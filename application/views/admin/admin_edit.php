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
                    <h2 class="panel-title">Ubah Data</h2>
                </header>
                <form action="<?php echo $this->config->item('link_admin_edit').'?id='.$id; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <input type="hidden" name="selfusername" value="<?php echo $result->username; ?>">
                    <input type="hidden" name="selfemail" value="<?php echo $result->email; ?>">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Nama:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name', $result->name); ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Username:</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control" value="<?php echo set_value('username', $result->username); ?>">
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Email:</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" value="<?php echo set_value('email', $result->email); ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Peran di Admin:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="role">
                                    <option value="">-- Pilih Salah Satu --</option>
                                    <?php foreach ($code_admin_role as $key => $val) { ?>
                                        <option value="<?php echo $key; ?>" <?php if ($result->role == $key) { echo 'selected="selected"'; } echo set_select('role', $key); ?>><?php echo $val; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('role'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Jabatan Kerja:</label>
                            <div class="col-sm-9">
                                <input type="text" name="job_title" class="form-control" value="<?php echo set_value('job_title', $result->job_title); ?>">
                                <?php echo form_error('job_title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Foto:</label>
                            <div class="col-sm-9">
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
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password:</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Ubah" id="submit_admin" />
                        <a type="button" class="btn btn-default" href="<?php echo $this->config->item('link_admin_lists'); ?>">Batal</a>
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>