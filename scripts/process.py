from osgeo import gdal,osr
from osgeo.gdalnumeric import *
from osgeo.gdalconst import *
from PIL import Image
from rasterstats import zonal_stats
from pyproj import Proj,transform
import psycopg2
import psycopg2.extras
import numpy as np
import math
import sys
import os
import time
import json
import palettable.cmocean.sequential as c 
import palettable.cubehelix as c1 
import palettable.matplotlib as c2
import palettable.colorbrewer.sequential as c3
import gridify
import rasterize

def ClassificationValue(val,unsur):
	retval = 0
	if unsur == "N":
		if val > 2.7: retval = 6
		elif val <= 2.7 and val > 2.5: retval = 5
		elif val <= 2.5 and val > 2.3: retval = 4 
		elif val <= 2.3 and val > 2.1: retval = 3 
		elif val <= 2.1 and val > 1.9: retval = 2 
		elif val <= 1.9: retval = 1 
	if unsur == "P":
		if val > 0.17: retval = 6
		elif val <= 0.17 and val > 0.15: retval = 5
		elif val <= 0.15 and val > 0.13: retval = 4 
		elif val <= 0.13 and val > 0.11: retval = 3 
		elif val <= 0.11 and val > 0.09: retval = 2 
		elif val <= 0.09: retval = 1 
	if unsur == "K":
		if val > 1.2: retval = 6
		elif val <= 1.2 and val > 1.0: retval = 5
		elif val <= 1.0 and val > 0.8: retval = 4 
		elif val <= 0.8 and val > 0.6: retval = 3 
		elif val <= 0.6 and val > 0.4: retval = 2 
		elif val <= 0.4: retval = 1 
	if unsur == "Mg":
		if val > 0.26: retval = 6
		elif val <= 0.26 and val > 0.24: retval = 5
		elif val <= 0.24 and val > 0.22: retval = 4 
		elif val <= 0.22 and val > 0.20: retval = 3 
		elif val <= 0.20 and val > 0.18: retval = 2 
		elif val <= 0.18: retval = 1 
	if unsur == "N-Tanah":
		if val > 0.25: retval = 6
		elif val <= 0.25 and val > 0.15: retval = 5
		elif val <= 0.15 and val > 0.12: retval = 4 
		elif val <= 0.12 and val > 0.08: retval = 3 
		elif val <= 0.08 and val > 0.04: retval = 2 
		elif val <= 0.04: retval = 1 
	if unsur == "P-Tanah":
		if val > 60: retval = 6
		elif val <= 60 and val > 40: retval = 5
		elif val <= 40 and val > 25: retval = 4 
		elif val <= 25 and val > 10: retval = 3 
		elif val <= 10 and val > 5: retval = 2 
		elif val <= 5: retval = 1 
	if unsur == "K-Tanah":  		# this value in PPM or mg/kg. To convert from cmol/kg, just multiply by 390 (weight of K = 39)
		if val > 117: retval = 6
		elif val <= 117 and val > 97.5: retval = 5
		elif val <= 97.5 and val > 78: retval = 4 
		elif val <= 78 and val > 31.2: retval = 3 
		elif val <= 31.2 and val > 16: retval = 2 
		elif val <= 16: retval = 1 


	return retval	

def ClassificationValue2(prev_val,new_val):
	retval = 0
	tempval = ((new_val - prev_val) / prev_val) * 100.00
	if tempval < 0: tempval = 0
	if tempval >= 0 and tempval <= 50: retval = 3
	elif tempval > 50 and tempval <= 100: retval = 2
	elif tempval > 100: retval = 1
	elif tempval < 0 and tempval >= -50: retval = 4
	elif tempval < -50 and tempval >= -100: retval = 5
	elif tempval < -100: retval = 6

	return retval

