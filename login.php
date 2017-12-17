<?php
include('config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | <?php echo $page_title; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	
	<!-- Sweetalert -->
	<link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">
	<script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>
<?php
if(isset($_SESSION['user'])){
	echo '<script language="javascript">document.location="index.php";</script>';
}

if(isset($_POST['login'])){
	$user = $_POST['username'];
	$pass = md5($_POST['password']);
	//untuk menentukan expire cookie, dihtung dri waktu server + waktu umur cookie          
	$time = time();                 
	//cek jika setcookie di cek set cookie jika tidak ''
	$check = isset($_POST['setcookie'])?$_POST['setcookie']:'';
	
	$sql = pg_query($db_conn, "SELECT * FROM pkt_user as a WHERE a.username='".$user."' AND a.login_pass='".$pass."'");
	$row = pg_fetch_array($sql);
	if(pg_num_rows($sql) == 0){
		echo '<script type="text/javascript">';
	  echo 'setTimeout(function () { swal("No!","Username atau password tidak terdaftar!","warning");';
	  echo '});</script>';
		//echo "<script language='javascript'>document.location='login.php';</script>";
	}else{
		$_SESSION['user']=$user;
		echo '<script language="javascript">document.location="index.php";</script>';
		if($check) {        
			setcookie("cookielogin[user]",$user , $time + 3600);        
			setcookie("cookielogin[pass]", $pass, $time + 3600);    
		}
	}
}
?>
<body class="login-page" style="background-image: url('images/background-login.jpg');background-repeat: no-repeat;background-attachment: fixed;background-position: top; ">
    <div class="login-box" style="background:white;opacity:50;">
        <div class="logo" align="center">
            <img src="images/pkt_logo.png" width="340px"/>
			<h3><?php echo $page_title; ?></h3>
        </div>
        <div class="card">
            <div class="body">
                <form action="" method="POST">
                    <div class="msg">Masuk untuk memulai sesi</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="setcookie" id="setcookie" class="filled-in chk-col-pink" checked>
                            <label for="setcookie">Ingat saya</label>
                        </div>
                        <div class="col-xs-4">
                            <input type="submit" class="btn bg-pink btn-block btn-flat" name="login" value="Masuk"></input>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6 align-right">
                            <!--<a href="forgot-password.html">Lupa password?</a>-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>