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

class Quotation_open extends Admin_Controller
{
    //Permission
    protected $viewPermission = 'Quotation_open.View';
    protected $addPermission  = 'Quotation_open.Add';
    protected $managePermission = 'Quotation_open.Manage';
    protected $deletePermission = 'Quotation_open.Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('Quotation_open/Quotation_open_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Quotation');
        $this->template->page_icon('fa fa-quote-right');

        date_default_timezone_set('Asia/Bangkok');
    }
 
    public function index()
    {
        $this->auth->restrict($this->viewPermission);
        $this->template->title('Quotation');
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
    			$nestedData[]	= "<div align='left'>".strtoupper($row['id_quotation'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['date_quotation'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['nm_customer'])."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['nama_karyawan'])."</div>";
    			$nestedData[]	= "<div align='right'>".strtoupper(number_format($row['grand_total']))."</div>";
    			$nestedData[]	= "<div align='center'>".strtoupper($row['status'])."</div>";
    			if($this->auth->restrict($this->viewPermission) ):
            $nestedData[]	= "<div style='text-align:center'>
              <a class='btn btn-sm btn-warning view' href='javascript:void(0)' title='View' data-id_quotation='".$row['id_quotation']."' style='width:30px; display:inline-block'>
                <span class='fa fa-eye'></span> 
              </a>
              <a class='btn btn-sm btn-primary edit' href='javascript:void(0)' title='Edit' data-id_quotation='".$row['id_quotation']."' style='width:30px; display:inline-block'>
                <span class='fa fa-edit'></span>
              </a> 
			  <a class='btn btn-sm btn-danger pdf' href='javascript:void(0)' title='PDF' data-id_quotation = '".$row['id_quotation']."'  style='width:30px; display:inline-block'>
                <i class='fa fa-file-pdf-o'></i>
              </a>
              <a class='btn btn-sm btn-info upload' href='javascript:void(0)' title='Upload' data-id_quotation = '".$row['id_quotation']."'  style='width:30px; display:inline-block'>
                <i class='fa fa-upload'></i>
              </a>
              <a class='btn btn-sm btn-success _close' href='javascript:void(0)' title='Close' data-id_quotation = '".$row['id_quotation']."'  style='width:30px; display:inline-block'>
                <i class='fa fa-check'></i>
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
		
		$sql = "SELECT
				  a.id_quotation,a.date_quotation,b.nm_customer,c.nama_karyawan, a.grand_total,a.status,a.activation
				FROM
				  quotation_header a INNER JOIN customer b ON a.id_customer = b.id_customer
				   INNER JOIN karyawan c ON a.id_karyawan = c.id_karyawan WHERE 1=1
				".$where_activation." 
				AND (
  				a.id_quotation LIKE '%".$this->db->escape_like_str($like_value)."%'
  				OR a.status LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.nm_customer LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR c.nama_karyawan LIKE '%".$this->db->escape_like_str($like_value)."%'
  	        )
			";

  		$data['totalData'] = $this->db->query($sql)->num_rows();
  		$data['totalFiltered'] = $this->db->query($sql)->num_rows();
  		$columns_order_by = array(
  			0 => 'nomor',
  			1 => 'id_quotation',
  			2 => 'date_quotation',
  			3 => 'nm_customer',
  			4 => 'nama_karyawan',
  			5 => 'grand_total',
  			6 => 'status'
  		);

  		$sql .= " ORDER BY a.id_quotation ASC, ".$columns_order_by[$column_order]." ".$column_dir." ";
  		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

  		$data['query'] = $this->db->query($sql);
  		return $data;
  	}

    public function getDataCategory(){
    		$requestData	= $_REQUEST;
    		$fetch			= $this->queryDataCategory(
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
    				$detail 	= "";
    			$nestedData[]	= "<div align='center'>".$nomor."</div>";
    			$nestedData[]	= "<div align='left'>".strtoupper($row['nm_categori'])."</div>";
    			if($this->auth->restrict($this->viewPermission) ) :
            $nestedData[]	= "<div style='text-align:center'>

              <!--<a class='btn btn-sm btn-primary detail' href='javascript:void(0)' title='Detail' data-id_category='".$row['id_categori']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-list'></span>-->
              </a>
              <a class='btn btn-sm btn-success edit_cat' href='javascript:void(0)' title='Edit' data-id_category='".$row['id_categori']."' style='width:30px; display:inline-block'>
                <span class='glyphicon glyphicon-edit'></span>
              </a>
              <a class='btn btn-sm btn-danger delete_cat' href='javascript:void(0)' title='Delete' data-id_category = '".$row['id_categori']."'  style='width:30px; display:inline-block'>
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

  	public function queryDataCategory($activation, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL){
  		// echo $series."<br>";
  		// echo $group."<br>";
  		// echo $komponen."<br>";

      $where_activation = "";
  		if(!empty($activation)){
  			$where_activation = " AND a.activation = '".$activation."' ";
  		}

  		$sql = "
  			SELECT
  				a.*
  			FROM
  				category a WHERE 1=1
          ".$where_activation."
  				AND a.deleted ='0' AND (
  				a.id_categori LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.nm_categori LIKE '%".$this->db->escape_like_str($like_value)."%'
  				
  	        )
  		";

  		// echo $sql;

  		$data['totalData'] = $this->db->query($sql)->num_rows();
  		$data['totalFiltered'] = $this->db->query($sql)->num_rows();
  		$columns_order_by = array(
  			0 => 'nomor',
  			1 => 'nm_categori'
  		);

  		$sql .= " ORDER BY a.id_categori ASC, ".$columns_order_by[$column_order]." ".$column_dir." ";
  		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

  		$data['query'] = $this->db->query($sql);
  		return $data;
  	}

    public function getID(){
	  $id				= $this->input->post('id');
      $first_letter 	= strtoupper(substr($id, 0, 2));
      $getI   			= $this->db->query("SELECT * FROM quotation_header WHERE LEFT(id_quotation,2) = '$first_letter' ORDER BY id_quotation DESC LIMIT 1")->row();
      //echo "$first_letter";
      //exit;
      $num = substr($getI->id_quotation,2,5)+1;
      $id = $first_letter.str_pad($num,5,"0",STR_PAD_LEFT);
      $Arr_Kembali	= array(
        'id'		=>$id
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
	  // echo "<pre>";
	  // print_r($this->input->post());
	  // echo "<pre>";
	  // exit;
      $where_col = $column." = '".$column_fill."'";
      $queryTable = "Select * FROM $table_name WHERE 1=1";
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
      if ($page == 'Quotation') {
		$data = $this->db->get('master_product')->result();
		$this->template->set('data',$data);
        $this->template->render('modal_Process_Quotation');
      }
  	}
	
	public function list_barang(){
		
		$id = $this->input->post('id');
		// print_r($id);
			
		if ($id != ''){
			if ($id == '1'){				
				$session       = $this->session->userdata('app_session');
				$itembarang    = $this->db->query("SELECT * FROM master_product_fabric")->result();
				$this->template->set('itembarang',$itembarang);
				$this->template->render('list_barang');
			} else {
				echo "Data kosong";
			}
		} else {
			// echo "Data asdsadasd";
			
			// $session       = $this->session->userdata('app_session');
			// $this->template->set('itembarang',$itembarang);
			// $this->template->title('Item Barang');
		
		}

    }
	
	public function addFee(){
		$session       = $this->session->userdata('app_session');
		$data    = $this->db->query("SELECT * FROM karyawan")->result();
		$this->template->set('karyawan',$data);
		$this->template->render('list_karyawan');

    }
	
	public function dataCustomer(){
		
		$id_cust = $this->input->post('id_cust');
		// print_r($id);
			
			
		$session       = $this->session->userdata('app_session');
		$pic    = $this->db->query("SELECT * FROM child_customer_pic where id_customer = '$id_cust'")->row();
		$customer    = $this->db->query("SELECT * FROM master_customer where id_customer = '$id_cust'")->row();
		
		$Arr = array (
			'customer' 	=> $customer,
			'pic'		=> $pic
		);
		
		echo json_encode($Arr);
	
	}
	
    public function addQuotation(){
		$this->template->set('id', $id);
		$data = $this->db->get('master_product')->result();
		$this->template->title('Add New Quotation');
		$this->template->set('data',$data);
        $this->template->render('form_add_quotation');
  	}
	
	public function get_item_barang(){
        $idbarang = $_GET['idbarang'];
        $session            = $this->session->userdata('app_session');
        $datbarang = $this->db->get('master_product_fabric')->result();

        echo json_encode($datbarang);
		
	}
	
	public function get_karyawan(){
        $idbarang 	= $_GET['id_kar'];
        $session    = $this->session->userdata('app_session');
        $datbarang 	= $this->db->get('karyawan')->result();

        echo json_encode($datbarang);
		
	}
	
    public function modal_Helper($action="",$id_sup=""){
      $this->template->set('action', $action);
      $this->template->set('id', $id_sup);
  		$this->template->render('modal_Helper');
  	}

    public function saveQuotation(){
		$data                 = $this->input->post();
		$type                 = $data['type'];
		echo "<pre>";
		print_r($data);
		echo "<pre>";
        
      $this->db->trans_begin();
   
      //SUPPLIER DATA
      if ($data['type'] == 'edit') {

        $insertData	= array(
		  // 'id_delivery'      	= $data['id_delivery'],
		  'id_provinsi'         => $data['id_provinsi'],
		  'id_kabupaten'        => $data['id_kota'],
		  'via'           		=> $data['via'],
		  'supplier'          	=> $data['supplier'],
		  'berat'    			=> $data['weight'],
		  'item_cost'    		=> str_replace(",","",$data['item_cost']),
		  'duration'    		=> $data['duration'],
		  'status'    			=> $data['package'],
		  'description'    		=> $data['description'],
		  'activation'          => $data['activation'],
          'modified_on'	        => date('Y-m-d H:i:s'),
          'modified_by'	        => $this->auth->user_id()
        );
        $this->db->where('id_delivery',$data['id_delivery'])->update('delivery',$insertData);
      }else {
        // $numID = $this->db->get_where('id_accomodation', array('id_accomodation'=>$id_accomodation))->num_rows();
        // if ($numID > 0) {
          // $nm				= $nm_supplier;
          // $first_letter = strtoupper(substr($nm, 0, 1));
          // $getI   = $this->db->query("SELECT * FROM master_supplier WHERE LEFT(id_supplier,1) = '$first_letter' ORDER BY id_supplier DESC LIMIT 1")->row();
          // echo "$first_letter";
          // exit;
          // $num = substr($getI->id_supplier,1,3)+1;
          // $id_supplier = $first_letter.str_pad($num,3,"0",STR_PAD_LEFT);
        // }

        $insertData	= array(
          'id_delivery'      	=> $data['id_delivery'],
		  'id_provinsi'         => $data['id_provinsi'],
		  'id_kabupaten'        => $data['id_kota'],
		  'via'           		=> $data['via'],
		  'supplier'          	=> $data['supplier'],
		  'berat'    			=> $data['weight'],
		  'item_cost'    		=> str_replace(",","",$data['item_cost']),
		  'duration'    		=> $data['duration'],
		  'status'    			=> $data['package'],
		  'description'    		=> $data['description'],
		  'activation'          => $data['activation'],
          'created_on'          => date('Y-m-d H:i:s'),
          'created_by'          => $this->auth->user_id()
        );
        $this->db->insert('delivery',$insertData);
      }

      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'pesan'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, '.$data['type'].' Delivery Data '.$id_delivery.' With detail '.$detail;
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

        $keterangan = 'SUCCESS, '.$data['type'].' Accomodation Data '.$id_accomodation.' With detail '.$detail;
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
      $id_delivery		= $this->input->post('id_delivery');
      $this->db->trans_begin();
      $getCat   = $this->db->where('id_delivery',$id_delivery)->update('delivery', array('activation'=>'nonaktif'));
      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'msg'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, Delete Delivery Data '.$id_delivery;
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

        $keterangan = 'SUCCESS, Delete Delivery Data '.$id_delivery;
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

  		echo json_encode($Arr_Kembali);
	  }
	  
	  public function deleteCat(){
      $id_category		= $this->input->post('id_category');
      $this->db->trans_begin();
      $getCat   = $this->db->where('id_categori',$id_category)->update('category', array('activation'=>'inactive'));
      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'msg'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, Delete Accomodation Data '.$id_supplier;
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

        $keterangan = 'SUCCESS, Delete Accomodation Data '.$id_supplier;
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

    public function saveCategory(){
  	  $data				= $this->input->post();
      // $counter = ((int) substr($this->db->query("select * From master_product_category ORDER BY id_category DESC LIMIT 1")->row()->id_category,-4))+1;

      $this->db->trans_begin();
      if ($data['type'] == 'edit') {
        $id_category = $data['id_category'];
        $insertData	= array(
          'nm_categori'	=> strtoupper($data['name_category']),
          'modified_on'	=> date('Y-m-d H:i:s'),
          'modified_by'	=> $this->auth->user_id()
        );
        $this->db->where('id_categori',$data['id_category'])->update('category',$insertData);
      }else {
        // $id_category = "PCN".str_pad($counter, 4, "0", STR_PAD_LEFT);
        $insertData	= array(
          'id_categori' => $id_category,
          'nm_categori'	=> strtoupper($data['name_category']),
          'activation'  => "active",
          'created_on'	=> date('Y-m-d H:i:s'),
          'created_by'	=> $this->auth->user_id()
        );
        $this->db->insert('category',$insertData);
      }
      //$this->db->trans_complete();

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $Arr_Kembali	= array(
          'pesan'		=>'Failed Add Changes. Please try again later ...',
          'status'	=> 0
        );
        $keterangan = 'FAILED, '.$data['type'].' Category Data '.$id_brand;
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

        $keterangan = 'SUCCESS, '.$data['type'].' Category Type Data '.$id_brand;
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

    public function getCountryOpt(){
      $id_country				= $this->input->post('id_country');
      $getCountry = $this->db->get('master_country')->result();
      $html = '<option value="">Select Country</option>';
      foreach ($getCountry as $key => $vc) {
        if ($vc->id_country == $id_country) {
          $active = 'selected';
        }else {
          $active = '';
        }
        $html .= '<option value="'.$vc->id_country.' '.$active.'">'.$vc->name_country.'</option>';
      }
      $Arr_Kembali	= array(
        'html'		=>$html
      );
      echo json_encode($Arr_Kembali);
    }

    public function getSupplierTypeOpt(){
      $id_type				= $this->input->post('id_type');
      $getSupplierType = $this->db->get('child_supplier_type')->result();
      $html = '<option value="">Select Supplier Type</option>';
      foreach ($getSupplierType as $key => $vc) {
        if ($vc->id_type == $id_type) {
          $active = 'selected';
        }else {
          $active = '';
        }
        $html .= '<option value="'.$vc->id_type.' '.$active.'">'.$vc->name_type.'</option>';
      }
      $Arr_Kembali	= array(
        'html'		=>$html
      );
      echo json_encode($Arr_Kembali);
    }

    public function getProductCatOpt(){
      $id_category				= $this->input->post('id_category');
      $supplier_shipping				= $this->input->post('supplier_shipping');
      $getProductCat = $this->db->get_where('master_product_category', array('supplier_shipping'=>$supplier_shipping))->result();
      $html = '<option value="">Select Product Category</option>';
      foreach ($getProductCat as $key => $vc) {
        if ($vc->id_cate == $id_category) {
          $active = 'selected';
        }else {
          $active = '';
        }
        $html .= '<option value="'.$vc->id_category.' '.$active.'">'.$vc->name_category.'</option>';
      }
      $Arr_Kembali	= array(
      'html'		=>$html
      );
      echo json_encode($Arr_Kembali);
    }

    public function getBusinessCatOpt(){
      $id_type				= $this->input->post('id_type');
      $id_business				= $this->input->post('id_business');
      $getBusinessCat = $this->db->get_where('child_supplier_business_category', array('id_type'=>$id_type))->result();
      if (count($getBusinessCat) == 0) {
        $getBusinessCat = $this->db->get_where('child_supplier_business_category', array('id_type'=>NULL))->result();
      }
      $html = '<option value="">Select Business Category</option>';
      foreach ($getBusinessCat as $key => $vc) {
        if ($vc->id_business == $id_business) {
          $active = 'selected';
        }else {
          $active = '';
        }
        $html .= '<option value="'.$vc->id_business.' '.$active.'">'.$vc->name_business.'</option>';
      }
      $Arr_Kembali	= array(
      'html'		=>$html
      );
      echo json_encode($Arr_Kembali);
    }

    public function getSupplierCapOpt(){
      $id_capacity				= $this->input->post('id_capacity');
      $id_business				= $this->input->post('id_business');
      $getSupplierCap = $this->db->get_where('child_supplier_capacity', array('id_business'=>$id_business))->result();
      if (count($getSupplierCap) == 0) {
        $getSupplierCap = $this->db->get_where('child_supplier_capacity', array('id_business'=>NULL))->result();
      }
      $html = '';
      foreach ($getSupplierCap as $key => $vc) {
        if ($vc->id_capacity == $id_capacity) {
          $active = 'selected';
        }else {
          $active = '';
        }
        $html .= '<option value="'.$vc->id_capacity.' '.$active.'">'.$vc->name_capacity.'</option>';
      }
      $Arr_Kembali	= array(
      'html'		=>$html
      );
      echo json_encode($Arr_Kembali);
    }

    public function getBrandOpt(){
      $id_supplier				= $this->input->post('id_supplier');
      $id_brand   				= $this->input->post('id_brand');
      $getBrand = $this->db->get('master_product_brand')->result();
      $html = '';
      foreach ($getBrand as $key => $vc) {
        $html .= '<option value="'.$vc->id_brand.'">'.$vc->name_brand.'</option>';
      }
      $Arr_Kembali	= array(
      'html'		=>$html
      );
      echo json_encode($Arr_Kembali);
    }

    public function getRefreshBrand(){
  		$id				= $this->input->post('id');
      $idb				= $this->input->post('idb');
      //echo "$idb";
      //exit;
      if (!empty($id)) {
        $getS   = $this->db->get_where('master_supplier',array('id_supplier'=>$id))->row();
      }
      $arrB   = explode(";",$idb);
      $getB		= $this->db->get('master_product_brand')->result();
      $html='';
      $checked = '';
      //print_r($arrB);
      //exit;
      foreach ($getB as $key => $vb):
        if (isset($arrB)) {
          if (in_array($vb->id_brand,$arrB)):
            $checked = 'checked';
          else:
            $checked = '';
          endif;
        }
        $html .= '
        <tr>
          <td>
            <input type="checkbox" name="brand[]" value="'.$vb->id_brand.'" style="display:inline-block" '.$checked.' > '.$vb->id_brand.'
          </td>
          <td>
            '.$vb->name_brand.'
          </td>
        </tr>';
      endforeach;
      $Arr_Kembali	= array(
        'html'		=>$html
      );
  		echo json_encode($Arr_Kembali);
	  }
}
