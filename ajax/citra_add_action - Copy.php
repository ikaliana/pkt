<?php
include "../config.php";

$date 			= $_POST['tanggal'];
$tanggal 		= strtotime( $date );
$tanggal 		= date( 'Y-m-d', $tanggal );
$area			= $_POST['area'];

$query ="SELECT nama FROM pkt_area WHERE kode_area=".$area."";
$get_area = pg_query($db_conn, $query);
$area_name = pg_fetch_array($get_area);

if(!empty($tanggal) && $area <> 0){
	$sql = pg_query($db_conn, "INSERT INTO pkt_citra (tanggal, kode_area) VALUES ('".$tanggal."', '".$area."')");	
	move_uploaded_file($_FILES["file"]["tmp_name"], '../uploads/citra/4/' . $_FILES["file"]["name"]);
	?>
	<script type="text/javascript">
		setTimeout(function () { swal("Yes!","Citra <?php echo $area_name[0]; ?>, tanggal akuisisi <?php echo $tanggal; ?> berhasil ditambahkan!","success");
	});</script>
	<?php
}else{
?>
	<script type="text/javascript">
	setTimeout(function () { swal("No!","Semua form harus diisi!","error");
	});</script>
<?php 
}
?>