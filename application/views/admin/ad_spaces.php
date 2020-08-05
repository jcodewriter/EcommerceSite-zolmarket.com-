<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo trans('ad_spaces'); ?></h3>
			</div>
			<!-- /.box-header -->

			<div class="box-body">
				<!-- include message block -->
				<?php if (empty($this->session->flashdata("mes_adsense"))):
					$this->load->view('admin/includes/_messages');
				endif; ?>

				<div class="form-group">
					<label><?php echo trans('select_ad_space'); ?></label>
					<select class="form-control custom-select" name="parent_id" onchange="window.location.href = '<?php echo admin_url(); ?>'+'ad-spaces?ad_space='+this.value;">
						<?php foreach ($array_ad_spaces as $key => $value):?>
							<option value="<?php echo $key; ?>" <?php echo ($key == $ad_category->name) ? 'selected' : ''; ?>><?php echo $value; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<?php echo form_open_multipart('admin_controller/ad_spaces_post'); ?>

				<input type="hidden" name="ad_space" value="<?php echo $ad_category->name; ?>">

				<?php if ($ad_category->name == "product_sidebar" || $ad_category->name == "products_sidebar" || $ad_category->name == "blog_post_details_sidebar" || $ad_category->name == "profile_sidebar"): ?>
					<div class="form-group">
						<?php if (!empty($array_ad_spaces[$ad_category->name])): ?>
							<h4><?php echo trans($ad_category->name . "_ad_space"); ?></h4>
						<?php endif; ?>
						<?php if ($ad_category->name == "products_sidebar" || $ad_category->name == "blog_post_details_sidebar" || $ad_category->name == "profile_sidebar"): ?>
							<p>
								<label class="label label-primary">160x600 <?php echo trans('banner'); ?></label>&nbsp;&nbsp;
								<small>(This ad will be shown on screens larger than 768px)</small>
							</p>
						<?php else: ?>
							<p>
								<label class="label label-primary">300x250 <?php echo trans('banner'); ?></label>&nbsp;&nbsp;
								<small>(This ad will be shown on screens larger than 768px)</small>
							</p>
						<?php endif; ?>
						<div class="row row-ad-space">
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('paste_ad_code'); ?></label>
								<div style="overflow-y: scroll;height: 150px;">
									<table class="table table-bordered table-striped" role="grid">
										<tbody>
											<?php foreach($ad_codes as $ad_code): 
												if ($ad_code->ad_banner == "ad_code_300"): ?>
											<tr>
												<td style="vertical-align: middle;width: 100px;border-bottom: 1px solid #dedede;" rowspan="2">
													<img src="<?php echo $ad_code->img_url;?>" style="width:100%; height: 80px; object-fit: none;" alt="">
												</td>
												<td style="word-break: break-all">
													<span style="width: 100%;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;"><?php echo $ad_code->site_url;?></span>
												</td>
											</tr>
											<tr>
												<td style="vertical-align: middle;text-align: end;border-bottom: 1px solid #dedede;">
													<button type="button" 
														class="btn btn-xs btn-success m-r-10" 
														onclick="$('input[name=id_ad_code_300]').val(<?php echo $ad_code->id;?>); 
																$('input[name=url_ad_code_300]').val('<?php echo $ad_code->site_url;?>');">Edit
													</button>
													<button type="button" 
														class="btn btn-xs btn-danger" 
														onclick="delete_ad_spaces('Are you sure you want to delete this item?', <?php echo $ad_code->id;?>);">Delete
													</button>
												</td>
											</tr>
												<?php endif;
											endforeach;?>
										</tbody>
									</table>
								</div>
								<!-- <textarea class="form-control text-area-adspace" name="ad_code_300"
										placeholder="<?php echo trans('paste_ad_code'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>><?php echo $ad_codes->ad_code_300; ?></textarea> -->
							</div>
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('upload_your_banner'); ?></label>
								<input type="hidden" class="form-control" name="id_ad_code_300" value=""/>
								<input type="text" class="form-control" name="url_ad_code_300" placeholder="<?php echo trans('paste_ad_url'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
								<div class="row m-t-15">
									<div class="col-sm-12">
										<a class='btn bg-olive btn-sm btn-file-upload'>
											<?php echo trans('select_image'); ?>
											<input type="file" name="file_ad_code_300" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info2').html($(this).val());">
										</a>
									</div>
								</div>

								<span class='label label-info' id="upload-file-info2"></span>
							</div>
						</div>

						<p>
							<label class="label label-primary">250x250 <?php echo trans('banner'); ?></label>&nbsp;&nbsp;
							<small>(This ad will be shown on screens smaller than 768px)</small>
						</p>
						<div class="row row-ad-space">
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('paste_ad_code'); ?></label>
								<div style="overflow-y: scroll;height: 150px;">
									<table class="table table-bordered table-striped" role="grid">
										<tbody>
											<?php foreach($ad_codes as $ad_code): 
												if ($ad_code->ad_banner == "ad_code_250"): ?>
											<tr>
												<td style="vertical-align: middle;width: 100px;border-bottom: 1px solid #dedede;" rowspan="2">
													<img src="<?php echo $ad_code->img_url;?>" style="width:100%; height: 80px; object-fit: none;" alt="">
												</td>
												<td style="word-break: break-all">
													<span style="width: 100%;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;"><?php echo $ad_code->site_url;?></span>
												</td>
											</tr>
											<tr>
												<td style="vertical-align: middle;text-align: end;border-bottom: 1px solid #dedede;">
													<button type="button" 
														class="btn btn-xs btn-success m-r-10" 
														onclick="$('input[name=id_ad_code_250]').val(<?php echo $ad_code->id;?>); 
																$('input[name=url_ad_code_250]').val('<?php echo $ad_code->site_url;?>');">Edit
													</button>
													<button type="button" 
														class="btn btn-xs btn-danger" 
														onclick="delete_ad_spaces('Are you sure you want to delete this item?', <?php echo $ad_code->id;?>);">Delete
													</button>
												</td>
											</tr>
												<?php endif;
											endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('upload_your_banner'); ?></label>
								<input type="hidden" class="form-control" name="id_ad_code_250" value=""/>
								<input type="text" class="form-control" name="url_ad_code_250" placeholder="<?php echo trans('paste_ad_url'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
								<div class="row m-t-15">
									<div class="col-sm-12">
										<a class='btn bg-olive btn-sm btn-file-upload'>
											<?php echo trans('select_image'); ?>
											<input type="file" name="file_ad_code_250" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info3').html($(this).val());">
										</a>
									</div>
								</div>

								<span class='label label-info' id="upload-file-info3"></span>
							</div>
						</div>
						<div class="row row-ad-space row-button">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
							</div>
						</div>

					</div>
				<?php else: ?>
					<div class="form-group">
						<?php if (!empty($array_ad_spaces[$ad_category->name])): ?>
							<h4><?php echo trans($ad_category->name . "_ad_space"); ?></h4>
						<?php endif; ?>

						<p>
							<label class="label label-primary">728x90 <?php echo trans('banner'); ?></label>&nbsp;&nbsp;
							<small>(This ad will be shown on screens larger than 1200px)</small>
						</p>
						<div class="row row-ad-space">
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('paste_ad_code'); ?></label>
								<div style="overflow-y: scroll;height: 150px;">
									<table class="table table-bordered table-striped" role="grid">
										<tbody>
											<?php foreach($ad_codes as $ad_code): 
												if ($ad_code->ad_banner == "ad_code_728"): ?>
											<tr>
												<td style="vertical-align: middle;width: 100px;border-bottom: 1px solid #dedede;" rowspan="2">
													<img src="<?php echo $ad_code->img_url;?>" style="width:100%; height: 80px; object-fit: none;" alt="">
												</td>
												<td style="word-break: break-all">
													<span style="width: 100%;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;"><?php echo $ad_code->site_url;?></span>
												</td>
											</tr>
											<tr>
												<td style="vertical-align: middle;text-align: end;border-bottom: 1px solid #dedede;">
													<button type="button" 
														class="btn btn-xs btn-success m-r-10" 
														onclick="$('input[name=id_ad_code_728]').val(<?php echo $ad_code->id;?>); 
																$('input[name=url_ad_code_728]').val('<?php echo $ad_code->site_url;?>');">Edit
													</button>
													<button type="button" 
														class="btn btn-xs btn-danger" 
														onclick="delete_ad_spaces('Are you sure you want to delete this item?', <?php echo $ad_code->id;?>);">Delete
													</button>
												</td>
											</tr>
												<?php endif;
											endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('upload_your_banner'); ?></label>
								<input type="hidden" class="form-control" name="id_ad_code_728" value=""/>
								<input type="text" class="form-control" name="url_ad_code_728" placeholder="<?php echo trans('paste_ad_url'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
								<div class="row m-t-15">
									<div class="col-sm-12">
										<a class='btn bg-olive btn-sm btn-file-upload'>
											<?php echo trans('select_image'); ?>
											<input type="file" name="file_ad_code_728" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info1').html($(this).val());">
										</a>
									</div>
								</div>

								<span class='label label-info' id="upload-file-info1"></span>
							</div>
						</div>

						<p>
							<label class="label label-primary">468x60 <?php echo trans('banner'); ?></label>&nbsp;&nbsp;
							<small>(This ad will be shown on screens larger than 576px and smaller than 1200px)</small>
						</p>
						<div class="row row-ad-space">
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('paste_ad_code'); ?></label>
								<div style="overflow-y: scroll;height: 150px;">
									<table class="table table-bordered table-striped" role="grid">
										<tbody>
											<?php foreach($ad_codes as $ad_code): 
												if ($ad_code->ad_banner == "ad_code_468"): ?>
											<tr>
												<td style="vertical-align: middle;width: 100px;border-bottom: 1px solid #dedede;" rowspan="2">
													<img src="<?php echo $ad_code->img_url;?>" style="width:100%; height: 80px; object-fit: none;" alt="">
												</td>
												<td style="word-break: break-all">
													<span style="width: 100%;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;"><?php echo $ad_code->site_url;?></span>
												</td>
											</tr>
											<tr>
												<td style="vertical-align: middle;text-align: end;border-bottom: 1px solid #dedede;">
													<button type="button" 
														class="btn btn-xs btn-success m-r-10" 
														onclick="$('input[name=id_ad_code_468]').val(<?php echo $ad_code->id;?>); 
																$('input[name=url_ad_code_468]').val('<?php echo $ad_code->site_url;?>');">Edit
													</button>
													<button type="button" 
														class="btn btn-xs btn-danger" 
														onclick="delete_ad_spaces('Are you sure you want to delete this item?', <?php echo $ad_code->id;?>);">Delete
													</button>
												</td>
											</tr>
												<?php endif;
											endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('upload_your_banner'); ?></label>
								<input type="hidden" class="form-control" name="id_ad_code_468" value=""/>
								<input type="text" class="form-control" name="url_ad_code_468" placeholder="<?php echo trans('paste_ad_url'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
								<div class="row m-t-15">
									<div class="col-sm-12">
										<a class='btn bg-olive btn-sm btn-file-upload'>
											<?php echo trans('select_image'); ?>
											<input type="file" name="file_ad_code_468" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info2').html($(this).val());">
										</a>
									</div>
								</div>

								<span class='label label-info' id="upload-file-info2"></span>
							</div>
						</div>

						<p><label class="label label-primary">250x250 <?php echo trans('banner'); ?></label>&nbsp;&nbsp;
							<small>(This ad will be shown on screens smaller than 576px)</small>
						</p>
						<div class="row row-ad-space">
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('paste_ad_code'); ?></label>
								<div style="overflow-y: scroll;height: 150px;">
									<table class="table table-bordered table-striped" role="grid">
										<tbody>
											<?php foreach($ad_codes as $ad_code): 
												if ($ad_code->ad_banner == "ad_code_250"): ?>
											<tr>
												<td style="vertical-align: middle;width: 100px;border-bottom: 1px solid #dedede;" rowspan="2">
													<img src="<?php echo $ad_code->img_url;?>" style="width:100%; height: 80px; object-fit: none;" alt="">
												</td>
												<td style="word-break: break-all">
													<span style="width: 100%;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;"><?php echo $ad_code->site_url;?></span>
												</td>
											</tr>
											<tr>
												<td style="vertical-align: middle;text-align: end;border-bottom: 1px solid #dedede;">
													<button type="button" 
														class="btn btn-xs btn-success m-r-10" 
														onclick="$('input[name=id_ad_code_250]').val(<?php echo $ad_code->id;?>); 
																$('input[name=url_ad_code_250]').val('<?php echo $ad_code->site_url;?>');">Edit
													</button>
													<button type="button" 
														class="btn btn-xs btn-danger" 
														onclick="delete_ad_spaces('Are you sure you want to delete this item?', <?php echo $ad_code->id;?>);">Delete
													</button>
												</td>
											</tr>
												<?php endif;
											endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-sm-6">
								<label class="control-label"><?php echo trans('upload_your_banner'); ?></label>
								<input type="hidden" class="form-control" name="id_ad_code_250" value=""/>
								<input type="text" class="form-control" name="url_ad_code_250" placeholder="<?php echo trans('paste_ad_url'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
								<div class="row m-t-15">
									<div class="col-sm-12">
										<a class='btn bg-olive btn-sm btn-file-upload'>
											<?php echo trans('select_image'); ?>
											<input type="file" name="file_ad_code_250" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info3').html($(this).val());">
										</a>
									</div>
								</div>

								<span class='label label-info' id="upload-file-info3"></span>
							</div>
						</div>
						<div class="row row-ad-space row-button">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
							</div>
						</div>

					</div>
				<?php endif; ?>

				<?php echo form_close(); ?>

			</div>
		</div>
		<!-- /.box -->
	</div>
