<?php
include "../config.php";

$id = $_POST['id'];

$sql = pg_query($db_conn, "DELETE FROM pkt_area WHERE kode_area='".$id."'");

$dirPath = "../uploads/area/".$id;

if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);

?>