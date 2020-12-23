<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo $title; ?> - <?php echo $language->name; ?></h3>
        </div>
    </div><!-- /.box-header -->


    <div class="box-body">
        <div class="row">
            <!-- include message block -->
            <div class="col-sm-12">
                <?php $this->load->view('admin/includes/_messages'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <?php $this->load->view('admin/language/_filter_translations', ['tab' => 1]); ?>
                    <div class="tab-content">

                        <?php for ($i = 1; $i <= $tab_count; $i++) : ?>

                            <div id="tab<?php echo $i; ?>" class="tab-pane fade <?php echo ($page == $i) ? 'in active' : ''; ?>">

                                <?php echo form_open('language_controller/update_phrases_post'); ?>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $language->id; ?>">
                                <input type="hidden" name="file_name" class="form-control" value="<?php echo $file_name; ?>">
                                <input type="hidden" id="lang_folder" class="form-control" value="<?php echo $language->folder_name; ?>">

                                <table class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th><?php echo trans('phrase'); ?></th>
                                            <th><?php echo trans('label'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $count = 1; ?>
                                        <?php foreach ($phrases as $item) : ?>

                                            <?php if ($count > ($i - 1) * 50 && $count <= $i * 50) : ?>
                                                <tr class="tr-phrase">
                                                    <td style="width: 50px;"><?php echo $count; ?></td>
                                                    <td style="width: 40%;"><input type="text" name="phrase[]" class="form-control" value="<?php echo $item["phrase"]; ?>" <?php echo ($language->text_direction == "rtl") ? 'dir="rtl"' : ''; ?> readonly></td>
                                                    <td style="width: 60%;"><input type="text" name="label[]" class="form-control" value="<?php echo $item["label"]; ?>" <?php echo ($language->text_direction == "rtl") ? 'dir="rtl"' : ''; ?>></td>
                                                </tr>
                                            <?php endif; ?>

                                            <?php $count++; ?>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>

                                <div class="col-sm-12 m-t-30">
                                    <div class="row">
                                        <div class="pull-right">
                                            <a href="<?php echo admin_url(); ?>languages" class="btn btn-danger m-r-5"><?php echo trans('back'); ?></a>
                                            <button type="submit" class="btn btn-primary"><?php echo trans('save_changes'); ?></button>
                                        </div>
                                    </div>
                                </div>

                                <?php echo form_close(); ?>
                                <!-- form end -->

                            </div>
                        <?php endfor; ?>
                    </div>

                    <div class="col-sm-12 m-t-30">
                        <div class="row">
                            <div class="text-center">
                                <ul class="pagination">
                                    <?php for ($i = 1; $i <= $tab_count; $i++) : ?>
                                        <li class="<?php echo ($page == $i) ? 'active' : ''; ?>">
                                            <a href="<?php echo admin_url(); ?>update-phrases/<?php echo $language->id; ?>?page=<?php echo $i; ?>&file_name=<?php echo $file_name; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>

    <?php if ($language->text_direction == "rtl") : ?>
        <link href="<?php echo base_url(); ?>assets/admin/css/rtl.css" rel="stylesheet" />
    <?php endif; ?>