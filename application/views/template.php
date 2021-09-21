<!DOCTYPE html>
<html>
  <head>
    <title>Archive App</title>
    <link rel="icon" type="image/ico" sizes="16x16" href="<?php base_url()?>assets/images/archive.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Bootstrap -->
    <link href="<?php base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="<?php base_url()?>assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php base_url()?>assets/css/jquery.dataTables.min.css">
    <script src="<?php base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?php base_url()?>assets/js/jquery.dataTables.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	    <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><img src="<?=base_url('assets/images/logo-login.png')?>" style="margin-bottom: 7px;"width="35px" height="35px" alt=""><a href="home">&nbsp;<b>A</b>rchive <b>M</b>anagement <b>S</b>ystem</a></h1>
	              </div>
               </div>
               <div class="float-right">
                    <div class="col-md-7">
                        <div class="navbar navbar-inverse" role="banner">
                            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                                <ul class="nav navbar-nav">
                                <li>
                                    <a class="profile-pic" href="#">
                                        <img src="<?php base_url()?>assets/images/user.png" alt="user-img" width="30" style="margin-bottom:5px;"
                                            class="img-circle"><span class="text-white font-medium">&nbsp;<?php echo $this->session->userdata("nama"); ?></span></a>

                                </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
	        </div>
	    </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="<?=base_url('home')?>"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="<?=base_url('dokumen')?>"><i class="glyphicon glyphicon-folder-open"></i> Dokumen</a></li>
                    <li><a href="<?=base_url('memo')?>"><i class="fas fa-file-alt"></i> Memo</a></li>
                    <li><a href="<?=base_url('edaran')?>"><i class="fas fa-envelope"></i> Surat Edaran</a></li>
                    <li><a href="<?=base_url('rabul')?>"><i class="fas fa-file-alt"></i> Rabul</a></li>
                    <li><a id="data-master" href="<?=base_url('data_master')?>"><i class="fa fa-database"></i> Data Master</a></li>
                    <li><a href="<?=base_url('login/logout')?>"><i class="fas fa-sign-out-alt"></i> LogOut</a></li>

                    <!-- <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
                    <li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
                    <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                         </a>
                          Sub menu -->
                         <ul>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
                    </li>
             </div>
		  </div>
      <div class="content">
        <?php
            if (isset($_view) && !empty($_view)) {
                $this->load->view($_view);
            }
        ?>
    </div>
    </div>
    </div>

    <footer class="footer text-center"> 2021 © IT RS PMC </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php base_url()?>assets/js/custom.js"></script>
    <script>
    <?php if($this->session->userdata("level") == "Admin" || $this->session->userdata("level") == "User" ){ ?>

         $(document).ready(function(){

           $("#data-master").remove();

         });
    <?php } ?>
    </script>
  </body>
</html>
