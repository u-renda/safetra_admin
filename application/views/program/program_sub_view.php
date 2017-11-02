<form class="form-horizontal form-bordered mb-lg">
    <div class="form-group mt-lg">
        <label class="col-sm-3 control-label">Nama:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->name; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Pengertian Program:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->introduction; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Tujuan Pelatihan:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->training_purpose; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Persyaratan Peserta:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->target_participant; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Materi Pelatihan:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->course_content; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Lainnya:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->others; ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
