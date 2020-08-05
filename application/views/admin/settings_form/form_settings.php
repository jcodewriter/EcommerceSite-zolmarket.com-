<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped dataTable" id="cs_datatable" role="grid"
                                    aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?php echo trans('id'); ?></th>
                                    <th><?php echo trans('category_name'); ?></th>
                                    <th><?php echo trans('category_level'); ?></th>
                                    <th><?php echo trans('parent_category'); ?></th>
                                    <th class="th-options"><?php echo trans('options'); ?></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($categories as $key => $item): ?>
                                    <tr>
                                        <td><?php echo html_escape($key+1); ?></td>
                                        <td><?php echo html_escape($item->name); ?></td>
                                        <td><label class="label bg-gray label-table"><?php echo "level ".$item->category_level; ?></label></td>
                                        <td>
                                            <?php
                                            $parent = get_category($item->parent_id);
                                            if (!empty($parent)) {
                                                echo get_category_name_by_lang($parent->id, $selected_lang->id);
                                            } ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo admin_url(); ?>form-settings/<?php echo html_escape($item->id); ?>" class="btn btn-success "><i class="fa fa-edit option-icon"></i>Edit Form Setting</a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
    </div>
</div>

<style>
    .col-sm-12 label {
        margin-left: 10px;
		font-weight: 400 !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
    }
</style>
