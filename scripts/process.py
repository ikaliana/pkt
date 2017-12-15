from osgeo import gdal
from osgeo.gdalnumeric import *
from osgeo.gdalconst import *
from PIL import Image
import psycopg2
import psycopg2.extras
import numpy as np
import math
import sys
import os


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
	
	if nama_unsur[1:] == "": 			# perhitungan pupuk berdasarkan nutrisi daun
		retval = ( critical_value / current_value ) * prev_value
	else:								# perhitungan pupuk berdasarkan nutrisi tanah
		R = 2 							# radius perakaran: 2 m (TM) / 1 m (TBM)
		L = math.pi * math.pow(R,2) 	# luas area perakaran 
		L = 1 * L 						# asumsi dalam 1 pixel ada 4 area perakaran --> jadinya pake 1 lingkaran
		D = 0.2 	#0.6 				# kedalamanan perakaran: 0.2 m
		BV = 1000  						# Berat jenis tanah. asumsi = 1000 kg/m3
		retval = ( critical_value - current_value ) *  L * D * BV
		retval = retval * 100 / komposisi_value	

	return retval

def ClassifyPupuk(data):
	retval = "TUNGGAL"
	count = 0
	if data["N"] != 0: count+=1
	if data["P"] != 0: count+=1
	if data["K"] != 0: count+=1
	if count > 1: retval = "MAJEMUK"

	return retval

def GetData(strquery,firstRowOnly):
	try:
		db_host = "localhost"
		db_name = "pkt"
		db_user = "postgres"
		dp_pass = "password"

		conn = psycopg2.connect(host=db_host,database=db_name, user=db_user, password=dp_pass)
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
		db_host = "localhost"
		db_name = "pkt"
		db_user = "postgres"
		dp_pass = "password"

		retval = 0;
		conn = psycopg2.connect(host=db_host,database=db_name, user=db_user, password=dp_pass)
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


# ==============================================================================================================================

## ==================== VARIABLES  ====================

kelompok_unsur = ["N", "P", "K"]
# kelompok_unsur = ["N", "P", "K", "N-Tanah", "P-Tanah", "K-Tanah"]
nama_unsur = { "N" : "Nitrogen", "P" : "Fosfor", "K" : "Kalium", "N-Tanah" : "Nitrogen", "P-Tanah" : "Fosfor", "K-Tanah" : "Kalium" }
null_value = -9999
format_file = "GTiff"

class_color = [0x00000000,0xFF0000FF,0xFF2DFFFC,0xFF48FE6A,0xFF30C602,0xFFDCE620,0xFF8F3A12]
class_color_2 = [0x00000000,0xFF1C19D7,0xFF5390F6,0xFF9ADFFF,0xFF9EF0DC,0xFF62CC8A,0xFF41961A]

critical_value_daun = { "N" : 2.5, "P" : 0.15, "K" : 1.00 }
critival_value_tanah = { "N" : 0.25, "P" : 40, "K" : 97.5 }

# --- VARIABLE dibawah ini seharusnya ambil dari database -- #
rekomendasi_pupuk = { "UREA" : 272, "KCL" : 200, "TSP" : 200, "NPK" : 200 }  # kg / hektar

# rekomendasi_ppks = 	{
# 						"urea" : { "1": 0, "2": 0, "3": 0, "4": 0, "5": 0, "6": 0, "7": 0, "8": 0, "9": 0, "10": 0, "11": 0, }
# 					}
# --- END OF VARIABLE dibawah ini seharusnya ambil dari database -- #

id_analisis = str(sys.argv[1])

work_folder = "../result/"
if not os.path.isdir(work_folder + id_analisis):
	os.makedirs(work_folder + id_analisis)

work_folder += id_analisis + "/"
source_folder = "../uploads"
sentinel_file = source_folder + "/citra/"
shp_file = source_folder + "/area/"
clipped_file = ""
unsur_id = {}

