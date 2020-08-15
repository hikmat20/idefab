<div class="col-md-6">
	<div class="form-group">
		<label class="col-sm-4" for="rail_material-lining<?= $no ?>">Rail Material</label>
		<div class="col-md-7">
			<strong>
				<select class="form-control required select2 rail_material-lining" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][rail_material]" id="rail_material-lining<?= $no ?>">
					<option value=""></option>
					<?php
					foreach ($rails as $rail) { ?>
						<option value="<?= $rail->id_rail ?>" <?= $rail->id_rail == $fabrics_lining->rail_material ? 'selected' : '' ?>><?= $rail->name_product ?></option>
					<?php
					}
					?>
				</select>
				<label class="label label-danger rail_material-lining<?= $no ?> hideIt">Rail Can't be empty!</label>
			</strong>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4" for="cust_rail_name-lining<?= $no ?>">Customer Product Name</label>
		<div class="col-md-7">
			<strong>
				<input class="form-control cust_rail_name-lining" value="<?= $fabrics_lining->cust_rail_name ? $fabrics_lining->cust_rail_name : '' ?>" name="product_lining[<?= $no ?>][cust_rail_name]" id="cust_rail_name-lining<?= $no ?>">
				<label class="label label-danger cust_rail_name-lining<?= $no ?> hideIt">Rail Name Can't be empty!</label>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="Width<?= $no ?>">Window Width</label>
		<div class="col-md-7">
			<strong>
				<div class="input-group">
					<input type="number" min="0" value="<?= $fabrics_lining->window_width ? $fabrics_lining->window_width : '' ?>" readonly class="form-control text-right" placeholder="0" name="product_lining[<?= $no ?>][window_width]" id="window_width-lining<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="overlap-lining<?= $no ?>">Overlap</label>
		<div class="col-md-7">
			<strong>
				<div class="input-group">
					<input type="number" min="0" data-id="<?= $no ?>" value="<?= $fabrics_lining->overlap ? $fabrics_lining->overlap : '' ?>" class="form-control text-right overlap-lining" placeholder="0" name="product_lining[<?= $no ?>][overlap]" id="overlap-lining<?= $no ?>">
					<div class="input-group-addon">cm</div>
				</div>
			</strong>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4" for="width-lining<?= $no ?>">Rail Width</label>
		<div class="col-md-7">
			<strong>
				<div class="input-group">
					<input type="number" min="0" readonly value="<?= $fabrics_lining->width ? $fabrics_lining->width : '' ?>" class="form-control text-right" placeholder="0" name="product_lining[<?= $no ?>][width_rail]" id="width_rail-lining<?= $no ?>">
					<div class="input-group-addon">M</div>
				</div>
			</strong>
		</div>
	</div>


	<div class="form-group">
		<label class="col-sm-4" for="price_rail-lining<?= $no ?>">Price</label>
		<div class="col-md-7">
			<strong>
				<input type="hidden" min="0" value="<?= $fabrics_lining->price ? $fabrics_lining->price : '' ?>" readonly class="form-control text-right" placeholder="0" name="product_lining[<?= $no ?>][price_rail]" id="price_rail-lining<?= $no ?>">
				<input type="text" min="0" value="<?= $fabrics_lining->t_price ? number_format($fabrics_lining->t_price) : '' ?>" readonly class="form-control text-right" placeholder="0" name="product_lining[<?= $no ?>][t_price_rail]" id="t_price_rail-lining<?= $no ?>">
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="subtotal_rail-lining<?= $no ?>">Subtotal</label>
		<div class="col-md-7">
			<strong>
				<input type="text" readonly value="<?= $fabrics_lining->diskon_rail != '' ? $fabrics_lining->diskon_rail : '' ?>" class="form-control required text-right subtotal_rail-lining" placeholder="0" name="product_lining[<?= $no ?>][subtotal_rail]" data-id="<?= $no ?>" id="subtotal_rail-lining<?= $no ?>">
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="diskon_rail-lining<?= $no ?>">Diskon</label>
		<div class="col-md-7">
			<strong>
				<div class="input-group">
					<input type="number" min="0" class="form-control required text-right diskon_rail-lining" value="<?= $fabrics_lining->diskon_rail != '' ? $fabrics_lining->diskon_rail : '' ?>" placeholder="0" name="product_lining[<?= $no ?>][diskon_rail]" data-id="<?= $no ?>" id="diskon_rail-lining<?= $no ?>">
					<span class="input-group-addon">%</span>
					<span class="input-group-addon">Rp.</span>
					<input type="text" min="0" class="form-control text-right" value="<?= $fabrics_lining->v_diskon_rail != '' ? number_format($fabrics_lining->v_diskon_rail) : '' ?>" readonly placeholder=" 0" name="product_lining[<?= $no ?>][v_diskon_rail]" id="v_diskon_rail-lining<?= $no ?>">
				</div>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="total_rail-lining<?= $no ?>">Total</label>
		<div class="col-md-7">
			<strong>
				<input type="text" readonly value="<?= $fabrics_lining->total_rail != '' ? $fabrics_lining->total_rail : '' ?>" class="form-control required text-right total_rail-lining" placeholder="0" name="product_lining[<?= $no ?>][total_rail]" data-id="<?= $no ?>" id="total_rail-lining<?= $no ?>">
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ket_rail-lining<?= $no ?>">Keterangan</label>
		<div class="col-md-7">
			<strong>
				<textarea type="text" min="0" class="form-control" placeholder="Keterangan" name="product_lining[<?= $no ?>][ket_rail]" id="ket_rail-lining<?= $no ?>"><?= $fabrics_lining->keterangan != '' ? $fabrics_lining->keterangan : '' ?></textarea>
			</strong>
		</div>
	</div>

