<form class="" id="form-quotation" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="type" class="form-control" value="<?= $type ?>">

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
                    <table width="100%" class="table-striped">
                        <tbody>
                            <tr>
                                <td width="30%">
                                    <label>Quotation Number</label>
                                </td>
                                <td>: <?= $data->id_quotation ?></td>
                                <input type="hidden" name="id_quotation" value="<?= $data->id_quotation ?>">
                            </tr>
                            <tr>
                                <td width="30%">
                                    <label>PO Number</label>
                                </td>
                                <td>: <?= $data->no_po ?></td>
                                <input type="hidden" name="po_number" value="<?= $data->no_po ?>">
                            </tr>
                            <tr>
                                <td>
                                    <label>Customer</label>
                                </td>
                                <td>: <?= $customer->name_customer ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category Customer</label>
                                </td>
                                <td>: <?= $cat_cust->name_category_customer ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>PIC</label>
                                </td>
                                <td>: <?= $pic_cust->name_pic ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Telephone</label>
                                </td>
                                <td>: <?= $pic_cust->telephone ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Address</label>
                                </td>
                                <td>: <?= $customer->address_office ?></td>
                            </tr>
                            <!-- <tr>
                                <td>
                                    <label>Discount Category</label>
                                </td>
                                <td>: <?= $disc_cat->name_cat ?> (<?= $data->val_disc_cat != '' ? $data->val_disc_cat . '%' : '' ?>)</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <table width="100%" class="table-striped">
                        <tbody>
                            <tr>
                                <td width="30%">
                                    <label>Date Quotation</label>
                                </td>
                                <td>: <?= $data->date ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Type Project</label>
                                </td>
                                <td>: <?= $type_pro->nm_type_project ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Project Name</label>
                                </td>
                                <td>: <?= $data->project_name ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category Sales</label>
                                </td>
                                <td>: <?= $data->sales_category ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Marketing</label>
                                </td>
                                <td>: <?= $karyawan->nama_karyawan ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <table class="table-condensed" width="100%">
                        <tr>
                            <td width="30%">
                                <label>MSO Number</label>
                            </td>
                            <td>
                                <input type="text" readonly class="form-control" name="id_mso" value="<?= $id_mso == '' ? $dataMso->id_mso : $id_mso ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <label>Date MSO</label>
                            </td>
                            <td><input type="date" name="date_mso" id="date_mso" value="<?= $dataMso->date ? $dataMso->date : date('Y-m-d') ?>" class="bg-gray form-control date"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <table class="table-condensed" width="100%">
                        <tr>
                            <td width="30%">
                                <label for="">PIC Delivery <span class="text-red"> *</span></label>
                            </td>
                            <td>
                                <input type="text" name="pic_delivery" id="pic_delivery" value="<?= $dataMso->pic_delivery ?>" class="required form-control" placeholder="PIC Delivery">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Delivery Phone <span class="text-red"> *</span></label>
                            </td>
                            <td>
                                <input type="text" name="delivery_phone" id="delivery_phone" value="<?= $dataMso->delivery_phone ?>" class="required form-control" placeholder="Delivery Phone">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Delivery Address <span class="text-red"> *</span></label>
                            </td>
                            <td>
                                <input type="text" name="delivery_addr" id="delivery_addr" value="<?= $dataMso->delivery_addr ?>" class="required form-control" placeholder="Delivery Address">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">PIC Installation <span class="text-red"> *</span></label>
                            </td>
                            <td>
                                <input type="text" name="pic_installation" id="pic_installation" value="<?= $dataMso->pic_installation ?>" class="required form-control" placeholder="PIC Installation">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Installation Adress <span class="text-red"> *</span></label>
                            </td>
                            <td>
                                <input type="text" name="installation_addr" id="installation_addr" value="<?= $dataMso->installation_addr ?>" class="required form-control" placeholder="Installation Adress">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Status <span class="text-red"> *</span></label>
                            </td>
                            <td>

                                <select name="status" id="status" class="form-control required select2">
                                    <option value=""></option>
                                    <option value="PROSES" <?= $dataMso->status == 'PROSES' ? 'selected' : '' ?>>PROSES</option>
                                    <option value="HOLD" <?= $dataMso->status == 'HOLD' ? 'selected' : '' ?>>HOLD</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table-condensed" width="100%">
                        <tr>
                            <td width="30%">
                                <label for="">PIC Invoice <span class="text-red"> *</span></label>
                            </td>
                            <td>
                                <input type="text" name="pic_invoice" id="pic_invoice" value="<?= $dataMso->pic_invoice ?>" class="required form-control" placeholder="PIC Invoice">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Address Invoice <span class="text-red"> *</span></label>
                            </td>
                            <td>
                                <input type="text" name="address_inv" id="address_inv" value="<?= $dataMso->address_inv ?>" class="required form-control" placeholder="Address Invoice">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Phone PIC invoice <span class="text-red"> *</span></label>
                            </td>
                            <td>
                                <input type="text" name="phone_pic_inv" id="phone_pic_inv" value="<?= $dataMso->phone_pic_inv ?>" class="required form-control" placeholder="Phone PIC invoice">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for=""> Jenis Penagihan</label>
                            </td>
                            <td>
                                <div class="radio">
                                    <label style="margin-right:10px">
                                        <input type="radio" name="tagihan" value="tagihan_aktual" <?= $dataMso->jenis_tagihan == 'tagihan_aktual' ? 'checked' : '' ?>>
                                        Tagihan Aktual
                                    </label>
                                    <label>
                                        <input type="radio" name="tagihan" value="tagihan_po" <?= $dataMso->jenis_tagihan != 'tagihan_po' ? '' : 'checked' ?>>
                                        Tagihan Sesuai PO
                                    </label>

                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <table class="table-stiped table-condensed" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ruangan</th>
                            <th>Lantai</th>
                            <th>Jendela</th>
                            <th>Target Pemasangan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($rooms as $rm => $room) {
                            $no++ ?>
                            <tr>
                                <td>
                                    <?= $no ?>
                                    <input type="hidden" name="pemasangan[$rm][id_ruangan]" class="bg-gray form-control" value="<?= $room->id_ruangan ?>">
                                </td>
                                <td>
                                    <?= $room->name_room ?>
                                    <input type="hidden" name="pemasangan[$rm][nama_ruangan]" class="bg-gray form-control" value="<?= $room->name_room ?>">
                                </td>
                                <td>
                                    <?= $room->floor ?>
                                    <input type="hidden" name="pemasangan[$rm][lantai]" class="bg-gray form-control" value="<?= $room->floor ?>">
                                </td>
                                <td>
                                    <?= $room->window ?>
                                    <input type="hidden" name="pemasangan[$rm][jendela]" class="bg-gray form-control" value="<?= $room->window ?>">
                                </td>
                                <td>
                                    <input type="date" name="pemasangan[$rm][tgl_pasang]" class="bg-gray form-control required" value="<?= $room->installation_date ?>">
                                </td>
                                <td>
                                    <input type="text" name="pemasangan[$rm][keterangan]" id="keterangan" class="form-control" value="<?= $room->notes ?>">
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-md btn-primary pull-right" id="saveMso"><i class="fa fa-save"></i> Save</button>
        </div>
</form>

<script type="text/javascript">
    $(".select2").select2({
        placeholder: "Choose An Option",
        allowClear: true,
        width: '100%'
    });
    jQuery(document).on('click', '#saveMso', function() {
        var valid = getValidation();
        // alert(valid)
        if (valid) {
            // var formdata = $("#form-quotation").serialize();
            var formdata = new FormData($("#form-quotation")[0]);
            // console.log(formdata);
            // exit();
            $.ajax({
                url: siteurl + active_controller + "saveDataMso",
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
                            open(siteurl + active_controller, '_self');
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