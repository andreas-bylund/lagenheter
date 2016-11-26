<div class="row">
  <div class="col-md-6">
    <div class="card-box">
      <h4 class="m-t-0 header-title"><b>Inställningar</b></h4>
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
      <p class="text-muted m-b-30 font-13">
        Här kan du specificera exakt vad du letar efter. Varje gång vi hittar en lägenhet som
        passar era preferenser kommer vi kontakta er på det sätt ni har bestämt.
      </p>

      <form class="" action="<?php echo base_url('dashboard/settings/send'); ?>" method="post">
        <h4><b>Ditt namn</b></h4>
        <div class="row">
          <div class="col-md-6">
            <?php
              if(!empty(form_error('name')))
              {
                echo '<div class="alert alert-danger">';
                echo form_error('name');
                echo '</div>';
              }
            ?>
            <div class="form-group m-l-10">
              <input type="text" id="name" name="name" class="form-control" value="<?php echo $userdata->name; ?>">
            </div>
          </div>
        </div>

        <h4><b>E-postadress:</b></h4>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group m-l-10">
              <?php
                if(!empty(form_error('mail')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('mail');
                  echo '</div>';
                }
              ?>
              <input type="text" id="mail" name="mail" class="form-control" value="<?php echo $userdata->mail; ?>">
            </div>
          </div>
        </div>

        <h4><b>Mobilnummer:</b></h4>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group m-l-10">
              <?php
                if(!empty(form_error('cellphone')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('cellphone');
                  echo '</div>';
                }
              ?>
              <input type="text" id="cellphone" name="cellphone" class="form-control" value="<?php echo $userdata->cellphone; ?>">
            </div>
          </div>
        </div>
        <hr>

        <h4><b>Ändra lösenord:</b></h4>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group row m-l-10">
              <?php
                if(!empty(form_error('password')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('password');
                  echo '</div>';
                }

                if(!empty(form_error('password_two')))
                {
                  echo '<div class="alert alert-danger">';
                  echo form_error('password_two');
                  echo '</div>';
                }
              ?>
              <div class="form-inline">
                <input type="password" name="password" class="form-control" id="password" placeholder="Ange nytt lösenord">

                <input type="password" name="password_two" class="form-control" id="password_two" placeholder="Upprepa nya lösenordet">
              </div>

            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-default waves-effect waves-light" name="button">Uppdatera inställningarna</button>
      </form>
    </div>
  </div>
</div>
