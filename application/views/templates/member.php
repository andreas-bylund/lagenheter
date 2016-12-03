<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <!-- App Favicon icon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
        <!-- App Title -->
        <title>Ubold - Responsive Admin Dashboard Template</title>

        <!--Morris Chart CSS -->
		    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css'); ?>">
        <!-- Custombox css -->
        <link href="<?php echo base_url('assets/plugins/custombox/css/custombox.css'); ?>" rel="stylesheet">

        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/core.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/menu.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>

    </head>


    <body>
    <!-- Navigation Bar-->
      <header id="topnav">
        <div class="topbar-main">
          <div class="container">
            <!-- Logo container-->
            <div class="logo">
                <a href="<?php echo base_url('dashboard'); ?>" class="logo">Lägenhetsbevakning.se</a>
            </div>
            <!-- End Logo container-->


            <div class="menu-extras">

              <ul class="nav navbar-nav navbar-right pull-right">
                <li class="divider"></li>
                <li><a href="<?php echo base_url('dashboard/sign_out'); ?>"><i class="ti-power-off text-danger m-r-10"></i> Logga ut</a></li>
              </ul>
              <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                  <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                </a>
                <!-- End mobile menu toggle-->
              </div>
            </div>
          </div>
        </div>

        <div class="navbar-custom">
          <div class="container">
            <div id="navigation">
              <!-- Navigation Menu-->
              <ul class="navigation-menu">
                <li class="has-submenu">
                  <a href="<?php echo base_url('dashboard'); ?>"><i class="md md-dashboard"></i>Start</a>
                </li>
                <li class="has-submenu">
                  <a href="<?php echo base_url('dashboard/store'); ?>"><i class="md md-local-grocery-store"></i>Butik</a>
                </li>
                <li class="has-submenu">
                  <a href="<?php echo base_url('dashboard/subscriptions'); ?>"><i class="md md-wallet-membership"></i> Mina prenumerationer</a>
                </li>
                <li class="has-submenu">
                  <a href="<?php echo base_url('dashboard/support'); ?>"><i class="md md-help"></i> Kundtjänst</a>
                </li>
                <li class="has-submenu">
                  <a href="<?php echo base_url('dashboard/settings'); ?>"><i class="md md-settings"></i> Kontoinställningar</a>
                </li>
              </ul>
              <!-- End navigation menu        -->
            </div>
          </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
      </header>
      <!-- End Navigation Bar-->

        <div class="wrapper">
            <div class="container">

              <?php echo $contents ?>

                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                © 2016. All rights reserved.
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/detect.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/fastclick.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.blockUI.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/waves.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/wow.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.nicescroll.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js'); ?>"></script>

        <!-- Modal-Effect -->
        <script src="<?php echo base_url('assets/plugins/custombox/js/custombox.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/custombox/js/legacy.min.js'); ?>"></script>

        <!--Morris Chart-->
    		<script src="<?php echo base_url('assets/plugins/morris/morris.min.js'); ?>"></script>
    		<script src="<?php echo base_url('assets/plugins/raphael/raphael-min.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('assets/pages/jquery.leads.init.js'); ?>"></script>

        <!-- App core js -->
        <script src="<?php echo base_url('assets/js/jquery.core.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.app.js'); ?>"></script>


    </body>
</html>
