

<div class="row">
  <div class="col-md-6">
    <div class="card-box">
      <h4 class="m-t-0 header-title"><b>Kundtjänst</b></h4>
      <p class="text-muted m-b-30 font-13">Ni kan skapa ett supportärende genom att fylla in rutan här nedan. Vi kommer sedan kontakta er på:<strong> <?php echo $this->session->userdata('mail'); ?></strong>, inom 12 timmar.</p>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <form action="<?php echo base_url('dashboard/support/send'); ?>" class="form" method="post"role="form">
                <?php
                  if(validation_errors())
                  {
                    echo '<div class="alert alert-danger">';
                    echo validation_errors();
                    echo '</div>';
                  }

                  if($this->session->flashdata('success'))
                  {
                    echo '<div class="alert alert-success">';
                    echo $this->session->flashdata('success');
                    echo '</div>';
                  }

                  ?>
                <div class="form-group">
                  <label for="meddelande">Vad kan vi hjälpa dig med?</label>
                  <textarea type="textarea" class="form-control" name="meddelande" id="meddelande" placeholder="Ditt meddelande..."></textarea>
                </div>
                <button type="submit" class="btn btn-default waves-effect waves-light">Skicka ärende</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card-box">
      <h4 class="m-t-0 header-title"><b>Andra supportkanaler</b></h4>
      <a href="https://www.facebook.com/lagenhetsbevakning">
        <button type="button" class="btn btn-facebook waves-effect waves-light">
         <span class="btn-label"><i class="fa fa-facebook"></i></span>Facebook
       </button>
     </a>

     <a href="https://twitter.com/l_bevakning">
       <button type="button" class="btn btn-twitter waves-effect waves-light">
        <span class="btn-label"><i class="fa fa-twitter"></i></span>Twitter
      </button>
    </a>
    </div>
  </div>
</div>
