<section role="main" class="content-body">
    <header class="page-header">
        <h2>Article</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
                <li><span>Article</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="article_create_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Ubah Data</h2>
                </header>
                <form action="<?php echo $this->config->item('link_article_edit').'?id='.$id; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Judul:</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" value="<?php echo set_value('title', $result->title); ?>">
                                <?php echo form_error('title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Isi:</label>
                            <div class="col-sm-10">
                                <textarea rows="5" name="content" class="form-control mceEditor"><?php echo set_value('content', $result->content); ?></textarea>
                                <?php echo form_error('content'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><span class="text-danger">*</span> Tags</label>
                            <div class="col-md-10">
                                <input name="tags" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" value="<?php echo set_value('tags', $result->tags); ?>" />
                                <?php echo form_error('tags'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto:</label>
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
                                            <input type="file" name="media" />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                
                                <?php echo form_error('media'); ?>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Ubah" id="submit_article" />
                        <a type="button" class="btn btn-default" href="<?php echo $this->config->item('link_article_lists'); ?>">Batal</a>
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>