<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Moisture Settings -->
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
                        <div class="row">
                              <div class="col-md-8">
                                    <h1 class="card-header-title align-middle">Technical &#187; Moisture Probe</h1>
                              </div>
                              <div class="col-md-4 text-right">
                                    <span class="pr-2 text-muted">Enable / Disable Probe</span>
                                    <!-- Toggle Switch -->
                                    <label class="switch align-middle" style="margin-top: 5px;">
                                          <?php if($activation_state == 0): ?>
                                                <input id="sensor-toggle" type="checkbox">
                                          <?php else: ?>
                                                <input id="sensor-toggle" type="checkbox" checked>
                                          <?php endif; ?>
                                          <span class="slider round"></span>
                                    </label>
                              </div>
                        </div>
                  </div>
                  <!-- Card Body -->
                  <div id="sensor-settings" class="card-body">

                              <h3 class="card-title">Settings</h3>
                              <p class="card-text">Configure Sensor</p>
                              
                              <!-- Set GPIO Pin -->
                              <?php echo form_open("technical/moisture/edit/GPIO"); ?>
                              <div class="form-group row">
                                   <div class="col-md-6">
                                          <h5>GPIO Pin</h5>
                                    </div>

                                   <div class="col-md-6">
                                          <?php if (!empty($GPIO)): ?>
                                                <input type="text" name="GPIO" class="form-control" value="<?php echo $GPIO; ?>">
                                          <?php else: ?>
                                                <input type="text" name="GPIO" class="form-control" placeholder="GPIO">
                                          <?php endif; ?>
                                          <small class="form-text text-muted">Please enter the BCM (Broadcom Pin Number) GPIO value.</small>
                                    </div>
                              </div>

                              <!-- Save GPIO Pin -->
                              <div class="form-group row pb-3">
                                   <div class="col-md-12">
                                          <button type="submit" class="btn btn-magenta">Save Settings</button>
                                   </div>
                              </div>
                              <?php echo form_close();?>
                        
                        <hr>
                        
                        <!-- Diagnostics -->
                        <h3 class="card-title pt-3 pb-3">Diagnostics</h3>
                        <div class="form-group row">
                              <div class="col-md-6">
                                    <button type="button" class="btn btn-magenta" onclick="runDiagnostics()">Test Sensor</button>
                              </div>

                              <div class="col-md-6">
                                    <div id="diagnosticsMsg" class="alert alert-secondary" role="alert"></div>
                              </div>
                        </div>
                  </div>
                  <!-- Card Footer -->
                  <div class="card-footer text-muted"></div>
            </div>
      </section>
        
    </div>

    <!-- Site Footer -->
    <?php $this->load->view('core/footer'); ?>

    <!-- Page Scripts -->
    <script>
            // Set Sensor Toggle on Load
            $(document).ready(function(){
                  if (<?php echo $activation_state; ?> == 0) {
                        $('#sensor-toggle').prop('checked', false);
                        $('#sensor-settings').addClass("settings-disabled");
                  }
            });

            // Toggle Sensor Function
            $('#sensor-toggle').change(function() {
                  if(this.checked) {
                        $('#sensor-settings').removeClass("settings-disabled");
                        $.ajax({
                              type: 'POST',
                              url: '../technical/moisture/enable'
                        });
                  } else {
                        $('#sensor-settings').addClass("settings-disabled");  
                        $.ajax({
                              type: 'POST',
                              url: '../technical/moisture/disable'
                        });    
                  }
            });

            // Run Diagnostics
            function runDiagnostics() {
                  $('#diagnosticsMsg').load("<?php echo base_url('technical/moisture/diagnostics') ?>");
                  $('#diagnosticsMsg').css('visibility','visible');
            }

    </script>

  </body>
  <!-- /Body -->

</html>