def CalculateDosisPupuk(nama_unsur,critical_value,current_value,prev_value,komposisi_value):
	retval = 0
	if current_value == 0: return 0
	
	kode_unsur = nama_unsur[:1]
	if kode_unsur not in ["N","P","K"]: kode_unsur = nama_unsur[:2]

	if (nama_unsur.replace(kode_unsur,"")) == "": 			# perhitungan pupuk berdasarkan nutrisi daun
		retval = ( critical_value / current_value ) * prev_value
	else:								# perhitungan pupuk berdasarkan nutrisi tanah
		# R = 2 							# radius perakaran: 2 m (TM) / 1 m (TBM)
		# L = math.pi * math.pow(R,2) 	# luas area perakaran 
		# L = 1 * L 						# asumsi dalam 1 pixel ada 4 area perakaran --> jadinya pake 1 lingkaran
		# D = 0.2 	#0.6 				# kedalamanan perakaran: 0.2 m
		# BV = 1000  						# Berat jenis tanah. asumsi = 1000 kg/m3
		# retval = ( critical_value - current_value ) *  L * D * BV
		# if retval <= 0: retval = 0
		# retval = retval * 100 / komposisi_value	
		L = math.pow(10,2)
		D = 0.2
		BV = 1000
		retval = ( critical_value - current_value )
		if retval <= 0: retval = 0
		else:
			retval = retval * L * D * BV
			if kode_unsur == "N":
				retval = retval / 100
			if kode_unsur == "P":
				retval = retval / 1000000
				retval = retval * 142 / 62
			if kode_unsur == "K":
				retval = retval / 1000000
				retval = retval * 94 / 39
			retval = retval * 100 / komposisi_value
		retval = 0

	return retval

def ClassifyPupuk(data):
	retval = "TUNGGAL"
	count = 0
	if data["N"] != 0: count+=1
	if data["P"] != 0: count+=1
	if data["K"] != 0: count+=1
	if data["Mg"] != 0: count+=1
	if count > 1: retval = "MAJEMUK"

	return retval

def db_config():
	
	return { "host" : "localhost", "database": "pkt", "username": "postgres","password": "password" }

def GetData(strquery,firstRowOnly):
	try:

		retval = None
		dbconf = db_config()
		# conn = psycopg2.connect(host=db_host,database=db_name, user=db_user, password=dp_pass)
		conn = psycopg2.connect(host=dbconf["host"],database=dbconf["database"], user=dbconf["username"], password=dbconf["password"])
		cur = conn.cursor(cursor_factory=psycopg2.extras.DictCursor)
		cur.execute(strquery)
		
		if cur.rowcount > 0:
			if firstRowOnly: 
				retval = cur.fetchone()
			else:
				retval = cur.fetchall()

		cur.close()

	except (Exception, psycopg2.DatabaseError) as error:
	    print(error)

	finally:
	    if conn is not None:
	        conn.close()

    	return retval

def ExecuteQuery(strquery,params,singleRowOnly,fetchResult):
	try:

		retval = 0;
		dbconf = db_config()
		# conn = psycopg2.connect(host=db_host,database=db_name, user=db_user, password=dp_pass)
		conn = psycopg2.connect(host=dbconf["host"],database=dbconf["database"], user=dbconf["username"], password=dbconf["password"])
		cur = conn.cursor()
		if singleRowOnly:
			cur.execute(strquery,params)
			if fetchResult: retval = cur.fetchone()[0]
		else:
			cur.executemany(strquery,params)	
			if fetchResult: retval = 1	
		
		conn.commit()
		cur.close()

	except (Exception, psycopg2.DatabaseError) as error:
	    print(error)

	finally:
	    if conn is not None:
	        conn.close()

    	if fetchResult: return retval

def SaveDataToTiff(nama_raster,arraydata,g):
	driver = gdal.GetDriverByName("GTiff")
	ds = driver.Create(nama_raster, g.RasterXSize, g.RasterYSize, 1, g.GetRasterBand(1).DataType)
	CopyDatasetInfo(g,ds)
	bandOut=ds.GetRasterBand(1)
	bandOut.SetNoDataValue(null_value)
	BandWriteArray(bandOut, arraydata)

def SaveDataToPNG(nama_raster,arraydata,cols,rows):
	pilImage = Image.frombuffer("RGBA",(cols, rows),arraydata,"raw","RGBA",0,1)
	pilImage.save(nama_raster)


# ==============================================================================================================================

## ==================== VARIABLES  ====================

# kelompok_unsur = ["N", "P", "K", "N-Tanah", "P-Tanah", "K-Tanah"]
kelompok_unsur = ["N", "P", "K", "Mg"]
nama_unsur = { "N" : "Nitrogen", "P" : "Fosfor", "K" : "Kalium", "Mg": "Magnesium", "N-Tanah" : "Nitrogen", "P-Tanah" : "Fosfor", "K-Tanah" : "Kalium" }
null_value = -9999
format_file = "GTiff"
pixel_size = 10.0

