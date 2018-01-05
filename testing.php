<?php
	try {

		// if(!mkdir('./uploads/citra/test',777,True)) 
		// {
		// 	echo "gagal dong";
		// }
		// else echo("Done");
		mkdir('./uploads/citra/test4',0777);
		chmod('./uploads/citra/test4',0777);
		mkdir('./uploads/citra/test4/anaknya',0777);
		chmod('./uploads/citra/test4/anaknya',0777);		
		echo("Coba 8");
	}
	catch (Throwable $t) {
		echo "Oh tidak!|".$t->getMessage()."|error";
	}
?>