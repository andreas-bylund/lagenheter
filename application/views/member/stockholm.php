<div class="row">
  <div class="col-xs-12">
    <div class="card-box product-detail-box">
      <div class="row">
        <div class="col-sm-4">
          <div class="sp-wrap sp-non-touch" style="display: inline-block;">
            <div class="sp-large">
              <img src="<?php echo base_url('images/stader/stockholm.jpg'); ?>" alt="Stockholm">
            </div>
          </div>
        </div>

        <div class="col-sm-8">
          <div class="product-right-info">
            <h1><b>Stockholm</b></h1>

            <h2>
              Just nu endast: <b>249 kr/mån</b><br />
              <small> <strike>Ordinarie pris: 299 kr/mån</strike></small>
            </h2>

            <hr>

            <h5 class="font-600">Beskrivning av tjänsten</h5>

            <p class="text-muted">Dantes remained confused and silent by this
            explanation of the thoughts which had unconsciously been working in
            his mind, or rather soul; for there are two distinct sorts of ideas,
            those that proceed from the head and those from the heart.</p>

            <p class="text-muted">Unconsciously been working in
            his mind, or rather soul; for there are two distinct sorts of ideas,
            those that proceed from the head and those from the heart.</p>

            <div class="m-t-30">

              <form action="<?php echo base_url('dashboard/process_subscription/stockholm'); ?>" method="POST">
                <script
                  src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                  data-key="pk_test_2xdVqkvOlH7mc6zd80M4GpfY"
                  data-image="http://localhost/lagenhet/images/stader/stockholm.jpg"
                  data-name="Stockholm"
                  data-description="Beskrivning på tjänsten."
                  data-locale="sv"
                  data-label="Prenumerera"
                  data-allow-remember-me="false"
                  data-label="Sign Me Up!"
                  data-email="<?php echo $this->session->userdata('mail'); ?>">
                </script>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end row -->
    </div> <!-- end card-box/Product detai box -->

    <div class="row">
      <div class="col-md-6 col-sm-6 col-lg-3">
          <div class="card-box widget-box-1 bg-white">
              <h4 class="text-dark">Antal hyresvärdar</h4>
              <h2 class="text-primary text-center"><span data-plugin="counterup">23</span></h2>
          </div>
      </div>

      <div class="col-md-6 col-sm-6 col-lg-3">
          <div class="card-box widget-box-1 bg-white">
            <h4 class="text-dark">Kontroller per dygn</h4>
            <h2 class="text-pink text-center"><span data-plugin="counterup">1,987,200</span></h2>
          </div>
      </div>

      <div class="col-md-6 col-sm-6 col-lg-3">
          <div class="card-box widget-box-1 bg-white">
              <h4 class="text-dark">Antal lägenheter hittade</h4>
              <h2 class="text-success text-center"><span data-plugin="counterup">304</span></h2>
          </div>
      </div>

      <div class="col-md-6 col-sm-6 col-lg-3">
          <div class="card-box widget-box-1 bg-white">
              <h4 class="text-dark">Bostadskö i Stockholm</h4>
              <h2 class="text-warning text-center"><span data-plugin="counterup">8 år~</span></h2>
          </div>
      </div>
    </div>
  </div> <!-- end col -->
</div>

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
var handler = StripeCheckout.configure({

});

document.getElementById('stripe-demo').addEventListener('click', function(e) {
  handler.open();
  e.preventDefault();
});
</script>
