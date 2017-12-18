<?php
include "../config.php";

$id = $_POST['id'];

$sql = pg_query($db_conn, "DELETE FROM pkt_pupuk WHERE kode_pupuk='".$id."'");

?>