# load raster and shape filename and model ID from table Analisis
strquery = ""
strquery += "select kode_model_n,kode_model_p,kode_model_k,"
strquery += "kode_model_n_tanah,kode_model_p_tanah,kode_model_k_tanah,"
strquery += "a.kode_citra,c.nama_file as citra_file,c.kode_area,ar.nama_file as area_file"
strquery += " from pkt_analisis a"
strquery += " left join pkt_citra c on a.kode_citra = c.kode_citra"
strquery += " left join pkt_area ar on c.kode_area = ar.kode_area"
strquery += " where a.kode_analisis = " + id_analisis
datavar = GetData(strquery,True)

#initiate working files
sentinel_file += str(datavar["kode_citra"]) + "/" + datavar["citra_file"]
shp_file += str(datavar["kode_area"]) + "/" + datavar["area_file"][:-4] + ".shp"
clipped_file = work_folder + datavar["citra_file"][:-4] + "_clipped" + datavar["citra_file"][-4:]

#initiate model ID
unsur_id["N"] = datavar["kode_model_n"]
unsur_id["P"] = datavar["kode_model_p"]
unsur_id["K"] = datavar["kode_model_k"]
unsur_id["N-Tanah"] = datavar["kode_model_n_tanah"]
unsur_id["P-Tanah"] = datavar["kode_model_p_tanah"]
unsur_id["K-Tanah"] = datavar["kode_model_k_tanah"]

#initiate fertilizer composition
komposisi_pupuk = {}
datapupuk = GetData("select * from pkt_pupuk",False)
for row in datapupuk:
	temp = {}
	temp["N"] = float(row["komposisi_n"])
	temp["P"] = float(row["komposisi_p"])
	temp["K"] = float(row["komposisi_k"])
	temp["ID"] = row["kode_pupuk"]
	temp["JENIS"] = ClassifyPupuk(temp)
	komposisi_pupuk[row["nama_pupuk"]] = temp

# print work_folder
# print sentinel_file
# print shp_file
# print clipped_file
# print unsur_id
# print komposisi_pupuk
# exit()

## ========== CLIP RASTER WITH SHAPEFILE  ====================

warp_opts = gdal.WarpOptions(
    format=format_file,
    cutlineDSName=shp_file,
    cropToCutline=True,
    dstNodata=-9999,
    xRes=10.0,
    yRes=10.0,
)
gdal.Warp(clipped_file, sentinel_file, options=warp_opts,)
#cari opsi lain buat clip raster (lihat di sample GDAL di internet)

## ========== LOAD RASTER AND ITS BAND  ====================

g = gdal.Open(clipped_file)
rows = g.RasterYSize
cols = g.RasterXSize
# print rows,cols

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
		temp["komposisi"] = komposisi_pupuk[nama_pupuk][unsur[:1]]
		temp["peta_prev"] = np.empty((cols, rows),numpy.float32)
		temp["peta_prev"].shape=rows, cols
		temp["peta_dosis"] = np.empty((cols, rows),numpy.float32)
		temp["peta_dosis"].shape=rows, cols
		temp["peta_warna"] = np.empty((cols, rows),numpy.uint32)
		temp["peta_warna"].shape=rows, cols
		temp["dosis"] = 0.0
		pupuk[nama_pupuk][unsur] = temp;

## ========== GET MODEL FROM DATABASE  ====================

