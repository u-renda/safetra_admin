<form class="form-horizontal form-bordered mb-lg">
    <div class="form-group mt-lg">
        <label class="col-sm-3 control-label">Nama:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->name; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Logo:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><img src="<?php echo $result->logo; ?>"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Website:</label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $result->client_url; ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
