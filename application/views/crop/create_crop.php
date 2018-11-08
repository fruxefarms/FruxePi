<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Create Crop -->
  <body>

    <!-- Page Sidebar Nav -->
    <?php $this->load->view('core/nav'); ?>

    <!-- Page Content -->
    <div id="main">
        <!-- Page Header -->
        <?php $this->load->view('core/page_header'); ?>

        <!-- Page Sections -->
        <section class="climate pt-5">
        <?php echo form_open("pages/cropSetup");?>

          <div class="form-group form-material">
            <h4>Crop Nickname</h4>
            <input type="text" class="form-control input-lg" id="name" name="name" placeholder="Enter a name" />
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <h5>Start Date</h5>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="icon md-calendar" aria-hidden="true"></i>
                </span>
                <input type="text" id="cropStart" class="form-control" name="cropStart" data-plugin="datepicker">
              </div>
            </div>
            <div class="col-sm-6">
              <h5>Grow Room</h5>
              <div class="input-group">
                <select data-plugin="selectpicker" name="grow_room">
                  <option value="1">Grow Room 1</option>
                  <option value="2">Grow Room 2</option>
                </select>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group row">
            <div class="col-sm-12">
              <h4>Plants + Strains</h4>
            </div>
            <div class="col-sm-6">
              <h5># Plants</h5>
              <input type="text" id="total_plants" name="total_plants" class="form-control" data-plugin="asSpinner" value="0" />
            </div>
            <div class="col-sm-6">

            </div>
          </div>

          <hr>

          <div class="form-group row">
            <div class="col-sm-12">
              <h4>Crop Schedule <small>(Weeks)</small></h4>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
            <ul class="blocks-3">
              <li>
                <div class="example-col">
                  <h5>Seed \ Clone</h5>
                  <input type="text" name="seedWeeks" class="form-control cropScheduleDropdown" data-plugin="asSpinner" value="2" />
                </div>
              </li>
              <li>
                <div class="example-col">
                  <h5>Vegetative</h5>
                  <input type="text" name="vegWeeks" class="form-control cropScheduleDropdown" data-plugin="asSpinner" value="2" />
                </div>
              </li>
              <li>
                <div class="example-col">
                  <h5>Flowering</h5>
                  <input type="text" name="flowerWeeks" class="form-control cropScheduleDropdown" data-plugin="asSpinner" value="7" />
                </div>
              </li>
            </ul>
          </div>
          </div>

          <div class="form-group form-material">
            <button name="submit" type="submit" class="btn btn-magenta">Create Crop</button>
          </div>

          <?php echo form_close(); ?>
        </section>
        
    </div>

    <!-- Site Footer -->
    <?php $this->load->view('core/footer'); ?>

    <!-- Page Scripts -->
    <?php $this->load->view('crop/crop_scripts'); ?>

  </body>
  <!-- /Body -->

</html>