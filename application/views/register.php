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
                    <label for="checkbox-signup">Genom att klicka på "Registrera dig" accepterar ni även Lägenhetsbevakning.se's <a href="#" data-toggle="modal" data-target="#villkor">användarvillkor</a>.</label>
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


<!-- Modal -->
<div id="villkor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lägenhetsvillkor.se - Användarvillkor</h4>
      </div>
      <div class="modal-body">
        <p>Lägenhetsbevakning.se är en tjänst som automatiskt kontrollerar hyresvärdars hemsidor efter ”först till kvarn” lägenheter. När Lägenhetsbevakning.se finner en lägenhet som passar användarens specifikationer meddelar Lägenhetsbevakning.se detta genom SMS och e-postadress till de uppgifter som användaren har angivit. Detta innebär att Lägenhetsbevakning.se inte tillhandahåller några egna lägenheter eller kan påverka att en viss användare kan få en lägenhet före någon annan. Detta betyder också att användandet av Lägenhetsbevakning.se inte garanterar en lägenhet.</p>
				<p>
					<ol>
						<li>Användaren måste vara en myndig privatperson för att kunna använda Lägenhetsbevakning.se.</li>
						<li>Tjänsten aktiveras automatiskt när användaren har betalat in medlemsavgiften.</li>
						<li>Vid användning av Lägenhetsbevakning.se godkänner även användaren att Lägenhetsbevakning.se sparar de personuppgifter och övriga uppgifter som användaren anger vid registrering. Uppgifterna kommer sparas tills användaren aktivt avregistrerar sig genom att kontakta Lägenhetsbevakning.se genom </li>
						<li>De uppgifter som Lägenhetsbevakning.se sparar kommer inte säljas eller delas till tredje part.</li>
						<li>Användaren ansvarar själv för att anmäla intresse på respektive lägenhet användaren får tips om från Lägenhetsbevakning.se. Denna anmälan ska ske direkt till hyresvärden och inte till Lägenhetsbevakning.se.</li>
						<li>Information som skickas till användaren via SMS och e-post är endast avsedd till användaren och dess hushåll. Om användaren delar med sig av information utanför hushållet kommer detta resultera i att användaren kommer stängas av.</li>
						<li>Lägenhetsbevakning.se hämtar och förmedlar informationen direkt till användaren och är därmed inte ansvariga för felaktigheter i den information som skickats vidare. </li>
						<li>Lägenhetsbevakning.se uppdateras och anpassas löpande. Därför kan Lägenhetsbevakning.se inte lämna några garantier över vilka hyresvärdar som övervakas och när dessa övervakas. </li>
						<li>Lägenhetsbevakning.se kan inte hållas ansvariga om en tredjepartsleverantörs hemsida blir oanvändbar. Lägenhetsbevakning.se kan inte heller hållas ansvariga på grund av strömavbrott eller andra typer av naturkatastrofer som gör att tredjepartsleverantören inte kan nås.</li>
						<li>1Om användaren upplever att tjänsten inte fungerat tillfredsställande under en begränsad period kan användaren få kompensation genom ett förlängt medlemskap med motsvarande tidsperiod om Lägenhetsbevakning.se anser det är skäligt enligt användaravtalet.</li>
						<li>1Detta användarvillkor kan kommas uppdateras. Befintliga användare kommer då informeras om detta genom ett mail till den angivna e-postadressen som användaren angav vid registreringen. Befintliga användare kommer bli bundna av det nya avtalet 30 dagar efter notisen har skickats ut till användaren.</li>
						<li>1Enligt Distans- och hemförsäljningslagen (2005:59) har konsumenter rätt att ångra medlemskapet inom 14 dagar. Användaren har dock inte ångerrätt om tjänsten har påbörjats med användarens samtycke. Användaren lämnar och accepterar sitt samtycke i samband när betalning sker vilket gör att tjänsten automatiskt aktiveras och Lägenhetsbevakning.se börjar söka efter objekt som ska skickas vidare till användaren.</li>
						<li>Svensk lag skall gälla avseende användarvillkoren och eventuella tvister ska lösas i svensk domstol. </li>
					</ol>
			</p>
			<p><em>Datum: 2017-02-01</em></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
      </div>
    </div>

  </div>
</div>
