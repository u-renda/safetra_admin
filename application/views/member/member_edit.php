<section role="main" class="content-body">
    <header class="page-header">
        <h2>Member</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
                <li><span>Member</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="member_create_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Ubah Data</h2>
                </header>
                <form action="<?php echo $this->config->item('link_member_edit').'?id='.$id; ?>" method="post" class="form-horizontal form-bordered">
                    <input type="hidden" name="selfemail" value="<?php echo $result->email; ?>">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Perusahaan:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="id_company">
                                    <option value="">-- Pilih Salah Satu --</option>
                                    <?php foreach ($company_lists as $row) { ?>
                                        <option value="<?php echo $row->id_company; ?>" <?php if ($result->company->id_company == $row->id_company) { echo 'selected="selected"'; } echo set_select('id_company', $row->id_company); ?>><?php echo $row->name; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('id_company'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Nama:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name', $result->name); ?>">
                                <?php echo form_error('name'); ?>
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
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Telp:</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone_number" class="form-control" value="<?php echo set_value('phone_number', $result->phone_number); ?>">
                                <?php echo form_error('phone_number'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> Password:</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Ubah" id="submit_member" />
                        <a type="button" class="btn btn-default" href="<?php echo $this->config->item('link_member_lists'); ?>">Batal</a>
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>