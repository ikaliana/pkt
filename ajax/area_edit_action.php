<?php
include "../config.php";

$id 			= $_POST['id'];
$lokasi 		= $_POST['lokasi'];
$area_name 		= $_POST['area_name'];
$deskripsi 		= $_POST['deskripsi'];
$allowed_ext	= array('shp', 'shx', 'dbf','prj');

if (isset($_FILES['shp']) && !empty($_FILES['shp'])) {
	$no_files = count($_FILES["shp"]['name']);
	$filename = pathinfo($_FILES["shp"]["name"][0], PATHINFO_FILENAME);
	if($no_files == 4 ){
		for($i=0; $i < $no_files; $i++){
			$filename 		= $_FILES["shp"]["name"][$i];
			$value			= explode('.', $filename);
			$file_ext		= strtolower(array_pop($value));
			$file_exts[$i]	= $file_ext;
		}
		if(in_array($file_exts[0], $allowed_ext) && in_array($file_exts[1], $allowed_ext) && in_array($file_exts[2], $allowed_ext) && in_array($file_exts[3], $allowed_ext)){	
			$sql = pg_query($db_conn, "UPDATE pkt_area SET nama='".$area_name."', lokasi='".$lokasi."', deskripsi='".$deskripsi."', nama_file='".$filename."' WHERE kode_area=".$id."");
		
			$kode_area = $id;
			
			$dirPath = "../uploads/area/".$kode_area;

			if (! is_dir($dirPath)) {
					throw new InvalidArgumentException("$dirPath must be a directory");
				}
				if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
					$dirPath .= '/';
				}
				$files = glob($dirPath . '*', GLOB_MARK);
				foreach ($files as $file) {
					if (is_dir($file)) {
						self::deleteDir($file);
					} else {
						unlink($file);
					}
				}
				
			for ($i = 0; $i < $no_files; $i++) {
				if ($_FILES["shp"]["error"][$i] > 0) {
					?>
					<script type="text/javascript">
						setTimeout(function () { swal("No!","Error: " . $_FILES["area"]["error"][$i] . "<br>","error");
					});</script>	
					<?php
				} else {	
					move_uploaded_file($_FILES["shp"]["tmp_name"][$i], '../uploads/area/' .$kode_area . '/' . $_FILES["shp"]["name"][$i]);
					?>
					<script type="text/javascript">
						setTimeout(function () { swal("Yes!","Area berhasil diperbarui!","success");
					});</script>		
					<?php
				}
			}
		}else{
			?>
			<script type="text/javascript">
				setTimeout(function () { swal("Oh tidak!","Anda mungkin mengupload file dengan ekstensi yang salah! Pastikan anda hanya mengupload file *.shp, *.shx, *.dbf, dan *.prj","error");
			});</script>		
			<?php
		}
	}else{
		?>
		<script type="text/javascript">
			setTimeout(function () { swal("Oh no!","File yang anda upload mungkin tidak lengkap! Pastikan anda mengupload file *.shp, *.shx, *.dbf, dan *.prj","error");
		});</script>		
		<?php
		}
}else{
	$sql = pg_query($db_conn, "UPDATE pkt_area SET nama='".$area_name."', lokasi='".$lokasi."', deskripsi='".$deskripsi."' WHERE kode_area=".$id."");
	?>
	<script type="text/javascript">
		setTimeout(function () { swal("Yes!","Area berhasil diperbarui! File tidak diganti","success");
	});</script>		
	<?php
}