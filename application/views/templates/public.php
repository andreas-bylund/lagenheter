
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Förstahandskontrakt i Stockholm - Lägenhetsbevakning.se</title>
  <!-- Bootstrap -->
  <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <!--Custom CSS-->
  <link href="<?php echo base_url('css/main.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('css/flexslider.css'); ?>" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo base_url('css/font-awesome.css'); ?>" type="text/css" media="screen" />
  <!--Google Font-->
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<!--Header Section-->
<div id="home" class="top">
  <div class="container">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 logo">
      <img src="images/header/logo_new.png" alt=".Square">
    </div>

    <!--Navigation-->
    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 pull-right ">
      <div class="nav">
        <ul class="navi">
          <li><a href="<?php echo base_url('login'); ?>">Logga in</a></li>
          <li><a href="<?php echo base_url('register'); ?>">Bli medlem</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php echo $contents ?>

<!-- Footer Section-->
<section id="footer">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer">
    <div class="footer-nav text-center">
      <ul class="navi">
        <li><a href="#home">Home</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div>
    <div class="social-icons text-center">
      <ul>
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
      </ul>
    </div>

    <div class="copyright">Copyright © 2014 dotSquare. All rights reserved.</div>
  </div>
</section>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('js/custom.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.easing.1.3.js'); ?>"></script>
<script defer src="<?php echo base_url('js/jquery.flexslider-min.js'); ?>"></script>

</body>
</html>
