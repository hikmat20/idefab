<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    table th {
      padding: 5px
    }
  </style>
</head>

<body style="font-family:Arial">
  <h3 style="text-align:;">Ref.<?= $data->nomor ?></h3>
  <?php
  if ($data->status == '0') {
    $status = "Open";
  } else if ($data->status == "1") {
    $status = "Deal";
  } else if ($data->status == "2") {
    $status = "Lost";
  } else {
    $status = "Tidak ada status";
  }
  ?>
  <h4 style="text-align: right;position:relative;margin:0px">Status : <?= $status ?></h4>
  <hr>

  <table id="my-grid3" width="100%">
    <thead>
      <tr>
        <th class="text">CUSTOMER DATA INFORMATION</th>
      </tr>
    </thead>
  </table>

  <table width="100%" style="font-size:12px">
    <tr>
      <td>
        <table width="100%">
          <tbody>
            <tr>
              <td width="">
                Quotation Number
              </td>
              <td>: <?= $data->nomor ?></td>
              <input type="hidden" name="id_quotation" value="<?= $data->id_quotation ?>">
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
            <!-- <tr>
              <td>
                <label>Discount Category</label>
              </td>
              <td>: <?= $disc_cat->name_cat ?> (<?= $data->val_disc_cat != '' ? $data->val_disc_cat . '%' : '' ?>)</td>
            </tr> -->
          </tbody>
        </table>
      </td>
      <td>
        <table width="100%">
          <tbody>
            <tr>
              <td width="">
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
            <!-- <tr>
              <td>
                <label>Nett Price / PPN</label>
              </td>
              <td>: <?= $data->net == '0' ? 'No' : 'Yes' ?> / <?= $data->ppn == '0' ? 'No' : 'Yes' ?></td>
            </tr> -->
            <tr>
              <td>
                <label>Project Name</label>
              </td>
              <td>: <?= $data->project_name ?></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </table>
  <hr>

  <div class="box-body">
    <table width="100%" style="font-size:12px;border-collapse: collapse;" border="1">
      <thead>
        <tr style="background-color: powderblue;">
          <th>Item</th>
          <th>Buka arah </th>
          <th>Lebar (cm)</th>
          <th>Tinggi (cm)</th>
          <th>lebar kain (cm)</th>
          <th>PANEL kain</th>
          <th>Qty/Unit Meter</th>
          <th>Unit</th>
          <th>Qty M/Pc/Set</th>
          <th>PRICE / M</th>
          <th>Total Price</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <?php
      $no = 0;
      foreach ($rooms as $room) {
        $no++; ?>
        <tbody>
          <!-- CURTAIN -->
          <tr style="background-color: pink">
            <td colspan="13"><strong><?= ucfirst($room->name_room) ?> (L : <?= $room->width_window ?> x T : <?= $room->height_window ?>)</strong></td>
          </tr>
          <?php
          $qttCurtain = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $id, 'item' => 'curtain'])->row();

          if ($qttCurtain) { ?>
            <tr>
              <td colspan="13">
                <strong>Curtain Material</strong>
              </td>
            </tr>
            <tr>
              <td>
                <?php
                $curtain = $this->db->get_where('master_product_fabric', ['id_product' => $qttCurtain->id_product])->row();
                // echo "<pre>";
                // print_r($curtain);
                // echo "<pre>";
                // // exit;
                $t_hrg_kain = ($qttCurtain->harga_kain * $qttCurtain->t_kain)  * $curtain->qty;
                $total = ($t_hrg_kain - ($t_hrg_kain * $qttCurtain->disc_persen / 100)) * $curtai->qty;
                ?>
                <strong><?= $qttCurtain->id_product ?></strong><br>
                <strong><?= $qttCurtain->cust_product_name ?></strong><br>
                Width : <?= $curtain->width ?> cm<br>
                Weight : <?= $curtain->weight ?> cm<br>
                Content : <?= $curtain->content_percent ?>
              </td>
              <td align="center"><?= $qttCurtain->bukaan ?></td>
              <td align="center"><?= $room->width_window ?></td>
              <td align="center"><?= $room->height_window ?></td>
              <td align="center"><?= $curtain->width ?></td>
              <td align="center"><?= $qttCurtain->round_up ?></td>
              <td align="center"><?= $qttCurtain->t_kain ?></td>
              <td align="center"><?= $qttCurtain->qty ?></td>
              <td align="center"><?= $qttCurtain->qty * $qttCurtain->t_kain ?></td>
              <td align="right"><?= number_format($qttCurtain->harga_kain) ?></td>
              <td align="right"><?= number_format($t_hrg_kain) ?></td>
              <!-- <td align="center"><?= $qttCurtain->disc_persen ?>%</td>
              <td align="right"><?= number_format($total) ?></td> -->
              <!-- <td align="center"><?= $curtain->product_status ?></td> -->
              <td><?= $qttCurtain->keterangan ?></td>
            </tr>
            <?php
            $rail = $this->db->get_where('mp_rail', ['id_rail' => $qttCurtain->rail_material])->row();
            $total_rail = ($rail->bc_selling_price * $qttCurtain->t_kain)  * $qttLining->qty;
            ?>
            <tr>
              <td colspan="13"><strong>Rail Curtain</strong></td>
            </tr>
            <tr>
              <td><strong>
                  <?= $rail->id_rail ?><br>
                  <?= $rail->name_product ?>
                </strong>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttCurtain->width ?></td>
              <td align="center"><?= $qttCurtain->qty ?></td>
              <td align="center"><?= $qttCurtain->qty * $qttCurtain->width ?></td>
              <td align="right"><?= number_format($qttCurtain->price) ?></td>
              <td align="right"><?= number_format(($qttCurtain->t_price)) ?></td>
              <td align=""><?= $qttCurtain->ket_rail ?></td>
            </tr>
            <?php
            $jahitan = $this->db->get_where('sewing', ['id_sewing' => $qttCurtain->jahitan])->row();
            $total_jahit = ($jahitan->price * $qttCurtain->t_kain) * $qttLining->qty;
            ?>
            <tr>
              <td colspan="13"><strong>Jahitan Curtain</strong></td>
            </tr>
            <tr>
              <td><?= $jahitan->item ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttCurtain->t_kain ?></td>
              <td align="center"><?= $qttCurtain->qty ?></td>
              <td align="center"><?= $qttCurtain->qty * $qttCurtain->t_kain ?></td>
              <td align="right"><?= number_format($jahitan->price) ?></td>
              <td align="right"><?= number_format($total_jahit) ?></td>
              <td></td>
            </tr>
            <?php
            $af = $this->db->get_where('qtt_air_freight', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $id, 'item' => 'curtain'])->row();
            ?>
            <tr>
              <td><strong>Biaya Air Freight Curtain</strong></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttCurtain->t_kain ?></td>
              <td align="center"><?= $qttCurtain->qty ?></td>
              <td align="center"><?= $qttCurtain->qty * $qttCurtain->t_kain ?></td>
              <td align="right"><?= number_format($af->air_freight) ?></td>
              <td align="right"><?= number_format($af->total_air_freight) ?></td>
              <td></td>
            </tr>
          <?php } ?>

          <!-- LINING -->
          <?php
          $qttLining = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan, 'id_quotation' => $id, 'item' => 'lining'])->row();
          if ($qttLining) { ?>
            <tr>
              <td colspan="13">
              </td>
            </tr>
            <tr>
              <td colspan="13">
                <strong>Lining Material</strong>
              </td>
            </tr>
            <tr>
              <td>
                <?php
                $lining = $this->db->get_where('master_product_fabric', ['id_product' => $qttLining->id_product])->row();
                $t_hrg_kain = ($qttLining->harga_kain * $qttLining->t_kain) * $qttLining->qty;
                $total = ($t_hrg_kain - ($t_hrg_kain * $qttLining->disc_persen / 100)) * $qttLining->qty;
                ?>
                <strong><?= $lining->id_product ?></strong><br>
                <strong><?= $qttLining->cust_product_name ?></strong><br>
                Width : <?= $lining->width ?> cm<br>
                Weight : <?= $lining->weight ?> cm<br>
                Content : <?= $lining->content_percent ?>
              </td>
              <td align="center"><?= $qttLining->bukaan ?></td>
              <td align="center"><?= $room->width_window ?></td>
              <td align="center"><?= $room->height_window ?></td>
              <td align="center"><?= $lining->width ?></td>
              <td align="center"><?= $qttLining->round_up ?></td>
              <td align="center"><?= $qttLining->t_kain ?></td>
              <td align="center"><?= $qttLining->qty ?></td>
              <td align="center"><?= $qttLining->qty * $qttLining->t_kain ?></td>
              <td align="right"><?= number_format($qttLining->harga_kain) ?></td>
              <td align="right"><?= number_format($t_hrg_kain) ?></td>
              <!-- <td align="center"><?= $qttLining->disc_persen ?>%</td>
              <td align="right"><?= number_format($total) ?></td> -->
              <!-- <td align="center"><?= $lining->product_status ?></td> -->
              <td><?= $qttLining->keterangan ?></td>
            </tr>
            <?php
            $rail = $this->db->get_where('mp_rail', ['id_rail' => $qttLining->rail_material])->row();
            $total_rail = $rail->bc_selling_price * $qttLining->t_kain;
            ?>
            <tr>
              <td colspan="13"><strong>Rail Lining</strong></td>
            </tr>
            <tr>
              <td><strong>
                  <?= $rail->id_rail ?><br>
                  <?= $rail->name_product ?>
                </strong>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttLining->width ?></td>
              <td align="center"><?= $qttLining->qty ?></td>
              <td align="center"><?= $qttLining->qty * $qttLining->width ?></td>
              <td align="right"><?= number_format($qttLining->price) ?></td>
              <td align="right"><?= number_format($qttLining->t_price) ?></td>
              <td align=""><?= $qttLining->ket_rail ?></td>
            </tr>
            <?php
            $jahitan = $this->db->get_where('sewing', ['id_sewing' => $qttLining->jahitan])->row();
            $total_jahit = $jahitan->price * $qttLining->t_kain;
            ?>
            <tr>
              <td colspan="13"><strong>Jahitan Lining</strong></td>
            </tr>
            <tr>
              <td><?= $jahitan->item ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttLining->t_kain ?></td>
              <td align="center"><?= $qttLining->qty ?></td>
              <td align="center"><?= $qttLining->qty * $qttLining->t_kain ?></td>
              <td align="right"><?= number_format($jahitan->price) ?></td>
              <td align="right"><?= number_format($total_jahit) ?>,-</td>
              <td></td>
            </tr>
            <?php
            $afL = $this->db->get_where('qtt_air_freight', ['id_ruangan' => $room->id_ruangan, 'item' => 'lining'])->row();
            ?>
            <tr>
              <td><strong>Biaya Air Freight Lining</strong></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttLining->t_kain ?></td>
              <td align="center"><?= $qttLining->qty ?></td>
              <td align="center"><?= $qttLining->qty * $qttLining->t_kain ?></td>
              <td align="right"><?= number_format($afL->air_freight) ?></td>
              <td align="right"><?= number_format($afL->total_air_freight) ?></td>
              <td></td>
            </tr>
          <?php } ?>

          <!-- VITRAGE -->
          <?php
          $qttVitrage = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $room->id_ruangan, 'item' => 'vitrage'])->row();
          if ($qttVitrage) { ?>
            <tr>
              <td colspan="13">

              </td>
            </tr>
            <tr>
              <td colspan="13">
                <strong>Vitrage</strong>
              </td>
            </tr>
            <tr>
              <td>
                <?php
                $vitrage = $this->db->get_where('master_product_fabric', ['id_product' => $qttVitrage->id_product])->row();
                $t_hrg_kain = $qttVitrage->harga_kain * $qttVitrage->t_kain;
                $total = $t_hrg_kain - ($t_hrg_kain * $qttVitrage->disc_persen / 100);
                ?>
                <strong><?= $vitrage->id_product ?></strong><br>
                <strong><?= $qttVitrage->cust_product_name ?></strong><br>
                Width : <?= $vitrage->width ?> cm<br>
                Weight : <?= $vitrage->weight ?> cm<br>
                Content : <?= $vitrage->content_percent ?>
              </td>
              <td align="center"><?= $qttVitrage->bukaan ?></td>
              <td align="center"><?= $room->width_window ?></td>
              <td align="center"><?= $room->height_window ?></td>
              <td align="center"><?= $vitrage->width ?></td>
              <td align="center"><?= $qttVitrage->round_up ?></td>
              <td align="center"><?= $qttVitrage->t_kain ?></td>
              <td align="center"><?= $qttVitrage->qty ?></td>
              <td align="center"><?= $qttVitrage->qty * $qttVitrage->t_kain ?></td>
              <td align="right"><?= number_format($qttVitrage->harga_kain) ?></td>
              <td align="right"><?= number_format($t_hrg_kain) ?></td>
              <!-- <td align="center"><?= $qttVitrage->disc_persen ?>%</td>
              <td align="right"><?= number_format($total) ?></td> -->
              <!-- <td align="center"><?= $vitrage->product_status ?></td> -->
              <td><?= $qttVitrage->keterangan ?></td>
            </tr>
            <?php
            $rail_vitrage = $this->db->get_where('mp_rail', ['id_rail' => $qttVitrage->rail_material])->row();
            $total_rail = $rail_vitrage->bc_selling_price * $qttVitrage->t_kain;
            ?>
            <tr>
              <td colspan="13"><strong>Rail Vitrage</strong></td>
            </tr>
            <tr>
              <td><strong>
                  <?= $rail_vitrage->id_rail ?><br>
                  <?= $rail_vitrage->name_product ?>
                </strong>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttVitrage->width ?></td>
              <td align="center"><?= $qttVitrage->qty ?></td>
              <td align="center"><?= $qttVitrage->qty * $qttVitrage->width ?></td>
              <td align="right"><?= number_format($qttVitrage->price) ?></td>
              <td align="right"><?= number_format($qttVitrage->t_price) ?></td>
              <td align=""><?= $qttVitrage->ket_rail ?></td>
            </tr>
            <?php
            $jahitan_vitrage = $this->db->get_where('sewing', ['id_sewing' => $qttVitrage->jahitan])->row();
            $total_jahit = $jahitan_vitrage->price * $qttVitrage->t_kain;
            ?>
            <tr>
              <td colspan="13"><strong>Jahitan Vitrage</strong></td>
            </tr>
            <tr>
              <td><?= $jahitan_vitrage->item ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttVitrage->t_kain ?></td>
              <td align="center"><?= $qttVitrage->qty ?></td>
              <td align="center"><?= $qttVitrage->qty * $qttVitrage->t_kain ?></td>
              <td align="right"><?= number_format($jahitan_vitrage->price) ?></td>
              <td align="right"><?= number_format($total_jahit) ?></td>
              <td></td>
            </tr>
            <?php
            $afV = $this->db->get_where('qtt_air_freight', ['id_ruangan' => $room->id_ruangan, 'item' => 'vitrage'])->row();
            ?>
            <tr>
              <td><strong>Biaya Air Freight Vitrage</strong></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?= $qttVitrage->t_kain ?></td>
              <td align="center"><?= $qttVitrage->qty ?></td>
              <td align="center"><?= $qttVitrage->qty * $qttVitrage->t_kain ?></td>
              <td align="right"><?= number_format($afV->air_freight) ?></td>
              <td align="right"><?= number_format($afV->total_air_freight) ?></td>
              <td></td>
            </tr>
          <?php } ?>

          <!-- ACCESSORIESS -->
          <?php
          $qttAcc = $this->db->get_where('qtt_accessoriess', ['id_ruangan' => $room->id_ruangan])->result();
          if ($qttAcc) { ?>
            <tr>
              <td colspan="13"></td>
            </tr>
            <tr>
              <td colspan="13"><strong>Accessoriess</strong></td>
            </tr>
            <?php
            $total_acc = $acc->price * $acc->qty;
            foreach ($qttAcc as $acc) { ?>
              <tr>
                <td>
                  <?=
                    "<strong>" . $acc->id_accessories . "</strong> - <br>" .
                      $acc->name_accessories
                  ?>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="center"><?= $acc->qty ?></td>
                <td align="right"><?= number_format($acc->price) ?></td>
                <td align="right"><?= number_format($acc->sub_price) ?></td>
                <td></td>
              </tr>
            <?php
            }
            ?>
          <?php
          }
          ?>
        </tbody>
      <?php
      }
      ?>
    </table>
  </div>


  <!-- DELIVERY COST -->
  <legend class="legend">
    <h4>Detail Delivery Cost <span class="text-red">*</span></h4>
  </legend>
  <?php
  $qttDelivery = $this->db->get_where('qtt_delivery', ['id_quotation' => $data->id_quotation])->row();
  $city = $this->db->get_where('kabupaten', ['id_kab' => $qttDelivery->id_city])->row();
  ?>
  <table border="1" width="100%" style="font-size:12px;border-collapse: collapse">
    <tr>
      <th align="left">City</th>
      <th align="left">Delivery By</th>
      <th align="right">Delivery Cost</th>
      <th align="left">Keterangan</th>
    </tr>
    <tr>
      <td><?= $city->nama ?></td>
      <td><?= $qttDelivery->via ?></td>
      <td align="right"><?= number_format($qttDelivery->price) ?></td>
      <td><?= $qttDelivery->keterangan ?></td>
    </tr>
  </table>

  <!-- ACCOMODATION -->
  <?php
  $meals      = $this->db->get_where('qtt_meal_cost', ['id_quotation' => $data->id_quotation])->result();
  $transport  = $this->db->get_where('qtt_transport_cost', ['id_quotation' => $data->id_quotation])->result();
  $housing    = $this->db->get_where('qtt_housing_cost', ['id_quotation' => $data->id_quotation])->result();
  $other      = $this->db->get_where('qtt_other_cost', ['id_quotation' => $data->id_quotation])->result();

  if (!empty($meals) || !empty($transport) || !empty($housing) || !empty($other)) : ?>
    <legend class="legend">
      <h4>Detail Accomodation <span class="text-red">*</span></h4>
    </legend>
  <?php endif ?>

  <?php if (!empty($meals)) : ?>
    <strong><small for="">Meal & Pocket Money</small></strong>
    <table border="1" width="100%" style="font-size:12px;border-collapse: collapse">
      <tr>
        <th align="left">Area</th>
        <th align="center">Qty MP</th>
        <th align="center">Total Day</th>
        <th align="right">Cost MP/Day</th>
        <th align="right">Total</th>
        <th align="left">Notes</th>
      </tr>
      <?php foreach ($meals as $meal) : $mealArea = $this->db->get_where('kabupaten', ['id_kab' => $meal->area])->row(); ?>
        <tr>
          <td><?= $mealArea->nama ?></td>
          <td align="center"><?= $meal->qty_mp ?></td>
          <td align="center"><?= $meal->total_day ?></td>
          <td align="right"><?= number_format($meal->cost_mp_day) ?></td>
          <td align="right"><?= number_format($meal->total) ?></td>
          <td><?= $meal->notes ?></td>
        </tr>
      <?php endforeach ?>
    </table>
    <br>
  <?php endif ?>

  <?php if (!empty($transport)) : ?>
    <strong><small for="">Transportation</small></strong>
    <table border="1" width="100%" style="font-size:12px;border-collapse: collapse">
      <tr>
        <th align="">Item Cost</th>
        <th align="">Transportation</th>
        <th align="">Origin</th>
        <th align="">Destination</th>
        <th align="center">Qty MP</th>
        <th align="right">Total</th>
        <th align="left">Notes</th>
      </tr>
      <?php foreach ($transport as $trans) : $transportasi = $this->db->get_where('transportasi', ['trans_code' => $trans->item_cost])->row(); ?>
        <tr>
          <td><?= $transportasi->name_transportasi ?></td>
          <td align=""><?= $trans->transportation ?></td>
          <td align=""><?= $trans->origin ?></td>
          <td align=""><?= $trans->destination ?></td>
          <td align="center"><?= number_format($trans->qty_mp) ?></td>
          <td align="right"><?= number_format($trans->total) ?></td>
          <td><?= $meal->notes ?></td>
        </tr>
      <?php endforeach ?>
    </table>
    <br>
  <?php endif ?>

  <?php if (!empty($housing)) : ?>
    <strong> <small for="">Housing & Transport Site</small></strong>
    <table border="1" width="100%" style="font-size:12px;border-collapse: collapse">
      <tr>
        <th align="left">Area</th>
        <th align="center">Qty Mp</th>
        <th align="center">Amount Day</th>
        <th align="right">Cost</th>
        <th align="right">Total</th>
        <th align="left">Notes</th>
      </tr>
      <?php foreach ($housing as $house) : $areas = $this->db->get_where('kabupaten', ['id_kab' => $house->area])->row(); ?>
        <tr>
          <td><?= $areas->nama ?></td>
          <td align="center"><?= $house->qty_mp ?></td>
          <td align="center"><?= $house->amount_day ?></td>
          <td align="right"><?= number_format($house->cost) ?></td>
          <td align="right"><?= number_format($house->total) ?></td>
          <td><?= $meal->notes ?></td>
        </tr>
      <?php endforeach ?>
    </table>
    <br>
  <?php endif ?>

  <?php if (!empty($other)) : ?>
    <strong><small for="">Other Cost</small></strong>
    <table border="1" width="100%" style="font-size:12px;border-collapse: collapse">
      <tr>
        <th align="left">Item Cost</th>
        <th align="right">Total</th>
      </tr>
      <?php foreach ($other as $oth) : ?>
        <tr>
          <td><?= $oth->item ?></td>
          <td align="right"><?= number_format($oth->cost) ?></td>
        </tr>
      <?php endforeach ?>
    </table>
  <?php endif ?>
</body>

</html>