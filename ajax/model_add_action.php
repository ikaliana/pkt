<?php
include "../config.php";

$model_name 	= $_POST['model_name'];
$nutrisi 		= $_POST['nutrisi'];
$b1				= $_POST['b1'];
$b2 			= $_POST['b2'];
$b3 			= $_POST['b3'];
$b4 			= $_POST['b4'];
$b5 			= $_POST['b5'];
$b6 			= $_POST['b6'];
$b7 			= $_POST['b7'];
$b8 			= $_POST['b8'];
$b8a 			= $_POST['b8a'];
$b9 			= $_POST['b9'];
$b10 			= $_POST['b10'];
$b11 			= $_POST['b11'];
$b12 			= $_POST['b12'];


	$query = "SELECT id_model FROM pkt_model WHERE nama='".$model_name."'";
	$sql = pg_query($db_conn, $query);
	$data_exist = pg_fetch_array($sql);
	if(empty($data_exist))
	{
		$query2 = "INSERT INTO pkt_model (nama, nutrisi, band1, band2, band3, band4, band5, band6, band7, band8, band8a, band9, band10, band11, band12) ";	
		$query2 .= "VALUES ('".$model_name."','".$nutrisi."',".$b1.",".$b2.",".$b3.",".$b4.",".$b5.",".$b6.",".$b7.",".$b8.",".$b8a.",".$b9.",".$b10.",".$b11.",".$b12.")";
		$sql = pg_query($db_conn, $query2);
	?>
		<script type="text/javascript">
			setTimeout(function () { swal("Yes!","Model <?php echo $model_name; ?> berhasil disimpan","success");});
		</script>		
	<?php
	} else {
	?>
		<script type="text/javascript">
		setTimeout(function () { swal("Oh tidak!","Model <?php echo $model_name ?> sudah tercatat di dalam sistem","error");
		});</script>
	<?php }
?>
