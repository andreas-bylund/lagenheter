<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
<div class=" card-box">
	<div class="panel-heading">
		<h3 class="text-center">Lösenordsåterställning</h3>
	</div>

	<div class="panel-body">
		<form method="post" action="<?php echo base_url('reset_password/send'); ?>" role="form" class="text-center">

      <p>Ange din mailadress som du använde när du registrerade dig. Vi skickar ett e-postmeddelande med ditt användarnamn och en länk där du kan återställa ditt lösenord.</p>
      <?php
        echo $this->session->flashdata('error');
        echo $this->session->flashdata('message');
        echo validation_errors();
      ?>
			<div class="form-group">
				<div class="input-group col-xs-12">
					<input type="email" name="mail" id="mail" class="form-control" placeholder="E-postadress">
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-danger w-sm waves-effect waves-light">
							Skicka
						</button>
					</span>
				</div>
			</div>
		</form>
	</div>
</div>
