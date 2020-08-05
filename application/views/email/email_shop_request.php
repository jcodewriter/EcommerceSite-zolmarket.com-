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
                            <div class="mailcontent" style="line-height: 20px;font-size: 14px;">
                                <p style='text-align: center;margin-top: 5px;margin-bottom:10px'>
                                    <strong style="font-size: 16px; font-weight: 700;"><?php echo $subject;?></strong>  
                                </p>
                                <p style='text-align: center;margin-top: 5px;'>
                                    <?php echo trans("there_is_shop_opening_request"); ?><br>
                                </p>
                                <div style="text-align:center;">
                                    <a href="<?php echo $email_link; ?>" style="text-align:center; height: 230px; width: 300px; margin: 0 auto;">
                                        <img src="<?php echo $img_src;?>" style="width:300px;height: 230px !important;border-radius: 5px;">    
                                    </a>    
                                </div>
                                <p style='text-align: center;margin-top: 5px;'>
                                    <?php echo html_escape($shopname); ?>
                                </p>
                                <p style='text-align: center;margin-top: 5px; margin-bottom: 5px;'>
                                    <strong style="font-weight: 600;"><?php echo trans("username"); ?></strong>
                                </p>
                                <div style="text-align: center">
                                    <?php if(!(empty($img_src))):?>
                                        <img src="<?php echo $img_src;?>" style="width:50px; height: 50px !important; border-radius: 50%">
                                    <?php else:?>
                                        <img src="https://www.zolmarket.com/assets/img/user.png" style="width:50px; height: 50px !important; border-radius: 50%">
                                    <?php endif;?>
                                </div>
                                <p style='text-align: center'>
                                    <?php echo $shopname; ?>
                                </p>
                                <p style='text-align: center'>
                                    <strong style="font-weight: 600;"><?php echo trans("phone_number"); ?></strong><br><?php echo html_escape($phone); ?>
                                </p>
                                <p style='text-align: center'>
                                    <strong style="font-weight: 600;"><?php echo trans("email_address"); ?></strong><br><?php echo html_escape($email); ?>
                                </p>
                                <p style='text-align: center'>
                                    <strong style="font-weight: 600;"><?php echo trans("location"); ?></strong><br><?php echo html_escape($location); ?>
                                </p>
                                <p style='text-align: center;margin-top: 30px;'>
                                    <a href="<?php echo $email_link; ?>" style='font-size: 14px;text-decoration: none;padding: 14px 40px;background-color: #09b1ba;color: #ffffff !important; border-radius: 3px;'>
                                        <?php echo html_escape($email_button_text); ?>
                                    </a>
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
