<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sub Program</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
                <li><span>Program</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="program_sub_lists_page" data-program="<?php echo $program->id_program; ?>">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Sub Program Lists - <?php echo $program->name; ?></h2>
                </header>
                <div class="panel-body">
                    <div id="multipleTable"></div>
                </div>
            </section>
            <a class="btn btn-primary" href="<?php echo $this->config->item('link_program_lists'); ?>">Back to Program</a>
        </div>
    </div>
    <!-- end: page -->
</section>