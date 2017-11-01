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
                    <h2 class="panel-title">Ubah Data</h2>
                </header>
                <form action="<?php echo $this->config->item('link_program_edit').'?id='.$id; ?>" method="post" class="form-horizontal form-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span> Nama Program:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name', $result->name); ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div id="additional">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><span class="text-danger">*</span> Pengertian Program:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="introduction" class="form-control mceEditor"><?php echo set_value('introduction', $result->introduction); ?></textarea>
                                    <?php echo form_error('introduction'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Tujuan Pelatihan:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="training_purpose" class="form-control mceEditor"><?php echo set_value('training_purpose', $result->training_purpose); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Persyaratan Peserta:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="target_participant" class="form-control mceEditor"><?php echo set_value('target_participant', $result->target_participant); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Materi Pelatihan:</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="course_content" class="form-control mceEditor"><?php echo set_value('course_content', $result->course_content); ?></textarea>
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
                        <input type="submit" class="btn btn-primary" name="submit" value="Ubah" id="submit_program_edit" />
                        <a type="button" class="btn btn-default" href="<?php echo $this->config->item('link_program_lists'); ?>">Batal</a>
                    </footer>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>