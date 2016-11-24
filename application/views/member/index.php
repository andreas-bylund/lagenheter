<div class="row">
  <div class="col-sm-12">
    <h4 class="page-title" style="padding-bottom: 25px;">Dina prenumerationer</h4>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <div class="card-box">
      <div class="row">
        <div class="col-md-12">

          <?php
          if($subscriptions->data)
          {
            echo '
            <table class="table table-striped m-0">
              <thead>
                <tr>
                  <th>Paket</th>
                  <th>Perioden Startade</th>
                  <th>Perioden slutar</th>
                  <th>Pris</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>';

              foreach ($subscriptions->data as $subscription)
              {
                if($subscription->status == "active")
                {
                  $status = "Aktiv";

                  if($subscription->cancel_at_period_end === TRUE)
                  {
                    $status = "Uppsagd";
                  }
                }


                echo '<tr>';
                echo '<td>' . $subscription->plan->name . '</td>';
                echo '<td>' . gmdate("Y-m-d H:i:s", $subscription->current_period_start) . '</td>';
                echo '<td>' . gmdate("Y-m-d H:i:s", $subscription->current_period_end) . '</td>';
                echo '<td>' . $subscription->plan->amount/100 . ' kr/mån</td>';
                echo '<td>' . $status . '</td>';
                echo '<td><a href="' . base_url('dashboard/subscription/edit/'.$subscription->id.'') . '"><span class="label label-warning">Hantera</span></a>  <a href="' . base_url('dashboard/subscription/delete/'.$subscription->id.'') . '"><span class="label label-danger">Avsluta</span></a></td>';
                echo '</tr>';
              }

              echo '
                </tbody>
              </table>';
            }
            else
            {
              echo '
              <p class="text-center">
                Du har ingen aktiv prenumeration just nu.
              </p>';
            }

           ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <h4 class="page-title">Lägenhetsbevakning</h4>
  </div>
</div>

<div class="row">
  <div class="m-b-15">

    <div class="col-sm-6 col-lg-3 col-md-4 desktops">
      <div class="product-list-box thumb">
        <a href="<?php echo base_url('dashboard/stad/stockholm'); ?>" class="image-popup" title="Screenshot-1">
          <img src="<?php echo base_url('images/stader/stockholm.jpg'); ?>" class="thumb-img" alt="Stockholm">
        </a>

        <div class="detail">
          <h4 class="m-t-0"><a href="" class="text-dark">Stockholm</a></h4>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 col-md-4 desktops">
      <div class="product-list-box thumb">
        <a href="javascript:void(0);" class="image-popup" title="Screenshot-1">
          <img src="<?php echo base_url('images/stader/goteborg.jpg'); ?>" class="thumb-img" alt="work-thumbnail">
        </a>

        <div class="detail">
          <h4 class="m-t-0"><a href="" class="text-dark">Göteborg</a></h4>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 col-md-4 desktops">
      <div class="product-list-box thumb">
        <a href="javascript:void(0);" class="image-popup" title="Screenshot-1">
          <img src="<?php echo base_url('images/stader/malmo.jpg'); ?>" class="thumb-img" alt="work-thumbnail">
        </a>

        <div class="detail">
          <h4 class="m-t-0"><a href="" class="text-dark">Malmö</a></h4>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 col-md-4 desktops">
      <div class="product-list-box thumb">
        <a href="javascript:void(0);" class="image-popup" title="Screenshot-1">
          <img src="<?php echo base_url('images/stader/sundsvall.jpg'); ?>" class="thumb-img" alt="work-thumbnail">
        </a>

        <div class="detail">
          <h4 class="m-t-0"><a href="" class="text-dark">Sundsvall</a></h4>
        </div>
      </div>
    </div>
  </div>
</div>
