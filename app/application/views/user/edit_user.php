<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Edit User -->
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
                        <h5 class="card-title">Modify Account Details</h5>
                        <p class="card-text">Contact Information</p>
                        <!-- <div id="infoMessage" style="color:red;"><?php echo $message;?></div> -->
                        <?php echo form_open(uri_string());?>

                        <!-- Set First Name & Last Name -->
                        <div class="form-row pb-3">
                              <div class="col">
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user->first_name;?>">
                              </div>
                              <div class="col">
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user->last_name;?>">
                              </div>
                        </div>

                        <!-- Email Address -->
                        <p class="card-text">Email \ Username</p>
                        <div class="form-group">
                              <input type="text" class="form-control" id="email" name="email" value="<?php echo $user->email;?>">
                        </div>
                        <hr>

                        <!-- <p class="card-text">Profile Photo</p>
                        <div class="form-group">
                              <input type="file" id="profile_photo" name="profile_photo" class="form-control-file">
                        </div>
                        <hr> -->

                        <!-- User Groups -->
                        <?php if ($this->ion_auth->is_admin()): ?>
                        <p class="card-text">Member Groups</p>
                        <div class="form-group">
                              <?php foreach ($groups as $group):?>
                                    <label class="checkbox">
                                    <?php
                                          $gID=$group['id'];
                                          $checked = null;
                                          $item = null;
                                          foreach($currentGroups as $grp) {
                                          if ($gID == $grp->id) {
                                                $checked= ' checked="checked"';
                                          break;
                                          }
                                          }
                                    ?>
                                    <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                                    <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                                    </label>
                              <?php endforeach?>
                        </div>
                        <hr>
                        <?php endif ?>

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

                        <?php echo form_hidden('id', $user->id);?>
                        <?php echo form_hidden($csrf); ?>
                        
                        <!-- Buttons -->
                        <button type="submit" class="btn btn-activity"><i class="far fa-save"></i> Save Settings</button>
                        <a class="btn btn-danger pull-right" role="button" title="Delete User" data-toggle="modal" data-target="#delete-modal" href="#"><i class="far fa-trash-alt"></i> Delete Account</a>


                        <?php echo form_close();?>

                        <!-- Confirm Delete Modal -->
                        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header text-light" style="background-color: red;">
                                          <h5 class="modal-title" id="exampleModalLabel">Confirm Account Deletion</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                    <div class="modal-body">
                                          Are you sure you want to delete the user <span class="text-capitalize font-weight-bold"><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?> <?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></span>?
                                    </div>
                                    <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <a href="<?php echo base_url("user/delete/"); ?><?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                    </div>
                              </div>
                        </div>

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