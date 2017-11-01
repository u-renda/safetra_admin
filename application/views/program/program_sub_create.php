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
                    <h2 class="panel-title">Tambah Baru - <?php echo $program->name;?></h2>
                </header>
                <form action="<?php echo $this->config->item('link_program_sub_create').'?id='.$program->id_program; ?>" method="post" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Nama Sub Program:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Pengertian Sub Program:</label>
                            <div class="col-sm-9">
                                <textarea rows="5" name="introduction" class="form-control mceEditor"><?php echo set_value('introduction'); ?></textarea>
                                <?php echo form_error('introduction'); ?>
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
                                <textarea rows="5" name="target_participant" class="form-control mceEditor"><?php echo set_value('target_participant'); ?></textarea>
                                <?php echo form_error('target_participant'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Materi Pelatihan:</label>
                            <div class="col-sm-9">
                                <textarea rows="5" name="course_content" class="form-control mceEditor"><?php echo set_value('course_content'); ?></textarea>
                                <?php echo form_error('course_content'); ?>
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
                        <a type="button" class="btn btn-default" href="<?php echo $this->config->item('link_program_sub_lists').'?id='.$program->id_program; ?>">Batal</a>
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>