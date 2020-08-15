<form class="" id="form-quotation" action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="type" class="form-control" value="<?= !empty($data->payment_term) ? 'edit' : 'add' ?>">
  <div class=" box-solid">
    <div class="box-header">
      <table id="my-grid3" class="table-condensed" width="100%">
        <thead>
          <tr>
            <th class="text">CUSTOMER DATA INFORMATION</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <table width="100%" class="-condensed">
            <tbody>
              <tr>
                <td width="30%">
                  <label>Quotation Number</label>
                </td>
                <td>: <?= $data->nomor ?></td>
                <input type="hidden" name="nomor" value="<?= $data->nomor ?>">
                <input type="hidden" name="id_quotation" value="<?= $data->id ?>">
              </tr>
              <tr>
                <td>
                  <label>Customer</label>
                </td>
                <td>: <?= $customer->name_customer ?></td>
              </tr>
              <tr>
                <td>
                  <label>PIC</label>
                </td>
                <td>: <?= $pic_cust->name_pic ?></td>
              </tr>
              <tr>
                <td>
                  <label>Address</label>
                </td>
                <td>: <?= $customer->address_office ?></td>
              </tr>
              <tr>
                <td>
                  <label>Category Customer</label>
                </td>
                <td>: <?= $cat_cust->name_category_customer ?></td>
              </tr>
              <tr>
                <td>
                  <label>Discount Category</label>
                </td>
                <td>: <?= $disc_cat->name_cat ?> (<?= $data->val_disc_cat != '' ? $data->val_disc_cat . '%' : '' ?>)</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-6">
          <table width="100%" class="-condensed">
            <tbody>
              <tr>
                <td width="30%">
                  <label>Date</label>
                </td>
                <td>: <?= $data->date ?></td>
              </tr>
              <tr>
                <td>
                  <label>Category Sales</label>
                </td>
                <td>: <?= $data->sales_category ?></td>
              </tr>
              <tr>
                <td>
                  <label>Type Project</label>
                </td>
                <td>: <?= $type_pro->nm_type_project ?></td>
              </tr>
              <tr>
                <td>
                  <label>Marketing</label>
                </td>
                <td>: <?= $karyawan->nama_karyawan ?></td>
              </tr>
              <tr>
                <td>
                  <label>Nett Price / PPN</label>
                </td>
                <td>: <?= $data->net == '0' ? 'No' : 'Yes' ?> / <?= $data->ppn == '0' ? 'No' : 'Yes' ?></td>
              </tr>
              <tr>
                <td>
                  <label>Project Name</label>
                </td>
                <td>: <?= $data->project_name ?></td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
      <hr>
      <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group row">
              <label for="input" class="col-sm-2">Payment Term</label>
              <div class="col-sm-9">
                <select name="payment_term" onchange="myFunction()" id="paymentTerm" class="select2 required form-control paymentTerm">
                  <option value=""></option>
                  <option value="CA" <?= $data->payment_term == "CA" ? 'selected' : '' ?>>Cash in Advance</option>
                  <option value="TM" <?= $data->payment_term == "TM" ? 'selected' : '' ?>>Termin</option>
                </select>
                <div class="detailPayterm">
                  <?php if ($data->payment_term == 'TM') : ?>
                    <table width="100%" class="table-condensed table-bordered">
                      <thead>
                        <tr class="bg-gray">
                          <th width="20px">No</th>
                          <th>Requirements</th>
                          <th width="150px" class="text-right">Value</th>
                          <th width="80px" class="text-right">%</th>
                          <th>Notes</th>
                          <th width="20px">#</th>
                        </tr>
                      </thead>
                      <tbody class="list-termin">
                        <?php $no = 0;
                        foreach ($pay_term as $pt) : $no++ ?>
                          <tr>
                            <td><?= $no ?></td>
                            <td><input type="text" value="<?= $pt->requirement ?>" class="form-control required" name="termin[<?= $no ?>][requirement]" placeholder="Requirements"></td>
                            <td class="text-right"><input type="text " value="<?= number_format($pt->value) ?>" class="form-control nominal numberOnly text-right" name="termin[<?= $no ?>][value]" placeholder="0"></td>
                            <td class="text-right"><input type="number" min="0" max="100" value="<?= $pt->percent ?>" class="form-control text-right" name="termin[<?= $no ?>][percent]" placeholder="0"></td>
                            <td><input type="text" value="<?= $pt->notes ?>" class="form-control" name="termin[<?= $no ?>][notes]" placeholder="0"></td>
                            <td><button type="button" class="btn btn-sm btn-danger hapusTermin">x</button></td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                    <button type="button" class="btn btn-sm addTermin btn-success" id="addTermin">Add Termin</button>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>


      <!-- ================================ DETAIL JENDELA ==========================================  -->

      <div class="box box-solid">
        <table id="my-grid3" class="table-condensed" width="100%">
          <thead>
            <tr>
              <th class="text">DETAIL DATA ORDER</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="box-body">
        <?php
        $no = 0;
        foreach ($rooms as $room) {
          $no++;
        ?>
          <legend><label>Deskripsi Jendela[<?= $no ?>]</label></legend>
          <div class="row">
            <div class="col-md-6">
              <table width="100%">
                <tr>
                  <td width="25%"><label>Ruangan</label></td>
                  <td>: <?= $room->name_room ?></td>
                </tr>
                <tr>
                  <td><label>Lantai</label></td>
                  <td>: <?= $room->floor ?></td>
                </tr>
                <tr>
                  <td><label>Jendela</label></td>
                  <td>: <?= $room->window ?></td>
                </tr>
                <tr>
                  <td><label>Lebar</label></td>
                  <td>: <?= $room->width_window ?> cm</td>
                </tr>
                <tr>
                  <td><label>Tinggi</label></td>
                  <td>: <?= $room->height_window ?> cm</td>
                </tr>
                <tr>
                  <td><label>Qty Unit</label></td>
                  <td>: <?= $room->qty_unit ?> pcs</td>
                </tr>
                <tr>
                  <td><label>Installation</label></td>
                  <td>: <?= ucfirst($room->installation) ?></td>
                </tr>
              </table>
            </div>
          </div>
          <br>
      </div>

      <!-- CURTAIN -->
      <?php
          $qttCurtain = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $data->id, 'item' => 'curtain'])->row();

          if ($qttCurtain) { ?>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4 class="box-title"><label> Curtain</label></h4>
          </div>
          <div class="box-body">
            <table width="100%" class="table-bordered table-condensed table-striped">
              <thead>
                <tr class="bg-primary">
                  <th width="20%" class="text-center">Item Code</th>
                  <th width="5%" class="text-center">Buka Arah</th>
                  <th width="5%" class="text-center">Panel</th>
                  <th width="5%" class="text-center">Qty/Unit (m)</th>
                  <th width="9%" class="text-center">Price(m)</th>
                  <th width="9%" class="text-center">Total Price</th>
                  <th width="7%" class="text-center">Discount(%)</th>
                  <th width="15%" class="text-center">Total</th>
                  <th width="10%" class="text-center">Status</th>
                  <th width="" class="text-center">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="10"><label for="">Curtain Material</label></td>
                </tr>
                <tr>
                  <td>
                    <?php
                    $curtain = $this->db->get_where('master_product_fabric', ['id_product' => $qttCurtain->id_product])->row();
                    $t_hrg_kain = ($qttCurtain->harga_kain * $qttCurtain->t_kain) * $qttCurtain->qty;
                    $total = $t_hrg_kain - ($t_hrg_kain * $qttCurtain->disc_persen / 100);
                    ?>
                    <label><?= $curtain->id_product ?></label><br>
                    <label><?= $curtain->name_product ?></label><br>
                    Width : <?= $curtain->width ?> cm<br>
                    Weight : <?= $curtain->weight ?> cm<br>
                    Content : <?= $curtain->content_percent ?>
                  </td>
                  <td style="vertical-align:top" class="text-center"><?= $qttCurtain->bukaan ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttCurtain->round_up ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttCurtain->t_kain ?> m</td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($qttCurtain->harga_kain) ?></td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($t_hrg_kain) ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttCurtain->disc_persen ? $qttCurtain->disc_persen : '0' ?>%</td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($total) ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $curtain->product_status ?></td>
                  <td style="vertical-align:top"><?= $qttCurtain->keterangan ?></td>
                </tr>
                <tr>
                  <td colspan="10"><label for="">Rail Curtain</label></td>
                </tr>
                <?php
                $rail = $this->db->get_where('mp_rail', ['id_rail' => $qttCurtain->rail_material])->row();
                $total_rail = $qttCurtain->t_price - ($qttCurtain->t_price * $qttCurtain->diskon_rail / 100);
                // echo "<pre>";
                // print_r($qttCurtain->width);
                // echo "<pre>";
                // exit;
                ?>
                <tr>
                  <td><?= $rail->id_rail . " - " . $rail->name_product ?></td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><?= $qttCurtain->width ?></td>
                  <td class="text-right"><?= number_format($qttCurtain->price) ?></td>
                  <td class="text-right"><?= number_format($qttCurtain->t_price) ?></td>
                  <td class="text-center"><?= $qttCurtain->diskon_rail ? number_format($qttCurtain->diskon_rail) : '0' ?>%</td>
                  </td>
                  <td class="text-right"><?= number_format($total_rail) ?></td>
                  <td class="text-center"><?= $rail->status_wh ?></td>
                  <td class=""><?= $qttCurtain->ket_rail ?></td>
                </tr>
                <tr>
                  <td colspan="10"><label for="">Additional Component</label></td>
                </tr>
                <?php

                $this->db->select('a.*,c.name_component');
                $this->db->from('qtt_additional_comp_rail a');
                $this->db->join('mp_rail_additional b', 'a.id_additional_comp = b.id_rail_add');
                $this->db->join('master_component c', 'b.id_component = c.id');
                $this->db->where(['a.section' => $no, 'a.id_quotation' => $qttCurtain->id_quotation, 'a.item' => 'curtain']);
                $additionalComponent = $this->db->get()->result();
                foreach ($additionalComponent as $addComp) {
                  // exit;
                ?>
                  <tr>
                    <td>
                      <?= $addComp->id_additional_comp . ' - ' . $addComp->name_component ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><?= $addComp->qty ?></td>
                    <td class="text-right"><?= number_format($addComp->selling_price) ?></td>
                    <td class="text-right"><?= number_format($addComp->t_price) ?></td>
                    <td class="text-center"><?= '0' ?>%</td>
                    </td>
                    <td class="text-right"><?= number_format($addComp->t_price) ?></td>
                    <td class="text-center"></td>
                    <td class=""></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="10"><label for="">Jahitan</label></td>
                </tr>
                <?php
                $jahitan = $this->db->get_where('sewing', ['id_sewing' => $qttCurtain->jahitan])->row();
                $total_jahit = $qttCurtain->hrg_jahitan * $qttCurtain->t_kain;
                $gtotal_jahitan = $total_jahit - ($total_jahit * $qttCurtain->disc_jahitan / 100);
                ?>
                <tr>
                  <td><?= $jahitan->item ?></td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><?= $qttCurtain->t_kain ?></td>
                  <td class="text-right"><?= $qttCurtain->hrg_jahitan ? number_format($qttCurtain->hrg_jahitan) : '' ?></td>
                  <td class="text-right"><?= $total_jahit ? number_format($total_jahit) : '0' ?></td>
                  <td class="text-center"><?= $qttCurtain->disc_jahitan ? $qttCurtain->disc_jahitan : '0' ?>%</td>
                  <td class="text-right"><?= $gtotal_jahitan ? number_format($gtotal_jahitan) : '' ?></td>
                  <td class="text-right"></td>
                  <td class="text-right"></td>
                </tr>
              </tbody>
            </table>
            <br>

            <div class="form-horizontal">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Total </label>
                <div class="col-sm-3">
                  <div class="input-group">
                    <?php
                    $af = $this->db->get_where('qtt_air_freight', ['id_ruangan' => $room->id_ruangan, 'item' => 'curtain'])->row();
                    ?>
                    <input type="text" data-id="<?= $no ?>" readonly id="t_kain_curtain<?= $no ?>" class="form-control" name="curtain[<?= $no ?>][t_kain_curtain]" value="<?= $qttCurtain->t_kain ?>">
                    <div class="input-group-addon">x</div>
                    <div class="input-group-addon">Rp.</div>
                    <input type="text" data-id="<?= $no ?>" id="air_freight_curtain<?= $no ?>" value="<?= $af != '' ? number_format($af->air_freight) : '' ?>" class="form-control nominal numberOnly air_freight_curtain text-right air_freight" name="curtain[<?= $no ?>][air_freight_curtain]" placeholder="0">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Air Freight Curtain</label>
                <div class="col-sm-3">
                  <input type="hidden" name="curtain[<?= $no ?>][id_ruangan]" value="<?= $room->id_ruangan ?>">
                  <input type="text" readonly value="<?= $af != '' ? number_format($af->total_air_freight) : '' ?>" class="form-control text-right nominal numberOnly required total_af" name="curtain[<?= $no ?>][t_air_freight_curtain]" id="t_air_freight_curtain<?= $no ?>" placeholder="0">
                </div>
              </div>

            </div>
          </div>
        </div>
        <br>
      <?php
          }
      ?>

      <!-- LINING -->
      <?php
          $qttLining = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan, 'item' => 'lining'])->row();
          if ($qttLining) { ?>
        <div class="box box-info">
          <div class="box-header with-border">
            <h4 class="box-title"><label> Lining</label></h4>
          </div>
          <div class="box-body">
            <table width="100%" class="table-bordered table-condensed table-striped">
              <thead>
                <tr class="bg-primary">
                  <th width="20%" class="text-center">Item Code</th>
                  <th width="5%" class="text-center">Buka Arah</th>
                  <th width="5%" class="text-center">Panel</th>
                  <th width="5%" class="text-center">Qty/Unit (m)</th>
                  <th width="9%" class="text-center">Price(m)</th>
                  <th width="9%" class="text-center">Total Price</th>
                  <th width="7%" class="text-center">Discount(%)</th>
                  <th width="15%" class="text-center">Total</th>
                  <th width="10%" class="text-center">Status</th>
                  <th width="" class="text-center">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="10"><label for="">Lining Material</label></td>
                </tr>
                <tr>
                  <td>
                    <?php
                    $lining = $this->db->get_where('master_product_fabric', ['id_product' => $qttLining->id_product])->row();
                    $t_hrg_kain = ($qttLining->harga_kain * $qttLining->t_kain) * $qttLining->qty;
                    $total = $t_hrg_kain - ($t_hrg_kain * $qttLining->disc_persen / 100);
                    ?>
                    <label><?= $lining->id_product ?></label><br>
                    <label><?= $lining->name_product ?></label><br>
                    Width : <?= $lining->width ?> cm<br>
                    Weight : <?= $lining->weight ?> cm<br>
                    Content : <?= $lining->content_percent ?>
                  </td>
                  <td style="vertical-align:top" class="text-center"><?= $qttLining->bukaan ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttLining->round_up ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttLining->t_kain ?> m</td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($qttLining->harga_kain) ?></td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($t_hrg_kain) ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttLining->disc_persen ?>%</td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($total) ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $lining->product_status ?></td>
                  <td style="vertical-align:top"><?= $qttLining->keterangan ?></td>
                </tr>
                <tr>
                  <td colspan="10"><label for="">Rail Lining</label></td>
                </tr>
                <?php
                $rail = $this->db->get_where('mp_rail', ['id_rail' => $qttLining->rail_material])->row();
                $total_rail = $qttLining->t_price  - ($qttLining->t_price * $qttLining->diskon_rail / 100);
                ?>
                <tr>
                  <td><?= $rail->id_rail . ' - ' . $rail->name_product ?></td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><?= $qttLining->width ?></td>
                  <td class="text-right"><?= number_format($qttLining->price) ?></td>
                  <td class="text-right"><?= number_format($qttLining->t_price) ?></td>
                  <td class="text-center"><?= number_format($qttLining->diskon_rail) ?>%</td>
                  <td class="text-right"><?= number_format($total_rail) ?></td>
                  <td class="text-center"><?= $rail->status_wh ?></td>
                  <td class=""><?= $qttLining->ket_rail ?></td>
                </tr>
                <tr>
                  <td colspan="10"><label for="">Additional Component</label></td>
                </tr>
                <?php

                $this->db->select('a.*,c.name_component');
                $this->db->from('qtt_additional_comp_rail a');
                $this->db->join('mp_rail_additional b', 'a.id_additional_comp = b.id_rail_add');
                $this->db->join('master_component c', 'b.id_component = c.id');
                $this->db->where(['a.section' => $no, 'a.id_quotation' => $qttCurtain->id_quotation, 'a.item' => 'lining']);
                $addCompLining = $this->db->get()->result();
                foreach ($addCompLining as $cl) {
                  // exit;
                ?>
                  <tr>
                    <td>
                      <?= $cl->id_additional_comp . ' - ' . $cl->name_component ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><?= $cl->qty ?></td>
                    <td class="text-right"><?= number_format($cl->selling_price) ?></td>
                    <td class="text-right"><?= number_format($cl->t_price) ?></td>
                    <td class="text-center"><?= '0' ?>%</td>
                    </td>
                    <td class="text-right"><?= number_format($cl->t_price) ?></td>
                    <td class="text-center"></td>
                    <td class=""></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="10"><label for="">Jahitan</label></td>
                </tr>
                <?php
                $jahitan = $this->db->get_where('sewing', ['id_sewing' => $qttLining->jahitan])->row();
                $total_jahit = $qttLining->hrg_jahitan * $qttLining->t_kain;
                $gtotal_jahit = $total_jahit - ($total_jahit * $qttLining->disc_jahitan / 100);
                ?>
                <tr>
                  <td><?= $jahitan->item ?></td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><?= $qttLining->t_kain ?></td>
                  <td class="text-right"><?= number_format($qttLining->hrg_jahitan) ?></td>
                  <td class="text-right"><?= number_format($total_jahit) ?></td>
                  <td class="text-center"><?= number_format($qttLining->disc_jahitan) ?>%</td>
                  <td class="text-right"><?= number_format($gtotal_jahit) ?></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
            <br>

            <div class="form-horizontal">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Total </label>
                <div class="col-sm-3">
                  <div class="input-group">
                    <?php
                    $afl = $this->db->get_where('qtt_air_freight', ['id_ruangan' => $room->id_ruangan, 'item' => 'lining'])->row();
                    ?>
                    <input type="text" data-id="<?= $no ?>" readonly id="t_kain_lining<?= $no ?>" class="form-control" name="lining[<?= $no ?>][t_kain_lining]" value="<?= $qttLining->t_kain  ?>">
                    <div class="input-group-addon">x</div>
                    <div class="input-group-addon">Rp.</div>
                    <input type="text" data-id="<?= $no ?>" id="air_freight_lining<?= $no ?>" value="<?= $afl != '' ? number_format($afl->air_freight) : '' ?>" class="air_freight form-control nominal numberOnly air_freight_lining text-right" name="lining[<?= $no ?>][air_freight_lining]" placeholder="0">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Air Freight Lining</label>
                <div class="col-sm-3">
                  <input type="hidden" name="lining[<?= $no ?>][id_ruangan]" value="<?= $room->id_ruangan ?>">
                  <input type="text" readonly value="<?= $afl != '' ? number_format($afl->total_air_freight) : '' ?>" class="total_af form-control text-right required" name="lining[<?= $no ?>][t_air_freight_lining]" id="t_air_freight_lining<?= $no ?>" placeholder="0">
                </div>
              </div>

            </div>
            <br>
          </div>
        </div>
        <br>
      <?php
          }
      ?>

      <!-- VITRAGE -->
      <?php
          $qttVitrage = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $data->id, 'item' => 'vitrage'])->row();
          if ($qttVitrage) { ?>
        <div class="box box-warning">
          <div class="box-header with-border">
            <h4 class="box-title"><label> Vitrage</label></h4>
          </div>
          <div class="box-body">
            <table width="100%" class="table-bordered table-condensed table-striped">
              <thead>
                <tr class="bg-primary">
                  <th width="20%" class="text-center">Item Code</th>
                  <th width="5%" class="text-center">Buka Arah</th>
                  <th width="5%" class="text-center">Panel</th>
                  <th width="5%" class="text-center">Qty/Unit (m)</th>
                  <th width="9%" class="text-center">Price(m)</th>
                  <th width="9%" class="text-center">Total Price</th>
                  <th width="7%" class="text-center">Discount(%)</th>
                  <th width="15%" class="text-center">Total</th>
                  <th width="10%" class="text-center">Status</th>
                  <th width="" class="text-center">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="10"><label for=""> Vitrage Material</label></td>
                </tr>
                <tr>
                  <td>
                    <?php
                    $vitrage = $this->db->get_where('master_product_fabric', ['id_product' => $qttVitrage->id_product])->row();
                    $t_hrg_kain = ($qttVitrage->harga_kain * $qttVitrage->t_kain) * $qttVitrage->qty;
                    $total = $t_hrg_kain - ($t_hrg_kain * $qttVitrage->disc_persen / 100);
                    ?>
                    <label><?= $vitrage->id_product ?></label><br>
                    <label><?= $vitrage->name_product ?></label><br>
                    Width : <?= $vitrage->width ?> cm<br>
                    Weight : <?= $vitrage->weight ?> cm<br>
                    Content : <?= $vitrage->content_percent ?>
                  </td>
                  <td style="vertical-align:top" class="text-center"><?= $qttVitrage->bukaan ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttVitrage->round_up ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttVitrage->t_kain ?> m</td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($qttVitrage->harga_kain) ?></td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($t_hrg_kain) ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $qttVitrage->disc_persen ?>%</td>
                  <td style="vertical-align:top" class="text-right"><?= number_format($total) ?></td>
                  <td style="vertical-align:top" class="text-center"><?= $vitrage->product_status ?></td>
                  <td style="vertical-align:top"><?= $qttVitrage->keterangan ?></td>
                </tr>
                <tr>
                  <td colspan="10"><label for="">Rail Vitrage</label></td>
                </tr>
                <?php
                $rail = $this->db->get_where('mp_rail', ['id_rail' => $qttVitrage->rail_material])->row();
                $total_rail = $qttVitrage->price - ($qttVitrage->price * $qttVitrage->diskon_rail / 100);
                ?>
                <tr>
                  <td><?= $rail->id_rail . ' - ' . $rail->name_product ?></td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><?= $qttVitrage->width ?></td>
                  <td class="text-right"><?= number_format($qttVitrage->price) ?></td>
                  <td class="text-right"><?= number_format($qttVitrage->t_price) ?></td>
                  <td class="text-center"><?= number_format($qttVitrage->diskon_rail) ?>%</td>
                  <td class="text-right"><?= number_format($total_rail) ?></td>
                  <td class="text-center"><?= $rail->status_wh ?></td>
                  <td class=""><?= $qttVitrage->ket_rail ?></td>
                </tr>
                <tr>
                  <td colspan="10"><label for="">Additional Component</label></td>
                </tr>
                <?php

                $this->db->select('a.*,c.name_component');
                $this->db->from('qtt_additional_comp_rail a');
                $this->db->join('mp_rail_additional b', 'a.id_additional_comp = b.id_rail_add');
                $this->db->join('master_component c', 'b.id_component = c.id');
                $this->db->where(['a.section' => $no, 'a.id_quotation' => $qttCurtain->id_quotation, 'a.item' => 'vitrage']);
                $addCompVitrage = $this->db->get()->result();
                foreach ($addCompVitrage as $cv) {
                  // exit;
                ?>
                  <tr>
                    <td>
                      <?= $cv->id_additional_comp . ' - ' . $cv->name_component ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><?= $cv->qty ?></td>
                    <td class="text-right"><?= number_format($cv->selling_price) ?></td>
                    <td class="text-right"><?= number_format($cv->t_price) ?></td>
                    <td class="text-center"><?= '0' ?>%</td>
                    </td>
                    <td class="text-right"><?= number_format($cv->t_price) ?></td>
                    <td class="text-center"></td>
                    <td class=""></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="10"><label for="">Jahitan</label></td>
                </tr>
                <?php
                $jahitan = $this->db->get_where('sewing', ['id_sewing' => $qttVitrage->jahitan])->row();
                $total_jahit_v = $qttVitrage->hrg_jahitan * $qttVitrage->t_kain;
                $gtotal_jahitan_v = $total_jahit_v - ($total_jahit_v * $qttVitrage->disc_jahitan / 100);

                ?>
                <tr>
                  <td><?= $jahitan->item ?></td>
                  <td class="text-right"></td>
                  <td class="text-right"></td>
                  <td class="text-center"><?= $qttVitrage->t_kain ?></td>
                  <td class="text-right"><?= number_format($qttVitrage->hrg_jahitan) ?></td>
                  <td class="text-right"><?= number_format($total_jahit_v) ?></td>
                  <td class="text-center"><?= number_format($qttVitrage->disc_jahitan) ?>%</td>
                  <td class="text-right"><?= number_format($gtotal_jahitan_v) ?></td>
                  <td class="text-right"></td>
                  <td class="text-right"></td>
                </tr>
              </tbody>
            </table>
            <br>


            <div class="form-horizontal">

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Total </label>
                <div class="col-sm-3">
                  <div class="input-group">
                    <?php
                    $afv = $this->db->get_where('qtt_air_freight', ['id_ruangan' => $room->id_ruangan, 'item' => 'vitrage'])->row();
                    ?>
                    <input type="text" data-id="<?= $no ?>" readonly id="t_kain_vitrage<?= $no ?>" class="form-control" name="vitrage[<?= $no ?>][t_kain_vitrage]" value="<?= $qttVitrage->t_kain ?>">
                    <div class="input-group-addon">x</div>
                    <div class="input-group-addon">Rp.</div>
                    <input type="text" data-id="<?= $no ?>" id="air_freight_vitrage<?= $no ?>" value="<?= $afv != '' ? number_format($afv->air_freight) : '' ?>" class="air_freight form-control nominal numberOnly air_freight_vitrage text-right" name="vitrage[<?= $no ?>][air_freight_vitrage]" placeholder="0">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Air Freight Vitrage</label>
                <div class="col-sm-3">
                  <input type="hidden" name="vitrage[<?= $no ?>][id_ruangan]" value="<?= $room->id_ruangan ?>">
                  <input type="text" readonly value="<?= $afv != '' ? number_format($afv->total_air_freight) : '' ?>" class="form-control text-right required total_af" name="vitrage[<?= $no ?>][t_air_freight_vitrage]" id="t_air_freight_vitrage<?= $no ?>" placeholder="0">
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
      <?php
          }
      ?>

      <!-- ACCESSORIESS -->
      <?php
          $qttAcc = $this->db->get_where('qtt_accessoriess', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $data->id])->result();
          if ($qttAcc) { ?>
        <div class="box box-danger">
          <div class="box-header with-border">
            <h4 class="box-title">
              <label> Accessoriess</label>
            </h4>
          </div>
          <div class="box-body">
            <table width="100%" class="table-bordered table-condensed table-striped">
              <thead>
                <tr class="bg-primary">
                  <th width="">Item Code</th>
                  <th width="5%" class="text-center">Qty/m</th>
                  <th width="12%" class="text-right">Price</th>
                  <th width="12%" class="text-right">Subtotal</th>
                  <th width="5%" class="text-right">Disc.</th>
                  <th width="12%" class="text-right">Total Disc.</th>
                  <th width="12%" class="text-right">Total</th>
                </tr>
              </thead>
              <?php
              $total_acc = $acc->price * $acc->qty;
              foreach ($qttAcc as $acc) { ?>
                <tr>
                  <td><?= $acc->id_accessories . " - " . $acc->name_accessories ?></td>
                  <td class="text-center"><?= $acc->qty ?></td>
                  <td class="text-right"><?= number_format($acc->price) ?></td>
                  <td class="text-right"><?= number_format($acc->sub_price) ?></td>
                  <td class="text-right"><?= $acc->disc_acc ?></td>
                  <td class="text-right"><?= number_format($acc->val_disc_acc) ?></td>
                  <td class="text-right"><?= number_format($acc->t_price_acc) ?></td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
        <br>
      <?php
          }
      ?>
    <?php
        }
    ?>

    <!-- DELIVERY COST -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h4 class="box-title"><strong>Detail Delivery Cost</strong> <span class="text-red">*</span></h4>
      </div>
      <div class="box-body">
        <?php
        $qttDelivery = $this->db->get_where('qtt_delivery', ['id_quotation' => $data->id])->row();
        ?>
        <table class="table-condensed table-bordered table-striped" width="100%">
          <thead class="bg-blue">
            <tr>
              <th width="30%">City</th>
              <th>Delivery By</th>
              <th>Delivery Cost</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tr>
            <td>
              <select name="city_delivery" class="form-control select2" id="city_delivery">
                <option value=""></option>
                <?php
                $citys = $this->db->get_where('kabupaten')->result();
                foreach ($citys as $city) { ?>
                  <option value="<?= $city->id_kab ?>" <?= $qttDelivery->id_city == $city->id_kab ? 'selected' : ''; ?>><?= $city->nama ?></option>
                <?php
                }
                ?>
              </select>
            </td>
            <td>
              <select name="via_delivery" id="via_delivery" class="form-control select2">
                <option value=""></option>
                <option value="DR" <?= $qttDelivery->via == 'DR' ? 'selected' : '' ?>>Darat</option>
                <option value="AF" <?= $qttDelivery->via == 'AF' ? 'selected' : '' ?>>Air Freight</option>
                <option value="SF" <?= $qttDelivery->via == 'SF' ? 'selected' : '' ?>>Sea Freight</option>
              </select>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-addon">Rp.</div>
                <input type="text" value="<?= number_format($qttDelivery->price) ?>" name="price_delivery" id="price_delivery" class="form-control nominal numberOnly" placeholder="0">
              </div>
            </td>
            <td>
              <input name="ket_delivery" id="ket_delivery" class="form-control " placeholder="Keterangan" value="<?= $qttDelivery->keterangan ?>">
            </td>
          </tr>
        </table>
      </div>
    </div>
    <br>

    <!-- ACCOMODATION -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h4 class="box-title"><strong>Detail accomodation <span class="text-red">*</span></strong></h4>
      </div>
      <div class="box-body">
        <label for="">Meal & Pocket Money</label>
        <table class="table-condensed table-bordered table-striped" id="meal_cost" width="100%">
          <thead class="bg-blue">
            <tr>
              <th width="20%">Area</th>
              <th>Qty MP</th>
              <th>Total Day</th>
              <th>Cost MP/Day</th>
              <th class="text-right">Total</th>
              <th>Notes</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $meal_cost = $this->db->get_where('qtt_meal_cost', ['id_quotation' => $data->id])->result();
            if (!empty($meal_cost)) {
              $no = 0;
              foreach ($meal_cost as $meal) {
                $no++;
            ?>
                <tr class="list_meal">
                  <td>
                    <select class="form-control select2" name="meal_cost[<?= $no ?>][meal_area]" data-id="<?= $no ?>">
                      <option value=""></option>
                      <?php
                      $areas = $this->db->get('kabupaten')->result();
                      foreach ($areas as $area) {
                      ?>
                        <option value="<?= $area->id_kab ?>" <?= $area->id_kab == $meal->area ? 'selected' : '' ?>><?= $area->nama ?></option>
                      <?php } ?>
                    </select>
                  </td>
                  <td><input value="<?= $meal->qty_mp ?>" id="qty_mp_meal<?= $no ?>" class="form-control text-right qty_mp_meal" type="number" name="meal_cost[<?= $no ?>][qty_mp_meal]" data-id="<?= $no ?>"></td>
                  <td><input value="<?= $meal->total_day ?>" id="total_day<?= $no ?>" class="form-control text-right total_day" type="number" name="meal_cost[<?= $no ?>][total_day]" data-id="<?= $no ?>"></td>
                  <td><input value="<?= number_format($meal->cost_mp_day) ?>" id="cost_mp_day<?= $no ?>" class="form-control numberOnly nominal text-right cost_mp_day" type="text" name="meal_cost[<?= $no ?>][cost_mp_day]" data-id="<?= $no ?>"></td>
                  <td><input value="<?= number_format($meal->total) ?>" id="total_meal<?= $no ?>" readonly class="form-control total_meal text-right" type="text" name="meal_cost[<?= $no ?>][total_meal]" data-id="<?= $no ?>"></td>
                  <td><input value="<?= $meal->notes ?>" id="notes_meal<?= $no ?>" class="form-control" type="text" name="meal_cost[<?= $no ?>][notes_meal]" data-id="<?= $no ?>"></td>
                  <td><button type="button" class="hapus_meal_cost btn btn-sm btn-danger">X</button></td>

                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
        <button class="btn btn-success" style="margin-top:7px" type="button" id="add_meal">
          <i class="fa fa-plus"></i> Add Meal & Pocket Money
        </button>
        <hr>
        <label for="">Transportation</label>
        <table class="table-condensed table-bordered table-striped" id="trans_cost" width="100%">
          <thead class="bg-blue">
            <tr>
              <th width="20%">Item Cost</th>
              <th width="15%">Transportation</th>
              <th>Origin</th>
              <th>Destination</th>
              <th width="7%">Qty MP</th>
              <th width="15%" class="text-right">Total</th>
              <th>Notes</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $transport = $this->db->get_where('qtt_transport_cost', ['id_quotation' => $data->id])->result();
            if (!empty($transport)) {
              $no = 0;
              foreach ($transport as $trans) {
                $no++;
            ?>
                <tr>
                  <td>
                    <select data-id="<?= $no ?>" name="trans_cost[<?= $no ?>][item_cost]" id="item_cost<?= $no ?>" class="form-control select2">
                      <option value=""></option>
                      <?php
                      $transp = $this->db->get('transportasi')->result();
                      foreach ($transp as $tr) { ?>
                        <option value="<?= $tr->trans_code ?>" <?= $trans->item_cost == $tr->trans_code ? 'selected' : '' ?>><?= $tr->name_transportasi ?></option>
                      <?php } ?>
                    </select>
                  </td>
                  <td>
                    <select data-id="<?= $no ?>" name="trans_cost[<?= $no ?>][transport]" id="transport<?= $no ?>" class="form-control select2">' +
                      <option value="" <?= $trans->transportation == '' ? 'selected' : '' ?>></option>
                      <option value="Kereta" <?= $trans->transportation == 'Kereta' ? 'selected' : '' ?>>Kereta</option>
                      <option value="Pesawat" <?= $trans->transportation == 'Pesawat' ? 'selected' : '' ?>>Pesawat</option>
                      <option value="Bus" <?= $trans->transportation == 'Bus' ? 'selected' : '' ?>>Bus</option>
                      <option value="Mobil" <?= $trans->transportation == 'Mobil' ? 'selected' : '' ?>>Mobil</option>
                      <option value="Minibus" <?= $trans->transportation == 'Minibus' ? 'selected' : '' ?>>Minibus</option>
                      <option value="ELF" <?= $trans->transportation == 'ELF' ? 'selected' : '' ?>>ELF</option>
                    </select>
                  </td>
                  <td><input value="<?= $trans->origin ?>" type="text" data-id="<?= $no ?>" name="trans_cost[<?= $no ?>][origin]" id="origin<?= $no ?>" class="form-control"></td>
                  <td><input value="<?= $trans->destination ?>" type="text" data-id="<?= $no ?>" name="trans_cost[<?= $no ?>][destination]" id="destination<?= $no ?>" class="form-control"></td>
                  <td><input value="<?= $trans->qty_mp ?>" type="number" data-id="<?= $no ?>" name="trans_cost[<?= $no ?>][qty_mp]" id="qty_mp_transport<?= $no ?>" class="qty_mp_transport form-control"></td>
                  <td><input value="<?= number_format($trans->total) ?>" type="text" data-id="<?= $no ?>" name="trans_cost[<?= $no ?>][total]" id="total_transport<?= $no ?>" class="total_transport form-control text-right numberOnly nominal"></td>
                  <td><input value="<?= $trans->notes ?>" type="text" data-id="<?= $no ?>" name="trans_cost[<?= $no ?>][notes]" id="notes_transport<?= $no ?>" class="form-control"></td>
                  <td><button type="button" class="hapus_trans_cost btn btn-sm btn-danger">X</button></td>
                </tr>

            <?php }
            } ?>
          </tbody>
        </table>
        <button class="btn btn-success" style="margin-top:7px" id="add_transportation" type="button">
          <i class="fa fa-plus"></i> Add Transportation
        </button>
        <hr>
        <label for="">Housing & Transport Site</label>
        <table class="table-condensed table-bordered table-striped" id="housing_cost" width="100%">
          <thead class="bg-blue">
            <tr>
              <th width="20%">Area</th>
              <th width="7%">Qty MP</th>
              <th>Amount Day</th>
              <th>Cost</th>
              <th width="15%">Total</th>
              <th>Notes</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $housing = $this->db->get_where('qtt_housing_cost', ['id_quotation' => $data->id])->result();
            if (!empty($housing)) {
              $no = 0;
              foreach ($housing as $hous) {
                $no++;
            ?>
                <tr class="list_housing">
                  <td>
                    <select data-id="<?= $no ?>" class="form-control select2" name="housing_cost[<?= $no ?>][housing_area]">
                      <option value=""></option>
                      <?php $areas = $this->db->get('kabupaten')->result();
                      foreach ($areas as $area) {
                      ?>
                        <option value="<?= $area->id_kab ?>" <?= $hous->area == $area->id_kab ? 'selected' : '' ?>><?= $area->nama ?></option>
                      <?php }
                      ?>
                    </select>
                  </td>
                  <td><input value="<?= $hous->qty_mp ?>" type="number" min="0" data-id="<?= $no ?>" id="qty_mp_housing<?= $no ?>" name="housing_cost[<?= $no ?>][qty_mp_housing]" class="form-control text-right  qty_mp_housing"></td>
                  <td><input value="<?= $hous->amount_day ?>" type="number" min="0" data-id="<?= $no ?>" id="amount_day<?= $no ?>" name="housing_cost[<?= $no ?>][amount_day]" class="form-control text-right  amount_day"></td>
                  <td><input value="<?= number_format($hous->cost) ?>" type="text" data-id="<?= $no ?>" id="cost<?= $no ?>" name="housing_cost[<?= $no ?>][cost]" class="form-control nominal numberOnly  text-right cost"></td>
                  <td><input value="<?= number_format($hous->total) ?>" type="text" data-id="<?= $no ?>" id="total_housing_cost<?= $no ?>" name="housing_cost[<?= $no ?>][total_housing_cost]" readonly class="form-control nominal total_housing_cost text-right "></td>
                  <td><input value="<?= $hous->notes ?>" type="text" data-id="<?= $no ?>" id="notes_housing<?= $no ?>" name="housing_cost[<?= $no ?>][notes]" class="form-control"></td>
                  <td><button type="button" class="hapus_housing_cost btn btn-sm btn-danger">X</button></td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
        <button class="btn btn-success" style="margin-top:7px" id="add_housing" type="button">
          <i class="fa fa-plus"></i> Add Housing & Transport Site
        </button>
        <hr>
        <label for="">Other</label>
        <table class="table-condensed table-bordered table-striped" id="other_cost" width="100%">
          <thead class="bg-blue">
            <tr>
              <th>Item Name</th>
              <th>Cost</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $other = $this->db->get_where('qtt_other_cost', ['id_quotation' => $data->id])->result();
            if (!empty($other)) {
              $no = 0;
              foreach ($other as $oth) {
                $no++;
            ?>
                <tr class="list_other">
                  <td><input value="<?= $oth->item ?>" type="text" name="other_cost[<?= $no ?>][other_item]" class="form-control"></td>
                  <td><input value="<?= number_format($oth->cost) ?>" type="text" name="other_cost[<?= $no ?>][other_cost]" class="form-control text-right other_cost nominal numberOnly"></td>
                  <td><button type="button" class="btn btn-sm btn-danger hapus_oth_cost">X</button></td>
                </tr>
            <?php
              }
            }

            ?>
          </tbody>
        </table>
        <button class="btn btn-success" style="margin-top:7px" id="add_other" type="button">
          <i class="fa fa-plus"></i> Add Other
        </button>
      </div>
    </div>
    </div>

    <br>
    <!-- SUMMARY  -->

    <div class="box-body">
      <?php
      $sumCurtain = $this->db->query('SELECT
            SUM((harga_kain * t_kain) * qty) AS subtotal,
            SUM((((harga_kain * t_kain) * qty) * disc_persen )/100) AS discount,
            SUM((( harga_kain * t_kain ) * qty ) - ((( harga_kain * t_kain )* qty  ) * disc_persen )/ 100 ) AS total,
            SUM(t_kain) AS t_kain,
            SUM(((hrg_jahitan * t_kain)* qty)) AS hrg_jahitan,
            SUM(((val_disc_jahit  * t_kain) * qty)) AS disc_jahitan,
            SUM(((t_hrg_jahitan  * t_kain) * qty)) AS total_jahitan,
            SUM((t_price* qty)) AS subtotal_rail,
            SUM((v_diskon_rail* qty)) AS discount_rail,
            SUM((t_price* qty) - (v_diskon_rail * qty)) AS total_rail
            FROM
              qtt_product_fabric
            WHERE id_quotation = "' . $data->id . '"')->row();

      $sumAcc = $this->db->query('SELECT SUM(t_price_acc) AS total_acc FROM qtt_accessoriess WHERE id_quotation = "' . $data->id . '"')->row();
      $sumAddComp = $this->db->query('SELECT SUM(t_price) AS total_addc FROM qtt_additional_comp_rail WHERE id_quotation = "' . $data->id . '"')->row();
      $sumRail = $sumCurtain->subtotal_rail + $sumAddComp->total_addc;
      $sumRailAcc = $sumAcc->total_acc + $sumCurtain->subtotal_rail + $sumAddComp->total_addc;
      $sumRailAccTotal = $sumRailAcc - $sumCurtain->discount_rail;


      $sumAf = $this->db->query('SELECT sum(total_air_freight) as total_air_freight from qtt_air_freight where id_quotation = "' . $data->id . '"')->row();
      $sumDeliv = $this->db->query('SELECT sum(price) as t_delivery from qtt_delivery where id_quotation = "' . $data->id . '"')->row();
      $sumMeal = $this->db->query('SELECT sum(total) as t_meal from qtt_meal_cost where id_quotation = "' . $data->id . '"')->row();
      $sumTrans = $this->db->query('SELECT sum(total) as t_trans from qtt_transport_cost where id_quotation = "' . $data->id . '"')->row();
      $sumHouse = $this->db->query('SELECT sum(total) as t_house from qtt_housing_cost where id_quotation = "' . $data->id . '"')->row();
      $sumOth = $this->db->query('SELECT sum(cost) as t_oth from qtt_other_cost where id_quotation = "' . $data->id . '"')->row();

      $sumBiaya = $sumCurtain->total_jahitan + $sumAf->total_air_freight + $sumDeliv->t_delivery + $sumMeal->t_meal + $sumTrans->t_trans + $sumHouse->t_house + $sumOth->t_oth;
      $sumDiscBiaya = $sumCurtain->disc_jahitan;
      $t_sumBiaya = $sumBiaya - $sumDiscBiaya;

      // $sumMoq = $this->db->query('SELECT sum(price) as subtotal_moq, sum(total) as t_moq, sum(val_disc) as disc_moq from qtt_moq where id_quotation = "' . $data->id . '"')->row();
      $subtotalFabric = $sumCurtain->subtotal;
      $discFabric = $sumCurtain->discount;
      $totalFabric = $sumCurtain->total;

      $subtotal = $totalFabric + $sumBiaya + $sumRailAccTotal;
      $ppn = ($subtotal * 10) / 100;
      $gTotal = $subtotal + $ppn;
      $qttHeader = $this->db->get_where('quotation_header', ['id' => $data->id])->row();
      $gTotalRounding = $subtotal + $ppn - $qttHeader->rounding;

      ?>
      <input type="hidden" id="sumJahitan" value="<?= round($sumCurtain->total_jahitan) ?>">
      <input type="hidden" id="sumAirFreight" value="<?= $sumAf->total_air_freight ?>">
      <input type="hidden" id="sumDelivery" value="<?= $sumDeliv->t_delivery ?>">

      <input type="hidden" id="sumTotalAirFreight">
      <input type="hidden" id="sumMealCost" value="<?= $sumMeal->t_meal ?>">
      <input type="hidden" id="sumTransportCost" value="<?= $sumTrans->t_trans ?>">
      <input type="hidden" id="sumHousingCost" value="<?= $sumHouse->t_house ?>">
      <input type="hidden" id="sumOtherCost" value="<?= $sumOth->t_oth ?>">

      <div class="summary row">
        <div class="col-md-5 pull-right">
          <table class="table-condensed table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th>Item</th>
                <th class="text-right">Subtotal</th>
                <th class="text-right">Discount Total</th>
                <th class="text-right">Total</th>
              </tr>
            </thead>
            <tr>
              <td>Fabric</td>
              <td class="text-right"><?= number_format($subtotalFabric) ?> <input type="hidden" name="subtotalFabric" value=" <?= $subtotalFabric ?>"></td>
              <td class="text-right"><?= number_format($discFabric) ?> <input type="hidden" name="discFabric" value=" <?= $discFabric ?>"></td>
              <th class="text-right"><?= number_format($totalFabric) ?> <input type="hidden" id="sumFabric" name="totalFabric" value=" <?= $totalFabric ?>"></th>
            </tr>
            <tr>
              <td>Rail & Acc</td>
              <td class="text-right"><?= number_format($sumRailAcc) ?> <input type="hidden" name="subtotal_rail" value=" <?= $sumRailAcc ?>"></td>
              <td class="text-right"><?= number_format($sumCurtain->discount_rail) ?> <input type="hidden" name="discount_rail" value=" <?= $sumCurtain->discount_rail ?>"></td>
              <th class="text-right"><?= number_format($sumRailAccTotal) ?> <input type="hidden" id="sumRailAcc" name="sumRailAcc" value=" <?= $sumRailAccTotal ?>"></th>
            </tr>
            <tr>
              <td>Biaya</td>
              <td class="text-right"><span id="sumBiayaText"><?= number_format($sumBiaya) ?></span> <input type="hidden" name="sumBiaya" id="sumBiaya" value=" <?= $sumBiaya ?>"></td>
              <td class="text-right"><?= number_format($sumDiscBiaya) ?><input type="hidden" id="sumDiscBiaya" name="sumDiscBiaya" value="<?= $sumDiscBiaya ?>"></td>
              <th class="text-right"><span id="t_sumBiayaText"><?= number_format($t_sumBiaya) ?></span> <input type="hidden" id="t_sumBiaya" name="t_sumBiaya" value=" <?= $t_sumBiaya ?>"></th>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Subtotal</td>
              <td colspan="3" class="text-right">
                <h4>
                  <strong id="sumSubtotalText">
                    <?= number_format($subtotal) ?>
                  </strong>
                </h4>
                <input type="hidden" id="sumSubtotal" name="subtotal" value=" <?= $subtotal ?>">
              </td>
            </tr>
            <tr>
              <td>PPN (10%)</td>
              <th colspan="3" class="text-right">
                <span id="ppnText"><?= number_format($ppn) ?></span>
                <input type="hidden" id="ppn" name="ppn" value=" <?= $ppn ?>">
              </th>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><label for="">Total</label></td>
              <th colspan="3" class="text-right">
                <h4>
                  <strong>
                    <span id="total_quotation">
                      <?= number_format($gTotal) ?>
                    </span>
                  </strong>
                </h4>
                <input type="hidden" id="total_quotation_val" name="total" value=" <?= $gTotal ?>">
              </th>
            </tr>
            <tr>
              <td><label for="">Pembulatan</label></td>
              <td colspan="3" class="text-right"><input id="pembulatan_quotation" value="<?= number_format($qttHeader->rounding) ?>" name="rounding" type="text" class="required form-control text-right nominal numberOnly"></td>
            </tr>
            <tr>
              <td><label for="">Grand Total</label></td>
              <td colspan="3" class="text-right">
                <h4>
                  <strong>
                    <span id="grand_total">
                      <!-- <?= number_format($qttHeader->grand_total) ?> -->
                      <?= number_format($gTotalRounding) ?>
                    </span>
                  </strong>
                </h4>
                <input type="hidden" name="grand_total" id="grand_total_quotation" value="  <?= number_format($gTotalRounding) ?>" class="required form-control text-right">
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="box-footer">
      <button type="button" class="btn btn-md btn-primary pull-right" id="saveQuotation2"><i class="fa fa-save"></i> Save</button>
    </div>
  </div>
</form>

<style>
  .inSp {
    text-align: center;
    display: inline-block;
    S width: 100px;
  }

  .inSp2 {
    text-align: center;
    display: inline-block;
    width: 45%;
  }

  .inSpL {
    text-align: left;
  }

  .vMid {
    vertical-align: middle !important;
  }

  .w10 {
    display: inline-block;
    width: 10%;
  }

  .w15 {
    display: inline-block;
    width: 15%;
  }

  .w20 {
    display: inline-block;
    width: 20%;
  }

  .w30 {
    display: inline-block;
    width: 30%;
  }

  .w40 {
    display: inline-block;
    width: 40%;
  }

  .w50 {
    display: inline-block;
    width: 50%;
  }

  .w60 {
    display: inline-block;
    width: 60%;
  }

  .w70 {
    display: inline-block;
    width: 70%;
  }

  .w80 {
    display: inline-block;
    width: 80%;
  }

  .w90 {
    display: inline-block;
    width: 90%;
  }

  .hideIt {
    display: none;
  }

  .showIt {
    display: block;
  }
</style>

<script type="text/javascript">
  /*
|----------------------|
| ACOMODATION FUNCTION |
|----------------------|
 */

  //  MEAL & Pocket Money

  $(document).on('click', '#add_meal', function(e) {
    let x = parseInt($(".list_meal").length + 1);
    // alert(x)
    let data = '' +
      '<tr class="list_meal">' +
      '<td>' +
      '<select data-id="' + x + '" class="form-control select2" name="meal_cost[' + x + '][meal_area]">' +
      '<option value=""></option>' +
      <?php $areas = $this->db->get('kabupaten')->result();
      foreach ($areas as $area) {
      ?> '<option value="<?= $area->id_kab ?>"><?= $area->nama ?></option>' +
      <?php }
      ?> '</select>' +
      '</td>' +
      '<td><input data-id="' + x + '" type="number" name="meal_cost[' + x + '][qty_mp_meal]" min="0" id="qty_mp_meal' + x + '" class="form-control text-right qty_mp_meal"></td>' +
      '<td><input data-id="' + x + '" type="number" name="meal_cost[' + x + '][total_day]" id="total_day' + x + '" min="0" class="form-control text-right total_day"></td>' +
      '<td><input data-id="' + x + '" type="text" name="meal_cost[' + x + '][cost_mp_day]" id="cost_mp_day' + x + '" class="form-control numberOnly nominal text-right cost_mp_day"></td>' +
      '<td><input data-id="' + x + '" type="text" name="meal_cost[' + x + '][total_meal]" id="total_meal' + x + '" readonly class="form-control total_meal text-right"></td>' +
      '<td><input data-id="' + x + '" type="text" name="meal_cost[' + x + '][notes_meal]" id="notes_meal' + x + '" class="form-control"></td>' +
      '<td><button type="button" class="hapus_meal_cost btn btn-sm btn-danger">X</button></td>' +
      '</tr>';

    $('#meal_cost tbody').append(data);
    $(".select2").select2({
      placeholder: "Choose An Option",
      width: '100%'
    });
  })



  $(document).on('change input paste', '.qty_mp_meal,.total_day,.cost_mp_day', function() {
    let no = $(this).data('id');
    let qty_mp_meal = $('#qty_mp_meal' + no).val() || 0;
    let total_day = $('#total_day' + no).val() || 0;
    let cost_mp_day = $('#cost_mp_day' + no).val().replace(/,/g, '') || 0;


    total_meal = (parseInt(qty_mp_meal) * parseInt(total_day)) * parseInt(cost_mp_day);
    $('#total_meal' + no).val(('' + total_meal.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

    let total_meal_cost = 0;
    $('.total_meal').each(function() {
      total_meal_cost += parseFloat($(this).val().replace(/,/g, '') || 0);
    })
    $('#sumMealCost').val(total_meal_cost);
    changeSumBiaya();

  })

  $(document).on('change keyup', '.air_freight', function() {
    let no = $(this).data('id');
    let val = parseInt($(this).val().replace(/,/g, '') || 0);

    let total_af = 0;
    $('.total_af').each(function() {
      total_af += Number($(this).val().replace(/,/g, '') || 0);
    })

    // sumAf = $('#sumAirFreight').val().replace(/,/g, '') || 0;
    // sumTotalAf = parseInt(sumAf) + total_af;
    // console.log(sumTotalAf);
    $('#sumAirFreight').val(total_af) || 0;
    changeSumBiaya()
    // $('#sumAirFreight').val(sumTotalAf)

  })

  function changeSumBiaya() {
    let sumFabric = $('#sumFabric').val() || 0;
    let sumRailAcc = $('#sumRailAcc').val() || 0;


    let sumMealCost = $('#sumMealCost').val() || 0;
    let sumTransportCost = $('#sumTransportCost').val() || 0;
    let sumHousingCost = $('#sumHousingCost').val() || 0;
    let sumOtherCost = $('#sumOtherCost').val() || 0;

    let sumJahitan = $('#sumJahitan').val() || 0;
    let sumAirFreight = $('#sumAirFreight').val() || 0;
    let sumDelivery = $('#sumDelivery').val() || 0;
    let sumDiscBiaya = $('#sumDiscBiaya').val() || 0;

    sumBiaya = parseInt(sumMealCost) + parseInt(sumTransportCost) + parseInt(sumHousingCost) + parseInt(sumOtherCost) + parseInt(sumJahitan) + parseInt(sumAirFreight) + parseInt(sumDelivery);
    t_sumBiaya = parseInt(sumBiaya) - parseInt(sumDiscBiaya);
    $('#sumBiaya').val(sumBiaya.toFixed());
    $('#t_sumBiaya').val(t_sumBiaya.toFixed());
    $('#sumBiayaText').text(('' + sumBiaya.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
    $('#t_sumBiayaText').text(('' + t_sumBiaya.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

    sumSubtotal = parseInt(sumFabric) + parseInt(sumRailAcc) + parseInt(t_sumBiaya);
    $('#sumSubtotal').val(sumSubtotal.toFixed());
    $('#sumSubtotalText').text(('' + sumSubtotal.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

    ppn = (sumSubtotal * 10) / 100;
    $('#ppn').val(ppn.toFixed());
    $('#ppnText').text(('' + ppn.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

    sumTotal = parseInt(sumSubtotal) + parseInt(ppn);
    $('#total_quotation_val').val(sumTotal.toFixed())
    $('#total_quotation').text(('' + sumTotal.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
    $('#grand_total_quotation').val(sumTotal.toFixed())
    $('#grand_total').text(('' + sumTotal.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

  }

  $(document).on('click', '.hapus_meal_cost', function() {
    $(this).parents('tr').remove();
    let total_meal_cost = 0;
    $('.total_meal').each(function() {
      total_meal_cost += parseFloat($(this).val().replace(/,/g, '') || 0);
    })
    $('#sumMealCost').val(total_meal_cost);
    changeSumBiaya();
  })


  // Transportation

  $(document).on('click', '#add_transportation', function(e) {
    let x = parseInt($(".list_trans").length + 1);
    // alert(x)
    let data = '' +
      '<tr class="list_trans">' +
      '<td>' +
      '<select data-id="' + x + '" name="trans_cost[' + x + '][item_cost]" id="item_cost' + x + '"class="form-control select2">' +
      '<option value=""></option>' +
      <?php
      $transp = $this->db->get('transportasi')->result();
      foreach ($transp as $tr) { ?> '<option value="<?= $tr->trans_code ?>"><?= $tr->name_transportasi ?></option>' +
      <?php
      }
      ?> '</select>' +
      '</td>' +
      '<td>' +
      '<select data-id="' + x + '" name="trans_cost[' + x + '][transport]" id="transport' + x + '"class="form-control select2">' +
      '<option value=""></option>' +
      '<option value="Kereta">Kereta</option>' +
      '<option value="Pesawat">Pesawat</option>' +
      '<option value="Bus">Bus</option>' +
      '<option value="Mobil">Mobil</option>' +
      '<option value="Minibus">Minibus</option>' +
      '<option value="ELF">ELF</option>' +
      '</select>' +
      '</td>' +
      '<td><input type="text" data-id="' + x + '" name="trans_cost[' + x + '][origin]" id="origin' + x + '"class="form-control"></td>' +
      '<td><input type="text" data-id="' + x + '" name="trans_cost[' + x + '][destination]" id="destination' + x + '"class="form-control"></td>' +
      '<td><input type="number" data-id="' + x + '" name="trans_cost[' + x + '][qty_mp]" id="qty_mp_transport' + x + '"class="qty_mp_transport form-control"></td>' +
      '<td><input type="text" data-id="' + x + '" name="trans_cost[' + x + '][total]" id="total_transport' + x + '"class="form-control text-right total_transport numberOnly nominal"></td>' +
      '<td><input type="text" data-id="' + x + '" name="trans_cost[' + x + '][notes]" id="notes_transport' + x + '"class="form-control"></td>' +
      '<td><button type="button" class="hapus_trans_cost btn btn-sm btn-danger">X</button></td>' +
      '</tr>';

    $('#trans_cost tbody').append(data);
    $(".select2").select2({
      placeholder: "Choose An Option",
      width: '100%'
    });
  })

  $(document).on('change input paste', '.qty_mp_transport,.total_transport', function() {

    let sum_transport = 0;
    $('.total_transport').each(function() {
      sum_transport += parseFloat($(this).val().replace(/,/g, '') || 0);
    })
    $('#sumTransportCost').val(sum_transport);
    changeSumBiaya();
  })

  // $(document).on('change', '.item_cost', function() {
  //   let no = $(this).data('id');
  //   let id = $(this).val();

  //   $.ajax({
  //     type: 'POST',
  //     url: siteurl + active_controller + 'transport',
  //     dataType: 'JSON',
  //     data: {
  //       id: id
  //     },
  //     success: function(data) {
  //       console.log(data);
  //       // var option = new Option(data.nama, data.id_trans, false, false);
  //       // $('#transport' + no).append(option).trigger("change");
  //     }
  //   })

  // })

  $(document).on('click', '.hapus_trans_cost', function() {
    $(this).parents('tr').remove();

    let sum_transport = 0;
    $('.total_transport').each(function() {
      sum_transport += parseFloat($(this).val().replace(/,/g, '') || 0);
    })
    $('#sumTransportCost').val(sum_transport);
    changeSumBiaya();
  })

  // Housing

  $(document).on('click', '#add_housing', function(e) {
    let x = parseInt($(".list_housing").length + 1);
    // alert(x)
    let data = '' +
      '<tr class="list_housing">' +
      '<td>' +
      '<select data-id="' + x + '" class="form-control select2" name="housing_cost[' + x + '][housing_area]">' +
      '<option value=""></option>' +
      <?php $areas = $this->db->get('kabupaten')->result();
      foreach ($areas as $area) {
      ?> '<option value="<?= $area->id_kab ?>"><?= $area->nama ?></option>' +
      <?php }
      ?> '</select>' +
      '</td>' +
      '<td><input type="number" min="0" data-id="' + x + '" id="qty_mp_housing' + x + '" name="housing_cost[' + x + '][qty_mp_housing]" class="form-control text-right  qty_mp_housing"></td>' +
      '<td><input type="number" min="0" data-id="' + x + '" id="amount_day' + x + '" name="housing_cost[' + x + '][amount_day]" class="form-control text-right  amount_day"></td>' +
      '<td><input type="text" data-id="' + x + '" id="cost' + x + '" name="housing_cost[' + x + '][cost]" class="form-control nominal numberOnly  text-right cost"></td>' +
      '<td><input type="text" data-id="' + x + '" id="total_housing_cost' + x + '" name="housing_cost[' + x + '][total_housing_cost]" readonly class="form-control nominal total_housing_cost text-right "></td>' +
      '<td><input type="text" data-id="' + x + '" id="notes_housing' + x + '" name="housing_cost[' + x + '][notes]" class="form-control"></td>' +
      '<td><button type="button" class="hapus_housing_cost btn btn-sm btn-danger">X</button></td>' +
      '</tr>';

    $('#housing_cost tbody').append(data);
    $(".select2").select2({
      placeholder: "Choose An Option",
      width: '100%'
    });
  })

  $(document).on('change input paste', '.cost,.amount_day,.qty_mp_housing', function() {
    let no = $(this).data('id');
    let qty_mp_housing = $('#qty_mp_housing' + no).val() || 0;
    let amount_day = $('#amount_day' + no).val() || 0;
    let cost = $('#cost' + no).val().replace(/,/g, '') || 0;

    total_housing = amount_day * cost;
    $('#total_housing_cost' + no).val(('' + total_housing.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));

    let sum_housing = 0;
    $('.total_housing_cost').each(function() {
      sum_housing += parseFloat($(this).val().replace(/,/g, '') || 0);
    })
    $('#sumHousingCost').val(sum_housing);
    changeSumBiaya();
  })

  $(document).on('click', '.hapus_housing_cost', function() {
    $(this).parents('tr').remove();
    let sum_housing = 0;
    $('.total_housing_cost').each(function() {
      sum_housing += parseFloat($(this).val().replace(/,/g, '') || 0);
    })
    $('#sumHousingCost').val(sum_housing);
    changeSumBiaya();
  })

  // Other

  $(document).on('click', '#add_other', function(e) {
    let x = parseInt($(".list_other").length + 1);
    // alert(x)
    let data = '' +
      '<tr class="list_other">' +
      '<td><input type="text" name="other_cost[' + x + '][other_item]" class="form-control"></td>' +
      '<td><input type="text" name="other_cost[' + x + '][other_cost]" class="form-control text-right nominal other_cost numberOnly"></td>' +
      '<td><button type="button" class="hapus_oth_cost btn btn-sm btn-danger">X</button></td>' +
      '</tr>';

    $('#other_cost tbody').append(data);
  })

  $(document).on('change input paste', '.other_cost', function() {
    let other_cost = 0;
    $('.other_cost').each(function() {
      other_cost += parseFloat($(this).val().replace(/,/g, '') || 0);
    })
    $('#sumOtherCost').val(other_cost);
    changeSumBiaya();
  })

  $(document).on('click', '.hapus_oth_cost', function() {
    $(this).parents('tr').remove();
    let other_cost = 0;
    $('.other_cost').each(function() {
      other_cost += parseFloat($(this).val().replace(/,/g, '') || 0);
    })
    $('#sumOtherCost').val(other_cost);
    changeSumBiaya();
  })

  $('#dtDetail').DataTable({
    "paging": false,
    "searching": false,
    "lengthChange": false,
    "ordering": false

  });

  $(document).on('change input', '#pembulatan_quotation', function() {
    let pembulatan = $(this).val().replace(/,/g, '') || 0;
    let total_quotation = $('#total_quotation').text().replace(/,/g, '') || 0;
    grand_total = parseFloat(total_quotation) - parseInt(pembulatan);

    if (pembulatan > 300000) {
      alert('Pembulatan maksimal Rp. 300,000');
      $(this).val('0');
      $('#grand_total_quotation').val('0')
    } else {
      $('#grand_total_quotation').val(grand_total.toFixed())
      $('#grand_total').text(('' + grand_total.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
    }
  })

  $(document).on('change input', '.air_freight_curtain', function() {
    let no = $(this).data('id');
    let air_freight = $(this).val().replace(/,/g, '') || 0;
    let t_kain = $('#t_kain_curtain' + no).val() || 0;
    t_air_freight = parseFloat(t_kain) * parseInt(air_freight);
    $('#t_air_freight_curtain' + no).val(('' + t_air_freight.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
  })

  $(document).on('change input', '.air_freight_lining', function() {
    let no = $(this).data('id');
    let air_freight = $(this).val().replace(/,/g, '') || 0;
    let t_kain = $('#t_kain_lining' + no).val() || 0;
    t_air_freight = parseFloat(t_kain) * parseInt(air_freight);
    $('#t_air_freight_lining' + no).val(('' + t_air_freight.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
  })

  $(document).on('change input', '.air_freight_vitrage', function() {
    let no = $(this).data('id');
    let air_freight = $(this).val().replace(/,/g, '') || 0;
    let t_kain = $('#t_kain_vitrage' + no).val() || 0;
    t_air_freight = parseFloat(t_kain) * parseInt(air_freight);
    $('#t_air_freight_vitrage' + no).val(('' + t_air_freight.toFixed()).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','))
  })

  $(document).on('change', '#qty_accomodation,#price_accomodation,#disc_accomodation', function() {
    qty = $('#qty_accomodation').val().replace(/,/g, '') || 0;
    price = $('#price_accomodation').val().replace(/,/g, '') || 0;
    disc = $('#disc_accomodation').val().replace(/,/g, '') || 0;

    total = (parseInt(qty) * parseInt(price));
    diskon = (total * parseInt(disc)) / 100
    gTotal = total - diskon

    $('#price_aft_disc_accomodation').val(('' + gTotal).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
  })

  $(document).on('change', '#qty_moq,#price_moq,#disc_moq', function() {
    qty = $('#qty_moq').val().replace(/,/g, '') || 0;
    price = $('#price_moq').val().replace(/,/g, '') || 0;
    disc = $('#disc_moq').val().replace(/,/g, '') || 0;

    total = (parseInt(qty) * parseInt(price));
    diskon = (total * parseInt(disc)) / 100
    gTotal = total - diskon

    $('#t_price_moq').val(('' + gTotal).replace(/\B(?=(?:\d{3})+(?!\d))/g, ','));
  })

  // 

  $(document).ready(function() {
    getCustomer();
    $(".datepicker").datepicker({
      format: "yyyy-mm-dd",
      showInputs: true,
      autoclose: true
    });
    $(".select2").select2({
      placeholder: "Choose An Option",
      allowClear: true,
      width: '100%',
      dropdownParent: $("#form-quotation")
    });
    $('.select2-search--inline').css('margin-right', '5%');
    $('.select2-search--inline').css('width', '100%');
    $('.select2-search__field').css('margin-right', '5%');
    $('.select2-search__field').css('width', '90% !important');
    $('.select2-search__field').css('padding-right', '5%');


    $(document).on('click change keyup paste blur', '#form-quotation .form-control', function(e) {
      //console.log('AHAHAHAHA');
      var val = $(this).val();
      var id = $(this).attr('id');
      if (val == '') {
        //$('.'+id).addClass('hideIt');
        $('.' + id).css('display', 'inline-block');
      } else {
        $('.' + id).css('display', 'none');
      }
    });
    if ('<?php $getC->id_cuctomer ?>' != null) {
      id_prov = '<?php $getC->id_cuctomer ?>';
    }
    if ('<?= $this->uri->segment(4) ?>' == 'view') {
      $('.label_view').css("display", "block");
      $('.label_input').css("display", "none");
    } else {
      $('.label_view').css("display", "none");
      $('.label_input').css("display", "block");
    }

  });

  function getCustomer() {
    if ('<?= ($getC->id_customer) ?>' != null) {
      var id_selected = '<?= $getC->id_customer ?>';
    } else if ($('#id_customer').val() != null || $('#id_customer').val() != '') {
      var id_selected = $('#id_customer').val();
    } else {
      var id_selected = '';
    }
    //console.log(id_selected);
    var column = 'id_customer';
    var column_fill = '';
    var column_name = 'nm_customer';
    var table_name = 'master_customer';
    var key = 'id_customer';
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
        $('#id_cuctomer').html(result.html);
      },
      error: function(request, error) {
        console.log(arguments);
        alert(" Can't do because: " + error);
      }
    });
  }


  jQuery(document).on('click', '#saveQuotation2', function() {
    var valid = getValidation();
    // alert(valid)
    if (valid) {
      // var formdata = $("#form-quotation").serialize();
      var formdata = new FormData($("#form-quotation")[0]);
      console.log(formdata);
      // exit();
      $.ajax({
        url: siteurl + active_controller + "saveQuotation2",
        dataType: "json",
        type: 'POST',
        data: formdata,
        contentType: false,
        cache: false,
        processData: false,
        async: false,
        success: function(result) {
          if (result.status == '1') {
            swal({
              title: "Sukses!",
              text: result['pesan'],
              type: "success",
              timer: 1500,
              showConfirmButton: false
            });
            setTimeout(function() {
              open(siteurl + active_controller + 'qt_pro_open', '_self');
            }, 1600);
          } else {
            swal({
              title: "Gagal!",
              text: result['pesan'],
              type: "error",
              timer: 1500,
              showConfirmButton: false
            });
          };
        },
        error: function(request, error) {
          console.log(arguments);
          alert(" Can't do because: " + error);
        }
      });
    } else {
      swal({
        title: "Gagal!",
        text: 'Please fill in the blank form!',
        type: "error",
        timer: 1500,
        showConfirmButton: false
      });
    }
  });
</script>