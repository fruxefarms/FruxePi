<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Edit Crop Activity -->
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
                        <h1 class="card-header-title align-middle">Activity &#187; Edit</h1>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                        
                              <!-- Add New Crop Form -->
                              <?php echo form_open("crop/activity/edit/" . $activity['id']); ?>

                              <h4 class="card-title"><?php echo $activity['activity_type']; ?></h4>

                              <!-- Crop Nickname -->
                              <div class="form-group row">
                                   <div class="col-md-6">
                                          <h5>Activity Notes:</h5>
                                    </div>

                                   <div class="col-md-6">
                                          <!-- <input type="text" class="form-control" name="msg" value="<?php echo $activity['msg']; ?>"> -->
                                          <textarea name="msg" class="form-control" rows="3"><?php echo $activity['msg']; ?></textarea>
                                          <small class="form-text text-muted">Add notes to Crop Activity</small>
                                    </div>
                              </div>

                              <hr>

                              <!-- Save Button -->
                              <div class="form-group row pt-3 pb-3">
                                   <div class="col-md-12">
                                          <button type="submit" class="btn btn-magenta"><i class="fas fa-save pr-1"></i> Save Entry</button>
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

  </body>
  <!-- /Body -->

</html>