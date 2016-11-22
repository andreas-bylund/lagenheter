<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
  <div class=" card-box">
  	<div class="panel-heading">
  		<h3 class="text-center">Aktivera ditt konto</h3>
  	</div>

    <div class="row">
      <?php
        echo $this->session->flashdata('error');
      ?>
    </div>

  	<div class="panel-body">
      <p class="text-center">För att kunna använda Lägenhetsbevakning.se måste ni aktivera kontot. Kontroller er mail, där kommer ni hitta aktiveringslänken.</p>
  	</div>
    <div class="row">
      <div class="col-sm-12">
        <div class="text-center">
          <a href="<?php echo base_url('/'); ?>" class="btn btn-primary" id="singlebutton">Gå tillbaka</a>
        </div>
      </div>
    </div>
  </div>
</div>
