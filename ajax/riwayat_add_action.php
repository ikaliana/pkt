<?php
include "../config.php";

try {
	$id				= $_POST['id'];
	$area			= $_POST['area'];
	$pupuk			= $_POST['pupuk'];
	$tahun			= $_POST['tahun'];
	$dosis			= $_POST['dosis'];

	if(!empty($tahun) && $area <> "" && $pupuk <> ""){
		if(!empty($id)) {
			$query2 = "UPDATE pkt_riwayat SET ";
			$query2 .= "kode_area = ".$area;
			$query2 .= ",kode_pupuk = ".$pupuk;
			$query2 .= ",tahun = ".$tahun;
			$query2 .= ",dosis_pupuk = ".$dosis;
			$query2 .= " WHERE kode_riwayat=".$id;

			$update_data = pg_query($db_conn, $query2);

			echo "Yes!|Data riwayat pupuk berhasil diubah!|success";
		}
		else {
		    $query = "";
		    $query .= "select a.nama as nama_area,p.nama_pupuk,r.tahun,r.dosis_pupuk";
		    $query .= ",r.kode_riwayat,r.kode_area,r.kode_pupuk ";
		    $query .= "from pkt_riwayat r ";
		    $query .= "left join pkt_area a on r.kode_area = a.kode_area ";
		    $query .= "left join pkt_pupuk p on r.kode_pupuk = p.kode_pupuk ";
			$query .= "WHERE r.kode_area=".$area." AND r.kode_pupuk=".$pupuk." AND r.tahun=".$tahun;
			$get_area = pg_query($db_conn, $query);
			$data_exist = pg_fetch_array($get_area);

			if(empty($data_exist)) {
				$query2 = "INSERT INTO pkt_riwayat (kode_area, kode_pupuk, tahun, dosis_pupuk) ";	
				$query2 .= "VALUES ('".$area."',".$pupuk.",".$tahun.",".$dosis.")";

				$insert_data = pg_query($db_conn, $query2);

				echo "Yes!|Riwayat pupuk baru berhasil ditambahkan!|success";
			}
			else {
				echo "Tidak!|Riwayat pemupukan di ".$data_exist[0]." pada tahun ".$data_exist[2]." untuk tahun ".$data_exist[1]." sudah tersedia!|error";
			}
		}
	}else{
		echo "Tidak!|Semua form harus diisi!|error";
	}

}
catch (Throwable $t) {
	echo "Oh tidak!|".$t->getMessage()."|error";
}
catch(Exception $e) {
	echo "Oh tidak!|".$e->getMessage()."|error";
} 
?>