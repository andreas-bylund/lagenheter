<h1>Bli medlem</h1>

<?php

echo $this->session->flashdata('error');

echo validation_errors();

echo form_open('register/send');

$name = array(
  'name'  =>  'name',
  'value' =>  set_value('name')
);

echo form_label('Namn: ', 'name');
echo form_input($name);

$mail = array(
  'name'  =>  'mail',
  'value' =>  set_value('mail')
);

echo form_label('Mailadress:', 'mail');
echo form_input($mail);

$number = array(
  'name'  =>  'number',
  'value' =>  set_value('number')
);

echo form_label('Mobilnummer: ', 'number');
echo form_input($number);

echo form_label('Lösenord: ', 'password');
echo form_password('password');

echo form_submit('submit', 'Bli medlem');

echo form_close();
?>


<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="container-alt">
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1">
      <div class="wrapper-page signup-signin-page">
        <div class="card-box">
          <div class="panel-heading">
            <h3 class="text-center"> Bli medlem</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="p-20">
                  <h4><b>Sign Up</b></h4>
                  <form class="form-horizontal m-t-20" action="index.html">
                    <div class="form-group ">
                      <div class="col-xs-12">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Ditt namn">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input class="form-control" type="text" id="mail" name="mail" placeholder="Din mailadress">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input class="form-control" type="text" id="number" name="number" placeholder="Ditt mobilnummer">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                          <input id="checkbox-signup" type="checkbox" checked="checked">
                          <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group text-right m-t-20 m-b-0">
                      <div class="col-xs-12">
                        <button class="btn btn-pink text-uppercase waves-effect waves-light w-sm" type="submit">
                        Sign Up
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-6">
                <img height="800px" src="https://s-media-cache-ak0.pinimg.com/736x/d2/08/6f/d2086fee762b25f6ba720a1e68c475a0.jpg">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
