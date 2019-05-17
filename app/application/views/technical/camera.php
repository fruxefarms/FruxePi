<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Camera Settings -->
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
                                    <h1 class="card-header-title align-middle">Technical &#187; Camera</h1>
                              </div>
                              <div class="col-md-4 text-right">
                                    <span class="pr-2 text-muted">Enable / Disable Camera</span>
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
                        
                        <!-- Manual Camera Control -->
                        <h3 class="card-title">Manual Controls</h3>
                        <div class="form-group row pt-3">
                              <div class="col-md-6">
                                    <button id="capturePhoto" type="button" class="btn btn-magenta">Take Photo</button>
                              </div>

                              <div class="col-md-6">
                                    <img id="photo" src="" class="img-thumbnail">
                              </div>
                        </div>
                        
                        <hr>

                        <!-- Diagnostics -->
                        <h3 class="card-title pt-3 pb-3">Diagnostics</h3>
                        <div class="form-group row">
                              <div class="col-md-6">
                                    <button type="button" class="btn btn-magenta" onclick="runDiagnostics()">Test Camera</button>
                              </div>

                              <div class="col-md-6">
                                    <div id="diagnosticsMsg" class="alert alert-secondary" role="alert"></div>
                              </div>
                        </div>

                        <hr>

                        <!-- Raspi-config camera enable/disable reminder -->
                        <div class="alert alert-warning" role="alert">Don't forget to also enable your camera using <span class="text-monospace">raspi-config</span></div>
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
                              url: '<?php echo base_url("technical/camera/enable"); ?>'
                        });
                  } else {
                        $('#sensor-settings').addClass("settings-disabled");  
                        $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url("technical/camera/disable"); ?>'
                        });    
                  }
            });

            // Take Photo
            $("#capturePhoto").click(function(){
                  $.get("<?php echo base_url('technical/camera/capture') ?>", function(data){
                        var asset_url = '<?php echo asset_url() ?>tmp/';
                        $('#photo').attr('src', asset_url + data);
                        $('#photo').css('visibility','visible'); 
                  });
            });

            // Run Diagnostics
            function runDiagnostics() {
                  $('#diagnosticsMsg').load("<?php echo base_url('technical/camera/diagnostics') ?>");
                  $('#diagnosticsMsg').css('visibility','visible');
            }

    </script>

  </body>
  <!-- /Body -->

</html>