<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('companies'); ?></h3>
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
                    <?php $this->load->view('admin/users/_filters'); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr role="row">
                                <th width="20"><?php echo trans('id'); ?></th>
                                <th><?php echo trans('image'); ?></th>
                                <th><?php echo trans('company_name'); ?></th>
                                <th><?php echo trans('email'); ?></th>
                                <th><?= trans("membership_plan"); ?></th>
                                <th><?php echo trans('status'); ?></th>
                                <th><?php echo str_replace(":", "", trans("last_seen")); ?></th>
                                <th><?php echo trans('date'); ?></th>
                                <th class="max-width-120"><?php echo trans('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($users as $user) :
                                $membership_plan = $this->membership_model->get_user_plan_by_user_id($user->id); ?>
                                <tr>
                                    <td><?php echo html_escape($user->id); ?></td>
                                    <td>
                                        <img src="<?php echo get_user_avatar($user); ?>" alt="user" class="img-responsive" style="height: 50px;">
                                    </td>
                                    <td><?php echo html_escape($user->username); ?></td>
                                    <td>
                                        <?php echo html_escape($user->email);
                                        if ($user->email_status == 1) : ?>
                                            <small class="text-success">(<?php echo trans("confirmed"); ?>)</small>
                                        <?php else : ?>
                                            <small class="text-danger">(<?php echo trans("unconfirmed"); ?>)</small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= !empty($membership_plan) ? $membership_plan->plan_title : ''; ?></td>
                                    <td>
                                        <?php if ($user->banned == 0) : ?>
                                            <label class="label label-success"><?php echo trans('active'); ?></label>
                                        <?php else : ?>
                                            <label class="label label-danger"><?php echo trans('banned'); ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo time_ago($user->last_seen); ?></td>
                                    <td><?php echo formatted_date($user->created_at); ?></td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li>
                                                    <?php if ($user->banned == 0) : ?>
                                                        <?php if ($user->is_active_shop_request == 0) : ?>
                                                            <a href="javascript:void(0)" onclick="decline_user(<?php echo $user->id; ?>);"><i class="fa fa-times option-icon"></i><?php echo trans('close_user_shop'); ?></a>
                                                        <?php else : ?>
                                                            <a href="javascript:void(0)" onclick="decline_user(<?php echo $user->id; ?>);"><i class="fa fa-cart-plus option-icon"></i><?php echo trans('open_user_shop'); ?></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </li>
                                                <li>
                                                    <?php if ($user->email_status != 1) : ?>
                                                        <a href="javascript:void(0)" onclick="confirm_user_email(<?php echo $user->id; ?>);"><i class="fa fa-check option-icon"></i><?php echo trans('confirm_user_email'); ?></a>
                                                    <?php endif; ?>
                                                </li>
                                                <li>
                                                    <?php if ($user->is_active_shop_request == 0) : ?>
                                                        <?php if ($user->banned == 0) : ?>
                                                            <a href="javascript:void(0)" onclick="ban_remove_ban_user(<?php echo $user->id; ?>);"><i class="fa fa-stop-circle option-icon"></i><?php echo trans('ban_user'); ?></a>
                                                        <?php else : ?>
                                                            <a href="javascript:void(0)" onclick="ban_remove_ban_user(<?php echo $user->id; ?>);"><i class="fa fa-circle option-icon"></i><?php echo trans('remove_user_ban'); ?></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </li>
                                                <li>
                                                    <a href="<?php echo admin_url(); ?>edit-user/<?php echo $user->id; ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit_user'); ?></a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_user_post','<?php echo $user->id; ?>','<?php echo trans("confirm_user"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                    <?php if (empty($users)) : ?>
                        <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>