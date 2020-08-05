<?php 
	$idiom = $this->session->userdata('modesy_selected_lang');
	if($idiom == 2){
		$this->config->set_item('language', 'العربية');
		$this->lang->load('site', 'العربية');
		$oops = $this->lang->line('all');
	}else{
		$this->config->set_item('language', 'default');
		$this->lang->load('site', 'default');
		$oops = $this->lang->line('all');
	}
?>

<?php


	    $search = null;
		$type = 'menucat';
		$querystring = '';
		
		if (isset($_POST['search']))
			$search = $_POST['search'];
			
		if (isset($_POST['query']))
			$querystring = $_POST['query'];
			
			
			
		foreach ($items['categories'] as $category):
			?>
			<li class="nav-item ">
				<a href="<?=  htmlspecialchars(generate_category_url($category) . $querystring) ?>"  class="nav-link p-0">
					    <div class="link-icon">
    						<?php if (!empty($category->icon)): ?>
    							<img src="<?php echo get_category_image_url($category, 'icon'); ?>" alt=""
    								 style="height: 40px;width:40px;">
    						<?php else: ?>
    							<span style="height: 40px;width:40px;"></span>
    						<?php endif; ?>
						</div>
						<div class="link-content">
							<span class="titre"><?php echo html_escape($category->name); ?></span>
						</div>
						<div class="link-action">
							<i class="icon-arrow-left"></i>
						</div>
				</a>
			</li>
		<?php
		endforeach;
		?>
		
			
		<?php	
		foreach ($items['products'] as $product):
			?>
			<li class="nav-item">
			   	<?php 
			   	    $category = null;/*
			   	if($product->category_id  != 0 && get_category($product->category_id)->top_parent_id != 0 )
			     $category  = get_category(get_category($product->category_id)->top_parent_id);  
			     else if($product->category_id != 0)
			     $category  = get_category($product->category_id); */ ?>
				
				
				<a href="<?= generate_product_url($product) . $querystring ?>"  class="nav-link p-0">
					    <div class="link-icon">
    						<?php if (!empty($product)): ?>
    							<span style="height: 40px;width:40px;"></span>
    						<?php else: ?>
    							<span style="height: 40px;width:40px;"></span>
    						<?php endif; ?>
						</div>
						<div class="link-content">
							<span class="titre"><?php echo  html_escape($product->title); ?></span>
						</div>
						<div class="link-action">
							<i class="icon-arrow-left"></i>
						</div>
				</a>
			</li>
		<?php
		endforeach;
		?>