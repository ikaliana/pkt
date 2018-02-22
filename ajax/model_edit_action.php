<?php
include "../config.php";

$id_model	 	= $_POST['id_model'];
$model_name 	= $_POST['model_name'];
$nutrisi 		= $_POST['nutrisi'];
$constant		= $_POST['constant'];
$bands			= array();

$bands = array('1','2','3','4','5','6','7','8','8a','9','10','11','12');
$required = array('model_name', 'nutrisi', 'constant');
$error1a = false;
$error1 = false;
$error2 = false;

foreach($required as $field) 
  if (!isset($_POST[$field])) { $error1a = true; }

if(!$error1a) {
	foreach($bands as $band) {
	  if (!isset($_POST['b'.$band]) OR !isset($_POST['b'.$band.'_2'])) { $error1 = true; }
	  if (!is_numeric($_POST['b'.$band]) OR !is_numeric($_POST['b'.$band.'_2'])) { $error2 = true; }
	}
}

if($error1 || $error1a){
	?>
		<script type="text/javascript">
		setTimeout(function () { swal("Oh tidak!","<?php echo $error1a."-".$error1; ?> Semua isian harus diisi!","error");
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
	
	$query = "SELECT id_model FROM pkt_model WHERE nama='".$model_name."' and id_model <> ".$id_model;
	$sql = pg_query($db_conn, $query);
	$data_exist = pg_fetch_array($sql);

	if(empty($data_exist))
	{
		$query2 = "UPDATE pkt_model SET nama='".$model_name."',nutrisi='".$nutrisi."',constant=".$constant;
		foreach($bands as $band) {
			$query2 .= ",band".$band."=".$_POST['b'.$band].",band".$band."_2=".$_POST['b'.$band.'_2'];
		}
		$query2 .= " WHERE id_model=".$id_model;
		echo $query2;

		$sql = pg_query($db_conn, $query2);
	?>
		<script type="text/javascript">
			setTimeout(function () { swal("Yes!","Model <?php echo $model_name; ?> berhasil diperbarui","success");});
		</script>		
	<?php
	} else {
	?>
		<script type="text/javascript">
		setTimeout(function () { swal("Oh tidak!","Model <?php echo $model_name ?> sudah tercatat di dalam sistem","error");
		});</script>
	<?php } 
	}
}
?>
