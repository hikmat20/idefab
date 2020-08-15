<?php

if (!empty($this->uri->segment(3))) {

	$getData        = $this->db->get_where('quotation_header', array('id' => $id))->row();
	$customer     	= $this->db->get_where('master_customer', array('id_customer' => $getData->id_customer))->row();
	$cat_cust     	= $this->db->get_where('child_customer_category', array('id_category_customer' => $getData->id_cust_cut))->row();
	$pic_cust     	= $this->db->get_where('child_customer_pic', array('id_customer' => $getData->id_customer))->row();
	$ruang     		= $this->db->get_where('quotation_room', array('id_quotation' => $getData->id))->result();
}
// echo "<pre>";
// print_r($getData);
// echo "<pre>";
// exit;
?>
<form id="form-quotation" class="form-active" method="post" enctype="multipart/form-data">
	<div class="box box-primary">
		<div class="box-header">
			<table id="my-grid3" class="table-condensed" width="100%">
				<thead>
					<tr>
						<th class="text">CUSTOMER DATA INFORMATION</th>
					</tr>
				</thead>
			</table>
		</div>

		<input type="hidden" name="type" value="<?= !empty($getData) ? 'edit' : 'add' ?>">
		<input type="hidden" name="id_quotation" id="id_qtt" value="<?= $getData->id ?>">
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-1">
					<div class="form-group">
						<div><label>Quotation Number <span class='text-red'>*</span></label></div>
						<strong>
							<input type="text" class="form-control input required" name="nomor" id="nomor" value="<?= empty($getData->nomor) ? '' : $getData->nomor ?>" readonly>
							<label class="label label-danger nomor hideIt">Quotation Number Can't be empty!</label>
						</strong>
					</div>
					<div class="form-group">
						<div><label>Customer <span class='text-red'>*</span></label></div>
						<strong>
							<select class="form-control required select2" name="id_cuctomer" id="id_cuctomer"></select>
							<label class="label label-danger id_cuctomer hideIt">Customer Can't be empty!</label>
							<input type="hidden" id="id_cust" value="<?= $customer ? $customer->id_customer : '' ?>">
						</strong>
					</div>
					<div class="form-group">
						<div><label>PIC </label></div>
						<strong>
							<input type="hidden" class="form-control input required w50" name="id_pic" id="id_pic" value="<?= $pic_cust->id_pic ?>">
							<input type="text" class="form-control input" name="nm_pic" id="nm_pic" placeholder="Name PIC" value="<?= $pic_cust ? $pic_cust->name_pic : '' ?>" readonly>
							<label class="label label-danger nm_pic hideIt">PIC Can't be empty!</label>
						</strong>
					</div>
					<div class="form-group">
						<div><label>Address</label></div>
						<strong>
							<textarea type="text" class="form-control input " name="address" id="address" placeholder="Address" readonly><?= $customer ? $customer->address_office : '' ?></textarea>
							<label class="label label-danger address hideIt">Address Can't be empty!</label>
						</strong>
					</div>
					<div class="form-group">
						<div><label>Category Customer</label></div>
						<strong>
							<input type="hidden" class="form-control input" placeholder="Category Customer" name="id_cust_cut" id="id_cust_cut" value="<?= $cat_cust ? $cat_cust->id_category_customer : '' ?>" readonly>
							<input type="text" class="form-control input" placeholder="Category Customer" name="nm_cust_cut" id="nm_cust_cut" value="<?= $cat_cust ? $cat_cust->name_category_customer : '' ?>" readonly>
							<label class="label label-danger id_cust_cut hideIt">Category Customer Can't be empty!</label></label>
						</strong>
					</div>
					<div class="form-group row">
						<div class="col-md-12"><label>Discount Category <span class='text-red'>*</span></label></div>
						<div class="col-xs-8 col-md-8">
							<strong>
								<select class="form-control required select2" name="id_disc_cat" id="id_disc_cat"></select>
								<label class="label label-danger id_disc_cat hideIt">Discount Category Can't be empty!</label>
							</strong>
						</div>
						<div class="col-xs-4 col-md-4 ">
							<strong>
								<input class="form-control text-center" readonly value="<?= $getData->val_disc_cat != '' ? $getData->val_disc_cat . '%' : '' ?>" name="disc_cat" id="disc_cat" placeholder="0%">
								<input type="hidden" class="form-control text-center" readonly name="act_disk" id="act_disk" value="<?= $getData->val_disc_cat != '' ? $getData->val_disc_cat : '0' ?>">
							</strong>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-md-offset-2">
					<div class="form-group">
						<div><label>Date <span class='text-red'>*</span></label></div>
						<strong>
							<input type="date" class="form-control input required " placeholder="yyy-mm-dd" name="date" id="date" value="<?= date('Y-m-d') ?>" autocomplete="off">
							<label class="label label-danger date hideIt">Date Can't be empty!</label>
						</strong>
					</div>
					<div class="form-group">
						<div><label>Category Sales <span class='text-red'>*</span></label></div>
						<strong>
							<select class="form-control required select2" name="cat" id="cat">
								<option value=""></option>
								<option value="project" <?= $getData->sales_category == 'project' ? 'selected' : '' ?>>Project</option>
								<option value="wholesale" <?= $getData->sales_category == 'wholesale' ? 'selected' : '' ?>>Wholesale</option>
							</select>
							<label class="label label-danger cat hideIt">Category Can't be empty!</label>
						</strong>
					</div>
					<div class="form-group">
						<div><label>Type Project <span class='text-red'>*</span></label></div>
						<strong>
							<select class="form-control required select2" name="type_project" id="type_project"></select>
							<label class="label label-danger type_project hideIt">Type Project Can't be empty!</label>
						</strong>
					</div>
					<div class="form-group">
						<div><label>Marketing <span class='text-red'>*</span></label></div>
						<strong>
							<select class="form-control input required select2" name="id_karyawan" id="id_karyawan"></select>
							<label class="label label-danger id_karyawan hideIt">Marketing Can't be empty!</label></label>
						</strong>
					</div>
					<div class="form-group">
						<label style="width:70px">Net Price </label>
						<label style="margin-left:20px">
							<input type="radio" name="net" class="net" value="0" <?= !empty($getData->net) && $getData->net == '0' ? '' : 'checked' ?>> No
						</label>
						<label style="margin-left:20px">
							<input type="radio" name="net" class="net" value="1" <?= $getData->net == '1' ? 'checked' : '' ?>> Yes
						</label>
						<label class="label label-danger net hideIt">Category Can't be empty!</label>
					</div>
					<div class="form-group">
						<?php
						if ($getData->ppn == '0') {
							$No = 'checked';
							$Yes = '';
							$default = '';
						} else if ($getData->ppn == '1') {
							$Yes = 'checked';
							$No = '';
							$default = '';
						} else {
							$Yes = '';
							$No = '';
							$default = 'checked';
						}
						?>
						<label style="width:70px">PPN <span class='text-red'>*</span></label>
						<label style="margin-left:20px">
							<input type="radio" name="ppn" class="ppn" value="0" <?= $No ?>> No
						</label>
						<label style="margin-left:20px">
							<input type="radio" name="ppn" class="ppn" value="1" <?= $Yes . $default ?>> Yes </label>
						<label class="label label-danger ppn hideIt">PPN Can't be empty!</label>
					</div>
					<div class="form-group">
						<div><label>Project Name <span class='text-red'>*</span></label></div>
						<strong>
							<input type="text" class="form-control input required" placeholder="Project Name" name="pr_name" id="pr_name" value="<?= empty($getData->project_name) ? '' : $getData->project_name ?>">
							<label class="label label-danger pr_name hideIt">Date Can't be empty!</label>
						</strong>
					</div>
				</div>
			</div>
		</div>


		<hr>
		<div class="box box-solid">
			<div class="box-header">
				<!-- <h3 class="box-title"></h3> -->
				<table id="my-grid3" class="table-condensed" width="100%">
					<thead>
						<tr>
							<th class="text">DETAIL DATA ORDER</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="box-body">
				<div class="" id="data-item">
				</div>
				<div class="pull-right">
					<button type="button" class="btn btn-sm btn-success" id="tambah-ruang"><i class="fa fa-plus"></i> Tambah Jendela</button>

				</div>
			</div>
			<div class="box-footer">
				<?php
				echo form_button(array('type' => 'button', 'class' => 'btn btn-md btn-success label_input', 'style' => 'min-width:100px; float:right;', 'value' => 'save', 'content' => 'Save', 'id' => 'saveQuotation')) . ' ';
				?>
			</div>
		</div>
	</div>
