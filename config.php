<?php 
session_start();
//Koneksi ke Postgre
$db_host="localhost";
$db_port="5432";
$db_name="pkt";
$db_user="postgres";
$db_password="password";
$pg_conn_string="host=".$db_host." port=".$db_port." dbname=".$db_name." user=".$db_user." password=".$db_password;
$db_conn = pg_connect($pg_conn_string);

if(!$db_conn){
	$warningDB = "Koneksi database gagal";
} ELSE {
	$warningDB = NULL;
}

//path bin Postgis
$PostGIS_BIN="C:/Program Files/PostgreSQL/9.1/bin";

$page_title = "Sistem Rekomendasi Pemupukan Kelapa Sawit";
$copyright = "MIT-NRM IPB & PT Pupuk Kaltim";

?>