</div>

<div class="col-md-6">

	<div class="form-group">
		<label class="col-sm-4" for="basic_commponen<?= $no ?>">Basic Component</label>
		<div class="col-md-8">
			<strong>

				<div class="table-responsive">
					<table class="table-hover table-bordered table-condensed" id="basic_component-lining<?= $no ?>" width="100%">
						<thead>
							<tr>
								<th>Component</th>
								<th>Qty</th>
								<th>Uom</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$this->db->select('a.*,c.name_component');
							$this->db->from('qtt_basic_comp_rail a');
							$this->db->join('mp_rail_basic b', 'a.id_basic_comp = b.id_rail_basic');
							$this->db->join('master_component c', 'b.id_component = c.id');
							$this->db->where(['a.id_quotation' => $fabrics_lining->id_quotation, 'a.item' => 'lining', 'a.section' => $no]);
							$bsRailComponent = $this->db->get()->result();
							foreach ($bsRailComponent as $bs => $component) {

								if ($bs == 0) {
									$qty = $component->qty * $fabrics_lining->width;
								} else if ($bs == 1) {
									$qty = ceil($fabrics_lining->width / 0.1) / 1;
								} else if ($bs == 2) {
									$qty = ceil($fabrics_lining->width / 0.5);
								} else if ($bs == 3) {
									$qty = $component->qty;
								}
							?>
								<tr>
									<td>
										<?= $component ? $component->name_component : '-' ?>
										<input type="hidden" name="bc_comp-lining[<?= $no ?>][<?= $bs ?>][id_rail_basic]" value="<?= $component ? $component->id_basic_comp : '-' ?>">
									</td>
									<td>
										<?= $component ? $qty : '0' ?>
										<input type="hidden" style="width:100%" name="bc_comp-lining[<?= $no ?>][<?= $bs ?>][qty]" value="<?= $component ? $component->qty : '0' ?>" class="form-control text-right" placeholder="0" maxlength="3" min="0" max="100">
									</td>
									<td>
										<?= $component ? $component->uom : '-' ?>
										<input type="hidden" style="width:100%" name="bc_comp-lining[<?= $no ?>][<?= $bs ?>][uom]" value="<?= $component ? $component->uom : '-' ?>" class="form-control text-right" placeholder="0">
									</td>
								</tr>
							<?php
							} ?>

						</tbody>
					</table>
				</div>

			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="additional_comp_rail-lining<?= $no ?>">Additional Compoenent</label>
		<div class="col-md-8">
			<strong>
				<table class="table-condensed table-striped table-bordered additional_comp_rail-lining" id="additional_comp_rail-lining<?= $no ?>" data-id="<?= $no ?>" width="100%">
					<thead>
						<tr>
							<th>Component</th>
							<th width="25%" class="text-center">Qty</th>
							<th class="text-right">UOM</th>
							<th class="text-center">Price</th>
							<th class="text-center">Total</th>
							<th class="text-center">*</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$this->db->select('a.*,c.name_component');
						$this->db->from('qtt_additional_comp_rail a');
						$this->db->join('mp_rail_additional b', 'a.id_additional_comp = b.id_rail_add');
						$this->db->join('master_component c', 'b.id_component = c.id');
						$this->db->where(['a.id_quotation' => $fabrics_lining->id_quotation, 'a.item' => 'lining', 'a.section' => $no]);
						$adtRailComponent = $this->db->get()->result();
						foreach ($adtRailComponent as $addt => $component) { ?>
							<tr>
								<td>
									<?= $component ? $component->name_component : '-' ?>
									<input type="hidden" id="id_<?= $component->id_basic_comp ?>" name="addt_comp-lining[<?= $no ?>][<?= $addt ?>][id_comp]" value="<?= $component ? $component->id_basic_comp : '-' ?>">
								</td>
								<td>
									<input type="number" id="qty_<?= $component->id_basic_comp ?>" style="width:100%" name="addt_comp-lining[<?= $no ?>][<?= $addt ?>][qty]" data-id="<?= $component->id_basic_comp ?>" value="<?= $component ? $component->qty : '0' ?>" class="qty_add_comp-lining form-control text-right" placeholder="0" min="0" max="100">
								</td>
								<td>
									<?= $component ? $component->uom : '-' ?>
									<input type="hidden" id="uom_<?= $component->id_basic_comp ?>" style="width:100%" name="addt_comp-lining[<?= $no ?>][<?= $addt ?>][uom]" value="<?= $component ? $component->uom : '-' ?>" class="form-control text-right" placeholder="0">
								</td>
								<td>
									<?= $component ? number_format($component->selling_price) : '-' ?>
									<input type="hidden" id="price_<?= $component->id_basic_comp ?>" style="width:100%" name="addt_comp-lining[<?= $no ?>][<?= $addt ?>][price]" id="price_lining<?= $component->id_basic_comp ?>" value="<?= $component ? $component->selling_price : '-' ?>" class="form-control text-right" placeholder="0">
								</td>
								<td>
									<input type="text" id="t_price_<?= $component->id_basic_comp ?>" readonly style="width:100%" name="addt_comp-lining[<?= $no ?>][<?= $addt ?>][t_price]" id="t_price_lining<?= $component->id_basic_comp ?>" value="<?= $component ? number_format($component->selling_price * $component->qty) : '0' ?>" class="form-control text-right" placeholder="0">
								</td>
								<td>
									<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a>
								</td>
							</tr>
						<?php
						} ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4" class="text-right">Total</td>
							<td colspan="">
								<input type="text" name="product_lining[<?= $no ?>][total_add_comp_rail]" id="total_add_comp_rail-lining<?= $no ?>" class="form-control text-right" placeholder="0" readonly>
							</td>
							<td></td>
						</tr>
					</tfoot>
				</table>
				<button type="button" class="btn btn-sm btn-primary addData" data-type="additionalComp" data-product="lining" data-id="<?= $no ?>">Add Component</button>
			</strong>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4" for="ex_comm_rail-lining<?= $no ?>">External Commission</label>
		<div class="col-md-8">
			<strong>
				<table class="table-condensed table-striped table-bordered extComm_rail-lining" id="extComm_rail-lining<?= $no ?>" data-id="<?= $no ?>" width="100%">
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
						$exCOmm = $this->db->get_where('qtt_ext_commission', ['id_quotation' => $fabrics_lining->id_quotation, 'item' => 'rail-lining', 'section' => $no])->result();
						if ($exCOmm) {
							foreach ($exCOmm as $cm => $comm) {
								$this->db->select('a.*,b.name_pic');
								$this->db->from('qtt_ext_commission a');
								$this->db->join('child_customer_pic b', 'a.id_pic = b.id_pic');
								$this->db->where(['a.id_pic' => $comm->id_pic, 'a.id_quotation' => $comm->id_quotation, 'a.item' => 'rail-lining', 'a.section' => $no]);
								$railCommissi = $this->db->get()->result();
								foreach ($railCommissi as $Commission) {

						?>
									<tr>
										<td><?= $Commission->name_pic ?>
											<input type="hidden" value="<?= $Commission->id_pic ?>" name="ext_comm_rail_lining[<?= $no ?>][<?= $cm ?>][id_pic]" data-id="<?= $Commission->id_pic ?>" value="<?= $Commission->id_pic ?>">
										</td>
										<td><input type="number" style="width:100%" value="<?= $Commission->persen_fee ?>" name="ext_comm_rail_lining[<?= $no ?>][<?= $cm ?>][persen]" data-id="<?= $Commission->id_pic ?>" id="persen_<?= $Commission->id_pic ?>" class="form-control input-sm numberOnly persen text-right" placeholder="0" maxLength="3" min="0" max="100">
										</td>
										<td><input type="text" style="width:100%" value="<?= $Commission->value_fee ?>" name="ext_comm_rail_lining[<?= $no ?>][<?= $cm ?>][value]" data-id="<?= $Commission->id_pic ?>" id="value_<?= $Commission->id_pic ?>" class="form-control input-sm numberOnly nominal value text-right" placeholder="0"></td>
										<td><a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span></td>
									</tr>
						<?php
								}
							}
						} ?>

					</tbody>
				</table>
				<button type="button" class="btn btn-sm btn-primary addData" data-type="extCommission" data-product="rail-lining" data-id="<?= $no ?>">Add PIC</button>
				<input type="hidden" data-id="<?= $no ?>" id="fee_rail-lining<?= $no ?>">
				<input type="hidden" data-id="<?= $no ?>" id="diskon_rail-lining<?= $no ?>">
			</strong>
		</div>
	</div>
