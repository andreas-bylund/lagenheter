

<div class="row">
  <div class="col-md-6">
    <div class="card-box">
      <form class="" action="<?php echo base_url('dashboard/subscription/edit_process'); ?>" method="post">
        <h4><b>Vad söker ni efter?</b></h4>
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

        <h4><b>Hyra</b></h4>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group m-l-10">
              <select class="form-control" id="hyra_min" name="hyra_min">
                <option selected disabled>Hyra från:</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
                <option value="3000">3000</option>
                <option value="4000">4000</option>
                <option value="5000">5000</option>
                <option value="6000">6000</option>
                <option value="7000">7000</option>
                <option value="8000">8000</option>
                <option value="9000">9000</option>
                <option value="10000">10 000</option>
                <option value="11000">11 000</option>
                <option value="12000">12 000</option>
                <option value="13000">13 000</option>
                <option value="14000">14 000</option>
                <option value="15000">15 000</option>
                <option value="16000">16 000</option>
                <option value="17000">17 000</option>
                <option value="18000">18 000</option>
                <option value="19000">19 000</option>
                <option value="20000">20 000</option>
                <option value="25000">25 000</option>
                <option value="30000">30 000</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group m-l-10">
              <select class="form-control" id="hyra_max" name="hyra_max">
                <option selected disabled>Hyra till:</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
                <option value="3000">3000</option>
                <option value="4000">4000</option>
                <option value="5000">5000</option>
                <option value="6000">6000</option>
                <option value="7000">7000</option>
                <option value="8000">8000</option>
                <option value="9000">9000</option>
                <option value="10000">10 000</option>
                <option value="11000">11 000</option>
                <option value="12000">12 000</option>
                <option value="13000">13 000</option>
                <option value="14000">14 000</option>
                <option value="15000">15 000</option>
                <option value="16000">16 000</option>
                <option value="17000">17 000</option>
                <option value="18000">18 000</option>
                <option value="19000">19 000</option>
                <option value="20000">20 000</option>
                <option value="25000">25 000</option>
                <option value="30000">30 000</option>
              </select>
            </div>
          </div>
        </div>

        <h4><b>Rum</b></h4>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group m-l-10">
              <select class="form-control" id="rum_min" name="rum_min">
                <option selected disabled>Min. antal rum:</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group m-l-10">
              <select class="form-control" id="rum_max" name="rum_max">
                <option selected disabled>Max. antal rum:</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
          </div>
        </div>

        <h4><b>Storlek</b><em>(kvm)</em></h4>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group m-l-10">
              <select class="form-control" id="kvm_min" name="kvm_min">
                <option selected disabled>Storlek från:</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
                <option value="60">60</option>
                <option value="70">70</option>
                <option value="80">80</option>
                <option value="90">90</option>
                <option value="100">100</option>
                <option value="120">120</option>
                <option value="140">140</option>
                <option value="160">160</option>
                <option value="180">180</option>
                <option value="200">200</option>
                <option value="250">250</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group m-l-10">
              <select class="form-control" id="kvm_max" name="kvm_max">
                <option selected disabled>Storlek  till:</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
                <option value="60">60</option>
                <option value="70">70</option>
                <option value="80">80</option>
                <option value="90">90</option>
                <option value="100">100</option>
                <option value="120">120</option>
                <option value="140">140</option>
                <option value="160">160</option>
                <option value="180">180</option>
                <option value="200">200</option>
                <option value="250">250</option>
              </select>
            </div>
          </div>
        </div>
        <input type="hidden" name="stripe_sub_id" value="<?php echo $stripe_sub_id; ?>">
        <button type="submit" class="btn btn-default waves-effect waves-light" name="button">Uppdatera inställningarna</button>
      </form>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card-box">
      <h4 class="m-t-0 header-title"><b>Prenumeration - Vad söker du efter?</b></h4>
      <p class="text-muted m-b-30 font-14">
        Här kan du specificera exakt vad du letar efter. Varje gång vi hittar en lägenhet som
        passar era preferenser kommer vi kontakta er på det sätt ni har bestämt.
      </p>

      <h4><b>Just nu får du notiser när:</b></h4>
      <p class="text-muted m-b-30 font-14">Vi hittar en lägenhet som : <br /></p>
        <div style="padding-left: 10px;">

          <?php
            echo '- Kostar mellan ' . $current_settings->min_hyra . ' - ' . $current_settings->max_hyra . ' kronor';
            echo '<br>';
            echo '- Har mellan ' . $current_settings->min_rum . ' - ' . $current_settings->max_rum . ' rum';
            echo '<br>';
            echo '- Storlek mellan ' . $current_settings->min_kvm . ' - ' . $current_settings->max_kvm . ' kvm';
            echo '<br>';

            if($current_settings->enbart_snabben == "0")
            {
              echo '- som kräver <strong>bostadskö</strong> och de utan <strong>utan bostadskö</strong> <em>("Först till kvarn")</em>';
            }
            else if($current_settings->enbart_snabben == "1")
            {
              echo '- <strong>inte kräver bostadskö</strong>  <em>("Först till kvarn")</em>';
            }
          ?>
        </div>
    </div>
  </div>
</div>
