<?php
include "../config.php";

$date 			= $_POST['tanggal'];
$tanggal 		= strtotime( $date );
$tanggal 		= date( 'Y-m-d', $tanggal );
$area			= $_POST['area'];
$allowed_ext	= array('tif');

$query ="SELECT nama FROM pkt_area WHERE kode_area=".$area."";
$get_area = pg_query($db_conn, $query);
$area_name = pg_fetch_array($get_area);

if(!empty($tanggal) && $area <> 0){
	if (isset($_FILES['tif']) && !empty($_FILES['tif'])) {
		$filename 		= pathinfo($_FILES["tif"]["name"], PATHINFO_FILENAME);
		$filename_ext	= $_FILES["tif"]["name"];
		$value			= explode('.', $filename_ext);
		$file_ext		= strtolower(array_pop($value));
		
		if(in_array($file_ext, $allowed_ext)){	
			$kode_area = $area;
			$dir_citra = scandir('../uploads/citra/');
			if(!in_array($kode_area, $dir_citra)){
				mkdir('../uploads/citra/'.$kode_area.'');
			}else{
				if ($_FILES["tif"]["error"] > 0) {
					?>
					<script type="text/javascript">
						setTimeout(function () { swal("No!",'Error: <?php echo $_FILES["tif"]["error"] ?> <br>',"error");
					});</script>	
					<?php
				} else {
					$dir_citra2 = scandir('../uploads/citra/'.$kode_area.'');
					if(!in_array($filename_ext, $dir_citra2)){
						$sql = pg_query($db_conn, "INSERT INTO pkt_citra (tanggal, kode_area, nama_file) VALUES ('".$tanggal."', '".$area."', '".$filename."')");	
						move_uploaded_file($_FILES["tif"]["tmp_name"], '../uploads/citra/' .$kode_area. '/' . $filename_ext);
						?>
						<script type="text/javascript">
							setTimeout(function () { swal("Yes!","Citra <?php echo $area_name[0]; ?>, tanggal akuisisi <?php echo $tanggal; ?> berhasil ditambahkan!","success");
						});</script>
					<?php
					}else{
						?>
						<script type="text/javascript">
							setTimeout(function () { swal("Oh tidak!","Citra <?php echo $filename_ext; ?> untuk area <?php echo $area_name[0]; ?> sudah tersedia! Anda dapat langsung menggunakannya, atau silakan pilih file lainnya","error");
						});</script>
						<?php
					}
				}
			}	
		}else{
			?>
			<script type="text/javascript">
				setTimeout(function () { swal("Oh tidak!","Anda mungkin mengupload file dengan ekstensi yang salah! Pastikan anda hanya mengupload file dengan ekstensi *.tif","error");
			});</script>		
			<?php
		}
	} else {
		?>
		<script type="text/javascript">
		setTimeout(function () { swal("No!","Pilih file *.tif untuk diupload!","error");
		});</script>	
		<?php	
	}
}else{
?>
	<script type="text/javascript">
	setTimeout(function () { swal("No!","Semua form harus diisi!","error");
	});</script>
<?php 
}
?>