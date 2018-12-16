<?php
include "../config.php";

$kode_pupuk	 	= $_POST['kode_pupuk'];
$nama_pupuk 	= $_POST['nama_pupuk'];
$komposisi_n 	= $_POST['komposisi_n'];
$komposisi_p 	= $_POST['komposisi_p'];
$komposisi_k 	= $_POST['komposisi_k'];
$komposisi_mg 	= $_POST['komposisi_mg'];

	$query2 = "UPDATE pkt_pupuk SET (nama_pupuk, komposisi_n, komposisi_p, komposisi_k, komposisi_mg) =";	
	$query2 .= "('".$nama_pupuk."',".$komposisi_n.",".$komposisi_p.",".$komposisi_k.",".$komposisi_mg.") WHERE kode_pupuk=".$kode_pupuk."";
	$sql = pg_query($db_conn, $query2);
?>
	<script type="text/javascript">
		setTimeout(function () { swal("Yes!","Pupuk <?php echo $nama_pupuk; ?> berhasil diperbarui","success");});
	</script>		