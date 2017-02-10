<section role="main" class="content-body">
    <header class="page-header">
        <h2>Program</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs mr-xl">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
                <li><span>Program</span></li>
            </ol>
    
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="program_edit_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Program Edit</h2>
                </header>
                <form action="<?php echo $this->config->item('link_program_edit').'?id='.$id; ?>" method="post" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Name:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name', $result->name); ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Percentage:</label>
                            <div class="col-sm-9">
                                <input type="text" name="percentage" class="form-control" value="<?php echo set_value('percentage', $result->percentage); ?>">
                                <?php echo form_error('percentage'); ?>
                            </div>
                        </div>
                        <div id="additional">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><span class="text-danger">*</span> Tujuan Program:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="program_objective" class="form-control mceEditor"><?php echo set_value('program_objective', $result->program_objective); ?></textarea>
                                    <?php echo form_error('program_objective'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><span class="text-danger">*</span> Tujuan Pelatihan:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="training_purpose" class="form-control mceEditor"><?php echo set_value('training_purpose', $result->training_purpose); ?></textarea>
                                    <?php echo form_error('training_purpose'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><span class="text-danger">*</span> Persyaratan Peserta:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="requirements_of_participant" class="form-control mceEditor"><?php echo set_value('requirements_of_participant', $result->requirements_of_participant); ?></textarea>
                                    <?php echo form_error('requirements_of_participant'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><span class="text-danger">*</span> Materi Pelatihan:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="training_material" class="form-control mceEditor"><?php echo set_value('training_material', $result->training_material); ?></textarea>
                                    <?php echo form_error('training_material'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lainnya:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="others" class="form-control"><?php echo set_value('others', $result->others); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Save Changes" id="submit_program_edit" />
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>