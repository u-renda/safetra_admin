<form class="form-horizontal form-bordered mb-lg">
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->name; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Username:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->username; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->email; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Foto:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><img src="<?php echo $result->photo; ?>" style="max-height: 300px;"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Peran di web:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $code_admin_role[$result->role]; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Jabatan:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->job_title; ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
