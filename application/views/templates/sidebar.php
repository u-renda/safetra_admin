<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="list-dashboard">
                        <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                            <span>Admin</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_admin_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_admin_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-files-o" aria-hidden="true"></i>
                            <span>Article</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_article_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_article_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-empire" aria-hidden="true"></i>
                            <span>Client</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_client_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_client_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-slack" aria-hidden="true"></i>
                            <span>Company</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_company_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_company_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                            <span>Media</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_media_album_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_media_album_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Member</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_member_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_member_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-sliders" aria-hidden="true"></i>
                            <span>Slider</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_slider_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_slider_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-asterisk" aria-hidden="true"></i>
                            <span>Preferences</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_preferences_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_preferences_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span>Program</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_program_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_program_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent list-parent">
                        <a>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <span>Testimony</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_testimony_lists'); ?>">
                                     Lists
                                </a>
                            </li>
                            <li class="list-child">
                                <a href="<?php echo $this->config->item('link_testimony_create'); ?>">
                                     Create
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <hr class="separator" />
        </div>

    </div>

</aside>
<!-- end: sidebar -->