</div>

<script>
	$(document).on('change', '.overlap-lining', function() {
		no = $(this).data('id');
		id_rail = $('#rail_material-lining' + no).val();
		overlap_lining(no);
		getBasicComponentLining(id_rail, no);
		subtotal_rail_lining(no);
		diskon_rail_lining(no);
		total_rail_lining(no);
	})

	function overlap_lining(no) {
		overlap = $('#overlap-lining' + no).val() || 0;
		qty = $('#qty_unit' + no).val() || 0;
		window_width = $('#window_width-lining' + no).val() || 0;
		price_rail = $('#price_rail-lining' + no).val().replace(/,/g, '') || 0;

		t_width_rail = parseInt(window_width) + parseInt(overlap);
		$('#width_rail-lining' + no).val(t_width_rail / 100);
		t_price_rail = (parseInt(price_rail) * (parseInt(t_width_rail) / 100) * qty);
		$('#t_price_rail-lining' + no).val(("" + t_price_rail.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
	}

	function subtotal_rail_lining(no) {
		let t_price_rail = $('#t_price_rail-lining' + no).val().replace(/,/g, '') || 0;
		let t_add_comp_rail = $('#total_add_comp_rail-lining' + no).val().replace(/,/g, '') || 0;
		let subtotal_rail = parseInt(t_price_rail) + parseInt(t_add_comp_rail);
		$('#subtotal_rail-lining' + no).val(("" + subtotal_rail.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
	}

	function total_rail_lining(no) {
		let v_disc_rail = $('#v_diskon_rail-lining' + no).val().replace(/,/g, '') || 0;
		console.log(v_disc_rail);
		let subtotal_rail = $('#subtotal_rail-lining' + no).val().replace(/,/g, '') || 0;
		let total_rail = parseInt(subtotal_rail) - parseInt(v_disc_rail);
		$('#total_rail-lining' + no).val(("" + total_rail.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
	}
</script>