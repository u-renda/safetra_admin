<section role="main" class="content-body">
    <header class="page-header">
        <h2>Preferences</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
                <li><span>Preferences</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="preferences_create_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Preferences Create</h2>
                </header>
                <form action="<?php echo $this->config->item('link_preferences_create'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Name:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Content:</label>
                            <div class="col-sm-10">
                                <textarea rows="5" name="content" class="form-control mceEditor"><?php echo set_value('content'); ?></textarea>
                                <?php echo form_error('content'); ?>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Create" id="submit_preferences_create" />
                        <a type="button" class="btn btn-default" href="<?php echo $this->config->item('link_preferences_lists'); ?>">Batal</a>
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>