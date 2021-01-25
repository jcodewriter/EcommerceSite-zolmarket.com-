<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-12">
		<div class="product-description" style="margin-bottom: 10px;">
			<h4  style="<?= $this->selected_lang->id == 2 ? 'float: right;margin-right:30px' : '' ?>" class="section-title"><?php echo trans("description"); ?></h4>
			<div style="<?= $this->selected_lang->id == 2 ? 'text-align: right;' : '' ?>font-weight: bold;" class="description">
				<?php echo $product->description; ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="row-custom row-bn">
			<!--Include banner-->
			<?php $this->load->view("partials/_ad_spaces", ["ad_space" => "product", "class" => "m-b-30"]); ?>
		</div>
	</div>
</div>
