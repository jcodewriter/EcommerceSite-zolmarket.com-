<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-uploader/css/jquery.dm-uploader.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-uploader/css/styles.css" />
<script src="<?php echo base_url(); ?>assets/vendor/file-uploader/js/jquery.dm-uploader.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/file-uploader/js/demo-ui.js"></script>

<div class="dm-uploader-container">
    <div id="drag-and-drop-zone" class="dm-uploader text-center">
        <p class="dm-upload-icon">
            <i class="icon-upload"></i>
        </p>
        <p class="dm-upload-text"><?php echo trans("drag_drop_images_here"); ?>&nbsp;<span style="text-decoration: underline"><?php echo trans('browse_files'); ?></span></p>

        <a class='btn btn-md dm-btn-select-files'>
            <input type="file" name="file" size="40" multiple="multiple">
        </a>



        <div class="error-message error-message-img-upload">
            <p class="m-b-5 text-center">
            </p>
        </div>

    </div>
    <div style="margin-top:10px">
        <ul class="dm-uploaded-files" id="files-image">
            <?php if (!empty($modesy_images)) :
                foreach ($modesy_images as $modesy_image) : ?>
                    <li class="media">
                        <img src="<?php echo get_product_image_url($modesy_image, 'image_small'); ?>" alt="">
                        <a href="javascript:void(0)" class="btn-img-delete btn-delete-product-img" data-file-id="<?php echo $modesy_image->id; ?>">
                            <i class="icon-close"></i>
                        </a>
                        <?php if ($modesy_image->is_main == 1) : ?>
                            <a href="javascript:void(0)" class="badge badge-success badge-is-image-main btn-set-image-main"><?php echo trans("main"); ?></a>
                        <?php else : ?>
                            <a href="javascript:void(0)" class="badge badge-secondary badge-is-image-main btn-set-image-main" data-image-id="<?php echo $modesy_image->id; ?>" data-product-id="<?php echo $modesy_image->product_id; ?>"><?php echo trans("main"); ?></a>
                        <?php endif; ?>
                    </li>
            <?php endforeach;
            endif; ?>
        </ul>
    </div>
</div>

<p class="images-exp"><i class="icon-exclamation-circle"></i><?php echo trans("product_image_exp"); ?></p>


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
    $(document).ready(function() {
        $("form").submit(function(e) {
            if (!$(".dm-uploaded-files li").length) {
                $(".dm-uploader").css("border-color", "#edaab3")
                $(".images-exp").text("Please add at least one photo.");
                $(".images-exp").css("color", "#edaab3");
                $("html, body").animate({
                    scrollTop: 0
                }, 700);
                e.preventDefault();
            }
        })
    })

    $('#drag-and-drop-zone').dmUploader({
        url: '<?php echo base_url(); ?>file_controller/upload_image',
        maxFileSize: <?php echo $this->general_settings->max_file_size_image; ?>,
        queue: true,
        allowedTypes: 'image/*',
        extFilter: ["jpg", "jpeg", "png", "gif"],
        extraData: function(id) {
            return {
                "product_id": <?php echo $product->id; ?>
            };
        },
        onDragEnter: function() {
            this.addClass('active');
        },
        onDragLeave: function() {
            this.removeClass('active');
        },
        onInit: function() {},
        onComplete: function(id) {},
        onNewFile: function(id, file) {
            ui_multi_add_file(id, file, "image");
            if (typeof FileReader !== "undefined") {
                var reader = new FileReader();
                var img = $('#uploaderFile' + id).find('img');

                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        },
        onBeforeUpload: function(id) {
            $('#uploaderFile' + id + ' .dm-progress-waiting').hide();
            ui_multi_update_file_progress(id, 0, '', true);
            ui_multi_update_file_status(id, 'uploading', 'Uploading...');
        },
        onUploadProgress: function(id, percent) {
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data) {
            var obj = JSON.parse(data);
            var data = {
                "image_id": obj.image_id,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "file_controller/get_uploaded_image",
                data: data,
                success: function(response) {
                    document.getElementById("uploaderFile" + id).innerHTML = response;
                    $(".dm-uploader").css("border-color", "#eeeff1")
                    $(".images-exp").html(`<i class="icon-exclamation-circle"></i>Products with good and clear images are sold faster!`);
                    $(".images-exp").css("color", "#9B9B9B");
                }
            });
        },
        onUploadError: function(id, xhr, status, message) {
            if (message == "Not Acceptable") {
                $("#uploaderFile" + id).remove();
                $(".error-message-img-upload").show();
                $(".error-message-img-upload p").html("You can upload 5 files.");
                setTimeout(function() {
                    $(".error-message-img-upload").fadeOut("slow");
                }, 4000)
            }
        },
        onFallbackMode: function() {},
        onFileSizeError: function(file) {
            $(".error-message-img-upload").show();
            $(".error-message-img-upload p").html("<?php echo trans('file_too_large') . ' ' . formatSizeUnits($this->general_settings->max_file_size_image); ?>");
            setTimeout(function() {
                $(".error-message-img-upload").fadeOut("slow");
            }, 4000)
        },
        onFileTypeError: function(file) {},
        onFileExtError: function(file) {},
    });
</script>