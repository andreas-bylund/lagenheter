<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
<div class=" card-box">
	<div class="panel-heading">
		<h3 class="text-center">Lösenordsåterställning</h3>
	</div>

	<div class="panel-body">
		<form method="post" action="<?php echo base_url('reset_password/send'); ?>" role="form" class="text-center">

      <p>Ange din <b>mailadress</b> som du använde när du registrerade dig. Vi skickar ett e-postmeddelande med ditt användarnamn och en länk där du kan återställa ditt lösenord.</p>
      <?php
        echo $this->session->flashdata('error');
        echo $this->session->flashdata('message');
        echo validation_errors();
      ?>
			<div class="form-group m-b-0">
				<div class="input-group">
					<input type="email" name="mail" id="mail" class="form-control" placeholder="E-postadress" required="">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
							Skicka
						</button>
					</span>
          <p>Om ni fortfarande behöver hjälp...</p>
				</div>
			</div>
		</form>
	</div>
</div>
