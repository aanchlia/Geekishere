<script type="text/javascript" src="assets\js\bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="assets\css\bootstrap.css">

<form class="form-horizontal" id="onwer_form" method="post" action="<?php echo base_url()?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Add your property here</legend>
        <span class="alert-success"><?php echo $message;?></span>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Name">Name</label>
            <div class="col-md-6">
                <input id="Name" name="Name" type="text" placeholder="Cassandra Abbott" class="form-control input-md" required="">
                <span class="help-block"></span>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Email">Email Id</label>
            <div class="col-md-6">
                <input id="Email" name="Email" type="text" placeholder="abc@def.com" class="form-control input-md" required="">
                <span class="help-block"></span>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Phone">Phone</label>
            <div class="col-md-6">
                <input id="Phone" name="Phone" type="text" placeholder="123-456-7890" class="form-control input-md" required="">
                <span class="help-block"></span>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Type">Type</label>
            <div class="col-md-6">
                <input id="Type" name="Type" type="text" placeholder="Type" class="form-control input-md">
                <span class="help-block"></span>
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Location">Location</label>
            <div class="col-md-4">
                <textarea class="form-control" id="Location" name="Location"></textarea>
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="BUA">BUA</label>
            <div class="col-md-4">
                <textarea class="form-control" id="BUA" name="BUA"></textarea>
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Carpet">Carpet</label>
            <div class="col-md-4">
                <textarea class="form-control" id="Carpet" name="Carpet"></textarea>
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Amenities">Amenities</label>
            <div class="col-md-4">
                <textarea class="form-control" id="Amenities" name="Amenities"></textarea>
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Description">Description</label>
            <div class="col-md-4">
                <textarea class="form-control" id="Description" name="Description"></textarea>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="save"></label>
            <div class="col-md-4">
                <button id="save" name="save" class="btn btn-primary">Save</button>
            </div>
        </div>

    </fieldset>
</form>
