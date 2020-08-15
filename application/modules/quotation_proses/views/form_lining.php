<div class="detailLining<?= $no ?>">
    <div class="row">
        <!-- =================== SIDE LEFT ============================= -->

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-4" for="product_lining<?= $no ?>">Lining Material <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <select class="form-control required select2 product_lining" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][id_product]" id="product_lining<?= $no ?>">
                            <?php
                            $products = $this->db->get_where('pricelist_fabric_view', ['activation' => 'aktif'])->result();
                            foreach ($products as $product) { ?>
                                <option value="<?= $product->id_product ?>" <?= $product->id_product == $lining->id_product ? 'selected' : '' ?>><?= $product->name_product ?></option>
                            <?php }
                            ?>
                        </select>
                        <label class="label label-danger product_lining<?= $no ?> hideIt">Product Lining Can't be empty!</label>
                    </strong>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="product_lining<?= $no ?>">Customer Product Name <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <input type="text" class="form-control cust_lining_name" value="<?= !empty($lining) ? $lining->cust_product_name : '' ?>" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][cust_lining_name]" id="cust_lining_name<?= $no ?>">
                        <label class="label label-danger cust_lining_name<?= $no ?> hideIt">Product Name Can't be empty!</label>
                    </strong>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="panel<?= $no ?>">Panel <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <select class="form-control required select2 dt_panel" data-id="<?= $no ?>" data-type="panel-lining" name="product_lining[<?= $no ?>][panel]" id="panel-lining<?= $no ?>">
                            <option value=""></option>
                            <option value="no" <?= $lining->panel == 'no' ? 'selected' : '' ?>>No</option>
                            <option value="yes" <?= $lining->panel == 'yes' ? 'selected' : '' ?>>Yes</option>
                        </select>
                        <label class="label label-danger panel-lining<?= $no ?> hideIt">Panel Lining Can't be empty!</label>
                    </strong>
                </div>
            </div>

        </div>

        <!-- =================== SIDE RIGHT ============================= -->

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-4" for="lebar_kain<?= $no ?>">Lebar Kain <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <input type="text" value="<?= !empty($lining) ? $lining->lebar_kain : '' ?>" readonly class="form-control lebar_kain" placeholder="0" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][lebar_kain]" id="lebar_kain-lining<?= $no ?>">
                        <label class="label label-danger lebar_kain-lining<?= $no ?> hideIt">Lebar Kain Can't be empty!</label>
                    </strong>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="harga_kain<?= $no ?>">Harga Kain <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input type="hidden" value="<?= !empty($lining) ? $lining->harga_kain : '' ?>" class="form-control text-right harga_kain" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_lining[<?= $no ?>][harga_kain]" id="harga_kain-lining<?= $no ?>">
                            <input type="text" value="<?= !empty($lining) ? number_format($lining->t_harga_kain) : '' ?>" class="form-control text-right t_harga_kain" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_lining[<?= $no ?>][t_harga_kain]" id="t_harga_kain-lining<?= $no ?>">
                        </div>
                        <label class="label label-danger harga_kain-lining<?= $no ?> hideIt">Harga Kain Can't be empty!</label>
                    </strong>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="harga_kain<?= $no ?>">Total Harga Kain <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input type="text" value="<?= number_format($lining->t_harga_kain * $lining->t_kain)  ?>" class=" form-control text-right total_harga_kain-lining" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_lining[<?= $no ?>][total_harga_kain]" id="total_harga_kain-lining<?= $no ?>">
                        </div>
                        <label class="label label-danger harga_kain-lining<?= $no ?> hideIt">Total Harga Kain Can't be empty!</label>
                    </strong>
                </div>
            </div>

        </div>
    </div>

    <div class="data-detail-lining<?= $no ?> row">
    </div>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4" for="jns_jahit<?= $no ?>">Jenis Jahitan</label>
                <div class="col-md-8">
                    <?php
                    if ($lining->jahit == "yes") {
                        $j_yes = 'checked';
                        $j_no = '';
                        $j_def = '';
                    } else if ($lining->jahit == "no") {
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
                        <label style="padding-left:20px"><input type="radio" class="pilihJahitan-lining" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][jahit]" <?= $j_no . $j_def ?> value="no"><span style="margin-left:5px">No</span></label>
                        <label style="margin-left:20px"><input type="radio" class="pilihJahitan-lining" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][jahit]" <?= $j_yes ?> value="yes"><span style="margin-left:5px">Yes</span></label>
                        <label class="label label-danger jahit<?= $no ?> hideIt">Jahitan Can't be empty!</label>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div data-jht="<?= $lining->jahitan ?>" id="dt_jns_jahit-lining<?= $no ?>">
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4" for="rail_lining<?= $no ?>">Rail Lining</label>
                <div class="col-md-8">
                    <?php
                    if ($lining->rail == "yes") {
                        $r_yes = 'checked';
                        $r_no = '';
                        $r_def = '';
                    } else if ($lining->rial == "no") {
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
                        <label style="padding-left:20px"><input type="radio" class="pilihRail-lining" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][rail_lining]" <?= $r_no . $r_def ?> value="no"><span style="margin-left:5px">No</span></label>
                        <label style="margin-left:20px"><input type="radio" class="pilihRail-lining" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][rail_lining]" <?= $r_yes ?> value="yes"><span style="margin-left:5px">Yes</span></label>
                    </strong>
                </div>
            </div>

        </div>
    </div>

    <div class="row" id="dt_rail_lining<?= $no ?>">
    </div>
</div>