<?php
// echo "<pre>";
// print_r($vitrage);
// echo "<pre>";
// exit;
?>
<div class="col-md-6">
    <div class="form-group">
        <label class="col-sm-4">Item</label>
        <div class="col-md-8">
            <strong>
                <select class="form-control required select2 jahitan-vitrage" data-id="<?= $no ?>" name="product_vitrage[<?= $no ?>][jahitan]" id="jahitan-vitrage<?= $no ?>">
                    <option value=""></option>
                    <?php
                    if ($vitrage->jahit == 'yes') { ?>
                        <?php foreach ($jahitan as $jahit) { ?>
                            <option value="<?= $jahit->id_sewing ?>" <?= $vitrage->jahitan == $jahit->id_sewing ? 'selected' : '' ?>><?= $jahit->item ?></option>
                        <?php }
                    } else {
                        foreach ($jahitan as $jahit) { ?>
                            <option value="<?= $jahit->id_sewing ?>"><?= $jahit->item ?></option>
                    <?php }
                    }
                    ?>
                </select>
            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4">Harga</label>
        <div class="col-md-8">
            <strong>
                <input type="text" value="<?= number_format($vitrage->hrg_jahitan) ?>" readonly class="form-control text-right" placeholder="0" name="product_vitrage[<?= $no ?>][hrg_jahitan]" id="hrg_jahitan-vitrage<?= $no ?>">
            </strong>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="col-sm-4">Diskon Jahitan</label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <input type="number" min="0" data-id="<?= $no ?>" value="<?= number_format($vitrage->disc_jahitan) ?>" class="form-control text-right disc_jahitan-vitrage" placeholder="0" name="product_vitrage[<?= $no ?>][disc_jahitan]" id="disc_jahitan-vitrage<?= $no ?>">
                    <span class="input-group-addon">%</span>
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" data-id="<?= $no ?>" value="<?= number_format($vitrage->val_disc_jahit) ?>" readonly class="form-control text-right" placeholder="0" name="product_vitrage[<?= $no ?>][val_disc_jahit]" id="val_disc_jahit-vitrage<?= $no ?>">
                </div>
            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4">Total</label>
        <div class="col-md-8">
            <strong>
                <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" data-id="<?= $no ?>" value="<?= number_format($vitrage->t_hrg_jahitan) ?>" readonly class="form-control text-right" placeholder="0" name="product_vitrage[<?= $no ?>][t_hrg_jahitan]" id="t_hrg_jahitan-vitrage<?= $no ?>">
                </div>
            </strong>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4">Keterangan</label>
        <div class="col-md-8">
            <textarea name="product_vitrage[<?= $no ?>][ket_jahitan]" id="ket_jahitan<?= $no ?>" class="form-control" placeholder="Keterangan"><?= $curtain->ket_jahitan ?></textarea>
        </div>
    </div>
</div>



<script>
    $(document).on('change', '.disc_jahitan-vitrage', function() {
        let no = $(this).data('id');
        let jns_jhit = $('#jahitan-vitrage' + no).val();
        if (jns_jhit == '') {
            alert('Item jenis jahitan belum dipilih.');
            $(this).val('0');
        } else {
            disc_jahit_vitrage(no);
        }
    })

    function disc_jahit_vitrage(no) {
        console.log(no)
        let hrg_jahitan = $('#hrg_jahitan-vitrage' + no).val().replace(/,/g, '') || 0;
        let disc_jahitan = $('#disc_jahitan-vitrage' + no).val() || 0;
        // console.log(hrg_jahitan)
        val_disc_jahit = parseInt(hrg_jahitan) * parseInt(disc_jahitan) / 100;
        t_hrg_jahitan = hrg_jahitan - val_disc_jahit;
        $('#val_disc_jahit-vitrage' + no).val(('' + val_disc_jahit).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
        $('#t_hrg_jahitan-vitrage' + no).val(('' + t_hrg_jahitan).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
    }
</script>