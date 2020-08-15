<?php

$dataPanel = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'item' => 'curtain', 'panel' => 'no'])->row();

// echo "<pre>";
// print_r($id_ruangan);
// echo "</pre>";


?>


<div class="col-md-6" id="type<?= $no ?>" data-type="nonpanel">
	<div class="form-group">
		<label class="col-sm-4" for="bukaan<?= $no ?>">Buka Arah <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<select class="form-control required select2" name="product_curtain[<?= $no ?>][bukaan]" id="bukaan<?= $no ?>">
					<option value="" <?= $dataPanel->bukaan = '' ? 'selected' : '' ?>></option>
					<option value="1" <?= $dataPanel->bukaan = '1' ? 'selected' : '' ?>>1</option>
					<option value="2" <?= $dataPanel->bukaan = '2' ? 'selected' : '' ?>>2</option>
				</select>
				<label class="label label-danger bukaan<?= $no ?> hideIt">Bukaan Arah Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ovl_kiri<?= $no ?>">Overlap Kiri <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" value="<?= $dataPanel->ovl_kiri != '' ? $dataPanel->ovl_kiri : '' ?>" class="form-control required ovl_kiri" data-id="<?= $no ?>" placeholder="0" name="product_curtain[<?= $no ?>][ovl_kiri]" id="ovl_kiri<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
				<label class="label label-danger ovl_kiri<?= $no ?> hideIt">Overlap Kiri Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ovl_tengah<?= $no ?>">Overlap Tengah <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" value="<?= $dataPanel->ovl_tengah != '' ? $dataPanel->ovl_tengah : '' ?>" class="form-control required ovl_tengah" data-id="<?= $no ?>" placeholder="0" name="product_curtain[<?= $no ?>][ovl_tengah]" id="ovl_tengah<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
				<label class="label label-danger ovl_tengah<?= $no ?> hideIt">Overlap Tengah Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="jahit_h<?= $no ?>">Jahit Kanan-Kiri <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" value="<?= $dataPanel->jahit_h != '' ? $dataPanel->jahit_h : '' ?>" class="form-control required jahit_h" data-id="<?= $no ?>" placeholder="0" name="product_curtain[<?= $no ?>][jahit_h]" id="jahit_h<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
				<label class="label label-danger jahit_h<?= $no ?> hideIt">Jahit Kanan-Kiri Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="fullness<?= $no ?>">Fullness <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" min="0" value="<?= $dataPanel->fullness != '' ? $dataPanel->fullness : '' ?>" class="form-control required fullness" placeholder="0" data-id="<?= $no ?>" name="product_curtain[<?= $no ?>][fullness]" id="fullness<?= $no ?>">
					<div class="input-group-addon">%</div>
				</div>
				<label class="label label-danger fullness<?= $no ?> hideIt">Fullness Can't be empty!</label>
			</strong>
		</div>
	</div>

	<!-- <div class="form-group">
		<label class="col-sm-4" for="qty_unit<?= $no ?>">Qty Unit <span class="text-red">*</span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" class="form-control required text-right qty_unit" data-id="<?= $no ?>" placeholder="0" min="0" name="product_curtain[<?= $no ?>][qty_unit]" id="qty_unit<?= $no ?>">
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
					<input type="text" value="<?= $dataPanel->t_kain != '' ? $dataPanel->t_kain : '' ?>" readonly class="form-control" placeholder="0" name="product_curtain[<?= $no ?>][t_kain]" id="t_kain<?= $no ?>">
					<span class="input-group-addon">m</span>
				</div>
				<label class="label label-danger t_kain<?= $no ?> hideIt">Total Kain Can't be empty!</label>
			</strong>
		</div>
	</div>
</div>

<!-- ========================= -->

