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
                        <?php $cropFormAttr = array('id' => 'crop_form'); ?>
                        <?php echo form_open("crop/new", $cropFormAttr); ?>

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

                        <!-- Image Thumbnail -->
                        <input type="hidden" id="crop_thumbnail" name="crop_thumbnail" value="assets/img/camera_bg.jpg">

                        <?php echo form_close();?>

                        <hr>

                        <!-- Crop Thumbnail -->
                        <h4 class="card-title">Thumbnail</h4>

                        <div class="form-group row pb-3">
                              <div class="col-md-6">
                                    <h5>Image Source</h5>
                              </div>

                              <div class="col-md-6">
                                    <div class="row">
                                          <div class="col-12">
                                                <div class="form-check">
                                                      <input class="form-check-input" type="radio" id="cameraRadio" name="img_thumb" value="img/crop_bg.jpg">
                                                      <label class="form-check-label">
                                                      Use Camera
                                                      </label>
                                                </div>
                                                <div class="form-check">
                                                      <input class="form-check-input" type="radio" id="uploadRadio" name="img_thumb" value="">
                                                      <label class="form-check-label">
                                                      Upload Image
                                                      </label>
                                                </div>
                                                <small class="form-text text-muted">Give your crop a profile pic, otherwise the default will be displayed.</small>
                                          </div>
                                    </div>
                                    <div class="row pt-3">
                                          <!-- Upload Image  -->
                                          <?php $attributes = array('id' => 'crop_image'); ?>
                                          <?php echo form_open("media/upload_image", $attributes); ?>
                                                <div id="img-container" class="col-12 px-3 pb-3"></div>
                                                <div id="uploadForm" class="col-12">
                                                      <input type="file" id="image_upload" name="image_upload" class="form-control-file">
                                                      <button id="upload_button" type="submit" class="btn btn-magenta mt-3">Upload</button>
                                                </div>
                                          <?php echo form_close();?>
                                    </div>
                              </div>
                        </div>

                        <hr>

                        <!-- Save Crop Button -->
                        <div class="form-group row pt-3 pb-3">
                              <div class="col-md-12">
                              <button type="button" class="btn btn-magenta" onclick="saveCrop()"><i class="fas fa-save pr-1"></i> Save Crop</button>
                              </div>
                        </div>
  
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

      function saveCrop(){
            $('#crop_form').submit();
      }

      $(document).ready(function(){

            // Set Crop Thumbnail to Camera
            $('#cameraRadio').click(function(){
                  $("#crop_thumbnail").val('assets/img/crop_bg.jpg');
            });
            

            // Toggle Photo Upload
            $('input[type=radio][name=img_thumb]').change(function(){
                  var radioValue = $(this).val(); 
                  
                  if (radioValue == 'img/crop_bg.jpg') {
                        $('#uploadForm').css('visibility','hidden');
                  } else {
                        $('#uploadForm').css('visibility','visible');
                  }
            });

            // Upload Photo
            $("#upload_button").click(function(){

                  $('#crop_image').submit(function(event) {

                        event.preventDefault();
                        var formData = new FormData($('#crop_image')[0]);

                        var image_file = $("#image_upload")[0].files[0]; 

                        $.ajax({
                              type: "POST",
                              url: "<?php echo base_url('media/upload_image'); ?>",
                              data: formData,
                              processData: false,
                              contentType: false,
                              success: function(data) {
                                    var imgSrc = 'assets/tmp/' + image_file.name;
                                    var imgTag = '<img class="img-fluid img-thumbnail" src="../' + imgSrc + '"/>';
                                    $("#crop_thumbnail").val(imgSrc);
                                    $('#img-container').css('visibility','visible');
                                    $('#img-container').prepend(imgTag);
                                    console.log("Uploaded!");
                              },
                              error: function() { 
                                    alert("Error uploading"); 
                              }
                        });

                  });
            });

      });
  
    </script>

  </body>
  <!-- /Body -->

</html>