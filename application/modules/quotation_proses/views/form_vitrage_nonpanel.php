<?php

// echo "<pre>";
// print_r($dataPanel);
// echo "</pre>";

?>

<div class="col-md-6" id="type_vitrage<?= $no ?>" data-type="nonpanel">
    <div class="form-group">
        <label class="col-sm-4" for="bukaan<?= $no ?>">Buka Arah <span class="text-red">*</span></label>
        <div class="col-md-8">
            <strong>
                <select class="form-control required select2" name="product_vitrage[<?= $no ?>][bukaan]" id="bukaan-vitrage<?= $no ?>">
                    <option value="" <?= $dataPanel->bukaan = '' ? 'selected' : '' ?>></option>
                    <option value="1" <?= $dataPanel->bukaan = '1' ? 'selected' : '' ?>>1</option>
                    <option value="2" <?= $dataPanel->bukaan = '2' ? 'selected' : '' ?>>2</option>
                </select>
                <label class="label label-danger bukaan-vitrage<?= $no ?> hideIt">Bukaan Arah Can't be empty!</label>
            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4" for="ovl_kiri-vitrage<?= $no ?>">Overlap Kiri <span class="text-red">*</span></label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <input type="number" min="0" class="form-control required ovl_kiri-vitrage" value="<?= $dataPanel->ovl_kiri != '' ? $dataPanel->ovl_kiri : '' ?>" data-id="<?= $no ?>" placeholder="0" name="product_vitrage[<?= $no ?>][ovl_kiri]" id="ovl_kiri-vitrage<?= $no ?>">
                    <div class="input-group-addon">cm</div>
                </div>
                <label class="label label-danger ovl_kiri-vitrage<?= $no ?> hideIt">Overlap Kiri Can't be empty!</label>

            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4" for="ovl_tengah<?= $no ?>">Overlap Tengah <span class="text-red">*</span></label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <input type="number" min="0" class="form-control required ovl_tengah-vitrage" value="<?= $dataPanel->ovl_tengah != '' ? $dataPanel->ovl_tengah : '' ?>" data-id="<?= $no ?>" placeholder="0" name="product_vitrage[<?= $no ?>][ovl_tengah]" id="ovl_tengah-vitrage<?= $no ?>">
                    <div class="input-group-addon">cm</div>
                </div>
                <label class="label label-danger ovl_tengah-vitrage<?= $no ?> hideIt">Overlap Tengah Can't be empty!</label>
            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4" for="jahit_h<?= $no ?>">Jahit Kanan-Kiri <span class="text-red">*</span></label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <input type="number" min="0" class="form-control required jahit_h-vitrage" value="<?= $dataPanel->jahit_h != '' ? $dataPanel->jahit_h : '' ?>" data-id="<?= $no ?>" placeholder="0" name="product_vitrage[<?= $no ?>][jahit_h]" id="jahit_h-vitrage<?= $no ?>">
                    <div class="input-group-addon">cm</div>
                </div>
                <label class="label label-danger jahit_h-vitrage<?= $no ?> hideIt">Jahit Kanan-Kiri Can't be empty!</label>
            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4" for="fullness<?= $no ?>">Fullness <span class="text-red">*</span></label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <input type="number" min="0" class="form-control required fullness-vitrage" value="<?= $dataPanel->fullness != '' ? $dataPanel->fullness : '' ?>" placeholder="0" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][fullness]" id="fullness-vitrage<?= $no ?>">
                    <div class="input-group-addon">%</div>
                </div>
                <label class="label label-danger fullness-vitrage<?= $no ?> hideIt">Fullness Can't be empty!</label>
            </strong>
        </div>
    </div>

    <!-- <div class="form-group">
		<label class="col-sm-4" for="qty_unit<?= $no ?>">Qty Unit <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" class="form-control required text-right qty_unit" data-id="<?= $no ?>" placeholder="0" min="0" name="product_vitrage[<?= $no ?>][qty_unit]" id="qty_unit<?= $no ?>">
					<span class="input-group-addon">Pcs</span>
				</div>
				<label class="label label-danger qty_unit<?= $no ?> hideIt">Qty Unit Can't be empty!</label>
			</strong>
		</div>
	</div> -->

    <div class="form-group">
        <label class="col-sm-4" for="t_kain<?= $no ?>">Total Kain </label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <input type="text" readonly class="form-control" value="<?= $dataPanel->t_kain != '' ? $dataPanel->t_kain : '' ?>" placeholder="0" name="product_vitrage[<?= $no ?>][t_kain]" id="t_kain-vitrage<?= $no ?>">
                    <span class="input-group-addon">m</span>
                </div>
                <label class="label label-danger t_kain-vitrage<?= $no ?> hideIt">Total Kain Can't be empty!</label>
            </strong>
        </div>
    </div>

</div>

<!-- ========================= -->

