<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Create User -->
  <body>

    <!-- Page Sidebar Nav -->
    <?php $this->load->view('core/nav'); ?>

    <!-- Page Content -->
    <div id="main">
        <!-- Page Header -->
        <?php $this->load->view('core/page_header'); ?>

        <!-- Page Sections -->
        <section class="climate pt-3 pb-5">
            <div class="card">
              <div class="card-header">
                <h1 style="font-size:25px;">Settings &#187; User</h1>
              </div>
              <div class="card-body">
                        <h5 class="card-title">Create New User Account</h5>
                        <p class="card-text">Contact Information</p>
                        <div id="infoMessage" style="color:red;"><?php echo $message;?></div>
                        <?php echo form_open("auth/create_user");?>

                        <!-- Set First Name & Last Name -->
                        <div class="form-row pb-3">
                              <div class="col">
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name">
                              </div>
                              <div class="col">
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name">
                              </div>
                        </div>

                        <!-- Email Address -->
                        <p class="card-text">Email \ Username</p>
                        <div class="form-group">
                              <input type="text" class="form-control" id="email" name="email" placeholder="hello@fruxe.co">
                        </div>
                        <hr>

                        <!-- Choose Password -->
                        <p class="card-text">Change Password</p>
                        <div class="form-row pb-3">
                              <div class="col">
                              <label>New Password</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="*******">
                              </div>
                              <div class="col">
                              <label>Confirm Password</label>
                              <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="*******">
                              </div>
                        </div>
                        
                        <!-- Buttons -->
                        <button type="submit" class="btn btn-activity"><i class="far fa-save"></i> Create User</button>

                        <?php echo form_close();?>

                  </div>
              <div class="card-footer text-muted">
                <!-- <em>Last Updated: </em>2 days ago -->
              </div>
            </div>
        </section>
        
    </div>

    <!-- Site Footer -->
    <?php $this->load->view('core/footer'); ?>

  </body>
  <!-- /Body -->

</html>