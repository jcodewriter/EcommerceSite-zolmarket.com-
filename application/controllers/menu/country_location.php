<?php
$idiom = $this->session->userdata('modesy_selected_lang');
if ($idiom == 2) {
	$this->config->set_item('language', 'العربية');
	$this->lang->load('site', 'العربية');
	$oops = $this->lang->line('all');
} else {
	$this->config->set_item('language', 'default');
	$this->lang->load('site', 'default');
	$oops = $this->lang->line('all');
}
?>

<li class="nav-item">
	<input type="text" oninput="filterMenuItems(this)" maxlength="300" class="form-control input-search m-0" placeholder="<?php echo trans('search') ?>">
</li>
<?php
foreach ($items as $item) :
?>
	<li class="nav-item text-left">
		<label onclick=" $('select[name=country_id]').val(<?= $item->id ?>).trigger('change') 
				$('html').removeClass('disable-body-scroll')
				$('body').removeClass('disable-body-scroll')
				$('.ajax-filter-menu').children().each(function(key){
					if (key > 1){
						$(this).remove()
					}
				})
				$('.country-btn').css({
					'border-width': '1px',
					'border-color': '#404041'
				});
				$('button[name=state]').attr('data-ajax', '<?= $item->id ?>')
				$('#country_button').text(`<?php echo html_escape($item->name); ?>`)" class="nav-link p-0">
			<div class="link-icon">
				<?php if (!empty($item->icon)) : ?>
					<img alt="" style="height: 50px;width:40px;">
				<?php else : ?>
					<span style="height: 50px;width:40px;"></span>
				<?php endif; ?>
			</div>
			<span class="titre"><?php echo html_escape($item->name); ?></span>
			<i class="icon-arrow-right"></i>
		</label>
	</li>
<?php
endforeach;
?>
<li class="nav-item text-left mb-5">
</li>