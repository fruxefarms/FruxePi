<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Climate Settings -->
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
                                    <h1 class="card-header-title align-middle">Technical &#187; Climate Probe</h1>
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

                        <!-- Configure Sensor Settings -->
                        <h3 class="card-title">Settings</h3>
                        <p class="card-text">Configure Sensor</p>

                        <!-- Set Temperature Format -->
                        <?php echo form_open("technical/climate/edit/format"); ?>
                        <div class="form-group row">
                              <div class="col-md-6">
                                    <h5>Temperature Format</h5>
                              </div>

                              <div class="col-md-6">
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="tempFormat" value="C" <?php echo $temperature_format == "C" ? "checked" : "";?>>
                                          <label class="form-check-label">
                                          Celsius <span class="text-muted">(&#176C)</span>
                                          </label>
                                    </div>
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="tempFormat" value="F" <?php echo $temperature_format == "F" ? "checked" : "";?>>
                                          <label class="form-check-label">
                                          Fahrenheit <span class="text-muted">(&#176F)</span>
                                          </label>
                                    </div>
                                    <small class="form-text text-muted">Set to display temperature in Celsius or Fahrenheit</small>
                              </div>
                        </div>

                        <!-- Save Temperature Format -->
                        <div class="form-group row pb-3">
                              <div class="col-md-12">
                                    <button type="submit" class="btn btn-magenta">Save Format</button>
                              </div>
                        </div>
                        <?php echo form_close();?>

                        <hr>
                        
                        <!-- Set GPIO Pin -->
                        <?php echo form_open("technical/climate/edit/GPIO"); ?>
                        <div class="form-group row pt-3">
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
                              url: '../technical/climate/enable'
                        });
                  } else {
                        $('#sensor-settings').addClass("settings-disabled");  
                        $.ajax({
                              type: 'POST',
                              url: '../technical/climate/disable'
                        });    
                  }
            });

            // Run Diagnostics
            function runDiagnostics() {
                  $('#diagnosticsMsg').load("<?php echo base_url('technical/climate/diagnostics') ?>");
                  $('#diagnosticsMsg').css('visibility','visible');
            }

    </script>

  </body>
  <!-- /Body -->

</html>