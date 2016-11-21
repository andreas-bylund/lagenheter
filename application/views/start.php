
<section class="banner">
  <div id="bannerSlider" class="carousel carousel-fade slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active" style="background-image:url(images/header/stockholm.jpg);">
        <div class="carousel-caption">
          <div class="container">
            <div class="col-md-12">
              <div class="content">
                <h1>Hitta Förstahandskontrakt i Stockholm</h1>
                <h2>Få ett sms/mail när en "först till kvarn" lägenhet blir tillgänglig</h2>
                <div class="btn-orange">
                  <a href="#">Starta här</a>
                </div>

                <div>
                  <p>Mer info</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bluebg" id="signup">
  <div class="container msg">
    <div id="message" style="display:none"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 opt-container">
      <h1>Hitta lägenheter i Stockholm utan kö</h1>
      <h2>För endast <span>249 kr</span> <span style="text-decoration: line-through;">(295 kr)</span> får ni ett sms/mail när en lägenhet utan kö finns tillgänglig. <br><br>Fyll i formuläret nedan för att komma vidare.</h2>

      <form id="contactform" action="<?php echo base_url('register/send'); ?>" method="post">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form">

          <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <input name="name" type="text" id="name" placeholder="Namn">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <input name="mail" type="text" id="mail" placeholder="E-postadress">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <input name="password" type="password" id="password" placeholder="Lösenord">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <div>
              <input class="btn-blue" type="button" value="Bli medlem" id="submit">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!--Features Section-->
<section class="feature-styles" id="features">
  <div class="container feature-container">
    <div class="col-lg-push-6 col-md-6 col-sm-12 col-xs-12 text-center">

      <div class="feature-icon red hidden-xs">
        <i class="fa fa-trello" ></i>
      </div>

      <div class="feature-icon green hidden-xs">
        <i class="fa fa-laptop" ></i>
      </div>

      <img src="images/body/howitwork-img1.png" alt="How it works?">
    </div>

    <div class="col-lg-pull-6 col-md-6 col-sm-12 col-xs-12">
      <h1>Hur fungerar detta?</h1>

      <div class="txt">Det finns flertalet hyresvärdar som erbjuder hyreslägenheter, med förstahandskontrakt, utan något krav av någon kötid. Det vi gör är att vi kontrollerar, flera gånger per minut, om det har publicerats någon ny lägenhet utifrån era specifikationer.   När det publiceras en lägenhet med era specifikationer så skickar vi automatiskt ett mail och ett sms till er.</div>
    </div>
  </div>

  <div class="container feature-container">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
      <div class="feature-icon blue hidden-xs">
        <i class="fa fa-trello" ></i>
      </div>

      <div class="feature-icon orange hidden-xs">
        <i class="fa fa-laptop" ></i>
      </div>
      <img src="images/body/devtime-img.png" alt="Reduce development time">
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <h1>Varför finns denna tjänst?</h1>
      <div class="txt">Enligt XXX så tar det ungefär X antal år för en bostadssökande att få en lägenhet med förstahandskontrakt. Med hjälp av Lägenhetsbevakning.se underlättar arbetet med att hitta en lägenhet i Stockholm. Då våra användare behöver inte manuellt kolla på alla olika hyresvärdar och deras hemsidor om det har kommit ut några nya lägenheter.</div>

      <div class="getstarted">
        <a href="#">Get Started Today! <i class="fa fa-long-arrow-right"></i></a>
      </div>
    </div>
  </div>

  <div class="container feature-container">
    <div class="col-lg-push-6 col-md-6 col-sm-12 col-xs-12 text-center">
      <div class="feature-icon pgreen hidden-xs">
        <i class="fa fa-trello" ></i>
      </div>
      <div class="feature-icon yellow hidden-xs">
        <i class="fa fa-laptop" ></i>
      </div>
      <img src="images/body/alldevices-img.png" alt="Works on all devices">
    </div>

    <div class="col-lg-pull-6 col-md-6 col-sm-12 col-xs-12">
      <h1>Works on all devices</h1>
      <div class="txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit aliquet felis, quis ultrices orci condiment. Suspendisse ut eleifend sem, nec iaculis nulla.</div>
      <div class="getstarted">
        <a href="#">Get Started Today! <i class="fa fa-long-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>
