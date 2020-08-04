<?php
    $ENABLE_ADD     = has_permission('Pricelist_accessories_model.Add');
    $ENABLE_MANAGE  = has_permission('Pricelist_accessories_model.Manage');
    $ENABLE_VIEW    = has_permission('Pricelist_accessories_model.View');
    $ENABLE_DELETE  = has_permission('Pricelist_accessories_model.Delete');
?>

<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">

<div class="nav-tabs-custom">
    

    <div class="tab-content">
        <div class="tab-pane active" id="Process_cost">
          <div class="box box-primary">
              <div class="box-header">
                <div style="display:inline-block;width:100%;">
                  <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Add" onclick="add_data()" style="float:left;margin-right:8px"><i class="fa fa-plus">&nbsp;</i>New</a>
                  <!--<a class="btn btn-sm btn-danger pdf" id="pdf-report" style="float:right;margin:8px 8px 0 0"><i class="fa fa-file"></i> PDF</a>-->
                  <!--<a class="btn btn-sm btn-success excel" id="excel-report" style="float:right;margin:8px 8px 0 0"><i class="fa fa-table"></i> Excel</a>-->
                </div>

              </div>
              <div class="box-body">

                <table id="tableset" class="table table-bordered table-striped">
                  <thead>
                    <tr>
						<th width="5">#</th>
						<th width="15%">ID Product</th>
						<th  class="text-">Name Product</th>
						<th width="10%" class="text-center">Buy Price</th>
						<th width="10%" class="text-center">Rate Cost</th>
						<th width="5%" class="text-center">Profit(%)</th>
						<th width="10%" class="text-center">Bottom Price</th>
						<th width="5%" class="text-right">Pricelist</th>
						<th width="10%" class="text-center">Status</th>
						<?php if ($ENABLE_MANAGE) : ?>
						<th width="15%">Action</th>
						<?php endif; ?>
                    </tr>
                  </thead>

                <tbody id="tbody-detail">

                </tbody>

                <tfoot>
                  <tr>
                    <th width="5">#</th>
                    <th width="15%">ID Product</th>
					<th  class="text-">Name Product</th>
					<th width="10%" class="text-center">Buy Price</th>
					<th width="10%" class="text-center">Harga Modal</th>
					<th width="5%" class="text-center">Profit(%)</th>
					<th width="10%" class="text-center">Bottom Price</th>
					<th width="5%" class="text-right">Pricelist</th>
					<th width="10%" class="text-center">Status</th>
					<?php if ($ENABLE_MANAGE) : ?>
					<th width="">Action</th>
					<?php endif; ?>
                  </tr>
                </tfoot>
                </table>
              </div>
          </div>
        </div>
    </div>
</div>



<form id="form-modal" action="" method="post">
  <div class="modal fade" id="ModalView">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="head_title"></h4>
        </div>
        <div class="modal-body" id="view">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ModalView2">
    <div class="modal-dialog"  style='width:30%; '>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="head_title2"></h4>
          </div>
          <div class="modal-body" id="view2">
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-primary">Save</button>-->
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="ModalView3">
      <div class="modal-dialog"  style='width:30%; '>
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="head_title3"></h4>
            </div>
            <div class="modal-body" id="view3">
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn btn-primary">Save</button>-->
              <button type="button" class="btn btn-default close3" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!-- modal -->
</form>
<!-- Modal Bidus-->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<!-- End Modal Bidus-->
<style>
  .box-primary{

    border: 1px solid #ddd;
  }
