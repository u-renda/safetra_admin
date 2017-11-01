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
    <div class="row" id="testimony_create_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Testimony Create</h2>
                </header>
                <form action="<?php echo $this->config->item('link_testimony_create'); ?>" method="post" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Nama:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Jabatan:</label>
                            <div class="col-sm-10">
                                <input type="text" name="job_title" class="form-control" value="<?php echo set_value('job_title'); ?>">
                                <?php echo form_error('job_title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Testimony:</label>
                            <div class="col-sm-10">
                                <textarea rows="5" name="testimony" class="form-control mceEditor"><?php echo set_value('testimony'); ?></textarea>
                                <?php echo form_error('testimony'); ?>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Create" id="submit_testimony_create" />
                        <a type="button" class="btn btn-default" href="<?php echo $this->config->item('link_testimony_lists'); ?>">Batal</a>
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>