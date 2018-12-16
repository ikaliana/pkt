<?php
    $page = $_GET['p'];
    
    $area_group = ($page=="area_content" OR $page=="area_edit");
    $citra_group = ($page=="citra_content");
    $model_group = ($page=="model_content" OR $page=="model_edit" OR $page=="model_add");
    $anorganik_group = ($page=="pupuk_content" OR $page=="pupuk_edit");
    $ppks_group = ($page=="ppks_content" OR $page=="ppks_edit");
    $riwayat_group = ($page=="riwayat_pupuk");
    $pupuk_group = ($anorganik_group OR $ppks_group OR $riwayat_group);
    $admin_group = ($area_group OR $citra_group OR $model_group OR $pupuk_group OR $riwayat_group);

    $new_hitung = ($page=="hitung_content");
    $hasil_hitung = ($page=="hasil_content" OR $page=="hasil_content_detail");
    $rekomendasi_group = ($new_hitung OR $hasil_hitung);
?>

<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</div>
                    <div class="name">Afdeling D</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profil</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">build</i>Pengaturan</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="logout.php"><i class="material-icons">input</i>Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU UTAMA</li>
                    <li class="active" style="display:;">
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="<?php if($admin_group){echo 'active';}?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">storage</i>
                            <span>Administrasi Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?php if($area_group){echo 'active';}?>">
                                <a href="index.php?p=area_content">Area Lahan</a>
                            </li>
                            <li class="<?php if($citra_group){echo 'active';}?>">
                                <a href="index.php?p=citra_content">Citra Sentinel</a>
                            </li>
							<li class="<?php if($model_group){echo 'active';}?>">
                                <a href="index.php?p=model_content">Model Perhitungan Nutrisi</a>
                            </li>
                            <li class="<?php if($pupuk_group){echo 'active';}?>">
                                <a href="javascript:void(0);" class="menu-toggle">Pupuk</a>
								<ul class="ml-menu">
									<li class="<?php if($anorganik_group){echo 'active';}?>">
										<a href="index.php?p=pupuk_content">
											<span>Pupuk Anorganik</span>
										</a>
									</li>
                                    <li class="<?php if($riwayat_group){echo 'active';}?>">
                                        <a href="index.php?p=riwayat_pupuk">
                                            <span>Riwayat Pupuk</span>
                                        </a>
                                    </li>
									<li class="<?php if($ppks_group){echo 'active';}?>">
										<a href="index.php?p=ppks_content">
											<span>Rekomendasi PPKS</span>
										</a>
									</li>
								</ul>
							</li>
                        </ul>
                    </li>
					<li class="<?php if($rekomendasi_group){echo 'active';}?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Rekomendasi Pupuk</span>
                        </a>
                        <ul class="ml-menu">
							<li class="<?php if($new_hitung){echo 'active';}?>">
                                <a href="index.php?p=hitung_content">
                                    <span>Perhitungan Baru</span>
                                </a>
                            </li>
                            <li class="<?php if($hasil_hitung){echo 'active';}?>">
                                <a href="index.php?p=hasil_content">
                                    <span>Hasil Perhitungan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);"><?php echo $copyright; ?></a>
                </div>
                <div class="version">
                    <b>Versi: </b> 1.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>