from osgeo import gdal

format_file = "GTiff"
sentinel_file = "base_citra.tif"
shp_file = "base_area.tif"
clipped_file = "cliped.tif"

Raster = gdal.Open(shp_file, gdal.GA_ReadOnly)
Projection = Raster.GetProjectionRef()
PixelRes = 10
geoTransform = Raster.GetGeoTransform()
minX = geoTransform[0]
maxY = geoTransform[3]
maxX = minX + geoTransform[1] * Raster.RasterXSize
minY = maxY + geoTransform[5] * Raster.RasterYSize

processed_raster = gdal.Open(sentinel_file, gdal.GA_ReadOnly)

# warp_opts = gdal.WarpOptions(
#     format=format_file,
#     cutlineDSName=shp_file,
#     cropToCutline=True,
#     dstNodata=-9999,
#     xRes=10.0,
#     yRes=10.0,
# )
# gdal.Warp(clipped_file, sentinel_file, options=warp_opts,)

OutTile = gdal.Warp(
	clipped_file
	, processed_raster
	, format=format_file
	, outputBounds=[minX, minY, maxX, maxY]
	, xRes=PixelRes
	, yRes=PixelRes
	, dstSRS=Projection
	# , resampleAlg=gdal.GRA_NearestNeighbour
	, options=['COMPRESS=DEFLATE'])

Raster = None
processed_raster = None