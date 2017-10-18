<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label marginbottom0"><u>Name:</u></label>
            <div class="form-control-static paddingtop0"><?php echo ucwords($name); ?></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label marginbottom0"><u>Role:</u></label>
            <div class="form-control-static paddingtop0"><?php echo $role; ?></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label marginbottom0"><u>Username:</u></label>
            <div class="form-control-static paddingtop0"><?php echo $username; ?></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label marginbottom0"><u>Email:</u></label>
            <div class="form-control-static paddingtop0"><?php echo $email; ?></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label marginbottom0"><u>Status:</u></label>
            <div class="form-control-static paddingtop0"><?php echo $status; ?></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label marginbottom0"><u>Job Title:</u></label>
            <div class="form-control-static paddingtop0"><?php echo $job_title; ?></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label marginbottom0"><u>Photo:</u></label>
            <img class="paddingtop0 paddingbottom10 fullwidth" src="<?php echo $photo; ?>" alt="<?php echo ucwords($name); ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 margintop15">
        <button type="button" class="btn pull-right" data-dismiss="modal">Close</button>
    </div>
</div>