<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
	<div class=" card-box">
    <div class="panel-heading">
      <h1 class="text-center">Bli medlem</h1>
    </div>
    <div class="panel-body">
      <div class="row">
        <?php
          if($this->session->flashdata('error'))
          {
            echo '<div class="alert alert-danger">';
            echo $this->session->flashdata('error');
            echo '</div>';
          }
        ?>

        <div class="col-lg-12">
          <div>
            <form method="post" class="form-horizontal m-t-20" action="<?php echo base_url('register/send'); ?>">
              <div class="form-group ">
                <div class="col-xs-12">
                  <?php
                    if(!empty(form_error('name')))
                    {
                      echo '<div class="alert alert-danger">';
                      echo form_error('name');
                      echo '</div>';
                    }
                  ?>
                  <input class="form-control" type="text" name="name" id="name" placeholder="Namn" value="<?php echo set_value('name'); ?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <?php
                    if(!empty(form_error('mail')))
                    {
                      echo '<div class="alert alert-danger">';
                      echo form_error('mail');
                      echo '</div>';
                    }
                  ?>
                  <input class="form-control" value="<?php echo set_value('mail'); ?>" type="text" id="mail" name="mail" placeholder="E-postadress">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <?php
                    if(!empty(form_error('number')))
                    {
                      echo '<div class="alert alert-danger">';
                      echo form_error('number');
                      echo '</div>';
                    }
                  ?>
                  <input class="form-control" type="text" id="number" name="number" placeholder="Mobilnummer" value="<?php echo set_value('number'); ?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <?php
                    if(!empty(form_error('password')))
                    {
                      echo '<div class="alert alert-danger">';
                      echo form_error('password');
                      echo '</div>';
                    }
                  ?>

                  <input class="form-control" type="password" id="password" name="password" placeholder="Lösenord">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <p class="text-muted m-b-30 font-12">
                    <label for="checkbox-signup">Genom att klicka på Registrera dig accepterar du Lägenhetsbevakning.se's <a href="#">villkor</a> och <a href="#">sekretesspolicy</a></label>
                  </p>
                </div>
              </div>
              <div class="form-group text-right m-t-20 m-b-0">
                <div class="col-xs-12">
                  <button class="btn btn-danger text-uppercase waves-effect waves-light w-sm" type="submit">
                  Registrera dig
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
