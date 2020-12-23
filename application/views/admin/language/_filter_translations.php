<div class="row">
    <div class="col-sm-12">
        <?php echo form_open(admin_url() . "search-phrases", ['method' => 'get']); ?>
        <div class="phrases-search">
            <input type="hidden" name="id" value="<?php echo $language->id; ?>">
            <input type="hidden" name="file_name" value="<?php echo $file_name; ?>">
            <input type="text" name="q" class="form-control" placeholder="<?php echo trans("search") ?>" required>
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>