<div class="col-md-6">

	<div class="form-group">
		<label class="col-sm-4" for="disc_fab<?= $no ?>">Diskon Fabric</label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<input type="number" class="form-control disc_fab" value="<?= $dataPanel->disc_persen ? $dataPanel->disc_persen : '' ?>" placeholder="0" min="0" data-id="<?= $no ?>" name="product_curtain[<?= $no ?>][disc_fab]" id="disc_fab<?= $no ?>">
					<span class="input-group-addon">%</span>
					<span class="input-group-addon">Rp.</span>
					<input type="text" class="form-control text-right" value="<?= $dataPanel->disc_value ? number_format($dataPanel->disc_value) : '' ?>" readonly placeholder="0" min="0" name="product_curtain[<?= $no ?>][t_disc_fab]" id="t_disc_fab<?= $no ?>">
				</div>
				<label class="label label-danger disc_fab<?= $no ?> hideIt">Diskon Fabric Can't be empty!</label>
				<!-- <input type="text" name="product_curtain[<?= $no ?>][disc_fab_val]" data-id="<?= $no ?>" id="disc_fab_val<?= $no ?>"> -->
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="harga_aft_disc<?= $no ?>">Harga After Diskon </span></label>
		<div class="col-md-8">
			<strong>
				<div class="input-group">
					<span class="input-group-addon">Rp.</span>
					<input type="text" class="form-control text-right" value="<?= $dataPanel->harga_aft_disc ? number_format($dataPanel->harga_aft_disc) : '' ?>" readonly placeholder="0" min="0" name="product_curtain[<?= $no ?>][harga_aft_disc]" id="harga_aft_disc<?= $no ?>">

				</div>
				<label class="label label-danger harga_aft_disc<?= $no ?> hideIt">Harga After Diskon Can't be empty!</label>
				<!-- <input type="text" name="product_curtain[<?= $no ?>][disc_fab_val]" data-id="<?= $no ?>" id="disc_fab_val<?= $no ?>"> -->
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="mainten<?= $no ?>">Maintenance <span class="text-red">*</span></label>
		<div class="col-md-8 col-sm-3">
			<strong>
				<label class="label label-danger mainten<?= $no ?> hideIt">Keterangan Can't be empty!</label>
			</strong>
		</div>
		<div class="col-md-7">
			<div class="input-group">
				<span class="input-group-addon">
					<label style="padding-left:20px"><input type="radio" id="no_<?= $no ?>" data-id="<?= $no ?>" <?= $dataPanel->mainten == 'no' ? 'checked' : '' ?> class="pilihMainten" name="product_curtain[<?= $no ?>][mainten]" value="no"><span style="margin-left:5px">No</span></label>
				</span>
				<span class="input-group-addon">
					<label style="margin-left:20px"><input type="radio" id="yes_<?= $no ?>" data-id="<?= $no ?>" <?= $dataPanel->mainten == 'yes' ? 'checked' : '' ?> class="pilihMainten" disabled name="product_curtain[<?= $no ?>][mainten]" value="yes"><span style="margin-left:5px">Yes</span></label>
				</span>
				<input type="number" readonly class="form-control disc_mnt text-right" value="<?= $dataPanel->disc_mnt_persen ? $dataPanel->disc_mnt_persen : '' ?>" placeholder="0" min="0" data-id="<?= $no ?>" name="product_curtain[<?= $no ?>][disc_mnt]" id="disc_mnt<?= $no ?>">
				<span class="input-group-addon">%</span>
			</div>
			<input type="hidden" name="product_curtain[<?= $no ?>][disc_mnt_val]" value="<?= $dataPanel->disc_mnt_value ? $dataPanel->disc_mnt_value : '' ?>" data-id="<?= $no ?>" id="disc_mnt_val<?= $no ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="curtain_roll<?= $no ?>">Curtain Roll <span class="text-red">*</span></label>
		<div class="col-md-8">
			<table width="100%" data-id="<?= $no ?>" id="dtBook<?= $no ?>" class="dtBook table-bordered table-condensed table-striped">
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
					$dtBook = $this->db->get_where('qtt_booking_roll', ['id_quotation' => $dataPanel->id_quotation, 'section' => $no, 'panel' => 'no'])->result();


					if ($dtBook) {
						foreach ($dtBook as $bk => $Book) {
							$this->db->select('a.*,c.name_product');
							$this->db->from('qtt_booking_roll a');
							$this->db->join('warehouse b', 'a.id_roll = b.id_roll');
							$this->db->join('master_product_fabric c', 'b.id_product = c.id_product');
							$this->db->where(['a.id_roll' => $Book->id_roll, 'id_quotation' => $Book->id_quotation, 'section' => $no, 'item' => 'curtain', 'panel' => 'no']);
							$dtRoll = $this->db->get()->result();
							foreach ($dtRoll as $roll) {
					?>
								<tr>
									<td>
										<?= $roll->id_roll ?>
										<input type="hidden" name="book_roll[<?= $no ?>][<?= $bk ?>][id_product]" data-id="<?= $roll->id_roll ?>" value="<?= $roll->id_roll ?>">
										<input type="hidden" name="book_roll[<?= $no ?>][<?= $bk ?>][panel]" data-id="<?= $roll->id_roll ?>" value="no">
									</td>
									<td><?= $roll->name_product ?></td>
									<td width="20%"><input type="text" value="<?= $roll->book_qty ?>" name="book_roll[<?= $no ?>][<?= $bk ?>][book]" data-id="<?= $roll->id_roll ?>" class="form-control input-sm numberOnly text-right" placeholder="0"></td>
									<td><a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span></td>
								</tr>
					<?php
							}
						}
					} ?>
				</tbody>
			</table>
			<strong>
				<button type="button" class="btn btn-sm btn-primary addData" data-type="bookRoll" data-product="curtain" data-id="<?= $no ?>">Booking Roll</button>
				<!-- <input type="number" readonly class="form-control" placeholder="0" min="0" name="product_curtain[<?= $no ?>][curtain_roll]" id="curtain_roll<?= $no ?>"> -->
				<!-- <label class="label label-danger curtain_roll<?= $no ?> hideIt">Curtain Up Panel Can't be empty!</label> -->
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ComCurtain<?= $no ?>">External Commission</label>
		<div class="col-md-8">
			<!--<input type="text" class="form-control required" name="product_curtain[<?= $no ?>][ex_comm]" id="ex_comm<?= $no ?>">
			<label class="label label-danger ex_comm<?= $no ?> hideIt">External Commission Can't be empty!</label>
		-->
			<table class="table-condensed table-striped table-bordered ComCurtain" id="ComCurtain<?= $no ?>" data-id="<?= $no ?>" width="100%">
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
					$dtComm = $this->db->get_where('qtt_ext_commission', ['id_quotation' => $dataPanel->id_quotation, 'item' => 'curtain', 'panel' => 'no', 'section' => $no])->result();
					if ($dtComm) {
						foreach ($dtComm as $cm => $comm) {
							$this->db->select('a.*,b.name_pic');
							$this->db->from('qtt_ext_commission a');
							$this->db->join('child_customer_pic b', 'a.id_pic = b.id_pic');
							$this->db->where(['a.id_pic' => $comm->id_pic, 'id_quotation' => $comm->id_quotation, 'item' => 'curtain', 'section' => $no]);
							$Commissi = $this->db->get()->result();
							foreach ($Commissi as $Commission) {
					?>
								<tr>
									<td><?= $Commission->name_pic ?>
										<input type="hidden" value="<?= $Commission->id_pic ?>" name="ext_comm[<?= $no ?>][<?= $cm ?>][id_pic]" data-id="<?= $Commission->id_pic ?>">
										<input type="hidden" value="no" name="ext_comm[<?= $no ?>][<?= $cm ?>][panel]" data-id="<?= $Commission->id_pic ?>">
									</td>
									<td><input type="number" style="width:100%" value="<?= $Commission->persen_fee ?>" name="ext_comm[<?= $no ?>][<?= $cm ?>][persen]" data-id="<?= $Commission->id_pic ?>" id="persen_<?= $Commission->id_pic ?>" class="form-control input-sm numberOnly persen text-right" placeholder="0" maxLength="3" min="0" max="100">
									</td>
									<td><input type="text" style="width:100%" value="<?= $Commission->value_fee ?>" name="ext_comm[<?= $no ?>][<?= $cm ?>][value]" data-id="<?= $Commission->id_pic ?>" id="value_<?= $Commission->id_pic ?>" class="form-control input-sm numberOnly nominal value text-right" placeholder="0"></td>
									<td><a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span></td>
								</tr>
					<?php
							}
						}
					} ?>
				</tbody>
			</table>
			<button type="button" class="btn btn-sm btn-primary addData" data-type="extCommission" data-product="curtain" data-id="<?= $no ?>">Add PIC</button>
			<input type="hidden" data-id="<?= $no ?>" id="fee_pic<?= $no ?>">
			<input type="hidden" data-id="<?= $no ?>" id="curtain_disk<?= $no ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ket<?= $no ?>">Keterangan</label>
		<div class="col-md-8">
			<strong>
				<textarea type="text" class="form-control" placeholder="Keterangan" name="product_curtain[<?= $no ?>][ket]" id="ket<?= $no ?>"><?= $dataPanel->keterangan ? $dataPanel->keterangan : '' ?></textarea>
				<label class="label label-danger ket<?= $no ?> hideIt">Keterangan Can't be empty!</label>
			</strong>
		</div>
	</div>
	<br>
</div>


<script>
	// let disc_cat = $('#disc_cat').val();
	if (disc_cat != '') {
		$('.pilihMainten').prop('disabled', false);
	}
</script>