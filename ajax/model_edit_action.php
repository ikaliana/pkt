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

$required = array('model_name', 'nutrisi', 'b1', 'b2', 'b3', 'b4', 'b5', 'b6', 'b7', 'b8', 'b8a', 'b9', 'b10', 'b11', 'b12' );
$numeric = array('b1', 'b2', 'b3', 'b4', 'b5', 'b6', 'b7', 'b8', 'b8a', 'b9', 'b10', 'b11', 'b12');
$error1 = false;
$error2 = false;
foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error1 = true;
  }
}
foreach($numeric as $field) {
  if (!is_numeric($_POST[$field])) {
    $error2 = true;
  }
}

if($error1){
	?>
		<script type="text/javascript">
		setTimeout(function () { swal("Oh tidak!","Semua isian harus diisi!","error");
		});</script>
	<?php
}else{
	if($error2){
		?>
		<script type="text/javascript">
		setTimeout(function () { swal("Oh tidak!","Isian band harus dalam angka!","error");
		});</script>
	<?php
	}else{
		$query2 = "UPDATE pkt_model SET (nama, nutrisi, band1, band2, band3, band4, band5, band6, band7, band8, band8a, band9, band10, band11, band12) =";	
		$query2 .= "('".$model_name."','".$nutrisi."',".$b1.",".$b2.",".$b3.",".$b4.",".$b5.",".$b6.",".$b7.",".$b8.",".$b8a.",".$b9.",".$b10.",".$b11.",".$b12.")";
		$sql = pg_query($db_conn, $query2);
	?>
		<script type="text/javascript">
			setTimeout(function () { swal("Yes!","Model <?php echo $model_name; ?> berhasil diperbarui","success");});
		</script>		
	<?php
	}
}
?>