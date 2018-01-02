<?php
include "../config.php";

$kode_pupuk		= $_POST['kode_pupuk'];
$mode			= $_POST['mode'];

$query = "SELECT DISTINCT p.nama_pupuk FROM pkt_rekomendasi r ";
$query .= "LEFT JOIN pkt_pupuk p ON r.kode_pupuk = p.kode_pupuk ";
$query .= "WHERE r.kode_pupuk = ".$kode_pupuk; 
$nama_pupuk = "";

$sql = pg_query($db_conn, $query);
$data_exist = pg_fetch_array($sql);	

if(!empty($data_exist)) $nama_pupuk = $data_exist[0];
if($mode == "edit") $data_exist =  array();

if(empty($data_exist))
{
	if ($mode == "edit") {
		$query2 = "DELETE FROM pkt_rekomendasi WHERE kode_pupuk=".$kode_pupuk;
		$sql = pg_query($db_conn, $query2);
	}

	for($i = 1; $i <= 25; $i++) {
		$angka = "angka_".strval($i);
		$jumlah = $_POST[$angka];
		$query2 = "INSERT INTO pkt_rekomendasi (kode_pupuk, umur_tanaman, jumlah_pupuk) ";	
		$query2 .= "VALUES (".$kode_pupuk.",".$i.",".$jumlah.")";
		$sql = pg_query($db_conn, $query2);
	}

?>
	<script type="text/javascript">
		setTimeout(function () { 
			swal("Yes!","Data rekomendasi pupuk <?php echo $nama_pupuk; ?> berhasil disimpan","success"); 
		});
	</script>		
<?php
} else {
?>
	<script type="text/javascript">
	setTimeout(function () { swal("Oh tidak!","Rekomendasi pupuk <?php echo $nama_pupuk ?> sudah tercatat di dalam sistem","error");
	});</script>
<?php } ?>