from osgeo import ogr
import osgeo.osr as osr
import math
import os

#===========
# ref:
# http://varunpant.com/posts/how-to-create-fishnets-or-geospatial-grids
# https://pcjericks.github.io/py-gdalogr-cookbook/vector_layers.html
#=================

def GenerateGrid(shp_file,out_file):
	#adeasddwa
	inDriver = ogr.GetDriverByName("ESRI Shapefile")
	inDataSource = inDriver.Open(shp_file, 1)
	inLayer = inDataSource.GetLayer()
	xmin,xmax,ymin,ymax = inLayer.GetExtent()
	# print xmin,xmax,ymin,ymax
	spatial_ref = inLayer.GetSpatialRef()
	epsg_value = spatial_ref.GetAttrValue("AUTHORITY",1)

	gridWidth = 100.0
	gridHeight = 100.0

	rows = math.ceil((ymax-ymin)/gridHeight)
	cols = math.ceil((xmax-xmin)/gridWidth)

	ringXleftOrigin = xmin
	ringXrightOrigin = xmin + gridWidth
	ringYtopOrigin = ymax
	ringYbottomOrigin = ymax-gridHeight

	# create output file
	outDriver = ogr.GetDriverByName('ESRI Shapefile')
	fieldName = "KODE"
	srs = osr.SpatialReference()
	srs.ImportFromEPSG(int(epsg_value))

	if os.path.exists(out_file): os.remove(out_file)
	outDataSource = outDriver.CreateDataSource(out_file)
	outLayer = outDataSource.CreateLayer(out_file,srs,ogr.wkbPolygon )
	featureDefn = outLayer.GetLayerDefn()
	new_field = ogr.FieldDefn(fieldName, ogr.OFTInteger)
	outLayer.CreateField(new_field)


	# create grid cells
	countcols = 0
	counter = 0

	while (countcols < cols):
		countcols += 1
	    # reset envelope for rows
		ringYtop = ringYtopOrigin
		ringYbottom = ringYbottomOrigin
		countrows = 0
		
		while countrows < rows:
			countrows += 1
			counter += 1
			ring = ogr.Geometry(ogr.wkbLinearRing)
			ring.AddPoint(ringXleftOrigin, ringYtop)
			ring.AddPoint(ringXrightOrigin, ringYtop)
			ring.AddPoint(ringXrightOrigin, ringYbottom)
			ring.AddPoint(ringXleftOrigin, ringYbottom)
			ring.AddPoint(ringXleftOrigin, ringYtop)
			poly = ogr.Geometry(ogr.wkbPolygon)
			poly.AddGeometry(ring)

			# add new geom to layer
			outFeature = ogr.Feature(featureDefn)
			outFeature.SetGeometry(poly)
			outFeature.SetField(fieldName,counter)
			outLayer.CreateFeature(outFeature)
			outFeature.Destroy


			# new envelope for next poly
			ringYtop = ringYtop - gridHeight
			ringYbottom = ringYbottom - gridHeight

    	# new envelope for next poly
		ringXleftOrigin = ringXleftOrigin + gridWidth
		ringXrightOrigin = ringXrightOrigin + gridWidth


	# Close DataSources
	outDataSource.Destroy()
	# print "DONE"


# work_folder = "../result/"
# source_folder = "../uploads"
# shp_file = source_folder + "/area/"
# shp_file += "3/kebun_jonggol_32478.shp"
# out_file = "grid_coba.shp"

# GenerateGrid(shp_file,out_file)
