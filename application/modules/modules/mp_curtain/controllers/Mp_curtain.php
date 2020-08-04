<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * @author Ichsan
 * @copyright Copyright (c) 2019, Ichsan
 *
 * This is controller for Master Supplier
 */

class Mp_curtain extends Admin_Controller
{
    //Permission
    protected $viewPermission = 'Mp_curtain.View';
    protected $addPermission  = 'Mp_curtain.Add';
    protected $managePermission = 'Mp_curtain.Manage';
    protected $deletePermission = 'Mp_curtain.Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('Mp_curtain/Mp_curtain_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Curtain Data');
        $this->template->page_icon('fa fa-table');

        date_default_timezone_set('Asia/Bangkok');
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);
        $this->template->title('Curtain Accesories');
        $this->template->render('index');
    }

    public function getDataJSON(){
    		$requestData	= $_REQUEST;
    		$fetch			= $this->queryDataJSON(
          $requestData['activation'],
    			$requestData['search']['value'],
    			$requestData['order'][0]['column'],
    			$requestData['order'][0]['dir'],
    			$requestData['start'],
    			$requestData['length']
    		);
    		$totalData		= $fetch['totalData'];
    		$totalFiltered	= $fetch['totalFiltered'];
    		$query			= $fetch['query'];

    		$data	= array();
    		$urut1  = 1;
            $urut2  = 0;
    		foreach($query->result_array() as $row)
    		{
    			$total_data     = $totalData;
                $start_dari     = $requestData['start'];
                $asc_desc       = $requestData['order'][0]['dir'];
                if($asc_desc == 'asc')
                {
                    $nomor = $urut1 + $start_dari;
                }
                if($asc_desc == 'desc')
                {
                    $nomor = ($total_data - $start_dari) - $urut2;
                }

    			$nestedData 	= array();
    				$detail = "";
    			$nestedData[]	= "<div align='center'>".$nomor."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['id_product'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['name_product'])."</div>";
    			$nestedData[]	= "<div align='center'>".strtoupper($row['original_name'])."</div>";
    			$nestedData[]	= "<div align='center'>".strtoupper($row['type_product'])."</div>";
    			$nestedData[]	= "<div align='center'>".strtoupper($row['product_status'])."</div>";
    			if($this->auth->restrict($this->viewPermission) ) :
            $nestedData[]	= "<div style='text-align:center'>
              <a class='btn btn-sm btn-primary detail' href='javascript:void(0)' title='Detail' data-id_product='".$row['id_product']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-list'></span>
              </a>
              <a class='btn btn-sm btn-success edit' href='javascript:void(0)' title='Edit' data-id_product='".$row['id_product']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-edit'></span>
              </a>
              <a class='btn btn-sm btn-danger delete' href='javascript:void(0)' title='Delete' data-id_product = '".$row['id_product']."'  style='width:30px; display:inline-block'>
                <i class='fa fa-trash'></i>
              </a>
              </div>
      		      ";
            endif;
    			$data[] = $nestedData;
                $urut1++;
                $urut2++;
    		}

    		$json_data = array(
    			"draw"            	=> intval( $requestData['draw'] ),
    			"recordsTotal"    	=> intval( $totalData ),
    			"recordsFiltered" 	=> intval( $totalFiltered ),
    			"data"            	=> $data
    		);

    		echo json_encode($json_data);
  	}

  	public function queryDataJSON($activation, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL){
  		// echo $series."<br>";
  		// echo $group."<br>";
  		// echo $komponen."<br>";

      $where_activation = "";
  		if(!empty($activation)){
  			$where_activation = " AND a.activation = '".$activation."' ";
  		}

  		$sql = "
  			SELECT
  				a.*, b.nm_supplier
  			FROM
  				master_product_curtain_header a
  				LEFT JOIN master_supplier b ON b.id_supplier = a.id_supplier
  			WHERE 1=1
          ".$where_activation."
  				AND (
  				a.id_product LIKE '%".$this->db->escape_like_str($like_value)."%'
  				OR a.name_product LIKE '%".$this->db->escape_like_str($like_value)."%'
          OR a.type_product LIKE '%".$this->db->escape_like_str($like_value)."%'
          OR a.original_name LIKE '%".$this->db->escape_like_str($like_value)."%'
          OR a.product_status LIKE '%".$this->db->escape_like_str($like_value)."%'
  	        )
  		";

  		// echo $sql;

  		$data['totalData'] = $this->db->query($sql)->num_rows();
  		$data['totalFiltered'] = $this->db->query($sql)->num_rows();
  		$columns_order_by = array(
  			0 => 'nomor',
  			1 => 'id_product',
  			2 => 'name_product',
  			3 => 'original_name',
  			4 => 'type_product',
  			5 => 'product_status'
  		);

  		$sql .= " ORDER BY a.id_product ASC, ".$columns_order_by[$column_order]." ".$column_dir." ";
  		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

  		$data['query'] = $this->db->query($sql);
  		return $data;
  	}

    public function getDataPatternName(){
    		$requestData	= $_REQUEST;
    		$fetch			= $this->queryDataPatternName(
          $requestData['activation'],
    			$requestData['search']['value'],
    			$requestData['order'][0]['column'],
    			$requestData['order'][0]['dir'],
    			$requestData['start'],
    			$requestData['length']
    		);
    		$totalData		= $fetch['totalData'];
    		$totalFiltered	= $fetch['totalFiltered'];
    		$query			= $fetch['query'];

    		$data	= array();
    		$urut1  = 1;
            $urut2  = 0;
    		foreach($query->result_array() as $row)
    		{
    			$total_data     = $totalData;
                $start_dari     = $requestData['start'];
                $asc_desc       = $requestData['order'][0]['dir'];
                if($asc_desc == 'asc')
                {
                    $nomor = $urut1 + $start_dari;
                }
                if($asc_desc == 'desc')
                {
                    $nomor = ($total_data - $start_dari) - $urut2;
                }

    			$nestedData 	= array();
    				$detail = "";
    			$nestedData[]	= "<div align='center'>".$nomor."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['id_pattern'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['name_pattern'])."</div>";
    			$nestedData[]	= "<div align='center'>".strtoupper($row['nm_supplier'])."</div>";
    			if($this->auth->restrict($this->viewPermission) ) :
            $nestedData[]	= "<div style='text-align:center'>

              <a class='btn btn-sm btn-primary detail' href='javascript:void(0)' title='Detail' data-id_pattern='".$row['id_pattern']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-list'></span>
              </a>
              <a class='btn btn-sm btn-success edit' href='javascript:void(0)' title='Edit' data-id_pattern='".$row['id_pattern']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-edit'></span>
              </a>
              <a class='detail btn btn-sm btn-danger delete' href='javascript:void(0)' title='Delete' data-id_pattern = '".$row['id_pattern']."'  style='width:30px; display:inline-block'>
                <i class='fa fa-trash'></i>
              </a>
              </div>
      		      ";
            endif;
    			$data[] = $nestedData;
                $urut1++;
                $urut2++;
    		}

    		$json_data = array(
    			"draw"            	=> intval( $requestData['draw'] ),
    			"recordsTotal"    	=> intval( $totalData ),
    			"recordsFiltered" 	=> intval( $totalFiltered ),
    			"data"            	=> $data
    		);

    		echo json_encode($json_data);
  	}

  	public function queryDataPatternName($activation, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL){
  		// echo $series."<br>";
  		// echo $group."<br>";
  		// echo $komponen."<br>";

      $where_activation = "";
  		if(!empty($activation)){
  			$where_activation = " AND a.activation = '".$activation."' ";
  		}

  		$sql = "
  			SELECT
  				a.*, b.nm_supplier
  			FROM
  				child_supplier_pattern a
  				LEFT JOIN master_supplier b ON b.id_supplier = a.id_supplier
  			WHERE 1=1
          ".$where_activation."
  				AND (
  				a.id_supplier LIKE '%".$this->db->escape_like_str($like_value)."%'
          OR a.id_pattern LIKE '%".$this->db->escape_like_str($like_value)."%'
  				OR a.name_pattern LIKE '%".$this->db->escape_like_str($like_value)."%'
          OR b.nm_supplier LIKE '%".$this->db->escape_like_str($like_value)."%'
  	        )
  		";

  		// echo $sql;

  		$data['totalData'] = $this->db->query($sql)->num_rows();
  		$data['totalFiltered'] = $this->db->query($sql)->num_rows();
  		$columns_order_by = array(
  			0 => 'nomor',
  			1 => 'id_pattern',
  			2 => 'name_pattern',
  			3 => 'nm_supplier'
  		);

  		$sql .= " ORDER BY a.id_pattern ASC, ".$columns_order_by[$column_order]." ".$column_dir." ";
  		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

  		$data['query'] = $this->db->query($sql);
  		return $data;
  	}

    public function getDataSupplierType(){
    		$requestData	= $_REQUEST;
    		$fetch			= $this->queryDataSupplierType(
          $requestData['activation'],
    			$requestData['search']['value'],
    			$requestData['order'][0]['column'],
    			$requestData['order'][0]['dir'],
    			$requestData['start'],
    			$requestData['length']
    		);
    		$totalData		= $fetch['totalData'];
    		$totalFiltered	= $fetch['totalFiltered'];
    		$query			= $fetch['query'];

    		$data	= array();
    		$urut1  = 1;
            $urut2  = 0;
    		foreach($query->result_array() as $row)
    		{
    			$total_data     = $totalData;
                $start_dari     = $requestData['start'];
                $asc_desc       = $requestData['order'][0]['dir'];
                if($asc_desc == 'asc')
                {
                    $nomor = $urut1 + $start_dari;
                }
                if($asc_desc == 'desc')
                {
                    $nomor = ($total_data - $start_dari) - $urut2;
                }

    			$nestedData 	= array();
    				$detail = "";
    			$nestedData[]	= "<div align='center'>".$nomor."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['id_type'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['name_type'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['nm_supplier'])."</div>";
    			if($this->auth->restrict($this->viewPermission) ) :
            $nestedData[]	= "<div style='text-align:center'>

              <a class='btn btn-sm btn-primary detail' href='javascript:void(0)' title='Detail' data-id_type='".$row['id_type']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-list'></span>
              </a>
              <a class='btn btn-sm btn-success edit_SupplierType' href='javascript:void(0)' title='Edit' data-id_type='".$row['id_type']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-edit'></span>
              </a>
              <a class='detail btn btn-sm btn-danger delete' href='javascript:void(0)' title='Delete' data-id_type = '".$row['id_type']."'  style='width:30px; display:inline-block'>
                <i class='fa fa-trash'></i>
              </a>
              </div>
      		      ";
            endif;
    			$data[] = $nestedData;
                $urut1++;
                $urut2++;
    		}

    		$json_data = array(
    			"draw"            	=> intval( $requestData['draw'] ),
    			"recordsTotal"    	=> intval( $totalData ),
    			"recordsFiltered" 	=> intval( $totalFiltered ),
    			"data"            	=> $data
    		);

    		echo json_encode($json_data);
  	}

  	public function queryDataSupplierType($activation, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL){
  		// echo $series."<br>";
  		// echo $group."<br>";
  		// echo $komponen."<br>";

      $where_activation = "";
  		if(!empty($activation)){
  			$where_activation = " AND a.activation = '".$activation."' ";
  		}

  		$sql = "
  			SELECT
  				a.*, b.nm_supplier
  			FROM
  				child_supplier_type a
  				LEFT JOIN master_supplier b ON b.id_supplier = a.id_supplier
  			WHERE 1=1
          ".$where_activation."
  				AND (
  				a.id_supplier LIKE '%".$this->db->escape_like_str($like_value)."%'
          OR a.id_type LIKE '%".$this->db->escape_like_str($like_value)."%'
  				OR a.name_type LIKE '%".$this->db->escape_like_str($like_value)."%'
          OR b.nm_supplier LIKE '%".$this->db->escape_like_str($like_value)."%'
  	        )
  		";

  		// echo $sql;

  		$data['totalData'] = $this->db->query($sql)->num_rows();
  		$data['totalFiltered'] = $this->db->query($sql)->num_rows();
  		$columns_order_by = array(
  			0 => 'nomor',
  			1 => 'id_type',
  			2 => 'name_type',
  			3 => 'nm_supplier'
  		);

  		$sql .= " ORDER BY a.id_type ASC, ".$columns_order_by[$column_order]." ".$column_dir." ";
  		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

  		$data['query'] = $this->db->query($sql);
  		return $data;
  	}

    public function getDataProductCategory(){
    		$requestData	= $_REQUEST;
    		$fetch			= $this->queryDataProductCategory(
          $requestData['activation'],
    			$requestData['search']['value'],
    			$requestData['order'][0]['column'],
    			$requestData['order'][0]['dir'],
    			$requestData['start'],
    			$requestData['length']
    		);
    		$totalData		= $fetch['totalData'];
    		$totalFiltered	= $fetch['totalFiltered'];
    		$query			= $fetch['query'];

    		$data	= array();
    		$urut1  = 1;
            $urut2  = 0;
    		foreach($query->result_array() as $row)
    		{
    			$total_data     = $totalData;
                $start_dari     = $requestData['start'];
                $asc_desc       = $requestData['order'][0]['dir'];
                if($asc_desc == 'asc')
                {
                    $nomor = $urut1 + $start_dari;
                }
                if($asc_desc == 'desc')
                {
                    $nomor = ($total_data - $start_dari) - $urut2;
                }

    			$nestedData 	= array();
    				$detail = "";
    			$nestedData[]	= "<div align='center'>".$nomor."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['id_category'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['name_category'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['supplier_shipping'])."</div>";
    			if($this->auth->restrict($this->viewPermission) ) :
            $nestedData[]	= "<div style='text-align:center'>

              <a class='btn btn-sm btn-primary detail' href='javascript:void(0)' title='Detail' data-id_category='".$row['id_category']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-list'></span>
              </a>
              <a class='btn btn-sm btn-success edit_ProductCategory' href='javascript:void(0)' title='Edit' data-id_category='".$row['id_category']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-edit'></span>
              </a>
              <a class='detail btn btn-sm btn-danger delete' href='javascript:void(0)' title='Delete' data-id_category = '".$row['id_category']."'  style='width:30px; display:inline-block'>
                <i class='fa fa-trash'></i>
              </a>
              </div>
      		      ";
            endif;
    			$data[] = $nestedData;
                $urut1++;
                $urut2++;
    		}

    		$json_data = array(
    			"draw"            	=> intval( $requestData['draw'] ),
    			"recordsTotal"    	=> intval( $totalData ),
    			"recordsFiltered" 	=> intval( $totalFiltered ),
    			"data"            	=> $data
    		);

    		echo json_encode($json_data);
  	}

  	public function queryDataProductCategory($activation, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL){
  		// echo $series."<br>";
  		// echo $group."<br>";
  		// echo $komponen."<br>";

      $where_activation = "";
  		if(!empty($activation)){
  			$where_activation = " AND a.activation = '".$activation."' ";
  		}

  		$sql = "
  			SELECT
  				*
  			FROM
  				master_product_category a

  			WHERE 1=1
          ".$where_activation."
  				AND (
  				a.supplier_shipping LIKE '%".$this->db->escape_like_str($like_value)."%'
          OR a.id_category LIKE '%".$this->db->escape_like_str($like_value)."%'
  				OR a.name_category LIKE '%".$this->db->escape_like_str($like_value)."%'
  	        )
  		";

  		// echo $sql;

  		$data['totalData'] = $this->db->query($sql)->num_rows();
  		$data['totalFiltered'] = $this->db->query($sql)->num_rows();
  		$columns_order_by = array(
  			0 => 'nomor',
  			1 => 'id_category',
  			2 => 'name_category',
  			3 => 'supplier_shipping'
  		);

  		$sql .= " ORDER BY a.id_category ASC, ".$columns_order_by[$column_order]." ".$column_dir." ";
  		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

  		$data['query'] = $this->db->query($sql);
  		return $data;
  	}

    public function getIDAcc(){
  		$id_supplier				= $this->input->post('id_supplier');
      $getI   = $this->db->query("SELECT * FROM master_product_curtain_header WHERE id_supplier = '$id_supplier' ORDER BY id_product DESC LIMIT 1")->row();

      $id_product_2 = (int) $getI->id_product_2+1;
      //$id = $first_letter.str_pad($num,3,"0",STR_PAD_LEFT);
      $Arr_Kembali	= array(
        'id_product_2'		=>$id_product_2
      );
  		echo json_encode($Arr_Kembali);
	  }

    public function getID(){
  		$nm				= $this->input->post('nm');
      $getI   = $this->db->query("SELECT * FROM master_product_accesories WHERE id_supplier = '$id_supplier' ORDER BY id_product DESC LIMIT 1")->row();

      $id_product_2 = (int) $getI->id_product_2+1;
      //$id = $first_letter.str_pad($num,3,"0",STR_PAD_LEFT);
      $Arr_Kembali	= array(
        'id_product_2'		=>$id_product_2
      );
  		echo json_encode($Arr_Kembali);
	  }

    public function getOpt(){
      $id_selected     = ($this->input->post('id_selected'))?$this->input->post('id_selected'):'';
      $column          = ($this->input->post('column'))?$this->input->post('column'):'';
      $column_fill     = ($this->input->post('column_fill'))?$this->input->post('column_fill'):'';
      $idkey           = ($this->input->post('key'))?$this->input->post('key'):'';
      $column_name     = ($this->input->post('column_name'))?$this->input->post('column_name'):'';
      $table_name      = ($this->input->post('table_name'))?$this->input->post('table_name'):'';
      $act             = ($this->input->post('act'))?$this->input->post('act'):'';

      $where_col = $column." = '".$column_fill."'";
      $queryTable = "Select * FROM $table_name WHERE activation = 'active'";
      if (!empty($column_fill)) {
        $queryTable .= " AND ".$where_col;
      }
      $getTable = $this->db->query($queryTable)->result_array();
      if ($act == 'free') {
        //echo count($getTable);
        //exit;
        if (count($getTable) == 0) {
          $queryTable = "Select * FROM $table_name WHERE 1=1 AND ".$column." IS NULL OR ".$column." = ''";
          $getTable = $this->db->query($queryTable)->result_array();
        }
        //echo count($getTable);
        //exit;
      }
      $html = '<option value="">Choose An Option</option>';
      if ($id_selected == 'multiple') {
        $html = '';
      }
      foreach ($getTable as $key => $vc) {
        $id_key = $vc[$idkey];//${'vc'.$key};
        $name = $vc[$column_name];//${'vc'.$column_name};
        if (!empty($id_selected)) {
          if ($id_key == $id_selected) {
            $active = 'selected';
          }else {
            $active = '';
          }
        }
        $html .= '<option value="'.$id_key.'" '.$active.'>'.$name.'</option>';
      }
      $Arr_Kembali	= array(
        'html'		=>$html
      );
      echo json_encode($Arr_Kembali);
    }

    public function getVal(){
      $id_selected     = ($this->input->post('id_selected'))?$this->input->post('id_selected'):'';
      $column          = ($this->input->post('column'))?$this->input->post('column'):'';
      $column_fill     = ($this->input->post('column_fill'))?$this->input->post('column_fill'):'';
      $idkey           = ($this->input->post('key'))?$this->input->post('key'):'';
      $column_name     = ($this->input->post('column_name'))?$this->input->post('column_name'):'';
      $table_name      = ($this->input->post('table_name'))?$this->input->post('table_name'):'';
      $act             = ($this->input->post('act'))?$this->input->post('act'):'';

      $where_col = $column." = '".$column_fill."'";
      $queryTable = "Select * FROM $table_name WHERE $idkey = '$id_selected' ";
      $getTable = $this->db->query($queryTable)->result_array();
      //echo $queryTable;
      //exit;
      $html = $getTable[0][$column];

      $Arr_Kembali	= array(
        'html'		=>$html
      );
      echo json_encode($Arr_Kembali);
    }

    public function modal_Process($page="",$action="",$id=""){
      $this->template->set('action', $action);
      $this->template->set('id', $id);
      if ($page == 'Curtain') {
        $this->template->render('modal_Process_Curtain');
      }elseif ($page == 'basicComponent') {
        $this->template->render('modal_Process_basicComponent');
      }elseif ($page == 'ProductCategory') {
        $this->template->render('modal_Process_ProductCategory');
      }
  	}

    public function modal_Helper($action="",$id_sup=""){
      $this->template->set('action', $action);
      $this->template->set('id', $id_sup);
      if ($action == 'Ci') {
        $this->template->render('modal_Helper_Ci');
      }else {
        $this->template->render('modal_Helper');
      }
  	}

    public function saveCurtain(){
  		$data                 = $this->input->post();
      /*?>
      <pre>
      <?php
      print_r($data);
      ?>
      <pre>
      <?php
      exit;*/
      $type                 = $data['type'];
      $id_product           = empty($data['id_product_1'])?'':$data['id_product_1']."-".$data['id_product_2'];
      $name_product         = empty($data['name_product'])?'':$data['name_product'];
      $product_photo        = empty($data['product_photo'])?'':$data['product_photo'];
      $original_name        = empty($data['original_name'])?'':$data['original_name'];
      $id_supplier          = empty($data['id_supplier'])?'':$data['id_supplier'];
      $buy_price            = empty($data['buy_price'])?'':$data['buy_price'];
      $selling_price        = empty($data['selling_price'])?'':$data['selling_price'];
      $product_status       = empty($data['product_status'])?'':$data['product_status'];
      $id_colour            = empty($data['id_colour'])?'':$data['id_colour'];
      $description          = empty($data['description'])?'':$data['description'];
      $activation           = empty($data['activation'])?'':$data['activation'];
      $warranty             = empty($data['warranty'])?'':$data['warranty'];
      $width                = empty($data['width'])?'':$data['width'];
      $height               = empty($data['height'])?'':$data['height'];
      $weight               = empty($data['weight'])?'':$data['weight'];
      $m1                   = empty($data['m1'])?'':$data['m1'];
      $m2                   = empty($data['m2'])?'':$data['m2'];
      $type_product         = empty($data['type_product'])?'':$data['type_product'];
      $type_component       = empty($data['type_component'])?'':$data['type_component'];
      $min_order            = empty($data['min_order'])?'':$data['min_order'];
      if ($data['type_accesories'] == 'Non Component') {
        for ($i=0; $i < count($data['id_component']); $i++) {
          $detail[$i]['id_product']       = $id_product;
          $detail[$i]['id_component']     = $data['id_component'][$i];
          $detail[$i]['name_component']   = $data['name_component'][$i];
          $detail[$i]['price_component']  = $data['price_component'][$i];
          $detail[$i]['qty_component']    = $data['qty_component'][$i];
          $detail[$i]['uom_component']    = $data['uom_component'][$i];
          $detail[$i]['subt_component']   = $data['subt_component'][$i];
        }
      }
      $filelama             =   $data['filelama'];

      ##UPLOAD

        $path           =   './assets/img/master_curtain/'; //path folder

        $config = array(
                'upload_path' => './assets/img/master_curtain/',
                'allowed_types' => 'gif|jpg|png|jpeg|JPG|PNG',
                'file_name' => 'photo_curtain_'.$id_product,
                'file_ext_tolower' => TRUE,
                'overwrite' => TRUE,
                'max_size' => 2048,
                //'max_width' => 1024,
                //'max_height' => 768,
                //'min_width' => 10,
                //'min_height' => 7,
                //'max_filename' => 0,
                'remove_spaces' => TRUE
                );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('product_photo')){
            $result = $this->upload->display_errors();
        }else{

          $ext = end((explode(".", $_FILES['product_photo']['name'])));
          $name_pic = 'photo_curtain_'.$id_product.".".$ext;
          $paths = $_SERVER['DOCUMENT_ROOT'].'assets/img/master_curtain/'.$name_pic;
          if (file_exists($paths)) {
            unlink($paths);
          }
          $data_foto  = array('upload_data' => $this->upload->data('product_photo'));
        }
      ##END UPLOAD
      /*
      echo $result;
      ?>
      <pre>
        <?=print_r($data)?>
      </pre>
      <?php
      exit;
      */
      //DATA INSERT
      $insertData = array(
        'id_product'      =>  $id_product,
        'name_product'    =>  $name_product,
        'product_photo'   =>  $product_photo,
        'original_name'   =>  $original_name,
        'id_supplier'     =>  $id_supplier,
        'buy_price'       =>  $buy_price,
        'selling_price'   =>  $selling_price,
        'product_status'  =>  $product_status,
        'id_colour'       =>  $id_colour,
        'description'     =>  $description,
        'activation'      =>  $activation,
        'warranty'        =>  $warranty,
        'width'           =>  $width,
        'height'          =>  $height,
        'weight'          =>  $weight,
        'type_product'    =>  $type_product,
        'type_component'  =>  $type_component,
        'min_order'       =>  $min_order,
        'created_on'      =>  date('Y-m-d H:i:s'),
        'created_by'      =>  $this->auth->user_id()

      );

      $this->db->trans_begin();

      //FABRIC DATA
      if ($data['type'] == 'edit') {
        $this->db->where('id_product',$id_product)->update('master_product_curtain_header',$insertData);
      }else {
        $numID = $this->db->get_where('master_product_curtain', array('id_product'=>$id_product))->num_rows();
        if ($numID > 0) {
          $Arr_Kembali	= array(
            'pesan'		=>'Failed Add Changes. Code already exist ...',
            'status'	=> 0
          );
          echo json_encode($Arr_Kembali);
          exit;
        }else {
          $this->db->insert('master_product_curtain',$insertData);
        }
      }

      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'pesan'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, '.$data['type'].' Supplier Data '.$id_supplier.' With Name '.$nm_supplier;
        $status = 0;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      else{
        $this->db->trans_commit();
        $Arr_Kembali	= array(
          'pesan'		=>'Success Save Item. Thanks ...',
          'status'	=> 1
        );

        $keterangan = 'SUCCESS, '.$data['type'].' Brand Data '.$id_supplier.' With Name '.$nm_supplier;
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

  		echo json_encode($Arr_Kembali);
    }

    public function deleteData(){
      $id_product				= $this->input->post('id_product');
      $this->db->trans_begin();
      $getCat   = $this->db->where('id_product',$id_product)->update('master_product_curtain', array('activation'=>'nonaktif'));
      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'msg'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, Delete Customer Data '.$id_product;
        $status = 0;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      else{
        $this->db->trans_commit();
        $Arr_Kembali	= array(
          'msg'		=>'Success Delete Item. Thanks ...',
          'status'	=> 1
        );

        $keterangan = 'SUCCESS, Delete Customer Data '.$id_product;
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

  		echo json_encode($Arr_Kembali);
	  }

    public function saveBrand(){
  		$data				= $this->input->post();
      $counter = ($this->db->get('master_product_brand')->num_rows())+1;

      $this->db->trans_begin();
      if ($data['type'] == 'edit') {
        $id_supplier = $data['id_supplier'];
        $insertData	= array(
          'nm_supplier'	=> strtoupper($data['nm_supplier']),
          'modified_on'	=> date('Y-m-d H:i:s'),
          'modified_by'	=> $this->auth->user_id()
        );
        $this->db->where('id_brand',$data['id_brand'])->update('master_product_brand',$insertData);
      }else {
        $id_brand = "MPB".str_pad($counter, 3, "0", STR_PAD_LEFT);
        $insertData	= array(
          'id_brand'    => $id_brand,
          'name_brand'	=> strtoupper($data['name_brand']),
          'activation'  => "active",
          'created_on'	=> date('Y-m-d H:i:s'),
          'created_by'	=> $this->auth->user_id()
        );
        $this->db->insert('master_product_brand',$insertData);
      }
      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'pesan'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, '.$data['type'].' Brand Data '.$id_brand;
        $status = 0;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      else{
        $this->db->trans_commit();
        $Arr_Kembali	= array(
          'pesan'		=>'Success Save Item. Thanks ...',
          'status'	=> 1
        );

        $keterangan = 'SUCCESS, '.$data['type'].' Brand Data '.$id_brand;
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

  		echo json_encode($Arr_Kembali);
    }

    public function saveSupplierType(){
  		$data				= $this->input->post();
      $counter = ((int) substr($this->db->query("select * From child_supplier_type ORDER BY id_type DESC LIMIT 1")->row()->id_type,-5))+1;

      $this->db->trans_begin();
      if ($data['type'] == 'edit') {
        $id_type = $data['id_type'];
        $insertData	= array(
          'name_type'	=> strtoupper($data['name_type']),
          //'activation'	=> strtoupper($data['activation']),
          'modified_on'	=> date('Y-m-d H:i:s'),
          'modified_by'	=> $this->auth->user_id()
        );
        $this->db->where('id_type',$data['id_type'])->update('child_supplier_type',$insertData);
      }else {
        $id_type = "ST".str_pad($counter, 5, "0", STR_PAD_LEFT);
        $insertData	= array(
          'id_type'    => $id_type,
          'name_type'	=> strtoupper($data['name_type']),
          'activation'  => "active",
          'created_on'	=> date('Y-m-d H:i:s'),
          'created_by'	=> $this->auth->user_id()
        );
        $this->db->insert('child_supplier_type',$insertData);
      }
      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'pesan'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, '.$data['type'].' Supplier Type Data '.$id_brand;
        $status = 0;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      else{
        $this->db->trans_commit();
        $Arr_Kembali	= array(
          'pesan'		=>'Success Save Item. Thanks ...',
          'status'	=> 1
        );

        $keterangan = 'SUCCESS, '.$data['type'].' Supplier Type Data '.$id_brand;
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

  		echo json_encode($Arr_Kembali);
    }

    public function saveProductCategory(){
  		$data				= $this->input->post();
      $counter = ((int) substr($this->db->query("select * From master_product_category ORDER BY id_category DESC LIMIT 1")->row()->id_category,-4))+1;

      $this->db->trans_begin();
      if ($data['type'] == 'edit') {
        $id_category = $data['id_category'];
        $insertData	= array(
          'name_category'	=> strtoupper($data['name_category']),
          'supplier_shipping'	=> strtoupper($data['supplier_shipping']),
          'modified_on'	=> date('Y-m-d H:i:s'),
          'modified_by'	=> $this->auth->user_id()
        );
        $this->db->where('id_category',$data['id_category'])->update('master_product_category',$insertData);
      }else {
        $id_category = "PCN".str_pad($counter, 4, "0", STR_PAD_LEFT);
        $insertData	= array(
          'id_category'    => $id_category,
          'name_category'	=> strtoupper($data['name_category']),
          'supplier_shipping'	=> strtoupper($data['supplier_shipping']),
          'activation'  => "active",
          'created_on'	=> date('Y-m-d H:i:s'),
          'created_by'	=> $this->auth->user_id()
        );
        $this->db->insert('master_product_category',$insertData);
      }
      //$this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'pesan'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, '.$data['type'].' Supplier Type Data '.$id_brand;
        $status = 0;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      else{
        $this->db->trans_commit();
        $Arr_Kembali	= array(
          'pesan'		=>'Success Save Item. Thanks ...',
          'status'	=> 1
        );

        $keterangan = 'SUCCESS, '.$data['type'].' Supplier Type Data '.$id_brand;
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

  		echo json_encode($Arr_Kembali);
    }

    public function print_request($id)
    {
        $id_supplier = $id;
        $mpdf = new mPDF('', '', '', '', '', '', '', '', '', '');
        $mpdf->SetImportUse();
        $mpdf->RestartDocTemplate();

        $sup_data = $this->Supplier_model->print_data_supplier($id_supplier);

        $this->template->set('sup_data', $sup_data);
        $show = $this->template->load_view('print_data', $data);

        $this->mpdf->AddPage('P');
        $this->mpdf->WriteHTML($show);
        $this->mpdf->Output();
    }

    public function print_rekap()
    {
        $mpdf = new mPDF('', '', '', '', '', '', '', '', '', '');
        $mpdf->SetImportUse();
        $mpdf->RestartDocTemplate();

        $rekap = $this->Supplier_model->rekap_data()->result_array();

        $this->template->set('rekap', $rekap);

        $show = $this->template->load_view('print_rekap', $data);

        $this->mpdf->AddPage('L');
        $this->mpdf->WriteHTML($show);
        $this->mpdf->Output();
    }

    public function downloadExcel()
    {
        $rekap = $this->Supplier_model->rekap_data()->result_array();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17);

        $objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);

        $header = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Verdana',
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:J2')
                ->applyFromArray($header)
                ->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:J2');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Rekap Data Supplier')
            ->setCellValue('A3', 'No.')
            ->setCellValue('B3', 'ID Supplier')
            ->setCellValue('C3', 'Nama Supplier')
            ->setCellValue('D3', 'Negara')
            ->setCellValue('E3', 'Alamat')
            ->setCellValue('F3', 'No Telpon /  Fax')
            ->setCellValue('G3', 'Kontak Person')
            ->setCellValue('H3', 'Hp Kontak Person / WeChat ID')
            ->setCellValue('I3', 'Email')
            ->setCellValue('J3', 'Status');

        $ex = $objPHPExcel->setActiveSheetIndex(0);
        $no = 1;
        $counter = 4;
        foreach ($rekap as $row):
            $ex->setCellValue('A'.$counter, $no++);
        $ex->setCellValue('B'.$counter, strtoupper($row['id_supplier']));
        $ex->setCellValue('C'.$counter, $row['nm_supplier']);
        $ex->setCellValue('D'.$counter, strtoupper($row['nm_negara']));
        $ex->setCellValue('E'.$counter, $row['alamat']);
        $ex->setCellValue('F'.$counter, $row['telpon'].' / '.$row['fax']);
        $ex->setCellValue('G'.$counter, $row['cp']);
        $ex->setCellValue('H'.$counter, $row['hp_cp'].' / '.$row['id_webchat']);
        $ex->setCellValue('I'.$counter, $row['email']);
        $ex->setCellValue('J'.$counter, $row['sts_aktif']);

        $counter = $counter + 1;
        endforeach;

        $objPHPExcel->getProperties()->setCreator('Yunaz Fandy')
            ->setLastModifiedBy('Yunaz Fandy')
            ->setTitle('Export Rekap Data Supplier')
            ->setSubject('Export Rekap Data Supplier')
            ->setDescription('Rekap Data Supplier for Office 2007 XLSX, generated by PHPExcel.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('PHPExcel');
        $objPHPExcel->getActiveSheet()->setTitle('Rekap Data Supplier');
        ob_end_clean();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        header('Chace-Control: no-store, no-cache, must-revalation');
        header('Chace-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ExportRekapSupplier'.date('Ymd').'.xls"');

        $objWriter->save('php://output');
    }

}
