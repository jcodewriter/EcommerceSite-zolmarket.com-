<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Data Extractor</title>

	<!-- Bootstrap -->
	<link href="<?php echo base_url() ?>assets/css/bootstrap-3.3.7.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/shieldui-all.min.css" rel="stylesheet"/>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		#custom-fields-options-table thead tr {

		}

		#custom-fields-options-table thead tr th {
			/*background: white;*/
			/*position: sticky;*/
			/*top: 0;*/
			/*z-index: 10;*/
		}

		#custom-fields-options-table thead tr:nth-child(2) th {
			/*top: 35px;*/
		}

	</style>
</head>
<body class="theme-light">
<div class="container" style="margin-top: 20px;">
	<div class="row">
		<div class="col-md-5 hidden">
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="treeview"></div>
					<br/>
					<p><span id="checkedCount"></span></p>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="panel panel-default" id="custom-fields-panel">
				<div class="panel-body">
					<form class="form-horizontal">
						<div class="form-group">
							<label for="category" class="col-md-3">alsoug Category</label>
							<div class="col-md-5">
								<select class="form-control" id="category"></select>
							</div>
							<div class="col-md-4">
								<select class="form-control" id="subcategory"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="custom-fields" class="col-md-3">alsoug Custom Field</label>
							<div class="col-md-5">
								<select class="form-control" id="custom-fields"></select>
							</div>
							<div class="col-md-4">
								<select class="form-control hidden" id="custom-fields-dependency"></select>
							</div>
						</div>
						<div class="form-group">
							<label for="export_action" class="col-md-3">Create or Merge</label>
							<div class="col-md-4">
								<label class="radio-inline">
									<input type="radio" name="export_action" id="create" value="create"> Create New
									Custom Field
								</label>
							</div>
							<div class="col-md-5">
								<label class="radio-inline">
									<input type="radio" name="export_action" id="merge" value="merge"> Merge With
									Existence Custom Field
								</label>
							</div>
						</div>
						<div class="form-group create-target hidden">
							<label for="row_width" class="col-md-3">Row Width</label>
							<div class="col-md-4">
								<label class="radio-inline">
									<input type="radio" id="row_width_1" name="row_width" value="half" checked> Half
									Width
								</label>
							</div>
							<div class="col-md-3">
								<label class="radio-inline">
									<input type="radio" id="row_width_2" name="row_width" value="full"> Full Width
								</label>
							</div>

						</div>
						<div class="form-group create-target hidden">
							<label for="status" class="col-md-3">Status</label>
							<div class="col-md-4">
								<label class="radio-inline">
									<input type="radio" id="status_1" name="status" value="1" checked> Active
								</label>
							</div>
							<div class="col-md-3">
								<label class="radio-inline">
									<input type="radio" id="status_2" name="status" value="0"> Inactive
								</label>
							</div>
						</div>
						<div class="form-group create-target hidden">
							<label for="is_required" class="col-md-3">Required</label>
							<div class="col-md-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="is_required" name="is_required" value="1">
									</label>
								</div>
							</div>
						</div>
						<div class="form-group create-target hidden">
							<label for="is_product_filter" class="col-md-3">Product Filter</label>
							<div class="col-md-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="is_product_filter" name="is_product_filter"
											   value="1">
									</label>
								</div>
							</div>
						</div>
						<div class="form-group create-target hidden">
							<label for="custom-fields" class="col-md-3">Field Name (English)</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="name_lang_1"></input>
							</div>
						</div>
						<div class="form-group create-target hidden">
							<label for="custom-fields" class="col-md-3">Field Name (العربية)</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="name_lang_2"></input>
							</div>
						</div>
						<div class="form-group create-target">
							<label for="field_type" class="col-md-3">Type</label>
							<div class="col-md-9">
								<select class="form-control" name="field_type" id="field_type">
									<option value="text">Text</option>
									<option value="textarea">Textarea</option>
									<option value="number">Number</option>
									<option value="checkbox">Checkbox</option>
									<option value="radio_button">Radio Button</option>
									<option value="dropdown">Dropdown</option>
									<option value="popup">Popup List</option>
									<option value="date">Date</option>
								</select>
							</div>
						</div>
						<div class="form-group merge-target hidden">
							<label for="current-custom-fields" class="col-md-3">
								Merge With Custom Field
							</label>
							<div class="col-md-9">
								<select class="form-control" id="current-custom-fields">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="current-custom-fields" class="col-md-3">
								Selected Options
							</label>
							<div class="col-md-9">
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
										data-target="#selected-options-modal">Show selected options
								</button>
							</div>
						</div>
						<div class="form-group hidden">
							<label for="current-custom-fields" class="col-md-3">
								Categories
							</label>
							<div class="col-md-9">
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
										data-target="#selected-categories-modal">Show categories
								</button>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 col-md-offset-3">
								<button type="button" class="btn btn-primary" id="export-custom-field" disabled>
									Submit
								</button>
							</div>
						</div>
					</form>
					<p class="text-danger hidden" id="msg">Arabic options count is not matched by English options
						count.</p>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="row">
				<div class="col-md-12" style="height: 15vh;">
					<div class="panel panel-default panel-categories" style="height: 100%">
						<div class="panel-heading">
							Categories
						</div>
						<div class="panel-body text-center">
							<button class="btn btn-primary btn-sm" id="add-to-selected-category-aa" data-toggle="modal"
									data-target="#add-category-modal">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								Add
							</button>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12" style="height: 60vh; overflow-y: scroll;">
					<div class="panel panel-default">
						<div class="panel-heading">
							Custom Field Options
						</div>
						<table class="table table-bordered" id="custom-fields-options-table">
							<thead>
							<tr>
								<th colspan="100%">
									<button class="btn btn-success btn-xs" id="add-to-selected-options">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										Add to selected options
									</button>
								</th>
							</tr>
							<tr>
								<th><input type="checkbox" id="select-all"></th>
								<th>#</th>
								<th>name</th>
								<th>english name</th>
								<th></th>
							</tr>

							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('extractor/modals') ?>
