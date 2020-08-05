<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('email/_header', ['title' => trans("you_have_new_order")]); ?>
    <!-- START CENTERED WHITE CONTAINER -->
    <table role="presentation" class="main">
        <!-- START MAIN CONTENT AREA -->
        <tr>
            <td class="wrapper">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <div class="mailcontent" style="line-height: 15px;font-size: 14px;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="width:50px !important;vertical-align: middle !important;"><img src="<?php echo lang_base_url() . $icon_image;?>" style="width:50px;height: 50px !important;border-radius: 5px;"></td>
                                        <td style="text-align:center;vertical-align: middle !important;"><strong style="font-size: 16px;line-height: 26px;"><?php echo $subject;?></strong></td>
                                    </tr>
                                </table>    
                                <!--<p style='text-align: center;margin-top: 5px;margin-bottom:10px'>-->
                                      
                                <!--</p>-->
                                <div style="text-align:center;">
                                    <a href="<?php echo lang_base_url() . 'add-post'; ?>" style="text-align:center; height: 230px; width: 300px; margin: 0 auto;">
                                        <img src="<?php echo lang_base_url().$shop_image;?>" style="width:300px;height: 230px !important;border-radius: 5px;">    
                                    </a>    
                                </div>
                                <p style='text-align: center;margin-top: 5px;'>
                                    <strong style="font-size: 17px;font-weight: 700;"><?php echo html_escape($shop_name); ?></strong>
                                </p>
                                <p style='text-align: center;margin-top: 30px;'>
                                    <a href="<?php echo lang_base_url() . $slug; ?>" style="font-size: 14px;text-decoration: none;padding: 14px 40px;background-color: #09b1ba;color: #ffffff !important; border-radius: 3px; margin-top:20px;" target="_blank" rel="noreferrer nofollow noopener"><?php echo trans("add_post_ex"); ?> </a>
                                </p>    
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- END MAIN CONTENT AREA -->
    </table>
<?php $this->load->view('email/_footer'); ?>
