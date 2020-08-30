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

</head>
<body class="theme-light">
<div class="container" style="margin-top: 20px;">
	<div class="row">
		<div class="col-md-5">
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
							<label for="custom-fields" class="col-md-3">Custom Field</label>
							<div class="col-md-5">
								<select class="form-control" id="custom-fields"></select>
							</div>
							<div class="col-md-4">
								<select class="form-control hidden" id="custom-fields-sub"></select>
							</div>
						</div>
						<div class="form-group">
							<label for="export_action" class="col-md-3">Create or Merge</label>
							<div class="col-md-9">
								<label class="radio-inline">
									<input type="radio" name="export_action" id="create" value="create"> Create New
									Custom Field
								</label>
								<label class="radio-inline">
									<input type="radio" name="export_action" id="merge" value="merge"> Merge With
									Existence Custom Field
								</label>
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

							</label>
							<div class="col-md-9">
								<button type="button" class="btn btn-primary" data-toggle="modal"
										data-target="#selected-options-modal">Selected Options
								</button>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 col-md-offset-3">
								<button type="button" class="btn btn-primary btn-sm" id="export-custom-field" disabled>
									Submit
								</button>
							</div>
						</div>
					</form>
					<p class="text-danger hidden" id="msg">Arabic options count is not matched by English options
						count.</p>
				</div>
				<div class="panel-body" style="min-height: 45vh">
					<table class="table table-bordered table-condensed" id="custom-fields-options-table">
						<thead>
						<th><input type="checkbox" id="select-all"></th>
						<th>#</th>
						<th>name</th>
						<th>english name</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="selected-options-modal" tabindex="-1" role="dialog"
	 aria-labelledby="selected-options-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="selected-options-label">Selected Options</h4>
			</div>
			<div class="modal-body" style="height: 300px;overflow-y: scroll;">
				<table class="table table-bordered table-condensed" id="selected-options-table">
					<thead>
					<th><input type="checkbox" id="select-all"></th>
					<th>#</th>
					<th>name</th>
					<th>english name</th>
					<th></th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="remove-selected-options">Remove selected</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-3.3.7.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/shieldui-all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.blockUI.js"></script>