<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-3.3.7.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/shieldui-all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url() ?>assets/js/notify.min.js"></script>
<script type="text/javascript">
	const data___categories = <?php echo json_encode($categories) ?>;
	const baseUrl = "<?php echo base_url() ?>";
	const siteUrl = "<?php echo site_url('/') ?>"
	const iconUrl = baseUrl + 'assets/img/folder.png';
	const xCategories = {
		text: "root",
		id: null,
		items: [],
		subs: []
	};

	const xTreeCategories = {
		text: "root",
		expanded: true,
		xid: null,
		iconUrl: iconUrl,
		items: []
	};

	function prepareCategoriesForTree() {
		data___categories.forEach(function (category, index) {

			let classNameParts = category.classname.split('/').filter(x => x != '');
			let classParts = category.class.split('.').filter(x => x != '').map(x => parseInt(x));


			let pointer = xTreeCategories;


			for (let i = 0; i < classNameParts.length; i++) {

				let cat = pointer.items.find(c => c.text == classNameParts[i]);
				if (cat == undefined) {
					pointer.items.push({
						text: classNameParts[i],
						xid: classParts[i],
						iconUrl: iconUrl,
						expanded: true,
						items: []
					});
				}
				pointer = pointer.items.find(c => c.text == classNameParts[i]);
			}


		});
	}

	function prepareCategories() {
		data___categories.forEach(function (category, index) {

			let classNameParts = category.classname.split('/').filter(x => x != '');
			let classParts = category.class.split('.').filter(x => x != '').map(x => parseInt(x));


			let pointer = xCategories;


			for (let i = 0; i < classNameParts.length; i++) {
				if (pointer.name != "root" && pointer.subs.length == 0) {
					pointer.subs.push({
						name: "--",
						id: null,
						items: [],
						subs: []
					});
				}
				let cat = pointer.subs.find(c => c.name == classNameParts[i]);
				if (cat == undefined) {
					pointer.subs.push({
						name: classNameParts[i],
						id: classParts[i],
						items: [],
						subs: []
					});
				}
				pointer = pointer.subs.find(c => c.name == classNameParts[i]);
			}


		});
	}

	//prepareCategories();

	function onCheck() {
		// find all LI elements in the treeview and determine how many are checked
		var checkedCount = $("#treeview").swidget("TreeView").element.find("li").filter(function () {
			return $("#treeview").swidget("TreeView").checked($(this));
		}).length;
		$("#checkedCount").html(checkedCount + " items checked");
	}


	function onSelect(e, y) {
		$('#export-custom-field').prop('disabled', true);
		var elementPath = this.getPath(e.element);
		if (elementPath && Array.isArray(elementPath) /*&& elementPath.length > 2*/) {
			currentCustomFieldIndex = null;
			bindCategoryItems(e.item.data___id)
		}
	}

	function blockElement(el) {
		var options = {
			css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000000',
				borderRadius: '10px',
				fontSize: '10px',
				opacity: .5,
				color: '#fff'
			}
		};
		if (el) {
			$(el).block(options);
		} else {
			$.blockUI(options);
		}

	}

	function parseCities(obj) {
		let x = obj.map(function (city, index) {
			return city.city_name;
		})
		return x.join('|');
	}

	function bindAddCategoryFormCategories(cat, level = 0) {
		let $select = generateSelectInAddCategoryModal();
		cat.subs.forEach(function (category, index) {
			let $option = $('<option />')
				.val(category.id)
				.data('category', category)
				.data('level', level)
				.text(category.name);

			$select.append($option);

		});

		$select.on('change', function (event) {

			let category = $('option:selected', this).data('category');

			//remove next select element
			$('#add-category-modal .form-group:gt(' + level + ')').not(':last').remove();

			//if has subs create another select
			if (category.subs.length > 0) {
				bindAddCategoryFormCategories(category, level + 1);
			}

		}).trigger('change');


	}

	function generateSelectInAddCategoryModal() {
		let $form_group = $('<div class="form-group"/>').insertBefore('#add-category-modal .btn-add-group');
		let $col = $('<div class="col-sm-12" />').appendTo($form_group);
		let $select = $('<select class="form-control"/>').appendTo($col);

		return $select;
	}

	bindAddCategoryFormCategories(xCategories);

	function bindCategoryItems(catId, index) {
		$('#custom-fields, #custom-fields-options-table tbody').empty();
		$('#name_lang_1, #name_lang_2').val('');

		blockElement('#custom-fields-panel');
		customFields = {
			ar: [],
			en: []
		};

		$.when(
			$.ajax('https://www.alsoug.com/category-form/' + catId),
			$.ajax('https://www.alsoug.com/en/category-form/' + catId)
		).done(function (arResp, enResp) {
			var arData = arResp[0];
			var enData = enResp[0];

			if (arData.status.status == true && enData.status.status == true) {
				customFields = {
					ar: arData.data,
					en: enData.data
				}
				customFields.ar.unshift({
					display_name: 'المدن',
					type: 'dropdown',
					options: parseCities(cities.ar),
					id: 'cities',
					has_dependency: false
				})
				customFields.en.unshift({
					display_name: 'cities',
					type: 'dropdown',
					options: parseCities(cities.en),
					id: 'cities',
					has_dependency: false,
				})
				arData.data.forEach(function (customFiled, index) {
					$('<option />')
						.val(index)
						.attr('data-id', customFiled.id)
						.attr('data-has-dependency', customFiled.has_dependency)
						.text(customFiled.display_name).appendTo('#custom-fields')

				});

				$('#custom-fields').trigger('change')
			}
		}).always(function () {
			$('#custom-fields-panel').unblock();
		});


	}

	$('#edit-option-modal').on('click', '.next, .prev', function (event) {
		let uuid = $('#edit-option-modal #option_uuid').val();
		let index = uuid.split('xi').slice(-1)[0];

		let replaceValue = null;
		if ($(this).hasClass('next')) {
			replaceValue = 'xi' + (parseInt(index) + 1);
		} else {
			replaceValue = 'xi' + (parseInt(index) - 1);
		}


		let nextUUID = uuid.replace(`xi${index}`, replaceValue);


		if (cachedOptions[nextUUID]) {
			bindEditOptionForm(nextUUID);
		}

	});

	function bindEditOptionForm(uuid) {
		let option = cachedOptions[uuid];
		$('#edit-option-modal #option_uuid').val(uuid);
		$('#edit-option-modal #option_lang_1').val(option.en);
		$('#edit-option-modal #option_lang_2').val(option.ar);
	}

	$(document).on('click', '[data-target="#edit-option-modal"]', function (event) {
		let uuid = $(this).closest('tr').data('uuid');
		bindEditOptionForm(uuid);
	});


	$(document).on('click', '#add-category-modal .save', function (event) {
		$modal = $('#add-category-modal');
		$('.msg', $modal).text('data saved.').show().delay(1000).fadeOut('slow');
		selectedCategories = getSelectCategories();
		$('.panel-categories .panel-heading').html(`<span>Categories <span class='text-danger h5'>(${selectedCategories.length} selected)</span></span>`);
	});
	$(document).on('click', '#edit-option-modal .save', function (event) {
		$modal = $('#edit-option-modal');
		let uuid = $('#option_uuid', $modal).val();
		let option_en = $('#option_lang_1', $modal).val();
		let option_ar = $('#option_lang_2', $modal).val();
		cachedOptions[uuid] = {
			en: option_en,
			ar: option_ar
		};
		$('.msg', $modal).text('data saved.').show().delay(1000).fadeOut('slow');
		$('#custom-fields').trigger('change');
	});
	$(document).on('click', '#add-to-selected-options', function (event) {
		event.preventDefault();
		let $checked = $('#custom-fields-options-table tbody input[type=checkbox]:checked');

		$checked.each(function (index, element) {
			let $tr = $(element).closest('tr');
			let uuid = $(element).data('uuid');

			let data = {
				uuid: uuid,
				ar_value: $tr.find('td:eq(2)').text(),
				en_value: $tr.find('td:eq(3)').text()
			};
			addOptionToSelectedArray(data);
		});
	});
	$('#selected-options-modal').on('click', '#remove-selected-options, #remove-all-options', function (event) {
		let xid = $(this).prop('id');

		let selector = '#selected-options-table tbody input[type=checkbox]'
		if (xid == 'remove-selected-options') {
			selector += ':checked';

		}
		$(selector).each(function (index, element) {
			let uuid = $(this).data('uuid');
			removeOptionFromSelectedArray(uuid);
		});
	});

	$(document).on('change', 'input[type=radio][name=export_action]', function (event) {
		let action = $(this).val();
		$('[class$="-target"]').addClass('hidden')
		$(`.${action}-target`).hide().removeClass('hidden').fadeIn('slow');
	})
	$(document).on('change', '#select-all', function (event) {
		let state = $(this).prop('checked');
		let $rows = $(this).closest('table').find('tbody tr input[type=checkbox]');
		$rows.each(function (index, element) {
			$(element).prop('checked', state)
			$(element).trigger('change');
		});
	});

	function getSelectedOptions() {
		let options = {
			ar: [],
			en: [],
		}
		$('#custom-fields-options-table tbody input[type=checkbox]:checked').each(function (index, element) {
			let $tr = $(element).closest('tr');
			options.ar.push($tr.find('td:eq(2)').text());
			options.en.push($tr.find('td:eq(3)').text());
		});
		return options;
	}

	$(document).on('change', '#custom-fields-options-table tbody input[type=checkbox]', function () {
		return;
		let uuid = $(this).data('uuid');
		let status = $(this).prop('checked');
		let $tr = $(this).closest('tr');

		let index = selectedOptions.findIndex(function (option, index) {
			return option.uuid == uuid;
		});
		if (status == true && index == -1) {
			let option = {
				uuid: uuid,
				ar_value: $tr.find('td:eq(2)').text(),
				en_value: $tr.find('td:eq(3)').text()
			};
			selectedOptions.push(option);
			drawSelectedOptionsTable();
		} else if (status == false) {
			removeOptionFromSelectedArray(uuid);
		}
	});


	function addOptionToSelectedArray(data) {


		let index = selectedOptions.findIndex(function (option, index) {
			return option.uuid == data.uuid;
		});
		let isExistsInSelectedOptions = (index > -1);
		if (!isExistsInSelectedOptions) {
			selectedOptions.push(data);
			drawSelectedOptionsTable();
		}
	}

	function removeOptionFromSelectedArray(uuid) {

		let index = selectedOptions.findIndex(function (option, index) {
			return option.uuid == uuid;
		});

		if (index >= 0) {
			selectedOptions.splice(index, 1);
			$(`#custom-fields-options-table tbody input[type=checkbox][data-uuid=${uuid}]`).prop('checked', false);

			let selectAllStatus = $('#custom-fields-options-table tbody input[type=checkbox]:checked').length > 0;
			$('#custom-fields-options-table #select-all').prop('checked', selectAllStatus)

			drawSelectedOptionsTable();
		}

	}

	function drawSelectedOptionsTable() {

		let $tableBody = $('#selected-options-table tbody').empty();

		selectedOptions.forEach(function (option, index) {
			let newRow = generateRow(option, index);
			$('#selected-options-table tbody').append(newRow);
		});

		$('[data-target="#selected-options-modal"]').text(`Selected Options (${selectedOptions.length})`)


		function generateRow(option, index) {
			return `<tr>
					<td><input type="checkbox" data-index='${index}' data-uuid='${option.uuid}'></td>
					<td>${index + 1}</td>
					<td>${option.ar_value}</td>
					<td>${option.en_value}</td>
					<td>
						<button class="btn btn-xs btn-danger"  onclick="removeOptionFromSelectedArray('${option.uuid}')">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
					</td>
				</tr>`;
		}
	}

	$(document).on('click', '#export-custom-field', function (event) {
		let selectedCustomField = {
			ar: customFields.ar[currentCustomFieldIndex],
			en: customFields.en[currentCustomFieldIndex]
		}
		let xdata = {};
		xdata[csrf.name] = csrf.hash;

		// xdata.product_filter_key = selectedCustomField.ar.name;

		xdata.export_action = $('input[type=radio][name=export_action]:checked').val();
		if (xdata.export_action == 'create') {
			xdata.row_width = $('input[type=radio][name=row_width]:checked').val();
			xdata.status = $('input[type=radio][name=status]:checked').val();
			xdata.is_required = $('#is_required').prop('checked') ? 1 : 0;
			xdata.field_type = $('#field_type').val();
			xdata.is_product_filter = $('#is_product_filter').prop('checked') ? 1 : 0;
			//display_name
			xdata.name_lang_1 = $('#name_lang_1').val();
			xdata.name_lang_2 = $('#name_lang_2').val();
		} else {
			xdata.merge_with = $('#current-custom-fields').val();
		}

		//options
		//let selectedOptions = getSelectedOptions();
		xdata.options_ar = selectedOptions.map(o => o.ar_value).join('|');
		xdata.options_en = selectedOptions.map(o => o.en_value).join('|');
		xdata.categories = selectedCategories.join('|');
		$.ajax({
			url: siteUrl + 'extractor/save',
			type: 'POST',
			data: xdata,
			dataType: 'json',
			beforeSend: function () {
				blockElement();
			},
			complete: function () {
				$.unblockUI();
			},
			success: function (data) {
				if (data.status == 'success') {
					$.notify('data saved successfully.', {
						autoHide: false,
						className: 'success'
					});
					bindCurrentCustomField();
				} else if (data.status == 'error') {
					var msg = 'validation errors: \n';
					Object.keys(data.data).forEach(function (obj_key) {
						msg += data.data[obj_key] + '\n';
					});

					$.notify(msg, "error");
				}
			}
		})
	});

	function getCustomFieldMaxCount(arOptions, enOptions) {
		let maxCustomFieldCount = null;
		if (arOptions && Array.isArray(arOptions)) {
			maxCustomFieldCount = arOptions.length;
		}
		isDataLengthMatched = true;
		if (enOptions && Array.isArray(enOptions) && enOptions.length > maxCustomFieldCount) {
			maxCustomFieldCount = enOptions.length;
			isDataLengthMatched = false;
		}
		return maxCustomFieldCount;
	}


	$(document).on('change', '#merge-with-status', function (event) {
		let status = $(this).prop('checked');
		$('#current-custom-fields').prop('disabled', !status);
	});

	function fillCustomFieldOptionsTable(arCustomField, enCustomField, customFieldId = null) {
		$('#custom-fields-options-table tbody').empty();
		let arOptions = arCustomField.options.split('|');
		let enOptions = enCustomField.options.split('|');
		let maxCustomFieldCount = getCustomFieldMaxCount(arOptions, enOptions);
		if (maxCustomFieldCount == null) {
			return;
		}
		if (customFieldId == null) {
			customFieldId = arCustomField.id;
		}

		for (let i = 0; i < maxCustomFieldCount; i++) {
			let enOption = enOptions[i] || '--';
			let arOption = arOptions[i] || '--';

			//let uuid = `${customFieldId}x${i}`;
			let uuid = generateUUID(i);
			if (cachedOptions[uuid.small]) {
				arOption = cachedOptions[uuid.small].ar;
				enOption = cachedOptions[uuid.small].en;
			} else {
				cachedOptions[uuid.small] = {
					ar: arOption,
					en: enOption
				}
			}

			let checked = selectedOptions.find(o => o.uuid == uuid.small) ? 'checked' : '';

			let newRow = `<tr data-uuid='${uuid.small}'>
					<td><input type='checkbox' data-index='${i}' data-uuid='${uuid.small}' ${checked}></td>
					<td>${i + 1}</td>
					<td>${arOption}</td>
					<td>${enOption}</td>
					<td>
						<button class='btn btn-success btn-xs' data-toggle='modal' data-target='#edit-option-modal'>
							<span class='glyphicon glyphicon-pencil'></span>
						</button>
					</td>
				</tr>`;


			$('#custom-fields-options-table tbody').append(newRow);
		}
		let selectAllStatus = $('#custom-fields-options-table tbody input[type=checkbox]:checked').length > 0;
		$('#custom-fields-options-table #select-all').prop('checked', selectAllStatus);

		$('#export-custom-field').prop('disabled', false);
	}

	function hashCode(s) {
		return s.split("").reduce(function (a, b) {
			a = ((a << 5) - a) + b.charCodeAt(0);
			return a & a
		}, 0);
	}

	function fillCustomFieldOptionsDependency(arCustomField, enCustomField) {

		let arOptions = arCustomField.options.split('|');
		let enOptions = enCustomField.options.split('|');
		let maxCustomFieldCount = getCustomFieldMaxCount(arOptions, enOptions);
		if (maxCustomFieldCount == null) {
			return;
		}
		let customFieldId = arCustomField.id;
		for (let i = 0; i < maxCustomFieldCount; i++) {
			let enOption = enOptions[i] || '--';
			let arOption = arOptions[i] || '--';

			let forPath = enOption;
			if (enOption == '--' && arOption != '--') {
				forPath = hashCode(arOption);
			} else if (arOption == '--') {
				//todo: finding solution
			}

			$('<option />')
				.attr('data-parent-id', customFieldId)
				.attr('data-for-path', forPath)
				.attr('data-ar-parent-value', arOption)
				.attr('data-en-parent-value', enOption)
				.text(arOption).appendTo('#custom-fields-dependency');
		}

		$('#custom-fields-dependency').trigger('change');

	}

	$(document).on('change', '#custom-fields-dependency', function (event) {
		$('#custom-fields-options-table tbody').empty();
		let $selectedOption = $(this).find('option:selected');
		let parentId = $selectedOption.data('parentId');
		let arParentValue = $selectedOption.data('arParentValue');
		let enParentValue = $selectedOption.data('enParentValue');


		$('#name_lang_1').val(enParentValue);
		$('#name_lang_2').val(arParentValue);

		currentPath.dependency = $(this).find('option:selected').data('forPath');

		$.when($.ajax(`https://www.alsoug.com/field-dependencies?parent_id=${parentId}&parent_value=${arParentValue}`),
			$.ajax(`https://www.alsoug.com/en/field-dependencies?parent_id=${parentId}&parent_value=${enParentValue}`))
			.done(function (arResp, enResp) {
				let arCustomField = arResp[0].data[0];
				let enCustomField = enResp[0].data[0];

				fillCustomFieldOptionsTable(arCustomField, enCustomField)

			});
	});
	let selectedCategories = [];

	function bindSelectedCategoriesTable() {
		$('[data-target="#selected-categories-modal"]').text(`Show categories (${selectedCategories.length})`);
		$tbody = $('#add-category-modal table tbody').empty();

		selectedCategories.forEach(function (category, index) {
			$tbody.append(`<tr>
						<td>${index + 1}</td>
						<td>${category.text}</td>
						<td>
							<button class="btn btn-xs btn-danger" onclick="removeCategoryFromSelectedArray('${category.id}')">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
						</td>
					</tr>`);
		});
	}

	function removeCategoryFromSelectedArray(catId) {
		let index = selectedCategories.findIndex(c => c.id == catId);
		if (index > -1) {
			selectedCategories.splice(index, 1);
		}
		bindSelectedCategoriesTable();
	}

	$(document).on('click', '#add-category-modal .add', function (event) {

		let $select = $('#add-category-modal form select').eq(-1);
		if ($select.val() == "") {
			$select = $('#add-category-modal form select').eq(-2);
		}
		let catId = $select.val();
		let isSelectedBefore = selectedCategories.some(c => c.id == catId);
		if (isSelectedBefore) {
			$.notify(`Category is selected before, please select another one.`, "error");
			return;
		}

		let txt = data___categories.find(c => c.id == catId).classname;
		selectedCategories.push({
			id: catId,
			text: txt
		});
		bindSelectedCategoriesTable();

	});
	$(document).on('click', '#add-to-selected-category', function (event) {
		let catId = $('#field-category').val();
		if (catId > 0) {
			let isSelectedBefore = selectedCategories.findIndex(c => c.id == catId) > -1;
			let txt = $('#field-category option:selected').text();
			if (isSelectedBefore) {
				$.notify(`Category [${txt}] \nis selected before, please select another one.`, "error");
				return;
			}

			selectedCategories.push({
				id: catId,
				text: txt
			});
			bindSelectedCategoriesTable();
		}
	});
	$(document).on('change', '#custom-fields', function (event) {
		event.preventDefault();

		$('#merge-with-status').prop('checked', false).trigger('change');
		$('#select-all').prop('checked', false);

		$('#custom-fields-options-table tbody').empty();
		$('#custom-fields-dependency').addClass('hidden');
		let val = currentCustomFieldIndex = $(this).val();
		let arCustomField = customFields.ar[val];
		let enCustomField = customFields.en[val];

		let id = $(this).find('option:selected').data('id');
		currentPath.fieldId = id;
		let hasDependency = $(this).find('option:selected').data('hasDependency');
		currentPath.hasDependency = hasDependency;
		if (hasDependency) {
			fillCustomFieldOptionsDependency(arCustomField, enCustomField);
			$('#custom-fields-dependency').removeClass('hidden');

		} else {
			$('#name_lang_1').val(enCustomField.display_name);
			$('#name_lang_2').val(arCustomField.display_name);
			fillCustomFieldOptionsTable(arCustomField, enCustomField);

		}


		//$('#export-custom-field').prop('disabled', !isDataLengthMatched);
		//$('#msg').toggleClass('hidden', isDataLengthMatched)

	})

	function uuidv4() {
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
			var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
			return v.toString(16);
		});
	}

	let treeView = null;

	function bindTree(xItems) {
		treeView = $("#treeview").shieldTreeView({
			checkboxes: {
				enabled: false,
				children: false
			},
			events: {
				check: onCheck,
				select: onSelect
			},
			dataSource: {
				data: [
					{
						text: "Root",
						iconUrl: iconUrl,
						expanded: true,
						items: xItems
					}
				]
			}
		});
	}


	const csrf = {
		name: '<?php echo $this->security->get_csrf_token_name() ?>',
		hash: '<?php echo $this->security->get_csrf_hash() ?>'
	}

	let categories = {
		ar: [],
		en: []
	};
	let cities = {
		ar: [],
		en: []
	}
	let customFields = [];
	let currentCustomFieldIndex = null;
	let isDataLengthMatched = false;
	let selectedOptions = [];
	let cachedOptions = [];

	function init() {
		$.when($.ajax('https://www.alsoug.com/adverts/get-search'),
			$.ajax('https://www.alsoug.com/en/adverts/get-search'))
			.done(function (arResp, enResp) {
				cities.ar = arResp[0].data.cities;
				cities.en = enResp[0].data.cities;
				//parse categories
				categories.ar = arResp[0].data.categories.data;

				bindCategories(categories.ar, '#category');
			});
	}

	function bindCategories(categories, element) {
		$(element).empty();
		categories.forEach(function (category, index) {

			$('<option />')
				.val(category.id)
				.attr('data-has-dependency', category.has_dependency || false)
				.text(category.category_name)
				.appendTo(element);
		});
		$(element).trigger('change');
	}

	let currentPath = {};

	function generateUUID(index = '') {
		let largeUUID = "c" + currentPath.categoryId + "s" + currentPath.subcategoryId;

		largeUUID += "f" + currentPath.fieldId;
		let smallUUID = currentPath.fieldId;
		if (currentPath.hasDependency) {
			largeUUID += "d" + currentPath.dependency;
			smallUUID += "x" + currentPath.dependency;
		}

		if (index !== '') {
			largeUUID += "i" + index;
			smallUUID += "xi" + index;
		}

		return {
			small: smallUUID,
			large: largeUUID
		};
	}

	$(document).on('change', '#category, #subcategory', function (event) {
		event.preventDefault();
		let $option = $('option:selected', this);
		let index = $option.index();
		let id = $(this).val();
		let domId = $(this).prop('id')


		if (domId == 'category') {
			currentPath.categoryId = id;
			bindCategories(categories.ar[index].childs, '#subcategory');

		} else if (domId == 'subcategory') {
			currentPath.subcategoryId = id;
		}

		bindCategoryItems(id, index);
	});

	$(document).on('change', '#sub-category', function (event) {
		event.preventDefault();
		let id = $(this).data('id');


	});


	function parseCategoryChilds(childs) {
		var result = [];
		childs.forEach(function (xchild, index) {
			var item = {};
			item.data___id = xchild.id;
			item.data__category_name = xchild.category_name;
			item.data__has_dependency = xchild.has_dependency;
			item.text = xchild.category_name;
			item.iconUrl = iconUrl;
			item.items = [];
			if (xchild.childs != []) {
				item.items = parseCategoryChilds(xchild.childs);
			}
			result.push(item);
		});
		return result;
	}

	function bindCurrentCustomField() {
		$.ajax({
			url: siteUrl + 'extractor/get_custom_fields',
			dataType: 'json',
			success: function (response) {

				response.data.forEach(function (xcustomField, index) {
					let $option = $('<option />');
					let name = xcustomField.langs[0].name;

					$option.text(name)
						.val(xcustomField.id)
						.appendTo('#current-custom-fields');
				})
			}

		});
	}

	let $categoriesTreeView = null;
	$(document).ready(function () {
		init();
		bindCurrentCustomField();
		$('input[type=radio][name=export_action]#create').prop('checked', true).trigger('change')

		prepareCategoriesForTree();
		$categoriesTreeView = $("#categories-tree-view").shieldTreeView({
			checkboxes: {
				enabled: true,
				children: true,
				// enableLabelClick: false,
			},

			events: {
				check: function (event) {
					let checkedCats = getSelectCategories();
					$('#add-category-modal-label span').text(` ( ${checkedCats.length} selected )`);

					let el = event.element;
					if (event.checked == true) {
						let parent = $categoriesTreeView.swidget("TreeView").getParent(el);

						if (parent && parent.length > 0) {
							let isCheckedParent = $categoriesTreeView.swidget("TreeView").checked(parent);
							if (!isCheckedParent) {

								$categoriesTreeView.swidget("TreeView").updateIndetermined();
							}
						}
					}

				},
				init: function () {
					debugger;
				}
			},
			dataSource: {
				data: xTreeCategories.items
			}
		});
		setTimeout(function () {
			let treeWidget = $categoriesTreeView.swidget("TreeView");
			treeWidget.element.find('li').each((index, el) => {
				let $el = $(el)
				let hasChildren = treeWidget.hasChildren($el);


				if (hasChildren) {
					treeWidget._collapse($el);
				}
			});
		}, 1000);


	});

	function getSelectCategories() {
		let selected = [];
		$("#categories-tree-view").swidget("TreeView").element.find("li").filter(function () {
			return $("#categories-tree-view").swidget("TreeView").checked($(this));
		}).each(function () {
			let id = $("#categories-tree-view").swidget("TreeView").getItem($(this)).xid
			selected.push(id);
		});

		return selected;

	}
</script>
</body>
</html>
