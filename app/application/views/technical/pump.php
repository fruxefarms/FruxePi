<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Pump Settings -->
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
                                    <h1 class="card-header-title align-middle">Technical &#187; Pump</h1>
                              </div>
                              <div class="col-md-4 text-right">
                                    <span class="pr-2 text-muted">Enable / Disable Pump</span>
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
                        

                        <h3 class="card-title">Manual Controls</h3>
                              <div class="form-group row pt-3">
                                   <div class="col-md-6">
                                          <h5>OFF / ON</h5>
                                    </div>

                                   <div class="col-md-6">
                                          <!-- ON/OFF Switch -->
                                          <label class="switch">
                                                <?php if($pump_status == 0): ?>
                                                      <input id="pump-toggle" type="checkbox">
                                                <?php else: ?>
                                                      <input id="pump-toggle" type="checkbox" checked>
                                                <?php endif; ?>
                                                <span class="slider round"></span>
                                          </label>
                                    </div>
                              </div>
                              <hr>
                              <h3 class="card-title">Scheduling</h3>
                              <?php echo form_open("technical/pump/edit/schedule"); ?>
                              <div class="form-group row">
                                    <div class="col-sm-6 pt-3">
                                          <h5>Pump ON</h5>
                                          <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="pumpON" name="pump_ON" data-plugin="timepicker" value="<?php echo $pump_schedule[0]->pump_ON; ?>">
                                          </div>
                                          <small class="form-text text-muted">Pump will run each day at the prescribed time.</small>
                                    </div>
                                    <div class="col-sm-6 pt-3">
                                          <h5>Run Duration <small class="text-muted">minutes</small></h5>
                                          <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="pumpDuration" name="pump_duration" value="<?php echo $pump_schedule[0]->pump_duration; ?>">
                                          </div>
                                          <small class="form-text text-muted">Pump will run for <?php echo $pump_schedule[0]->pump_duration != "" ? $pump_schedule[0]->pump_duration : " this many " ?> minutes.</small>
                                    </div>
                              </div>

                              <!-- Save Schedule -->
                              <div class="form-group row pb-3">
                                   <div class="col-md-12">
                                          <button type="submit" class="btn btn-magenta">Save Schedule</button>
                                   </div>
                              </div>
                              <?php echo form_close();?>
                              
                              <hr>

                              <!-- Configure Relay -->
                              <h3 class="card-title">Settings</h3>
                              <p class="card-text">Configure Relay</p>
                              
                              <!-- Set GPIO Pin -->
                              <?php echo form_open("technical/pump/edit/settings"); ?>
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

                              <!-- Set Relay type -->
                              <div class="form-group row">
                                    <div class="col-md-6">
                                          <h5>Relay Type</h5>
                                    </div>

                                    <div class="col-md-6">
                                          <div class="form-check">
                                                <input class="form-check-input" type="radio" name="relayType" value="high" <?php echo $relay_type == "high" ? "checked" : "";?>>
                                                <label class="form-check-label">
                                                Active High
                                                </label>
                                          </div>
                                          <div class="form-check">
                                                <input class="form-check-input" type="radio" name="relayType" value="" <?php echo $relay_type == "" ? "checked" : "";?>>
                                                <label class="form-check-label">
                                                Active Low <span class="text-muted">(Default)</span>
                                                </label>
                                          </div>
                                    </div>
                              </div>

                              <!-- Save Settings Button -->
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
                                    <button type="button" class="btn btn-magenta" onclick="runDiagnostics()">Test Relay</button>
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

    <!-- Page Plugins -->
    <script src="<?php echo asset_url(); ?>js/jquery.timepicker.min.js"></script> 

    <!-- Page Scripts -->
    <script>
            // Timepicker Input
            $('#pumpON').timepicker({ show2400: true, timeFormat: 'G:i'});
            $('#pumpDurdation').timepicker({ show2400: true, timeFormat: 'G:i'});

            $(document).ready(function() {
                  // Set sensor toggle on load
                  if (<?php echo $activation_state; ?> == 0) {
                        $('#sensor-toggle').prop('checked', false);
                        $('#sensor-settings').addClass("settings-disabled");
                  }

                  // Set lights toggle on load
                  if (<?php echo $pump_status; ?> == 0) {
                        $('#pump-toggle').prop('checked', false);
                  }
            });

            // Toggle Sensor Function
            $('#sensor-toggle').change(function() {
                  if(this.checked) {
                        $('#sensor-settings').removeClass("settings-disabled");
                        $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url("technical/pump/enable"); ?>'
                        });
                  } else {
                        $('#sensor-settings').addClass("settings-disabled");  
                        $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url("technical/pump/disable"); ?>'
                        });    
                  }
            });

            // Toggle pump function
            $('#pump-toggle').change(function() {
                  if(this.checked) {
                        $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url("technical/pump/ON"); ?>'
                        });
                  } else {
                        $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url("technical/pump/OFF"); ?>'
                        });    
                  }
            });

            // Run Diagnostics
            function runDiagnostics() {
                  $('#diagnosticsMsg').load("<?php echo base_url('technical/pump/diagnostics') ?>");
                  $('#diagnosticsMsg').css('visibility','visible');
            }

    </script>

  </body>
  <!-- /Body -->

</html>