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
    <div class="row" id="media_create_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Media Create</h2>
                </header>
                <form action="<?php echo $this->config->item('link_media_create').'?id='.$media_album->id_media_album; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Album Name:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo $media_album->name; ?></p>
                            </div>
                        </div>
                        <?php for ($i=1;$i<=5;$i++) { ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Media:</label>
                            <div class="col-sm-10">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="media[]" />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <?php echo form_error('media'); ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Create" id="submit_media_create" />
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>