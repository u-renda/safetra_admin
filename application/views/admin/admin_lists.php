<section role="main" class="content-body">
    <header class="page-header">
        <h2>Admin</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
                <li><span>Admin</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="admin_lists_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Admin Lists</h2>
                </header>
                <div class="panel-body">
                    <a type="button" class="btn btn-success mb-xl" href="<?php echo $this->config->item('link_admin_create'); ?>">Tambah Baru</a>
                    <?php
                    if ($msg == TRUE)
                    {
                        if ($msg == 'success')
                        {
                            echo '<div class="alert alert-success">';
                            echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                            echo 'Success '.$type.' data! </div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-danger">';
                            echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                            echo 'Failed '.$type.' data! </div>';
                        }
                    }
                    ?>
                    <div id="multipleTable"></div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>