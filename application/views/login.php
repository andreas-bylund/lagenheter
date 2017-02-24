<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
	<div class=" card-box">
    <div class="panel-heading">
      <h1 class="text-center"> Logga in</h1>
    </div>

    <div class="panel-body">
      <?php echo $this->session->flashdata('error'); ?>
      <?php echo validation_errors(); ?>
      <form class="form-horizontal m-t-20" method="post" action="<?php echo base_url('login/send'); ?>">
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="mail" id="mail" placeholder="E-postadress">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="password" id="password" type="password" placeholder="Ditt lösenord">
          </div>
        </div>

        <div class="form-group text-center m-t-40">
          <div class="col-xs-12">
            <button class="btn btn-danger btn-block text-uppercase waves-effect waves-light" type="submit">Logga in</button>
          </div>
        </div>

        <div class="form-group m-t-30 m-b-0">
          <div class="col-sm-12">
            <a href="<?php echo base_url('reset_password');?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> Glömt ditt lösenord?</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
  	<div class="col-sm-12 text-center">
  		<p>Har ni inget konto? <a href="<?php echo base_url('register'); ?>" class="text-primary m-l-5"><b>Bli medlem</b></a></p>
    </div>
  </div>
</div>
