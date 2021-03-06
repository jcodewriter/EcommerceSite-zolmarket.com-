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
                                <p style='text-align: center;margin-top: 5px;margin-bottom:20px'>
                                    <strong style="font-size: 18px; font-weight: 700;"><?php echo trans('email_new_product_review')?></strong>  
                                </p>
                                <div style="display: flex;text-align:left;">
                                    <a href="<?php echo lang_base_url() . 'product/' . $product->slug; ?>" style="height: 60px; width: 80px;">
                                        <?php if (!(empty($img_src))) : ?>
                                            <img src="<?php echo $img_src;?>" style="width:80px;height: 60px !important;border-radius: 5px;">    
                                        <?php else: ?>    
                                            <img src="<?php echo base_url()."uploads/profile/no-image.png";?>" style="width:80px;height: 60px !important;border-radius: 5px;object-fit: cover;">
                                        <?php endif; ?>
                                    </a>
                                    <div style="display: block; margin-left: 10px; font-weight: 600">
                                        <?php if(is_arabic($message_subject)): ?>
                                            <span style='position: absolute;display: block;white-space: nowrap;text-overflow: ellipsis;max-width: 200px;overflow: hidden;font-size: 14px !important;'>
                                                <?php echo html_escape($message_subject); ?>
                                            </span>
                                        <?php else: ?>
                                            <span style='position: absolute;display: block;white-space: nowrap;text-overflow: ellipsis;max-width: 200px;overflow: hidden;font-size: 14px !important;direction: rtl'>
                                                <?php echo html_escape($message_subject); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($product->is_sold == 1): ?>
                                			<strong class="lbl-price" style="color: #9a9a9a;font-weight: 600;text-decoration-line: line-through;"><?php echo print_price($product->price, $product->currency); ?></strong>
                                			<strong class="lbl-sold" style="font-weight: 600; color: #555"><?php echo trans("sold"); ?></strong>
                                		<?php elseif ($product->is_free_product == 1): ?>
                                			<strong class="lbl-free"><?php echo trans("free"); ?></strong>
                                		<?php else: ?>
                                			<strong class="lbl-price" style="color: green;font-weight: 600;"><?php echo print_price($product->price, $product->currency); ?></strong>
                                		<?php endif; ?>
                                    </div>
                                </div>
                                <div style="display: flex;text-align:left;margin-top: 15px;">
                                    <?php if(!(empty($sender_avatar))):?>
                                        <img src="<?php echo base_url().$sender_avatar;?>" style="width:50px; height: 50px !important; border-radius: 50%">
                                    <?php else:?>
                                        <img src="<?php echo base_url().'uploads/profile/user.png';?>" style="width:50px; height: 50px !important; border-radius: 50%">
                                    <?php endif;?>
                                    
                                    <div style="background-color: #eff2f5;padding: 5px 15px;margin-left: 5px;border-radius: 5px;max-width: 70%;">
                                        <?php if(is_arabic($sender_name)): ?>
                                            <span class="" style="font-size: 14px !important;font-weight: 600;display: block;width: 100%;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;height:24px;"><?php echo $sender_name;?></span>
                                        <?php else: ?>
                                            <span class="" style="font-size: 14px !important;font-weight: 600;display: block;width: 100%;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;height:24px;direction: rtl"><?php echo $sender_name;?></span>
                                        <?php endif; ?>
                                        <span style="text-align: center; display:block">
                                            <?php if($rating == 1): ?>
                                                ⭐️
                                            <?php elseif($rating == 2): ?>    
                                                ⭐️⭐️
                                            <?php elseif($rating == 3): ?>    
                                                ⭐️⭐️⭐️
                                            <?php elseif($rating == 4): ?>    
                                                ⭐️⭐️⭐️⭐
                                            <?php elseif($rating == 5): ?>    
                                                ⭐️⭐️⭐️⭐⭐
                                            <?php endif;?>    
                                        </span>
                                        <span class="" style="display: block;word-break: break-word;font-size: 12px !important;"><?php echo $reviews;?></span>        
                                    </div>
                                </div>
                                <p style='text-align: center;margin-top: 40px;margin-bottom: 15px;'>
                                    <a href="<?php echo lang_base_url() . 'product/' . $product->slug; ?>" style="display: block;padding: 14px 0;width: 100%; max-width: 375px;font-size: 14px;text-decoration: none;background-color: #09b1ba;color: #ffffff !important; border-radius: 3px;margin: 0 auto;" target="_blank" rel="noreferrer nofollow noopener"><?php echo trans("visit_review"); ?> </a>
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
