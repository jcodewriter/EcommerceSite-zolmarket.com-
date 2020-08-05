<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("choose_image_view"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('admin_controller/navigation_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
                <div class="form-group">
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="m-b-15"><?php echo trans("mobile"); ?></label>
                        <div class="mobile product-view-method m-b-15">
                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 1) ? 'active' : ''; ?>" mobile-image-id="1">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-list" class="svg-inline--fa fa-th-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path></svg>
                            </div>
                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 2) ? 'active' : ''; ?>" mobile-image-id="2">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="square" class="svg-inline--fa fa-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path></svg>
                            </div>
                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 3) ? 'active' : ''; ?>" mobile-image-id="3">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th" class="svg-inline--fa fa-th fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M149.333 56v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zm181.334 240v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm32-240v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24zm-32 80V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm-205.334 56H24c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm386.667-56H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm0 160H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zM181.333 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24z"></path></svg>
                            </div>
                        </div>
                        <div class="mobile product-view-method-select m-b-15">
                            <div class="view-icon-select" mobile-image-id="1">
                                <input type="radio" name="choose_image_view_mobile" value="1" id="choose_image_view_mobile"
                                        class="square-purple" <?php echo ($general_settings->choose_image_view_mobile == 1) ? 'checked' : ''; ?>>
                            </div>
                            <div class="view-icon-select" mobile-image-id="2">
                                <input type="radio" name="choose_image_view_mobile" value="2" id="choose_image_view_mobile"
                                        class="square-purple" <?php echo ($general_settings->choose_image_view_mobile == 2) ? 'checked' : ''; ?>>
                            </div>
                            <div class="view-icon-select" mobile-image-id="3">
                                <input type="radio" name="choose_image_view_mobile" value="3" id="choose_image_view_mobile"
                                        class="square-purple" <?php echo ($general_settings->choose_image_view_mobile == 3) ? 'checked' : ''; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="m-b-15"><?php echo trans("desktop"); ?></label>
                        <div class="desktop product-view-method m-b-15">
                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 1) ? 'active' : ''; ?>" desktop-image-id="1">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-list" class="svg-inline--fa fa-th-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path></svg>
                            </div>
                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 2) ? 'active' : ''; ?>" desktop-image-id="2">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="square" class="svg-inline--fa fa-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path></svg>
                            </div>
                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 3) ? 'active' : ''; ?>" desktop-image-id="3">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th" class="svg-inline--fa fa-th fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M149.333 56v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zm181.334 240v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm32-240v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24zm-32 80V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm-205.334 56H24c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm386.667-56H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm0 160H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zM181.333 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24z"></path></svg>
                            </div>
                        </div>
                        <div class="desktop product-view-method-select m-b-15">
                            <div class="view-icon-select" desktop-image-id="1">
                                <input type="radio" name="choose_image_view_desktop" value="1" id="choose_image_view_desktop"
                                        class="square-purple" <?php echo ($general_settings->choose_image_view_desktop == 1) ? 'checked' : ''; ?>>
                            </div>
                            <div class="view-icon-select" desktop-image-id="2">
                                <input type="radio" name="choose_image_view_desktop" value="2" id="choose_image_view_desktop"
                                        class="square-purple" <?php echo ($general_settings->choose_image_view_desktop == 2) ? 'checked' : ''; ?>>
                            </div>
                            <div class="view-icon-select" desktop-image-id="3">
                                <input type="radio" name="choose_image_view_desktop" value="3" id="choose_image_view_desktop"
                                        class="square-purple" <?php echo ($general_settings->choose_image_view_desktop == 3) ? 'checked' : ''; ?>>
                            </div>
                        </div> 
                    </div>
                    
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>