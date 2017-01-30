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
    <div class="row" id="admin_create_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Admin Create</h2>
                </header>
                <form action="<?php echo $this->config->item('link_admin_create'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Name:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Username:</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>">
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Email:</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Role:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="role">
                                    <option value="">-- Pilih Salah Satu --</option>
                                    <?php foreach ($code_admin_role as $key => $val) {
                                        echo '<option value="'.$key.'"'.set_select('role', $key).'>'.$val.'</option>';
                                    } ?>
                                </select>
                                <?php echo form_error('role'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> Job Title:</label>
                            <div class="col-sm-10">
                                <input type="text" name="job_title" class="form-control" value="<?php echo set_value('job_title'); ?>">
                                <?php echo form_error('job_title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Photo:</label>
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
                                            <input type="file" name="photo" />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <?php echo form_error('photo'); ?>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Create" id="submit_admin_create" />
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>