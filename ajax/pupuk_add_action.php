<?php
include "../config.php";

$nama_pupuk 	= $_POST['nama_pupuk'];
$pupuk_n 		= $_POST['pupuk_n'];
$pupuk_p 		= $_POST['pupuk_p'];
$pupuk_k 		= $_POST['pupuk_k'];

$query = "SELECT kode_pupuk FROM pkt_pupuk WHERE upper(nama_pupuk)=upper('".$nama_pupuk."')";

$sql = pg_query($db_conn, $query);
$data_exist = pg_fetch_array($sql);

if(empty($data_exist))
{
	$query2 = "INSERT INTO pkt_pupuk (nama_pupuk, komposisi_n, komposisi_p, komposisi_k) ";	
	$query2 .= "VALUES ('".$nama_pupuk."',".$pupuk_n.",".$pupuk_p.",".$pupuk_k.")";
	$sql = pg_query($db_conn, $query2);

	$sql = pg_query($db_conn, $query);	
?>
	<script type="text/javascript">
		setTimeout(function () { swal("Yes!","Data pupuk berhasil disimpan","success");});
	</script>		
<?php
} else {
?>
	<script type="text/javascript">
	setTimeout(function () { swal("Oh tidak!","Pupuk <?php echo $nama_pupuk ?> sudah tercatat di dalam sistem","error");
	});</script>
<?php } ?>