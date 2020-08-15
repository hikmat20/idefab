<form class="" id="form-quotation" action="" method="post" enctype="multipart/form-data">
  <div class=" box-solid">
    <div class="box-header">
      <table id="my-grid3" class="table-condensed" width="100%">
        <thead>
          <tr>
            <th class="text">CUSTOMER DATA INFORMATION</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <table width="100%" class="-condensed">
            <tbody>
              <tr>
                <td width="30%">
                  <label>Quotation Number</label>
                </td>
                <td>: <?= $data->nomor ?></td>
                <input type="hidden" name="nomor" value="<?= $data->nomor ?>">
                <input type="hidden" name="id_quotation" value="<?= $data->id ?>">
              </tr>
              <tr>
                <td>
                  <label>Customer</label>
                </td>
                <td>: <?= $customer->name_customer ?></td>
              </tr>
              <tr>
                <td>
                  <label>PIC</label>
                </td>
                <td>: <?= $pic_cust->name_pic ?></td>
              </tr>
              <tr>
                <td>
                  <label>Address</label>
                </td>
                <td>: <?= $customer->address_office ?></td>
              </tr>
              <tr>
                <td>
                  <label>Category Customer</label>
                </td>
                <td>: <?= $cat_cust->name_category_customer ?></td>
              </tr>
              <tr>
                <td>
                  <label>Discount Category</label>
                </td>
                <td>: <?= $disc_cat->name_cat ?> (<?= $data->val_disc_cat != '' ? $data->val_disc_cat . '%' : '' ?>)</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-6">
          <table width="100%" class="-condensed">
            <tbody>
              <tr>
                <td width="30%">
                  <label>Date</label>
                </td>
                <td>: <?= $data->date ?></td>
              </tr>
              <tr>
                <td>
                  <label>Category Sales</label>
                </td>
                <td>: <?= $data->sales_category ?></td>
              </tr>
              <tr>
                <td>
                  <label>Type Project</label>
                </td>
                <td>: <?= $type_pro->nm_type_project ?></td>
              </tr>
              <tr>
                <td>
                  <label>Marketing</label>
                </td>
                <td>: <?= $karyawan->nama_karyawan ?></td>
              </tr>
              <tr>
                <td>
                  <label>Nett Price / PPN</label>
                </td>
                <td>: <?= $data->net == '0' ? 'No' : 'Yes' ?> / <?= $data->ppn == '0' ? 'No' : 'Yes' ?></td>
              </tr>
              <tr>
                <td>
                  <label>Project Name</label>
                </td>
                <td>: <?= $data->project_name ?></td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
      <hr>
      <table id="my-grid3" class="table-condensed" width="100%">
        <thead>
          <tr>
            <th class="text">PURCHASE ORDER INFORMATION</th>
          </tr>
        </thead>
      </table>
      <div class="row">
        <div class="col-md-6">
          <div class="fom-horizontal">
            <?php
            // echo "<pre>";
            // print_r($data);
            // echo "<pre>";

            ?>
            <div class="form-group">
              <label class="control-label col-sm-3" style="margin: 5px 0px;" for="">PO Number <span class="text-red">*</span></label>
              <div class="col-sm-9">
                <input type="text" id="po_number" value="<?= $data->no_po ?>" style="margin: 5px 0px;" class="required form-control" name="po_number" placeholder="PO Number">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="">Upload Date <span class="text-red">*</span></label>
              <div class="col-sm-9">
                <input type="date" id="date_upload" value="<?= $data->tgl_upload_po ?>" style="margin: 5px 0px;" class="required form-control " name="date_upload">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="">Upload File <span class="text-red">*</span></label>
              <div class="col-sm-9">
                <input type="file" id="file_po" style="margin: 5px 0px;" class="required form-control" name="file_po_upload">
                <span class="text-gray"><i>* Type File PDF,XLSX,DOCX,JPG (Max. 3 MB)</i></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="" style="padding-top: 5px;">PO File </label>
              <div class="col-sm-9" style="padding-top: 5px;">
                :
                <?php
                if ($data->upload_po != null) { ?>
                  <a href="<?= base_url('/assets/po/' . $data->upload_po) ?>" target=" _blank"><?= $data->upload_po ?></a>
                <?php } else {
                  echo "~";
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <button type="button" class="btn btn-md btn-primary pull-right" id="saveUpdloadPo"><i class="fa fa-save"></i> Save</button>
    </div>
</form>

<script type="text/javascript">
  jQuery(document).on('click', '#saveUpdloadPo', function() {
    var valid = getValidation();
    // alert(valid)
    if (valid) {
      // var formdata = $("#form-quotation").serialize();
      var formdata = new FormData($("#form-quotation")[0]);
      console.log(formdata);
      // exit();
      $.ajax({
        url: siteurl + active_controller + "saveUpdloadPo",
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
              open(siteurl + active_controller + 'qt_pro_deal', '_self');
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