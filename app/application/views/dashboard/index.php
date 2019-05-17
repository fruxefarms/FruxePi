<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Dashboard Index -->
  <body class="body-index">

    <!-- Page Sidebar Nav -->
    <?php $this->load->view('core/nav'); ?>

    <!-- Page Content -->
    <!-- If Camera is active load latest image as background -->
    <?php if ($sensor_state['camera_state'] == "1"): ?>
    <div id="main" class="camera-bg">
    <?php else: ?>
    <div id="main" class="default-bg">
    <?php endif; ?>

        <!-- Page Header -->
        <section id="header" class="header media">
            <div class="pull-left h-logo">
                <h1 onclick="openNav()" style="cursor:pointer;">
                    <img src="<?php echo asset_url(); ?>img/logo-wordmark-sm-rev.svg">
                </h1>   
            </div>
        </section>

        <!-- Page Section -->
        <section class="climate pt-5 text-center">

            <?php if ($sensor_state['climate_state'] == 1): ?>
            <div class="row">
              <div class="col-lg-6 col-6 font-size-50 mb-5 white text-center">
                <!-- Temperature: Convert Celsius or Fahrenheit -->
                <?php if ($temperature_format == "F"): ?>
                  <?php echo round(celsiusToFahrenheit($grow_data['temperature']), 0); ?>&#176;
                  <span class="font-size-30">F</span>
                <?php else: ?>
                  <?php echo $grow_data['temperature']; ?>&#176;
                  <span class="font-size-30">C</span>
                <?php endif; ?>
              </div>
              <div class="col-lg-6 col-6 font-size-50 mb-5 white text-center">
                <?php echo $grow_data['humidity']; ?>
                <span class="font-size-30">%</span><span class="font-size-16"> rH.</span>
              </div>
            </div>
            <?php endif; ?>

            <?php if ($sensor_state['lights_state'] == 1): ?>
            <ul class="list-inline font-size-16 white">
              <li class="list-inline-item">
                <?php if ($lights_status == 1 ): ?>
                  <i class="fas fa-sun" aria-hidden="true"></i>
                  <?php echo $grow_data['light_status_message']; ?>
                <?php elseif ($lights_status == 0 ): ?>
                  <i class="fas fa-moon" aria-hidden="true"></i>
                  <?php echo $grow_data['light_status_message']; ?>
                <?php endif; ?>
              </li>
            </ul>
            <?php endif; ?>

        </section>

        <div class="page-content" style="padding: 15px;">
          <div class="row">
            <div class="col-lg-12 col-md-12">

              <!-- Card -->
              <div class="card shadow" style="width: 100%;">
                
                <!-- Crop Info -->
                <div class="card-body">

                  <!-- If no Crops still display camera -->
                  <?php if (empty($crops)): ?>
                    <div class="row">
                      <div class="col-12 text-right">
                        <?php if ($sensor_state['camera_state'] == "1"): ?>
                          <!-- Camera View Functions -->
                          <div class="btn-group btn-group-sm">
                            <a id="cameraView" href="<?php echo asset_url(); ?>img/crop_bg.jpg" role="button" class="btn btn-outline-secondary image-popup-vertical-fit" data-plugin="magnificPopup">VIEW <i class="fas fa-video pl-1"></i></a>
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item fruxe-grey" href="<?php echo base_url("dashboard/latestPhoto"); ?>">Take Photo <i class="fas fa-camera pl-1"></i></a>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>

                  <!-- Show Crops -->
                  <?php else: ?>

                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    
                    <!-- Crops Carousel -->
                    <div class="carousel-inner">
                      <?php $counter = 0; ?>
                      <?php foreach($crops as $crop): ?>
                        <!-- Set Active Carousel Slide -->
                        <?php if($counter == 0): ?>
                          <div class="carousel-item active">
                        <?php else: ?>
                          <div class="carousel-item">
                        <?php endif; ?>
                          
                          
                          <div class="row">
                            <!-- Crop Nickname -->
                            <div class="col-8">
                              <h5 class="cropNickname medium-grey"><?php echo $crop['nickname']; ?></h5> 
                            </div>
                            
                            <!-- Buttons -->
                            <div class="col-4">
                              <div class="btn-group btn-group-sm float-right" role="group" aria-label="">
                                <?php if(count($crops) > 1): ?>
                                <a href="#carouselExampleIndicators" role="button" data-slide="prev" class="btn btn-outline-secondary"><i class="fas fa-angle-double-left"></i></a>
                                <a href="#carouselExampleIndicators" role="button" data-slide="next" class="btn btn-outline-secondary"><i class="fas fa-angle-double-right"></i></a>
                                <?php endif; ?>
                                <?php if ($sensor_state['camera_state'] == "1"): ?>
                                  <!-- Camera View Functions -->
                                  <div class="btn-group btn-group-sm">
                                    <a id="cameraView" href="<?php echo asset_url(); ?>img/crop_bg.jpg" role="button" class="btn btn-outline-secondary image-popup-vertical-fit" data-plugin="magnificPopup">VIEW <i class="fas fa-video pl-1"></i></a>
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item fruxe-grey" href="<?php echo base_url("dashboard/latestPhoto"); ?>">Take Photo <i class="fas fa-camera pl-1"></i></a>
                                    </div>
                                  </div>
                                <?php endif; ?>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12">
                              <!-- Crop Details -->
                              <h5 class="font-size-16 fruxe-grey"><i class="fas fa-leaf pr-3"></i><?php echo $crop['plant_type']; ?><br class="d-md-none d-lg-none d-xl-none"><i class="fas fa-calendar-alt pr-3 pl-3" aria-hidden="true"></i> Day <?php echo $crop['growdays_complete']; ?> / <?php echo $crop['total_growdays']; ?> <span class="font-weight-light text-muted">(<?php echo $crop['crop_progress']; ?>%)</span></h5>
                              
                              <!-- Progress Bar -->
                              <div class="progress mt-3">
                                <div class="progress-bar progress-bar-striped fruxe-green-bg active" aria-valuenow="<?php echo $crop['crop_progress']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $crop['crop_progress']; ?>%" role="progressbar">
                                </div>
                              </div>
                            </div>
                          </div>
                            
                        </div>
                        <?php $counter++; ?>
                      <?php endforeach; ?>

                    </div>

                  </div>
                  <?php endif; ?>

                </div>

                <!-- Tabs -->
                <div class="card-body p-0">
                  
                  <!-- Tab Navigation -->
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-status" aria-selected="true">Status</a>
                      <a class="nav-item nav-link" id="nav-journal-tab" data-toggle="tab" href="#nav-journal" role="tab" aria-controls="nav-journal" aria-selected="false">Activity</a>
                      <a class="nav-item nav-link" id="nav-alerts-tab" data-toggle="tab" href="#nav-alerts" role="tab" aria-controls="nav-alerts" aria-selected="false">Settings</a>
                    </div>
                  </nav>

                  <!-- Tab Content --> 
                  <div class="tab-content p-3" id="nav-tabContent">
                    
                    <!-- Status Tab -->
                    <div class="tab-pane fade show active p-3" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
                      <div class="row">
                        <div class="col-md-9 col-8 text-left pl-3 pt-1">
                          <h4>Growing Environment</h4>
                        </div>
                        <div class="col-md-3 col-4 settings-dropdown pt-3">
                          
                          <!-- Actions Dropdown -->
                          <div class="btn-group float-right">
                            <button type="button" class="btn dropdown-toggle medium-grey" style="background-color:transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i> </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <h6 class="dropdown-header">Technical Settings</h6>
                              <a class="dropdown-item" href="<?php echo base_url("technical/lights"); ?>">Lights</a>
                              <a class="dropdown-item" href="<?php echo base_url("technical/fans"); ?>">Fans</a>
                              <a class="dropdown-item" href="<?php echo base_url("technical/pump"); ?>">Pump</a>
                            </div>
                          </div>  

                        </div>
                      </div>
                    

                      <!-- Grow Room Stats -->
                      <div id="statsDIV" class="row p-3" style="margin-bottom:20px; border-bottom: 1px solid #ccc;">
                        
                        <!-- Temperature -->
                        <?php if ($sensor_state['climate_state'] == 1): ?>
                        <div id="temp" class="roomStats col-6 col-md-2 col-sm-6 text-left p-0">
                          TEMPERATURE
                          <?php if($cropThresholds['temperature'] == "Y"): ?>
                            <i class="fas fa-check-circle light-green mr-2"></i>
                          <?php elseif($cropThresholds['temperature'] == "N"): ?>
                            <?php if($cropThresholds['tempStatus'] == "H"): ?>
                              <i class="fas fa-arrow-up mr-3"></i>
                            <?php elseif($cropThresholds['tempStatus'] == "L"): ?>
                              <i class="fas fa-arrow-down mr-3"></i>
                            <?php endif; ?>
                          <?php endif; ?>

                          <!-- Temperature: Convert Celsius or Fahrenheit -->
                          <div class="font-size-40 medium-grey">
                            <?php if ($temperature_format == "F"): ?>
                              <?php echo round(celsiusToFahrenheit($grow_data['temperature']), 1); ?>°
                              <span class="font-size-30">F</span>
                            <?php else: ?>
                              <?php echo round($grow_data['temperature'], 1); ?>°
                              <span class="font-size-30">C</span>
                            <?php endif; ?>
                          </div>
                        </div>

                        <!-- Humidity -->
                        <div id="humid" class="roomStats col-6 col-md-2 col-sm-6 text-left p-0">
                          HUMIDITY
                          <?php if($cropThresholds['humidity'] == "Y"): ?>
                            <i class="fas fa-check-circle light-green mr-2"></i>
                          <?php elseif($cropThresholds['humidity'] == "N"): ?>
                            <?php if($cropThresholds['humidStatus'] == "H"): ?>
                              <i class="fas fa-arrow-up mr-3"></i>
                            <?php elseif($cropThresholds['humidStatus'] == "L"): ?>
                              <i class="fas fa-arrow-down mr-3"></i>
                            <?php endif; ?>
                          <?php endif; ?>

                          <div class="font-size-40 medium-grey">
                            <?php echo round($grow_data['humidity'], 1); ?>
                            <span class="font-size-30">%</span>
                          </div>
                        </div>
                        <?php endif; ?>

                        <!-- Soil -->
                        <?php if ($sensor_state['moisture_state'] == 1): ?>
                        <div class="roomStats col-6 col-md-2 col-sm-6 text-left p-0">
                          SOIL
                          <?php if ($soil_status == 0): ?>
                          <i class="fas fa-check-circle light-green mr-2"></i>
                          <?php elseif ($soil_status == 1): ?>
                          <i class="fas fa-minus-circle light-red mr-2"></i>
                          <?php endif; ?>
                          

                          <div class="font-size-40 medium-grey">
                            <?php if ($soil_status == 0): ?>
                              <i class="fas fa-tint font-size-40"></i>
                            <?php elseif ($soil_status == 1): ?>
                              <i class="fas fa-tint-slash font-size-40"></i>
                            <?php endif; ?>
                          </div>
                        </div>
                        <?php endif; ?>

                        <!-- Conditions -->
                        <?php if ($sensor_state['climate_state'] == 1): ?>
                        <div class="roomStats col-6 col-md-2 col-sm-6 text-left p-0">
                          CONDITIONS
                          <?php if($cropConditions > 80 ): ?>
                            <i class="fas fa-check-circle light-green mr-2"></i>
                          <?php endif; ?>
                          <div class="font-size-40 medium-grey">
                            <?php echo $cropConditions; ?>
                            <span class="font-size-30">%</span>
                          </div>
                        </div>
                        <?php endif; ?>

                        <!-- Lights -->
                        <?php if ($sensor_state['lights_state'] == 1): ?>
                        <div class="roomStats col-6 col-md-2 col-sm-6 text-left p-0">
                          LIGHTS
                          <?php if($lights_status == 1): ?>
                            <i class="fas fa-check-circle light-green mr-2"></i>
                          <?php elseif($lights_status == 0): ?>
                            <i class="fas fa-minus-circle light-red mr-2"></i>
                          <?php endif; ?>

                          <div class="font-size-40 medium-grey">
                            <?php if ($lights_status == 1): ?>
                              <i class="fas fa-sun font-size-40"></i>
                            <?php elseif ($lights_status == 0): ?>
                              <i class="fas fa-moon font-size-40"></i>
                            <?php endif; ?>
                          </div>
                        </div>
                        <?php endif; ?>

                        <!-- Fans -->
                        <?php if ($sensor_state['fan_state'] == 1): ?>
                        <div class="roomStats col-6 col-md-2 col-xs-6 text-left p-0">
                          FANS
                          <?php if($fan_status == 1): ?>
                            <i class="fas fa-check-circle light-green mr-2"></i>
                          <?php elseif($fan_status == 0): ?>
                            <i class="fas fa-minus-circle light-red mr-2"></i>
                          <?php endif; ?>
                          <div class="font-size-40 medium-grey">
                            <?php if($fan_status == 1): ?>
                              <i class="fas fa-wind font-size-40"></i>
                            <?php elseif($fan_status == 0): ?>
                              <i class="fas fa-ban font-size-40"></i>
                            <?php endif; ?>
                          </div>
                        </div>
                        <?php endif; ?> 

                      </div>

                      <?php if ($sensor_state['climate_state'] == 1): ?>
                      <div class="col-md-9 col-xs-6 text-left p-0">
                          <h4>Grow Climate <small class="text-muted font-size-14">Last 24 Hours</small></h4>
                        </div>
                      <div class="chart" style="width:100%;">
                        <canvas id="canvas"></canvas>
                      </div>
                      <?php endif; ?>
                    </div>

                    <!-- Journal Tab -->
                    <div class="tab-pane fade p-3" id="nav-journal" role="tabpanel" aria-labelledby="nav-journal-tab">
      
                      <!-- Crop Journal -->
                      <ul class="list-group list-group-dividered list-group-full pb-4">

                        <!-- Display cropJournal Entries -->
                        <?php if(!empty($crop_activity)): ?>

                          <?php foreach ($crop_activity as $activity_entry): ?>
                          
                            <!-- Journal Entry -->
                            <li class="list-group-item">
                              <div class="media">
                                <div class="pr-5" style="width:100px;">
                                  <a class="avatar" href="javascript:void(0);">
                                    <?php if ($activity_entry['activity_type'] == "Spraying"): ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo asset_url(); ?>img/activity_spraying.svg" alt="">
                                    <?php elseif ($activity_entry['activity_type'] == "Pest Control"): ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo asset_url(); ?>img/activity_pest.svg" alt="">
                                    <?php elseif ($activity_entry['activity_type'] == "Fertilizer"): ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo asset_url(); ?>img/activity_fertilizer.svg" alt="">
                                    <?php elseif ($activity_entry['activity_type'] == "Trimming"): ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo asset_url(); ?>img/activity_trimming.svg" alt="">
                                    <?php elseif ($activity_entry['activity_type'] == "Watering"): ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo asset_url(); ?>img/activity_watering.svg" alt="">
                                    <?php elseif ($activity_entry['activity_type'] == "Notes"): ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo asset_url(); ?>img/activity_notes.svg" alt="">
                                    <?php else: ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo asset_url(); ?>img/profile_pic.jpg" alt="">
                                    <?php endif; ?>
                                  </a>
                                </div>
                                <div class="media-body">
                                  <div class="media-heading font-size-16">
                                    <span class="activity_type text-uppercase medium-grey"><?php echo $activity_entry['activity_type']; ?></span>
                                    <span class="text-muted float-right font-size-12">
                                      <?php echo $timeago = get_timeago(strtotime($activity_entry['date_time'])); ?>
                                    </span>
                                  </div>
 
                                  <p class="font-size-12">
                                    <i class="fas fa-calendar-alt pr-1" aria-hidden="true"></i> <?php echo date('d M Y', strtotime($activity_entry['date_time'])); ?>
                                    <i class="far fa-clock pl-1 pr-1" aria-hidden="true"></i> <?php echo date('H:i', strtotime($activity_entry['date_time'])); ?> 
                                    <span class="activity_edit medium-grey"> 
                                      <a href="<?php echo base_url("crop/activity/edit/" . $activity_entry['id']); ?>" class="text-muted ml-2"><i class="fas fa-edit pr-1" aria-hidden="true"></i>Edit</a> 
                                      <a href="<?php echo base_url("crop/activity/delete/" . $activity_entry['id']); ?>" class="text-muted ml-2"><i class="fas fa-times-circle pr-1" aria-hidden="true"></i>Delete</a>
                                    </span>
                                  </p>
                                  
                                  <!-- Display Journal Entry Message -->
                                  <?php if (!empty($activity_entry['msg'])) : ?>

                                    <div class="alert alert-secondary mt-3" role="alert">
                                      <?php echo $activity_entry['msg']; ?>
                                    </div>

                                  <?php endif; ?>

                                </div>

                              </div>
                            </li>
        
                          <?php endforeach; ?>

                        <?php else: ?>

                          <li class="list-group-item">
                            <h4>No Journal entries display</h4>
                          </li>

                        <?php endif; ?>

                      </ul>

                    </div>

                    <!-- Settings Tab -->
                    <div class="tab-pane fade p-3" id="nav-alerts" role="tabpanel" aria-labelledby="nav-alerts-tab">
                      
                      <!-- Grow Room Settings -->
                      <div class="col-md-12 col-xs-6 text-left">
                        <h3>Grow Room Settings </h3>
                        <h5 class="pb-3">Adjust the light, fan and pump settings.</h5>
                              <?php echo form_open("dashboard/settings"); ?>
                              
                              <!-- Climate Settings -->
                              <?php if ($sensor_state['climate_state'] == 1): ?>
                              <h4>Climate Threshold </h4>
                              <p class="text-muted">These values determine the conditions metric on the dashboard. If conditions fall within these values, everything is 100%!</p>
                              <div class="form-group row">
                                    <!-- Temperature Threshold -->
                                    <div class="col-sm-6 pt-1">
                                      <h5>Temperature</h5>
                                      <div class="row">
                                        <div class="col-6">
                                          <div class="input-group mb-2">
                                                <?php if(!empty($climate_threshold['temp_MIN'])): ?>
                                                  <!-- Format Temperature -->
                                                  <?php if ($temperature_format == "F"): ?>
                                                    <input type="text" class="form-control" name="temperatureLOW" value="<?php echo celsiusToFahrenheit($climate_threshold['temp_MIN']); ?>">
                                                  <?php else: ?>
                                                    <input type="text" class="form-control" name="temperatureLOW" value="<?php echo $climate_threshold['temp_MIN']; ?>">
                                                  <?php endif; ?>
                                                <?php else: ?>
                                                  <input type="text" class="form-control" name="temperatureLOW" value="" placeholder="Min Temperature">
                                                <?php endif; ?>
                                                <div class="input-group-append">
                                                  <!-- Format Temperature -->
                                                  <?php if ($temperature_format == "F"): ?>
                                                    <div class="input-group-text">&#176F</div>
                                                  <?php else: ?>
                                                    <div class="input-group-text">&#176C</div>
                                                  <?php endif; ?>
                                                </div>
                                          </div>
                                          <small class="form-text text-muted">Set minimum temperature</small>
                                        </div>
                                        <div class="col-6">
                                          <div class="input-group mb-2">
                                                <?php if(!empty($climate_threshold['temp_MAX'])): ?>
                                                  <!-- Format Temperature -->
                                                  <?php if ($temperature_format == "F"): ?>
                                                    <input type="text" class="form-control" name="temperatureHIGH" value="<?php echo celsiusToFahrenheit($climate_threshold['temp_MAX']); ?>">
                                                  <?php else: ?>
                                                    <input type="text" class="form-control" name="temperatureHIGH" value="<?php echo $climate_threshold['temp_MAX']; ?>">
                                                  <?php endif; ?>
                                                <?php else: ?>
                                                  <input type="text" class="form-control" name="temperatureHIGH" value="" placeholder="Max Temperature">
                                                <?php endif; ?>
                                                <div class="input-group-append">
                                                  <!-- Format Temperature -->
                                                  <?php if ($temperature_format == "F"): ?>
                                                    <div class="input-group-text">&#176F</div>
                                                  <?php else: ?>
                                                    <div class="input-group-text">&#176C</div>
                                                  <?php endif; ?>
                                                </div>
                                          </div>
                                          <small class="form-text text-muted">Set maximum temperature</small>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Humidity Threshold -->
                                    <div class="col-sm-6 pt-1">
                                      <h5>Humidity</h5>
                                      <div class="row">
                                        <div class="col-6">
                                          <div class="input-group mb-2">
                                                <?php if(!empty($climate_threshold['humid_MIN'])): ?>
                                                <input type="text" class="form-control" name="humidityLOW" value="<?php echo $climate_threshold['humid_MIN']; ?>">
                                                <?php else: ?>
                                                <input type="text" class="form-control" name="humidityLOW" value="" placeholder="Min Humidity">
                                                <?php endif; ?>
                                                <div class="input-group-append">
                                                      <div class="input-group-text">%</div>
                                                </div>
                                          </div>
                                          <small class="form-text text-muted">Set minimum humidity</small>
                                        </div>
                                        <div class="col-6">
                                          <div class="input-group mb-2">
                                                <?php if(!empty($climate_threshold['humid_MAX'])): ?>
                                                <input type="text" class="form-control" name="humidityHIGH" value="<?php echo $climate_threshold['humid_MAX']; ?>">
                                                <?php else: ?>
                                                <input type="text" class="form-control" name="humidityHIGH" value="" placeholder="Max Humidity">
                                                <?php endif; ?>
                                                <div class="input-group-append">
                                                      <div class="input-group-text">%</div>
                                                </div>
                                          </div>
                                          <small class="form-text text-muted">Set maximum humidity</small>
                                        </div>
                                      </div>
                                    </div>
                              </div>
                              <hr>
                              <?php endif; ?>

                              <!-- Light Settings -->
                              <?php if ($sensor_state['lights_state'] == 1): ?>
                              <h4>Lights </h4>
                              <div class="form-group row">
                                    <div class="col-sm-6 pt-1">
                                          <h5>Lights ON</h5>
                                          <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                                <?php if(!empty($lights_ON)): ?>
                                                <input type="text" class="form-control" id="lightsON" name="lightsON" data-plugin="timepicker" value="<?php echo $lights_ON; ?>">
                                                <?php else: ?>
                                                <input type="text" class="form-control" id="lightsON" name="lightsON" data-plugin="timepicker" value="">
                                                <?php endif; ?>
                                          </div>
                                    </div>
                                    <div class="col-sm-6 pt-1">
                                          <h5>Lights OFF</h5>
                                          <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                                <?php if(!empty($lights_OFF)): ?>
                                                <input type="text" class="form-control" id="lightsOFF" name="lightsOFF" data-plugin="timepicker" value="<?php echo $lights_OFF; ?>">
                                                <?php else: ?>
                                                <input type="text" class="form-control" id="lightsOFF" name="lightsOFF" data-plugin="timepicker" value="">
                                                <?php endif; ?>
                                          </div>
                                    </div>
                              </div>
                              <hr>
                              <?php endif; ?>

                              <!-- Fan Settings -->
                              <?php if ($sensor_state['fan_state'] == 1): ?>
                              <h4>Fans</h4>
                              <p class="text-muted">The fans will run if the temperature or humidity rises above these temperature thresholds.</p>
                              <div class="form-group row">
                                    
                                    <!-- Fan Climate Thresholds -->
                                    <div class="col-sm-6 pt-1">
                                      <h5>Temperature Thresholds</h5>
                                      <div class="row">
                                        <div class="col-6">
                                          <div class="input-group mb-2">
                                            <?php if(!empty($fan_schedule[0]->fan_temp_threshold)): ?>
                                              <?php if ($temperature_format == "F"): ?> 
                                                <input type="text" name="fan_temp_threshold" class="form-control" value="<?php echo celsiusToFahrenheit($fan_schedule[0]->fan_temp_threshold); ?>">
                                              <?php else: ?>
                                                <input type="text" name="fan_temp_threshold" class="form-control" value="<?php echo $fan_schedule[0]->fan_temp_threshold; ?>">
                                              <?php endif; ?>
                                            <?php else: ?>
                                              <input type="text" name="fan_temp_threshold" class="form-control" placeholder="Max Temperature">
                                            <?php endif; ?>
                                            <div class="input-group-append">
                                              <!-- Format Temperature -->
                                              <?php if ($temperature_format == "F"): ?>
                                                <div class="input-group-text">&#176F</div>
                                              <?php else: ?>
                                                <div class="input-group-text">&#176C</div>
                                              <?php endif; ?>
                                            </div>
                                          </div>
                                          <small class="form-text text-muted">Set maximum temperature</small>
                                        </div>
                                        <div class="col-6">
                                          <div class="input-group mb-2">
                                                <?php if(!empty($fan_schedule[0]->fan_humid_threshold)): ?>
                                                <input type="text" class="form-control" name="fan_humid_threshold" value="<?php echo $fan_schedule[0]->fan_humid_threshold; ?>">
                                                <?php else: ?>
                                                <input type="text" class="form-control" name="fan_humid_threshold" value="" placeholder="Max Humidity">
                                                <?php endif; ?>
                                                <div class="input-group-append">
                                                      <div class="input-group-text">%</div>
                                                </div>
                                          </div>
                                          <small class="form-text text-muted">Set maximum humidity</small>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-sm-6 pt-1">
                                          <h5>Run Duration <small class="text-muted">minutes</small></h5>
                                          <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                                <input type="text" name="fan_duration" class="form-control" value="<?php echo $fan_schedule[0]->fan_duration; ?>">
                                          </div>
                                          <small class="form-text text-muted">Fan will run for <?php echo $fan_schedule[0]->fan_duration != "" ? $fan_schedule[0]->fan_duration : " this many " ?> minutes.</small>

                                    </div>
                              </div>
                              <hr>
                              <?php endif; ?>

                              <!-- Pump Settings -->
                              <?php if ($sensor_state['pump_state'] == 1): ?>
                              <h4>Pump</h4>
                              <div class="form-group row">
                                    <div class="col-sm-6 pt-1">
                                          <h5>Pump ON</h5>
                                          <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="pumpON" name="pump_ON" data-plugin="timepicker" value="<?php echo $pump_schedule[0]->pump_ON; ?>">
                                          </div>
                                          <small class="form-text text-muted">Pump will run each day at the prescribed time.</small>
                                    </div>
                                    <div class="col-sm-6 pt-1">
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
                              <hr>
                              <?php endif; ?>

                              <!-- Save Schedule -->
                              <div class="form-group row pb-3">
                                   <div class="col-md-12">
                                          <button type="submit" class="btn btn-magenta">Save Settings</button>
                                   </div>
                              </div>
                              <?php echo form_close();?>
                      </div>
                    
                    </div>

                  </div>

                </div> <!-- END Tabs -->
              
                <!-- Card Footer -->
                <div class="card-footer text-muted">
                  <p class="font-size-12 pt-2"><strong class="text-uppercase pr-3">Last Update</strong> <?php echo date('d M Y', strtotime($grow_data['date_time'])) ?> <i class="far fa-clock pl-1 pr-1"></i> <?php echo date('H:i', strtotime($grow_data['date_time'])) ?></p>
                </div>

              </div> <!-- END card -->
              
        </div> <!-- END main -->

        <button id="activityButton" class="btn btn-activity site-action btn-floating" type="button" data-toggle="modal" data-target="#addActivity">
          <i class="fas fa-plus"></i>
        </button>
        
        <!-- Crop Activity Modal -->
        <div class="modal fade" id="addActivity" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <!-- Modal Header -->
              <div class="modal-header m-2">
                <h4 class="modal-title">Log Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <!-- Log Crop Activity Form -->
              <?php echo form_open('crop/activity/new'); ?>
              <div class="modal-body m-2 pb-2">
                  
                  <!-- Select crop -->
                  <div class="form-group row">
                    <div class="col-3">
                      <h5 class="pt-2">Crop</h5>
                    </div>
                    <div class="col-9">
                      <select class="form-control selectpicker" data-plugin="selectpicker" name="crop">
                        <?php foreach ($crops as $crop): ?>
                        <option value="<?php echo $crop['cropID']; ?>"><?php echo $crop['nickname']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Select crop activity type -->
                  <div class="form-group row">
                    <div class="col-3">
                      <h5 class="pt-2">Activity</h5>
                    </div>
                    <div class="col-9">
                      <select class="form-control selectpicker" data-plugin="selectpicker" name="activity_type">
                        <option>Spraying</option>
                        <option>Fertilizer</option>
                        <option>Pest Control</option>
                        <option>Trimming</option>
                        <option>Watering</option>
                        <option>Notes</option>
                      </select>
                    </div>
                  </div>

                  <!-- Log remarks -->
                  <div class="form-group">
                    <button type="button" class="btn btn-transparent" style="padding-left:0;" data-toggle="collapse" href="#logRemarks" aria-expanded="false" aria-controls="logRemarks"><i class="fas fa-plus"></i> Add Remarks</button>
                    <div id="logRemarks" class="form-group collapse pt-3">
                      <textarea class="form-control" id="textareaDefault" name="msg" rows="3" placeholder="Enter remarks"></textarea>
                    </div>
                  </div>
              </div>

              <div class="modal-footer">
                <a id="cancelActivityModal" class="btn btn-danger" data-dismiss="modal" href="javascript:void(0);">Cancel</a>
                <button type="submit" name="submit" class="btn btn-activity" >Log Activity</button>
              </div>
            </div>
            <?php echo form_close();?>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- End Page -->

  

          
     
     
  

    <!-- Site Footer -->
    <?php $this->load->view('core/footer'); ?>

    <!-- Page Scripts -->
    <?php $this->load->view('dashboard/dashboard_scripts'); ?>

  </body>
  <!-- /Body -->

</html>