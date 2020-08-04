<div class="panel panel-solid detailCurtain<?= $no ?>">
	<div class="panel-body">

		<div class="box box-default">
			<div class="box-body">
				<div class="row">
					<!-- =================== SIDE LEFT ============================= -->
					<?php
					// $dataCurtain = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'panel' => 'no', 'item' => 'curtain'])->result();

					// echo "<pre>";
					// print_r($curtain[0]->cust_product_name);
					// echo "</pre>";

					?>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-sm-3" for="product_curtain<?= $no ?>">Curtain Material <span class='text-red'>*</span></label>
							<div class="col-md-7">
								<strong>
									<select class="form-control required select2 product_curtain" data-id="<?= $no ?>" name="product_curtain[<?= $no ?>][id_product]" id="product_curtain<?= $no ?>">
										<option value=""></option>
										<?php
										$products = $this->db->get_where('pricelist_fabric_view', ['activation' => 'aktif'])->result();
										foreach ($products as $product) { ?>
											<option value="<?= $product->id_product ?>" <?= $product->id_product == $curtain[0]->id_product ? 'selected' : '' ?>><?= $product->name_product ?></option>
										<?php }
										?>
									</select>

									<label class="label label-danger product_curtain<?= $no ?> hideIt">Product Curtain Can't be empty!</label>
								</strong>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="product_curtain<?= $no ?>">Customer Product Name <span class='text-red'>*</span></label>
							<div class="col-md-7">
								<strong>
									<input type="text" class="form-control cust_curtain_name" data-id="<?= $no ?>" value="<?= $curtain[0]->cust_product_name ?>" name="product_curtain[<?= $no ?>][cust_curtain_name]" id="cust_curtain_name<?= $no ?>">
									<label class="label label-danger cust_curtain_name<?= $no ?> hideIt">Product Name Can't be empty!</label>
								</strong>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="panel<?= $no ?>">Panel <span class='text-red'>*</span></label>
							<div class="col-md-7">
								<strong>
									<select class="form-control required select2 dt_panel" data-id="<?= $no ?>" data-type="panel-curtain" name="product_curtain[<?= $no ?>][panel]" id="panel<?= $no ?>">
										<option value=""></option>
										<option value="no" <?= $curtain[0]->panel == 'no' ? 'selected' : '' ?>>No</option>
										<option value="yes" <?= $curtain[0]->panel == 'yes' ? 'selected' : '' ?>>Yes</option>
									</select>
									<label class="label label-danger panel<?= $no ?> hideIt">Panel Curtain Can't be empty!</label>
								</strong>
							</div>
						</div>

					</div>

					<!-- =================== SIDE RIGHT ============================= -->

					<div class="col-md-6">

						<div class="form-group">
							<label class="control-label col-sm-3" for="lebar_kain<?= $no ?>">Lebar Kain <span class='text-red'>*</span></label>
							<div class="col-md-7">
								<strong>
									<input type="text" value="<?= $curtain[0]->lebar_kain ?>" readonly class="form-control lebar_kain" placeholder="0" data-id="<?= $no ?>" name="product_curtain[<?= $no ?>][lebar_kain]" id="lebar_kain<?= $no ?>">
									<label class="label label-danger lebar_kain<?= $no ?> hideIt">Lebar Kain Can't be empty!</label>
								</strong>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="harga_kain<?= $no ?>">Harga Kain <span class='text-red'>*</span></label>
							<div class="col-md-7">
								<strong>
									<div class="input-group">
										<span class="input-group-addon">Rp.</span>
										<input type="hidden" value="<?= $curtain[0]->harga_kain ?>" class=" form-control text-right harga_kain" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_curtain[<?= $no ?>][harga_kain]" id="harga_kain<?= $no ?>">
										<input type="text" value="<?= number_format($curtain[0]->t_harga_kain) ?>" class=" form-control text-right t_harga_kain" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_curtain[<?= $no ?>][t_harga_kain]" id="t_harga_kain<?= $no ?>">
										<span class="input-group-addon">/m</span>
									</div>
									<label class="label label-danger harga_kain<?= $no ?> hideIt">Harga Kain Can't be empty!</label>
								</strong>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="harga_kain<?= $no ?>">Total Harga Kain <span class='text-red'>*</span></label>
							<div class="col-md-7">
								<strong>
									<div class="input-group">
										<span class="input-group-addon">Rp.</span>
										<input type="text" value="<?= number_format($curtain[0]->t_harga_kain * $curtain[0]->t_kain)  ?>" class=" form-control text-right total_harga_kain" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_curtain[<?= $no ?>][total_harga_kain]" id="total_harga_kain<?= $no ?>">
									</div>
									<label class="label label-danger harga_kain<?= $no ?> hideIt">Total Harga Kain Can't be empty!</label>
								</strong>
							</div>
						</div>

					</div>
				</div>

				<div class="data-detail-curtain<?= $no ?> row">
				</div>
			</div>
		</div>

		<!-- jenis jahitan -->
		<div class="box box-default">
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-sm-3" for="jns_jahit<?= $no ?>">Jenis Jahitan</label>
							<div class="col-md-9">
								<?php
								if ($curtain[0]->jahit == "yes") {
									$j_yes = 'checked';
									$j_no = '';
									$j_def = '';
								} else if ($curtain[0]->jahit == "no") {
									$j_yes = '';
									$j_no = 'checked';
									$j_def = '';
								} else {
									$j_yes = '';
									$j_no = '';
									$j_def = 'checked';
								}
								?>
								<strong>
									<label style="padding-left:20px"><input type="radio" class="pilihJahitan" data-id="<?= $no ?>" name="product_curtain[<?= $no ?>][jahit]" <?= $j_no . $j_def ?> value="no"><span style="margin-left:5px">No</span></label>
									<label style="margin-left:20px"><input type="radio" class="pilihJahitan" data-id="<?= $no ?>" name="product_curtain[<?= $no ?>][jahit]" <?= $j_yes  ?> value="yes"><span style="margin-left:5px">Yes</span></label>
									<label class="label label-danger jahit<?= $no ?> hideIt">Jahitan Can't be empty!</label>
								</strong>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div data-jht="<?= $curtain[0]->jahitan ?>" id="dt_jns_jahit<?= $no ?>">
					</div>
				</div>
			</div>
		</div>

		<div class="box box-default">
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-sm-3" for="rail_curtain<?= $no ?>">Rail Curtain</label>
							<div class="col-md-7">
								<?php
								if ($curtain[0]->rail == "yes") {
									$r_yes = 'checked';
									$r_no = '';
									$r_def = '';
								} else if ($curtain[0]->jahit == "no") {
									$r_yes = '';
									$r_no = 'checked';
									$r_def = '';
								} else {
									$r_yes = '';
									$r_no = '';
									$r_def = 'checked';
								}
								?>
								<strong>
									<label style="padding-left:20px"><input type="radio" class="pilihRail" data-id="<?= $no ?>" <?= $r_no . $r_def ?> name="product_curtain[<?= $no ?>][rail_curtain]" value="no"><span style="margin-left:5px">No</span></label>
									<label style="margin-left:20px"><input type="radio" class="pilihRail" data-id="<?= $no ?>" <?= $r_yes ?> name="product_curtain[<?= $no ?>][rail_curtain]" value="yes"><span style="margin-left:5px">Yes</span></label>
								</strong>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div id="dt_rail_curtain<?= $no ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>