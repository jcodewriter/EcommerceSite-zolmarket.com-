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
	<input type="text" oninput="filterMenuItems(this)" maxlength="300" class="form-control input-search m-0" placeholder="<?php echo trans('search'); ?>">
</li>
<?php
foreach ($items['items'] as $item) :
?>
	<li class="nav-item text-left">
		<?php if ($items['type'] == 'input') : ?>
			<label onclick=" $('input[name=<?php echo $_POST['type'] ?>]').val('<?= $item->field_option ?>').trigger('change'); $('span[name=<?php echo $_POST['type'] ?>]').text('<?= $item->field_option ?>'); $('.ajax-filter-menu').find('.navCatDownMobile.nav-mobile').slice(2,10).remove()" class="nav-link p-0">
			<?php elseif ($items['type'] == 'select') : ?>
				<label onclick=" $('select[name=field_<?php echo $item->field_id ?>]').val('<?= $item->common_id ?>');  $('span[name=field_<?php echo $item->field_id ?>]').text('<?= $item->field_option ?>')" class="nav-link p-0 remove-menu">
				<?php endif; ?>
				<span class="titre"><?php echo html_escape($item->field_option); ?></span>
				</label>
	</li>
<?php
endforeach;
?>
<li class="nav-item text-left mb-5">
</li>