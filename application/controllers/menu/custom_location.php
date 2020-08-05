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
<li class="nav-item">
	<input type="text" oninput="filterMenuItems(this)" maxlength="300" class="form-control input-search m-0" placeholder="<?php echo trans('search');?>" >
</li>
<?php

        $types  = array('country_id','state_id','city_id');
	    $parent = null;
		if (isset($_POST['type']))
			$type = $_POST['type'];
		if (isset($_POST['parent']))
			$parent = $_POST['parent'];
		if (isset($_POST['type'])){
			if($_POST['type'] == "country_id"){
			    $oldtype = $types[0];
			    $currenttype = $types[0];
			    $nexttype = $types[1];
			    
			}
			
			if($_POST['type'] == "state_id"){
			    $oldtype = $types[0];
			    $currenttype = $types[1];
			    $nexttype = $types[2];
			    
			}
			
			if($_POST['type'] == "city_id"){
			    $oldtype = $types[1];
			    $currenttype = $types[2];
			    $nexttype = $types[2];
			    
			}
		}
		
		foreach ($items as $item):
			?>
			<li class="nav-item text-left">
				<label onclick="
					$('select[name=<?= $nexttype ?>]').val(-1) 
					$('select[name=<?=$currenttype?>]').val(<?=$item->id?>).trigger('change') 
					<?php if ($currenttype == 'city_id' || $item->cnt == 1):?>
						$('html').removeClass('disable-body-scroll'); 
						$('body').removeClass('disable-body-scroll');
						$('.ajax-filter-menu').children().each(function(key){
							if (key > 1){
								$(this).remove()
							}
						});
					<?php endif;?>
					<?php if ($currenttype == 'state_id'):?>
						$('#city_button').text(`<?php echo html_escape($item->name); ?>`)
					<?php else:?>	
						$('#city_button').append(`<?php echo ' / '.html_escape($item->name); ?>`)
					<?php endif;?>"
				   	<?php if ($currenttype != "city_id"): ?>  data-type="<?= $nexttype ?>"  data-ajax="<?= $item->id ?>" 	data-url="custom_location"	<?php endif; ?>
				   		class="nav-link p-0 <?= ($type != "city_id" && $item->cnt > 1)?'has-menu':'' ?>">
					    <div class="link-icon">
    						<?php if (!empty($item->icon)): ?>
    							<img alt="" style="height: 50px;width:40px;">
    						<?php else: ?>
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