class_color = [0x00000000,0xFF0000FF,0xFF2DFFFC,0xFF48FE6A,0xFF30C602,0xFFDCE620,0xFF8F3A12]
class_color_2 = [0x00000000,0xFF1C19D7,0xFF5390F6,0xFF9ADFFF,0xFF9EF0DC,0xFF62CC8A,0xFF41961A]
# data_color = c.Algae_20.hex_colors
data_color = c.Ice_15.hex_colors[::-1]
# data_color = c1.purple_16.hex_colors[::-1]	#additional '[::-1]' --> reverse the array
# data_color = c2.Viridis_20.hex_colors[::-1]
# data_color = c3.Blues_9.hex_colors
data_color_size = np.size(data_color)

critical_value_daun = { "N" : 2.5, "P" : 0.15, "K" : 1.00, "Mg" : 0.24 }
critival_value_tanah = { "N" : 0.25, "P" : 40, "K" : 97.5, "Mg" : 0 }

id_analisis = str(sys.argv[1])

work_folder = "../result/"
if not os.path.isdir(work_folder + id_analisis):
	os.makedirs(work_folder + id_analisis,0777)
	os.chmod(work_folder + id_analisis,0777)

work_folder += id_analisis + "/"
source_folder = "../uploads"
sentinel_file = source_folder + "/citra/"
shp_file = source_folder + "/area/"
clipped_file = ""
grid_file = ""
raster_tahun_tanam = ""
unsur_id = {}

# load raster and shape filename and model ID from table Analisis
strquery = ""
strquery += "select kode_model_n,kode_model_p,kode_model_k,kode_model_mg,"
strquery += "kode_model_n_tanah,kode_model_p_tanah,kode_model_k_tanah,"
strquery += "a.kode_citra,c.nama_file as citra_file,c.kode_area,ar.nama_file as area_file,c.tanggal as tanggal_citra"
strquery += " from pkt_analisis a"
strquery += " left join pkt_citra c on a.kode_citra = c.kode_citra"
strquery += " left join pkt_area ar on c.kode_area = ar.kode_area"
strquery += " where a.kode_analisis = " + id_analisis
datavar = GetData(strquery,True)

#initiate working files
kode_area = datavar["kode_area"]
sentinel_file += str(kode_area) + "/" + datavar["citra_file"]
shp_file += str(kode_area) + "/" + datavar["area_file"][:-4] + ".shp"
clipped_file = work_folder + datavar["citra_file"][:-4] + "_clipped" + datavar["citra_file"][-4:]
grid_file = work_folder + datavar["area_file"][:-4] + "_grid" + ".shp"
raster_tahun_tanam = work_folder + datavar["area_file"][:-4] + "_tahuntanam" + ".tif"
tanggal_citra = datavar["tanggal_citra"]

#initiate model ID
unsur_id["N"] = datavar["kode_model_n"]
unsur_id["P"] = datavar["kode_model_p"]
unsur_id["K"] = datavar["kode_model_k"]
unsur_id["Mg"] = datavar["kode_model_mg"]
# unsur_id["N-Tanah"] = datavar["kode_model_n_tanah"]
# unsur_id["P-Tanah"] = datavar["kode_model_p_tanah"]
# unsur_id["K-Tanah"] = datavar["kode_model_k_tanah"]

#initiate fertilizer composition
komposisi_pupuk = {}
# datapupuk = GetData("select * from pkt_pupuk",False)
datapupuk = GetData("select * from pkt_pupuk where kode_pupuk in (select distinct kode_pupuk from pkt_rekomendasi)",False)
for row in datapupuk:
	temp = {}
	temp["N"] = float(row["komposisi_n"])
	temp["P"] = float(row["komposisi_p"])
	temp["K"] = float(row["komposisi_k"])
	temp["Mg"] = float(row["komposisi_mg"])
	temp["ID"] = row["kode_pupuk"]
	temp["JENIS"] = ClassifyPupuk(temp)
	komposisi_pupuk[row["nama_pupuk"]] = temp