</div>

<div class="row" style="display: none !important">
	<div class="col-lg-6 col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo trans('google_adsense_code'); ?></h3>
			</div>
			<!-- /.box-header -->

			<!-- form start -->
			<?php echo form_open('admin_controller/google_adsense_code_post'); ?>
			<div class="box-body">
				<!-- include message block -->
				<?php if (!empty($this->session->flashdata("mes_adsense"))):
					$this->load->view('admin/includes/_messages');
				endif; ?>
				<div class="form-group">
					<textarea name="google_adsense_code" class="form-control" placeholder="<?php echo trans('google_adsense_code'); ?>" style="min-height: 140px;"><?php echo $general_settings->google_adsense_code; ?></textarea>
				</div>
			</div>

			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
			</div>
			<!-- /.box-footer -->
			<!-- /.box -->
			<?php echo form_close(); ?><!-- form end -->
		</div>
	</div>
</div>
<style>
	h4 {
		color: #0d6aad;
		text-align: left;
		font-weight: 600;
		margin-bottom: 15px;
		margin-top: 30px;
	}

	.row-ad-space {
		padding: 15px 0;
		background-color: #f7f7f7;
		margin-bottom: 45px;
	}

	.row-button {
		background-color: transparent !important;
		min-height: 60px;
	}

	textarea {
		height: 78px !important;
		resize: none;
	}

	.label-primary {
		font-size: 12px;
	}

	small {
		color: #333 !important;
	}
</style>

<?php if ($site_lang->text_direction == "rtl"): ?>

	<style>
		h4 {
			text-align: right;
		}
	</style>
<?php endif; ?>
