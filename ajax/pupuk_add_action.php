<?php
include "../config.php";

$kode_pupuk		= $_POST['kode_pupuk'];
$nama_pupuk 	= $_POST['nama_pupuk'];
$pupuk_n 		= $_POST['pupuk_n'];
$pupuk_p 		= $_POST['pupuk_p'];
$pupuk_k 		= $_POST['pupuk_k'];
$pupuk_mg 		= $_POST['pupuk_mg'];
$mode			= $_POST['mode'];

$query = "SELECT kode_pupuk FROM pkt_pupuk WHERE upper(nama_pupuk)=upper('".$nama_pupuk."')";
if($mode=="edit") $query .= " AND kode_pupuk <> ".$kode_pupuk; 

$sql = pg_query($db_conn, $query);
$data_exist = pg_fetch_array($sql);

if(empty($data_exist))
{
	if($mode=="tambah") {
		$query2 = "INSERT INTO pkt_pupuk (nama_pupuk, komposisi_n, komposisi_p, komposisi_k, komposisi_mg) ";	
		$query2 .= "VALUES ('".$nama_pupuk."',".$pupuk_n.",".$pupuk_p.",".$pupuk_k.",".$pupuk_mg.")";
	}
	else {
		$query2 = "UPDATE pkt_pupuk SET ";	
		$query2 .= "nama_pupuk='".$nama_pupuk."',komposisi_n=".$pupuk_n.",komposisi_p=".$pupuk_n.",komposisi_k=".$pupuk_n.",komposisi_mg=".$pupuk_mg;
		$query2 .= " WHERE kode_pupuk=".$kode_pupuk;
	}
	$sql = pg_query($db_conn, $query2);

	$sql = pg_query($db_conn, $query);	
?>
	<script type="text/javascript">
		setTimeout(function () { 
			swal("Yes!","Data pupuk <?php echo $nama_pupuk; ?> berhasil disimpan","success"); 
			$('#tambah_pupuk').modal('hide'); 
		});
	</script>		
<?php
} else {
?>
	<script type="text/javascript">
	setTimeout(function () { swal("Oh tidak!","Pupuk <?php echo $nama_pupuk ?> sudah tercatat di dalam sistem","error");
	});</script>
<?php } ?>