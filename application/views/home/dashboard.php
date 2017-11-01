<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_program_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-star"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Program</h3>
                    <p class="text-center">Berisi program pelatihan yang ada di safetra</p>
                </div>
            </section>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_client_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-empire"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Client</h3>
                    <p class="text-center">Berisi klien yang bekerjasama dengan safetra. Akan tampil di halaman utama web</p>
                </div>
            </section>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_slider_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-sliders"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Slider</h3>
                    <p class="text-center">Berisi foto-foto yang akan ditampilkan di halaman utama web</p>
                </div>
            </section>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_testimony_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-star"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Testimony</h3>
                    <p class="text-center">Berisi testimony client yang akan ditampilkan di halaman utama web</p>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_article_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-files-o"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Article</h3>
                    <p class="text-center">Berisi artikel/berita. Tampil di bagian artikel</p>
                </div>
            </section>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_company_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-slack"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Company</h3>
                    <p class="text-center">Perusahaan yang menghubungi safetra via web</p>
                </div>
            </section>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_member_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-users"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Member</h3>
                    <p class="text-center">Berisi orang-orang yang menghubungi safetra via web</p>
                </div>
            </section>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_preferences_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-asterisk"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Preferences</h3>
                    <p class="text-center">Berisi beberapa fungsi yang ditampilkan di web/email</p>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3">
            <section class="panel">
                <a href="<?php echo $this->config->item('link_admin_lists'); ?>" class="color-grey">
                    <header class="panel-heading bg-white">
                        <div class="panel-heading-icon bg-primary mt-sm">
                            <i class="fa fa-user-secret"></i>
                        </div>
                    </header>
                </a>
                <div class="panel-body">
                    <h3 class="text-semibold mt-none text-center">Admin</h3>
                    <p class="text-center">Berisi karyawan yang bisa mengakses halaman admin</p>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>