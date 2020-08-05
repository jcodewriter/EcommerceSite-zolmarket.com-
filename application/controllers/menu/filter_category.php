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
	$parent = null;
	$type = 'menucat';
	$querystring = '';
	if (isset($_POST['parent']))
		$parent = $_POST['parent'];
	if (isset($_POST['type']))
		$type = $_POST['type'];
	if (isset($_POST['query']))
		$querystring = $_POST['query'];
	if($parent != null)
		$categories = get_subcategories_by_parent_id($parent);
	else
		$categories = get_subcategories_by_parent_id(0);
	
	if ($parent != null && $parent != 0):
		?>
		<li class="nav-item">
			<div class="nav-link has-event" href="<?= htmlspecialchars(generate_category_url(get_category($parent))) ?>" data-ajax="<?= $parent ?>" data-text="<?= $oops.' '.$_POST['text']?>">
				<div class="link-icon">
					<i class="fa fa-th-large float-none fa-fw fa-lg" aria-hidden="true" style="color:#fd7e14;"></i>
				</div>
				<span class="titre"><?php echo $oops; ?></span>
				<i class="icon-arrow-right"></i>
			</div>
		</li>
	<?php
	endif;	
	if (isset($_POST['back']) && $parent != 0 &&  get_category($parent)->parent_id != 0):
		?>
		<li id="btn-back-mobile-nav<?=$parent?>" class="nav-item" data-query="<?= htmlspecialchars($querystring) ?>"   data-type="<?= $type ?>" 
		data-text="<?= get_category_joined(get_category($parent)->parent_id)->name ?>"  data-ajax="<?= get_category($parent)->parent_id ?>"  data-url="filter_categories">
			
		</li>
	<?php
	endif;
	foreach ($categories as $category):
		?>
		<li class="nav-item text-left">
			<?php $hassub = has_subcategories_by_parent_id($category->id); ?>
			
			<div href="<?=  htmlspecialchars(!$hassub?generate_category_url($category) . $querystring:'javascript:void(0)') ?>" data-ajax="<?= $category->id ?>"
				<?php if ($hassub): ?>  data-type="<?= $type ?>"  data-query="<?=  htmlspecialchars($querystring) ?>" data-url="filter_categories"	<?php endif; ?>
				class="nav-link p-0 <?= $hassub?'has-menu':'has-event' ?>" data-text="<?= $category->name?>">
					<div class="link-icon">
						<?php if (!empty($category->icon)): ?>
							<img src="<?php echo get_category_image_url($category, 'icon'); ?>" alt=""
									style="height: 50px;width:50px;">
						<?php else: ?>
							<span style="height: 50px;width:50px;"></span>
						<?php endif; ?>
					</div>

					<span class="titre"><?php echo html_escape($category->name); ?></span>

					<i class="icon-arrow-right"></i>
			</div>
		</li>
	<?php
	endforeach;
	?>
	<li class="nav-item text-left mb-5">
	</li>