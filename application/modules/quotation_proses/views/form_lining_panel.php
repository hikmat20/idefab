<div class="col-md-6" data-type="panel" id="type_lining<?= $no ?>">
	<div class="form-group">
		<label class="col-sm-4" for="bukaan<?= $no ?>">Buka Arah <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<select class="form-control required select2" name="product_lining[<?= $no ?>][bukaan]" id="bukaan-lining<?= $no ?>">
					<option value="" <?= $dataPanel->bukaan = '' ? 'selected' : '' ?>></option>
					<option value="1" <?= $dataPanel->bukaan = '1' ? 'selected' : '' ?>>1</option>
					<option value="2" <?= $dataPanel->bukaan = '2' ? 'selected' : '' ?>>2</option>
				</select>
				<label class="label label-danger bukaan-lining<?= $no ?> hideIt">Bukaan Arah Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ovl_kiri-lining<?= $no ?>">Overlap Kiri <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" class="form-control required ovl_kiri-lining" value="<?= $dataPanel->ovl_kiri != '' ? $dataPanel->ovl_kiri : '' ?>" data-id="<?= $no ?>" placeholder="0" name="product_lining[<?= $no ?>][ovl_kiri]" id="ovl_kiri-lining<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
				<label class="label label-danger ovl_kiri-lining<?= $no ?> hideIt">Overlap Kiri Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ovl_tengah-lining<?= $no ?>">Overlap Tengah <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" class="form-control required ovl_tengah-lining" value="<?= $dataPanel->ovl_tengah != '' ? $dataPanel->ovl_tengah : '' ?>" data-id="<?= $no ?>" placeholder="0" name="product_lining[<?= $no ?>][ovl_tengah]" id="ovl_tengah-lining<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
				<label class="label label-danger ovl_tengah-lining<?= $no ?> hideIt">Overlap Tengah Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="jahit_h-lining<?= $no ?>">Jahit Kanan-Kiri <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" class="form-control required jahit_h-lining" value="<?= $dataPanel->jahit_h != '' ? $dataPanel->jahit_h : '' ?>" data-id="<?= $no ?>" placeholder="0" name="product_lining[<?= $no ?>][jahit_h]" id="jahit_h-lining<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
				<label class="label label-danger jahit_h-lining<?= $no ?> hideIt">Jahit Kanan-Kiri Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="jahit_v-lining<?= $no ?>">Jahit Atas-Bawah <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" class="form-control required jahit_v-lining" value="<?= $dataPanel->jahit_v != '' ? $dataPanel->jahit_v : '' ?>" placeholder="0" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][jahit_v]" id="jahit_v-lining<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
				<label class="label label-danger jahit_v-lining<?= $no ?> hideIt">Jahit Atas-Bawah Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="vertikal_repeat-lining<?= $no ?>">Vertikal Repeat <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" class="form-control required vertikal_repeat-lining" value="<?= $dataPanel->vertikal_repeat != '' ? $dataPanel->vertikal_repeat : '' ?>" placeholder="0" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][vertikal_repeat]" id="vertikal_repeat-lining<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
				<label class="label label-danger vertikal_repeat-lining<?= $no ?> hideIt">Vertikal Repeat Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="fullness-lining<?= $no ?>">Fullness <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" class="form-control required fullness-lining" value="<?= $dataPanel->fullness != '' ? $dataPanel->fullness : '' ?>" placeholder="0" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][fullness]" id="fullness-lining<?= $no ?>">
					<div class="input-group-addon">%</div>
				</div>
				<label class="label label-danger fullness-lining<?= $no ?> hideIt">Fullness Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="rumus_panel-lining<?= $no ?>">Rumus Panel</label>
		<div class="col-md-8">
			<strong>
				<input type="text" readonly class="form-control rumus_panel-lining" value="<?= $dataPanel->rumus_panel != '' ? $dataPanel->rumus_panel : '' ?>" placeholder="0" name="product_lining[<?= $no ?>][rumus_panel]" id="rumus_panel-lining<?= $no ?>">
				<label class="label label-danger rumus_panel-lining<?= $no ?> hideIt">Rumus Panel Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="r_up_panel-lining<?= $no ?>">Round Up Panel <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<input type="number" class="form-control required r_up_panel-lining" value="<?= $dataPanel->round_up != '' ? $dataPanel->round_up : '' ?>" placeholder="0" min="0" name="product_lining[<?= $no ?>][r_up_panel]" id="r_up_panel-lining<?= $no ?>" data-id="<?= $no ?>">
				<label class="label label-danger r_up_panel-lining<?= $no ?> hideIt">Round Up Panel Can't be empty!</label>
			</strong>
		</div>
	</div>

</div>

<!-- ========================= -->

