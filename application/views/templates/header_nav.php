<body>
    <section class="body">

        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="<?php echo $this->config->item('link_dashboard'); ?>" class="logo">
                    <img src="<?php echo base_url('assets/images').'/logo.png'; ?>" height="35" alt="Safetra Indonesia" />
                </a>
                <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
        
            <!-- start: search & user box -->
            <div class="header-right">
                <span class="separator"></span>
                <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                        <figure class="profile-picture">
                            <?php
                            echo '<img src="'.base_url('assets/images').'/default_user.png" alt="'.$this->session->userdata('name').'" class="img-circle" data-lock-picture="'.base_url('assets/images').'/default_user.png" />';
                            if ($this->session->userdata('photo') != '') {
                                echo '<img src="'.$this->session->userdata('photo').'" alt="'.$this->session->userdata('name').'" class="img-circle" data-lock-picture="'.$this->session->userdata('photo').'" />';
                            } ?>
                        </figure>
                        <div class="profile-info" data-lock-name="<?php echo $this->session->userdata('name'); ?>" data-lock-email="<?php echo $this->session->userdata('email'); ?>">
                            <span class="name"><?php echo $this->session->userdata('name'); ?></span>
                            <span class="role"><?php echo $this->session->userdata('role_desc'); ?></span>
                        </div>
        
                        <i class="fa custom-caret"></i>
                    </a>
        
                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="<?php echo $this->config->item('link_profile'); ?>"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="<?php echo $this->config->item('link_logout'); ?>"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->
        
        <div class="inner-wrapper">