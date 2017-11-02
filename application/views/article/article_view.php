<form class="form-horizontal form-bordered mb-lg">
    <div class="form-group mt-lg">
        <label class="col-sm-2 control-label">Judul:</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?php echo $result->title; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Isi:</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?php echo $result->content; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto:</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?php echo $result->media; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Tags:</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?php echo $result->tags; ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