</form>

<div class="modal fade" id="ModalView">
	<div class="modal-dialog" style="width:90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="head_title">List Data</h4>
			</div>
			<div class="modal-body">
				<div class="box box-primary">
					<div class="box-body" id="view">

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span> Close</button>
				<button type="button" class="btn btn-warning" onclick="AddData()" data-dismiss="modal">
					<span class="glyphicon glyphicon-save"></span> Add Data</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		if ('<?= $getData->id ?>' != '') {
			var selector = "ruang";
			var selectorCount = 0;
			var id = '<?= $getData->id ?>';
			// alert(selectorCount)
			$('div[data-item=' + selector + ']').each(function() {
				selectorCount++;
			});

			// alert(selectorCount);
			if (selectorCount == 0) {
				count = selectorCount;
				$.ajax({
					url: siteurl + active_controller + 'load_form',
					type: 'POST',
					data: {
						'count': count,
						'id': id
					},
					success: function(data) {
						$("#data-item").append(data);
					}
				});
			} else {
				// count = selectorCount;
				// $.ajax({
				// 	url: siteurl + active_controller + 'load_form',
				// 	type: 'POST',
				// 	data: {
				// 		'count': count
				// 	},
				// 	success: function(data) {
				// 		// $("#data-item").append(data);
				// 	}
				// });

			}
		}
	})


	$(document).on('click', '#tambah-ruang', function() {
		var selector = "ruang";
		var selectorCount = 0;
		var nomor = $('#nomor').val();

		$('div[data-item=' + selector + ']').each(function() {
			selectorCount++;
		});

		// alert(selectorCount);
		if (selectorCount == 0) {
			count = selectorCount;
			$.ajax({
				url: siteurl + active_controller + 'load_form',
				type: 'POST',
				data: {
					'count': count,
					'nomor': nomor,
				},
				success: function(data) {
					$("#data-item").append(data);
				}
			});
		} else {
			count = selectorCount;
			$.ajax({
				url: siteurl + active_controller + 'load_form',
				type: 'POST',
				data: {
					'count': count,
					'nomor': nomor
				},
				success: function(data) {
					$("#data-item").append(data);
				}
			});

		}
	})

	$(document).on('change', '#id_cuctomer', function() {
		var cust = $(this).val();
		$.ajax({
			type: 'POST',
			url: siteurl + 'quotation_proses/dataCustomer',
			data: {
				'id_cust': cust
			},
			dataType: 'json',
			success: function(result) {
				// console.log(result['cat_cust']);
				if (result['customer'] != null) {
					if (result['pic'] != null && result['cat_cust'] != null) {
						$('#id_pic').val(result['pic'].id_pic);
						$('#nm_pic').val(result['pic'].name_pic);
						$('#address').val(result['customer'].address_office);
						$('#id_cust_cut').val(result['customer'].id_category_customer);
						$('#nm_cust_cut').val(result['cat_cust'].name_category_customer);
						$('#id_cust').val(result['customer'].id_customer);
					} else {
						alert('Ada data kosong!');
						$('#id_cuctomer').text();
						$('#id_cuctomer').val('');
						$('#id_pic').val('');
						$('#nm_pic').val('');
						$('#address').val('');
						$('#id_cust_cut').val('');
						$('#nm_cust_cut').val('');
						$('#id_cust').val('');
					}

				} else {
					$('#id_cust').val('');
					$('#id_pic').val('');
					$('#nm_pic').val('');
					$('#address').val('');
					$('#id_cust_cut').val('');
					$('#nm_cust_cut').val('');
				}

			},
			error: function() {
				alert('Ajax Error..!!!!!!');
			}

		})

	})

	$(document).on('change', '#id_disc_cat', function() {
		var disc_cat = $(this).val();
		$.ajax({
			type: 'POST',
			url: siteurl + 'quotation_proses/dataDiscCat',
			data: {
				'id_disc_cat': disc_cat
			},
			dataType: 'json',
			success: function(result) {
				// console.log(result['result']);
				if (result['result'] != null) {
					$('#disc_cat').val(result['result'].discount + '%');
					$('.pilihMainten').prop('disabled', false);
					$('.pilihMainten-lining').prop('disabled', false);
					$('.pilihMainten-vitrage').prop('disabled', false);
				} else {
					$('#disc_cat').val('');
				}
			},
			error: function() {
				alert('Ajax Error..!!!!!!');
			}

		})

	})

	// $('#dtDetail').DataTable({
	// 	"paging": false,
	// 	"searching": false,
	// 	"lengthChange": false,
	// 	"ordering": false

	// });


	jQuery(document).on('keyup keypress blur', '.numberOnly', function() {
		if ((event.which < 48 || event.which > 57) && (event.which < 46 || event.which > 46) && event.which != 43) {
			event.preventDefault();
		}
	});

	jQuery(document).on('keyup change', '.nominal', function() {
		var val = this.value;
		val = val.replace(/[^0-9\.]/g, '');

		if (val != "") {
			valArr = val.split(',');
			valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
			val = valArr.join(',');
		}

		this.value = val;
	});

	//========================================================================
	var id = $('#nomor').val();
	if (id == '') {
		$.ajax({
			url: siteurl + active_controller + "getID",
			dataType: "json",
			type: 'POST',
			data: {
				'id': id
			},
			success: function(result) {
				$('#nomor').val(result.id);
			},
			error: function(request, error) {
				console.log(arguments);
				alert(" Can't do because: " + error);
			}
		});
	}

	$(document).ready(function() {

		getCustomer();
		getTypeProject();
		getKar();
		getDiscCat()

		$(".datepicker").datepicker({
			format: "yyyy-mm-dd",
			showInputs: true,
			autoclose: true
		});

		$(".select2").select2({
			placeholder: "Choose An Option",
			allowClear: true,
			width: '100%',
			dropdownParent: $("#form-quotation")
		});

		$('.select2-search--inline').css('margin-right', '5%');
		$('.select2-search--inline').css('width', '100%');
		$('.select2-search__field').css('margin-right', '5%');
		$('.select2-search__field').css('width', '90% !important');
		$('.select2-search__field').css('padding-right', '5%');

		$(document).on('click change keyup paste blur', '#form-quotation .form-control', function(e) {
			//console.log('AHAHAHAHA');
			var val = $(this).val();
			var id = $(this).attr('id');
			if (val == '') {
				//$('.'+id).addClass('hideIt');
				$('.' + id).css('display', 'inline-block');
			} else {
				$('.' + id).css('display', 'none');
			}
		});

		if ('<?= $this->uri->segment(4) ?>' == 'view') {
			$('.label_view').css("display", "block");
			$('.label_input').css("display", "none");
		} else {
			$('.label_view').css("display", "none");
			$('.label_input').css("display", "block");
		}
		console.log('<?= $this->uri->segment(4) ?>');
	});

	function getDiscCat() {
		if ('<?= ($getData->id_disc_cat) ?>' != null) {
			var id_selected = '<?= $getData->id_disc_cat ?>';
		} else if ($('#id_disc_cat').val() != null || $('#id_disc_cat').val() != '') {
			var id_selected = $('#id_disc_cat').val();
		} else {
			var id_selected = '';
		}
		//console.log(id_selected);
		var column = 'id_category';
		var column_fill = '';
		var column_name = 'name_cat';
		var table_name = 'discount_category';
		var key = 'id_category';
		var act = 'free';
		$.ajax({
			url: siteurl + active_controller + "getOpt",
			dataType: "json",
			type: 'POST',
			data: {
				id_selected: id_selected,
				column: column,
				column_fill: column_fill,
				column_name: column_name,
				table_name: table_name,
				key: key,
				act: act
			},
			success: function(result) {
				$('#id_disc_cat').html(result.html);
			},
			error: function(request, error) {
				console.log(arguments);
				alert(" Can't do because: " + error);
			}
		});
	}

	function getCustomer() {
		if ('<?= ($getData->id_customer) ?>' != null) {
			var id_selected = '<?= $getData->id_customer ?>';
		} else if ($('#id_customer').val() != null || $('#id_customer').val() != '') {
			var id_selected = $('#id_customer').val();
		} else {
			var id_selected = '';
		}
		//console.log(id_selected);
		var column = 'activation';
		var column_fill = 'active';
		var column_name = 'name_customer';
		var table_name = 'master_customer';
		var key = 'id_customer';
		var act = 'free';
		$.ajax({
			url: siteurl + active_controller + "getOpt",
			dataType: "json",
			type: 'POST',
			data: {
				id_selected: id_selected,
				column: column,
				column_fill: column_fill,
				column_name: column_name,
				table_name: table_name,
				key: key,
				act: act
			},
			success: function(result) {
				$('#id_cuctomer').html(result.html);
			},
			error: function(request, error) {
				console.log(arguments);
				alert(" Can't do because: " + error);
			}
		});
	}

	function getTypeProject() {
		if ('<?= ($getData->id_type_project) ?>' != null) {
			var id_selected = '<?= $getData->id_type_project ?>';
		} else if ($('#type_project').val() != null || $('#type_project').val() != '') {
			var id_selected = $('#type_project').val();
		} else {
			var id_selected = '';
		}
		//console.log(id_selected);
		var column = 'id_type_project';
		var column_fill = '';
		var column_name = 'nm_type_project';
		var table_name = 'type_project';
		var key = 'id_type_project';
		var act = 'free';
		$.ajax({
			url: siteurl + active_controller + "getOpt",
			dataType: "json",
			type: 'POST',
			data: {
				id_selected: id_selected,
				column: column,
				column_fill: column_fill,
				column_name: column_name,
				table_name: table_name,
				key: key,
				act: act
			},
			success: function(result) {
				$('#type_project').html(result.html);
			},
			error: function(request, error) {
				console.log(arguments);
				alert(" Can't do because: " + error);
			}
		});
	}

	function getKar() {
		if ('<?= ($getData->id_karyawan) ?>' != null) {
			var id_selected = '<?= $getData->id_karyawan ?>';
		} else if ($('#id_karyawan').val() != null || $('#id_karyawan').val() != '') {
			var id_selected = $('#id_karyawan').val();
		} else {
			var id_selected = '';
		}
		//console.log(id_selected);
		var column = 'id_karyawan';
		var column_fill = '';
		var column_name = 'nama_karyawan';
		var table_name = 'karyawan';
		var key = 'id_karyawan';
		var act = 'free';
		$.ajax({
			url: siteurl + active_controller + "getOpt",
			dataType: "json",
			type: 'POST',
			data: {
				id_selected: id_selected,
				column: column,
				column_fill: column_fill,
				column_name: column_name,
				table_name: table_name,
				key: key,
				act: act
			},
			success: function(result) {
				$('#id_karyawan').html(result.html);
			},
			error: function(request, error) {
				console.log(arguments);
				alert(" Can't do because: " + error);
			}
		});
	}

	jQuery(document).on('click', '#saveQuotation', function() {
		var valid = getValidation();
		if (valid) {
			// var formdata = $("#form-quotation").serialize();
			var formdata = new FormData($("#form-quotation")[0]);
			console.log(formdata);
			// exit();
			$.ajax({
				url: siteurl + active_controller + "saveQuotation",
				dataType: "json",
				type: 'POST',
				data: formdata,
				contentType: false,
				cache: false,
				processData: false,
				async: false,
				success: function(result) {
					if (result.status == '1') {
						swal({
							title: "Sukses!",
							text: result['pesan'],
							type: "success",
							timer: 1500,
							showConfirmButton: false
						});
						setTimeout(function() {
							open(siteurl + active_controller + 'qt_pro_open', '_self');
						}, 1600);
					} else {
						swal({
							title: "Gagal!",
							text: result['pesan'],
							type: "error",
							timer: 1500,
							showConfirmButton: false
						});
					};
				},
				error: function(request, error) {
					console.log(arguments);
					alert(" Can't do because: " + error);
				}
			});
		} else {
			swal({
				title: "Gagal!",
				text: 'Please fill in the blank form!',
				type: "error",
				timer: 1500,
				showConfirmButton: false
			});
		}
	});
</script>