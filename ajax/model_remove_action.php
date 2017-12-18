<?php
include "../config.php";

$id = $_POST['id'];

$sql = pg_query($db_conn, "DELETE FROM pkt_model WHERE id_model='".$id."'");

?>