<div class="col-md-6">
    <div class="form-group">
        <label class="col-sm-4" for="disc_vitrage<?= $no ?>">Diskon Vitrage</label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <input type="number" class="form-control disc_vitrage" value="<?= $dataPanel->disc_persen ? $dataPanel->disc_persen : '' ?>" placeholder="0" min="0" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][disc_vitrage]" id="disc_vitrage<?= $no ?>">
                    <span class="input-group-addon">%</span>
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control text-right" value="<?= $dataPanel->disc_value ? number_format($dataPanel->disc_value) : '' ?>" readonly placeholder="0" min="0" name="product_vitrage[<?= $no ?>][t_disc_vitrage]" id="t_disc_vitrage<?= $no ?>">
                </div>
                <label class="label label-danger disc_vitrage<?= $no ?> hideIt">Diskon Fabric Can't be empty!</label>
                <!-- <input type="text" name="product_vitrage[<?= $no ?>][disc_fab_val]" data-id="<?= $no ?>" id="disc_fab_val<?= $no ?>"> -->
            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4" for="harga_aft_disc<?= $no ?>">Harga After Diskon </span></label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control text-right" value="<?= $dataPanel->harga_aft_disc ? number_format($dataPanel->harga_aft_disc) : '' ?>" readonly placeholder="0" min="0" name="product_vitrage[<?= $no ?>][harga_aft_disc]" id="harga_aft_disc-vitrage<?= $no ?>">

                </div>
                <label class="label label-danger harga_aft_disc-vitrage<?= $no ?> hideIt">Harga After Diskon Can't be empty!</label>
                <!-- <input type="text" name="product_curtain[<?= $no ?>][disc_fab_val]" data-id="<?= $no ?>" id="disc_fab_val<?= $no ?>"> -->
            </strong>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4" for="mainten<?= $no ?>">Maintenance <span class="text-red">*</span></label>
        <div class="col-md-3 col-sm-3">
            <strong>
                <label class="label label-danger mainten<?= $no ?> hideIt">Keterangan Can't be empty!</label>
            </strong>
        </div>
        <div class="col-md-7">
            <div class="input-group">
                <span class="input-group-addon">
                    <label style="padding-left:20px"><input type="radio" id="no_<?= $no ?>" data-id="<?= $no ?>" <?= $dataPanel->mainten == 'no' ? 'checked' : '' ?> class="pilihMainten-vitrage" name="product_vitrage[<?= $no ?>][mainten]" value="no"><span style="margin-left:5px">No</span></label>
                </span>
                <span class="input-group-addon">
                    <label style="margin-left:20px"><input type="radio" id="yes_<?= $no ?>" data-id="<?= $no ?>" <?= $dataPanel->mainten == 'yes' ? 'checked' : '' ?> class="pilihMainten-vitrage" disabled name="product_vitrage[<?= $no ?>][mainten]" value="yes"><span style="margin-left:5px">Yes</span></label>
                </span>
                <input type="number" readonly class="form-control disc_mnt text-right" placeholder="0" min="0" data-id="<?= $no ?>" value="<?= $dataPanel->disc_mnt_persen != '' ? $dataPanel->disc_mnt_persen : '' ?>" name="product_vitrage[<?= $no ?>][disc_mnt]" id="disc_mnt-vitrage<?= $no ?>">
                <span class="input-group-addon">%</span>
            </div>
            <input type="hidden" name="product_vitrage[<?= $no ?>][disc_mnt_val]" value="<?= $dataPanel->disc_mnt_val != '' ? $dataPanel->disc_mnt_val : '' ?>" data-id="<?= $no ?>" id="disc_mnt_val-vitrage<?= $no ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4" for="curtain_roll<?= $no ?>">Vitrage Roll <span class="text-red">*</span></label>
        <div class="col-md-8">
            <table width="100%" data-id="<?= $no ?>" id="dtBook-vitrage<?= $no ?>" class="dtBook table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Product</th>
                        <th>Book</th>
                        <th class="text-center">*</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dtBook = $this->db->get_where('qtt_booking_roll', ['id_quotation' => $dataPanel->id_quotation, 'section' => $no, 'panel' => 'no', 'item' => 'vitrage'])->result();

                    if ($dtBook) {
                        foreach ($dtBook as $bk => $Book) {
                            $this->db->select('a.*,c.name_product');
                            $this->db->from('qtt_booking_roll a');
                            $this->db->join('warehouse b', 'a.id_roll = b.id_roll');
                            $this->db->join('master_product_fabric c', 'b.id_product = c.id_product');
                            $this->db->where(['a.id_roll' => $Book->id_roll, 'id_quotation' => $Book->id_quotation, 'section' => $no, 'item' => 'vitrage', 'panel' => 'no']);
                            $dtRoll = $this->db->get()->result();
                            foreach ($dtRoll as $roll) {
                    ?>
                                <tr>
                                    <td>
                                        <?= $roll->id_roll ?>
                                        <input type="hidden" name="book_roll_vitrage[<?= $no ?>][<?= $bk ?>][id_product]" data-id="<?= $roll->id_roll ?>" value="<?= $roll->id_roll ?>">
                                        <input type="hidden" name="book_roll_vitrage[<?= $no ?>][<?= $bk ?>][panel]" data-id="<?= $roll->id_roll ?>" value="no">
                                    </td>
                                    <td><?= $roll->name_product ?></td>
                                    <td width="20%"><input type="text" value="<?= $roll->book_qty ?>" name="book_roll_vitrage[<?= $no ?>][<?= $bk ?>][book]" data-id="<?= $roll->id_roll ?>" class="form-control input-sm numberOnly text-right" placeholder="0"></td>
                                    <td><a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span></td>
                                </tr>
                    <?php
                            }
                        }
                    } ?>
                </tbody>
            </table>
            <strong>
                <button type="button" class="btn btn-sm btn-primary addData" data-type="bookRoll" data-product="vitrage" data-id="<?= $no ?>">Booking Roll</button>
                <!-- <input type="number" readonly class="form-control" placeholder="0" min="0" name="product_vitrage[<?= $no ?>][curtain_roll]" id="curtain_roll<?= $no ?>"> -->
                <!-- <label class="label label-danger curtain_roll<?= $no ?> hideIt">Curtain Up Panel Can't be empty!</label> -->
            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4" for="ComVitrage<?= $no ?>">External Commission</label>
        <div class="col-md-8">
            <!--<input type="text" class="form-control required" name="product_vitrage[<?= $no ?>][ex_comm]" id="ex_comm<?= $no ?>">
			<label class="label label-danger ex_comm<?= $no ?> hideIt">External Commission Can't be empty!</label>
		-->
            <table class="table-condensed table-striped table-bordered ComVitrage" id="ComVitrage<?= $no ?>" data-id="<?= $no ?>" width="100%">
                <thead>
                    <tr>
                        <th>PIC</th>
                        <th width="25%" class="text-center">%</th>
                        <th class="text-right">Value</th>
                        <th class="text-center">*</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dtComm = $this->db->get_where('qtt_ext_commission', ['id_quotation' => $dataPanel->id_quotation, 'item' => 'vitrage', 'panel' => 'no', 'section' => $no])->result();
                    if ($dtComm) {
                        foreach ($dtComm as $cm => $comm) {
                            $this->db->select('a.*,b.name_pic');
                            $this->db->from('qtt_ext_commission a');
                            $this->db->join('child_customer_pic b', 'a.id_pic = b.id_pic');
                            $this->db->where(['a.id_pic' => $comm->id_pic, 'id_quotation' => $comm->id_quotation, 'item' => 'vitrage', 'section' => $no, 'panel' => 'no']);
                            $Commissi = $this->db->get()->result();
                            foreach ($Commissi as $Commission) {
                    ?>
                                <tr>
                                    <td><?= $Commission->name_pic ?>
                                        <input type="hidden" value="<?= $Commission->id_pic ?>" name="ext_comm_vitrage[<?= $no ?>][<?= $cm ?>][id_pic]" data-id="<?= $Commission->id_pic ?>">
                                        <input type="hidden" value="no" name="ext_comm_vitrage[<?= $no ?>][<?= $cm ?>][panel]" data-id="<?= $Commission->id_pic ?>">
                                    </td>
                                    <td><input type="number" style="width:100%" value="<?= $Commission->persen_fee ?>" name="ext_comm_vitrage[<?= $no ?>][<?= $cm ?>][persen]" data-id="<?= $Commission->id_pic ?>" id="persen_<?= $Commission->id_pic ?>" class="form-control input-sm numberOnly persen text-right" placeholder="0" maxLength="3" min="0" max="100">
                                    </td>
                                    <td><input type="text" style="width:100%" value="<?= $Commission->value_fee ?>" name="ext_comm_vitrage[<?= $no ?>][<?= $cm ?>][value]" data-id="<?= $Commission->id_pic ?>" id="value_<?= $Commission->id_pic ?>" class="form-control input-sm numberOnly nominal value text-right" placeholder="0"></td>
                                    <td><a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span></td>
                                </tr>
                    <?php
                            }
                        }
                    } ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-sm btn-primary addData" data-type="extCommission" data-product="vitrage" data-id="<?= $no ?>">Add PIC</button>
            <input type="hidden" data-id="<?= $no ?>" id="fee_pic-vitrage<?= $no ?>">
            <input type="hidden" data-id="<?= $no ?>" id="vitrage_disk<?= $no ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4" for="ket<?= $no ?>">Keterangan</label>
        <div class="col-md-8">
            <strong>
                <textarea type="text" class="form-control" placeholder="Keterangan" name="product_vitrage[<?= $no ?>][ket]" id="ket-vitrage<?= $no ?>"><?= $dataPanel->keterangan ?></textarea>
                <label class="label label-danger ket-vitrage<?= $no ?> hideIt">Keterangan Can't be empty!</label>
            </strong>
        </div>
    </div>
</div>

<script>
    // let disc_cat = $('#disc_cat').val();
    if ($('#disc_cat').val() != '') {
        $('.pilihMainten-vitrage').prop('disabled', false);
    }
</script>