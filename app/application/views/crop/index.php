<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Crop Index -->
  <body>

    <!-- Page Sidebar Nav -->
    <?php $this->load->view('core/nav'); ?>

    <!-- Page Content -->
    <div id="main">
        <!-- Page Header -->
        <?php $this->load->view('core/page_header'); ?>

        <!-- Page Sections -->
        <section class="pt-5">
            <h1 class="pb-3"><?php echo sizeof($crops) > 1 ? "Crops" : "Crop"; ?>
            <a class="btn btn-activity float-right" href="<?php echo base_url("crop/new"); ?>" role="button"><i class="fas fa-plus pr-1"></i> Add Crop</a>
            </h1>

            <?php if (empty($crops)): ?>
              <h3 class="text-muted">No Crops To Display</h3>
            <?php else: ?>

              <?php foreach($crops as $crop): ?>
              <div class="shadow-sm card crop-item mb-3">
                <div class="row">
                  
                  <!-- Crop Image -->
                  <div class="col-2">
                    <div class="card-img-bottom-default crop-item-img" style="background: url(../<?php echo $crop['crop_thumbnail']; ?>) center no-repeat;">
                    </div>
                  </div>

                  <!-- Crop Info -->
                  <div class="col-6 pt-4">
                    <div class="card-block pl-3 pr-4">
                      <h4 class="card-title font-size-30"><a href="<?php echo base_url("crop/edit/" . $crop['cropID']); ?>"><?php echo $crop['nickname']; ?></a></h4>
                      <h5 class="font-size-16 fruxe-grey"><i class="fas fa-leaf pr-3"></i><?php echo $crop['plant_type']; ?> <i class="fas fa-calendar-alt pl-3 pr-3" aria-hidden="true"></i> Day <?php echo $crop['growdays_complete']; ?> / <?php echo $crop['total_growdays']; ?> <span class="font-weight-light text-muted">(<?php echo $crop['crop_progress']; ?>%)</span></h5>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated fruxe-green-bg" role="progressbar" aria-valuenow="<?php echo $crop['crop_progress']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $crop['crop_progress']; ?>%"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Crop Activity -->
                  <div class="col-4 border-left crop-details-panel">
                    <div class="card-block pl-3 pt-4 pr-3">
                      
                      <div class="row">
                        
                        <div class="col-6 font-size-14">
                          <h5 class="card-title text-uppercase">Crop Details</h5>
                        </div>

                        <div class="col-6 ">
                          <!-- Actions Dropdown -->
                          <div class="btn-group float-right">
                            <button type="button" class="btn dropdown-toggle fruxe-grey" style="background-color:transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i> </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <h6 class="dropdown-header">Modify Crop</h6>
                              <a class="dropdown-item" href="<?php echo base_url("crop/edit/" . $crop['cropID']); ?>"><i class="fas fa-edit pr-1"></i> Edit Crop</a>
                              <a class="dropdown-item" href="<?php echo base_url("crop/delete/" . $crop['cropID']); ?>"><i class="fas fa-trash-alt pr-1"></i> Delete Crop</a>
                            </div>
                          </div>
                        </div>
                        
                      </div>

                      <div class="row">

                        <div class="col-12 font-size-14">
                          <span><strong>Plants: </strong><?php echo $crop['plant_qty']; ?></span><br>
                          <span><strong>Start Date: </strong><?php echo date('d M Y', strtotime($crop['crop_start'])) ?></span><br>
                          <span><strong>End Date: </strong><?php echo date('d M Y', strtotime($crop['crop_end'])) ?></span>
                        </div>

                      </div>
                        

                    </div>
                  </div>

                </div>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
        </section>
        
    </div>

    <!-- Site Footer -->
    <?php $this->load->view('core/footer'); ?>

  </body>
  <!-- /Body -->

</html>