# print komposisi_pupuk
# exit(0)

#initiate data rekomendasi pupuk PPKS
rekomendasi_pupuk = {}
strquery = ""
strquery += "select p.nama_pupuk,r.* from pkt_rekomendasi r "
strquery += "left join pkt_pupuk p on r.kode_pupuk = p.kode_pupuk "
strquery += "order by p.nama_pupuk,r.umur_tanaman"
datarekomendasi = GetData(strquery,False)

temp_nama = ""
for row in datarekomendasi:
	if temp_nama != row["nama_pupuk"]:
		rekomendasi_pupuk[row["nama_pupuk"]] = {}
		temp = rekomendasi_pupuk[row["nama_pupuk"]]
	temp_nama = row["nama_pupuk"]
	temp[row["umur_tanaman"]] = row["jumlah_pupuk"] 

#initiate data riwayat pupuk
riwayat_pupuk = {}
strquery = ""
strquery += "select p.nama_pupuk,r.kode_pupuk,r.tahun,r.dosis_pupuk "
strquery += "from pkt_riwayat r left join pkt_pupuk p on r.kode_pupuk = p.kode_pupuk "
strquery += "where r.kode_area = " + str(kode_area) + " "
strquery += "order by p.nama_pupuk,r.tahun "
datariwayat = GetData(strquery,False)

if datariwayat is not None:
	temp_nama = ""
	for row in datariwayat:
		if temp_nama != row["nama_pupuk"]:
			riwayat_pupuk[row["nama_pupuk"]] = {}
			temp = riwayat_pupuk[row["nama_pupuk"]]
		temp_nama = row["nama_pupuk"]
		temp[row["tahun"]] = row["dosis_pupuk"] 

# print work_folder
# print sentinel_file
# print shp_file
# print clipped_file
# print unsur_id
# print komposisi_pupuk
# print rekomendasi_pupuk
# print riwayat_pupuk
# exit()

## ========== CLIP RASTER WITH SHAPEFILE  ====================

warp_opts = gdal.WarpOptions(
    format=format_file,
    cutlineDSName=shp_file,
    cropToCutline=True,
    dstNodata=null_value,
    xRes=pixel_size,
    yRes=pixel_size,
)
gdal.Warp(clipped_file, sentinel_file, options=warp_opts)
#cari opsi lain buat clip raster (lihat di sample GDAL di internet). bbrp titik hasilnya meleset
# exit()

## ========== CREATE GRID FILE  ====================

gridify.GenerateGrid(shp_file,grid_file)

## ========== CREATE RASTER OF TahunTanam  ====================

field_name = "TahunTanam"

rasterize.VectorToRaster(pixel_size,null_value,shp_file,raster_tahun_tanam,field_name)
# exit()

## ========== LOAD RASTER AND ITS BAND  ====================

g = gdal.Open(clipped_file)
rows = g.RasterYSize
cols = g.RasterXSize
# print rows,cols
x1, xres, xskew, y2, yskew, yres = g.GetGeoTransform()
x2 = x1 + g.RasterXSize * xres
y1 = y2 + g.RasterYSize * yres
prj = g.GetProjection()
srs = osr.SpatialReference(wkt=prj)
crs = srs.GetAttrValue("AUTHORITY",1)

p1 = Proj(init="epsg:"+crs)
p2 = Proj(init="epsg:4326")
x3,y3 = transform(p1,p2,x1,y1)
x4,y4 = transform(p1,p2,x2,y2)

#-- SAVE RASTER METADATA TO JSON FILE
raster_metadata = { "x1_original": x1 , "y1_original": y1, "x2_original": x2, "y2_original": y2, 
					"x1_4326": x3 , "y1_4326": y3, "x2_4326": x4, "y2_4326": y4, 
					"crs": crs }
with open(work_folder + "raster_metadata.json", 'w') as outfile:
		    json.dump(raster_metadata, outfile)

