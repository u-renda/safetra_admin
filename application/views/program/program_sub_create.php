<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sub Program</h2>
    
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
    <div class="row" id="program_sub_create_page">
        <div class="col-md-12">
            <section class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Sub Program Create - <?php echo $program->name;?></h2>
                </header>
                <form action="<?php echo $this->config->item('link_program_sub_create').'?id='.$program->id_program; ?>" method="post" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Name:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Tujuan Program:</label>
                            <div class="col-sm-9">
                                <textarea rows="5" name="program_objective" class="form-control mceEditor"><?php echo set_value('program_objective'); ?></textarea>
                                <?php echo form_error('program_objective'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Tujuan Pelatihan:</label>
                            <div class="col-sm-9">
                                <textarea rows="5" name="training_purpose" class="form-control mceEditor"><?php echo set_value('training_purpose'); ?></textarea>
                                <?php echo form_error('training_purpose'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Persyaratan Peserta:</label>
                            <div class="col-sm-9">
                                <textarea rows="5" name="requirements_of_participant" class="form-control mceEditor"><?php echo set_value('requirements_of_participant'); ?></textarea>
                                <?php echo form_error('requirements_of_participant'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Materi Pelatihan:</label>
                            <div class="col-sm-9">
                                <textarea rows="5" name="training_material" class="form-control mceEditor"><?php echo set_value('training_material'); ?></textarea>
                                <?php echo form_error('training_material'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lainnya:</label>
                            <div class="col-sm-9">
                                <textarea rows="5" name="others" class="form-control"><?php echo set_value('others'); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Create" id="submit_program_sub_create" />
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>