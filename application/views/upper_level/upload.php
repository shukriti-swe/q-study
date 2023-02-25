<div id="img_upload_error_msg" style="text-align:center;color:red">
</div><br>
<div class="col-sm-6 col-sm-offset-3">
    <div class="blue_photo bottom10">
        <a href="">Logo / Photo</a></div><br><br>
    <form action="<?php echo base_url(); ?>u_level_file-upload" class="dropzone" id="upload-widget">
        <div id="img_upload_msg">
        </div>
        <div class="fallback">
            <input name="file" type="file"/>
        </div>
        <div class="dz-message needsclick">
            <div class="ss_upload_text"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <br/> <span>Choose photo to Upload </span></div>

        </div>
    </form>
    <br>
    <br>
    <div class="text-center">

        <button class="btn btn_next" id="dropzone_submit_btn"><i class="fa fa-save" aria-hidden="true"></i>  submit</button>

    </div>
</div>
<br>
<br>
<script>

    Dropzone.options.uploadWidget = {
        paramName: 'file',
        maxFilesize: 2, //MB 
        maxFiles: 1, //photo quantity
        autoProcessQueue: false,
        dictDefaultMessage: 'Drag an image here to upload, or click to select one',
        acceptedFiles: 'image/*',
        init: function () {

            var xxx = this;
            $("#dropzone_submit_btn").on("click", function (e) {
                e.preventDefault();
                var filesInQueue = xxx.getQueuedFiles().length;
                if (filesInQueue == 0) {
                    $('#img_upload_error_msg').html('please select at least one file');
                } else {
                    xxx.processQueue();
                }
            });
            this.on('success', function (file, resp) {
                if (resp == 0) {
                    $('#img_upload_error_msg').html('image not uploaded');
                } else {
                    location.reload(true);
                }

            });
            this.on('error', function (file, resp) {
                $('#img_upload_msg').html('The image width minimum  50px and height minimum 50px');
            });
            this.on('thumbnail', function (file) {
                if (file.width < 50 || file.height < 50) {
                    file.rejectDimensions();
                }
                else {
                    file.acceptDimensions();
                }
            });
        },
        accept: function (file, done) {
            file.acceptDimensions = done;
            file.rejectDimensions = function () {
                done('The image width minimum  640px and height minimum 480px');
            };
        }
    };
</script>