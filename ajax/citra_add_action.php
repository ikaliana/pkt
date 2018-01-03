<?php
include "../config.php";

try {
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

				//if(!in_array($kode_area, $dir_citra)) mkdir('../uploads/citra/'.$kode_area.'');
				if(!file_exists('../uploads/citra/'.$kode_area.'')) mkdir('../uploads/citra/'.$kode_area.'',0777);

				if ($_FILES["tif"]["error"] > 0) {
					echo "No!|Error: Kode error ".$_FILES["tif"]["error"]."<br>|error";
				} else {
					$dir_citra2 = scandir('../uploads/citra/'.$kode_area.'');
					//if(!in_array($filename_ext, $dir_citra2)){
					if(!file_exists('../uploads/citra/'.$kode_area. '/' . $filename_ext)){
						$sql = pg_query($db_conn, "INSERT INTO pkt_citra (tanggal, kode_area, nama_file) VALUES ('".$tanggal."', '".$area."', '".$filename_ext."')");	
						move_uploaded_file($_FILES["tif"]["tmp_name"], '../uploads/citra/' .$kode_area. '/' . $filename_ext);
						echo "Yes!|Citra ".$area_name[0].", tanggal akuisisi ".$tanggal." berhasil ditambahkan!|success";
					}else{
						echo "Oh tidak!|Citra ".$filename_ext." untuk area ".$area_name[0]." sudah tersedia! Anda dapat langsung menggunakannya, atau silakan pilih file lainnya|error";
					}
				}

			}else{
				echo "Oh tidak!|Anda mungkin mengupload file dengan ekstensi yang salah! Pastikan anda hanya mengupload file dengan ekstensi *.tif|error";
			}
		} else {
			echo "No!|Pilih file *.tif untuk diupload!|error";
		}
	}else{
		echo "No!|Semua form harus diisi!|error";
	}
}
catch (Throwable $t) {
	echo "Oh tidak!|".$t->getMessage()."|error";
}
catch(Exception $e) {
	echo "Oh tidak!|".$e->getMessage()."|error";
} 
?>