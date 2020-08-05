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
	    $parent_text = null;
		if (isset($_POST['type']))
			$type = $_POST['type'];
		if (isset($_POST['parent']))
			$parent = $_POST['parent'];
		if (isset($_POST['text']))
			$parent_text = $_POST['text'];
			
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
		if ($parent != null && $currenttype != 'country'):
			?>
            <li class="nav-item">
                <input type="radio" id="link_location_<?= $currenttype?><?= $parent?>"  onchange="$('.ajax-filter-menu').find('.navCatDownMobile.nav-mobile').slice(2,10).remove();$('.home-location-text').text(`<?= $parent_text?>`);$('html,body').removeClass('disable-body-scroll');"   class="d-none" />
				<label
                     onclick="$('select[name=<?= $nexttype ?>]').val(-1) $('select[name=<?=$currenttype?>]').append('<option value=\'<?=$parent?>\'><option>').val(<?=$parent?>).trigger('change');" for="link_location_<?= $currenttype?><?= $parent?>" class="nav-link" >
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
			    <?php if($currenttype == "city"): ?>
                    <input type="radio" id="link_location_<?=$currenttype?><?=$item->id?>"  class="d-none"  onchange="$('select[name=<?=$currenttype?>]').val(<?=$item->id?>).trigger('change');$('.ajax-filter-menu').find('.navCatDownMobile.nav-mobile').slice(2,10).remove();$('.home-location-text').text(`<?= $item->name?>`);$('html,body').removeClass('disable-body-scroll');" />
			    <?php endif; ?>
				<label
				        onclick="$('select[name=<?= $nexttype ?>]').val(-1)
				        $('select[name=<?=$currenttype?>]').val(<?=$item->id?>).trigger('change')"
				<?php if ($currenttype == "city"): ?> for="link_location_<?=$currenttype?><?=$item->id?>"  <?php endif; ?>
				   <?php if ($currenttype != "city"): ?>  data-type="<?= $nexttype ?>"  data-ajax="<?= $item->id ?>" 	data-url="search_location"	<?php endif; ?>
				   class="nav-link p-0 <?= ($type != "city")?'has-menu':'' ?>" header-text="<?= $item->name?>">
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