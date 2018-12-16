<?php
include "../config.php";

try {
	$id 			= $_POST['id'];
	$citra 			= $_POST['citra'];
	$n_daun 		= $_POST['n_daun'];
	$p_daun 		= $_POST['p_daun'];
	$k_daun 		= $_POST['k_daun'];
	$mg_daun 		= $_POST['mg_daun'];
	$n_tanah 		= $_POST['n_tanah'];
	$p_tanah 		= $_POST['p_tanah'];
	$k_tanah 		= $_POST['k_tanah'];

	$query ="SELECT kode_analisis FROM pkt_analisis WHERE kode_citra=".$citra."";
	$query .= " and kode_model_n=".$n_daun." and kode_model_p=".$p_daun." and kode_model_k=".$k_daun." and kode_model_mg=".$mg_daun;
	// $query .= " and kode_model_n_tanah=".$n_tanah." and kode_model_p_tanah=".$p_tanah." and kode_model_k_tanah=".$k_tanah;
	$query .= " and kode_analisis <> ".$id;
	$sql = pg_query($db_conn, $query);
	$data_exist = pg_fetch_array($sql);

	chdir('../scripts');
	$script_path = getcwd()."/process.py";


	if(empty($data_exist))
	{
		// $query2 = "INSERT INTO pkt_analisis (tanggal_analisis, kode_citra, kode_model_n, kode_model_p, kode_model_k, ";
		// $query2 .= "kode_model_n_tanah, kode_model_p_tanah, kode_model_k_tanah, status) ";
		// $query2 .= "VALUES (now(),".$citra.",".$n_daun.",".$p_daun.",".$k_daun.",".$n_tanah.",".$p_tanah.",".$k_tanah.",FALSE)";
		$query2 = "UPDATE pkt_analisis SET tanggal_analisis=now(),kode_citra=".$citra;
		$query2 .= ",kode_model_n=".$n_daun.",kode_model_n_tanah=".$n_tanah;
		$query2 .= ",kode_model_p=".$p_daun.",kode_model_p_tanah=".$p_tanah;
		$query2 .= ",kode_model_k=".$k_daun.",kode_model_k_tanah=".$k_tanah;
		$query2 .= ",kode_model_mg=".$mg_daun;
		$query2 .= " WHERE kode_analisis=".$id;
		
		$sql = pg_query($db_conn, $query2);

		// $sql = pg_query($db_conn, $query);
		// $kode_analisis = pg_fetch_array($sql);

		$full_cmd = "python ".$script_path." ".$id;

		$last_line = shell_exec($full_cmd);
		?>
{
	"title": "<?php echo "Yes!"; ?>"
	,"text": "<?php echo "Analisis berhasil diinput dan dijalankan dengan sukses."; ?>"
	,"type": "<?php echo "success"; ?>"
	,"ID": "<?php echo $id; ?>"
}
		<?php

	} else {
	?>
{
	"title": "<?php echo "Oh tidak!"; ?>"
	,"text": "<?php echo "Analisis dengan model terpilih sudah terdaftar di database! Harap gunakan kombinasi model yang lain!"; ?>"
	,"type": "<?php echo "error"; ?>"
	,"ID": ""
}
	<?php }
}
catch (Throwable $t) {
?>
{
	"title": "<?php echo "Oh tidak!"; ?>"
	,"text": "<?php echo $t->getMessage(); ?>"
	,"type": "<?php echo "error"; ?>"
	,"ID": ""
}
<?php }
catch(Exception $e) {
?>
{
	"title": "<?php echo "Oh tidak!"; ?>"
	,"text": "<?php echo $e->getMessage(); ?>"
	,"type": "<?php echo "error"; ?>"
	,"ID": ""
}
<?php }?>