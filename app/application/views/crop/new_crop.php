<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - New Crop -->
  <body>

    <!-- Page Sidebar Nav -->
    <?php $this->load->view('core/nav'); ?>

    <!-- Page Content -->
    <div id="main">
      <!-- Page Header -->
      <?php $this->load->view('core/page_header'); ?>

      <!-- Page Sections -->
      <section class="pt-3 pb-5">
            <div class="card">
                  <!-- Card Header -->
                  <div class="card-header">
                        <h1 class="card-header-title align-middle">Crop &#187; New</h1>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                        
                              <!-- Add New Crop Form -->
                              <?php echo form_open("crop/new"); ?>

                              <!-- Validation Errors -->
                              <?php if (validation_errors()): ?>
                              <div class="alert alert-danger" role="alert">
                                    <?php echo validation_errors(); ?>
                              </div>
                              <?php endif; ?>

                              <h4 class="card-title">Crop Details</h4>

                              <!-- Crop Nickname -->
                              <div class="form-group row">
                                   <div class="col-md-6">
                                          <h5>Crop Nickname</h5>
                                    </div>

                                   <div class="col-md-6">
                                          <input type="text" class="form-control" name="nickname" placeholder="Nickname">
                                          <small class="form-text text-muted">Give your crop a nickname.</small>
                                    </div>
                              </div>

                               <!-- Crop Thumbnail -->
                               <div class="form-group row pb-3">
                                    <div class="col-md-6">
                                          <h5>Thumbnail</h5>
                                    </div>

                                    <div class="col-md-6">
                                          <div class="row">
                                                <div class="col-12">
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="img_thumb" value="C">
                                                            <label class="form-check-label">
                                                            Use Camera
                                                            </label>
                                                      </div>
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="img_thumb" value="F">
                                                            <label class="form-check-label">
                                                            Upload Image
                                                            </label>
                                                      </div>
                                                      <small class="form-text text-muted">Give your crop a profile pic.</small>
                                                </div>
                                                
                                          </div>
                                          <div class="row pt-3">
                                                <div class="col-12">
                                                      <input type="file" id="crop_thumbnail" name="crop_thumbnail" class="form-control-file">
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              

                              <!-- Plant Type -->
                              <div class="form-group row pb-3">
                                   <div class="col-md-6">
                                          <h5>Plant Type</h5>
                                    </div>

                                   <div class="col-md-6">
                                    <input type="text" id="plant_type" name="plant_type" class="form-control">
                                    </div>
                              </div>

                              <!-- Plant Qty -->
                              <div class="form-group row pb-3">
                                   <div class="col-md-6">
                                          <h5>Plant Quantity</h5>
                                    </div>

                                   <div class="col-md-6">
                                    <input type="text" id="plant_qty" name="plant_qty" class="form-control">
                                    </div>
                              </div>

                              <hr>

                              <h4 class="card-title pt-3 pb-3">Crop Schedule</h4>

                              <!-- Crop Start -->
                              <div class="form-group row">
                                   <div class="col-md-6">
                                          <h5>Crop Start</h5>
                                    </div>

                                   <div class="col-md-6">
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="text" id="cropStart" class="form-control" name="crop_start" data-plugin="datepicker">
                                          </div>
                                    </div>
                              </div>

                              <!-- Crop End -->
                              <div class="form-group row">
                                   <div class="col-md-6">
                                          <h5>Crop End</h5>
                                    </div>

                                   <div class="col-md-6">
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="text" id="cropEnd" class="form-control" name="crop_end" data-plugin="datepicker">
                                          </div>
                                    </div>
                              </div>

                              <hr>

                              <!-- Save Button -->
                              <div class="form-group row pt-3 pb-3">
                                   <div class="col-md-12">
                                    <button type="submit" class="btn btn-magenta"><i class="fas fa-save pr-1"></i> Save Crop</button>
                                   </div>
                              </div>

                              <?php echo form_close();?>
  
                  </div>
                  <!-- Card Footer -->
                  <div class="card-footer text-muted">
                        
                  </div>
            </div>
      </section>
        
    </div>

    <!-- Site Footer -->
    <?php $this->load->view('core/footer'); ?>

    <!-- Page Plugins -->
    <script src="<?php echo asset_url(); ?>js/jquery-asSpinner.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
 

    <!-- Page Scripts -->
    <script>
        $('#cropStart').datepicker();
        $('#cropEnd').datepicker();  
    </script>

  </body>
  <!-- /Body -->

</html>