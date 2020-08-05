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

        $types  = array('country','state','city');
	    $parent = null;
		if (isset($_POST['type']))
			$type = $_POST['type'];
		if (isset($_POST['parent']))
			$parent = $_POST['parent'];
		if (isset($_POST['type'])){
			if($_POST['type'] == "country"){
			    $oldtype = $types[0];
			    $currenttype = $types[0];
			    $nexttype = $types[1];
			    
			}
			
			if($_POST['type'] == "state"){
			    $oldtype = $types[0];
			    $currenttype = $types[1];
			    $nexttype = $types[2];
			    
			}
			
			if($_POST['type'] == "city"){
			    $oldtype = $types[1];
			    $currenttype = $types[2];
			    $nexttype = $types[2];
			    
			}
		}
		if ($parent != null && $currenttype == 'state'):
			?>
            <li class="nav-item">
				<label
					onclick="$('input[name=country]').prop('disabled', true)
							 $('input[name=<?= $nexttype ?>]').prop('disabled', true) 
							 $('input[name=<?=$currenttype?>]').prop('disabled', true)
							 $('.ajax-filter-menu').find('.navCatDownMobile.nav-mobile').slice(1,10).remove()
							 $('.location-name').text(`<?= $currenttype == 'state'?trans('all_states_cities'):$_POST['other_text'].','.trans('all_cities')?>`)"
							 data-text="<?= $_POST['text']?>" class="nav-link" >
                    <div class="link-icon">
                        <i class="fa fa-th-large float-none fa-fw fa-lg" aria-hidden="true" style="color:#fd7e14;"></i>
                    </div>
                     <?php echo trans("all"); ?>
                    <i class="icon-arrow-right"></i>
                </label>
            </li>
		<?php
		endif;
		if ($parent != null && $currenttype == 'city'):
			?>
            <li class="nav-item">
				<label
					onclick="$('input[name=<?= $nexttype ?>]').prop('disabled', true) 
							 $('input[name=<?=$currenttype?>]').prop('disabled', true)
							 $('.ajax-filter-menu').find('.navCatDownMobile.nav-mobile').slice(1,10).remove()
							 $('.location-name').text(`<?= $currenttype == 'state'?trans('all_states_cities'):$_POST['other_text'].','.trans('all_cities')?>`)"
							 data-text="<?= $_POST['text']?>" class="nav-link" >
                    <div class="link-icon">
                        <i class="fa fa-th-large float-none fa-fw fa-lg" aria-hidden="true" style="color:#fd7e14;"></i>
                    </div>
                     <?php echo trans("all"); ?>
                    <i class="icon-arrow-right"></i>
                </label>
            </li>
		<?php
		endif;
		
		foreach ($items as $item):
			?>
			<li class="nav-item text-left">
				<?php if ($currenttype != "city"): ?>
					<label
						onclick="$('input[name=<?= $nexttype ?>]').val(-1)
						$('input[name=<?=$currenttype?>]').val(<?=$item->id?>)
						$('.location-name').text(`<?= $item->name?>`)"
						data-type="<?= $nexttype ?>"  data-ajax="<?= $item->id ?>" 	data-url="filter_location"
						data-text="<?= $item->name?>"
						header-text="<?= $currenttype == "country"?trans("states"):trans("cities")?>"
						class="nav-link p-0 has-menu">
				<?php else: ?>		
					<label
						onclick="$('input[name=<?= $nexttype ?>]').val(-1)
						$('input[name=<?=$currenttype?>]').val(<?=$item->id?>)
						$('.ajax-filter-menu').find('.navCatDownMobile.nav-mobile').slice(1,10).remove()
						$('.location-name').text(`<?= $_POST['other_text'].','.$item->name?>`)"
						data-text="<?= $item->name?>"
						class="nav-link p-0">
				<?php endif; ?>
					    <div class="link-icon">
    						<?php if (!empty($item->icon)): ?>
    							<img  alt=""
    								 style="height: 50px;width:50px;">
    						<?php else: ?>
    							<span style="height: 50px;width:50px;"></span>
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