
<div id="sidenav" class="sidenav">
    <!-- Close Sidenav -->
    <a href="javascript:void(0);" class="closebtn" onclick="closeNav()">&times;</a>

    <!-- Sidenav Menu -->
    <ul class="nav flex-column" id="sidenav-menu">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="<?php echo base_url("dashboard"); ?>" title="Dashboard">Dashboard</a>
        </li>
        
        <!-- Crop -->
        <li class="nav-item">
            <a href="<?php echo base_url("crop"); ?>" title="Crop">Crop</a>
        </li>
        
        <!-- Technical -->
        <li class="nav-item">
            <a href="#technicalDropdown" data-toggle="collapse" data-parent="#sidenav-menu" title="Sensors and Relays">Technical</a>
            <ul id="technicalDropdown" class="collapse">
                <li class="nav-item-sub"><a href="<?php echo base_url("technical/climate"); ?>" title="Climate Sensor Settings">Climate</a></li>
                <li class="nav-item-sub"><a href="<?php echo base_url("technical/lights"); ?>" title="Light Settings">Lights</a></li>
                <li class="nav-item-sub"><a href="<?php echo base_url("technical/fans"); ?>" title="Fan Settings">Fans</a></li>
                <li class="nav-item-sub"><a href="<?php echo base_url("technical/pump"); ?>" title="Pump Settings">Pump</a></li>
                <li class="nav-item-sub"><a href="<?php echo base_url("technical/moisture"); ?>" title="Moisture Settings">Moisture</a></li>
                <!-- <li class="nav-item-sub"><a href="<?php echo base_url("technical/heater"); ?>" title="Heater Settings">Heater</a></li> -->
                <li class="nav-item-sub"><a href="<?php echo base_url("technical/camera"); ?>" title="Camera Settings">Camera</a></li>
            </ul>
        </li>

         <!-- Users -->
        <?php if ($this->ion_auth->is_admin()): ?>
        <li class="nav-item">
            <a href="<?php echo base_url("users"); ?>" title="Users">Users</a>
        </li>
        <?php endif; ?>
        
        <!-- Settings -->
        <li class="nav-item">
            <a href="#settingsDropdown" data-toggle="collapse" data-parent="#sidenav-menu" title="Settings">Settings</a>
            <ul id="settingsDropdown" class="collapse">
                <li class="nav-item-sub"><a href="<?php echo base_url("user/edit/" . $user_info[0]->id); ?>" title="User Settings">User</a></li>
            </ul>
        </li>

        <!-- Logout -->
        <li class="nav-item">
            <a href="<?php echo base_url("logout"); ?>" title="Logout">Logout</a>
        </li>
    </ul>
</div>