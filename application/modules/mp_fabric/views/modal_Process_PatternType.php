<?php

if (!empty($this->uri->segment(3))) {
  $getC		= $this->db->get_where('master_pattern_type',array('id_pattern_type'=>$id))->row();

}
$getI   = $this->db->query("SELECT MAX(id_pattern_type) AS max_id FROM master_pattern_type ORDER BY id_pattern_type ASC")->row();
//echo "$first_letter";
//exit;
$num = substr($getI->max_id,-5)+1;
$id_pattern_type = 'PT'.str_pad($num,5,"0",STR_PAD_LEFT);


?>
<form class="" id="form-PatternType" action="" method="post">
  <div class="box box-success">
	<div class="box-body" style="">
    <div class="row">
      <div class="col-sm-12">

        <section id="DETAIL_COLLECTION_IDENTITY">
          <table id="my-grid" class="table table-striped table-bordered table-hover table-condensed" width="100%">
            <tbody>
              <tr style='background-color: #175477 !important; color: white; font-size: 15px !important;'>
                <th class="text-center" colspan='2'>DETAIL COLLECTION</th>
              </tr>
              <tr id="my-grid-tr-id_collection">
                <td class="text-left vMid">Code <span class='text-red'>*</span></b></td>
                <td class="text-left">
                  <label class="label_view">
                    <?=$getC->id_pattern_type?>
                  </label>
                  <label class="label_input">
                    <input type="hidden" name="type" value="<?=empty($getC->id_pattern_type)?'add':'edit'?>">
                    <input type="text" class="form-control input input-sm required w50" name="id_pattern_type" id="id_pattern_type" value="<?=empty($getC->id_pattern_type)?$id_pattern_type:$getC->id_pattern_type?>" readonly>
                    <label class="label label-danger id_pattern_type hideIt">Code Can't be empty!</label>
                  </label>
                </td>
              </tr>

              <tr id="my-grid-tr-name_pattern_type">
                <td class="text-left vMid">Pattern Type <span class='text-red'>*</span></b></td>
                <td class="text-left">
                  <label class="label_view">
                    <?=$getC->name_pattern_type?>
                  </label>
                  <label class="label_input">
                  <?php
                  echo form_input(array('type'=>'text','id'=>'name_pattern_type','name'=>'name_pattern_type','class'=>'form-control input-sm required w60', 'placeholder'=>'Pattern Type Name','autocomplete'=>'off','value'=>empty($getC->name_pattern_type)?'':$getC->name_pattern_type))
                  ?>
                  <!--<a id="generate_id" class="btn btn-sm btn-primary" style="display:inline-block">Generate ID</a>-->
                  <label class="label label-danger name_pattern_type hideIt">Collection Name Can't be empty!</label>
                </label>
                </td>
              </tr>
            </tbody>
          </table>
        </section>

      </div>
    </div>
    <label class="label_input">
      <?php
        echo form_button(array('type'=>'button','class'=>'btn btn-md btn-success','style'=>'min-width:100px; float:right;','value'=>'save','content'=>'Save','id'=>'addPatternTypeSave')).' ';
      ?>
    </label>

	</div>
</div>
</form>

<style>
	.inSp{
		text-align: center;
		display: inline-block;
		width: 100px;
	}
	.inSp2{
		text-align: center;
		display: inline-block;
		width: 45%;
	}
	.inSpL{
		text-align: left;
	}
	.vMid{
		vertical-align: middle !important;
	}
  .w10{
		display: inline-block;
		width: 10%;
	}
  .w15{
		display: inline-block;
		width: 15%;
	}
  .w20{
		display: inline-block;
		width: 20%;
	}
  .w30{
		display: inline-block;
		width: 30%;
	}
  .w40{
		display: inline-block;
		width: 40%;
	}
  .w50{
		display: inline-block;
		width: 50%;
	}
  .w60{
		display: inline-block;
		width: 60%;
	}
  .w70{
		display: inline-block;
		width: 70%;
	}
  .w80{
		display: inline-block;
		width: 80%;
	}
  .w90{
		display: inline-block;
		width: 90%;
	}
  .w100{
		display: inline-block;
		width: 100%;
	}
  .inline-block{
		display: inline-block;
	}
  .checkbox-label:hover{
    cursor: pointer;
	}
  .hideIt{
    display: none;
  }
  .showIt{
    display: block;
  }

</style>

<script type="text/javascript">

	$(document).ready(function(){

    if ('<?= $this->uri->segment(4) ?>' == 'view') {
      $('.label_view').css("display","block");
      $('.label_input').css("display","none");
    }else {
      $('.label_view').css("display","none");
      $('.label_input').css("display","block");
    }
	});
</script>
