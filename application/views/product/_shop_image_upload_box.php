<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-uploader/css/jquery.dm-uploader.min.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-uploader/css/styles.css"/>
<script src="<?php echo base_url(); ?>assets/vendor/file-uploader/js/jquery.dm-uploader.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/file-uploader/js/demo-ui.js"></script>

<div class="dm-uploader-container">
    <div id="drag-and-drop-zone" class="dm-uploader text-center" style="padding: 0; min-height: 150px;">
        <?php if (!empty(get_user_avatar($this->auth_user))):?>
            <p class="dm-upload-icon" style="display: none">
                <i class="icon-upload"></i>
            </p>
            <p class="dm-upload-text" style="display: none"><?php echo trans("drag_drop_images_here"); ?>&nbsp;<span style="text-decoration: underline"><?php echo trans('browse_files'); ?></span></p>
        <?php else:?>
            <p class="dm-upload-icon">
                <i class="icon-upload"></i>
            </p>
            <p class="dm-upload-text"><?php echo trans("drag_drop_images_here"); ?>&nbsp;<span style="text-decoration: underline"><?php echo trans('browse_files'); ?></span></p>
        <?php endif;?>
        <a class='btn dm-btn-select-files'>
            <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" multiple />
        </a>

        <ul class="dm-uploaded-file" id="files-image">
            <?php if (!empty(get_user_avatar($this->auth_user))):?>
                <li class="media" id="uploaderFile<?php echo $this->auth_user->id; ?>">
                    <img src="<?php echo get_user_avatar($this->auth_user);?>" alt="">
                    <a href="javascript:void(0)" class="btn-img-delete btn-delete-product-img-session" data-file-id="<?php echo $this->auth_user->id; ?>">
                        Select Image
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="error-message error-message-img-upload">
            <p class="m-b-5 text-center">
            </p>
        </div>

    </div>

</div>

<!-- File item template -->
<script type="text/html" id="files-template-image">
    <li class="media">
        <img class="preview-img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="bg">
        <div class="media-body">
            <div class="progress">
                <div class="dm-progress-waiting"><?php echo trans("waiting"); ?></div>
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </li>
</script>

<script>
    $(function () {
        $('#drag-and-drop-zone').dmUploader({
            url: '<?php echo base_url(); ?>file_controller/upload_avatar_image',
            maxFileSize: <?php echo $this->general_settings->max_file_size_image; ?>,
            multiple: 0,
            queue: true,
            allowedTypes: 'image/*',
            extFilter: ["jpg", "jpeg", "png", "gif"],
            extraData: function (id) {
                return {
                    "file_id": id
                };
            },
            onDragEnter: function () {
                this.addClass('active');
            },
            onDragLeave: function () {
                this.removeClass('active');
            },
            onInit: function () {
            },
            onComplete: function (id) {
            },
            onNewFile: function (id, file) {
                // console.log("here")
                $('.dm-upload-icon').css('display', 'none');
                $('.dm-upload-text').css('display', 'none');
                ui_multi_add_file(id, file, "image");
                if (typeof FileReader !== "undefined") {
                    var reader = new FileReader();
                    var img = $('#uploaderFile' + id).find('img');

                    reader.onload = function (e) {
                        img.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            },
            onBeforeUpload: function (id) {
                $('#uploaderFile' + id + ' .dm-progress-waiting').hide();
                ui_multi_update_file_progress(id, 0, '', true);
                ui_multi_update_file_status(id, 'uploading', 'Uploading...');
            },
            onUploadProgress: function (id, percent) {
                ui_multi_update_file_progress(id, percent);
            },
            onUploadSuccess: function (id, data) {
                var data = {
                    "file_id": id,
                };
                data[csfr_token_name] = $.cookie(csfr_cookie_name);
                $.ajax({
                    type: "POST",
                    url: base_url + "file_controller/get_sess_uploaded_avatar",
                    data: data,
                    success: function (response) {
                        document.getElementById("uploaderFile" + id).innerHTML = response;
                    }
                });
                ui_multi_update_file_status(id, 'success', 'Upload Complete');
                ui_multi_update_file_progress(id, 100, 'success', false);
            },
            onUploadError: function (id, xhr, status, message) {
                if (message == "Not Acceptable") {
                    $("#uploaderFile" + id).remove();
                    $(".error-message-img-upload").show();
                    $(".error-message-img-upload p").html("You can upload 5 files.");
                    setTimeout(function () {
                        $(".error-message-img-upload").fadeOut("slow");
                    }, 4000)
                }
            },
            onFallbackMode: function () {
            },
            onFileSizeError: function (file) {
                $(".error-message-img-upload").show();
                $(".error-message-img-upload p").html("<?php echo trans('file_too_large') . ' ' . formatSizeUnits($this->general_settings->max_file_size_image); ?>");
                setTimeout(function () {
                    $(".error-message-img-upload").fadeOut("slow");
                }, 4000)
            },
            onFileTypeError: function (file) {
            },
            onFileExtError: function (file) {
            },
        });
    });
</script>