<div class="col-md-6">
	<!-- <div class="form-group">
		<label class="col-sm-4" for="qty_unit<?= $no ?>">Qty Unit <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" class="form-control required text-right qty_unit" data-id="<?= $no ?>" placeholder="0" min="0" name="product_lining[<?= $no ?>][qty_unit]" id="qty_unit<?= $no ?>">
					<span class="input-group-addon">Pcs</span>
				</div>
				<label class="label label-danger qty_unit<?= $no ?> hideIt">Qty Unit Can't be empty!</label>
			</strong>
		</div>
	</div> -->

	<div class="form-group">
		<label class="col-sm-4" for="t_kain-lining<?= $no ?>">Total Kain <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="text" readonly class="form-control" value="<?= $dataPanel->t_kain != '' ? $dataPanel->t_kain : '' ?>" placeholder="0" name="product_lining[<?= $no ?>][t_kain]" id="t_kain-lining<?= $no ?>">
					<span class="input-group-addon">m</span>
				</div>
				<label class="label label-danger t_kain-lining<?= $no ?> hideIt">Total Kain Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="disc_lining<?= $no ?>">Diskon Fabric </span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" class="form-control disc_lining" value="<?= $dataPanel->disc_persen != '' ? $dataPanel->disc_persen : '' ?>" placeholder="0" min="0" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][disc_lining]" id="disc_lining<?= $no ?>">
					<span class="input-group-addon">%</span>
					<span class="input-group-addon">Rp.</span>
					<input type="text" class="form-control text-right" value="<?= $dataPanel->disc_value != '' ? number_format($dataPanel->disc_value) : '' ?>" readonly placeholder="0" min="0" name="product_lining[<?= $no ?>][t_disc_lining]" id="t_disc_lining<?= $no ?>">
				</div>
				<label class="label label-danger disc_lining<?= $no ?> hideIt">Diskon Fabric Can't be empty!</label>
				<!-- <input type="text" name="product_lining[<?= $no ?>][disc_fab_val]" data-id="<?= $no ?>" id="disc_fab_val<?= $no ?>"> -->
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="harga_aft_disc<?= $no ?>">Harga After Diskon </span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<span class="input-group-addon">Rp.</span>
					<input type="text" class="form-control text-right" value="<?= $dataPanel->harga_aft_disc ? number_format($dataPanel->harga_aft_disc) : '' ?>" readonly placeholder="0" min="0" name="product_lining[<?= $no ?>][harga_aft_disc]" id="harga_aft_disc-lining<?= $no ?>">
				</div>
				<label class="label label-danger harga_aft_disc-lining<?= $no ?> hideIt">Harga After Diskon Can't be empty!</label>
				<!-- <input type="text" name="product_curtain[<?= $no ?>][disc_fab_val]" data-id="<?= $no ?>" id="disc_fab_val<?= $no ?>"> -->
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="mainten-lining<?= $no ?>">Maintenance <span class="text-red">*</span></label>
		<div class="col-md-8 col-sm-3">
			<strong>
				<label class="label label-danger mainten-lining<?= $no ?> hideIt">Keterangan Can't be empty!</label>
			</strong>
		</div>
		<div class="col-md-7">
			<div class="input-group">
				<span class="input-group-addon">
					<label style="padding-left:20px"><input type="radio" id="no_<?= $no ?>" data-id="<?= $no ?>" <?= $dataPanel->mainten == 'no' ? 'checked' : '' ?> class="pilihMainten-lining" name="product_lining[<?= $no ?>][mainten]" value="no"><span style="margin-left:5px">No</span></label>
				</span>
				<span class="input-group-addon">
					<label style="margin-left:20px"><input type="radio" id="yes_<?= $no ?>" data-id="<?= $no ?>" <?= $dataPanel->mainten == 'yes' ? 'checked' : '' ?> class="pilihMainten-lining" disabled name="product_lining[<?= $no ?>][mainten]" value="yes"><span style="margin-left:5px">Yes</span></label>
				</span>
				<input type="number" readonly class="form-control disc_mnt text-right" value="<?= $dataPanel->disc_mnt_persen != '' ? $dataPanel->disc_mnt_persen : '' ?>" placeholder="0" min="0" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][disc_mnt]" id="disc_mnt-lining<?= $no ?>">
				<span class="input-group-addon">%</span>
			</div>
			<input type="hidden" name="product_lining[<?= $no ?>][disc_mnt_val]" data-id="<?= $no ?>" value="<?= $dataPanel->disc_mnt_value != '' ? $dataPanel->disc_mnt_value : '' ?>" id="disc_mnt_val-lining<?= $no ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="curtain-lining<?= $no ?>">Lining Roll</label>
		<div class="col-md-8">
			<table width="100%" data-id="<?= $no ?>" id="dtBook-lining<?= $no ?>" class="dtBook-lining table-bordered table-condensed table-striped">
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
					$dtBook = $this->db->get_where('qtt_booking_roll', ['id_quotation' => $dataPanel->id_quotation, 'section' => $no, 'panel' => 'yes', 'item' => 'lining'])->result();
					if ($dtBook) {
						foreach ($dtBook as $bk => $Book) {
							$this->db->select('a.*,c.name_product');
							$this->db->from('qtt_booking_roll a');
							$this->db->join('warehouse b', 'a.id_roll = b.id_roll');
							$this->db->join('master_product_fabric c', 'b.id_product = c.id_product');
							$this->db->where(['a.id_roll' => $Book->id_roll, 'id_quotation' => $Book->id_quotation, 'item' => 'lining', 'section' => $no, 'panel' => 'yes',]);
							$dtRoll = $this->db->get()->result();
							foreach ($dtRoll as $roll) {
					?>
								<tr>
									<td>
										<?= $roll->id_roll ?>
										<input type="hidden" value="<?= $roll->id_roll ?>" name="book_roll_lining[<?= $no ?>][<?= $bk ?>][book]" data-id="<?= $roll->id_roll ?>">
										<input type="hidden" value="yes" name="book_roll_lining[<?= $no ?>][<?= $bk ?>][panel]" data-id="<?= $roll->id_roll ?>">
									</td>
									<td><?= $roll->name_product ?></td>
									<td width="20%"><input type="text" value="<?= $roll->book_qty ?>" name="book_roll_lining[<?= $no ?>][<?= $bk ?>][book]" data-id="<?= $roll->id_roll ?>" class="form-control input-sm numberOnly text-right" placeholder="0"></td>
									<td><a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span></td>
								</tr>
					<?php
							}
						}
					} ?>
				</tbody>
			</table>
			<strong>
				<button type="button" class="btn btn-sm btn-primary addData" data-type="bookRoll" data-product="lining" data-id="<?= $no ?>">Booking Roll</button>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ex_comm-lining<?= $no ?>">External Commission</label>
		<div class="col-md-8">
			<!--<input type="text" class="form-control required" name="product_lining[<?= $no ?>][ex_comm]" id="ex_comm<?= $no ?>">
			<label class="label label-danger ex_comm<?= $no ?> hideIt">External Commission Can't be empty!</label>
		-->
			<table class="table-condensed table-striped table-bordered ComLining" id="ComLining<?= $no ?>" data-id="<?= $no ?>" width="100%">
				<thead>
					<tr>
						<td>PIC</td>
						<td width="25%" class="text-center">%</td>
						<td class="text-right">Value</td>
						<td class="text-right"></td>
					</tr>
				</thead>
				<tbody>
					<?php
					$dtComm = $this->db->get_where('qtt_ext_commission', ['id_quotation' => $dataPanel->id_quotation, 'item' => 'lining', 'panel' => 'yes', 'section' => $no])->result();
					if ($dtComm) {
						foreach ($dtComm as $cm => $comm) {
							$this->db->select('a.*,b.name_pic');
							$this->db->from('qtt_ext_commission a');
							$this->db->join('child_customer_pic b', 'a.id_pic = b.id_pic');
							$this->db->where(['a.id_pic' => $comm->id_pic, 'a.id_quotation' => $comm->id_quotation, 'a.item' => 'lining', 'a.section' => $no, 'a.panel' => 'yes']);
							$Commissi = $this->db->get()->result();
							foreach ($Commissi as $Commission) {
					?>
								<tr>
									<td><?= $Commission->name_pic ?>
										<input type="hidden" value="<?= $Commission->id_pic ?>" name="ext_comm_lining[<?= $no ?>][<?= $cm ?>][id_pic]" data-id="<?= $Commission->id_pic ?>">
										<input type="hidden" value="yes" name="ext_comm_lining[<?= $no ?>][<?= $cm ?>][id_pic]" data-id="<?= $Commission->id_pic ?>">
									</td>
									<td><input type="number" style="width:100%" value="<?= $Commission->persen_fee ?>" name="ext_comm_lining[<?= $no ?>][<?= $cm ?>][persen]" data-id="<?= $Commission->id_pic ?>" id="persen_<?= $Commission->id_pic ?>" class="form-control input-sm numberOnly persen text-right" placeholder="0" maxLength="3" min="0" max="100">
									</td>
									<td><input type="text" style="width:100%" value="<?= $Commission->value_fee ?>" name="ext_comm_lining[<?= $no ?>][<?= $cm ?>][value]" data-id="<?= $Commission->id_pic ?>" id="value_<?= $Commission->id_pic ?>" class="form-control input-sm numberOnly nominal value text-right" placeholder="0"></td>
									<td><a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span></td>
								</tr>
					<?php
							}
						}
					} ?>

				</tbody>
			</table>
			<button type="button" class="btn btn-sm btn-primary addData" data-type="extCommission" data-product="lining" data-id="<?= $no ?>">Add PIC</button>
			<input type="hidden" data-id="<?= $no ?>" id="fee_pic-lining<?= $no ?>">
			<input type="hidden" data-id="<?= $no ?>" id="lining_disk<?= $no ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ket-lining<?= $no ?>">Keterangan</label>
		<div class="col-md-8">
			<strong>
				<textarea type="text" class="form-control" placeholder="Keterangan" name="product_lining[<?= $no ?>][ket]" id="ket-lining<?= $no ?>"><?= $dataPanel->keterangan != '' ? $dataPanel->keterangan : '' ?></textarea>
				<label class="label label-danger ket-lining<?= $no ?> hideIt">Keterangan Can't be empty!</label>
			</strong>
		</div>
	</div>
</div>

<script>
	if ($('#disc_cat').val() != '') {
		$('.pilihMainten-lining').prop('disabled', false);
	}
</script>