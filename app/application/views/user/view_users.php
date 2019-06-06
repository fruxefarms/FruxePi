<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - View Users -->
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
              <div class="card-header">
                <h1 style="font-size:25px;">Settings &#187; All Users</h1>
              </div>
              <div class="card-body">
              <div class="col">
        <h1>
            Users
            <!-- Add User Button -->
            <a class="btn btn-outline-upload float-right" style="font-size:20px;" title="Add User" href="<?php echo base_url("auth/create_user"); ?>">
                <i class="fa fa-plus-square"></i> Add New User
            </a>
        </h1>
    </div>

    <div id="infoMessage"><?php echo $message;?></div>

    <div class="col">
    <table id="usersTable" class="table user-table table-hover dataTable table-striped w-full pb-3" style="width:100%">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email \ Username</th>
                <th>Groups</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user):?>
            <tr>
                <td class="text-capitalize"><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                <td class="text-capitalize"><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                <td class="text-capitalize">
                    <?php foreach ($user->groups as $group):?>
                        <?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                    <?php endforeach?>
                </td>
                <td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
                <td>
                    <a class="pr-2" href="<?php echo base_url("auth/edit_user/"); ?><?php echo $user->id; ?>" title="Edit User"><i class="fas fa-edit"></i></a>
                    <a href="#" title="Delete User" data-toggle="modal" data-target="#delete-modal-<?php echo $user->id; ?>"><i class="far fa-trash-alt"></i></a>
                </td>

                <!-- Confirm Delete Modal -->
                <div class="modal fade" id="delete-modal-<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    </div>
              </div>
              <div class="card-footer text-muted">
                <?php echo count($users); ?> Users
              </div>
            </div>
        </section>
        
    </div>

    <!-- Site Footer -->
    <?php $this->load->view('core/footer'); ?>

    <!-- Page Plugins -->
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/datatables.min.js"></script>

    <!-- Page Scripts -->
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "columnDefs": [
                    { "orderable": true, "targets": 1 },
                    { "orderable": false, "targets": 5 },
                    { "orderable": false, "targets": 6 }
                ]
            });
        });
    </script>

  </body>
  <!-- /Body -->

</html>