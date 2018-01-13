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
                    <li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="area_content" OR $_GET['p']=="model_content" OR $_GET['p']=="model_edit" OR $_GET['p']=="citra_content" OR $_GET['p']=="pupuk_content" OR $_GET['p']=="pupuk_edit" OR $_GET['p']=="ppks_content" OR $_GET['p']=="ppks_edit"){echo 'active';}};?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">storage</i>
                            <span>Administrasi Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="area_content"){echo 'active';}};?>">
                                <a href="index.php?p=area_content">Area Lahan</a>
                            </li>
                            <li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="citra_content"){echo 'active';}};?>">
                                <a href="index.php?p=citra_content">Citra Sentinel</a>
                            </li>
							<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="model_content" OR $_GET['p']=="model_edit"){echo 'active';}};?>">
                                <a href="index.php?p=model_content">Model Perhitungan Nutrisi</a>
                            </li>
                            <li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="pupuk_content" OR $_GET['p']=="ppks_content" OR $_GET['p']=="pupuk_edit" OR $_GET['p']=="ppks_edit"){echo 'active';}};?>">
                                <a href="javascript:void(0);" class="menu-toggle">Pupuk</a>
								<ul class="ml-menu">
									<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="pupuk_content" OR $_GET['p']=="pupuk_edit"){echo 'active';}};?>">
										<a href="index.php?p=pupuk_content">
											<span>Pupuk Anorganik</span>
										</a>
									</li>
									<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="ppks_content" OR $_GET['p']=="ppks_edit"){echo 'active';}};?>">
										<a href="index.php?p=ppks_content">
											<span>Rekomendasi PPKS</span>
										</a>
									</li>
								</ul>
							</li>
                        </ul>
                    </li>
					<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="hasil_content" OR $_GET['p']=="hitung_content" OR $_GET['p']=="hasil_content_detail" ){echo 'active';}};?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Rekomendasi Pupuk</span>
                        </a>
                        <ul class="ml-menu">
							<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="hitung_content"){echo 'active';}};?>">
                                <a href="index.php?p=hitung_content">
                                    <span>Perhitungan Baru</span>
                                </a>
                            </li>
                            <li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="hasil_content" OR $_GET['p']=="hasil_content_detail"){echo 'active';}};?>">
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