<script type="text/javascript">
	function onCheck() {
		// find all LI elements in the treeview and determine how many are checked
		var checkedCount = $("#treeview").swidget("TreeView").element.find("li").filter(function () {
			return $("#treeview").swidget("TreeView").checked($(this));
		}).length;
		$("#checkedCount").html(checkedCount + " items checked");
	}

	let isCarsSubtype = false;

	function onSelect(e, y) {
		$('#export-custom-field').prop('disabled', true);
		var elementPath = this.getPath(e.element);
		if (elementPath && Array.isArray(elementPath) /*&& elementPath.length > 2*/) {
			isCarsSubtype = (elementPath[1] == 0);
			currentCustomFieldIndex = null;
			getCategoryItems(e.item.data___id)
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

	function getCategoryItems(catId) {
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
							.prop('value', index)
							.attr('data-has-dependency', customFiled.has_dependency)
							.attr('data-is-cars-subtype', isCarsSubtype)
							.text(customFiled.display_name).appendTo('#custom-fields')

				});

				$('#custom-fields').trigger('change')
			}
		}).always(function () {
			$('#custom-fields-panel').unblock();
		});


	}

	$(document).on('click', '#selected-options-modal #remove-selected-options', function (event) {
		$('#selected-options-table tbody input[type=checkbox]:checked').each(function (index, element) {
			let uuid = $(this).data('uuid');
			removeOptionFromSelectedArray(uuid);
		});
	});
	$(document).on('change', 'input[type=radio][name=export_action]', function (event) {
		let action = $(this).val();
		$('[class$="-target"]').addClass('hidden')
		$(`.${action}-target`).removeClass('hidden');
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
					<td><button type="button" class="btn btn-primary btn-sm" onclick="removeOptionFromSelectedArray('${option.uuid}')">Remove</button></td>
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
		xdata.field_type = selectedCustomField.ar.type;
		// xdata.product_filter_key = selectedCustomField.ar.name;

		xdata.export_action = $('input[type=radio][name=export_action]:checked').val();
		//display_name
		xdata.name_lang_1 = $('#name_lang_1').val();
		xdata.name_lang_2 = $('#name_lang_2').val();

		xdata.merge_with = $('#current-custom-fields').val();
		//options
		//let selectedOptions = getSelectedOptions();
		xdata.options_ar = selectedOptions.map(o => o.ar_value).join('|');
		xdata.options_en = selectedOptions.map(o => o.en_value).join('|');

		$.ajax({
			url: siteUrl + 'extractor/add_custom_field',
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
					alert('data added successfully');
					bindCurrentCustomField();
				} else if (data.status == 'error') {
					var msg = 'validation errors: \n';
					Object.keys(data.data).forEach(function (obj_key) {
						msg += data.data[obj_key] + '\n';
					});

					alert(msg)
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

			let uuid = `${customFieldId}x${i}`;
			let checked = selectedOptions.find(o => o.uuid == uuid) ? 'checked' : '';

			let newRow = `<tr>
					<td><input type="checkbox" data-index='${i}' data-uuid='${uuid}' ${checked}></td>
					<td>${i + 1}</td>
					<td>${arOption}</td>
					<td>${enOption}</td>
				</tr>`;


			$('#custom-fields-options-table tbody').append(newRow);
		}
		let selectAllStatus = $('#custom-fields-options-table tbody input[type=checkbox]:checked').length > 0;
		$('#custom-fields-options-table #select-all').prop('checked', selectAllStatus);

		$('#export-custom-field').prop('disabled', false);
	}

	function fillCustomFieldOptionsList(arCustomField, enCustomField) {

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

			$('<option />')
					.attr('data-parent-id', customFieldId)
					.attr('data-ar-parent-value', arOption)
					.attr('data-en-parent-value', enOption)
					.text(arOption).appendTo('#custom-fields-sub');
		}

		$('#custom-fields-sub').trigger('change');

	}

	$(document).on('change', '#custom-fields-sub', function (event) {
		$('#custom-fields-options-table tbody').empty();
		let $selectedOption = $(this).find('option:selected');
		let parentId = $selectedOption.data('parentId');
		let arParentValue = $selectedOption.data('arParentValue');
		let enParentValue = $selectedOption.data('enParentValue');


		$('#name_lang_1').val(enParentValue);
		$('#name_lang_2').val(arParentValue);


		$.when($.ajax(`https://www.alsoug.com/field-dependencies?parent_id=${parentId}&parent_value=${arParentValue}`),
				$.ajax(`https://www.alsoug.com/en/field-dependencies?parent_id=${parentId}&parent_value=${enParentValue}`))
				.done(function (arResp, enResp) {
					let arCustomField = arResp[0].data[0];
					let enCustomField = enResp[0].data[0];

					fillCustomFieldOptionsTable(arCustomField, enCustomField)

				});
	});
	$(document).on('change', '#custom-fields', function (event) {
		event.preventDefault();

		$('#merge-with-status').prop('checked', false).trigger('change');
		$('#select-all').prop('checked', false);

		$('#custom-fields-options-table tbody').empty();
		$('#custom-fields-sub').addClass('hidden');
		let val = currentCustomFieldIndex = $(this).val();
		let arCustomField = customFields.ar[val];
		let enCustomField = customFields.en[val];


		let hasDependency = $(this).find('option:selected').data('hasDependency');
		if (hasDependency) {
			fillCustomFieldOptionsList(arCustomField, enCustomField);
			$('#custom-fields-sub').removeClass('hidden');
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

	const baseUrl = "<?php echo base_url() ?>";
	const siteUrl = "<?php echo site_url('/') ?>"
	const csrf = {
		name: '<?php echo $this->security->get_csrf_token_name() ?>',
		hash: '<?php echo $this->security->get_csrf_hash() ?>'
	}
	const iconUrl = baseUrl + 'assets/img/folder.png'
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
	$(function () {
		$.when($.ajax('https://www.alsoug.com/adverts/get-search'),
				$.ajax('https://www.alsoug.com/en/adverts/get-search'))
				.done(function (arResp, enResp) {
					cities.ar = arResp[0].data.cities;
					cities.en = enResp[0].data.cities;
					//parse categories
					categories.ar = arResp[0].data.categories.data;
					var items = parseCategoryChilds(categories.ar);
					bindTree(items);


				});
	})

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

	$(function () {
		bindCurrentCustomField();
		$('input[type=radio][name=export_action]#create').prop('checked', true).trigger('change')
	});
</script>
</body>
</html>