# --- LOAD RASTER DATA FOR EACH BAND --- #
band1 = BandReadAsArray(g.GetRasterBand(1))  	#Band 1
band2 = BandReadAsArray(g.GetRasterBand(2))		#Band 2
band3 = BandReadAsArray(g.GetRasterBand(3))		#Band 3
band4 = BandReadAsArray(g.GetRasterBand(4))		#Band 4
band5 = BandReadAsArray(g.GetRasterBand(5))		#Band 5
band6 = BandReadAsArray(g.GetRasterBand(6))		#Band 6
band7 = BandReadAsArray(g.GetRasterBand(7))		#Band 7
band8 = BandReadAsArray(g.GetRasterBand(8))		#Band 8
band8a = BandReadAsArray(g.GetRasterBand(9))	#Band 8A
band9 = BandReadAsArray(g.GetRasterBand(10))	#Band 9
band11 = BandReadAsArray(g.GetRasterBand(11))	#Band 11
band12 = BandReadAsArray(g.GetRasterBand(12))	#Band 12

# ---- LOAD TAHUN TANAM RASTER
g2 = gdal.Open(raster_tahun_tanam)
rows2 = g2.RasterYSize
cols2 = g2.RasterXSize
tahun_tanam_data = BandReadAsArray(g2.GetRasterBand(1)) 


## ========== INITIALIZE CALCULATION PLACEHOLDER  ====================

model = {}
raster_unsur = {}
raster_unsur_class = {}
raster_unsur_color = {}
pupuk = {}
luas_area = 0

for nama_pupuk in komposisi_pupuk:
	pupuk[nama_pupuk] = {}
	pupuk[nama_pupuk]["unsur_terpilih"] = ""

	for unsur in kelompok_unsur:
		temp = {}
		kode_unsur = unsur[:1]
		if kode_unsur not in ["N","P","K"]: kode_unsur = unsur[:2]
		temp["komposisi"] = komposisi_pupuk[nama_pupuk][kode_unsur]
		temp["peta_prev"] = np.empty((cols, rows),np.float32)
		temp["peta_prev"].shape=rows, cols
		temp["peta_dosis"] = np.empty((cols, rows),np.float32)
		temp["peta_dosis"].shape=rows, cols
		# temp["peta_dosis_warna"] = np.empty((cols, rows),np.uint32)
		# temp["peta_dosis_warna"].shape=rows, cols
		temp["peta_warna"] = np.empty((cols, rows),np.uint32)
		temp["peta_warna"].shape=rows, cols
		temp["peta_warna2"] = np.empty((cols, rows),np.uint32)
		temp["peta_warna2"].shape=rows, cols
		temp["dosis"] = 0.0
		pupuk[nama_pupuk][unsur] = temp;

## ========== GET MODEL FROM DATABASE  ====================

