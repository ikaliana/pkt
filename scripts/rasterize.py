from osgeo import gdal, ogr, osr

# src: http://pcjericks.github.io/py-gdalogr-cookbook/raster_layers.html#convert-an-ogr-file-to-a-raster
#update: https://gis.stackexchange.com/questions/212795/rasterizing-shapefiles-with-gdal-and-python

def VectorToRaster(pixel_size,NoData_value,vector_fn,raster_fn,attribute_name):
	# Open the data source and read in the extent
	source_ds = ogr.Open(vector_fn)
	source_layer = source_ds.GetLayer()
	spatial_ref = source_layer.GetSpatialRef()
	epsg_value = spatial_ref.GetAttrValue("AUTHORITY",1)
	x_min, x_max, y_min, y_max = source_layer.GetExtent()

	# print vector_fn
	# print source_ds
	# print source_layer
	# print spatial_ref

	srs = osr.SpatialReference()
	srs.ImportFromEPSG(int(epsg_value))

	# Create the destination data source
	x_res = int((x_max - x_min) / pixel_size)
	y_res = int((y_max - y_min) / pixel_size)
	# target_ds = gdal.GetDriverByName('GTiff').Create(raster_fn, x_res, y_res, 1, gdal.GDT_Byte)
	target_ds = gdal.GetDriverByName('GTiff').Create(raster_fn, x_res, y_res, 1, gdal.GDT_Int32)
	target_ds.SetGeoTransform((x_min, pixel_size, 0, y_max, 0, -pixel_size))
	band = target_ds.GetRasterBand(1)
	band.Fill(NoData_value)
	band.SetNoDataValue(NoData_value)

	target_ds.SetProjection(srs.ExportToWkt())

	# Rasterize
	gdal.RasterizeLayer(target_ds, [1], source_layer, options=["ATTRIBUTE="+attribute_name])
	# gdal.RasterizeLayer(target_ds, [1], source_layer, burn_values=[0], options=["ATTRIBUTE="+attribute_name])
	target_ds = None


# Define pixel_size and NoData value of new raster
# pixel_size = 10
# NoData_value = -9999

# # Filename of input OGR file
# vector_fn = 'base_area.shp'

# # # Filename of the raster Tiff that will be created
# raster_fn = 'base_area.tif'

# VectorToRaster(pixel_size,NoData_value,vector_fn,raster_fn,"TahunTanam")
# print "DONE"