</style>
<script type="text/javascript">

  $(document).ready(function() {
	  jQuery(document).on('keyup', '.nominal', function(){
		var val = this.value;
		val = val.replace(/[^0-9\.]/g,'');

		if(val != "") {
		  valArr = val.split(',');
		  valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
		  val = valArr.join(',');
		}

		this.value = val;
	  });
    //var table = $('#example1').DataTable();
    DataTables('set');

    $("#excel-report").on('click', function() {
      if (document.getElementById("hide-click").classList.contains('hide_colly')) {
        window.location.href = siteurl+"barang_wset/downloadExcel/hide";
      }else {
        window.location.href = siteurl+"barang_wset/downloadExcel/unhide";
      }
    });

    $("#pdf-report").on('click', function() {
      if (document.getElementById("hide-click").classList.contains('hide_colly')) {
        window.open = siteurl+"barang_wset/print_rekap/hide";
      }else {
        window.open = siteurl+"barang_wset/print_rekap/unhide";
      }
    });

    //Edit
    $(document).on('click', '.edit', function(e){
      var id = $(this).data('id_product');
      $(".modal-dialog").css('width','60%');
      $("#head_title").html("<b>EDIT PRICELIST</b>");
      $("#view").load(siteurl+active_controller+'/modal_Process/Process_Cost/edit/'+id);
      $("#ModalView").modal();
		});

    //DETAIL
    $(document).on('click', '.detail', function(e){
      var id = $(this).data('id_product');
      $(".modal-dialog").css('width','60%');
      $("#head_title").html("<b>DETAIL PRICELIST</b>");
      $("#view").load(siteurl+active_controller+'modal_Process/Process_Cost/view/'+id);
      $("#ModalView").modal();
		});
//--------------------------------------------------------------------------------------------
    $(document).on('click', '.edit_ProductCategory', function(e){
      var id = $(this).data('id_category');
      $(".modal-dialog").css('width','30%');
      $("#head_title").html("<b>EDIT FORM</b>");
      $("#view").load(siteurl+active_controller+'/modal_Process/ProductCategory/edit/'+id);
      $("#ModalView").modal();
		});

    //DELETE
    $(document).on('click', '.delete', function(e){
      var id_product = $(this).data('id_product');
      swal({
        title: "Are you sure?",
        text: "You will not be able to process again this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: siteurl+active_controller+"deleteData",
            dataType : "json",
            type: 'POST',
            data: {id_product:id_product},
            success: function(result){
              swal({
                title	: "Delete Success!",
                text	: result.msg,
                type	: "success",
                timer	: 1500,
                showCancelButton	: false,
                showConfirmButton	: false,
                allowOutsideClick	: false
              });
              DataTables('set');
            },
            error: function (request, error) {
              console.log(arguments);
              swal({
                title				: "Error Message !",
                text				: 'An Error Occured During Process. Please try again..',
                type				: "warning",
                timer				: 5000,
                showCancelButton	: false,
                showConfirmButton	: false,
                allowOutsideClick	: false
              });
            }
          });
		  
		} else {
		  swal("Batal Proses", "Data bisa diproses nanti", "error");
		  return false;
		}
	  });
	});
	
	//APPROVE
    $(document).on('click', '.approve', function(e){
      var id_product = $(this).data('id_product');
      swal({
        title: "Are you sure?",
        text: "This data will be approved?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: siteurl+active_controller+"approveData",
            dataType : "json",
            type: 'POST',
            data: {id_product:id_product},
            success: function(result){
              if (result.status == 0){
				swal({
					title	: "Oops!",
					text	: result.msg,
					type	: "warning",
					timer	: 2000,
					showCancelButton	: false,
					showConfirmButton	: false,
					allowOutsideClick	: false
				  });
			  } else {
				  swal({
					title	: "Approve Success!",
					text	: result.msg,
					type	: "success",
					timer	: 1500,
					showCancelButton	: false,
					showConfirmButton	: false,
					allowOutsideClick	: false
				  });
			  }
              DataTables('set');
            },
            error: function (request, error) {
              console.log(arguments);
              swal({
                title				: "Error Message !",
                text				: 'An Error Occured During Process. Please try again..',
                type				: "warning",
                timer				: 5000,
                showCancelButton	: false,
                showConfirmButton	: false,
                allowOutsideClick	: false
              });
            }
          });
		  
		} else {
		  swal("Batal Proses", "Data bisa diproses nanti", "error");
		  return false;
		}
	  });
	});
	
	$(document).on('click', '.delete_cat', function(e){
      var id_category = $(this).data('id_category');
      swal({
        title: "Are you sure?",
        text: "You will not be able to process again this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: siteurl+active_controller+"deleteCat",
            dataType : "json",
            type: 'POST',
            data: {id_category:id_category},
            success: function(result){
              swal({
                title	: "Delete Success!",
                text	: result.msg,
                type	: "success",
                timer	: 1500,
                showCancelButton	: false,
                showConfirmButton	: false,
                allowOutsideClick	: false
              });
              DataTables('set');
            },
            error: function (request, error) {
              console.log(arguments);
              swal({
                title				: "Error Message !",
                text				: 'An Error Occured During Process. Please try again..',
                type				: "warning",
                timer				: 5000,
                showCancelButton	: false,
                showConfirmButton	: false,
                allowOutsideClick	: false
              });
            }
          });
		  
		} else {
		  swal("Batal Proses", "Data bisa diproses nanti", "error");
		  return false;
		}
	  });
	});

    //Modal1 Supplier
    $('#ModalView3').on('hidden.bs.modal', function () {
        $('body').addClass('modal-open');
        $("#head_title3").html("");
        $("#view3").html("");
    });
    $('#ModalView2').on('hidden.bs.modal', function () {
        $('body').addClass('modal-open');
        $("#head_title2").html("");
        $("#view2").html("");
    });
    $('#ModalView').on('hidden.bs.modal', function () {
        $("#head_title").html("");
        $("#view").html("");
    });
   
    $(document).on('click', '#add_ProCat', function(e){
      $("#ModalView2 .modal-dialog").css('width','30%');
      $("#head_title2").html("<b>Add Product Category</b>");
      $("#view2").load(siteurl+active_controller+'/modal_Process/ProductCategory/add/');
      $("#ModalView2").modal();
    });
	
    $(document).on('click', '#addProductCategorySave', function(e){
      var formdata = $("#form-category").serialize();
      $.ajax({
        url: siteurl+active_controller+"saveProductCategory",
        dataType : "json",
        type: 'POST',
        data: formdata,
        success: function(result){
          //console.log(result['msg']);
          if(result.status=='1'){
            swal({
              title: "Sukses!",
              text: result['msg'],
              type: "success",
              timer: 1500,
              showConfirmButton: false
            });
            setTimeout(function(){
              if (($("#ModalView2").data('bs.modal') || {}).isShown) {
                $("#ModalView2").modal('hide');
                $("#view2").html('');
                getProCat();
              }else {
                $("#ModalView").modal('hide');
                $("#view").html('');
                DataTables('set');
              }
              //$('body').addClass('modal-open');
            },1600);
          } else {
            swal({
              title: "Gagal!",
              text: result['msg'],
              type: "error",
              timer: 1500,
              showConfirmButton: false
            });
          };
        },
        error: function (request, error) {
          console.log(arguments);
          alert(" Can't do because: " + error);
        }
      });
      //$("#ModalView").modal('hide');
    });
	
    jQuery(document).on('click', '#addSave', function(){
      var valid = getValidation();
      //console.log(valid);
      if (valid) {
        var formdata = new FormData(document.getElementById("form-data"));//$("#form-data").serialize();
        // console.log(formdata);
        $.ajax({
          url: siteurl+active_controller+"savePricelist",
          dataType : "json",
          type: 'POST',
          data: formdata,
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          success: function(result){
            if(result.status=='1'){
              swal({
                title: "Sukses!",
                text: result['pesan'],
                type: "success",
                timer: 1500,
                showConfirmButton: false
              });
              setTimeout(function(){
                DataTables('set');
                if (($("#ModalView3").data('bs.modal') || {}).isShown) {
                  $("#ModalView3").modal('hide');
                }else {
                  $("#ModalView").modal('hide');
                }

              },1600);
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
          error: function () {
            console.log(arguments);
			swal({
                title: "Can't do because:",
                text: 'error',
                type: "error",
                timer: 1500,
                showConfirmButton: false
              });
            // alert(" Can't do because: " + result.pesan);
          }
        });
      }else {
        swal({
          title: "Gagal!",
          text: 'Please fill in the blank form!',
          type: "error",
          timer: 1500,
          showConfirmButton: false
        });
      }

      //$("#ModalView").modal('hide');
    });

  });
  jQuery(document).on('keyup keypress blur', '.numberOnly', function(){
    if ((event.which < 48 || event.which > 57 ) && (event.which < 46 || event.which > 46 ) && event.which != 43) {
      event.preventDefault();
    }
  });


  function DataTables(set=null){
    var dataTable = $('#tableset').DataTable({
      "serverSide": true,
      "stateSave" : true,
      "bAutoWidth": true,
      "destroy": true,
      "responsive": true,
      "oLanguage": {
        "sSearch": "<b>Live Search : </b>",
        "sLengthMenu": "_MENU_ &nbsp;&nbsp;<b>Records Per Page</b>&nbsp;&nbsp;",
        "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
        "sInfoFiltered": "(filtered from _MAX_ total entries)",
        "sZeroRecords": "No matching records found",
        "sEmptyTable": "No data available in table",
        "sLoadingRecords": "Please wait - loading...",
        "oPaginate": {
          "sPrevious": "Prev",
          "sNext": "Next"
        }
      },
      "aaSorting": [[ 1, "asc" ]],
      "columnDefs": [ {
        "targets": 'no-sort',
        "orderable": false,
      }],
      "sPaginationType": "simple_numbers",
      "iDisplayLength": 5,
      "aLengthMenu": [[5, 10, 20, 50, 100, 150], [5, 10, 20, 50, 100, 150]],
      "ajax":{
        url : siteurl + active_controller + 'getDataJSON',
        type: "post",
        data: function(d){
          d.activation 	= 'aktif'
        },
        cache: false,
        error: function(){
          $(".my-grid-error").html("");
          $("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
          $("#my-grid_processing").css("display","none");
        }
      }
    });

    var dataTable2 = $('#table-category').DataTable({
      "serverSide": true,
      "stateSave" : true,
      "bAutoWidth": true,
      "destroy": true,
      "responsive": true,
      "oLanguage": {
        "sSearch": "<b>Live Search : </b>",
        "sLengthMenu": "_MENU_ &nbsp;&nbsp;<b>Records Per Page</b>&nbsp;&nbsp;",
        "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
        "sInfoFiltered": "(filtered from _MAX_ total entries)",
        "sZeroRecords": "No matching records found",
        "sEmptyTable": "No data available in table",
        "sLoadingRecords": "Please wait - loading...",
        "oPaginate": {
          "sPrevious": "Prev",
          "sNext": "Next"
        }
      },
      "aaSorting": [[ 1, "asc" ]],
      "columnDefs": [ {
        "targets": 'no-sort',
        "orderable": false,
      }],
      "sPaginationType": "simple_numbers",
      "iDisplayLength": 5,
      "aLengthMenu": [[5, 10, 20, 50, 100, 150], [5, 10, 20, 50, 100, 150]],
      "ajax":{
        url : siteurl + active_controller + 'getDataCategory',
        type: "post",
        data: function(d){
          d.activation 	= 'active'
        },
        cache: false,
        error: function(){
          $(".my-grid-error").html("");
          $("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
          $("#my-grid_processing").css("display","none");
        }
      }
    });

  }

  function add_data(){
    $(".modal-dialog").css('width','60%');
    $("#head_title").html("<b>Add Approval Fabric Cost</b>");
    $("#view").load(siteurl+active_controller+'/modal_Process/Process_Cost/add/');
    $("#ModalView").modal();
  }

</script>
