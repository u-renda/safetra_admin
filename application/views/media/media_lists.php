<section role="main" class="content-body">
    <header class="page-header">
        <h2>Media</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
                <li><span>Media</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="media_lists_page" data-program="<?php echo $media_album->id_media_album; ?>">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Media Lists - <?php echo ucwords($media_album->name); ?></h2>
                </header>
                <div class="panel-body">
                    <a type="button" class="btn btn-success mb-xl" href="<?php echo $this->config->item('link_media_create').'?id='.$id_media_album; ?>">Tambah Baru</a>
                    <a type="button" class="btn btn-primary mb-xl" href="<?php echo $this->config->item('link_media_album_lists'); ?>">Kembali ke Media Album</a>
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