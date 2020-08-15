<div class="detailVitrage<?= $no ?>">
    <div class="row">
        <!-- =================== SIDE LEFT ============================= -->

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-4" for="product_vitrage<?= $no ?>">Vitrage Material <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <select class="form-control required select2 product_vitrage" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][id_product]" id="product_vitrage<?= $no ?>">
                            <option value=""></option>
                            <?php
                            $products = $this->db->get_where('pricelist_fabric_view', ['activation' => 'aktif'])->result();
                            foreach ($products as $product) { ?>
                                <option value="<?= $product->id_product ?>" <?= $product->id_product == $vitrage->id_product ? 'selected' : '' ?>><?= $product->name_product ?></option>
                            <?php }
                            ?>
                        </select>
                        <label class="label label-danger product_vitrage<?= $no ?> hideIt">Product Vitrage Can't be empty!</label>
                    </strong>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="cust_vitrage_name<?= $no ?>">Customer Product Name <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <input type="text" class="form-control cust_vitrage_name" value="<?= !empty($vitrage) ? $vitrage->cust_product_name : '' ?>" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][cust_vitrage_name]" id="cust_vitrage_name<?= $no ?>">
                        <label class="label label-danger cust_vitrage_name<?= $no ?> hideIt">Product Name Can't be empty!</label>
                    </strong>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="panel<?= $no ?>">Panel <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <select class="form-control required select2 dt_panel" data-id="<?= $no ?>" data-type="panel-vitrage" name="product_vitrage[<?= $no ?>][panel]" id="panel-vitrage<?= $no ?>">
                            <option value=""></option>
                            <option value="no" <?= $vitrage->panel == 'no' ? 'selected' : '' ?>>No</option>
                            <option value="yes" <?= $vitrage->panel == 'yes' ? 'selected' : '' ?>>Yes</option>
                        </select>
                        <label class="label label-danger panel-vitrage<?= $no ?> hideIt">Panel Vitrage Can't be empty!</label>
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
                        <input type="text" value="<?= $vitrage->lebar_kain ?>" readonly class="form-control lebar_kain" placeholder="0" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][lebar_kain]" id="lebar_kain-vitrage<?= $no ?>">
                        <label class="label label-danger lebar_kain-vitrage<?= $no ?> hideIt">Lebar Kain Can't be empty!</label>
                    </strong>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="harga_kain<?= $no ?>">Harga Kain <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input type="hidden" value="<?= $vitrage->harga_kain ?>" class="form-control text-right harga_kain" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_vitrage[<?= $no ?>][harga_kain]" id="harga_kain-vitrage<?= $no ?>">
                            <input type="text" value="<?= number_format($vitrage->t_harga_kain) ?>" class="form-control text-right t_harga_kain" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_vitrage[<?= $no ?>][t_harga_kain]" id="t_harga_kain-vitrage<?= $no ?>">
                        </div>
                        <label class="label label-danger harga_kain-vitrage<?= $no ?> hideIt">Harga Kain Can't be empty!</label>
                    </strong>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="harga_kain<?= $no ?>">Total Harga Kain <span class='text-red'>*</span></label>
                <div class="col-md-8">
                    <strong>
                        <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input type="text" value="<?= number_format($vitrage->t_harga_kain * $vitrage->t_kain)  ?>" class=" form-control text-right total_harga_kain-vitrage" data-id="<?= $no ?>" readonly placeholder="0" min="0" name="product_vitrage[<?= $no ?>][total_harga_kain]" id="total_harga_kain-vitrage<?= $no ?>">
                        </div>
                        <label class="label label-danger harga_kain-vitrage<?= $no ?> hideIt">Total Harga Kain Can't be empty!</label>
                    </strong>
                </div>
            </div>

        </div>
    </div>
    <div class="data-detail-vitrage<?= $no ?> row"></div>

    <!-- jenis jahitan -->
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4" for="jns_jahit<?= $no ?>">Jenis Jahitan</label>
                <div class="col-md-8">
                    <?php
                    if ($vitrage->jahit == "yes") {
                        $j_yes = 'checked';
                        $j_no = '';
                        $j_def = '';
                    } else if ($vitrage->jahit == "no") {
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
                        <label style="padding-left:20px"><input type="radio" class="pilihJahitan-vitrage" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][jahit]" <?= $j_no . $j_def ?> value="no"><span style="margin-left:5px">No</span></label>
                        <label style="margin-left:20px"><input type="radio" class="pilihJahitan-vitrage" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][jahit]" <?= $j_yes ?> value="yes"><span style="margin-left:5px">Yes</span></label>
                        <label class="label label-danger jahit<?= $no ?> hideIt">Jahitan Can't be empty!</label>
                    </strong>
                </div>
            </div>

        </div>
    </div>
    <div data-jht="<?= $vitrage->jahitan ?>" id="dt_jns_jahit-vitrage<?= $no ?>" class="row"></div>

    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4" for="rail_vitrage<?= $no ?>">Rail Vitrage</label>
                <div class="col-md-8">
                    <?php
                    if ($vitrage->rail == "yes") {
                        $r_yes = 'checked';
                        $r_no = '';
                        $r_def = '';
                    } else if ($vitrage->rial == "no") {
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
                        <label style="padding-left:20px"><input type="radio" class="pilihRail-vitrage" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][rail_vitrage]" <?= $r_def . $r_no ?> value="no"><span style="margin-left:5px">No</span></label>
                        <label style="margin-left:20px"><input type="radio" class="pilihRail-vitrage" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][rail_vitrage]" <?= $r_yes ?> value="yes"><span style="margin-left:5px">Yes</span></label>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="dt_rail-vitrage<?= $no ?>"></div>
</div>