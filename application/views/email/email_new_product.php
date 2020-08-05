<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('email/_header', ['title' => trans("email_text_new_product")]); ?>
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
                                <div style="text-align:center; height: 230px !important; width: 300px; margin: 0 auto;">
                                    <?php if (!(empty($img_src))) : ?>
                                        <img src="<?php echo $img_src;?>" style="width:300px;height: 230px !important;border-radius: 5px;object-fit: cover;">    
                                    <?php else: ?>    
                                        <img src="<?php echo "https://www.zolmarket.com/assets/img/no-image.png";?>" style="width:300px;height: 230px !important;border-radius: 5px;object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                                <p style='text-align: center; margin-top: 2px; margin-bottom: 2px;'>
                                    <?php echo html_escape($message_subject); ?>
                                </p>
                                <p style='text-align: center; margin-top: 2px; margin-bottom: 2px;'>
                                    <strong style="font-weight: 600;"><?php echo trans("username"); ?></strong>
                                </p>
                                <div style="display:flex;justify-content: center;">
                                    <?php if(!(empty($avatar))):?>
                                        <img src="<?php echo $avatar;?>" style="width:50px; height: 50px !important; border-radius: 50%">
                                    <?php else:?>
                                        <img src="https://www.zolmarket.com/assets/img/user.png" style="width:50px; height: 50px !important; border-radius: 50%">
                                    <?php endif;?>
                                </div>
                                <p style='text-align: center'>
                                    <?php echo html_escape($sender_name); ?>
                                </p>
                                <?php if (!(empty($mobile_number))) : ?>
                                    <p style='text-align: center'>
                                        <strong style="font-weight: 600;"><?php echo trans("phone_number"); ?></strong><br><?php echo html_escape($mobile_number); ?>
                                    </p>
                                <?php endif;?>    
                                <p style='text-align: center'>
                                    <strong style="font-weight: 600;"><?php echo trans("email_address"); ?></strong><br><?php echo html_escape($email_address); ?>
                                </p>
                                <p style='text-align: center'>
                                    <strong style="font-weight: 600;"><?php echo trans("location"); ?></strong><br><?php echo html_escape($location); ?>
                                </p>
                                <p style='text-align: center'>
                                    <?php echo trans("email_text_see_product"); ?>
                                </p>
                                <p style='text-align: center'>
                                    <a href='<?php echo $product_url; ?>' style='font-size: 14px;text-decoration: none;padding: 14px 40px;background-color: #09b1ba;color: #ffffff !important; border-radius: 3px;'>
                                        <?php echo trans("view_product"); ?>
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