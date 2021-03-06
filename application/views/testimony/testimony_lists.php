<section role="main" class="content-body">
    <header class="page-header">
        <h2>Testimony</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
                <li><span>Testimony</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="testimony_lists_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Testimony Lists</h2>
                </header>
                <div class="panel-body">
                    <a type="button" class="btn btn-success mb-xl" href="<?php echo $this->config->item('link_testimony_create'); ?>">Tambah Baru</a>
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