<?php
$ENABLE_ADD     = has_permission('Quotation_proses.Add');
$ENABLE_MANAGE  = has_permission('Quotation_proses.Manage');
$ENABLE_VIEW    = has_permission('Quotation_proses.View');
$ENABLE_DELETE  = has_permission('Quotation_proses.Delete');
?>


<div class="nav-tabs-custom">
  <!--<ul class="nav nav-tabs">
        <li class="active"><a href="#Accomodation" data-toggle="tab" aria-expanded="true" >Accomodation</a></li>
        <li class=""><a href="#Category" data-toggle="tab" aria-expanded="false" >Category</a></li>
    </ul>-->
  <div class="tab-content">
    <div class="tab-pane active" id="Delivery">
      <div class="box box-primary">
        <div class="box-header">
          <div style="display:inline-block;width:100%;">
            <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Add" onclick="add_data()" style="float:left;margin-right:8px"><i class="fa fa-plus">&nbsp;</i>New</a>
            <!--<a class="btn btn-sm btn-danger pdf" id="pdf-report" style="float:right;margin:8px 8px 0 0"><i class="fa fa-file"></i> PDF</a>-->
            <a href="<?= base_url('quotation_proses/downloadExcel') ?>" class="btn btn-sm btn-success excel" id="excel-report" style="float:right;margin:8px 8px 0 0"><i class="fa fa-table"></i> Excel</a>
          </div>

        </div>
        <div class="box-body">
          <table id="tableset" class="table-condensed table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th width="5">#</th>
                <th>Quotation Code</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Marketing</th>
                <th width="10%" class="text-center">Total</th>
                <th class="text-center">Status</th>
                <th>Reason</th>
                <?php if ($ENABLE_MANAGE) : ?>
                  <th width="5%">Action</th>
                <?php endif; ?>
              </tr>
            </thead>

            <tbody id="tbody-detail">
            </tbody>

            <tfoot>
              <tr>
                <th width="5">#</th>
                <th>Quotation Code</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Marketing</th>
                <th width="10%" class="text-center">Total</th>
                <th class="text-center">Status</th>
                <th>Reason</th>
                <?php if ($ENABLE_MANAGE) : ?>
                  <th width="5%">Action</th>
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
    <div class="modal-dialog" style='width:30%; '>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="head_title2"></h4>
        </div>
        <div class="modal-body" id="view2">
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-primary">Save</button> -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ModalView3">
    <div class="modal-dialog" style='width:30%; '>
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

<script type="text/javascript">
  $(document).ready(function() {
    jQuery(document).on('keyup', '.nominal', function() {
      var val = this.value;
      val = val.replace(/[^0-9\.]/g, '');

      if (val != "") {
        valArr = val.split(',');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join(',');
      }

      this.value = val;
    });
    //var table = $('#example1').DataTable();
    DataTables('set');

    $("#pdf-report").on('click', function() {
      if (document.getElementById("hide-click").classList.contains('hide_colly')) {
        window.open = siteurl + "barang_wset/print_rekap/hide";
      } else {
        window.open = siteurl + "barang_wset/print_rekap/unhide";
      }
    });

    //Edit
    $(document).on('click', '.edit', function(e) {
      var id = $(this).data('id_quotation');
      new_id = id.replace(/\//g, '-');
      // alert(new_id);
      // $(".modal-dialog").css('width', '80%');
      // $("#head_title").html("<b>EDIT QUOTATION</b>");
      window.location.href = siteurl + active_controller + 'editQuotation/' + new_id;
      // $("#view").load(siteurl + active_controller + '/modal_Process/Delivery/edit/' + id);
      // $("#ModalView").modal();
    });

    $(document).on('click', '.detail', function(e) {
      var id = $(this).data('id_quotation');
      newId = id.replace(/\//g, '-');
      // alert(newId)
      $.ajax({
        type: "post",
        url: siteurl + active_controller + 'modal_view',
        data: {
          'id': newId
        },
        success: function(result) {
          $(".modal-dialog").css('width', '90%');
          $("#head_title").html("<b>DATA QUOTATION</b>");
          $("#view").html(result);
          $("#ModalView").modal('show');

        }
      })

    });

    $(document).on('click', '.reopen_po', function(e) {
      var id_quotation = $(this).data('id_quotation');
      swal({
          title: "Are you sure?",
          text: "This PO data will be 'Re-opened'",
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
              url: siteurl + active_controller + "reopen_po",
              dataType: "json",
              type: 'POST',
              data: {
                id_quotation: id_quotation
              },
              success: function(result) {
                swal({
                  title: "Delete Success!",
                  text: result.msg,
                  type: "success",
                  timer: 1500,
                  showCancelButton: false,
                  showConfirmButton: false,
                  allowOutsideClick: false
                });
                DataTables('set');
              },
              error: function(request, error) {
                console.log(arguments);
                swal({
                  title: "Error Message !",
                  text: 'An Error Occured During Process. Please try again..',
                  type: "warning",
                  timer: 5000,
                  showCancelButton: false,
                  showConfirmButton: false,
                  allowOutsideClick: false
                });
              }
            });

          } else {
            swal("Batal Proses", "Data bisa diproses nanti", "error");
            return false;
          }
        });
    });

    $(document).on('click', '.change_po', function(e) {
      var id = $(this).data('id_quotation');
      newId = id.replace(/\//g, '-');
      // alert(newId)
      $.ajax({
        type: "post",
        url: siteurl + active_controller + 'upload_po',
        data: {
          'id': newId
        },
        success: function(result) {
          $(".modal-dialog").css('width', '90%');
          $("#head_title").html("<b>DATA QUOTATION</b>");
          $("#view").html(result);
          $("#ModalView").modal('show');

        }
      })

    });

    //DETAIL
    $(document).on('click', '.print', function(e) {
      var id = $(this).data('id_quotation');
      newId = id.replace(/\//g, '-');
      window.open(siteurl + active_controller + 'print_quotation/' + newId, '_blank');
    });
    //--------------------------------------------------------------------------------------------


  });
  jQuery(document).on('keyup keypress blur', '.numberOnly', function() {
    if ((event.which < 48 || event.which > 57) && (event.which < 46 || event.which > 46) && event.which != 43) {
      event.preventDefault();
    }
  });


  function DataTables(set = null) {
    var dataTable = $('#tableset').DataTable({
      "serverSide": true,
      "stateSave": true,
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
      "aaSorting": [
        [1, "asc"]
      ],
      "columnDefs": [{
        "targets": 'no-sort',
        "orderable": false,
      }],
      "sPaginationType": "simple_numbers",
      "iDisplayLength": 10,
      "aLengthMenu": [
        [5, 10, 20, 50, 100, 150],
        [5, 10, 20, 50, 100, 150]
      ],
      "ajax": {
        url: siteurl + active_controller + 'getQuotationLost',
        type: "post",
        data: function(d) {
          d.activation = 'aktif'
        },
        cache: false,
        error: function() {
          $(".my-grid-error").html("");
          $("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
          $("#my-grid_processing").css("display", "none");
        }
      }
    });



  }

  function add_data() {
    // $(".modal-dialog").css('width','90%');
    // $("#head_title").html("<b>Add Quotation</b>");
    window.location.href = siteurl + active_controller + 'addQuotation';
    // $("#ModalView").modal();
  }
</script>