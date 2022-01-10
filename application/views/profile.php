<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AIS SYSTEM! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>Assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>Assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>Assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>Assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>Assets/build/css/custom.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>Assets/js/jquery.min.js"> </script>
  </head>

  <body class="login">
    <div class="right_col" role="main">
      <div class="page-title">
        <div class="title_left">
          <h3>PEMETAAN UMKM</h3>
        </div>

        <div class="title_right">
          <div class="col-md-2 col-sm-2   form-group pull-right">
            <div class="input-group">
              <a href="<?php echo base_url(); ?>Home/Login">Login</a>
              <!-- <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span> -->
            </div>
          </div>
          <div class="col-md2 col-sm-2   form-group pull-right">
            <div class="input-group">
              <a href="<?php echo base_url(); ?>Home/daftar">Daftar UMKM</a>
              <!-- <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span> -->
            </div>
          </div>
          <div class="col-md-1 col-sm-1   form-group pull-right">
            <div class="input-group">
              <a href="<?php echo base_url(); ?>Home/profil">Profil</a>
              <!-- <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span> -->
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title">
              <h2>PROFIL</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="col-md-6 col-sm-6  ">
                  <div class="profile clearfix">
                    <div class="profile_pic">
                      <img width="70%" style="margin-left: 350px;margin-right: auto;" src="<?php echo base_url() ?>Persiapan/avatar.png">
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6  ">
                  <div class="profile clearfix">
                    <div class="profile_pic">
                      <img width="70%"  src="<?php echo base_url() ?>Persiapan/Logostmik.png">
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12  ">
                  <center>
                    <br><br><br>
                    <h3>ADITYA RESTU SYAH TAMA</h3> <BR>
                    <h2>16.5.00059</h2><br>
                    <h2>TEKNIK INFORMATIKA</h2>
                  </center>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>