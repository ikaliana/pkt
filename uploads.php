<?php
 
if (isset($_FILES['shp']) && !empty($_FILES['shp'])) {
    $no_files = count($_FILES["shp"]['name']);
    for ($i = 0; $i < $no_files; $i++) {
        if ($_FILES["shp"]["error"][$i] > 0) {
            echo "Error: " . $_FILES["shp"]["error"][$i] . "<br>";
        } else {
            if (file_exists('uploads/area/' . $_FILES["shp"]["name"][$i])) {
                echo 'File already exists : uploads/area/' . $_FILES["shp"]["name"][$i];
            } else {
				mkdir('uploads/area/1');
                move_uploaded_file($_FILES["shp"]["tmp_name"][$i], 'uploads/area/1/' . $_FILES["shp"]["name"][$i]);
                echo 'File successfully uploaded : uploads/area/' . $_FILES["shp"]["name"][$i] . ' ';
            }
        }
    }
} else {
    echo 'Please choose at least one file';
}