# --- LOOP FOR EACH UNSUR --- #
for unsur in kelompok_unsur:

	model[unsur] = GetData('SELECT * FROM pkt_model where id_model=' + str(unsur_id[unsur]),True)

	# --- INITIATE NUMPY ARRAY OF RASTER --- #
	raster_unsur[unsur] = np.empty([rows, cols])
	raster_unsur_class[unsur] = np.empty((rows, cols),np.uint32)
	raster_unsur_color[unsur] = np.empty((cols, rows),np.uint32)
	raster_unsur_color[unsur].shape=rows, cols

	# --- PROCESS THE RASTER --- #
	for i in range(rows):
		for j in range(cols):

			tahun_tanam_null = True
			if i < rows2 and j < cols2: tahun_tanam_null = (tahun_tanam_data[i,j] == null_value)

			ndvi_value = (band8[i,j] - band4[i,j]) / (band8[i,j] + band4[i,j]) * 1.000
			is_vegetation = (ndvi_value >= 0.4000)

			# if band1[i,j] != null_value:
			if band1[i,j] != null_value and not tahun_tanam_null and is_vegetation:
				
				luas_area += 1
				tahun_tanam = tahun_tanam_data[i,j]  #ambil data ini dari raster/vector
				tahun_now = int(tanggal_citra.strftime("%Y"))  #harusnya ngambil dari tanggal sensing citra sentinel
				umur_tanaman = tahun_now - tahun_tanam

				# --- calculate nutrient using model --- #
				raster_unsur[unsur][i,j] = \
					band1[i,j] * model[unsur]["band1"] + band2[i,j] * model[unsur]["band2"] + band3[i,j] * model[unsur]["band3"] \
					+ band4[i,j] * model[unsur]["band4"] + band5[i,j] * model[unsur]["band5"] + band6[i,j] * model[unsur]["band6"] \
					+ band7[i,j] * model[unsur]["band7"] + band8[i,j] * model[unsur]["band8"] + band8a[i,j] * model[unsur]["band8a"] \
					+ band9[i,j] * model[unsur]["band9"] + band11[i,j] * model[unsur]["band11"] + band12[i,j] * model[unsur]["band12"] \
					+ (band1[i,j]**2) * model[unsur]["band1_2"] + (band2[i,j]**2) * model[unsur]["band2_2"] \
					+ (band3[i,j]**2) * model[unsur]["band3_2"] + (band4[i,j]**2) * model[unsur]["band4_2"] \
					+ (band5[i,j]**2) * model[unsur]["band5_2"] + (band6[i,j]**2) * model[unsur]["band6_2"] \
					+ (band7[i,j]**2) * model[unsur]["band7_2"] + (band8[i,j]**2) * model[unsur]["band8_2"] \
					+ (band8a[i,j]**2) * model[unsur]["band8a_2"] + (band9[i,j]**2) * model[unsur]["band9_2"] \
					+ (band11[i,j]**2) * model[unsur]["band11_2"] + (band12[i,j]**2) * model[unsur]["band12_2"] \
					+ model[unsur]["constant"]
				
				# --- make it non negative value --- #
				if raster_unsur[unsur][i,j] < 0: raster_unsur[unsur][i,j] = 0

				# --- classify the nutrient value --- #
				raster_unsur_class[unsur][i,j] = ClassificationValue(raster_unsur[unsur][i,j],unsur)

				for nama_pupuk in komposisi_pupuk:
					data_pupuk = pupuk[nama_pupuk][unsur]
					if data_pupuk["komposisi"] > 0:
						
						#Get Last year dosage value. If none, use PPKS recommendation value
						# data_pupuk["peta_prev"][i,j] = rekomendasi_pupuk[nama_pupuk] / 100.0
						riwayat_data_pupuk = False
						if nama_pupuk in riwayat_pupuk:
							if (tahun_now-1) in riwayat_pupuk[nama_pupuk]:
								data_pupuk["peta_prev"][i,j] = riwayat_pupuk[nama_pupuk][(tahun_now-1)] / 100.0
								riwayat_data_pupuk = True

						if not riwayat_data_pupuk:
							data_pupuk["peta_prev"][i,j] = rekomendasi_pupuk[nama_pupuk][umur_tanaman] / 100.0

						kode_unsur = unsur[:1]
						if kode_unsur not in ["N","P","K",""]: kode_unsur = unsur[:2]
						crValue = critival_value_tanah[kode_unsur]
						if (unsur.replace(kode_unsur,"")) == "": crValue = critical_value_daun[unsur]
						# print(kode_unsur,": ",crValue)

						data_pupuk["peta_dosis"][i,j] = CalculateDosisPupuk(unsur,crValue,raster_unsur[unsur][i,j],data_pupuk["peta_prev"][i,j],komposisi_pupuk[nama_pupuk][kode_unsur])

						data_pupuk["peta_warna"][i,j] = ClassificationValue2(data_pupuk["peta_prev"][i,j],data_pupuk["peta_dosis"][i,j])
						# data_pupuk["peta_warna"][i,j] = class_color_2[ data_pupuk["peta_warna"][i,j] ]
						data_pupuk["peta_warna2"][i,j] = class_color_2[ data_pupuk["peta_warna"][i,j] ]
						data_pupuk["dosis"] += data_pupuk["peta_dosis"][i,j]

			else:
				raster_unsur[unsur][i,j] = null_value
				raster_unsur_class[unsur][i,j] = 0

				for nama_pupuk in komposisi_pupuk:
					data_pupuk = pupuk[nama_pupuk][unsur]
					data_pupuk["peta_prev"][i,j] = null_value
					data_pupuk["peta_dosis"][i,j] = null_value
					data_pupuk["peta_warna"][i,j] = 0
					data_pupuk["peta_warna2"][i,j] = class_color_2[0]

			raster_unsur_color[unsur][i,j] = class_color[ raster_unsur_class[unsur][i,j] ]
	# --- END OF PROCESS THE RASTER --- #

	# --- SAVE TO FILE --- #
	nama_raster = work_folder + "Citra_Unsur_" + unsur + ".tif"
	SaveDataToTiff(nama_raster,raster_unsur[unsur],g)

	nama_raster = work_folder + "Citra_Klasifikasi_" + unsur + ".png"
	SaveDataToPNG(nama_raster,raster_unsur_color[unsur].tostring(),cols,rows)

	for nama_pupuk in komposisi_pupuk:
		nama_raster = work_folder + "Citra_Pupuk_" + nama_pupuk + "_" + unsur + ".tif"
		SaveDataToTiff(nama_raster,pupuk[nama_pupuk][unsur]["peta_dosis"],g)

		# nama_raster = "Citra_Klasifikasi_Pupuk_" + nama_pupuk + "_" + unsur + ".png"
		# pilImage = Image.frombuffer("RGBA",(cols, rows),pupuk[nama_pupuk][unsur]["peta_warna"].tostring(),"raw","RGBA",0,1)
		# pilImage.save(nama_raster)

