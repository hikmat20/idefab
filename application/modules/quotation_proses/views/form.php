<?php

$count = $this->input->post('count');

if ($count != '') {
    $no = $count + 1;
}
$rooms = $this->db->get_where('quotation_room', ['id_quotation' => $id])->result();
?>

<?php

if (!empty($rooms)) {
    $no = 0;
    foreach ($rooms as $room) {
        $no++;
?>
        <div data-item="ruang" data-count="<?= $no ?>">
            <div class="form-horizontal">
                <div class="box box-default" style="border-top-color:indigo">
                    <div class="box-header with-border">
                        <h3 class="box-title"><label for="">Deskripsi Jendela[<?= $no ?>]</label></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-info btn-sm show-hide-btn" data-widget="collapse" style="margin:0px 5px">Hide</button>
                            <a href="javascript:void(0)" class="pull-right btn btn-sm btn-danger del_jendela"><i class="fa fa-trash"></i> Delete Jendela</a>
                        </div>
                        <input type="hidden" data-id="<?= $no ?>" id="id_ruangan<?= $no ?>" class="form-control required" value="<?= $room->id_ruangan ?>" name="ruang[<?= $no ?>][id_ruangan]">
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="ruangan">Ruangan <span class='text-red'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control required" value="<?= $room != '' ? $room->name_room : '' ?>" id="ruang<?= $no ?>" placeholder="Nama Ruangan" name="ruang[<?= $no ?>][nm_ruang]">
                                        <label class="label label-danger ruang<?= $no ?> hideIt">Ruangan Can't be empty!</label></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2" for="lantai">Lantai <span class='text-red'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control required" value="<?= $room != '' ? $room->floor : '' ?>" placeholder="Lantai" id="lantai<?= $no ?>" name="ruang[<?= $no ?>][lantai]">
                                        <label class="label label-danger lantai<?= $no ?> hideIt">Lantai Can't be empty!</label></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2" for="jendela">Jendela <span class='text-red'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control required" value="<?= $room != '' ? $room->window : '' ?>" placeholder="Jendela" id="jendela<?= $no ?>" name="ruang[<?= $no ?>][jendela]">
                                        <label class="label label-danger jendela<?= $no ?> hideIt">Jendela Can't be empty!</label></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2" for="lebar">Lebar <span class='text-red'>*</span></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control required lebar" value="<?= $room != '' ? $room->width_window : '' ?>" data-id="<?= $no ?>" placeholder="0" id="lebar<?= $no ?>" name="ruang[<?= $no ?>][lebar]">
                                            <span class="input-group-addon">cm</span>
                                        </div>
                                        <label class="label label-danger lebar<?= $no ?> hideIt">Lebar Can't be empty!</label></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2" for="tinggi">Tinggi <span class='text-red'>*</span></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control required tinggi" value="<?= $room != '' ? $room->height_window : '' ?>" placeholder="0" data-id="<?= $no ?>" id="tinggi<?= $no ?>" name="ruang[<?= $no ?>][tinggi]">
                                            <span class="input-group-addon">cm</span>
                                        </div>
                                        <label class="label label-danger tinggi<?= $no ?> hideIt">Tinggi Can't be empty!</label></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2" for="tinggi">Qty Unit <span class='text-red'>*</span></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control required qty_unit" value="<?= $room != '' ? $room->qty_unit : '' ?>" placeholder="0" data-id="<?= $no ?>" id="qty_unit<?= $no ?>" name="ruang[<?= $no ?>][qty_unit]">
                                            <span class="input-group-addon">pcs</span>
                                        </div>
                                        <label class="label label-danger qty_unit<?= $no ?> hideIt">Qty Unit Can't be empty!</label></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2">Installation <span class='text-red'>*</span></label>
                                    <div class="col-md-4">
                                        <?php
                                        if ($room->installation == 'yes') {
                                            $yes = 'checked';
                                            $No = '';
                                            $def = '';
                                        } else if ($room->installation == 'no') {
                                            $yes = '';
                                            $No = 'checked';
                                            $def = '';
                                        } else {
                                            $yes = '';
                                            $No = '';
                                            $def = 'checked';
                                        }
                                        ?>
                                        <div class="input-group">
                                            <label style="padding-left:20px"><input type="radio" <?= $No ?> class="required" name="ruang[<?= $no ?>][installation]" value="no"><span style="margin-left:5px">No</span></label>
                                            <label style="margin-left:20px"><input type="radio" <?= $yes ?> class="required" name="ruang[<?= $no ?>][installation]" value="yes"><span style="margin-left:5px">Yes</span></label>
                                            <label class="label label-danger ruang[<?= $no ?>][installation] hideIt">Installation Can't be empty!</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-offset-1">
                                <!-- <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label class=" for="upload">Upload Gambar</label>
                                        <input type="file" id="upload_<?= $no ?>" name="uplaod_gambar_[<?= $no ?>][]">
                                    </div>
                                </div>
                                <img src="" alt="gamabar" id="gmbr_[<?= $no ?>][]">
                            </div> -->
                            </div>
                        </div>

                        <hr>
                        <!-- DETAIL -->
                        <?php
                        $fabrics_curtain = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan,  'item' => 'curtain', 'section' => $no])->result();
                        $fabrics_lining = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $room->id_quotation, 'item' => 'lining', 'section' => $no])->result();
                        $fabrics_vitrage = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $room->id_quotation, 'item' => 'vitrage', 'section' => $no])->result();
                        $accessories = $this->db->get_where('qtt_accessoriess', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $room->id_quotation, 'item' => 'accessoriess'])->result();

                        // echo "<pre>";
                        // print_r($fabrics_curtain);
                        // echo "<pre>";
                        // exit;
                        ?>
                        <div class="box box-primary curtain-box<?= $no ?> collapsed-box">
                            <div class="box-header with-border">
                                <div class="material-switch curtain-switch<?= $no ?>">
                                    <input class="switch-curtain" <?= !empty($fabrics_curtain) ? 'checked' : ''  ?> data-id="<?= $no ?>" id="switch-curtain<?= $no ?>" name="switch-curtain" type="checkbox" />
                                    <label for="switch-curtain<?= $no ?>" data-id="<?= $no ?>" class="label-primary"></label>
                                    <h3 class="box-title">Curtain</h3>
                                </div>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-sm btn-info show-hide-btn" data-widget="collapse">Hide</button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="box-curtain<?= $no ?>">
                                </div>
                            </div>
                        </div>

                        <div class="box box-info lining-box<?= $no ?> collapsed-box">
                            <div class="box-header with-border">
                                <div class="material-switch lining-switch<?= $no ?>">
                                    <input class="switch-lining" <?= !empty($fabrics_lining) ? 'checked' : ''  ?> data-id="<?= $no ?>" id="switch-lining<?= $no ?>" name="switch-lining" type="checkbox" />
                                    <label for="switch-lining<?= $no ?>" data-id="<?= $no ?>" class="label-info"></label>
                                    <h3 class="box-title">Lining</h3>
                                </div>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-sm btn-info show-hide-btn" data-widget="collapse">Hide</button>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="box-lining<?= $no ?>">
                                </div>
                            </div>
                        </div>

                        <div class="box box-warning vitrage-box<?= $no ?> collapsed-box">
                            <div class="box-header with-border">
                                <div class="material-switch vitrage-switch<?= $no ?>">
                                    <input class="switch-vitrage" <?= !empty($fabrics_vitrage) ? 'checked' : ''  ?> data-id="<?= $no ?>" id="switch-vitrage<?= $no ?>" name="switch-vitrage" type="checkbox" />
                                    <label for="switch-vitrage<?= $no ?>" data-id="<?= $no ?>" class="label-warning"></label>
                                    <h3 class="box-title">Vitrage</h3>
                                </div>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-sm btn-info show-hide-btn" data-widget="collapse">Hide</button>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="box-vitrage<?= $no ?>">

                                </div>
                            </div>

                        </div>

                        <div class="box box-danger accessories-box<?= $no ?> collapsed-box">
                            <div class="box-header with-border">
                                <div class="material-switch accessories-switch<?= $no ?>">
                                    <input class="switch-accessories" <?= !empty($accessories) ? 'checked' : ''  ?> data-id="<?= $no ?>" id="switch-accessories<?= $no ?>" name="switch-accessories" type="checkbox" />
                                    <label for="switch-accessories<?= $no ?>" data-id="<?= $no ?>" class="label-danger"></label>
                                    <h3 class="box-title">Accessories</h3>
                                </div>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-sm btn-info show-hide-btn" data-widget="collapse">Hide</button>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="box-accessories<?= $no ?>">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
} else { ?>
    <div data-item="ruang" data-count="<?= $no ?>">
        <div class="form-horizontal">
            <div class="box box-default" style="border-top-color:indigo">
                <div class="box-header with-border">
                    <h3 class="box-title"><label> Deskripsi Jendela[<?= $no ?>]</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-sm btn-info" data-widget="collapse" style="margin:0px 5px">Hide</button>
                        <a href="javascript:void(0)" class="pull-right btn btn-sm btn-danger del_jendela"><i class="fa fa-trash"></i> Delete Jendela</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-2" for="ruangan">Ruangan <span class='text-red'>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control required" value="<?= $room != '' ? $room->name_room : '' ?>" id="ruang<?= $no ?>" placeholder="Nama Ruangan" name="ruang[<?= $no ?>][nm_ruang]">
                                    <label class="label label-danger ruang<?= $no ?> hideIt">Ruangan Can't be empty!</label></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2" for="lantai">Lantai <span class='text-red'>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control required" placeholder="Lantai" id="lantai<?= $no ?>" name="ruang[<?= $no ?>][lantai]">
                                    <label class="label label-danger lantai<?= $no ?> hideIt">Lantai Can't be empty!</label></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2" for="jendela">Jendela <span class='text-red'>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control required" placeholder="Jendela" id="jendela<?= $no ?>" name="ruang[<?= $no ?>][jendela]">
                                    <label class="label label-danger jendela<?= $no ?> hideIt">Jendela Can't be empty!</label></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2" for="lebar">Lebar <span class='text-red'>*</span></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control required lebar" data-id="<?= $no ?>" placeholder="0" id="lebar<?= $no ?>" name="ruang[<?= $no ?>][lebar]">
                                        <span class="input-group-addon">cm</span>
                                    </div>
                                    <label class="label label-danger lebar<?= $no ?> hideIt">Lebar Can't be empty!</label></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2" for="tinggi">Tinggi <span class='text-red'>*</span></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control required tinggi" placeholder="0" data-id="<?= $no ?>" id="tinggi<?= $no ?>" name="ruang[<?= $no ?>][tinggi]">
                                        <span class="input-group-addon">cm</span>
                                    </div>
                                    <label class="label label-danger tinggi<?= $no ?> hideIt">Tinggi Can't be empty!</label></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2" for="tinggi">Qty Unit <span class='text-red'>*</span></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control required qty_unit" placeholder="0" data-id="<?= $no ?>" id="qty_unit<?= $no ?>" name="ruang[<?= $no ?>][qty_unit]">
                                        <span class="input-group-addon">pcs</span>
                                    </div>
                                    <label class="label label-danger qty_unit<?= $no ?> hideIt">Qty Unit Can't be empty!</label></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2">Installation <span class='text-red'>*</span></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label style="padding-left:20px"><input type="radio" class="required" name="ruang[<?= $no ?>][installation]" value="no"><span style="margin-left:5px">No</span></label>
                                        <label style="margin-left:20px"><input type="radio" checked class="required" name="ruang[<?= $no ?>][installation]" value="yes"><span style="margin-left:5px">Yes</span></label>
                                        <label class="label label-danger ruang[<?= $no ?>][installation] hideIt">Installation Can't be empty!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-offset-1">
                            <!-- <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class=" for="upload">Upload Gambar</label>
                                    <input type="file" id="upload_<?= $no ?>" name="uplaod_gambar_[<?= $no ?>][]">
                                </div>
                            </div>
                            <img src="" alt="gamabar" id="gmbr_[<?= $no ?>][]">
                        </div> -->
                        </div>
                    </div>
                    <hr>
                    <!-- DETAIL -->

                    <div class="box box-primary curtain-box<?= $no ?> collapsed-box">
                        <div class="box-header with-border">
                            <div class="material-switch curtain-switch<?= $no ?>">
                                <input class="switch-curtain" data-id="<?= $no ?>" id="switch-curtain<?= $no ?>" name="switch-curtain" type="checkbox" />
                                <label for="switch-curtain<?= $no ?>" data-id="<?= $no ?>" class="label-primary"></label>
                                <h3 class="box-title">Curtain</h3>
                            </div>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-sm btn-info" data-widget="collapse">Hide</i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="box-curtain<?= $no ?>"></div>
                        </div>
                    </div>

                    <div class="box box-info lining-box<?= $no ?> collapsed-box">
                        <div class="box-header with-border">
                            <div class="material-switch lining-switch<?= $no ?>">
                                <input class="switch-lining" data-id="<?= $no ?>" id="switch-lining<?= $no ?>" name="switch-lining" type="checkbox" />
                                <label for="switch-lining<?= $no ?>" data-id="<?= $no ?>" class="label-info"></label>
                                <h3 class="box-title">Lining</h3>
                            </div>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-sm btn-info" data-widget="collapse">Hide</i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="box-lining<?= $no ?>">
                            </div>
                        </div>
                    </div>

                    <div class="box box-warning vitrage-box<?= $no ?> collapsed-box">
                        <div class="box-header with-border">
                            <div class="material-switch vitrage-switch<?= $no ?>">
                                <input class="switch-vitrage" data-id="<?= $no ?>" id="switch-vitrage<?= $no ?>" name="switch-vitrage" type="checkbox" />
                                <label for="switch-vitrage<?= $no ?>" data-id="<?= $no ?>" class="label-warning"></label>
                                <h3 class="box-title">Vitrage</h3>
                            </div>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-sm btn-info" data-widget="collapse">Hide</i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="box-vitrage<?= $no ?>">

                            </div>
                        </div>

                    </div>

                    <div class="box box-danger accessories-box<?= $no ?> collapsed-box">
                        <div class="box-header with-border">
                            <div class="material-switch accessories-switch<?= $no ?>">
                                <input class="switch-accessories" data-id="<?= $no ?>" id="switch-accessories<?= $no ?>" name="switch-accessories" type="checkbox" />
                                <label for="switch-accessories<?= $no ?>" data-id="<?= $no ?>" class="label-danger"></label>
                                <h3 class="box-title">Accessories</h3>
                            </div>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-sm btn-info" data-widget="collapse">Hide</i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="box-accessories<?= $no ?>">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>


<script>
    $(document).on('click', '.show-hide-btn', function() {
        if ($(this).text() == 'Hide') {
            $(this).text('Show')
        } else {
            $(this).text('Hide')
        }
    });

    $('#dtFee').DataTable({
        "paging": false,
        "searching": false,
        "lengthChange": false,
        "ordering": false,
        "info": false

    });

    function detail(no) {
        if (no != '') {

            id_ruangan = $('#id_ruangan' + no).val();
            id_quotation = $('#id_qtt').val();
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'addCurtain',
                data: {
                    'no': no,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    $(".box-curtain" + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        width: '100%',
                        dropdownParent: $("#form-quotation")
                    });
                    $('.curtain-box' + no).removeClass('collapsed-box');
                    lebarKain = $('#lebar_kain' + no).val() || 0;
                    dataType = 'panel-curtain';
                    if ($("input[type='radio'].pilihJahitan").is(':checked')) {
                        var type = $("input[type='radio'].pilihJahitan:checked").val();
                    }
                    if ($("input[type='radio'].pilihRail").is(':checked')) {
                        var type_rail = $("input[type='radio'].pilihRail:checked").val();
                    }
                    // var type_rail = 'yes';
                    changeJahit(type, no);
                    changedt_panel(no, lebarKain, dataType);
                    changeRail(no, type_rail)

                }
            })
        } else {
            $(".box-curtain" + no).html('');
            $('.curtain-box' + no).addClass('collapsed-box');
        }

    }

    function detailLining(no) {
        if (no != '') {

            id_ruangan = $('#id_ruangan' + no).val();
            id_quotation = $('#id_qtt').val();
            // alert(id_ruangan)
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'addLining',
                data: {
                    'no': no,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    $(".box-lining" + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        width: '100%',
                        dropdownParent: $("#form-quotation")
                    });
                    $('.lining-box' + no).removeClass('collapsed-box');
                    lebarKain = $('#lebar_kain-lining' + no).val() || 0;
                    dataType = 'panel-lining';
                    if ($("input[type='radio'].pilihJahitan-lining").is(':checked')) {
                        var type = $("input[type='radio'].pilihJahitan-lining:checked").val();
                    }
                    if ($("input[type='radio'].pilihRail-lining").is(':checked')) {
                        var type_rail = $("input[type='radio'].pilihRail-lining:checked").val();
                    }
                    // var type_rail = 'yes';
                    changeJahitLining(type, no);
                    changedt_panel(no, lebarKain, dataType);
                    changeRailLining(no, type_rail)

                }
            })
        } else {
            $(".box-lining" + no).html('');
            $('.lining-box' + no).addClass('collapsed-box');
        }

    }

    function detailVitrage(no) {
        if (no != '') {

            id_ruangan = $('#id_ruangan' + no).val();
            // alert(id_ruangan)
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'addVitrage',
                data: {
                    'no': no,
                    'id_ruangan': id_ruangan
                },
                success: function(result) {
                    $(".box-vitrage" + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        width: '100%',
                        // dropdownParent: $("#form-quotation")
                    });
                    $('.vitrage-box' + no).removeClass('collapsed-box');
                    lebarKain = $('#lebar_kain-vitrage' + no).val() || 0;
                    dataType = 'panel-vitrage';
                    if ($("input[type='radio'].pilihJahitan-vitrage").is(':checked')) {
                        var type = $("input[type='radio'].pilihJahitan-vitrage:checked").val();
                    }
                    if ($("input[type='radio'].pilihRail-vitrage").is(':checked')) {
                        var type_rail = $("input[type='radio'].pilihRail-vitrage:checked").val();
                    }
                    // var type_rail = 'yes';
                    changeJahitVitrage(type, no);
                    changedt_panel(no, lebarKain, dataType);
                    changeRailVitrage(no, type_rail)

                }
            })
        } else {
            $(".box-vitrage" + no).html('');
            $('.vitrage-box' + no).addClass('collapsed-box');
        }

    }

    function detailAcc(no) {
        var id_quotation = $('#id_qtt').val();
        if (no != '') {
            // alert(no);
            id_ruangan = $('#id_ruangan' + no).val();
            // alert(id_ruangan)
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'addaccessories',
                data: {
                    'no': no,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    $(".box-accessories" + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        width: '100%',
                        dropdownParent: $("#form-quotation")
                    });
                    $('.accessories-box' + no).removeClass('collapsed-box');
                }
            })
        } else {
            $(".box-vitrage" + no).html('');
            $('.accessories-box' + no).addClass('collapsed-box');
        }

    }
    // curtain
    $(function() {
        if ('<?= $fabrics_curtain ?>' != '') {
            var selector = "ruang";
            var selectorCount = 0;

            // alert(selectorCount)
            $('.switch-curtain:checkbox:checked').each(function() {
                selectorCount++;
                detail(selectorCount)
            });
            // getSewing(no);
        }

        // lining
        if ('<?= $fabrics_lining ?>' != '') {
            var selector = "ruang";
            var selectorCount = 0;

            // alert(selectorCount)
            $('.switch-lining:checkbox:checked').each(function() {
                selectorCount++;
                detailLining(selectorCount)
            });

        }

        // vitrage
        if ('<?= $fabrics_vitrage ?>' != '') {
            var selector = "ruang";
            var selectorCount = 0;

            // alert(selectorCount)
            $('.switch-vitrage:checkbox:checked').each(function() {
                selectorCount++;
                detailVitrage(selectorCount)
            });
        }

        // asscessories
        if ('<?= $accessories ?>' != '') {
            // alert('data_muncul');
            var selector = "ruang";
            var selectorCount = 0;

            // alert(selectorCount)
            $('.switch-accessories:checkbox:checked').each(function() {
                selectorCount++;
                detailAcc(selectorCount)
            });

        }
    })

    $(document).on('change', '.switch-curtain', function() {
        var no = $(this).data('id');
        if ($('div.curtain-switch' + no + ' input[type="checkbox"]').is(":checked")) {
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addCurtain',
                    data: {
                        'no': no
                    },
                    success: function(result) {
                        $(".box-curtain" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: $("#form-quotation")
                        });
                        getProduk(no);
                        getSewing(no);
                        $('.curtain-box' + no).removeClass('collapsed-box');
                    }
                })
            }, 200);
        } else {
            $(".box-curtain" + no).html('');
            $('.curtain-box' + no).addClass('collapsed-box');
        }

    })

    function changeSwitch(no) {
        if ($('div.curtain-switch' + no + ' input[type="checkbox"]').is(":checked")) {
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addCurtain',
                    data: {
                        'no': no
                    },
                    success: function(result) {
                        $(".box-curtain" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: $("#form-quotation")
                        });
                        getProduk(no);
                        getSewing(no);
                        $('.curtain-box' + no).removeClass('collapsed-box');
                    }
                })
            }, 200);
        } else {
            $(".box-curtain" + no).html('');
            $('.curtain-box' + no).addClass('collapsed-box');
        }
    }

    function getSewing(no) {
        // if ($('#dt_jns_jahit' + no).data('jht') != '') {
        //     var id_selected = $('#dt_jns_jahit' + no).data('jht');
        // } else {
        //     var id_selected = '';
        // }
        // alert(no);
        var column = 'id_sewing';
        var column_fill = '';
        var column_name = 'item';
        var table_name = 'sewing';
        var key = 'id_sewing';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                // id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {

                $('#jahitan' + no).html(result.html);
                // console.log(no);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });

    }

    function getProduk(no) {

        if ('<?= $fabrics_curtain->id_product ?>' != '') {
            var id_selected = '<?= $fabrics_curtain->id_product ?>';
        } else {
            var id_selected = '';
        }
        // alert(no)
        // console.log(id_selected);
        var column = 'activation';
        var column_fill = 'aktif';
        var filter_column = 'status';
        var filter_val = '1';
        var search_column = 'usages';
        var search_value = 'curtain';
        var column_name = 'name_product';
        var table_name = 'pricelist_fabric_view';
        var key = 'id_product';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                filter_column: filter_column,
                filter_val: filter_val,
                search_column: search_column,
                search_value: search_value,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {
                $('#product_curtain' + no).html(result.html);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });
    }

    function getRailCurtain(no) {
        if ('<?= $fabrics_curtain->rail_material ?>' != null) {
            var id_selected = '<?= $fabrics_curtain->rail_material ?>';
            // }else if ($('#id_produk_curtain<?= $no ?>').val() != null || $('#id_produk_curtain<?= $no ?>').val() != '') {
            // var id_selected = $('#id_produk_curtain<?= $no ?>').val();
        } else {
            var id_selected = '';
        }
        //console.log(id_selected);
        var column = 'activation';
        var column_fill = 'aktif';
        var column_name = 'name_product';
        var table_name = 'mp_rail';
        var key = 'id_rail';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {
                $('#rail_material' + no).html(result.html);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });

    }

    // INPUT DISKON FABRIC //
    //=====================//

    function disc_fab(no) {
        let t_harga_kain = $('#total_harga_kain' + no).val().replace(/,/g, '') || 0;
        t_disk = (parseInt(t_harga_kain) * (parseInt(disc_fab))) / 100;
        harga_aft_disc = parseInt(t_harga_kain) - parseInt(t_disk);
        $('#harga_aft_disc' + no).val(('' + harga_aft_disc).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
    }

    $(document).on('keyup paste change', '.disc_fab', function() {
        let no = $(this).data('id');
        let t_harga_kain = $('#total_harga_kain' + no).val().replace(/,/g, '') || 0;
        let disc_fab = $(this).val() || 0;
        let val = countDisc(no);
        if (val == false) {
            $(this).val('0');
            $('#t_disc_fab' + no).val('0');
        } else {
            t_disk = (parseInt(t_harga_kain) * (parseInt(disc_fab))) / 100;
            $('#t_disc_fab' + no).val(('' + t_disk).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            harga_aft_disc = parseInt(t_harga_kain) - parseInt(t_disk);
            $('#harga_aft_disc' + no).val(('' + harga_aft_disc).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

        let persen = 0;
        $('.persen').each(function() {
            persen += Number($('.persen').val());
        })
        $('#fee_pic' + no).val(persen);

        disc = $('.persen').val() || 0;
        id = $('.persen').data("id");

        dis_fab = (parseInt(t_harga_kain) * (parseInt(disc_fab))) / 100;
        if (dis_fab == '') {
            t_disk = (parseInt(t_harga_kain));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(t_harga_kain) - (parseInt(dis_fab)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }
        if (val == false) {
            $('table#ComCurtain' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#ComCurtain' + no).find('input#value_' + id).val(('' + val_disc).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

    })


    $(document).on('keyup paste change', '.diskon_rail', function() {
        let no = $(this).data('id');
        diskon_rail_curtain(no);
        total_rail(no);

    })

    function diskon_rail_curtain(no) {
        let t_price_rail = $('#t_price_rail' + no).val().replace(/,/g, '') || 0;
        let subtotal_rail = $('#subtotal_rail' + no).val().replace(/,/g, '') || 0;
        let diskon_rail = $('#diskon_rail' + no).val() || 0;

        let val = countDiscRail(no);
        if (val == false) {
            $('#diskon_rail' + no).val('0');
            $('#v_diskon_rail' + no).val('0');
        } else {
            // alert('total fee adalah : ');
            t_disk = (parseInt(subtotal_rail) * (parseInt(diskon_rail))) / 100;
            $('#v_diskon_rail' + no).val(('' + t_disk.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

        }

        let persen = 0;
        $('.persen_rail').each(function() {
            persen += Number($('.persen_rail').val());
        })
        $('#fee_rail_curtain' + no).val(persen);


        disc = $('.persen_rail').val() || 0;
        id = $('.persen_rail').data("id");

        dis_rail = (parseInt(subtotal_rail) * (parseInt(diskon_rail))) / 100;
        if (dis_rail == '') {
            t_disk = (parseInt(subtotal_rail));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(subtotal_rail) - (parseInt(dis_rail)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        if (val == false) {
            // $(this).val('0');
            $('table#extComm_rail' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#extComm_rail' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

    }

    // RUMUS DISKON MAINTENANCE //
    //--------------------------//

    $(document).on('change', '.pilihMainten', function() {
        let no = $(this).data('id');
        mode = $(this).val();
        harga_aft_disc = $('#harga_aft_disc' + no).val().replace(/,/g, '') || 0;
        diskon_fab = $('#disc_fab' + no).val() || 0;

        if (mode == 'yes') {
            $('#disc_mnt' + no).val('5');
        } else {
            $('#disc_mnt' + no).val('0');
        }

        let diskon_mnt = $('#disc_mnt' + no).val();
        let val = countDisc(no);
        // alert(diskon_mnt)
        if (val == false) {
            $('#disc_mnt' + no).val('0');
            $('#no_' + no).prop('checked', true);
        } else {
            // dis_fab = (parseInt(harga_aft_disc) * parseInt(diskon_fab)) / 100;
            // afterDiscFab = parseInt(harga_aft_disc) - parseInt(dis_fab);
            dis_mnt = (parseInt(harga_aft_disc) * parseInt(diskon_mnt)) / 100;
            $('#disc_mnt_val' + no).val(dis_mnt);
            // console.log(dis_mnt);

        }

    })

    // DISKON FEE PIC //
    //===============//
    // curtain
    $(document).on('change', '.persen', function() {
        let no = $(this).parents('table').data('id');
        let disc_fab = $('#disc_fab' + no).val() || 0;
        let t_harga_kain = $('#total_harga_kain' + no).val().replace(/,/g, '') || 0;

        let persen = 0;
        $('.persen').each(function() {
            persen += Number($(this).val());
        })
        $('#fee_pic' + no).val(persen);
        let fee_pic = $('#fee_pic' + no).val() || 0;

        disc = $(this).val() || 0;
        id = $(this).data("id");

        dis_fab = (parseInt(t_harga_kain) * (parseInt(disc_fab))) / 100;
        if (dis_fab == '') {
            t_disk = (parseInt(t_harga_kain));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(t_harga_kain) - (parseInt(dis_fab)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        let val = countDisc(no);
        if (val == false) {
            $(this).val('0');
            $('table#ComCurtain' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#ComCurtain' + no).find('input#value_' + id).val(('' + Math.ceil(val_disc)).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }
    })

    $(document).on('change', '.value', function() {
        let no = $(this).parents('table').data('id');
        let disc_fab = $('#disc_fab' + no).val() || 0;
        let t_harga_kain = $('#total_harga_kain' + no).val().replace(/,/g, '') || 0;
        let disMnt = $('#disc_mnt' + no).val() || 0;

        id = $(this).data("id");
        disc = $(this).val().replace(/,/g, '');

        dis_fab = (parseInt(t_harga_kain) * (parseInt(disc_fab))) / 100;
        if (dis_fab == 0) {
            t_disk = (parseInt(t_harga_kain));
            val_disc = (parseInt(disc) / (parseInt(t_disk)) * 100);

        } else {
            t_disk = (parseInt(t_harga_kain) - (parseInt(dis_fab)));
            val_disc = (parseInt(disc) / (parseInt(t_disk)) * 100);
        }

        let val = countDisc(no);
        if (val == false) {
            $(this).val('0');
            $('table#ComCurtain' + no).find('input#persen_' + id).val('0');
        } else {
            $('table#ComCurtain' + no).find('input#persen_' + id).val(Math.ceil(val_disc));
            let persen = 0;
            $('.persen').each(function() {
                persen += Number($('.persen').val() || 0);
            })
            $('#fee_pic' + no).val(persen);
            sumDisk = parseInt(disc_fab) + parseInt(disMnt) + parseInt(persen);
            $('#curtain_disk' + no).val(sumDisk);
        }
    })

    // rail//
    $(document).on('change', '.persen_rail', function() {
        let no = $(this).parents('table').data('id');
        let diskon_rail = $('#diskon_rail' + no).val() || 0;
        let subtotal_rail = $('#subtotal_rail' + no).val().replace(/,/g, '') || 0;

        let persen = 0;
        $('.persen_rail').each(function() {
            persen += Number($(this).val());
        })
        $('#fee_rail_curtain' + no).val(persen);

        disc = $(this).val();
        id = $(this).data("id");

        dis_rail = (parseInt(subtotal_rail) * (parseInt(diskon_rail))) / 100;
        if (dis_rail == '') {
            t_disk = (parseInt(subtotal_rail));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(subtotal_rail) - (parseInt(dis_rail)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        let val = countDiscRail(no);
        if (val == false) {
            $(this).val('0');
            $('table#extComm_rail' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#extComm_rail' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }
    })

    $(document).on('change', '.value_rail', function() {
        let no = $(this).parents('table').data('id');
        let diskon_rail = $('#diskon_rail' + no).val() || 0;
        let subtotal_rail = $('#subtotal_rail' + no).val().replace(/,/g, '') || 0;
        id = $(this).data("id");
        disc = $(this).val().replace(/,/g, '') || 0;
        dis_rail = (parseInt(subtotal_rail) * (parseInt(diskon_rail))) / 100;
        if (dis_rail == '') {
            t_disk = (parseInt(subtotal_rail));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        } else {
            t_disk = (parseInt(subtotal_rail) - (parseInt(dis_rail)));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        }

        let val = countDiscRail(no);
        if (val == false) {
            $(this).val('0');
            $('table#extComm_rail' + no).find('input#persen_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#extComm_rail' + no).find('input#persen_' + id).val(Math.ceil(val_disc));
            let persen = 0;
            $('.persen_rail').each(function() {
                persen += Number($('.persen_rail').val() || 0);
            })
            // console.log(persen)
            $('#extComm_rail_sum' + no).val(persen);
        }
        // let fee_pic = $('#fee_pic' + no).val() || 0;
    })

    // HASIL DISKON
    // =======================//
    function countDisc(no) {
        let disk = $('#disc_cat').val();
        let disk2 = disk.replace(/%/g, '');
        let disc_fab = $('#disc_fab' + no).val() || 0;
        let disMnt = $('#disc_mnt' + no).val() || 0;
        let fee_pic = $('#fee_pic' + no).val() || 0;

        sumDisk = parseInt(disc_fab) + parseInt(disMnt) + parseInt(fee_pic);
        // $('#act_disk').val(sumDisk);
        $('#curtain_disk' + no).val(sumDisk);
        if ($('#product_curtain' + no).val() == '' || $('#product_curtain' + no).val() == null) {
            alert('Pilih bahan curtain terlebih dahulu!');
            return false;
        } else if (disk2 == 0 || disk2 == '') {
            alert('Discount Category tidak boleh 0.');
            return false;
        } else if (parseInt(sumDisk) > parseInt(disk2)) {
            alert('Diskon melebihi batas.');
            return false;
        } else {
            return true;
        }
    }

    function countDiscRail(no) {
        let disk = $('#disc_cat').val();
        let disk2 = disk.replace(/%/g, '');
        let fee_pic = $('#fee_rail_curtain' + no).val() || 0;
        let diskon_rail = $('#diskon_rail' + no).val() || 0;

        sumDisk = parseInt(diskon_rail) + parseInt(fee_pic);
        $('#diskon_rail-curtain' + no).val(sumDisk);
        if ($('#rail_material' + no).val() == '' || $('#rail_material' + no).val() == null) {
            alert('Pilih material rail terlebih dahulu!');
            return false;
        } else if (disk2 == 0 || disk2 == '') {
            alert('Discount Category tidak boleh 0.');
            return false;
        } else if (parseInt(sumDisk) > parseInt(disk2)) {
            alert('Diskon melebihi batas.');
            return false;
        } else {
            return true;
        }
    }

    // PRODUCT CURTAIN //
    //=====================//

    $(document).on('change', '.product_curtain', function() {
        var no = $(this).data('id');
        var qty_unit = $('#qty_unit' + no).val() || 0;
        var product = $(this).val();
        changeCurtain(no, product, qty_unit);

    })

    function changeCurtain(no, product, qty_unit) {
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataProduct',
            data: {
                'product': product
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result['product']);
                if (result['product'] == '' || result['product'] == null) {
                    $('#lebar_kain' + no).val('');
                    $('#harga_kain' + no).val('');
                    $('#t_harga_kain' + no).val('');
                    $('#t_disc_fab' + no).val('');
                    $('#cust_curtain_name' + no).val('');
                    let harga_kain = 0;
                } else {
                    if (qty_unit == '' || qty_unit == 0) {
                        alert('Qty Unit tidak boleh kosong!');
                        $(this).text('');
                        $(this).val('');
                        return false;
                    } else {
                        total_hrg_kain = parseInt(result['product'].price) * parseInt(qty_unit);
                        $('#lebar_kain' + no).val(result['product'].width);
                        $('#harga_kain' + no).val(result['product'].price);
                        $('#t_harga_kain' + no).val(("" + total_hrg_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
                        $('#cust_curtain_name' + no).val(result['product'].name_product);
                        let harga_kain = total_hrg_kain;
                        let disc_fab = $('#disc_fab' + no).val() || 0;
                        let val = countDisc(no);
                        if (val == false) {
                            $('#t_disc_fab' + no).val('0');
                        } else {
                            t_disk = (parseInt(harga_kain) * (parseInt(disc_fab))) / 100;
                            $('#t_disc_fab' + no).val(('' + t_disk).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
                        }
                        lebarKain = $('#lebar_kain' + no).val() || 0;
                        dataType = 'panel-curtain';
                        // changedt_panel(no, lebarKain);
                        rumus_panel(no);

                    }

                }
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        })
    }
    // DATA DETAIL //
    //=============//

    $(document).on('change', '.dt_panel', function(e) {
        e.preventDefault()
        var no = $(this).data('id');
        dataType = $(this).data('type');
        type = $(this).val();
        id_quotation = $('#id_qtt').val();
        id_product = $('#product_curtain' + no).val();
        id_ruangan = $('#id_ruangan' + no).val();
        lbrKainCurtain = $('#lebar_kain' + no).val() || 0;
        lbrKainLining = $('#lebar_kain-lining' + no).val() || 0;
        lbrKainVitrage = $('#lebar_kain-vitrage' + no).val() || 0;

        if (dataType == 'panel-curtain') {
            if (lbrKainCurtain == '') {
                alert("Lebar lain Curtain tidak boleh kosong!");
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addDetail',
                    data: {
                        'no': no,
                        'type': type,
                        'dataType': dataType,
                        'id_product': id_product,
                        'id_ruangan': id_ruangan
                        // 'id_quotation': id_quotation
                    },
                    success: function(result) {
                        // console.log(result);
                        $(".data-detail-curtain" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            dropdownParent: $("#form-quotation")
                        });
                    }
                })
            }
        } else if (dataType == 'panel-lining') {
            if (lbrKainLining == '') {
                alert("Lebar lain Lining tidak boleh kosong!");
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addDetail',
                    data: {
                        'no': no,
                        'type': type,
                        'dataType': dataType,
                        'id_product': id_product,
                        'id_ruangan': id_ruangan
                    },
                    success: function(result) {
                        // console.log(result);
                        $(".data-detail-lining" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            dropdownParent: $("#form-quotation")
                        });
                    }
                })
            }
        } else if (dataType == 'panel-vitrage') {
            if (lbrKainVitrage == '') {
                alert("Lebar lain Lining tidak boleh kosong!");
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addDetail',
                    data: {
                        'no': no,
                        'type': type,
                        'dataType': dataType,
                        'id_product': id_product,
                        'id_ruangan': id_ruangan,
                        'id_quotation': id_quotation
                    },
                    success: function(result) {
                        // console.log(result);
                        $(".data-detail-vitrage" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            dropdownParent: $("#form-quotation")
                        });
                    }
                })
            }
        }
    })

    function changedt_panel(no, lebarKain, dataType = '') {
        // alert(dataType)

        id_ruangan = $('#id_ruangan' + no).val();
        id_quotation = $('#id_qtt').val();

        if (dataType == 'panel-curtain') {
            type = $('#panel' + no).val();;
            id_product = $('#product_curtain' + no).val();
            if (lebarKain == '') {
                alert("Lebar lain Curtain tidak boleh kosong!");
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addDetail',
                    data: {
                        'no': no,
                        'type': type,
                        'dataType': dataType,
                        'id_product': id_product,
                        'id_ruangan': id_ruangan,
                        'id_quotation': id_quotation
                    },
                    success: function(result) {
                        // console.log(result);
                        $(".data-detail-curtain" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            dropdownParent: $("#form-quotation")
                        });
                    }
                })
            }
        } else if (dataType == 'panel-lining') {
            type = $('#panel-lining' + no).val();;
            id_product = $('#product_curtain' + no).val();
            if (lebarKain == '') {
                alert("Lebar lain Lining tidak boleh kosong!");
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addDetail',
                    data: {
                        'no': no,
                        'type': type,
                        'dataType': dataType,
                        'id_product': id_product,
                        'id_ruangan': id_ruangan,
                        'id_quotation': id_quotation
                    },
                    success: function(result) {
                        console.log(result);
                        $(".data-detail-lining" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            dropdownParent: $("#form-quotation")
                        });
                    }
                })
            }
        } else if (dataType == 'panel-vitrage') {
            type = $('#panel-vitrage' + no).val();;
            id_product = $('#product_vitrage' + no).val();
            if (lebarKain == '') {
                alert("Lebar lain Vitrage tidak boleh kosong!");
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addDetail',
                    data: {
                        'no': no,
                        'type': type,
                        'dataType': dataType,
                        'id_product': id_product,
                        'id_ruangan': id_ruangan,
                        'id_quotation': id_quotation
                    },
                    success: function(result) {
                        // console.log(result);
                        $(".data-detail-vitrage" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            dropdownParent: $("#form-quotation")
                        });
                    }
                })
            }
        }
    }

    // JAHITAN //
    //----------//

    $(document).on('change', '.jahitan', function() {
        var no = $(this).data('id');
        var id_jahitan = $(this).val();
        var qty_unit = $('#qty_unit' + no).val();
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataJahitan',
            data: {
                'id_jahitan': id_jahitan
            },
            dataType: 'json',
            success: function(result) {
                t_price = parseInt(result['sewing'].price) * parseInt(qty_unit);
                $('#hrg_jahitan' + no).val(('' + t_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
                disc_jahitan_curtain(no);
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        })
    })

    function changeJahitan(no, id_jht) {
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataJahitan',
            data: {
                'id_jahitan': id_jht
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result['sewing']);
                if (result['sewing'] != null) {
                    $('#hrg_jahitan' + no).val(result['sewing'].price.replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));

                }
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        })
    }

    function changeJahitanLining(no, id_jht) {
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataJahitan',
            data: {
                'id_jahitan': id_jht
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result['sewing']);
                if (result['sewing'] != null) {
                    // $('#hrg_jahitan' + no).val(result['sewing'].price.replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
                    $('#hrg_jahitan-lining' + no).val(result['sewing'].price.replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));

                }
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        })
    }

    $(document).on('change', '.pilihJahitan', function() {
        var type = $(this).val();
        var no = $(this).data('id');
        // alert(type)
        changeJahit(type, no);
    })

    function changeJahit(type, no) {
        id_jahitan = $('#dt_jns_jahit' + no).data('jht');
        id_ruangan = $('#id_ruangan' + no).val();
        id_quotation = $('#id_qtt').val();
        // alert(id_jahitan)
        if (type == 'yes') {
            // alert('type=' + no)
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'addJahitCurtain',
                data: {
                    'no': no,
                    'id_jahitan': id_jahitan,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    // console.log(result)
                    $('#dt_jns_jahit' + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        dropdownParent: $("#form-quotation")
                    });
                }
            })
        } else {
            $('#dt_jns_jahit' + no).html('');
        }
    }

    function changeJahitLining(type, no) {
        id_jahitan = $('#dt_jns_jahit-lining' + no).data('jht');
        id_ruangan = $('#id_ruangan' + no).val();
        id_quotation = $('#id_qtt').val();
        if (type == 'yes') {
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'addJahitLining',
                data: {
                    'no': no,
                    'id_jahitan': id_jahitan,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    // console.log(result)
                    $('#dt_jns_jahit-lining' + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        dropdownParent: $("#form-quotation")
                    });
                }
            })
        } else {
            $('#dt_jns_jahit-lining' + no).html('');
        }
    }



    // RAIL CURTAIN //
    //--------------//

    $(document).on('change', '.pilihRail', function() {
        var type = $(this).val();
        var qty_unit = $('#qty_unit' + no).val() || 0;
        var no = $(this).data('id');
        changeRail(no, type)
    });

    function changeRail(no, type) {
        var id_ruangan = $('#id_ruangan' + no).val();
        var id_quotation = $('#id_qtt').val();
        if (type == 'yes') {
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'get_rail_curtain',
                data: {
                    'no': no,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    $("#dt_rail_curtain" + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        dropdownParent: $("#form-quotation")
                    });
                    // getRailCurtain(no);
                }
            })

        } else {
            $('#dt_rail_curtain' + no).html('');
        }
    }

    $(document).on('change', '.rail_material', function() {
        let x = $(this).data('id');
        let id_rail = $(this).val();
        let lebar = $('#lebar' + x).val();
        let qty_unit = $('#qty_unit' + x).val();
        if (qty_unit == '') {
            alert("Qty Unit tidak boleh kosong!");
            return false;
        } else {
            if (lebar == '') {
                alert("Lebar jendela tidak boleh kosong!");
                return false;
            } else {
                $('#width_rail' + x).val(lebar / 100);
                $('#window_width' + x).val(lebar);
                $.ajax({
                    url: siteurl + active_controller + 'get_data_rail',
                    type: "POST",
                    dataType: "json",
                    data: {
                        id_rail: id_rail
                    },
                    success: function(result) {
                        // console.log(result['list'][0].act_selling_price)
                        $('#price_rail' + x).val(result['list'][0].act_selling_price)
                        t_hrga_rail = ((parseInt(result['list'][0].act_selling_price) * parseInt(lebar)) / 100) * parseInt(qty_unit);
                        $('#t_price_rail' + x).val(("" + t_hrga_rail).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
                        $('#cust_rail_name' + x).val(result['list'][0].name_product);

                        overlap_curtain(x);
                        getBasicComponent(id_rail, x);
                        getAdditionalComponent(id_rail, x);
                        subtotal_rail(x);
                        diskon_rail_curtain(x);
                        total_rail(x);
                    },
                    error: function() {
                        alert("Ajax Error..!!")
                    }
                })
            }
        }
    });

    function getBasicComponent(id_rail, x) {
        let width_rail = parseFloat($('#width_rail' + x).val() || 0);
        // let qty = 0;
        $.ajax({
            url: siteurl + active_controller + 'get_baic_component',
            type: "POST",
            dataType: "json",
            data: {
                id_rail: id_rail,
                width_rail: width_rail
            },
            success: function(result) {
                data = result['list']
                $('#basic_component' + x + ' tbody tr').remove();
                for (var i = 0; i < data.length; i++) {
                    table =
                        '<tr>' +
                        '<td>' + data[i].name_component +
                        '<input type="hidden" name="bc_comp[' + x + '][' + i + '][id_rail_basic]" data-id="' + data[i].id_rail_basic + '" value="' + data[i].id_rail_basic + '" >' +
                        '</td>' +
                        '<td>' + data[i].qty +
                        '<input type="hidden" style="width:100%" name="bc_comp[' + x + '][' + i + '][qty]" value="' + data[i].qty + '" class="form-control text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                        '</td>' +
                        '<td>' + data[i].uom +
                        '<input type="hidden" style="width:100%" name="bc_comp[' + x + '][' + i + '][uom]" value="' + data[i].uom + '" class="form-control text-right" placeholder="0">' +
                        '</td>' +
                        '</tr>';
                    $('#basic_component' + x + ' tbody').append(table);
                };
            }
        })
    }

    function getAdditionalComponent(id_rail, x) {
        $.ajax({
            url: siteurl + active_controller + 'get_additional_component',
            type: "POST",
            dataType: "json",
            data: {
                id_rail: id_rail,
            },
            success: function(result) {
                data = result['list']
                // console.log(data.length)
                // $('#additional_comp_rail' + x + ' tbody tr').remove();
                // // console.log(result)
                // for (var i = 0; i < data.length; i++) {
                //     table =
                //         '<tr>' +
                //         '<td>' + data[i].name_component +
                //         '<input type="hidden" name="addt_comp[' + x + '][' + i + '][id_comp]" data-id="' + data[i].id_rail_add + '" value="' + data[i].id_rail_add + '" >' +
                //         '</td>' +
                //         '<td>' +
                //         '<input type="number" style="width:100%" name="addt_comp[' + x + '][' + i + '][qty]" data-id="' + data[i].id_rail_add + '" id="qty_' + data[i].id_rail_add + '" class="qty_add_comp form-control numberOnly required text-right" placeholder="0" min="0" max="100">' +
                //         '</td>' +
                //         '<td>' + data[i].uom +
                //         '<input type="hidden" style="width:100%" name="addt_comp[' + x + '][' + i + '][uom]" value="' + data[i].uom + '" id="uom_' + data[i].id_rail_add + '" class="form-control text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' + ('' + data[i].selling_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',') +
                //         '<input type="hidden" style="width:100%" name="addt_comp[' + x + '][' + i + '][price]" value="' + data[i].selling_price + '"  id="price_' + data[i].id_rail_add + '" class="form-control input-sm numberOnly nominal value text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' +
                //         '<input type="text" readonly style="width:100%" name="addt_comp[' + x + '][' + i + '][t_price]" id="t_price_' + data[i].id_rail_add + '" class="form-control text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' +
                //         '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                //         '</td>' +
                //         '</tr>';
                //     $('#additional_comp_rail' + x + ' tbody').append(table);
                // };
            }
        })
    }

    $(document).on('change input', '.qty_add_comp', function() {
        let id = $(this).data('id');
        let no = $(this).parents('table').data('id');
        let qty = parseInt($(this).val());
        let price = parseInt($('#price_' + id).val().replace(/'/g, '') || 0);

        let t_price = qty * price;
        $('table#additional_comp_rail' + no).find('input#t_price_' + id).val(('' + t_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

        var total_add_comp = 0;
        $('.t_price_add_comp').each(function() {
            total_add_comp += Number($(this).val().replace(/,/g, '') || 0);
        })
        $('#total_add_comp_rail' + no).val(('' + total_add_comp).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        subtotal_rail(no);
        diskon_rail_curtain(no);
        total_rail(no);
    })


    // RUMUS PANEL //
    //-------------//
    // ovlKiri, ovlTengah, jh, jv, lebar, lbrKain, fullness
    $(document).on('keyup paste change', '.lebar', function() {
        var no = $(this).data('id');
        lebar = $('#lebar' + no).val() || 0;
        rumus_panel(no);
        rumus_panel_lining(no);
    })

    $(document).on('keyup paste change', '.ovl_kiri,.ovl_tengah,.jahit_h,.jahit_v,.fullness', function() {
        var no = $(this).data('id');
        qty_unit = $('#qty_unit' + no).val() || 0;
        lebar = $('#lebar' + no).val() || 0;

        if (lebar == '' || lebar == 0) {
            alert('Lebar Jendela tidak boleh kosong!');
            $(this).val('');
            return false;
        } else {
            if (qty_unit == '' || qty_unit == 0) {
                alert('Qty Unit tidak boleh kosong!');
                $(this).val('');
                return false;
            } else {
                rumus_panel(no);
            }
            // total_kain(no);
        }
    })

    function rumus_panel(no) {
        type = $('#type' + no).data('type');
        lebar = $('#lebar' + no).val() || 0;
        ovlKiri = $('#ovl_kiri' + no).val() || 0;
        ovlTengah = $('#ovl_tengah' + no).val() || 0;
        jh = $('#jahit_h' + no).val() || 0;
        lbrKain = $('#lebar_kain' + no).val() || 0;
        fullness = $('#fullness' + no).val() || 0;
        // console.log(no)
        if (type == 'panel') {
            let jml_panel = (parseInt(lebar) + parseInt(ovlKiri) +
                parseInt(ovlTengah) + parseInt(jh)) / parseInt(lbrKain) * (parseInt(fullness) / 100);
            // console.log(jml_panel)
            $('#rumus_panel' + no).val(jml_panel.toFixed(3));
            total_kain(no);
        } else {
            total_kain(no);
        }
    }

    // QTY UNIT CHANGE //
    //=====================//
    $(document).on('change keyup paste', '.tinggi,.qty_unit,.vertikal_repeat', function() {
        var no = $(this).data('id');
        total_kain(no);
        total_kain_lining(no);
        total_kain_vitrage(no);
        disc_fab(no);
    })

    $(document).on('change keyup paste', '.r_up_panel', function() {
        var no = $(this).data('id');
        qty_unit = $('#qty_unit' + no).val() || 0;

        if (qty_unit == '' || qty_unit == 0) {
            alert('Qty Unit tidak boleh kosong!');
            return false;
        } else {
            total_kain(no);
            disc_fab(no);
        }
    })

    $(document).on('change keyup paste', '.r_up_panel-lining', function() {
        var no = $(this).data('id');
        qty_unit = $('#qty_unit' + no).val() || 0;

        // alert($(this).val())
        if (qty_unit == '' || qty_unit == 0) {
            alert('Qty Unit tidak boleh kosong!');
            return false;
        } else {
            total_kain_lining(no);
        }
    })
    $(document).on('change keyup paste', '.r_up_panel-vitrage', function() {
        var no = $(this).data('id');
        qty_unit = $('#qty_unit' + no).val() || 0;

        if (qty_unit == '' || qty_unit == 0) {
            alert('Qty Unit tidak boleh kosong!');
            return false;
        } else {
            total_kain_vitrage(no);
        }
    })

    function total_kain(no) {
        type = $('#type' + no).data('type');
        lebar = $('#lebar' + no).val() || 0;
        ovlKiri = $('#ovl_kiri' + no).val() || 0;
        ovlTengah = $('#ovl_tengah' + no).val() || 0;
        jh = $('#jahit_h' + no).val() || 0;
        jv = $('#jahit_v' + no).val() || 0;
        vr = $('#vertikal_repeat' + no).val() || 0;
        fullness = $('#fullness' + no).val() || 0;
        tinggi = $('#tinggi' + no).val() || 0;
        roundUp = $('#r_up_panel' + no).val() || 0;
        qty_unit = $('#qty_unit' + no).val() || 0;
        if (type == 'panel') {
            console.log(roundUp + "," + tinggi + "," + jv + "," + vr + "," + vr);
            // let total_kain = (parseInt(roundUp) * ((parseInt(tinggi) + parseInt(jv)) / 100) * parseInt(qty_unit));
            let total_kain = (parseInt(roundUp) * (Math.ceil((parseInt(tinggi) + parseInt(jv)) / parseFloat(vr)) * (parseFloat(vr) / 100)) * parseInt(qty_unit));
            $('#t_kain' + no).val(total_kain.toFixed(2));
            let t_harga_kain = $('#t_harga_kain' + no).val().replace(/,/g, '') || 0;
            total_harga_kain = total_kain.toFixed(2) * parseFloat(t_harga_kain);
            // console.log(total_harga_kain);
            $('#total_harga_kain' + no).val(('' + total_harga_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        } else {
            jmlKain = (((parseInt(lebar) + parseInt(ovlKiri) + parseInt(ovlTengah) + parseInt(jh)) * (parseInt(fullness) / 100)) / 100) * (parseInt(qty_unit));
            $('#t_kain' + no).val(jmlKain.toFixed(1));
            let t_harga_kain = $('#t_harga_kain' + no).val() || 0;
            // console.log(t_harga_kain)
            if (t_harga_kain != 0) {
                total_harga_kain = jmlKain.toFixed(1) * parseInt(t_harga_kain.replace(/,/g, ''));
                $('#total_harga_kain' + no).val(('' + total_harga_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            }
        }
    }

    // POP UP ADD DATA
    // -----------------------------
    $(document).on('click', '.addData', function() {
        let x = $(this).data('id');
        let dataType = $(this).data('type');
        let prodType = $(this).data("product");
        let type = $("#type" + x).data("type");
        let bahan = $('#product_curtain' + x).val();
        let rail = $('#rail_material' + x).val();
        let rail_lining = $('#rail_material-lining' + x).val();
        let lining = $('#product_lining' + x).val();
        let rail_vitrage = $('#rail_material-vitrage' + x).val();
        let vitrage = $('#product_vitrage' + x).val();
        let id_cust = $('#id_cust').val();
        if (dataType == 'bookRoll') {
            if (prodType == 'curtain') {
                if (bahan == '') {
                    alert('Data Bahan tidak boleh kosong!');
                    return false;
                } else {
                    dataUrl = siteurl + 'quotation_proses/addBook';
                }
            } else if (prodType == 'lining') {
                if (lining == '') {
                    alert('Data Bahan Lining tidak boleh kosong!');
                    return false;
                } else {
                    dataUrl = siteurl + 'quotation_proses/addBookLining';
                }
            } else if (prodType == 'vitrage') {
                if (vitrage == '') {
                    alert('Data Bahan Lining tidak boleh kosong!');
                    return false;
                } else {
                    dataUrl = siteurl + 'quotation_proses/addBookVitrage';
                }
            }
        } else if (dataType == "extCommission") {
            if (id_cust == '') {
                alert('Data Customer tidak boleh kosong!');
                return false;
            } else {
                dataUrl = siteurl + 'quotation_proses/addFee';
            }
        } else if (dataType == "additionalComp") {
            if (prodType == 'curtain') {
                if (rail == '') {
                    alert("Data material rail tidak boleh kosong!");
                    return false;
                } else {
                    dataUrl = siteurl + 'quotation_proses/addComp';
                }
            } else if (prodType == "lining") {
                if (rail_lining == '') {
                    alert("Data material rail tidak boleh kosong!");
                    return false;
                } else {
                    dataUrl = siteurl + 'quotation_proses/addCompLining';
                }
            } else if (prodType == "vitrage") {
                if (rail_vitrage == '') {
                    alert("Data material rail tidak boleh kosong!");
                    return false;
                } else {
                    dataUrl = siteurl + 'quotation_proses/addCompVitrage';
                }
            }
        } else if (dataType == "accessoriess") {
            dataUrl = siteurl + 'quotation_proses/addAcc';
        }

        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: {
                x: x,
                type: type,
                dataType: dataType,
                prodType: prodType,
                bahan: bahan,
                lining: lining,
                rail: rail,
                rail_lining: rail_lining,
                rail_vitrage: rail_vitrage,
                id_cust: id_cust
            },
            success: function(result) {
                $("#ModalView").modal();
                $("#view").html(result);
            }
        })
    });

    function AddData() {
        var list_mentah = $('#input_edit').val();
        var list_arr = list_mentah.split(";");
        let x = $('#counter').val();
        let type = $('#type').val();
        let dataType = $('#dataType').val();
        let prodType = $('#prodType').val();

        if (list_mentah != "") {
            if (dataType == 'bookRoll' && prodType == 'curtain') {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_roll",
                    data: "id_roll=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#dtBook' + x + ' tbody tr').remove();
                        var panel_curtain = $('#panel' + x).val();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].id_roll +
                                '<input type="hidden" name="book_roll[' + x + '][' + i + '][id_product]" data-id="' + data[list_arr[i]].id_roll + '" value="' + data[list_arr[i]].id_roll + '" >' +
                                '<input type="hidden" name="book_roll[' + x + '][' + i + '][panel]" data-id="' + data[list_arr[i]].id_roll + '" value="' + panel_curtain + '" >' +
                                '</td>' +
                                '<td>' + data[list_arr[i]].name_product +
                                '</td>' +
                                '<td width="20%">' +
                                '<input type="text" name="book_roll[' + x + '][' + i + '][book]" data-id="' + data[list_arr[i]].id_roll + '" class="form-control input-sm numberOnly text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#dtBook' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'bookRoll' && prodType == 'lining') {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_roll",
                    data: "id_roll=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#dtBook-lining' + x + ' tbody tr').remove();
                        var panel_lining = $('#panel-lining' + x).val();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].id_roll +
                                '<input type="hidden" name="book_roll-lining[' + x + '][' + i + '][id_product]" data-id="' + data[list_arr[i]].id_roll + '" value="' + data[list_arr[i]].id_roll + '" >' +
                                '<input type="hidden" name="book_roll-lining[' + x + '][' + i + '][panel]" data-id="' + data[list_arr[i]].id_roll + '" value="' + panel_lining + '" >' +
                                '</td>' +
                                '<td>' + data[list_arr[i]].name_product +
                                '</td>' +
                                '<td width="20%">' +
                                '<input type="text" name="book_roll-lining[' + x + '][' + i + '][book]" data-id="' + data[list_arr[i]].id_roll + '" class="form-control input-sm numberOnly text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#dtBook-lining' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'bookRoll' && prodType == 'vitrage') {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_roll",
                    data: "id_roll=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#dtBook-vitrage' + x + ' tbody tr').remove();
                        var panel_vitrage = $('#panel-vitrage' + x).val();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].id_roll +
                                '<input type="hidden" name="book_roll-vitrage[' + x + '][' + i + '][id_product]" data-id="' + data[list_arr[i]].id_roll + '" value="' + data[list_arr[i]].id_roll + '" >' +
                                '<input type="hidden" name="book_roll-vitrage[' + x + '][' + i + '][panel]" data-id="' + data[list_arr[i]].id_roll + '" value="' + panel_vitrage + '" >' +
                                '</td>' +
                                '<td>' + data[list_arr[i]].name_product +
                                '</td>' +
                                '<td width="20%">' +
                                '<input type="text" name="book_roll-vitrage[' + x + '][' + i + '][book]" data-id="' + data[list_arr[i]].id_roll + '" class="form-control input-sm numberOnly text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#dtBook-vitrage' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'extCommission' && prodType == "curtain") {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_pic",
                    data: "id_pic=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#ComCurtain' + x + ' tbody tr').remove();
                        var panel_cirtain = $('#panel' + x).val();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_pic +
                                '<input type="hidden" name="ext_comm[' + x + '][' + i + '][id_pic]" data-id="' + data[list_arr[i]].id_pic + '" value="' + data[list_arr[i]].id_pic + '" >' +
                                '<input type="hidden" name="ext_comm[' + x + '][' + i + '][panel]" data-id="' + data[list_arr[i]].id_pic + '" value="' + panel_cirtain + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="ext_comm[' + x + '][' + i + '][persen]" data-id="' + data[list_arr[i]].id_pic + '" id="persen_' + data[list_arr[i]].id_pic + '" class="form-control input-sm numberOnly persen text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" style="width:100%" name="ext_comm[' + x + '][' + i + '][value]" data-id="' + data[list_arr[i]].id_pic + '" id="value_' + data[list_arr[i]].id_pic + '"  class="form-control input-sm numberOnly nominal value text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#ComCurtain' + x + ' tbody').append(table);
                        };
                    }
                });

            } else if (dataType == 'extCommission' && prodType == "rail") {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_pic",
                    data: "id_pic=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#extComm_rail' + x + ' tbody tr').remove();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_pic +
                                '<input type="hidden" name="ext_comm_rail[' + x + '][' + i + '][id_pic]" data-id="' + data[list_arr[i]].id_pic + '" value="' + data[list_arr[i]].id_pic + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="ext_comm_rail[' + x + '][' + i + '][persen]" data-id="' + data[list_arr[i]].id_pic + '" id="persen_' + data[list_arr[i]].id_pic + '" class="form-control input-sm numberOnly persen_rail text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" style="width:100%" name="ext_comm_rail[' + x + '][' + i + '][value]" data-id="' + data[list_arr[i]].id_pic + '" id="value_' + data[list_arr[i]].id_pic + '"  class="form-control input-sm numberOnly nominal value_rail text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#extComm_rail' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'extCommission' && prodType == "lining") {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_pic",
                    data: "id_pic=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#ComLining' + x + ' tbody tr').remove();
                        var panel_lining = $('#panel-lining' + x).val();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_pic +
                                '<input type="hidden" name="ext_comm_lining[' + x + '][' + i + '][id_pic]" data-id="' + data[list_arr[i]].id_pic + '" value="' + data[list_arr[i]].id_pic + '" >' +
                                '<input type="hidden" name="ext_comm_lining[' + x + '][' + i + '][panel]" data-id="' + data[list_arr[i]].id_pic + '" value="' + panel_lining + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="ext_comm_lining[' + x + '][' + i + '][persen]" data-id="' + data[list_arr[i]].id_pic + '" id="persen_' + data[list_arr[i]].id_pic + '" class="form-control input-sm numberOnly persen_lining text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" style="width:100%" name="ext_comm_lining[' + x + '][' + i + '][value]" data-id="' + data[list_arr[i]].id_pic + '" id="value_' + data[list_arr[i]].id_pic + '"  class="form-control input-sm numberOnly nominal value_lining text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#ComLining' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'extCommission' && prodType == "vitrage") {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_pic",
                    data: "id_pic=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#ComVitrage' + x + ' tbody tr').remove();
                        var panel_vitrage = $('#panel-vitrage' + x).val();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_pic +
                                '<input type="hidden" name="ext_comm_vitrage[' + x + '][' + i + '][id_pic]" data-id="' + data[list_arr[i]].id_pic + '" value="' + data[list_arr[i]].id_pic + '" >' +
                                '<input type="hidden" name="ext_comm_vitrage[' + x + '][' + i + '][panel]" data-id="' + data[list_arr[i]].id_pic + '" value="' + panel_vitrage + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="ext_comm_vitrage[' + x + '][' + i + '][persen]" data-id="' + data[list_arr[i]].id_pic + '" id="persen_' + data[list_arr[i]].id_pic + '" class="form-control input-sm numberOnly persen_vitrage text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" style="width:100%" name="ext_comm_vitrage[' + x + '][' + i + '][value]" data-id="' + data[list_arr[i]].id_pic + '" id="value_' + data[list_arr[i]].id_pic + '"  class="form-control input-sm numberOnly nominal value_vitrage text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#ComVitrage' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'extCommission' && prodType == "rail-lining") {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_pic",
                    data: "id_pic=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#extComm_rail-lining' + x + ' tbody tr').remove();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_pic +
                                '<input type="hidden" name="ext_comm_rail_lining[' + x + '][' + i + '][id_pic]" data-id="' + data[list_arr[i]].id_pic + '" value="' + data[list_arr[i]].id_pic + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="ext_comm_rail_lining[' + x + '][' + i + '][persen]" data-id="' + data[list_arr[i]].id_pic + '" id="persen_' + data[list_arr[i]].id_pic + '" class="form-control input-sm numberOnly persen_rail-lining text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" style="width:100%" name="ext_comm_rail_lining[' + x + '][' + i + '][value]" data-id="' + data[list_arr[i]].id_pic + '" id="value_' + data[list_arr[i]].id_pic + '"  class="form-control input-sm numberOnly nominal value_rail-lining text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#extComm_rail-lining' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'extCommission' && prodType == "rail-vitrage") {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_pic",
                    data: "id_pic=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#extComm_rail-vitrage' + x + ' tbody tr').remove();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_pic +
                                '<input type="hidden" name="ext_comm_rail_vitrage[' + x + '][' + i + '][id_pic]" data-id="' + data[list_arr[i]].id_pic + '" value="' + data[list_arr[i]].id_pic + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="ext_comm_rail_vitrage[' + x + '][' + i + '][persen]" data-id="' + data[list_arr[i]].id_pic + '" id="persen_' + data[list_arr[i]].id_pic + '" class="form-control input-sm numberOnly persen_rail-vitrage text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" style="width:100%" name="ext_comm_rail_vitrage[' + x + '][' + i + '][value]" data-id="' + data[list_arr[i]].id_pic + '" id="value_' + data[list_arr[i]].id_pic + '"  class="form-control input-sm numberOnly nominal value_rail-vitrage text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#extComm_rail-vitrage' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'additionalComp' && prodType == 'curtain') {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_component",
                    data: "id_component=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#additional_comp_rail' + x + ' tbody tr').remove();
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_component +
                                '<input type="hidden" name="addt_comp[' + x + '][' + i + '][id_comp]" value="' + data[list_arr[i]].id_rail_add + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="addt_comp[' + x + '][' + i + '][qty]" value="' + '" id="qty_' + data[list_arr[i]].id_rail_add + '" data-id="' + data[list_arr[i]].id_rail_add + '" class="qty_add_comp form-control numberOnly text-right" placeholder="0" min="0" max="100">' +
                                '</td>' +
                                '<td>' + data[list_arr[i]].uom +
                                '<input type="hidden" style="width:100%" name="addt_comp[' + x + '][' + i + '][uom]" value="' + data[list_arr[i]].uom + '" class="form-control text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' + ('' + data[list_arr[i]].selling_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',') +
                                '<input type="hidden" style="width:100%" name="addt_comp[' + x + '][' + i + '][price]" id="price_' + data[list_arr[i]].id_rail_add + '" value="' + data[list_arr[i]].selling_price + '" class="form-control input-sm numberOnly nominal value text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" readonly style="width:100%" name="addt_comp[' + x + '][' + i + '][t_price]" id="t_price_' + data[list_arr[i]].id_rail_add + '" class="form-control required text-right t_price_add_comp" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#additional_comp_rail' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'additionalComp' && prodType == 'lining') {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_component",
                    data: "id_component=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#additional_comp_rail-lining' + x + ' tbody tr').remove();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_component +
                                '<input type="hidden" name="addt_comp-lining[' + x + '][' + i + '][id_comp]" value="' + data[list_arr[i]].id_rail_add + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="addt_comp-lining[' + x + '][' + i + '][qty]" id="qty_' + data[list_arr[i]].id_rail_add + '" data-id="' + data[list_arr[i]].id_rail_add + '" class="qty_add_comp-lining form-control numberOnly text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                                '</td>' +
                                '<td>' + data[list_arr[i]].uom +
                                '<input type="hidden" style="width:100%" name="addt_comp-lining[' + x + '][' + i + '][uom]" value="' + data[list_arr[i]].uom + '" class="form-control text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' + ('' + data[list_arr[i]].selling_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',') +
                                '<input type="hidden" style="width:100%" value="' + data[list_arr[i]].selling_price + '" name="addt_comp-lining[' + x + '][' + i + '][price]" id="price_' + data[list_arr[i]].id_rail_add + '" class="form-control text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" readonly style="width:100%" name="addt_comp-lining[' + x + '][' + i + '][price]" id="t_price_' + data[list_arr[i]].id_rail_add + '" class="form-control text-right t_price_add_comp-lining" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#additional_comp_rail-lining' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'additionalComp' && prodType == 'vitrage') {
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_component",
                    data: "id_component=" + list_mentah,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $('#additional_comp_rail-vitrage' + x + ' tbody tr').remove();
                        // console.log(result);
                        for (var i = 0; i < list_arr.length; i++) {
                            table =
                                '<tr>' +
                                '<td>' + data[list_arr[i]].name_component +
                                '<input type="hidden" name="addt_comp-vitrage[' + x + '][' + i + '][id_comp]" value="' + data[list_arr[i]].id_rail_add + '" >' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" style="width:100%" name="addt_comp-vitrage[' + x + '][' + i + '][qty]" id="qty_' + data[list_arr[i]].id_rail_add + '" data-id="' + data[list_arr[i]].id_rail_add + '" class="qty_add_comp-vitrage form-control numberOnly text-right" placeholder="0" min="0" max="100">' +
                                '</td>' +
                                '<td>' + data[list_arr[i]].uom +
                                '<input type="hidden" style="width:100%" name="addt_comp-vitrage[' + x + '][' + i + '][uom]" value="' + data[list_arr[i]].uom + '" class="form-control text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' + ('' + data[list_arr[i]].selling_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',') +
                                '<input type="hidden" style="width:100%" name="addt_comp-vitrage[' + x + '][' + i + '][price]" id="price_' + data[list_arr[i]].id_rail_add + '" value="' + data[list_arr[i]].selling_price + '" class="form-control numberOnly nominal value text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" readonly style="width:100%" name="addt_comp-vitrage[' + x + '][' + i + '][t_price]" id="t_price_' + data[list_arr[i]].id_rail_add + '" class="form-control text-right t_price_add_comp-vitrage" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#additional_comp_rail-vitrage' + x + ' tbody').append(table);
                        };
                    }
                });
            } else if (dataType == 'accessoriess' && prodType == 'accessoriess') {
                console.log(x);
                $.ajax({
                    type: "POST",
                    url: siteurl + "quotation_proses/get_accessoriess",
                    data: "id_acc=" + list_mentah,
                    dataType: 'json',
                    success: function(result) {
                        var data = result['list'];
                        $('#accProduct' + x + ' tbody tr').remove();
                        // console.log(result);
                        for (var i = 0; i < data.length; i++) {
                            // console.log(data[i].id_product)
                            table =
                                '<tr>' +
                                '<td>' + [i + 1] +
                                '</td>' +
                                '<td>' + data[i].id_accessories +
                                '<input type="hidden" name="product_acc[' + x + '][' + i + '][id_acc]" value="' + data[i].id_accessories + '" >' +
                                '<input type="hidden" name="product_acc[' + x + '][' + i + '][section]" value="' + i + '" >' +
                                '</td>' +
                                '<td>' + data[i].name_accessories +
                                '<input type="hidden" style="width:100%" name="product_acc[' + x + '][' + i + '][name_accessories]" value="' + data[i].name_accessories + '" class="form-control numberOnly text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                                '</td>' +
                                '<td class="text-center">' + data[i].name_uom +
                                '<input type="hidden" style="width:100%" name="product_acc[' + x + '][' + i + '][uom]" value="' + data[i].name_uom + '" class="form-control numberOnly nominal value text-right" placeholder="0">' +
                                '</td>' +
                                '<td class="text-right">' + ("" + data[i].selling_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ",") +
                                '<input type="hidden" id="price_acc' + data[i].id_accessories + '" data-id="' + data[i].id_accessories + '" style="width: 100 % " name="product_acc[' + x + '][' + i + '][price]" value="' + data[i].selling_price + '" class="form-control text-right " placeholder="0 ">' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" id="qty_acc' + data[i].id_accessories + '" data-id="' + data[i].id_accessories + '" style="width:100%" name="product_acc[' + x + '][' + i + '][qty]" class="form-control numberOnly qty_acc text-right" placeholder="0">' +
                                '</td>' +
                                '<td class="text-right">' +
                                '<span class="sub_price_acc' + data[i].id_accessories + '">0</span><input type="hidden" id="sub_price_acc' + data[i].id_accessories + '" data-id="' + data[i].id_accessories + '" style="width:100%" name="product_acc[' + x + '][' + i + '][sub_price]" class="form-control text-right" placeholder="0">' +
                                '</td>' +
                                '<td class="text-right">' +
                                '<input type="number" min="0" id="disc_acc' + data[i].id_accessories + '" data-id="' + data[i].id_accessories + '" name="product_acc[' + x + '][' + i + '][disc_acc]" class="form-control disc_acc text-right" placeholder="0">' +
                                '</td>' +
                                '<td class="text-right"> ' +
                                '<span class="v_disc_acc' + data[i].id_accessories + '">0</span><input type="hidden" id="v_disc_acc' + data[i].id_accessories + '" data-id="' + data[i].id_accessories + '" style="width:100%" name="product_acc[' + x + '][' + i + '][val_disc_acc]" class="form-control text-right" placeholder="0">' +
                                '</td>' +
                                '<td class="text-right"> ' +
                                '<span class="t_price_acc' + data[i].id_accessories + '">0</span><input type="hidden" id="t_price_acc' + data[i].id_accessories + '" data-id="' + data[i].id_accessories + '" style="width:100%" name="product_acc[' + x + '][' + i + '][t_price]" class="form-control text-right" placeholder="0">' +
                                '</td>' +
                                '<td>' +
                                '<a class="text-red text-center hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                                '</td>' +
                                '</tr>';
                            $('#accProduct' + x + ' tbody').append(table);
                        };
                    }
                });
            }
        }
    }

    // $(document).on('change', '.qtyAcc', function() {
    //     let no = $(this).parents('table').data('id');
    //     let id = $(this).data("id");
    //     let qty = $(this).val() || 0;
    //     let price = $('input[data-id=' + id + ']#price_acc' + no).val() || 0;
    //     let t_price = qty * price;

    //     // $('.t_price_acc' + no).text(("" + t_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ","))
    //     // $('#t_price_acc' + no).val(t_price);
    //     $('span[data-id=' + id + ']#t_price_acc' + no).text(("" + t_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ","))
    //     // alert(t_price);
    //     $('input[data-id=' + id + ']#t_price_acc' + no).val(t_price);
    // })
    // ------------------------------------------------------------------------------------------------------//
    // VITRAGE 
    //-------------------------------------------------------------------------------------------------------//
    // PRODUCT VITRAGE //
    // ===============//

    $(document).on('change', '.switch-vitrage', function() {
        var no = $(this).data('id');
        if ($('div.vitrage-switch' + no + ' input[type="checkbox"]').is(":checked")) {
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addvitrage',
                    data: {
                        'no': no
                    },
                    success: function(result) {
                        $(".box-vitrage" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: $("#form-quotation")
                        });
                        getVitrage(no);
                        getSewingVitrage(no);
                        $('.vitrage-box' + no).removeClass('collapsed-box');
                    }
                })
            }, 200);
        } else {
            $(".box-vitrage" + no).html('');
            $('.vitrage-box' + no).addClass('collapsed-box');
        }
    })

    function getVitrage(no) {
        if ('<?= $fabrics_vitrage->id_product ?>' != '') {
            var id_selected = '<?= $fabrics_vitrage->id_product ?>';
        } else if ($('#product_vitrage<?= $no ?>').val() != null || $('#product_vitrage<?= $no ?>').val() != '') {
            var id_selected = $('#product_vitrage<?= $no ?>').val();
        } else {
            var id_selected = '';
        }
        //console.log(id_selected);
        var column = 'activation';
        var column_fill = 'aktif';
        var filter_column = 'status';
        var filter_val = '1';
        var search_column = 'usages';
        var search_value = 'vitrage';
        var column_name = 'name_product';
        var table_name = 'pricelist_fabric_view';
        var key = 'id_product';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                filter_column: filter_column,
                filter_val: filter_val,
                search_column: search_column,
                search_value: search_value,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {
                $('#product_vitrage' + no).html(result.html);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });
    }

    $(document).on('change', '.product_vitrage', function() {
        var no = $(this).data('id');
        var qty_unit = $('#qty_unit' + no).val() || 0;
        var product = $(this).val();
        changeVitrage(no, product, qty_unit)
    })

    function changeVitrage(no, product, qty_unit) {
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataProduct',
            data: {
                'product': product
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result['product']);
                if (result['product'] == '' || result['product'] == null) {
                    $('#lebar_kain-vitrage' + no).val('');
                    $('#harga_kain-vitrage' + no).val('');
                    $('#t_harga_kain-vitrage' + no).val('');
                    $('#t_disc_fab-vitrage' + no).val('');
                    $('#cust_vitrage_name' + no).val('');
                    let harga_kain = 0;
                } else {
                    if (qty_unit == '' || qty_unit == 0) {
                        alert('Qty Unit tidak boleh kosong!');
                        $(this).text('');
                        $(this).val('');
                        return false;
                    } else {
                        total_hrg_kain = parseInt(result['product'].price) * parseInt(qty_unit);
                        $('#lebar_kain-vitrage' + no).val(result['product'].width);
                        $('#harga_kain-vitrage' + no).val(result['product'].price);
                        $('#t_harga_kain-vitrage' + no).val(("" + total_hrg_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
                        $('#cust_vitrage_name' + no).val(result['product'].name_product);
                        let harga_kain = total_hrg_kain;
                        let disc_fab = $('#disc_fab-vitrage' + no).val() || 0;
                        let val = countDiscVitrage(no);
                        if (val == false) {
                            // $(this).val('0');
                            $('#t_disc_fab-vitrage' + no).val('0');
                        } else {
                            t_disk = (parseInt(harga_kain) * (parseInt(disc_fab))) / 100;
                            $('#t_disc_fab-vitrage' + no).val(('' + t_disk).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
                        }
                        lebarKain = $('#lebar_kain-vitrage' + no).val() || 0;
                        dataType = 'panel-vitrage';
                        rumus_panel_vitrage(no);
                    }
                }
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        })
    }

    function countDiscVitrage(no) {
        let disk = $('#disc_cat').val();
        let disMnt = $('#disc_mnt-vitrage' + no).val() || 0;
        let disk2 = disk.replace(/%/g, '');
        let fee_pic = $('#fee_pic-vitrage' + no).val() || 0;
        let disc_vitrage = $('#disc_vitrage' + no).val() || 0;

        sumDisk = parseInt(disc_vitrage) + parseInt(disMnt) + parseInt(fee_pic);
        $('#vitrage_disk' + no).val(sumDisk);
        // console.log(sumDisk);
        if ($('#product_vitrage' + no).val() == '' || $('#product_vitrage' + no).val() == null) {
            alert('Pilih bahan vitrage terlebih dahulu!');
            return false;
        } else if (disk2 == 0 || disk2 == '') {
            alert('Discount Category tidak boleh 0.');
            return false;
        } else if (parseInt(sumDisk) > parseInt(disk2)) {
            alert('Diskon melebihi batas.');
            return false;
        } else {
            return true;
        }
    }

    $(document).on('keyup paste change', '.ovl_kiri-vitrage,.ovl_tengah-vitrage,.jahit_h-vitrage,.jahit_v-vitrage,.fullness-vitrage', function() {
        var no = $(this).data('id');
        qty_unit = $('#qty_unit' + no).val() || 0;
        lebar = $('#lebar' + no).val() || 0;

        if (lebar == '' || lebar == 0) {
            alert('Lebar Jendela tidak boleh kosong!');
            $(this).val('');
            return false;
        } else {
            if (qty_unit == '' || qty_unit == 0) {
                alert('Qty Unit tidak boleh kosong!');
                $(this).val('');
                return false;
            } else {
                rumus_panel_vitrage(no);
            }
            // total_kain(no);
        }
    })

    function rumus_panel_vitrage(no) {
        type = $('#type_vitrage' + no).data('type');
        lebar = $('#lebar' + no).val() || 0;
        ovlKiri = $('#ovl_kiri-vitrage' + no).val() || 0;
        ovlTengah = $('#ovl_tengah-vitrage' + no).val() || 0;
        jh = $('#jahit_h-vitrage' + no).val() || 0;
        lbrKain = $('#lebar_kain-vitrage' + no).val() || 0;
        fullness = $('#fullness-vitrage' + no).val() || 0;

        if (type == 'panel') {
            let jml_panel = (parseInt(lebar) + parseInt(ovlKiri) +
                parseInt(ovlTengah) + parseInt(jh)) / parseInt(lbrKain) * (parseInt(fullness) / 100);
            $('#rumus_panel-vitrage' + no).val(jml_panel.toFixed(3));
            total_kain_vitrage(no);
        } else {
            total_kain_vitrage(no);
        }
    }

    function total_kain_vitrage(no) {
        type = $('#type_vitrage' + no).data('type');
        lebar = $('#lebar' + no).val() || 0;
        tinggi = $('#tinggi' + no).val() || 0;
        qty_unit = $('#qty_unit' + no).val() || 0;

        ovlKiri = $('#ovl_kiri-vitrage' + no).val() || 0;
        ovlTengah = $('#ovl_tengah-vitrage' + no).val() || 0;
        jh = $('#jahit_h-vitrage' + no).val() || 0;
        jv = $('#jahit_v-vitrage' + no).val() || 0;
        vr = $('#vertikal_repeat-vitrage' + no).val() || 0;
        fullness = $('#fullness-vitrage' + no).val() || 0;
        roundUp = $('#r_up_panel-vitrage' + no).val() || 0;

        if (type == 'panel') {
            let total_kain = (parseInt(roundUp) * (Math.ceil((parseInt(tinggi) + parseInt(jv)) / parseFloat(vr)) * (parseFloat(vr) / 100)) * parseInt(qty_unit));
            $('#t_kain-vitrage' + no).val(total_kain.toFixed(2));
            let t_harga_kain = $('#t_harga_kain-vitrage' + no).val().replace(/,/g, '') || 0;
            total_harga_kain = total_kain.toFixed(2) * parseInt(t_harga_kain);
            $('#total_harga_kain-vitrage' + no).val(('' + total_harga_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        } else {
            jmlKain = (((parseInt(lebar) + parseInt(ovlKiri) + parseInt(ovlTengah) + parseInt(jh)) * (parseInt(fullness) / 100)) / 100) * (parseInt(qty_unit));
            $('#t_kain-vitrage' + no).val(jmlKain.toFixed(1));
            let t_harga_kain = $('#t_harga_kain-vitrage' + no).val() || 0;
            // console.log(t_harga_kain)
            if (t_harga_kain != 0) {
                total_harga_kain = jmlKain.toFixed(1) * parseInt(t_harga_kain.replace(/,/g, ''));
                $('#total_harga_kain-vitrage' + no).val(('' + total_harga_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            }
        }
    }

    $(document).on('keyup paste change', '.disc_vitrage', function() {
        let no = $(this).data('id');
        let t_harga_kain = $('#total_harga_kain-vitrage' + no).val().replace(/,/g, '') || 0;
        let disc_vitrage = $(this).val() || 0;
        let val = countDiscVitrage(no);
        // console.log(val);
        if (val == false) {
            $(this).val('0');
            $('#t_disc_vitrage' + no).val('0');
        } else {
            t_disk = (parseInt(t_harga_kain) * (parseInt(disc_vitrage))) / 100;
            $('#t_disc_vitrage' + no).val(('' + t_disk.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            t_aft_disk = parseInt(t_harga_kain) - (parseInt(t_disk));
            $('#harga_aft_disc-vitrage' + no).val(('' + t_aft_disk).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }


        let persen = 0;
        $('.persen_vitrage').each(function() {
            persen += Number($('.persen_vitrage').val() || 0);
        })
        $('#fee_pic-vitrage' + no).val(persen);

        disc = $('.persen_vitrage').val() || 0;
        id = $('.persen_vitrage').data("id");

        dis_vitrage = (parseInt(t_harga_kain) * (parseInt(disc_vitrage))) / 100;
        if (dis_vitrage == '') {
            t_disk = (parseInt(t_harga_kain));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(t_harga_kain) - (parseInt(dis_vitrage)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        if (val == false) {
            $('table#ComVitrage' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ' + val_disc);
            $('table#ComVitrage' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

    })

    $(document).on('change', '.pilihMainten-vitrage', function() {
        let no = $(this).data('id');
        mode = $(this).val();
        harga_kain = $('#harga_kain-vitrage' + no).val().replace(/,/g, '') || 0;
        diskon_vit = $('#disc_vitrage' + no).val() || 0;

        if (mode == 'yes') {
            $('#disc_mnt-vitrage' + no).val('5');
        } else {
            $('#disc_mnt-vitrage' + no).val('0');
        }

        let diskon_mnt = $('#disc_mnt-vitrage' + no).val();
        let val = countDiscVitrage(no);
        // alert(diskon_mnt)
        if (val == false) {
            $('#disc_mnt-vitrage' + no).val('0');
            $('#no_' + no).prop('checked', true);
        } else {
            dis_vit = (parseInt(harga_kain) * parseInt(diskon_vit)) / 100;
            afterDiscVit = parseInt(harga_kain) - parseInt(dis_vit);
            dis_mnt = (parseInt(afterDiscVit) * parseInt(diskon_mnt)) / 100;
            $('#disc_mnt_val-vitrage' + no).val(dis_mnt);

        }

    })

    $(document).on('change', '.persen_vitrage', function() {
        let no = $(this).parents('table').data('id');
        let disc_vitrage = $('#disc_vitrage' + no).val() || 0;
        let t_harga_kain_vitrage = $('#total_harga_kain-vitrage' + no).val().replace(/,/g, '') || 0;

        let persen = 0;
        $('.persen_vitrage').each(function() {
            persen += Number($(this).val() || 0);
        })
        $('#fee_pic-vitrage' + no).val(persen);
        // let fee_pic = $('#fee_pic-vitrage' + no).val() || 0;

        disc = $(this).val() || 0;
        id = $(this).data("id");

        dis_vitrage = (parseInt(t_harga_kain_vitrage) * (parseInt(disc_vitrage))) / 100;
        if (dis_vitrage == '') {
            t_disk = (parseInt(t_harga_kain_vitrage));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(t_harga_kain_vitrage) - (parseInt(dis_vitrage)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        let val = countDiscVitrage(no);
        if (val == false) {
            $(this).val('0');
            $('table#' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ' + val_disc);
            $('table#ComVitrage' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }
    })

    $(document).on('change', '.value_vitrage', function() {
        let no = $(this).parents('table').data('id');
        let disc_vitrage = $('#disc_vitrage' + no).val() || 0;
        let t_harga_kain_vitrage = $('#total_harga_kain-vitrage' + no).val().replace(/,/g, '') || 0;
        let disMnt = $('#disc_mnt-vitrage' + no).val() || 0;

        id = $(this).data("id");
        disc = $(this).val().replace(/,/g, '');

        dis_vitrage = (parseInt(t_harga_kain_vitrage) * (parseInt(disc_vitrage))) / 100;
        if (dis_vitrage == '') {
            t_disk = (parseInt(t_harga_kain_vitrage));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        } else {
            t_disk = (parseInt(t_harga_kain_vitrage) - (parseInt(dis_vitrage)));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        }

        let val = countDiscVitrage(no);
        if (val == false) {
            $(this).val('0');
            $('table#ComVitrage' + no).find('input#persen_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#ComVitrage' + no).find('input#persen_' + id).val(Math.ceil(val_disc));
            let persen = 0;
            $('.persen_vitrage').each(function() {
                persen += Number($('.persen_vitrage').val() || 0);
            })
            $('#fee_pic-vitrage' + no).val(parseInt(persen));
            sumDisk = parseInt(disc_vitrage) + parseInt(disMnt) + parseInt(persen);
            $('#vitrage_disk' + no).val(sumDisk);
        }
    })

    function getSewingVitrage(no) {
        if ('<?= ($fabrics_vitrage->jahitan) ?>' != null) {
            var id_selected = '<?= $fabrics_vitrage->jahitan ?>';
        } else if ($('#jahitan-vitrage<?= $no ?>').val() != null || $('#jahitan-vitrage<?= $no ?>').val() != '') {
            var id_selected = $('#jahitan-vitrage<?= $no ?>').val();
        } else {
            var id_selected = '';
        }
        //console.log(id_selected);
        var column = 'id_sewing';
        var column_fill = '';
        var column_name = 'item';
        var table_name = 'sewing';
        var key = 'id_sewing';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {
                $('#jahitan-vitrage' + no).html(result.html);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });

    }

    $(document).on('change', '.jahitan-vitrage', function() {
        var no = $(this).data('id');
        var id_jahitan = $(this).val();
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataJahitan',
            data: {
                'id_jahitan': id_jahitan
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result['sewing']);
                $('#hrg_jahitan-vitrage' + no).val(result['sewing'].price.replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
                disc_jahit_vitrage(no);
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        });

    });

    $(document).on('change', '.pilihJahitan-vitrage', function() {
        var type = $(this).val();
        var no = $(this).data('id');
        changeJahitVitrage(type, no);
    })

    function changeJahitVitrage(type, no) {
        id_jahitan = $('#dt_jns_jahit-vitrage' + no).data('jht');
        id_ruangan = $('#id_ruangan' + no).val();
        id_quotation = $('#id_qtt').val();
        if (type == 'yes') {
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'addJahitVitrage',
                data: {
                    'no': no,
                    'id_jahitan': id_jahitan,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    // console.log(result)
                    $('#dt_jns_jahit-vitrage' + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        dropdownParent: $("#form-quotation")
                    });
                }
            })
        } else {
            $('#dt_jns_jahit-vitrage' + no).html('');
        }
    }

    function changeJahitanVitrage(no, id_jht) {
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataJahitan',
            data: {
                'id_jahitan': id_jht
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result['sewing']);
                if (result['sewing'] != null) {
                    // $('#hrg_jahitan' + no).val(result['sewing'].price.replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
                    $('#hrg_jahitan-vitrage' + no).val(result['sewing'].price.replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));

                }
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        })
    }

    $(document).on('change', '.pilihRail-vitrage', function() {
        var type = $(this).val();
        var no = $(this).data('id');
        changeRailVitrage(no, type)
    });

    function changeRailVitrage(no, type) {
        var id_ruangan = $('#id_ruangan' + no).val();
        var id_quotation = $('#id_qtt').val();

        if (type == 'yes') {
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'get_rail_vitrage',
                data: {
                    'no': no,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    $("#dt_rail-vitrage" + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        dropdownParent: $("#form-quotation")
                    });
                    // getRailVitrage(no);
                }
            })

        } else {
            $('#dt_rail-vitrage' + no).html('');
        }
    }

    function getRailVitrage(no) {
        if ('<?= ($fabrics_vitrage->rail_material) ?>' != null) {
            var id_selected = '<?= $fabrics_vitrage->rail_material ?>';
        } else if ($('#rail_material-vitrage<?= $no ?>').val() != null || $('#rail_material-vitrage<?= $no ?>').val() != '') {
            var id_selected = $('#rail_material-vitrage<?= $no ?>').val();
        } else {
            var id_selected = '';
        }
        //console.log(id_selected);
        var column = 'activation';
        var column_fill = 'aktif';
        var column_name = 'name_product';
        var table_name = 'mp_rail';
        var key = 'id_rail';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {
                $('#rail_material-vitrage' + no).html(result.html);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });

    }

    $(document).on('change', '.rail_material-vitrage', function() {
        let x = $(this).data('id');
        let id_rail = $(this).val();
        let lebar = $('#lebar' + x).val();
        let qty_unit = $('#qty_unit' + x).val();
        if (qty_unit == '') {
            alert("Qty Unit tidak boleh kosong!");
            return false;
        } else {
            if (lebar == '') {
                alert("Lebar jendela tidak boleh kosong!");
                return false;
            } else {
                $('#width_rail-vitrage' + x).val(lebar / 100);
                $('#window_width-vitrage' + x).val(lebar);
                $.ajax({
                    url: siteurl + active_controller + 'get_data_rail',
                    type: "POST",
                    dataType: "json",
                    data: {
                        id_rail: id_rail
                    },
                    success: function(result) {
                        // console.log(result['list'][0].act_selling_price)
                        $('#price_rail-vitrage' + x).val(result['list'][0].act_selling_price)
                        t_hrga_rail = ((parseInt(result['list'][0].act_selling_price) * parseInt(lebar)) / 100) * parseInt(qty_unit);
                        $('#t_price_rail-vitrage' + x).val(("" + t_hrga_rail).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
                        $('#cust_rail_name-vitrage' + x).val(result['list'][0].name_product);

                        getBasicComponentVitrage(id_rail, x);
                        getAdditionalComponentVitrage(id_rail, x);
                        subtotal_rail_vitrage(x);
                        diskon_rail_vitrage(x);
                        total_rail_vitrage(x);
                    },
                    error: function() {
                        alert("Ajax Error..!!")
                    }
                })
            }
        }
    });

    function getBasicComponentVitrage(id_rail, x) {
        let width_rail = parseFloat($('#width_rail-vitrage' + x).val() || 0);

        $.ajax({
            url: siteurl + active_controller + 'get_baic_component',
            type: "POST",
            dataType: "json",
            data: {
                id_rail: id_rail,
                width_rail: width_rail
            },
            success: function(result) {
                data = result['list']
                // console.log(data.length)
                $('#basic_component-vitrage' + x + ' tbody tr').remove();
                for (var i = 0; i < data.length; i++) {
                    table =
                        '<tr>' +
                        '<td>' + data[i].name_component +
                        '<input type="hidden" name="bc_comp-vitrage[' + x + '][' + i + '][id_rail_basic]" data-id="' + data[i].id_rail_basic + '" value="' + data[i].id_rail_basic + '" >' +
                        '</td>' +
                        '<td>' + data[i].qty +
                        '<input type="hidden" style="width:100%" name="bc_comp-vitrage[' + x + '][' + i + '][qty]" value="' + data[i].qty + '" class="form-control text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                        '</td>' +
                        '<td>' + data[i].uom +
                        '<input type="hidden" style="width:100%" name="bc_comp-vitrage[' + x + '][' + i + '][uom]" value="' + data[i].uom + '" class="form-control text-right" placeholder="0">' +
                        '</td>' +
                        '</tr>';
                    $('#basic_component-vitrage' + x + ' tbody').append(table);
                };
            }
        })
    }

    function getAdditionalComponentVitrage(id_rail, x) {
        $.ajax({
            url: siteurl + active_controller + 'get_additional_component',
            type: "POST",
            dataType: "json",
            data: {
                id_rail: id_rail,
            },
            success: function(result) {
                data = result['list']
                // console.log(data.length)
                // $('#additional_comp_rail-vitrage' + x + ' tbody tr').remove();
                // for (var i = 0; i < data.length; i++) {
                //     table =
                //         '<tr>' +
                //         '<td>' + data[i].name_component +
                //         '<input type="hidden" name="addt_comp-vitrage[' + x + '][' + i + '][id_comp]" data-id="' + data[i].id_rail_add + '" value="' + data[i].id_rail_add + '" >' +
                //         '</td>' +
                //         '<td>' +
                //         '<input type="number" style="width:100%" name="addt_comp-vitrage[' + x + '][' + i + '][qty]" id="qty_' + data[i].id_rail_add + '"  data-id="' + data[i].id_rail_add + '" class="qty_add_comp-vitrage form-control required input-sm text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                //         '</td>' +
                //         '<td>' + data[i].uom +
                //         '<input type="hidden" style="width:100%" name="addt_comp-vitrage[' + x + '][' + i + '][uom]" value="' + data[i].uom + '" class="form-control text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' + ('' + data[i].selling_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',') +
                //         '<input type="hidden" style="width:100%" name="addt_comp-vitrage[' + x + '][' + i + '][price]" id="price_' + data[i].id_rail_add + '"  value="' + data[i].selling_price + '"  class="form-control input-sm numberOnly nominal value text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' +
                //         '<input type="text" readonly style="width:100%" name="addt_comp-vitrage[' + x + '][' + i + '][t_price]" id="t_price_' + data[i].id_rail_add + '"  class="form-control text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' +
                //         '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                //         '</td>' +
                //         '</tr>';
                //     $('#additional_comp_rail-vitrage' + x + ' tbody').append(table);
                // };
            }
        })
    }

    $(document).on('change input', '.qty_add_comp-vitrage', function() {
        let id = $(this).data('id');
        let no = $(this).parents('table').data('id');
        let qty = parseInt($(this).val());
        let price = parseInt($('#price_' + id).val().replace(/'/g, '') || 0);

        let t_price = qty * price;
        $('table#additional_comp_rail-vitrage' + no).find('input#t_price_' + id).val(('' + t_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        // console.log(t_price)
        var total_add_comp = 0;
        $('.t_price_add_comp-vitrage').each(function() {
            total_add_comp += Number($(this).val().replace(/,/g, '') || 0);
        })
        $('#total_add_comp_rail-vitrage' + no).val(('' + total_add_comp).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        subtotal_rail_vitrage(no);
        diskon_rail_vitrage(no);
        total_rail_vitrage(no);

    })





    function countDiscRailVitrage(no) {
        let disk = $('#disc_cat').val();
        let disk2 = disk.replace(/%/g, '');
        let fee_pic = $('#fee_rail-vitrage' + no).val() || 0;
        let diskon_rail = $('#diskon_rail-vitrage' + no).val() || 0;

        sumDisk = parseInt(diskon_rail) + parseInt(fee_pic);
        $('#diskon_rail_vitrage' + no).val(sumDisk);
        if ($('#rail_material-vitrage' + no).val() == '' || $('#rail_material-vitrage' + no).val() == null) {
            alert('Pilih material rail terlebih dahulu!');
            return false;
        } else if (disk2 == 0 || disk2 == '') {
            alert('Discount Category tidak boleh 0.');
            return false;
        } else if (parseInt(sumDisk) > parseInt(disk2)) {
            alert('Diskon melebihi batas.');
            return false;
        } else {
            return true;
        }
    }

    $(document).on('keyup paste change', '.diskon_rail-vitrage', function() {
        let no = $(this).data('id');
        diskon_rail_vitrage(no);
        total_rail_vitrage(no);
    })

    function diskon_rail_vitrage(no) {
        let t_price_rail = $('#t_price_rail-vitrage' + no).val().replace(/,/g, '') || 0;
        let subtotal_rail = $('#subtotal_rail-vitrage' + no).val().replace(/,/g, '') || 0;
        let diskon_rail = $('#diskon_rail-vitrage' + no).val() || 0;

        let val = countDiscRailVitrage(no);
        if (val == false) {
            $('#diskon_rail-vitrage' + no).val('0');
            $('#v_diskon_rail-vitrage' + no).val('0');
        } else {
            t_disk = (parseInt(subtotal_rail) * (parseInt(diskon_rail))) / 100;
            $('#v_diskon_rail-vitrage' + no).val(('' + t_disk.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

        let persen = 0;
        $('.persen_rail-vitrage').each(function() {
            persen += Number($('.persen_rail-vitrage').val());
        })
        $('#fee_rail-vitrage' + no).val(persen);

        disc = $('.persen_rail-vitrage').val() || 0;
        id = $('.persen_rail-vitrage').data("id");

        dis_rail = (parseInt(subtotal_rail) * (parseInt(diskon_rail))) / 100;
        if (dis_rail == '') {
            t_disk = (parseInt(subtotal_rail));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(subtotal_rail) - (parseInt(dis_rail)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        if (val == false) {
            // $(this).val('0');
            $('table#extComm_rail-vitrage' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#extComm_rail-vitrage' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

    }

    $(document).on('change', '.persen_rail-vitrage', function() {
        let no = $(this).parents('table').data('id');
        let disc_rail_vitrage = $('#diskon_rail-vitrage' + no).val() || 0;
        let t_price_rail_vitrage = $('#t_price_rail-vitrage' + no).val().replace(/,/g, '') || 0;

        let persen = 0;
        $('.persen_rail-vitrage').each(function() {
            persen += Number($(this).val());
        })
        $('#fee_rail-vitrage' + no).val(persen);

        disc = $(this).val() || 0;
        id = $(this).data("id");

        dis_vitrage = (parseInt(t_price_rail_vitrage) * (parseInt(disc_rail_vitrage))) / 100;
        if (dis_vitrage == '') {
            t_disk = (parseInt(t_price_rail_vitrage));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(t_price_rail_vitrage) - (parseInt(dis_vitrage)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        // console.log(t_price_rail_vitrage + "," + dis_vitrage + "," + val_disc + "," + t_disk)

        let val = countDiscRailVitrage(no);
        if (val == false) {
            $(this).val('0');
            $('table#extComm_rail-vitrage' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ' + val_disc);
            $('table#extComm_rail-vitrage' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }
    })

    $(document).on('change', '.value_rail-vitrage', function() {
        let no = $(this).parents('table').data('id');
        let disc_rail_vitrage = $('#diskon_rail-vitrage' + no).val() || 0;
        let t_price_rail_vitrage = $('#t_price_rail-vitrage' + no).val().replace(/,/g, '') || 0;

        id = $(this).data("id");
        disc = $(this).val().replace(/,/g, '');

        dis_rail = (parseInt(t_price_rail_vitrage) * (parseInt(disc_rail_vitrage))) / 100;
        if (dis_rail == '') {
            t_disk = (parseInt(t_price_rail_vitrage));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        } else {
            t_disk = (parseInt(t_price_rail_vitrage) - (parseInt(dis_rail)));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        }

        let val = countDiscRailVitrage(no);
        if (val == false) {
            $(this).val('0');
            $('table#extComm_rail-vitrage' + no).find('input#persen_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#extComm_rail-vitrage' + no).find('input#persen_' + id).val(Math.ceil(val_disc));
            let persen = 0;
            $('.persen_rail-vitrage').each(function() {
                persen += Number($('.persen_rail-vitrage').val());
            })
            $('#fee_rail-vitrage' + no).val(persen);
            sumDisk = parseInt(disc_rail_vitrage) + parseInt(persen);
            $('#diskon_rail_vitrage' + no).val(sumDisk);

        }
        // let fee_pic = $('#fee_pic' + no).val() || 0;
    })


    // =======================================================================================================
    // LINING
    // =======================================================================================================
    $(document).on('change', '.switch-lining', function() {
        var no = $(this).data('id');
        if ($('div.lining-switch' + no + ' input[type="checkbox"]').is(":checked")) {
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addlining',
                    data: {
                        'no': no
                    },
                    success: function(result) {
                        $(".box-lining" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: $("#form-quotation")
                        });
                        getLining(no);
                        getSewingLining(no);
                        $('.lining-box' + no).removeClass('collapsed-box');
                    }
                })
            }, 200);
        } else {
            $(".box-lining" + no).html('');
            $('.lining-box' + no).addClass('collapsed-box');
        }
    })

    function getLining(no) {
        if ('<?= ($fabrics_lining->id_product) ?>' != null) {
            var id_selected = '<?= $fabrics_lining->id_product ?>';
        } else {
            var id_selected = '';
        }
        //console.log(id_selected);
        var column = 'activation';
        var column_fill = 'aktif';
        var filter_column = 'status';
        var filter_val = '1';
        var search_column = 'usages';
        var search_value = 'lining';
        var column_name = 'name_product';
        var table_name = 'pricelist_fabric_view';
        var key = 'id_product';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                filter_column: filter_column,
                filter_val: filter_val,
                search_column: search_column,
                search_value: search_value,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {
                $('#product_lining' + no).html(result.html);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });
    }

    $(document).on('change', '.product_lining', function() {
        var no = $(this).data('id');
        var qty_unit = $('#qty_unit' + no).val() || 0;
        var product = $(this).val();
        changeLining(no, product, qty_unit)
    })

    function changeLining(no, product, qty_unit) {
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataProduct',
            data: {
                'product': product
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result['product']);
                if (result['product'] == '' || result['product'] == null) {
                    $('#lebar_kain-lining' + no).val('');
                    $('#harga_kain-lining' + no).val('');
                    $('#t_harga_kain-lining' + no).val('');
                    $('#t_disc_fab-lining' + no).val('');
                    $('#cust_lining_name' + no).val('');
                    let harga_kain = 0;
                } else {
                    if (qty_unit == '' || qty_unit == 0) {
                        alert('Qty Unit tidak boleh kosong!');
                        $(this).text('');
                        $(this).val('');
                        return false;
                    } else {
                        total_hrg_kain = parseInt(result['product'].price) * parseInt(qty_unit);
                        $('#lebar_kain-lining' + no).val(result['product'].width);
                        $('#harga_kain-lining' + no).val(result['product'].price);
                        $('#t_harga_kain-lining' + no).val(("" + total_hrg_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
                        $('#cust_lining_name' + no).val(result['product'].name_product);
                        let harga_kain = total_hrg_kain;
                        let disc_fab = $('#disc_fab-lining' + no).val() || 0;
                        let val = countDiscLining(no);
                        if (val == false) {
                            // $(this).val('0');
                            $('#t_disc_fab-lining' + no).val('0');
                        } else {
                            t_disk = (parseInt(harga_kain) * (parseInt(disc_fab))) / 100;
                            $('#t_disc_fab-lining' + no).val(('' + t_disk).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
                        }
                        lebarKain = $('#lebar_kain-lining' + no).val() || 0;
                        dataType = 'panel-lining';
                        rumus_panel_lining(no);
                    }

                }
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        })
    }

    function countDiscLining(no) {
        let disk = $('#disc_cat').val();
        let disMnt = $('#disc_mnt-lining' + no).val() || 0;
        let disk2 = disk.replace(/%/g, '');
        let fee_pic = $('#fee_pic-lining' + no).val() || 0;
        let disc_lining = $('#disc_lining' + no).val() || 0;

        sumDisk = parseInt(disc_lining) + parseInt(disMnt) + parseInt(fee_pic);
        $('#lining_disk' + no).val(sumDisk);
        if ($('#product_lining' + no).val() == '' || $('#product_lining' + no).val() == null) {
            alert('Pilih bahan lining terlebih dahulu!');
            return false;
        } else if (disk2 == 0 || disk2 == '') {
            alert('Discount Category tidak boleh 0.');
            return false;
        } else if (parseInt(sumDisk) > parseInt(disk2)) {
            alert('Diskon melebihi batas.');
            return false;
        } else {
            return true;
        }
    }

    $(document).on('keyup paste change', '.ovl_kiri-lining,.ovl_tengah-lining,.jahit_h-lining,.jahit_v-lining,.fullness-lining', function() {
        var no = $(this).data('id');
        qty_unit = $('#qty_unit' + no).val() || 0;
        lebar = $('#lebar' + no).val() || 0;

        if (lebar == '' || lebar == 0) {
            alert('Lebar Jendela tidak boleh kosong!');
            $(this).val('');
            return false;
        } else {
            if (qty_unit == '' || qty_unit == 0) {
                alert('Qty Unit tidak boleh kosong!');
                $(this).val('');
                return false;
            } else {
                rumus_panel_lining(no);
            }
        }
    })

    function rumus_panel_lining(no) {
        type = $('#type_lining' + no).data('type');
        lebar = $('#lebar' + no).val() || 0;
        ovlKiri = $('#ovl_kiri-lining' + no).val() || 0;
        ovlTengah = $('#ovl_tengah-lining' + no).val() || 0;
        jh = $('#jahit_h-lining' + no).val() || 0;
        lbrKain = $('#lebar_kain-lining' + no).val() || 0;
        fullness = $('#fullness-lining' + no).val() || 0;

        if (type == 'panel') {
            let jml_panel = (parseInt(lebar) + parseInt(ovlKiri) +
                parseInt(ovlTengah) + parseInt(jh)) / parseInt(lbrKain) * (parseInt(fullness) / 100);
            $('#rumus_panel-lining' + no).val(jml_panel.toFixed(3));
            total_kain_lining(no);
        } else {
            total_kain_lining(no);
        }
    }

    function total_kain_lining(no) {
        type = $('#type_lining' + no).data('type');
        lebar = $('#lebar' + no).val() || 0;
        tinggi = $('#tinggi' + no).val() || 0;
        qty_unit = $('#qty_unit' + no).val() || 0;

        ovlKiri = $('#ovl_kiri-lining' + no).val() || 0;
        ovlTengah = $('#ovl_tengah-lining' + no).val() || 0;
        jh = $('#jahit_h-lining' + no).val() || 0;
        jv = $('#jahit_v-lining' + no).val() || 0;
        vr = $('#vertikal_repeat-lining' + no).val() || 0;
        fullness = $('#fullness-lining' + no).val() || 0;
        roundUp = $('#r_up_panel-lining' + no).val() || 0;
        // console.log(type)
        if (type == 'panel') {
            // let total_kain = (parseInt(roundUp) * ((parseInt(tinggi) + parseInt(jv)) / 100) * parseInt(qty_unit));
            let total_kain = (parseInt(roundUp) * (Math.ceil((parseInt(tinggi) + parseInt(jv)) / parseFloat(vr)) * (parseFloat(vr) / 100)) * parseInt(qty_unit));
            $('#t_kain-lining' + no).val(total_kain.toFixed(2));
            let t_harga_kain = $('#t_harga_kain-lining' + no).val().replace(/,/g, '') || 0;
            total_harga_kain = total_kain.toFixed(2) * parseInt(t_harga_kain);

            $('#total_harga_kain-lining' + no).val(('' + total_harga_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        } else {
            jmlKain = (((parseInt(lebar) + parseInt(ovlKiri) + parseInt(ovlTengah) + parseInt(jh)) * (parseInt(fullness) / 100)) / 100) * (parseInt(qty_unit));
            console.log(jmlKain)

            $('#t_kain-lining' + no).val(jmlKain.toFixed(1));
            let t_harga_kain = $('#t_harga_kain-lining' + no).val() || 0;
            if (t_harga_kain != 0) {
                total_harga_kain = jmlKain.toFixed(1) * parseInt(t_harga_kain.replace(/,/g, ''));
                $('#total_harga_kain-lining' + no).val(('' + total_harga_kain).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            }
        }
    }

    $(document).on('keyup paste change', '.disc_lining', function() {
        let no = $(this).data('id');
        let t_harga_kain = $('#total_harga_kain-lining' + no).val().replace(/,/g, '') || 0;
        let disc_lining = $(this).val() || 0;
        let val = countDiscLining(no);
        // console.log(val);
        if (val == false) {
            $(this).val('0');
            $('#t_disc_lining' + no).val('0');
        } else {
            t_disk = (parseInt(t_harga_kain) * (parseInt(disc_lining))) / 100;
            $('#t_disc_lining' + no).val(('' + t_disk.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            t_aft_disk = parseInt(t_harga_kain) - (parseInt(t_disk));
            $('#harga_aft_disc-lining' + no).val(('' + t_aft_disk).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

        let persen = 0;
        $('.persen_lining').each(function() {
            persen += Number($('.persen_lining').val());
        })
        $('#fee_pic-lining' + no).val(persen);

        disc = $('.persen_lining').val() || 0;
        id = $('.persen_lining').data("id");

        dis_lining = (parseInt(t_harga_kain) * (parseInt(disc_lining))) / 100;
        if (dis_lining == '') {
            t_disk = (parseInt(t_harga_kain));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(t_harga_kain) - (parseInt(dis_lining)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        if (val == false) {
            $('table#ComLining' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ' + val_disc);
            $('table#ComLining' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

    })

    $(document).on('change', '.pilihMainten-lining', function() {
        let no = $(this).data('id');
        mode = $(this).val();
        harga_kain = $('#harga_kain-lining' + no).val().replace(/,/g, '') || 0;
        diskon_fab = $('#disc_lining' + no).val() || 0;

        if (mode == 'yes') {
            $('#disc_mnt-lining' + no).val('5');
        } else {
            $('#disc_mnt-lining' + no).val('0');
        }

        let diskon_mnt = $('#disc_mnt-lining' + no).val();
        let val = countDiscLining(no);
        // alert(diskon_mnt)
        if (val == false) {
            $('#disc_mnt-lining' + no).val('0');
            $('#no_' + no).prop('checked', true);
        } else {
            dis_fab = (parseInt(harga_kain) * parseInt(diskon_fab)) / 100;
            afterDiscFab = parseInt(harga_kain) - parseInt(dis_fab);
            dis_mnt = (parseInt(afterDiscFab) * parseInt(diskon_mnt)) / 100;
            $('#disc_mnt_val-lining' + no).val(dis_mnt);

        }

    })

    // lining//
    $(document).on('change', '.persen_lining', function() {
        let no = $(this).parents('table').data('id');
        let disc_lining = $('#disc_lining' + no).val() || 0;
        let t_harga_kain_lining = $('#total_harga_kain-lining' + no).val().replace(/,/g, '') || 0;

        let persen = 0;
        $('.persen_lining').each(function() {
            persen += Number($(this).val() || 0);
        })
        $('#fee_pic-lining' + no).val(persen);

        disc = $(this).val() || 0;
        id = $(this).data("id");

        dis_lining = (parseInt(t_harga_kain_lining) * (parseInt(disc_lining))) / 100;
        if (dis_lining == '') {
            t_disk = (parseInt(t_harga_kain_lining));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(t_harga_kain_lining) - (parseInt(dis_lining)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        let val = countDiscLining(no);
        if (val == false) {
            $(this).val('0');
            $('table#ComLining' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ' + val_disc);
            $('table#ComLining' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }
    })

    $(document).on('change', '.value_lining', function() {
        let no = $(this).parents('table').data('id');
        let disc_lining = $('#disc_lining' + no).val() || 0;
        let t_harga_kain_lining = $('#total_harga_kain-lining' + no).val().replace(/,/g, '') || 0;
        let disMnt = $('#disc_mnt-lining' + no).val() || 0;

        id = $(this).data("id");
        disc = $(this).val().replace(/,/g, '');

        dis_lining = (parseInt(t_harga_kain_lining) * (parseInt(disc_lining))) / 100;
        if (dis_lining == '') {
            t_disk = (parseInt(t_harga_kain_lining));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        } else {
            t_disk = (parseInt(t_harga_kain_lining) - (parseInt(dis_lining)));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        }

        let val = countDiscLining(no);
        if (val == false) {
            $(this).val('0');
            $('table#ComLining' + no).find('input#persen_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#ComLining' + no).find('input#persen_' + id).val(Math.ceil(val_disc));
            let persen = 0;
            $('.persen').each(function() {
                persen += Number($('.persen_lining').val());
            })
            $('#fee_pic-lining' + no).val(persen);
            sumDisk = parseInt(disc_lining) + parseInt(disMnt) + parseInt(persen);
            $('#lining_disk' + no).val(sumDisk);

        }
        // let fee_pic = $('#fee_pic' + no).val() || 0;
    })

    function getSewingLining(no) {
        if ('<?= ($fabrics_lining->jahitan) ?>' != '') {
            var id_selected = '<?= $fabrics_lining->jahitan ?>';
        } else if ($('#jahitan-lining<?= $no ?>').val() != null || $('#jahitan-lining<?= $no ?>').val() != '') {
            var id_selected = $('#jahitan-lining<?= $no ?>').val();
        } else {
            var id_selected = '';
        }
        //console.log(id_selected);
        var column = 'id_sewing';
        var column_fill = '';
        var column_name = 'item';
        var table_name = 'sewing';
        var key = 'id_sewing';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {
                $('#jahitan-lining' + no).html(result.html);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });

    }

    $(document).on('change', '.jahitan-lining', function() {
        var no = $(this).data('id');
        var id_jahitan = $(this).val();
        $.ajax({
            type: 'POST',
            url: siteurl + 'quotation_proses/dataJahitan',
            data: {
                'id_jahitan': id_jahitan
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result['sewing']);
                $('#hrg_jahitan-lining' + no).val(result['sewing'].price.replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
                disc_jahitan_lining(no);
            },
            error: function() {
                alert('Ajax Error..!!!!!!');
            }
        })
    })

    $(document).on('change', '.pilihJahitan-lining', function() {
        var type = $(this).val();
        var no = $(this).data('id');
        changeJahitLining(type, no);
    })

    $(document).on('change', '.pilihRail-lining', function() {
        var type = $(this).val();
        var no = $(this).data('id');
        changeRailLining(no, type)
    });

    function changeRailLining(no, type) {
        var id_ruangan = $('#id_ruangan' + no).val();
        var id_quotation = $('#id_qtt').val();
        if (type == 'yes') {
            $.ajax({
                type: 'POST',
                url: siteurl + active_controller + 'get_rail_lining',
                data: {
                    'no': no,
                    'id_ruangan': id_ruangan,
                    'id_quotation': id_quotation
                },
                success: function(result) {
                    $("#dt_rail_lining" + no).html(result);
                    $(".select2").select2({
                        placeholder: "Choose An Option",
                        allowClear: true,
                        dropdownParent: $("#form-quotation")
                    });
                    // getRailLining(no);
                }
            })

        } else {
            $('#dt_rail_lining' + no).html('');
        }
    }

    function getRailLining(no) {
        if ('<?= ($fabrics_lining->rail_material) ?>' != null) {
            var id_selected = '<?= $fabrics_lining->rail_material ?>';
        } else if ($('#rail_material-lining<?= $no ?>').val() != null || $('#rail_material-lining<?= $no ?>').val() != '') {
            var id_selected = $('#rail_material-lining<?= $no ?>').val();
        } else {
            var id_selected = '';
        }
        //console.log(id_selected);
        var column = 'activation';
        var column_fill = 'aktif';
        var column_name = 'name_product';
        var table_name = 'mp_rail';
        var key = 'id_rail';
        var act = 'free';
        $.ajax({
            url: siteurl + active_controller + "getOpt",
            dataType: "json",
            type: 'POST',
            data: {
                id_selected: id_selected,
                column: column,
                column_fill: column_fill,
                column_name: column_name,
                table_name: table_name,
                key: key,
                act: act
            },
            success: function(result) {
                $('#rail_material-lining' + no).html(result.html);
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            }
        });

    }

    $(document).on('change', '.rail_material-lining', function() {
        let x = $(this).data('id');
        let id_rail = $(this).val();
        let lebar = $('#lebar' + x).val();
        let qty_unit = $('#qty_unit' + x).val();
        if (qty_unit == '') {
            alert("Qty Unit tidak boleh kosong!");
            return false;
        } else {
            if (lebar == '') {
                alert("Lebar jendela tidak boleh kosong!");
                return false;
            } else {
                $('#width_rail-lining' + x).val(lebar / 100);
                $('#window_width-lining' + x).val(lebar);
                $.ajax({
                    url: siteurl + active_controller + 'get_data_rail',
                    type: "POST",
                    dataType: "json",
                    data: {
                        id_rail: id_rail
                    },
                    success: function(result) {
                        // console.log(result['list'][0])
                        $('#price_rail-lining' + x).val(result['list'][0].act_selling_price)
                        t_hrga_rail = ((parseInt(result['list'][0].act_selling_price) * parseInt(lebar)) / 100) * parseInt(qty_unit);
                        $('#t_price_rail-lining' + x).val(("" + t_hrga_rail).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
                        $('#cust_rail_name-lining' + x).val(result['list'][0].name_product);

                        getBasicComponentLining(id_rail, x);
                        getAdditionalComponentLining(id_rail, x);
                        subtotal_rail_lining(x);
                        diskon_rail_lining(x);
                        total_rail_lining(x);
                    },
                    error: function() {
                        alert("Ajax Error..!!")
                    }
                })
            }
        }
    });

    function getBasicComponentLining(id_rail, x) {
        let width_rail = parseFloat($('#width_rail-lining' + x).val() || 0);

        $.ajax({
            url: siteurl + active_controller + 'get_baic_component',
            type: "POST",
            dataType: "json",
            data: {
                id_rail: id_rail,
                width_rail: width_rail
            },
            success: function(result) {
                data = result['list']
                // console.log(data.length)
                $('#basic_component-lining' + x + ' tbody tr').remove();
                for (var i = 0; i < data.length; i++) {
                    table =
                        '<tr>' +
                        '<td>' + data[i].name_component +
                        '<input type="hidden" name="bc_comp-lining[' + x + '][' + i + '][id_rail_basic]" data-id="' + data[i].id_rail_basic + '" value="' + data[i].id_rail_basic + '" >' +
                        '</td>' +
                        '<td>' + data[i].qty +
                        '<input type="hidden" style="width:100%" name="bc_comp-lining[' + x + '][' + i + '][qty]" value="' + data[i].qty + '" class="form-control text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                        '</td>' +
                        '<td>' + data[i].uom +
                        '<input type="hidden" style="width:100%" name="bc_comp-lining[' + x + '][' + i + '][uom]" value="' + data[i].uom + '" class="form-control text-right" placeholder="0">' +
                        '</td>' +
                        '</tr>';
                    $('#basic_component-lining' + x + ' tbody').append(table);
                };
            }
        })
    }

    function getAdditionalComponentLining(id_rail, x) {
        $.ajax({
            url: siteurl + active_controller + 'get_additional_component',
            type: "POST",
            dataType: "json",
            data: {
                id_rail: id_rail,
            },
            success: function(result) {
                data = result['list']
                // console.log(data.length)
                // $('#additional_comp_rail-lining' + x + ' tbody tr').remove();
                // for (var i = 0; i < data.length; i++) {
                //     table =
                //         '<tr>' +
                //         '<td>' + data[i].name_component +
                //         '<input type="hidden" name="addt_comp-lining[' + x + '][' + i + '][id_comp]" data-id="' + data[i].id_rail_add + '" value="' + data[i].id_rail_add + '" >' +
                //         '</td>' +
                //         '<td>' +
                //         '<input type="number" style="width:100%" name="addt_comp-lining[' + x + '][' + i + '][qty]" id="qty_' + data[i].id_rail_add + '" data-id="' + data[i].id_rail_add + '" class="qty_add_comp-lining form-control input-sm required text-right" placeholder="0" maxLength="3" min="0" max="100">' +
                //         '</td>' +
                //         '<td>' + data[i].uom +
                //         '<input type="hidden" style="width:100%" name="addt_comp-lining[' + x + '][' + i + '][uom]" value="' + data[i].uom + '" class="form-control text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' + ('' + data[i].selling_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',') +
                //         '<input type="hidden" style="width:100%" name="addt_comp-lining[' + x + '][' + i + '][price]" id="price_' + data[i].id_rail_add + '" value="' + data[i].selling_price + '"  class="form-control input-sm numberOnly nominal value text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' +
                //         '<input type="text" readonly style="width:100%" name="addt_comp-lining[' + x + '][' + i + '][t_price]" id="t_price_' + data[i].id_rail_add + '"  class="form-control input-sm numberOnly nominal value text-right" placeholder="0">' +
                //         '</td>' +
                //         '<td>' +
                //         '<a class="text-red hapus" href="javascript:void(0)" title="Hapus Item"><i class="fa fa-times"></i></a><span class="numbering"></span>' +
                //         '</td>' +
                //         '</tr>';
                //     $('#additional_comp_rail-lining' + x + ' tbody').append(table);
                // };
            }
        })
    }

    $(document).on('change input', '.qty_add_comp-lining', function() {
        let id = $(this).data('id');
        let no = $(this).parents('table').data('id');
        let qty = parseInt($(this).val());
        let price = parseInt($('#price_' + id).val().replace(/'/g, '') || 0);
        let t_price = qty * price;
        $('table#additional_comp_rail-lining' + no).find('input#t_price_' + id).val(('' + t_price).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        // console.log(t_price)
        var total_add_comp = 0;
        $('.t_price_add_comp-lining').each(function() {
            total_add_comp += Number($(this).val().replace(/,/g, '') || 0);
        })
        $('#total_add_comp_rail-lining' + no).val(('' + total_add_comp).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        subtotal_rail_lining(no);
        diskon_rail_lining(no);
        total_rail_lining(no);
    })

    function countDiscRailLining(no) {
        let disk = $(disc_cat).val();
        let disk2 = disk.replace(/%/g, '');
        let fee_pic = $('#fee_rail-lining' + no).val() || 0;
        let diskon_rail = $('#diskon_rail-lining' + no).val() || 0;

        sumDisk = parseInt(diskon_rail) + parseInt(fee_pic);
        $('#diskon_rail_lining' + no).val(sumDisk);
        if ($('#rail_material-lining' + no).val() == '' || $('#rail_material-lining' + no).val() == null) {
            alert('Pilih material rail terlebih dahulu!');
            return false;
        } else if (disk2 == 0 || disk2 == '') {
            alert('Discount Category tidak boleh 0.');
            return false;
        } else if (parseInt(sumDisk) > parseInt(disk2)) {
            alert('Diskon melebihi batas.');
            return false;
        } else {
            return true;
        }
    }

    $(document).on('keyup paste change', '.diskon_rail-lining', function() {
        let no = $(this).data('id');
        diskon_rail_lining(no);
        total_rail_lining(no);
    })

    function diskon_rail_lining(no) {
        let t_price_rail = $('#t_price_rail-lining' + no).val().replace(/,/g, '') || 0;
        let subtotal_rail = $('#subtotal_rail-lining' + no).val().replace(/,/g, '') || 0;
        let diskon_rail_lining = $('#diskon_rail-lining' + no).val() || 0;

        let val = countDiscRailLining(no);
        if (val == false) {
            $('#diskon_rail-lining' + no).val('0');
            $('#v_diskon_rail-lining' + no).val('0');
        } else {
            t_disk = (parseInt(subtotal_rail) * (parseInt(diskon_rail_lining))) / 100;
            $('#v_diskon_rail-lining' + no).val(('' + t_disk.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }

        let persen = 0;
        $('.persen_rail-lining').each(function() {
            persen += Number($('persen_rail-lining').val() || 0);
        })
        // console.log(persen);
        $('#fee_rail-lining' + no).val(persen);

        disc = $('.persen_rail-lining').val() || 0;
        id = $('.persen_rail-lining').data("id");

        dis_rail = (parseInt(subtotal_rail) * (parseInt(diskon_rail_lining))) / 100;
        if (dis_rail == '') {
            t_disk = (parseInt(subtotal_rail));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(subtotal_rail) - (parseInt(dis_rail)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        if (val == false) {
            // $(this).val('0');
            $('table#extComm_rail-lining' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#extComm_rail-lining' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }
    }

    $(document).on('change', '.persen_rail-lining', function() {
        let no = $(this).parents('table').data('id');
        let disc_rail_lining = $('#diskon_rail-lining' + no).val() || 0;
        let subtotal_rail_lining = $('#subtotal_rail-lining' + no).val().replace(/,/g, '') || 0;

        let persen = 0;
        $('.persen_rail-lining').each(function() {
            persen += Number($(this).val());
        })
        $('#fee_rail-lining' + no).val(persen);
        let fee_pic = $('#fee_rail-lining' + no).val() || 0;

        disc = $(this).val() || 0;
        id = $(this).data("id");

        dis_lining = (parseInt(subtotal_rail_lining) * (parseInt(disc_rail_lining))) / 100;
        if (dis_lining == '') {
            t_disk = (parseInt(subtotal_rail_lining));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        } else {
            t_disk = (parseInt(subtotal_rail_lining) - (parseInt(dis_lining)));
            val_disc = (parseInt(t_disk) * parseInt(disc) / 100);
        }

        // console.log(subtotal_rail_lining + "," + dis_lining + "," + val_disc + "," + t_disk)

        let val = countDiscRailLining(no);
        if (val == false) {
            $(this).val('0');
            $('table#extComm_rail-lining' + no).find('input#value_' + id).val('0');
        } else {
            // alert('total fee adalah : ' + val_disc);
            $('table#extComm_rail-lining' + no).find('input#value_' + id).val(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
        }
    })

    $(document).on('change', '.value_rail-lining', function() {
        let no = $(this).parents('table').data('id');
        let disc_rail_lining = $('#diskon_rail-lining' + no).val() || 0;
        let subtotal_rail_lining = $('#subtotal_rail-lining' + no).val().replace(/,/g, '') || 0;
        id = $(this).data("id");

        disc = $(this).val().replace(/,/g, '');

        dis_rail = (parseInt(subtotal_rail_lining) * (parseInt(disc_rail_lining))) / 100;
        if (dis_rail == '') {
            t_disk = (parseInt(subtotal_rail_lining));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        } else {
            t_disk = (parseInt(subtotal_rail_lining) - (parseInt(dis_rail)));
            val_disc = (parseInt(disc) / parseInt(t_disk)) * 100;
        }

        let val = countDiscRailLining(no);
        if (val == false) {
            $(this).val('0');
            $('table#extComm_rail-lining' + no).find('input#persen_' + id).val('0');
        } else {
            // alert('total fee adalah : ');
            $('table#extComm_rail-lining' + no).find('input#persen_' + id).val(Math.ceil(val_disc));
            let persen = 0;
            $('.persen').each(function() {
                persen += Number($('.persen_rail-lining').val());
            })
            // $('#extComm_rail-lining' + no).val(persen);
        }
        // let fee_pic = $('#fee_pic' + no).val() || 0;
    })



    // ===============================================================================================================
    // ACCESSORIESS
    // ===============================================================================================================

    $(document).on('change', '.switch-accessories', function() {
        var no = $(this).data('id');
        var id_accessories = $('#id_qtt').val();
        if ($('div.accessories-switch' + no + ' input[type="checkbox"]').is(":checked")) {
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: siteurl + active_controller + 'addaccessories',
                    data: {
                        'no': no,
                        'id_accessories': id_accessories
                    },
                    success: function(result) {
                        $(".box-accessories" + no).html(result);
                        $(".select2").select2({
                            placeholder: "Choose An Option",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: $("#form-quotation")
                        });
                        // getLining(no);
                        // getSewingLining(no);
                        $('.accessories-box' + no).removeClass('collapsed-box');
                    }
                })
            }, 200);
        } else {
            $(".box-accessories" + no).html('');
            $('.accessories-box' + no).addClass('collapsed-box');
        }
    })

    $(document).on('change', '.qty_acc', function() {
        let no = $(this).parents('table').data('id');
        id = $(this).data('id');
        qty = $(this).val() || 0;

        let price = $('#price_acc' + id).val().replace(/,/g, '') || 0;
        let disc = $('#disc_acc' + id).val() || 0;
        // let v_disc = $('#v_disc_acc' + id).val().replace(/,/g, '') || 0;

        sub_price = parseInt(price) * parseInt(qty);
        val_disc = (parseInt(sub_price) * parseInt(disc)) / 100;
        t_price_acc = (parseInt(sub_price) - (parseInt(sub_price) * parseInt(disc)) / 100);
        // console.log(t_price_acc)
        if (sub_price == '') {
            disc_acc = sub_price;
            $(this).val('0');
            $('table#accProduct' + no).find('input#sub_price_acc' + id).val('0');
            $('table#accProduct' + no).find('input#v_disc_acc' + id).val('0');
            $('table#accProduct' + no).find('input#t_price_acc' + id).val('0');
            $('table#accProduct' + no).find('span.sub_price_acc' + id).text('0');
            $('table#accProduct' + no).find('span.v_disc_acc' + id).text('0');
            $('table#accProduct' + no).find('span.t_price_acc' + id).text('0');
        } else {
            $('table#accProduct' + no).find('input#sub_price_acc' + id).val(sub_price.toFixed());
            $('table#accProduct' + no).find('input#v_disc_acc' + id).val(val_disc.toFixed());
            $('table#accProduct' + no).find('input#t_price_acc' + id).val(t_price_acc.toFixed());
            $('table#accProduct' + no).find('span.sub_price_acc' + id).text(('' + sub_price.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            $('table#accProduct' + no).find('span.v_disc_acc' + id).text(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            $('table#accProduct' + no).find('span.t_price_acc' + id).text(('' + t_price_acc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

        }


    })

    $(document).on('change', '.disc_acc', function() {
        let no = $(this).parents('table').data('id');
        id = $(this).data('id');
        disc = $(this).val() || 0;

        let sub_price = $('#sub_price_acc' + id).val().replace(/,/g, '') || 0;
        let qty = $('#qty_acc' + id).val() || 0;
        // let v_disc = $('#v_disc_acc' + id).val().replace(/,/g, '') || 0;


        val_disc = (parseInt(sub_price) * parseInt(disc)) / 100;
        t_price_acc = (parseInt(sub_price) - (parseInt(sub_price) * parseInt(disc)) / 100);
        // console.log(t_price_acc)
        if (sub_price == '') {
            disc_acc = sub_price;
            $(this).val('0');
            $('table#accProduct' + no).find('input#v_disc_acc' + id).val('0');
            $('table#accProduct' + no).find('span.t_price_acc' + id).text('0');
            $('table#accProduct' + no).find('span.v_disc_acc' + id).text('0');
            $('table#accProduct' + no).find('span.t_price_acc' + id).text('0');
        } else {

            $('table#accProduct' + no).find('input#v_disc_acc' + id).val(val_disc.toFixed());
            $('table#accProduct' + no).find('input#t_price_acc' + id).val(t_price_acc.toFixed());
            $('table#accProduct' + no).find('span.v_disc_acc' + id).text(('' + val_disc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
            $('table#accProduct' + no).find('span.t_price_acc' + id).text(('' + t_price_acc.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

        }


    })

    $(document).on('click', 'a.hapus', function() {
        $(this).parents('tbody tr').remove();
        // alert('s');
    })

    $(document).on('click', 'a.del_jendela', function() {
        $(this).parents('div.form-horizontal').remove();
        // alert('s');
    })

    $(document).on('input paste keyup', '.persen,.persen_lining,.persen_rail,.persen_rail-lining,.persen_rail-vitrage,.persen_vitrage', function() {
        var nilai = $(this).val();
        max = 100;
        if (nilai > max) {
            alert("input tidak boleh melebihi 100%");
            $(this).val('');
        }
    })
</script>