# --- LOOP FOR EACH UNSUR --- #
for unsur in kelompok_unsur:

	model[unsur] = GetData('SELECT * FROM pkt_model where id_model=' + str(unsur_id[unsur]),True)

	# --- INITIATE NUMPY ARRAY OF RASTER --- #
	raster_unsur[unsur] = np.empty([rows, cols])
	raster_unsur_class[unsur] = np.empty((rows, cols),numpy.uint32)
	raster_unsur_color[unsur] = np.empty((cols, rows),numpy.uint32)
	raster_unsur_color[unsur].shape=rows, cols

	# --- PROCESS THE RASTER --- #
	for i in range(rows):
		for j in range(cols):

			if band1[i,j] != null_value:
				
				luas_area += 1

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
						data_pupuk["peta_prev"][i,j] = rekomendasi_pupuk[nama_pupuk] / 100.0
						crValue = critival_value_tanah[unsur[:1]]
						if unsur[1:] == "": crValue = critical_value_daun[unsur]

						data_pupuk["peta_dosis"][i,j] = CalculateDosisPupuk(unsur,crValue,raster_unsur[unsur][i,j],data_pupuk["peta_prev"][i,j],komposisi_pupuk[nama_pupuk][unsur[:1]])

						data_pupuk["peta_warna"][i,j] = ClassificationValue2(data_pupuk["peta_prev"][i,j],data_pupuk["peta_dosis"][i,j])
						data_pupuk["peta_warna"][i,j] = class_color_2[ data_pupuk["peta_warna"][i,j] ]
						data_pupuk["dosis"] += data_pupuk["peta_dosis"][i,j]

			else:
				raster_unsur[unsur][i,j] = null_value
				raster_unsur_class[unsur][i,j] = 0

				for nama_pupuk in komposisi_pupuk:
					data_pupuk = pupuk[nama_pupuk][unsur]
					data_pupuk["peta_prev"][i,j] = null_value
					data_pupuk["peta_dosis"][i,j] = null_value
					data_pupuk["peta_warna"][i,j] = class_color_2[0]

			raster_unsur_color[unsur][i,j] = class_color[ raster_unsur_class[unsur][i,j] ]
	# --- END OF PROCESS THE RASTER --- #

	# --- SAVE TO FILE --- #
	driver = gdal.GetDriverByName(format_file)
	nama_raster = work_folder + "Citra_Unsur_" + unsur + ".tif"
	ds = driver.Create(nama_raster, g.RasterXSize, g.RasterYSize, 1, g.GetRasterBand(1).DataType)
	CopyDatasetInfo(g,ds)
	bandOut=ds.GetRasterBand(1)
	bandOut.SetNoDataValue(null_value)
	BandWriteArray(bandOut, raster_unsur[unsur])

	nama_raster = work_folder + "Citra_Klasifikasi_" + unsur + ".png"
	pilImage = Image.frombuffer("RGBA",(cols, rows),raster_unsur_color[unsur].tostring(),"raw","RGBA",0,1)
	pilImage.save(nama_raster)

	for nama_pupuk in komposisi_pupuk:
		nama_raster = work_folder + "Citra_Pupuk_" + nama_pupuk + "_" + unsur + ".tif"
		ds2 = driver.Create(nama_raster, g.RasterXSize, g.RasterYSize, 1, g.GetRasterBand(1).DataType)
		CopyDatasetInfo(g,ds2)
		bandOut2=ds2.GetRasterBand(1)
		bandOut2.SetNoDataValue(null_value)
		BandWriteArray(bandOut2, pupuk[nama_pupuk][unsur]["peta_dosis"])

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

		nama_raster = work_folder + "Citra_Pupuk_" + nama_pupuk + ".tif"
		ds3 = driver.Create(nama_raster, g.RasterXSize, g.RasterYSize, 1, g.GetRasterBand(1).DataType)
		CopyDatasetInfo(g,ds3)
		bandOut3=ds3.GetRasterBand(1)
		bandOut3.SetNoDataValue(null_value)
		BandWriteArray(bandOut3, pupuk[nama_pupuk][unsur_terpilih]["peta_dosis"])

		nama_raster = work_folder + "Citra_Klasifikasi_Pupuk_" + nama_pupuk + ".png"
		pilImage = Image.frombuffer("RGBA",(cols, rows),pupuk[nama_pupuk][unsur_terpilih]["peta_warna"].tostring(),"raw","RGBA",0,1)
		pilImage.save(nama_raster)


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
# TO DO:
# - Total berat pupuk diambil dari total berat pupuk unsur yg paling kecil
# - Klasifikasi dilakukan setelah didapatkan total berat pupuk umum

print "DONE"