# --- END LOOP FOR EACH UNSUR --- #

area_hektar = (luas_area/len(kelompok_unsur))/100.00
# print "Luas area: ", round(area_hektar,2) 

sql = "DELETE FROM pkt_analisis_detail WHERE kode_analisis = %s;"
data = (int(id_analisis),)
ExecuteQuery(sql,data,True,False)

# --- LOOP FOR EACH PUPUK, HITUNG TOTAL DOSIS UMUM --- #
for nama_pupuk in komposisi_pupuk:
	unsur_terpilih = ""
	temp_berat = 9999999

	jenis_pupuk = komposisi_pupuk[nama_pupuk]["JENIS"]
	kode_pupuk = komposisi_pupuk[nama_pupuk]["ID"]

	for unsur in kelompok_unsur:
		data_pupuk = pupuk[nama_pupuk][unsur]

		if data_pupuk["dosis"] != 0:
			if temp_berat > data_pupuk["dosis"]:
				temp_berat = data_pupuk["dosis"]
				unsur_terpilih = unsur

		dosis_total = data_pupuk["dosis"]
		dosis_hektar = dosis_total / area_hektar * 1.0
		dosis_pohon = dosis_hektar / 136

		print nama_pupuk,"\t",jenis_pupuk,"\t",unsur,"\t",round(dosis_total,2),"\t",round(dosis_hektar,2),"\t",round(dosis_pohon,2)
		
		sql = "INSERT INTO pkt_analisis_detail (kode_analisis,kode_pupuk,nama_pupuk,jenis_pupuk,nama_unsur,"
		sql += "dosis_total,dosis_hektar,dosis_pohon) VALUES "
		sql += "(%s,%s,%s,%s,%s,%s,%s,%s)"
		data = (int(id_analisis),kode_pupuk,nama_pupuk,jenis_pupuk,unsur,dosis_total,dosis_hektar,dosis_pohon,)
		ExecuteQuery(sql,data,True,False)

	if unsur_terpilih != "":
		pupuk[nama_pupuk]["unsur_terpilih"] = unsur_terpilih
		print "Unsur terpilih: ", unsur_terpilih

		# --- SAVE SELECTED FERTILIZER DATA TO PNG FILE --- #
		nama_raster = work_folder + "Citra_Pupuk_" + nama_pupuk + ".tif"
		SaveDataToTiff(nama_raster,pupuk[nama_pupuk][unsur_terpilih]["peta_dosis"],g)


		# --- Create Fertilizer stats based on GRID file and save it to Geojson file --- #
		stats = zonal_stats(grid_file, nama_raster, stats="count min mean max sum", geojson_out=True)
		json_data = {}
		json_data["type"] = "FeatureCollection"
		json_data["features"] = [] #stats
		for item in stats:
			temp_item = {}
			for key in item.keys():
				if key != "geometry":
					temp_item[key] = item[key]
				else:
					temp_geom = {}
					item_geom = item[key]					
					temp_geom["type"] = item_geom["type"]
					temp_geom["coordinates"] = []
					temp_geom["coordinates"].append([])
					temp_coords = temp_geom["coordinates"][0]
					item_coords = item_geom["coordinates"][0]
					for coord in item_coords:
						xc,yc = transform(p1,p2,coord[0],coord[1])
						temp_geom["coordinates"][0].append([xc,yc])
					temp_item[key] = temp_geom

			json_data["features"].append(temp_item)


		with open(work_folder + "Data_Grid_Pupuk_" + nama_pupuk + ".geojson", 'w') as outfile:
		    json.dump(json_data, outfile)

		
		# --- SAVE SELECTED FERTILIZER DOSAGE DATA TO PNG FILE --- #
		# nama_raster = work_folder + "Citra_Dosis_Pupuk_Percent_" + nama_pupuk + ".tif"
		# SaveDataToTiff(nama_raster,pupuk[nama_pupuk][unsur_terpilih]["peta_warna"],g)
		nama_raster = work_folder + "Citra_Dosis_Pupuk_" + nama_pupuk + ".png"
		SaveDataToPNG(nama_raster,pupuk[nama_pupuk][unsur_terpilih]["peta_warna2"].tostring(),cols,rows)

		
		# --- Classify fertilizer data and save to PNG --- #
		data_dosis = pupuk[nama_pupuk][unsur_terpilih]["peta_dosis"]
		dosis_max = np.ceil(np.amax(np.extract(data_dosis>=0,data_dosis)))
		# print "dosis max: ", dosis_max
		range_max = 1000
		for i in range(8,0,-1):
			if dosis_max <= (data_color_size * i): range_max = data_color_size * i 
		if dosis_max <= (data_color_size/2): range_max = data_color_size/2

		divider = range_max / (data_color_size * 1.0) #20.0
		range_value = np.arange(0,range_max+(divider/2.0),divider)
		# print range_value

		raster_data = np.empty((cols, rows),numpy.uint32)
		raster_data.shape=rows, cols

		for i in range(rows):
			for j in range(cols):

				if data_dosis[i,j] != null_value:
					dosis_val = data_dosis[i,j]
					idx = range_value.searchsorted(dosis_val,'right')-1
					if idx > 14: idx = 14
					if idx < 0: idx = 0
					color_val = data_color[idx]
					color_val_new = '0xFF' + color_val[5:7] + color_val[3:5] + color_val[1:3] 
					raster_data[i,j] = eval(color_val_new)
				else:
					raster_data[i,j] = 0x00000000

		# raster_data = np.zeros((cols, rows),np.uint32)
		# raster_data.shape=rows, cols

		# for i in range(np.size(range_value)-1):
		# 	minval = range_value[i]
		# 	cond1 = np.greater_equal(data_dosis,minval)
		# 	maxval = range_value[i+1]
		# 	cond2 = np.less(data_dosis,maxval)
		# 	cond3 = np.logical_and(cond1,cond2)

		# 	color_val = data_color[i]
		# 	color_val_new = '0xFF' + color_val[5:7] + color_val[3:5] + color_val[1:3] 
		# 	temp_data = np.where(cond3,eval(color_val_new),0)
		# 	raster_data = raster_data + temp_data

		# 	if nama_pupuk == "UREA":
		# 		print i,"-",minval,maxval
		# 		nama_raster = work_folder + "Citra_Dosis_Pupuk_" + str(i) + ".png"
		# 		SaveDataToPNG(nama_raster,temp_data.tostring(),cols,rows)

		# raster_data = raster_data + np.where (data_dosis >= range_value[np.size(range_value)-1],0xFF000000,0)
		# raster_data = raster_data + np.where( (data_dosis > null_value) & (data_dosis < 0),0xFFFFFFFF,0)

		nama_raster = work_folder + "Citra_Klasifikasi_Pupuk_" + nama_pupuk + ".png"
		SaveDataToPNG(nama_raster,raster_data.tostring(),cols,rows)



sql = "DELETE FROM pkt_analisis_summary WHERE kode_analisis = %s;"
data = (int(id_analisis),)
ExecuteQuery(sql,data,True,False)

sql = "INSERT INTO pkt_analisis_summary (kode_analisis,last_process,status_process,err_message,luas_area) "
sql += "VALUES (%s,now(),'OK','',%s)"
data = (int(id_analisis),area_hektar)
ExecuteQuery(sql,data,True,False)

sql = "UPDATE pkt_analisis SET status=True WHERE kode_analisis=%s"
data = (int(id_analisis),)
ExecuteQuery(sql,data,True,False)


print "DONE"