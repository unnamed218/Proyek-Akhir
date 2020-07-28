<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Meta, title, CSS, favicons, etc. -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="<?php echo base_url();?>assets/images/brandlogo.jpg" type="image/ico" />
      <?php 
       date_default_timezone_set('Asia/Jakarta');
      ?>
      <title>KPSBU</title>
      <!-- <title>Test</title> -->
      <!-- Bootstrap --> 
      <link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <!-- NProgress -->
      <link href="<?php echo base_url();?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
      <!-- iCheck -->
      <link href="<?php echo base_url();?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
      <!-- bootstrap-progressbar -->
      <link href="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
      <!-- JQVMap -->
      <link href="<?php echo base_url();?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
      <!-- bootstrap-daterangepicker -->
      <!-- <link href="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> -->
      <!-- Custom Theme Style -->
      <link href="<?php echo base_url();?>assets/build/css/custom.min.css" rel="stylesheet">
      <!-- Datatables -->
      <link href="<?php echo base_url();?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Ion.RangeSlider -->
    <link href="<?php echo base_url();?>assets/vendors/normalize-css/normalize.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <!-- Bootstrap Colorpicker -->
    <link href="<?php echo base_url();?>assets/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/vendors/cropper/dist/cropper.min.css" rel="stylesheet">
   </head>
   <body class="nav-md" >
      <div class="container body" style="position: relative;">
         <div class="main_container">
            <div class="col-md-3 left_col">
               <div class="left_col scroll-view">
                  <div class="navbar nav_title" style="border: 0;">
                     <!-- <a href="#" class="site_title" style="padding-top: 10px"><center> KPSBU </center></a> -->
                     <a href="#" class="site_title" ><img style="margin-top: 20px; height: 35px; width: 150px; margin-left: 25px" src="<?php echo base_url();?>assets/images/brandlogo.jpg" class="profile_pic"><span></span></a>
                  </div>
                  <div class="clearfix"></div>
                  <!-- menu profile quick info -->
                  <div class="profile clearfix">
                     <div class="profile_pic">
                        <img src="<?php echo base_url();?>assets/images/sapi.png" alt="..." class="img-circle profile_img">
                     </div>
                     <div class="profile_info">
                        <span>Welcome,</span>
                        <h2><?php echo $this->session->userdata('nama_lengkap');?></h2>
                     </div>
                  </div>
                  <!-- /menu profile quick info -->
                  <br />
                  <!-- sidebar menu -->
                  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                     <div class="menu_section">
                        <h3>List Menu</h3>
                        <ul class="nav side-menu">
                           <li><a href="<?php echo site_url();?>c_masterdata/beranda"><i class="fa fa-home"></i> Home </a>
                           </li>
                        </ul>
                       <?php 
                           if($this->session->userdata('level')=="admin" OR $this->session->userdata('level')=="produksi1" OR $this->session->userdata('level')=="produksi2" OR $this->session->userdata('level')=="penjualan" OR $this->session->userdata('level')=="keuangan3" OR $this->session->userdata('level')=="keuangan1" OR $this->session->userdata('level')=="keuangan2"):
                            ?>
                        <ul class="nav side-menu">
                           <li>
                              <a><i class="fa fa-table"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <?php
                                    if( $this->session->userdata('level')=="admin"):
                                     ?>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_coa">COA</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_bb">Bahan Baku</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_bp">Bahan Penolong</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_bdp">Produk Dalam Proses</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_peternak">Peternak</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_supp_bp">Supplier Bahan Penolong</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_produk">Produk</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_jbop">Jenis BOP</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_bom">BOM</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_bop">BOP</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_bopo">BOP</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_btk">BTKL</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_btko">BTKL</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_ips">Konsumen IPS</a></li>
                                  
                                
                                 <?php 
                                    elseif( $this->session->userdata('level')=="produksi1"):
                                     ?>
                                      <li><a href="<?php echo site_url();?>c_masterdata/lihat_bb">Bahan Baku</a></li>
                                       <li><a href="<?php echo site_url();?>c_masterdata/lihat_peternak">Peternak</a></li>
                                  <li><a href="<?php echo site_url();?>c_masterdata/lihat_bom">BOM</a></li>
                                  <li><a href="<?php echo site_url();?>c_masterdata/lihat_jbop">Jenis BOP</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_bop">BOP</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_btk">BTKL</a></li>
                                 <?php 
                                    elseif( $this->session->userdata('level')=="produksi2"):
                                     ?>
                                  <li><a href="<?php echo site_url();?>c_masterdata/lihat_bp">Bahan Penolong</a></li>
                                  <li><a href="<?php echo site_url();?>c_masterdata/lihat_supp_bp">Supplier Bahan Penolong</a></li>
                                  <li><a href="<?php echo site_url();?>c_masterdata/lihat_bdp">Produk Dalam Proses</a></li>
                                  <li><a href="<?php echo site_url();?>c_masterdata/lihat_bom">BOM</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_bopo">BOP</a></li>
                                 <li><a href="<?php echo site_url();?>c_masterdata/lihat_btko">BTKL</a></li>
                                  <?php
                                    elseif( $this->session->userdata('level')=="penjualan"):
                                     ?>
                                       <li><a href="<?php echo site_url();?>c_masterdata/lihat_produk">Produk</a></li>
                                      <li><a href="<?php echo site_url();?>c_masterdata/lihat_ips">Konsumen IPS</a></li>
                                       <?php
                                    elseif( $this->session->userdata('level')=="keuangan3"):
                                     ?>
                                       <li><a href="<?php echo site_url();?>c_masterdata/lihat_coa">COA</a></li>
                                        <?php
                                    elseif( $this->session->userdata('level')=="keuangan1"):
                                     ?>
                                       <li><a href="<?php echo site_url();?>c_masterdata/lihat_coa">COA</a></li>
                                        <?php
                                    elseif( $this->session->userdata('level')=="keuangan2"):
                                     ?>
                                       <li><a href="<?php echo site_url();?>c_masterdata/lihat_coa">COA</a></li>
                                 <?php 

                                    endif
                                    ?>
                              </ul>
                           </li>
                        </ul>
                        <?php
                           endif
                           ?>
                        <?php 
                           if(!empty($this->session->userdata('level'))):
                             ?>
                        <?php 
                           if($this->session->userdata('level')=="admin" OR $this->session->userdata('level')=="produksi1" OR $this->session->userdata('level')=="produksi2" OR $this->session->userdata('level')=="penjualan"):
                            ?>
                        <ul class="nav side-menu">
                           <li>
                           
                              <a><i class="fa fa-edit"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <?php
                                    if( $this->session->userdata('level')=="admin"):
                                     ?>

                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pemb">Pembelian Bahan Baku</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_ck">Cek Kualitas</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_produksi_ke1">Produksi ke IPS</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pembagian">Pembagian</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pembp">Pembelian Bahan Penolong</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_tp">Target Produksi</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_produksi_ke2">Produksi Olahan</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_penjs">Penjualan IPS</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_penjt">Penjualan Toko</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pemby">Pembayaran Beban Tetap</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pembyv">Pembayaran Beban Variabel</a></li>
                                   <?php
                                    elseif( $this->session->userdata('level')=="produksi1"):
                                     ?>
                                     
                                  <li><a href="<?php echo site_url();?>c_transaksi/lihat_pemb">Pembelian Bahan Baku</a></li>
                                      <li><a href="<?php echo site_url();?>c_transaksi/lihat_ck">Cek Kualitas</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_produksi_ke1">Produksi ke IPS</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pembagian">Pembagian</a></li>
                              
                                 <?php
                                    elseif( $this->session->userdata('level')=="produksi2"):
                                     ?>
                                     
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pembp">Pembelian Bahan Penolong</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_tp">Target Produksi</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_produksi_ke2">Produksi Olahan</a></li>
                                    
                                      <?php
                                    elseif( $this->session->userdata('level')=="penjualan"):
                                     ?>
                                      <li><a href="<?php echo site_url();?>c_transaksi/lihat_penjs">Penjualan IPS</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_penjt">Penjualan Toko</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pemby">Pembayaran Beban Tetap</a></li>
                                 <li><a href="<?php echo site_url();?>c_transaksi/lihat_pembyv">Pembayaran Beban Variabel</a></li>
                                 <?php 
                                    endif 
                                    ?>
                              </ul>
                           </li>
                        </ul>
                         <?php 
                                    endif 
                                    ?>
                        <?php 
                           endif 
                           ?>
                        <?php 
                           if(!empty($this->session->userdata('level'))):
                             ?>
                        <?php 
                            if($this->session->userdata('level')=="admin" OR $this->session->userdata('level')=="produksi1" OR $this->session->userdata('level')=="produksi2" OR $this->session->userdata('level')=="penjualan" OR $this->session->userdata('level')=="keuangan1" OR $this->session->userdata('level')=="keuangan2" OR $this->session->userdata('level')=="keuangan3"):
                            ?>
                        <ul class="nav side-menu">
                           <li> 
                          

                              <a><i class="fa fa-bar-chart-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                  <?php 
                           if( $this->session->userdata('level')=="keuangan" OR $this->session->userdata('level')=="admin"):
                            ?>
                                  <li><a href="<?php echo site_url();?>c_keuangan/view_jurnal">Jurnal</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/view_bukubesar">Buku Besar</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_pemb">Laporan Pembelian Bahan Baku</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_pembp">Laporan Pembelian Bahan Penolong</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_pemby">Laporan Pembayaran Beban</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_penjs">Laporan Penjualan IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_penjt">Laporan Penjualan Toko</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_bp_ips">Laporan Harga Pokok Produksi IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_bp_olahan">Laporan Harga Pokok Produksi Olahan</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/hpp_ips">Laporan Harga Pokok Penjualan IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/hpp_toko">Laporan Harga Pokok Penjualan Toko</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_bb">Kartu Persediaan Bahan Baku</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_bp">Kartu Persediaan Bahan Penolong</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_prod1">Kartu Persediaan Produk IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_prod">Kartu Persediaan Produk Toko</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lr1">Laporan Laba Rugi</a></li>
                                     <?php
                                    elseif( $this->session->userdata('level')=="produksi1"):
                                     ?>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_bb">Kartu Persediaan Bahan Baku</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_bp_ips">Laporan Harga Pokok Produksi IPS</a></li>
                                    
                                      <?php
                                    elseif( $this->session->userdata('level')=="produksi2"):
                                     ?>
                                     <!-- <li><a href="<?php echo site_url();?>c_keuangan/lap_pembp">Laporan Pembelian Bahan Penolong</a></li> -->
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_bp">Kartu Persediaan Bahan Penolong</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_bp_olahan">Laporan Harga Pokok Produksi Olahan</a></li>
                                    
                                     <?php
                                    elseif( $this->session->userdata('level')=="penjualan"):
                                     ?>
                                      <li><a href="<?php echo site_url();?>c_keuangan/lap_penjs">Laporan Penjualan IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_penjt">Laporan Penjualan Toko</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_pemby">Laporan Pembayaran Beban</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_prod1">Kartu Persediaan Produk IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_prod">Kartu Persediaan Produk Toko</a></li>
                                      <?php
                                    elseif( $this->session->userdata('level')=="keuangan3"):
                                     ?>
                                     <li><a href="<?php echo site_url();?>c_keuangan/view_jurnal">Jurnal</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/view_bukubesar">Buku Besar</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_penjs">Laporan Penjualan IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_penjt">Laporan Penjualan Toko</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_pemby">Laporan Pembayaran Beban</a></li>
                                     
                                    <li><a href="<?php echo site_url();?>c_keuangan/hpp_ips">Laporan Harga Pokok Penjualan IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/hpp_toko">Laporan Harga Pokok Penjualan Toko</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_prod1">Kartu Persediaan Produk IPS</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_prod">Kartu Persediaan Produk Toko</a></li>
                                      <li><a href="<?php echo site_url();?>c_keuangan/lr1">Laporan Laba Rugi</a></li>
                                    
                                   <?php
                                    elseif( $this->session->userdata('level')=="keuangan1"):
                                     ?>
                                     <li><a href="<?php echo site_url();?>c_keuangan/view_jurnal">Jurnal</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/view_bukubesar">Buku Besar</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_pemb">Laporan Pembelian Bahan Baku</a></li>
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_bp_ips">Laporan Harga Pokok Produksi IPS</a></li>
                                   
                                   <?php
                                    elseif( $this->session->userdata('level')=="keuangan2"):
                                     ?>
                                     <li><a href="<?php echo site_url();?>c_keuangan/view_jurnal">Jurnal</a></li>
                                    <li><a href="<?php echo site_url();?>c_keuangan/view_bukubesar">Buku Besar</a></li>
                                    <!-- <li><a href="<?php echo site_url();?>c_keuangan/lap_ks_bp">Kartu Persediaan Bahan Penolong</a></li> -->
                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_pembp">Laporan Pembelian Bahan Penolong</a></li>
                                    

                                     <li><a href="<?php echo site_url();?>c_keuangan/lap_bp_olahan">Laporan Harga Pokok Produksi Olahan</a></li>
                                    <?php
                                   endif
                                   ?>
                              </ul>
                           </li>
                        </ul>
                         <?php 
                                    endif 
                                      ?>
                        <?php 
                           endif
                           ?>
                     </div>
                  </div>
                  <!-- /sidebar menu -->
                  <!-- /menu footer buttons -->
                  <!-- /menu footer buttons -->
               </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
               <div class="nav_menu">
                  <nav>
                     <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                     </div>
                     <ul class="nav navbar-nav navbar-right">
                        <li class="">
                           <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                           <img src="<?php echo base_url();?>assets/images/sapi.png" alt=""><?php echo $this->session->userdata('nama_lengkap');?>
                           <span class=" fa fa-angle-down"></span>
                           </a>
                           <ul class="dropdown-menu dropdown-usermenu pull-right">
                              <!--  <li><a href="javascript:;"> Profile</a></li>
                                 <li>
                                   <a href="javascript:;">
                                     <span class="badge bg-red pull-right">50%</span>
                                     <span>Settings</span>
                                   </a>
                                 </li>
                                 <li><a href="javascript:;">Help</a></li>
                                 -->
                              <li><a href="<?php echo site_url();?>c_login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                           </ul>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
            <br /><br>
            <div class="right_col" role="main">
               <br>
               <?php echo $contents?>
            </div>
         </div>
      </div>
      <!-- /page content -->
      <!--  <footer>
         <div class="pull-right">
          © 6703164107 - Zulfikri Fahrudin
         </div>
         <div class="clearfix"></div>
         </footer> -->
      </div>
      </div>
      <!-- jQuery -->
      <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="<?php echo base_url();?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url();?>assets/vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="<?php echo base_url();?>assets/vendors/nprogress/nprogress.js"></script>
      <!-- iCheck -->
      <script src="<?php echo base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
      <!-- Chart.js -->
      <script src="<?php echo base_url();?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="<?php echo base_url();?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- Skycons -->
      <script src="<?php echo base_url();?>assets/vendors/skycons/skycons.js"></script>
      <!-- Flot -->
      <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.pie.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.time.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.stack.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="<?php echo base_url();?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="<?php echo base_url();?>assets/vendors/DateJS/build/date.js"></script>
      <!-- JQVMap -->
      <script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="<?php echo base_url();?>assets/vendors/moment/min/moment.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-datetimepicker -->    
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
      <!-- Datatables -->
      <script src="<?php echo base_url();?>assets/vendors/datatables-net/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/jszip/dist/jszip.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
      <script src="<?php echo base_url();?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="<?php echo base_url();?>assets/build/js/custom.min.js"></script>

   </body>
   <script>
      $(document).ready(function(){
             setTimeout(function(){
               $('#myModal').modal('show');
             }, 500);
           });
         // angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
         setTimeout(function(){
           $('#myModal').modal('hide');
         }, 10000);
      //$('#myModal').modal('show');
   </script>
   
<script>
//   var someDate = new Date();
// var numberOfDaysToAdd = 6;
// someDate.setDate(someDate.getDate() + numberOfDaysToAdd); 



   var date = new Date();
    var selectedDate;
    // var tambahtgl = 2;
     // date.setDate(date.getDate() + tambahtgl);
    $('#myDatepicker2').datetimepicker({
      minDate: date,
        format: 'YYYY-MM-DD'
    });
 </script>

  <script src="jquery.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#tester').keyup(function () {
          // setiap karakter yang diketik akan langsung dihapus   
          this.value = this.value.replace(/[^1-9.]/g, '');
        });
      });
    </script>
</html>