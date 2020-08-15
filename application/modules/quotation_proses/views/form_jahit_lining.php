<div class="col-md-6">
    <div class="form-group">
        <label class="col-sm-4">Item</label>
        <div class="col-md-8">
            <strong>
                <select class="form-control required select2 jahitan-lining" data-id="<?= $no ?>" name="product_lining[<?= $no ?>][jahitan]" id="jahitan-lining<?= $no ?>">
                    <option value=""></option>
                    <?php
                    $lining = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation, 'jahitan' => $id_jahitan])->row();
                    $jahitan = $this->db->get_where('sewing', ['activation' => 'aktif'])->result();

                    if ($lining->jahit == 'yes') { ?>
                        <?php foreach ($jahitan as $jahit) { ?>
                            <option value="<?= $jahit->id_sewing ?>" <?= $lining->jahitan == $jahit->id_sewing ? 'selected' : '' ?>><?= $jahit->item ?></option>
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
                <input type="text" data-id="<?= $no ?>" value="<?= number_format($lining->hrg_jahitan) ?>" readonly class="form-control text-right" placeholder="0" name="product_lining[<?= $no ?>][hrg_jahitan]" id="hrg_jahitan-lining<?= $no ?>">
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
                    <input type="number" min="0" data-id="<?= $no ?>" value="<?= number_format($lining->disc_jahitan) ?>" class="form-control text-right disc_jahitan-lining" placeholder="0" name="product_lining[<?= $no ?>][disc_jahitan]" id="disc_jahitan-lining<?= $no ?>">
                    <span class="input-group-addon">%</span>
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" data-id="<?= $no ?>" value="<?= number_format($lining->val_disc_jahit) ?>" readonly class="form-control text-right" placeholder="0" name="product_lining[<?= $no ?>][val_disc_jahit]" id="val_disc_jahit-lining<?= $no ?>">
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
                    <input type="text" data-id="<?= $no ?>" value="<?= number_format($lining->t_hrg_jahitan) ?>" readonly class="form-control text-right" placeholder="0" name="product_lining[<?= $no ?>][t_hrg_jahitan]" id="t_hrg_jahitan-lining<?= $no ?>">

                </div>
            </strong>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4">Keterangan</label>
        <div class="col-md-8">
            <textarea name="product_lining[<?= $no ?>][ket_jahitan]" id="ket_jahitan-lining<?= $no ?>" class="form-control" placeholder="Keterangan"><?= $curtain->ket_jahitan ?></textarea>
        </div>
    </div>
</div>

<script>
    $(document).on('change', '.disc_jahitan-lining', function() {
        let no = $(this).data('id');
        let jns_jhit = $('#jahitan-lining' + no).val();
        if (jns_jhit == '') {
            alert('Item jenis jahitan belum dipilih.');
            $(this).val('0');
        } else {
            disc_jahitan_lining(no);
        }
    })

    function disc_jahitan_lining(no) {
        let hrg_jahitan = $('#hrg_jahitan-lining' + no).val().replace(/,/g, '') || 0;
        let disc_jahitan = $('#disc_jahitan-lining' + no).val() || 0;
        // console.log(hrg_jahitan)
        val_disc_jahit = parseInt(hrg_jahitan) * parseInt(disc_jahitan) / 100;
        t_hrg_jahitan = hrg_jahitan - val_disc_jahit;
        $('#val_disc_jahit-lining' + no).val(('' + val_disc_jahit).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
        $('#t_hrg_jahitan-lining' + no).val(('' + t_hrg_jahitan).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
    }
</script>