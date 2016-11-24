

<div class="row">
  <div class="col-sm-12">
    <div class="card-box">
      <div class="row">
        <div class="col-md-12">
          <h4 class="page-title" style="padding-bottom: 20px;">Kontoinställningar</h4>
          <?php
            if($this->session->flashdata('success'))
            {
              echo '<div class="alert alert-success">';
              echo $this->session->flashdata('success');
              echo '</div>';
            }
          ?>
          <?php
            if($this->session->flashdata('error'))
            {
              echo '<div class="alert alert-danger">';
              echo $this->session->flashdata('error');
              echo '</div>';
            }
          ?>
          <form class="form-horizontal" method="post" action="<?php echo base_url('dashboard/settings/send'); ?>" role="form">
            <div class="form-group">
              <?php
                if(!empty(form_error('name')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('name');
                  echo '</div>';
                }

              ?>
              <label class="col-md-2 control-label">Ditt namn:</label>
              <div class="col-md-10">
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $userdata->name; ?>">
              </div>
            </div>
            <div class="form-group">
              <?php
                if(!empty(form_error('mail')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('mail');
                  echo '</div>';
                }
              ?>
              <label class="col-md-2 control-label" for="example-email">E-postadress: </label>
              <div class="col-md-10">
                <input type="text" id="mail" name="mail" class="form-control" value="<?php echo $userdata->mail; ?>">
              </div>
            </div>

            <div class="form-group">
              <?php
                if(!empty(form_error('cellphone')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('cellphone');
                  echo '</div>';
                }
              ?>
              <label class="col-md-2 control-label" for="cellphone">Mobilnummer: </label>
              <div class="col-md-10">
                <input type="text" id="cellphone" name="cellphone" class="form-control" value="<?php echo $userdata->cellphone; ?>">
              </div>
            </div>

            <hr>
            <h4 class="page-title" style="padding-bottom: 20px;">Ändra lösenord</h4>
            <div class="form-group">
              <?php
                if(!empty(form_error('password')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('password');
                  echo '</div>';
                }
              ?>
              <label class="col-md-2 control-label">Lösenord:</label>
              <div class="col-md-10">
                <input type="password" name="password" class="form-control" id="password" value="[hemligtlosenord]">
              </div>
            </div>

            <div class="form-group">
              <?php
                if(!empty(form_error('password_two')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('password_two');
                  echo '</div>';
                }
              ?>
              <label class="col-md-2 control-label">Lösenordet igen:</label>
              <div class="col-md-10">
                <input type="password" name="password_two" class="form-control" id="password_two" value="[hemligtlosenord]">
              </div>
            </div>
            <button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
							Uppdatera inställningarna
						</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
