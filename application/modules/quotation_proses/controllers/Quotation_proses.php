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

class Quotation_proses extends Admin_Controller
{
  //Permission
  protected $viewPermission = 'Quotation_proses.View';
  protected $addPermission  = 'Quotation_proses.Add';
  protected $managePermission = 'Quotation_proses.Manage';
  protected $deletePermission = 'Quotation_proses.Delete';

  public function __construct()
  {
    parent::__construct();

    $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
    $this->load->model(array(
      'Quotation_proses/Quotation_proses_model',
      'Aktifitas/aktifitas_model',
    ));
    $this->template->title('Quotation');
    $this->template->page_icon('fa fa-quote-right');

    date_default_timezone_set('Asia/Bangkok');
  }

  public function index()
  {
    $this->auth->restrict($this->viewPermission);
    $this->template->title('Quotation Process');
    $this->template->render('index');
  }



  public function qt_pro_open()
  {
    $this->auth->restrict($this->viewPermission);
    $this->template->title('Quotation Process Open');
    $this->template->render('index');
  }

  public function qt_pro_deal()
  {
    $this->auth->restrict($this->viewPermission);
    $this->template->title('Quotation Process Deal');
    $this->template->render('quotation_deal');
  }

  public function qt_pro_lost()
  {
    $this->auth->restrict($this->viewPermission);
    $this->template->title('Quotation Process Lost');
    $this->template->render('quotation_lost_index');
  }



  public function getDataJSON()
  {
    $requestData  = $_REQUEST;
    $fetch      = $this->queryDataJSON(
      $requestData['activation'],
      $requestData['search']['value'],
      $requestData['order'][0]['column'],
      $requestData['order'][0]['dir'],
      $requestData['start'],
      $requestData['length']
    );
    $totalData    = $fetch['totalData'];
    $totalFiltered  = $fetch['totalFiltered'];
    $query      = $fetch['query'];

    $data  = array();
    $urut1  = 1;
    $urut2  = 0;
    foreach ($query->result_array() as $row) {
      $total_data     = $totalData;
      $start_dari     = $requestData['start'];
      $asc_desc       = $requestData['order'][0]['dir'];
      if ($asc_desc == 'asc') {
        $nomor = $urut1 + $start_dari;
      }
      if ($asc_desc == 'desc') {
        $nomor = ($total_data - $start_dari) - $urut2;
      }

      if ($row['status'] == '0') {
        $status = '<span class="badge bg-teal">Open</span>';
      } else if ($row['status'] == '1') {
        $status = '<span class="badge bg-green">Deal</span>';
      } else if ($row['status'] == '2') {
        $status = '<span class="badge bg-default">Lost</span>';
      } else {
        $status = 'tidak ada status';
      }


      if ($row['grand_total'] == '' || $row['grand_total'] == '0') {
        $btn_print = '';
        $btn_upload = '';
        $btn_lost = '';
      } else {
        $btn_print = "
            <a class='btn btn-sm btn-default print' href='javascript:void(0)' title='Print Quotation' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block'>
            <span class='fa fa-print'></span> 
            </a>";
        $btn_upload = "
            <a class='btn btn-sm btn-success upload' href='javascript:void(0)' title='Upload PO' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block'>
            <span class='fa fa-upload'></span>
            </a>";
        $btn_lost = "
            <a class='btn btn-sm btn-danger lost' href='javascript:void(0)' title='Quotation Lost' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block'>
            <span class='fa fa-close'></span>
            </a>";
      }


      $nestedData   = array();
      $detail = "";
      $nestedData[]  = "<div align='center'>" . $nomor . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['nomor']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['date']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['name_customer']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['nama_karyawan']) . "</div>";
      $nestedData[]  = "<div align='right'>" . strtoupper(number_format($row['grand_total'])) . "</div>";
      $nestedData[]  = "<div align='center'>" . ($status) . "</div>";
      $nestedData[]  = "<div align='center'>" . ($row['nm_lengkap']) . "</div>";
      $nestedData[]  = "<div align='center'>" . ($row['modified_on']) . "</div>";
      if ($this->auth->restrict($this->viewPermission)) :
        $nestedData[]  = "<div>
        <a class='btn btn-sm btn-info view' href='javascript:void(0)' title='View Quotation' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block;margin:1px 0px'>
        <span class='fa fa-search'></span> 
        </a>
        <a class='btn btn-sm btn-warning edit' href='javascript:void(0)' title='Edit Quotation' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block;margin:1px 0px'>
        <span class='fa fa-edit'></span>
        </a>
        <a class='btn btn-sm btn-primary detail' href='javascript:void(0)' title='Detail Quotation' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block;margin:1px 0px'>
        <span class='fa fa-quote-right'></span>
        </a>"
          . $btn_upload . $btn_lost . $btn_print .
          "</div>";
      endif;
      $data[] = $nestedData;
      $urut1++;
      $urut2++;
    }

    $json_data = array(
      "draw"              => intval($requestData['draw']),
      "recordsTotal"      => intval($totalData),
      "recordsFiltered"   => intval($totalFiltered),
      "data"              => $data
    );

    echo json_encode($json_data);
  }

  public function queryDataJSON($activation, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
  {
    // echo $series."<br>";
    // echo $group."<br>";
    // echo $komponen."<br>";

    $where_activation = "";
    if (!empty($activation)) {
      $where_activation = " AND a.activation = '" . $activation . "' ";
    }

    $sql = "SELECT
				  a.id,a.nomor,a.date,b.name_customer,c.nama_karyawan, a.grand_total,a.status,a.activation,d.nm_lengkap,a.modified_on
				FROM
				  quotation_header a LEFT JOIN master_customer b ON a.id_customer = b.id_customer
				   LEFT JOIN karyawan c ON a.id_karyawan = c.id_karyawan
           LEFT JOIN users d ON d.id_user = a.modified_by WHERE 1=1 and a.status = '0'
          
				" . $where_activation . " 
				AND (
  				a.id LIKE '%" . $this->db->escape_like_str($like_value) . "%'
				OR b.name_customer LIKE '%" . $this->db->escape_like_str($like_value) . "%'
				OR c.nama_karyawan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
  	        )
			";

    $data['totalData'] = $this->db->query($sql)->num_rows();
    $data['totalFiltered'] = $this->db->query($sql)->num_rows();
    $columns_order_by = array(
      0 => 'nomor',
      1 => 'id',
      2 => 'date',
      3 => 'name_customer',
      4 => 'nama_karyawan',
      5 => 'grand_total',
      6 => 'status',
      7 => 'nm_lengkap',
      8 => 'modified_on'
    );

    $sql .= " ORDER BY a.id ASC, " . $columns_order_by[$column_order] . " " . $column_dir . " ";
    $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

    $data['query'] = $this->db->query($sql);
    return $data;
  }


  // DATA QUOTATION DEALS
  // -----------------------------------------

  public function getQuotationDeals()
  {
    $requestData  = $_REQUEST;
    $fetch      = $this->queryQuotationDeals(
      $requestData['activation'],
      $requestData['search']['value'],
      $requestData['order'][0]['column'],
      $requestData['order'][0]['dir'],
      $requestData['start'],
      $requestData['length']
    );
    $totalData    = $fetch['totalData'];
    $totalFiltered  = $fetch['totalFiltered'];
    $query      = $fetch['query'];

    $data  = array();
    $urut1  = 1;
    $urut2  = 0;
    foreach ($query->result_array() as $row) {
      $total_data     = $totalData;
      $start_dari     = $requestData['start'];
      $asc_desc       = $requestData['order'][0]['dir'];
      if ($asc_desc == 'asc') {
        $nomor = $urut1 + $start_dari;
      }
      if ($asc_desc == 'desc') {
        $nomor = ($total_data - $start_dari) - $urut2;
      }

      if ($row['status'] == '0') {
        $status = '<span class="badge bg-teal">Open</span>';
      } else if ($row['status'] == '1') {
        $status = '<span class="badge bg-green">Deal</span>';
      } else if ($row['status'] == '2') {
        $status = '<span class="badge bg-default">Close</span>';
      } else {
        $status = 'tidak ada status';
      }

      $nestedData   = array();
      $detail = "";
      $nestedData[]  = "<div align='center'>" . $nomor . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['nomor']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['date']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['name_customer']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['nama_karyawan']) . "</div>";
      $nestedData[]  = "<div align='right'>" . strtoupper(number_format($row['grand_total'])) . "</div>";
      $nestedData[]  = "<div align='center'>" . ($status) . "</div>";
      if ($this->auth->restrict($this->viewPermission)) :
        $nestedData[]  = "<div style='text-align:center'>
              <a class='btn btn-sm btn-warning print' href='javascript:void(0)' data-toggle='tooltip' title='View PO' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block'>
                <span class='fa fa-search'></span> 
              </a>
              <a class='btn btn-sm btn-success reopen_po' href='javascript:void(0)' data-toggle='tooltip' title='Re-open PO' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block'>
                <span class='fa fa-folder-open'></span>
              </a>
              <a class='btn btn-sm btn-danger change_po' href='javascript:void(0)' data-toggle='tooltip' title='Change PO' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block'>
                <span class='fa fa-refresh'></span>
              </a>
  
              </div>
      		      ";
      endif;
      $data[] = $nestedData;
      $urut1++;
      $urut2++;
    }

    $json_data = array(
      "draw"              => intval($requestData['draw']),
      "recordsTotal"      => intval($totalData),
      "recordsFiltered"   => intval($totalFiltered),
      "data"              => $data
    );

    echo json_encode($json_data);
  }


  public function queryQuotationDeals($activation, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
  {
    // echo $series."<br>";
    // echo $group."<br>";
    // echo $komponen."<br>";

    $where_activation = "";
    if (!empty($activation)) {
      $where_activation = " AND a.activation = '" . $activation . "' ";
    }

    $sql = "SELECT
				  a.id,a.nomor,a.date,b.name_customer,c.nama_karyawan, a.grand_total,a.status,a.activation
				FROM
				  quotation_header a LEFT JOIN master_customer b ON a.id_customer = b.id_customer
				   INNER JOIN karyawan c ON a.id_karyawan = c.id_karyawan WHERE 1=1 and a.status = '1'
				" . $where_activation . " 
				AND (
  				a.id LIKE '%" . $this->db->escape_like_str($like_value) . "%'
				OR b.name_customer LIKE '%" . $this->db->escape_like_str($like_value) . "%'
				OR c.nama_karyawan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
  	        )
			";

    $data['totalData'] = $this->db->query($sql)->num_rows();
    $data['totalFiltered'] = $this->db->query($sql)->num_rows();
    $columns_order_by = array(
      0 => 'nomor',
      1 => 'id',
      2 => 'date',
      3 => 'name_customer',
      4 => 'nama_karyawan',
      5 => 'grand_total',
      6 => 'status'
    );

    $sql .= " ORDER BY a.id ASC, " . $columns_order_by[$column_order] . " " . $column_dir . " ";
    $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

    $data['query'] = $this->db->query($sql);
    return $data;
  }


  // QUOTATION LOST
  //===========================================


  public function getQuotationlost()
  {
    $requestData  = $_REQUEST;
    $fetch      = $this->queryQuotationLost(
      $requestData['activation'],
      $requestData['search']['value'],
      $requestData['order'][0]['column'],
      $requestData['order'][0]['dir'],
      $requestData['start'],
      $requestData['length']
    );
    $totalData    = $fetch['totalData'];
    $totalFiltered  = $fetch['totalFiltered'];
    $query      = $fetch['query'];

    $data  = array();
    $urut1  = 1;
    $urut2  = 0;
    foreach ($query->result_array() as $row) {
      $total_data     = $totalData;
      $start_dari     = $requestData['start'];
      $asc_desc       = $requestData['order'][0]['dir'];
      if ($asc_desc == 'asc') {
        $nomor = $urut1 + $start_dari;
      }
      if ($asc_desc == 'desc') {
        $nomor = ($total_data - $start_dari) - $urut2;
      }

      if ($row['status'] == '0') {
        $status = '<span class="badge bg-teal">Open</span>';
      } else if ($row['status'] == '1') {
        $status = '<span class="badge bg-green">Deal</span>';
      } else if ($row['status'] == '2') {
        $status = '<span class="badge bg-default">Lost</span>';
      } else {
        $status = 'tidak ada status';
      }

      $nestedData   = array();
      $detail = "";
      $nestedData[]  = "<div align='center'>" . $nomor . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['nomor']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['date']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['name_customer']) . "</div>";
      $nestedData[]  = "<div align='left'>" . strtoupper($row['nama_karyawan']) . "</div>";
      $nestedData[]  = "<div align='right'>" . strtoupper(number_format($row['grand_total'])) . "</div>";
      $nestedData[]  = "<div align='center'>" . ($status) . "</div>";
      $nestedData[]  = "<div align=''>" . $row['reason'] . "</div>";
      if ($this->auth->restrict($this->viewPermission)) :
        $nestedData[]  = "<div style='text-align:center'>
              <a class='btn btn-sm btn-warning print' href='javascript:void(0)' data-toggle='tooltip' title='View PO' data-id_quotation='" . $row['id'] . "' style='width:30px; display:inline-block'>
                <span class='fa fa-search'></span> 
              </a>
              </div>
      		      ";
      endif;
      $data[] = $nestedData;
      $urut1++;
      $urut2++;
    }

    $json_data = array(
      "draw"              => intval($requestData['draw']),
      "recordsTotal"      => intval($totalData),
      "recordsFiltered"   => intval($totalFiltered),
      "data"              => $data
    );

    echo json_encode($json_data);
  }


  public function queryQuotationLost($activation, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
  {
    // echo $series."<br>";
    // echo $group."<br>";
    // echo $komponen."<br>";

    $where_activation = "";
    if (!empty($activation)) {
      $where_activation = " AND a.activation = '" . $activation . "' ";
    }

    $sql = "SELECT
				  a.id,a.nomor,a.date,b.name_customer,c.nama_karyawan, a.grand_total,a.status,a.reason,a.activation
				FROM
				  quotation_header a LEFT JOIN master_customer b ON a.id_customer = b.id_customer
				   INNER JOIN karyawan c ON a.id_karyawan = c.id_karyawan WHERE 1=1 and a.status = '2'
				" . $where_activation . " 
				AND (
  				a.id LIKE '%" . $this->db->escape_like_str($like_value) . "%'
				OR b.name_customer LIKE '%" . $this->db->escape_like_str($like_value) . "%'
				OR c.nama_karyawan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
  	        )
			";

    $data['totalData'] = $this->db->query($sql)->num_rows();
    $data['totalFiltered'] = $this->db->query($sql)->num_rows();
    $columns_order_by = array(
      0 => 'nomor',
      1 => 'id',
      2 => 'date',
      3 => 'name_customer',
      4 => 'nama_karyawan',
      5 => 'grand_total',
      6 => 'status',
      7 => 'reason'
    );

    $sql .= " ORDER BY a.id ASC, " . $columns_order_by[$column_order] . " " . $column_dir . " ";
    $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

    $data['query'] = $this->db->query($sql);
    return $data;
  }


  public function getID()
  {
    // $id				= $this->input->post('id');
    // $first_letter 	= strtoupper(substr($id, 0, 5));
    $getId         = $this->db->query("SELECT max(LEFT(nomor,5)) idQ FROM quotation_header where SUBSTRING(nomor, 17, 2) = SUBSTR(YEAR(CURDATE()),3,2) ORDER BY nomor DESC LIMIT 1")->row();
    $code = 'PR';
    $num = $getId->idQ + 1;
    $nomor = str_pad($num, 5, "0", STR_PAD_LEFT);
    $new_id = $nomor . '/IDF/' . $code . '/' . date('m') . '/' . date('y');
    $Arr_Kembali  = array(
      'id'    => $new_id
    );
    echo json_encode($Arr_Kembali);
  }

  public function getOpt()
  {
    $id_selected     = ($this->input->post('id_selected')) ? $this->input->post('id_selected') : '';
    $column          = ($this->input->post('column')) ? $this->input->post('column') : '';
    $column_fill     = ($this->input->post('column_fill')) ? $this->input->post('column_fill') : '';
    $filter_column   = ($this->input->post('filter_column')) ? $this->input->post('filter_column') : '';
    $filter_val      = ($this->input->post('filter_val')) ? $this->input->post('filter_val') : '';
    $search_column   = ($this->input->post('filter_column')) ? $this->input->post('search_column') : '';
    $search_value    = ($this->input->post('filter_val')) ? $this->input->post('search_value') : '';
    $idkey           = ($this->input->post('key')) ? $this->input->post('key') : '';
    $column_name     = ($this->input->post('column_name')) ? $this->input->post('column_name') : '';
    $table_name      = ($this->input->post('table_name')) ? $this->input->post('table_name') : '';
    $act             = ($this->input->post('act')) ? $this->input->post('act') : '';

    $where_col = $column . " = '" . $column_fill . "'";
    $filter_col = $filter_column . " = '" . $filter_val . "'";
    $search_col = $search_column . " like '%" . $search_value . "%'";
    $queryTable = "Select * FROM $table_name WHERE 1=1";
    if (!empty($column_fill)) {
      $queryTable .= " AND " . $where_col;
    }
    if (!empty($filter_val)) {
      $queryTable .= " AND " . $filter_col;
    }
    if (!empty($search_column)) {
      $queryTable .= " AND " . $search_col;
    }
    $getTable = $this->db->query($queryTable)->result_array();
    if ($act == 'free') {

      if (count($getTable) == 0) {
        $queryTable = "Select * FROM $table_name WHERE 1=1 AND " . $column . " IS NULL OR " . $column . " = ''";
        $getTable = $this->db->query($queryTable)->result_array();
      }
    }
    $html = '<option value="">Choose An Option</option>';
    if ($id_selected == 'multiple') {
      $html = '';
    }
    foreach ($getTable as $key => $vc) {
      $id_key = $vc[$idkey]; //${'vc'.$key};
      $name = $vc[$column_name]; //${'vc'.$column_name};
      if (!empty($id_selected)) {
        if ($id_key == $id_selected) {
          $active = 'selected';
        } else {
          $active = '';
        }
      }
      $html .= '<option value="' . $id_key . '" ' . $active . '>' . $name . '</option>';
    }
    $Arr_Kembali  = array(
      'html'    => $html
    );
    echo json_encode($Arr_Kembali);
  }

  public function getVal()
  {
    $id_selected     = ($this->input->post('id_selected')) ? $this->input->post('id_selected') : '';
    $column          = ($this->input->post('column')) ? $this->input->post('column') : '';
    $column_fill     = ($this->input->post('column_fill')) ? $this->input->post('column_fill') : '';
    $idkey           = ($this->input->post('key')) ? $this->input->post('key') : '';
    $column_name     = ($this->input->post('column_name')) ? $this->input->post('column_name') : '';
    $table_name      = ($this->input->post('table_name')) ? $this->input->post('table_name') : '';
    $act             = ($this->input->post('act')) ? $this->input->post('act') : '';

    $where_col = $column . " = '" . $column_fill . "'";
    $queryTable = "Select * FROM $table_name WHERE $idkey = '$id_selected' ";
    $getTable = $this->db->query($queryTable)->result_array();
    //echo $queryTable;
    //exit;
    $html = $getTable[0][$column];

    $Arr_Kembali  = array(
      'html'    => $html
    );
    echo json_encode($Arr_Kembali);
  }

  // public function modal_Process()
  public function modal_view()
  {
    $id = $this->input->post('id');
    // echo "<pre>";
    // print_r($id);
    // echo "<pre>";
    // exit;
    // $newId = str_replace('-', '/', $id);
    $data           = $this->db->get_where('quotation_header', array('id' => $id))->row();
    $customer       = $this->db->get_where('master_customer', array('id_customer' => $data->id_customer))->row();
    $cat_cust       = $this->db->get_where('child_customer_category', array('id_category_customer' => $data->id_cust_cut))->row();
    $disc_cat       = $this->db->get_where('discount_category', array('id_category' => $data->id_disc_cat))->row();
    $type_pro       = $this->db->get_where('type_project', array('id_type_project' => $data->id_type_project))->row();
    $pic_cust       = $this->db->get_where('child_customer_pic', array('id_customer' => $data->id_customer))->row();
    $karyawan       = $this->db->get_where('karyawan', array('id_karyawan' => $data->id_karyawan))->row();
    $rooms         = $this->db->get_where('quotation_room', array('id_quotation' => $data->id))->result();
    $pay_term         = $this->db->get_where('payment_term', array('id_quotation' => $data->id))->result();

    // echo "<pre>";
    // print_r($rooms);
    // echo "</pre>";
    $this->template->set([
      'data' => $data,
      'customer' => $customer,
      'cat_cust' => $cat_cust,
      'pic_cust' => $pic_cust,
      'disc_cat' => $disc_cat,
      'type_pro' => $type_pro,
      'karyawan' => $karyawan,
      'rooms' => $rooms,
      'pay_term' => $pay_term
    ]);
    $this->template->render('modal_Process_Quotation');
  }

  public function view_quotation()
  {
    $id = $this->input->post('id');
    // $newId = str_replace('-', '/', $id);
    $data           = $this->db->get_where('quotation_header', array('id' => $id))->row();
    $customer       = $this->db->get_where('master_customer', array('id_customer' => $data->id_customer))->row();
    $cat_cust       = $this->db->get_where('child_customer_category', array('id_category_customer' => $data->id_cust_cut))->row();
    $disc_cat       = $this->db->get_where('discount_category', array('id_category' => $data->id_disc_cat))->row();
    $type_pro       = $this->db->get_where('type_project', array('id_type_project' => $data->id_type_project))->row();
    $pic_cust       = $this->db->get_where('child_customer_pic', array('id_customer' => $data->id_customer))->row();
    $karyawan       = $this->db->get_where('karyawan', array('id_karyawan' => $data->id_karyawan))->row();
    $rooms         = $this->db->get_where('quotation_room', array('id_quotation' => $data->id))->result();
    $pay_term         = $this->db->get_where('payment_term', array('id_quotation' => $data->id))->result();

    // echo "<pre>";
    // print_r($customer);
    // echo "</pre>";
    $this->template->set([
      'data' => $data,
      'customer' => $customer,
      'cat_cust' => $cat_cust,
      'pic_cust' => $pic_cust,
      'disc_cat' => $disc_cat,
      'type_pro' => $type_pro,
      'karyawan' => $karyawan,
      'rooms' => $rooms,
      'pay_term' => $pay_term
    ]);
    $this->template->render('view_quotation');
  }

  public function quotation_lost()
  {
    $id = $this->input->post('id');
    // $newId = str_replace('-', '/', $id);
    $data           = $this->db->get_where('quotation_header', array('id' => $id))->row();
    $customer       = $this->db->get_where('master_customer', array('id_customer' => $data->id_customer))->row();
    $cat_cust       = $this->db->get_where('child_customer_category', array('id_category_customer' => $data->id_cust_cut))->row();
    $disc_cat       = $this->db->get_where('discount_category', array('id_category' => $data->id_disc_cat))->row();
    $type_pro       = $this->db->get_where('type_project', array('id_type_project' => $data->id_type_project))->row();
    $pic_cust       = $this->db->get_where('child_customer_pic', array('id_customer' => $data->id_customer))->row();
    $karyawan       = $this->db->get_where('karyawan', array('id_karyawan' => $data->id_karyawan))->row();
    $rooms          = $this->db->get_where('quotation_room', array('id_quotation' => $data->id))->result();


    // echo "<pre>";
    // print_r($customer);
    // echo "</pre>";
    $this->template->set([
      'data' => $data,
      'customer' => $customer,
      'cat_cust' => $cat_cust,
      'pic_cust' => $pic_cust,
      'disc_cat' => $disc_cat,
      'type_pro' => $type_pro,
      'karyawan' => $karyawan,
      'rooms' => $rooms
    ]);
    $this->template->render('quotation_lost');
  }

  public function upload_po()
  {
    $id = $this->input->post('id');
    // $newId = str_replace('-', '/', $id);
    $data           = $this->db->get_where('quotation_header', array('id' => $id))->row();
    $customer       = $this->db->get_where('master_customer', array('id_customer' => $data->id_customer))->row();
    $cat_cust       = $this->db->get_where('child_customer_category', array('id_category_customer' => $data->id_cust_cut))->row();
    $disc_cat       = $this->db->get_where('discount_category', array('id_category' => $data->id_disc_cat))->row();
    $type_pro       = $this->db->get_where('type_project', array('id_type_project' => $data->id_type_project))->row();
    $pic_cust       = $this->db->get_where('child_customer_pic', array('id_customer' => $data->id_customer))->row();
    $karyawan       = $this->db->get_where('karyawan', array('id_karyawan' => $data->id_karyawan))->row();
    $rooms          = $this->db->get_where('quotation_room', array('id_quotation' => $data->id))->result();


    // echo "<pre>";
    // print_r($customer);
    // echo "</pre>";
    $this->template->set([
      'data' => $data,
      'customer' => $customer,
      'cat_cust' => $cat_cust,
      'pic_cust' => $pic_cust,
      'disc_cat' => $disc_cat,
      'type_pro' => $type_pro,
      'karyawan' => $karyawan,
      'rooms' => $rooms
    ]);
    $this->template->render('upload_po');
  }

  public function list_barang()
  {

    $id = $this->input->post('id');
    // print_r($id);

    if ($id != '') {
      if ($id == '1') {
        $session       = $this->session->userdata('app_session');
        $itembarang    = $this->db->query("SELECT * FROM master_product_fabric")->result();
        $this->template->set('itembarang', $itembarang);
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

  public function addFee()
  {
    $session         = $this->session->userdata('app_session');
    $id_cust = $this->input->post('id_cust');
    $data        = $this->db->get_where("child_customer_pic", ['id_customer' => $id_cust])->result();
    $x = $this->input->post('x');
    $type = $this->input->post('type');
    $dataType = $this->input->post('dataType');
    $prodType = $this->input->post('prodType');
    $this->template->set('data', $data);
    $this->template->set('x', $x);
    $this->template->set('type', $type);
    $this->template->set('dataType', $dataType);
    $this->template->set('prodType', $prodType);
    $this->template->render('list_pic');
  }

  public function addBook()
  {
    $session      = $this->session->userdata('app_session');
    $bahan        = $this->input->post('bahan');
    $data         = $this->db->query("SELECT a.*, b.name_product FROM warehouse a inner join master_product_fabric b on a.id_product=b.id_product where a.id_product = '" . $bahan . "'")->result();
    $x = $this->input->post('x');
    $type = $this->input->post('type');
    $dataType = $this->input->post('dataType');
    $prodType = $this->input->post('prodType');
    $this->template->set('data', $data);
    $this->template->set('x', $x);
    $this->template->set('type', $type);
    $this->template->set('dataType', $dataType);
    $this->template->set('prodType', $prodType);
    $this->template->render('list_roll');
  }


  public function addBookLining()
  {
    $session      = $this->session->userdata('app_session');
    $lining       = $this->input->post('lining');
    $data         = $this->db->query("SELECT a.*, b.name_product FROM warehouse a inner join master_product_fabric b on a.id_product=b.id_product where a.id_product = '" . $lining . "'")->result();
    $x            = $this->input->post('x');
    $type         = $this->input->post('type');
    $dataType     = $this->input->post('dataType');
    $prodType     = $this->input->post('prodType');
    $this->template->set('data', $data);
    $this->template->set('x', $x);
    $this->template->set('type', $type);
    $this->template->set('dataType', $dataType);
    $this->template->set('prodType', $prodType);
    $this->template->render('list_roll');
  }

  public function addBookVitrage()
  {
    $session      = $this->session->userdata('app_session');
    $vitrage       = $this->input->post('vitrage');
    $data         = $this->db->query("SELECT a.*, b.name_product FROM warehouse a inner join master_product_fabric b on a.id_product=b.id_product where a.id_product = '" . $vitrage . "'")->result();
    $x            = $this->input->post('x');
    $type         = $this->input->post('type');
    $dataType     = $this->input->post('dataType');
    $prodType     = $this->input->post('prodType');
    $this->template->set('data', $data);
    $this->template->set('x', $x);
    $this->template->set('type', $type);
    $this->template->set('dataType', $dataType);
    $this->template->set('prodType', $prodType);
    $this->template->render('list_roll');
  }

  public function addComp()
  {
    $session      = $this->session->userdata('app_session');
    $rail        = $this->input->post('rail');
    $data         = $this->db->query("SELECT a.*, b.name_component FROM mp_rail_additional a inner join master_component b on a.id_component=b.id where a.id_rail = '" . $rail . "'")->result();
    $x = $this->input->post('x');
    $type = $this->input->post('type');
    $dataType = $this->input->post('dataType');
    $prodType = $this->input->post('prodType');
    $this->template->set('data', $data);
    $this->template->set('x', $x);
    $this->template->set('type', $type);
    $this->template->set('dataType', $dataType);
    $this->template->set('prodType', $prodType);
    $this->template->render('list_component');
  }

  public function addCompLining()
  {
    $session      = $this->session->userdata('app_session');
    $rail_lining        = $this->input->post('rail_lining');
    $data         = $this->db->query("SELECT a.*, b.name_component FROM mp_rail_additional a inner join master_component b on a.id_component=b.id where a.id_rail = '" . $rail_lining . "'")->result();
    $x = $this->input->post('x');
    $type = $this->input->post('type');
    $dataType = $this->input->post('dataType');
    $prodType = $this->input->post('prodType');
    $this->template->set('data', $data);
    $this->template->set('x', $x);
    $this->template->set('type', $type);
    $this->template->set('dataType', $dataType);
    $this->template->set('prodType', $prodType);
    $this->template->render('list_component');
  }

  public function addCompVitrage()
  {
    $session      = $this->session->userdata('app_session');
    $rail_vitrage        = $this->input->post('rail_vitrage');
    $data         = $this->db->query("SELECT a.*, b.name_component FROM mp_rail_additional a inner join master_component b on a.id_component=b.id where a.id_rail = '" . $rail_vitrage . "'")->result();
    $x = $this->input->post('x');
    $type = $this->input->post('type');
    $dataType = $this->input->post('dataType');
    $prodType = $this->input->post('prodType');
    $this->template->set('data', $data);
    $this->template->set('x', $x);
    $this->template->set('type', $type);
    $this->template->set('dataType', $dataType);
    $this->template->set('prodType', $prodType);
    $this->template->render('list_component');
  }

  public function addAcc()
  {
    $session      = $this->session->userdata('app_session');
    $this->db->select('a.*,b.name_uom');
    $this->db->from('accessories a');
    $this->db->join('master_uom b', 'a.uom = b.id_uom');
    $this->db->where_in('a.activation', 'aktif');
    $data = $this->db->get()->result();
    $no = $this->input->post('x');
    $type = $this->input->post('type');
    $dataType = $this->input->post('dataType');
    $prodType = $this->input->post('prodType');
    $this->template->set('no', $no);
    $this->template->set('data', $data);
    $this->template->set('type', $type);
    $this->template->set('dataType', $dataType);
    $this->template->set('prodType', $prodType);
    $this->template->render('list_accessoriess');
  }

  public function dataCustomer()
  {

    $id_cust   = $this->input->post('id_cust');
    $session    = $this->session->userdata('app_session');
    $pic      = $this->db->query("SELECT * FROM child_customer_pic where id_customer = '$id_cust'")->row();
    $customer   = $this->db->query("SELECT * FROM master_customer where id_customer = '$id_cust'")->row();
    $cat_cust1  = $this->db->query("SELECT * FROM child_customer_category where id_category_customer = '$customer->id_category_customer'")->row();
    $disc_cat   = $this->db->query("SELECT * FROM discount_category where id_category = '$customer->id_category_customer'")->row();

    $Arr = array(
      'customer'   => $customer,
      'pic'    => $pic,
      'cat_cust'  => $cat_cust1,
      'disc_cat'  => $disc_cat
    );

    echo json_encode($Arr);
  }

  public function dataDiscCat()
  {

    $id_cat   = $this->input->post('id_disc_cat');
    $session    = $this->session->userdata('app_session');

    $disc_cat   = $this->db->query("SELECT * FROM discount_category where id_category = '$id_cat'")->row();

    $Arr = array(
      'result'  => $disc_cat
    );

    echo json_encode($Arr);
  }

  public function dataProduct()
  {

    $id_product = $this->input->post('product');
    $session       = $this->session->userdata('app_session');
    $product      = $this->db->query("SELECT * FROM pricelist_fabric_view where id_product = '$id_product'")->row();

    $Arr = array(
      'product'   => $product,
    );

    echo json_encode($Arr);
  }

  public function dataJahitan()
  {

    $id_jahitan = $this->input->post('id_jahitan');
    $session    = $this->session->userdata('app_session');
    $jahit      = $this->db->query("SELECT * FROM sewing where id_sewing = '$id_jahitan'")->row();

    $Arr = array(
      'sewing'   => $jahit,
    );

    echo json_encode($Arr);
  }

  public function addQuotation()
  {
    $data = $this->db->get('master_product')->result();
    $this->template->title('Add New Quotation');
    $this->template->set('data', $data);
    $this->template->render('form_add_quotation');
  }

  public function editQuotation()
  {
    $id = $this->uri->segment(3);
    // $new_id = str_replace('-', '/', $id);
    $this->template->set('id', $id);
    $this->template->title('Edit New Quotation');
    $this->template->render('form_add_quotation');
  }

  public function get_item_barang()
  {
    $idbarang = $_GET['idbarang'];
    $session            = $this->session->userdata('app_session');
    $datbarang = $this->db->get('master_product_fabric')->result();

    echo json_encode($datbarang);
  }

  public function get_karyawan()
  {
    $session    = $this->session->userdata('app_session');
    // $id_kar 	= $this->input->post('id_kar');
    $get_idKar   = explode(";", $this->input->post('id_kar'));
    $this->db->select('*');
    $this->db->where_in('id_karyawan', $get_idKar);
    $list = $this->db->get('karyawan')->result_array();

    $Arr_data = array();
    foreach ($list as $key => $list_kar) {
      $Arr_Data[$list_kar['id_karyawan']]  = $list_kar;
    };

    echo json_encode($Arr_Data);
  }

  public function get_component()
  {
    $session    = $this->session->userdata('app_session');
    // $id_kar 	= $this->input->post('id_kar');
    $get_idComp   = explode(";", $this->input->post('id_component'));
    $this->db->select('a.*,b.name_component');
    $this->db->from('mp_rail_additional a');
    $this->db->join('master_component b', 'a.id_component = b.id');
    $this->db->where_in('a.id_rail_add', $get_idComp);
    $list = $this->db->get()->result_array();

    $Arr_data = array();
    foreach ($list as $key => $list_comp) {
      $Arr_Data[$list_comp['id_rail_add']]  = $list_comp;
    };

    echo json_encode($Arr_Data);
  }

  public function get_roll()
  {
    $session    = $this->session->userdata('app_session');
    // $id_kar 	= $this->input->post('id_kar');
    $idRoll   = explode(";", $this->input->post('id_roll'));
    $this->db->select('a.*,b.name_product');
    $this->db->from('warehouse a');
    $this->db->join('master_product_fabric b', 'a.id_product = b.id_product');
    $this->db->where_in('a.id_roll', $idRoll);
    $list = $this->db->get()->result_array();

    $Arr_Data = array();
    foreach ($list as $key => $list_roll) {
      $Arr_Data[$list_roll['id_roll']]  = $list_roll;
    };

    echo json_encode($Arr_Data);
  }

  public function get_pic()
  {
    $session    = $this->session->userdata('app_session');
    // $id_kar 	= $this->input->post('id_kar');
    $idPic   = explode(";", $this->input->post('id_pic'));
    $this->db->select('*');
    $this->db->where_in('id_pic', $idPic);
    $list = $this->db->get('child_customer_pic')->result_array();

    $Arr_Data = array();
    foreach ($list as $key => $list_pic) {
      $Arr_Data[$list_pic['id_pic']]  = $list_pic;
    };

    echo json_encode($Arr_Data);
  }

  public function get_data_rail()
  {
    $session    = $this->session->userdata('app_session');
    // $id_kar 	= $this->input->post('id_kar');
    $id_rail   = $this->input->post('id_rail');
    $this->db->select('*');
    $this->db->where('id_rail', $id_rail);
    $list = $this->db->get('mp_rail')->result_array();

    $Arr = [
      'list' => $list
    ];
    echo json_encode($Arr);
  }

  public function get_baic_component()
  {
    $session    = $this->session->userdata('app_session');
    // $id_kar 	= $this->input->post('id_kar');
    $id_rail   = $this->input->post('id_rail');
    $width_rail = $this->input->post('width_rail');

    $this->db->select('a.*,b.name_component');
    $this->db->from('mp_rail_basic a');
    $this->db->join('master_component b', 'a.id_component = b.id');
    $this->db->where('a.id_rail', $id_rail);
    $list = $this->db->get()->result();

    $ArrBasic = [];
    $no = 0;
    foreach ($list as $key => $value) {
      if ($key == 0) {
        $qty = $value->qty * $width_rail;
      } else if ($key == 1) {
        $qty = ceil($width_rail / 0.1) / 1;
      } else if ($key == 2) {
        $qty = ceil($width_rail / 0.5);
      } else if ($key == 3) {
        $qty = $value->qty;
      }

      $no++;
      $ArrBasic[$key]['id_rail_basic'] = $value->id_rail_basic;
      $ArrBasic[$key]['id_rail'] = $value->id_rail;
      $ArrBasic[$key]['id_component'] = $value->id_component;
      $ArrBasic[$key]['qty'] = $qty;
      $ArrBasic[$key]['uom'] = $value->uom;
      $ArrBasic[$key]['price'] = $value->price;
      $ArrBasic[$key]['activation'] = $value->activation;
      $ArrBasic[$key]['created_by'] = $value->created_by;
      $ArrBasic[$key]['created_on'] = $value->created_on;
      $ArrBasic[$key]['modified_by'] = $value->modified_by;
      $ArrBasic[$key]['modified_on'] = $value->modified_on;
      $ArrBasic[$key]['name_component'] = $value->name_component;
    }
    // echo "<pre>";
    // print_r($ArrBasic);
    // print_r($width_rail);
    // echo "</pre>";
    // exit;




    $Arr = [
      'list' => $ArrBasic
    ];
    echo json_encode($Arr);
  }

  public function get_accessoriess()
  {
    $session    = $this->session->userdata('app_session');
    // $id_kar 	= $this->input->post('id_kar');
    $id_acc   = explode(";", $this->input->post('id_acc'));
    $this->db->select('a.*,b.name_uom');
    $this->db->from('accessories a');
    $this->db->join('master_uom b', 'a.uom = b.id_uom');
    $this->db->where_in('a.id_accessories', $id_acc);
    $list = $this->db->get()->result_array();


    $Arr = [
      'list' => $list
    ];
    echo json_encode($Arr);
  }

  public function get_additional_component()
  {
    $session    = $this->session->userdata('app_session');
    // $id_kar 	= $this->input->post('id_kar');
    $id_rail   = $this->input->post('id_rail');
    $this->db->select('*');
    $this->db->from('mp_rail_additional a');
    $this->db->join('master_component b', 'a.id_component = b.id');
    $this->db->where('a.id_rail', $id_rail);
    $list = $this->db->get()->result_array();

    $Arr = [
      'list' => $list
    ];
    echo json_encode($Arr);
  }

  public function modal_Helper($action = "", $id_sup = "")
  {
    $this->template->set('action', $action);
    $this->template->set('id', $id_sup);
    $this->template->render('modal_Helper');
  }

  public function getIdQuotation()
  {
    // QU08 - F120 - 00001
    $getId         = $this->db->query("SELECT max(RIGHT(id,5)) idQ FROM quotation_header where SUBSTRING(id, 8, 2) = SUBSTR(YEAR(CURDATE()),3,2) ORDER BY id DESC LIMIT 1")->row();
    $code = 'QU';
    $num = $getId->idQ + 1;
    $nomor = str_pad($num, 5, "0", STR_PAD_LEFT);
    $idQuotation =  $code . date('m') . '-F1' . date('y') . '-' . $nomor;
    return $idQuotation;
  }

  public function saveQuotation()
  {
    $data                 = $this->input->post();
    $type                 = $data['type'];
    $idQuotation          = $this->getIdQuotation();


    if (!empty($data)) {
      if (!empty($data['ruang'])) {
        $arr_ruang = array();
        $nomor = substr($data['nomor'], 0, 5);
        $code = 'RM';
        foreach ($data['ruang'] as $ruang => $x) {
          $urut = str_pad($ruang, 2, "0", STR_PAD_LEFT);
          $id_ruang = $code . $nomor . "-" . $urut;

          $arr_ruang[$ruang]['id_quotation']   = $idQuotation;
          $arr_ruang[$ruang]['section_room']   = $ruang;
          $arr_ruang[$ruang]['id_ruangan']     = $id_ruang;
          $arr_ruang[$ruang]['name_room']      = $x['nm_ruang'];
          $arr_ruang[$ruang]['floor']          = $x['lantai'];
          $arr_ruang[$ruang]['window']         = $x['jendela'];
          $arr_ruang[$ruang]['width_window']   = $x['lebar'];
          $arr_ruang[$ruang]['height_window']  = $x['tinggi'];
          $arr_ruang[$ruang]['installation']   = $x['installation'];
          $arr_ruang[$ruang]['qty_unit']       = $x['qty_unit'];
          $arr_ruang[$ruang]['date']           = date('Y-m-d H:i:s');
        }
      }

      // CURTAIN
      // =======================================================================================================================
      if (!empty($data['product_curtain'])) {
        $ArrCurtain = array();
        foreach ($data['product_curtain'] as $curtain => $x) {
          $ArrCurtain[$curtain]['id_quotation']         = $idQuotation;
          $ArrCurtain[$curtain]['section']              = $curtain;
          $ArrCurtain[$curtain]['item']                 = 'curtain';
          $ArrCurtain[$curtain]['id_ruangan']           = $id_ruang;
          $ArrCurtain[$curtain]['id_product']           = $x['id_product'];
          $ArrCurtain[$curtain]['cust_product_name']    = $x['cust_curtain_name'];
          $ArrCurtain[$curtain]['panel']                = $x['panel'];
          $ArrCurtain[$curtain]['bukaan']               = $x['bukaan'];
          $ArrCurtain[$curtain]['ovl_kiri']             = $x['ovl_kiri'];
          $ArrCurtain[$curtain]['ovl_tengah']           = $x['ovl_tengah'];
          $ArrCurtain[$curtain]['jahit_h']              = $x['jahit_h'];
          $ArrCurtain[$curtain]['jahit_v']              = $x['jahit_v'];
          $ArrCurtain[$curtain]['fullness']             = $x['fullness'];
          $ArrCurtain[$curtain]['vertikal_repeat']      = $x['vertikal_repeat'];
          $ArrCurtain[$curtain]['rumus_panel']          = $x['rumus_panel'];
          $ArrCurtain[$curtain]['round_up']             = $x['r_up_panel'];
          $ArrCurtain[$curtain]['qty_unit']             = $data['ruang'][$curtain]['qty_unit'];
          $ArrCurtain[$curtain]['t_kain']               = $x['t_kain'];
          $ArrCurtain[$curtain]['lebar_kain']           = $x['lebar_kain'];
          $ArrCurtain[$curtain]['harga_kain']           = str_replace(',', '', $x['harga_kain']);
          $ArrCurtain[$curtain]['t_harga_kain']         = str_replace(',', '', $x['t_harga_kain']);
          $ArrCurtain[$curtain]['total_harga_kain']     = str_replace(',', '', $x['total_harga_kain']);
          $ArrCurtain[$curtain]['disc_persen']          = $x['disc_fab'];
          $ArrCurtain[$curtain]['disc_value']           = str_replace(',', '', $x['t_disc_fab']);
          $ArrCurtain[$curtain]['harga_aft_disc']       = str_replace(',', '', $x['harga_aft_disc']);
          $ArrCurtain[$curtain]['mainten']              = $x['mainten'];
          $ArrCurtain[$curtain]['disc_mnt_persen']      = $x['disc_mnt'];
          $ArrCurtain[$curtain]['disc_mnt_value']       = str_replace(',', '', $x['disc_mnt_val']);
          $ArrCurtain[$curtain]['keterangan']           = $x['ket'];
          $ArrCurtain[$curtain]['jahit']                = $x['jahit'];
          $ArrCurtain[$curtain]['jahitan']              = $x['jahitan'];
          $ArrCurtain[$curtain]['hrg_jahitan']          = str_replace(',', '', $x['hrg_jahitan']);
          $ArrCurtain[$curtain]['disc_jahitan']         = $x['disc_jahitan'];
          $ArrCurtain[$curtain]['val_disc_jahit']       = str_replace(',', '', $x['val_disc_jahit']);
          $ArrCurtain[$curtain]['t_hrg_jahitan']        = str_replace(',', '', $x['t_hrg_jahitan']);
          $ArrCurtain[$curtain]['ket_jahitan']          = $x['ket_jahitan'];
          $ArrCurtain[$curtain]['rail']                 = $x['rail_curtain'];
          $ArrCurtain[$curtain]['rail_material']        = $x['rail_material'];
          $ArrCurtain[$curtain]['cust_rail_name']       = $x['cust_rail_name'];
          $ArrCurtain[$curtain]['window_width']         = $x['window_width'];
          $ArrCurtain[$curtain]['overlap']              = $x['overlap'];
          $ArrCurtain[$curtain]['width']                = $x['width_rail'];
          $ArrCurtain[$curtain]['qty']                  = $data['ruang'][$curtain]['qty_unit'];
          $ArrCurtain[$curtain]['price']                = str_replace(',', '', $x['price_rail']);
          $ArrCurtain[$curtain]['t_price']              = str_replace(',', '', $x['t_price_rail']);
          $ArrCurtain[$curtain]['total_add_comp_rail']        = str_replace(',', '', $x['total_add_comp_rail']);
          $ArrCurtain[$curtain]['subtotal']        = str_replace(',', '', $x['subtotal']);
          $ArrCurtain[$curtain]['diskon_rail']          = $x['diskon_rail'];
          $ArrCurtain[$curtain]['v_diskon_rail']        = str_replace(',', '', $x['v_diskon_rail']);
          $ArrCurtain[$curtain]['total_rail']        = str_replace(',', '', $x['total_rail']);
          $ArrCurtain[$curtain]['ket_rail']             = $x['ket_rail'];
        }
      }

      if (!empty($data['book_roll'])) {
        $ArrBookRoll = array();
        $no = 0;
        foreach ($data['book_roll'] as $roll) {
          $no++;
          foreach ($roll as $key => $x) {
            $ArrBookRoll[$no . $key]['id_quotation']  = $idQuotation;
            $ArrBookRoll[$no . $key]['section']       = $no;
            $ArrBookRoll[$no . $key]['item']          = 'curtain';
            $ArrBookRoll[$no . $key]['panel']         = $x['panel'];
            $ArrBookRoll[$no . $key]['id_roll']       = $x['id_product'];
            $ArrBookRoll[$no . $key]['book_qty']      = $x['book'];
            $ArrBookRoll[$no . $key]['date']          = date('Y-m-d H:m:s');
          }
        }
      }

      if (!empty($data['ext_comm'])) {
        $ArrComm = array();
        $no = 0;
        foreach ($data['ext_comm'] as $commission) {
          $no++;
          foreach ($commission as $key => $x) {
            $ArrComm[$no . $key]['id_quotation']  = $idQuotation;
            $ArrComm[$no . $key]['section']       = $no;
            $ArrComm[$no . $key]['item']          = 'curtain';
            $ArrComm[$no . $key]['panel']         = $x['panel'];
            $ArrComm[$no . $key]['id_pic']        = $x['id_pic'];
            $ArrComm[$no . $key]['persen_fee']    = $x['persen'];
            $ArrComm[$no . $key]['value_fee']     = str_replace(',', '', $x['value']);
            $ArrComm[$no . $key]['date']          = date('Y-m-d H:i:s');
          }
        }
      }

      if (!empty($data['ext_comm_rail'])) {
        $ArrCommRail = array();
        $no = 0;
        foreach ($data['ext_comm_rail'] as $commRail) {
          $no++;
          foreach ($commRail as $key => $x) {
            $ArrCommRail[$no . $key]['id_quotation']  = $idQuotation;
            $ArrCommRail[$no . $key]['section']       = $no;
            $ArrCommRail[$no . $key]['item']          = 'rail-curtain';
            $ArrCommRail[$no . $key]['id_pic']        = $x['id_pic'];
            $ArrCommRail[$no . $key]['persen_fee']    = $x['persen'];
            $ArrCommRail[$no . $key]['value_fee']     = str_replace(',', '', $x['value']);
            $ArrCommRail[$no . $key]['date']          = date('Y-m-d H:i:s');
          }
        }
      }

      if (!empty($data['bc_comp'])) {
        $BasicCompRail = array();
        $no = 0;
        foreach ($data['bc_comp'] as $basicComp) {
          $no++;
          foreach ($basicComp as $key => $x) {
            $BasicCompRail[$no . $key]['id_quotation']   = $idQuotation;
            $BasicCompRail[$no . $key]['section']        = $no;
            $BasicCompRail[$no . $key]['item']           = 'curtain';
            $BasicCompRail[$no . $key]['id_basic_comp']  = $x['id_rail_basic'];
            $BasicCompRail[$no . $key]['qty']            = $x['qty'];
            $BasicCompRail[$no . $key]['uom']            = $x['uom'];
            $BasicCompRail[$no . $key]['date']           = date('Y-m-d H:i:s');
          }
        }
      }

      if (!empty($data['addt_comp'])) {
        $AddtCompRail = array();
        $no = 0;
        foreach ($data['addt_comp'] as $addtComp) {
          $no++;
          foreach ($addtComp as $key => $x) {
            $AddtCompRail[$no . $key]['id_quotation']   = $idQuotation;
            $AddtCompRail[$no . $key]['section']        = $no;
            $AddtCompRail[$no . $key]['item']           = 'curtain';
            $AddtCompRail[$no . $key]['id_additional_comp']  = $x['id_comp'];
            $AddtCompRail[$no . $key]['qty']            = $x['qty'];
            $AddtCompRail[$no . $key]['uom']            = $x['uom'];
            $AddtCompRail[$no . $key]['selling_price']  = str_replace(',', '', $x['price']);
            $AddtCompRail[$no . $key]['t_price']        = str_replace(',', '', $x['t_price']);
            $AddtCompRail[$no . $key]['date']           = date('Y-m-d H:i:s');
          }
        }
      }


      // LILING //
      //==============================================================================================
      if (!empty($data['product_lining'])) {
        $ArrLining = array();
        foreach ($data['product_lining'] as $lining => $x) {
          $ArrLining[$lining]['id_quotation']         = $idQuotation;
          $ArrLining[$lining]['section']              = $lining;
          $ArrLining[$lining]['item']                 = 'lining';
          $ArrLining[$lining]['id_ruangan']           = $id_ruang;
          $ArrLining[$lining]['id_product']           = $x['id_product'];
          $ArrLining[$lining]['cust_product_name']    = $x['cust_lining_name'];
          $ArrLining[$lining]['panel']                = $x['panel'];
          $ArrLining[$lining]['bukaan']               = $x['bukaan'];
          $ArrLining[$lining]['ovl_kiri']             = $x['ovl_kiri'];
          $ArrLining[$lining]['ovl_tengah']           = $x['ovl_tengah'];
          $ArrLining[$lining]['jahit_h']              = $x['jahit_h'];
          $ArrLining[$lining]['jahit_v']              = $x['jahit_v'];
          $ArrLining[$lining]['fullness']             = $x['fullness'];
          $ArrLining[$lining]['rumus_panel']          = $x['rumus_panel'];
          $ArrLining[$lining]['round_up']             = $x['r_up_panel'];
          $ArrLining[$lining]['qty_unit']             = $data['ruang'][$lining]['qty_unit'];
          $ArrLining[$lining]['t_kain']               = $x['t_kain'];
          $ArrLining[$lining]['lebar_kain']           = $x['lebar_kain'];
          $ArrLining[$lining]['harga_kain']           = str_replace(',', '', $x['harga_kain']);
          $ArrLining[$lining]['t_harga_kain']         = str_replace(',', '', $x['t_harga_kain']);
          $ArrLining[$lining]['total_harga_kain']     = str_replace(',', '', $x['total_harga_kain']);
          $ArrLining[$lining]['disc_persen']          = $x['disc_lining'];
          $ArrLining[$lining]['disc_value']           = str_replace(',', '', $x['t_disc_lining']);
          $ArrLining[$lining]['harga_aft_disc']       = str_replace(',', '', $x['harga_aft_disc']);
          $ArrLining[$lining]['mainten']              = $x['mainten'];
          $ArrLining[$lining]['disc_mnt_persen']      = $x['disc_mnt'];
          $ArrLining[$lining]['disc_mnt_value']       = str_replace(',', '', $x['disc_mnt_val']);
          $ArrLining[$lining]['keterangan']           = $x['ket'];
          $ArrLining[$lining]['jahit']                = $x['jahit'];
          $ArrLining[$lining]['jahitan']              = $x['jahitan'];
          $ArrLining[$lining]['hrg_jahitan']          = str_replace(',', '', $x['hrg_jahitan']);
          $ArrLining[$lining]['disc_jahitan']         = $x['disc_jahitan'];
          $ArrLining[$lining]['val_disc_jahit']       = str_replace(',', '', $x['val_disc_jahit']);
          $ArrLining[$lining]['t_hrg_jahitan']        = str_replace(',', '', $x['t_hrg_jahitan']);
          $ArrLining[$lining]['rail']                 = $x['rail_lining'];
          $ArrLining[$lining]['rail_material']        = $x['rail_material'];
          $ArrLining[$lining]['cust_rail_name']       = $x['cust_rail_name'];
          $ArrLining[$lining]['window_width']         = $x['window_width'];
          $ArrLining[$lining]['overlap']              = $x['overlap'];
          $ArrLining[$lining]['width']                = $x['width_rail'];
          $ArrLining[$lining]['qty']                  = $data['ruang'][$lining]['qty_unit'];
          $ArrLining[$lining]['price']                = str_replace(',', '', $x['price_rail']);
          $ArrLining[$lining]['t_price']              = str_replace(',', '', $x['t_price_rail']);
          $ArrLining[$lining]['diskon_rail']          = $x['diskon_rail'];
          $ArrLining[$lining]['v_diskon_rail']        = str_replace(',', '', $x['v_diskon_rail']);
          $ArrLining[$lining]['ket_rail']             = $x['ket_rail'];
          // $ArrCurtain[$curtain]['date']                 = date('Y-m-d H:i:s');
        }
      }

      if (!empty($data['book_roll_lining'])) {
        $ArrBookRollLining = array();
        $no = 0;
        foreach ($data['book_roll_lining'] as $roll) {
          $no++;
          foreach ($roll as $key => $x) {
            $ArrBookRollLining[$no . $key]['id_quotation']  = $idQuotation;
            $ArrBookRollLining[$no . $key]['section']       = $no;
            $ArrBookRollLining[$no . $key]['item']          = 'lining';
            $ArrBookRollLining[$no . $key]['panel']       = $x['panel'];
            $ArrBookRollLining[$no . $key]['id_roll']       = $x['id_product'];
            $ArrBookRollLining[$no . $key]['book_qty']      = $x['book'];
            $ArrBookRollLining[$no . $key]['date']          = date('Y-m-d H:m:s');
          }
        }
      }

      if (!empty($data['ext_comm_lining'])) {
        $ArrCommLining = array();
        $no = 0;
        foreach ($data['ext_comm_lining'] as $commission) {
          $no++;
          foreach ($commission as $key => $x) {
            $ArrCommLining[$no . $key]['id_quotation']  = $idQuotation;
            $ArrCommLining[$no . $key]['section']       = $no;
            $ArrCommLining[$no . $key]['item']          = 'lining';
            $ArrCommLining[$no . $key]['panel']        = $x['panel'];
            $ArrCommLining[$no . $key]['id_pic']        = $x['id_pic'];
            $ArrCommLining[$no . $key]['persen_fee']    = $x['persen'];
            $ArrCommLining[$no . $key]['value_fee']     = str_replace(',', '', $x['value']);
            $ArrCommLining[$no . $key]['date']          = date('Y-m-d H:i:s');
          }
        }
      }

      if (!empty($data['ext_comm_rail_lining'])) {
        $ArrCommRailLining = array();
        $no = 0;
        foreach ($data['ext_comm_rail_lining'] as $commRail) {
          $no++;
          foreach ($commRail as $key => $x) {
            $ArrCommRailLining[$no . $key]['id_quotation']  = $idQuotation;
            $ArrCommRailLining[$no . $key]['section']       = $no;
            $ArrCommRailLining[$no . $key]['item']           = 'rail-lining';
            $ArrCommRailLining[$no . $key]['id_pic']        = $x['id_pic'];
            $ArrCommRailLining[$no . $key]['persen_fee']    = $x['persen'];
            $ArrCommRailLining[$no . $key]['value_fee']     = str_replace(',', '', $x['value']);
            $ArrCommRailLining[$no . $key]['date']          = date('Y-m-d H:i:s');
          }
        }
      }

      if (!empty($data['bc_comp-lining'])) {
        $BasicCompRailLining = array();
        $no = 0;
        foreach ($data['bc_comp-lining'] as $basicComp) {
          $no++;
          foreach ($basicComp as $key => $x) {
            $BasicCompRailLining[$no . $key]['id_quotation']   = $idQuotation;
            $BasicCompRailLining[$no . $key]['section']        = $no;
            $BasicCompRailLining[$no . $key]['item']            = 'lining';
            $BasicCompRailLining[$no . $key]['id_basic_comp']  = $x['id_rail_basic'];
            $BasicCompRailLining[$no . $key]['qty']            = $x['qty'];
            $BasicCompRailLining[$no . $key]['uom']            = $x['uom'];
            $BasicCompRailLining[$no . $key]['date']           = date('Y-m-d H:i:s');
          }
        }
      }

      if (!empty($data['addt_comp-lining'])) {
        $AddtCompRailLining = array();
        $no = 0;
        foreach ($data['addt_comp-lining'] as $addtComp) {
          $no++;
          foreach ($addtComp as $key => $x) {
            $AddtCompRailLining[$no . $key]['id_quotation']   = $idQuotation;
            $AddtCompRailLining[$no . $key]['section']        = $no;
            $AddtCompRailLining[$no . $key]['item']            = 'lining';
            $AddtCompRailLining[$no . $key]['id_additional_comp']  = $x['id_comp'];
            $AddtCompRailLining[$no . $key]['qty']            = $x['qty'];
            $AddtCompRailLining[$no . $key]['uom']            = $x['uom'];
            $AddtCompRailLining[$no . $key]['selling_price']  = str_replace(',', '', $x['price']);
            $AddtCompRailLining[$no . $key]['t_price']        = str_replace(',', '', $x['t_price']);
            $AddtCompRailLining[$no . $key]['date']           = date('Y-m-d H:i:s');
          }
        }
      }


      // VITRAGE
      // ========================================================================================================
      if (!empty($data['product_vitrage'])) {
        $ArrVitrage = array();
        foreach ($data['product_vitrage'] as $vitrage => $x) {
          $ArrVitrage[$vitrage]['id_quotation']               = $idQuotation;
          $ArrVitrage[$vitrage]['section']                    = $vitrage;
          $ArrVitrage[$vitrage]['item']                       = 'vitrage';
          $ArrVitrage[$vitrage]['id_ruangan']                 = $id_ruang;
          $ArrVitrage[$vitrage]['id_product']                 = $x['id_product'];
          $ArrVitrage[$vitrage]['cust_product_name']          = $x['cust_vitrage_name'];
          $ArrVitrage[$vitrage]['panel']                      = $x['panel'];
          $ArrVitrage[$vitrage]['bukaan']                     = $x['bukaan'];
          $ArrVitrage[$vitrage]['ovl_kiri']                   = $x['ovl_kiri'];
          $ArrVitrage[$vitrage]['ovl_tengah']                 = $x['ovl_tengah'];
          $ArrVitrage[$vitrage]['jahit_h']                    = $x['jahit_h'];
          $ArrVitrage[$vitrage]['jahit_v']                    = $x['jahit_v'];
          $ArrVitrage[$vitrage]['fullness']                   = $x['fullness'];
          $ArrVitrage[$vitrage]['rumus_panel']                = $x['rumus_panel'];
          $ArrVitrage[$vitrage]['round_up']                   = $x['r_up_panel'];
          $ArrVitrage[$vitrage]['qty_unit']                   = $data['ruang'][$vitrage]['qty_unit'];
          $ArrVitrage[$vitrage]['t_kain']                     = $x['t_kain'];
          $ArrVitrage[$vitrage]['lebar_kain']                 = $x['lebar_kain'];
          $ArrVitrage[$vitrage]['harga_kain']                 = str_replace(',', '', $x['harga_kain']);
          $ArrVitrage[$vitrage]['t_harga_kain']               = str_replace(',', '', $x['t_harga_kain']);
          $ArrVitrage[$vitrage]['total_harga_kain']           = str_replace(',', '', $x['total_harga_kain']);
          $ArrVitrage[$vitrage]['disc_persen']                = $x['disc_vitrage'];
          $ArrVitrage[$vitrage]['disc_value']                 = str_replace(',', '', $x['t_disc_vitrage']);
          $ArrVitrage[$vitrage]['harga_aft_disc']             = str_replace(',', '', $x['harga_aft_disc']);
          $ArrVitrage[$vitrage]['mainten']                    = $x['mainten'];
          $ArrVitrage[$vitrage]['disc_mnt_persen']            = $x['disc_mnt'];
          $ArrVitrage[$vitrage]['disc_mnt_value']             = str_replace(',', '', $x['disc_mnt_val']);
          $ArrVitrage[$vitrage]['keterangan']                 = $x['ket'];
          $ArrVitrage[$vitrage]['jahit']                      = $x['jahit'];
          $ArrVitrage[$vitrage]['jahitan']                    = $x['jahitan'];
          $ArrVitrage[$vitrage]['hrg_jahitan']                = str_replace(',', '', $x['hrg_jahitan']);
          $ArrVitrage[$vitrage]['disc_jahitan']               = $x['disc_jahitan'];
          $ArrVitrage[$vitrage]['val_disc_jahit']             = str_replace(',', '', $x['val_disc_jahit']);
          $ArrVitrage[$vitrage]['t_hrg_jahitan']              = str_replace(',', '', $x['t_hrg_jahitan']);
          $ArrVitrage[$vitrage]['rail']                       = $x['rail_vitrage'];
          $ArrVitrage[$vitrage]['rail_material']              = $x['rail_material'];
          $ArrVitrage[$vitrage]['cust_rail_name']             = $x['cust_rail_name'];
          $ArrVitrage[$vitrage]['window_width']               = $x['window_width'];
          $ArrVitrage[$vitrage]['overlap']                    = $x['overlap'];
          $ArrVitrage[$vitrage]['width']                      = $x['width_rail'];
          $ArrVitrage[$vitrage]['qty']                        = $data['ruang'][$vitrage]['qty_unit'];
          $ArrVitrage[$vitrage]['price']                      = str_replace(',', '', $x['price_rail']);
          $ArrVitrage[$vitrage]['t_price']                    = str_replace(',', '', $x['t_price_rail']);
          $ArrVitrage[$vitrage]['diskon_rail']                = $x['diskon_rail'];
          $ArrVitrage[$vitrage]['v_diskon_rail']              = str_replace(',', '', $x['v_diskon_rail']);
          $ArrVitrage[$vitrage]['ket_rail']                   = $x['ket_rail'];
          // $ArrCurtain[$curtain]['date']                       = date('Y-m-d H:i:s');
        }
      }

      if (!empty($data['book_roll_vitrage'])) {
        $ArrBookRollVitrage = array();
        $no = 0;
        foreach ($data['book_roll_vitrage'] as $roll) {
          $no++;
          foreach ($roll as $key => $x) {
            $ArrBookRollVitrage[$no . $key]['id_quotation']  = $idQuotation;
            $ArrBookRollVitrage[$no . $key]['section']       = $no;
            $ArrBookRollVitrage[$no . $key]['item']          = 'vitrage';
            $ArrBookRollVitrage[$no . $key]['panel']       = $x['panel'];
            $ArrBookRollVitrage[$no . $key]['id_roll']       = $x['id_product'];
            $ArrBookRollVitrage[$no . $key]['book_qty']      = $x['book'];
            $ArrBookRollVitrage[$no . $key]['date']          = date('Y-m-d H:m:s');
          }
        }
      }

      if (!empty($data['ext_comm_vitrage'])) {
        $ArrCommVitrage = array();
        $no = 0;
        foreach ($data['ext_comm_vitrage'] as $commission) {
          $no++;
          foreach ($commission as $key => $x) {
            $ArrCommVitrage[$no . $key]['id_quotation']  = $idQuotation;
            $ArrCommVitrage[$no . $key]['section']       = $no;
            $ArrCommVitrage[$no . $key]['item']          = 'vitrage';
            $ArrCommVitrage[$no . $key]['panel']        = $x['panel'];
            $ArrCommVitrage[$no . $key]['id_pic']        = $x['id_pic'];
            $ArrCommVitrage[$no . $key]['persen_fee']    = $x['persen'];
            $ArrCommVitrage[$no . $key]['value_fee']     = str_replace(',', '', $x['value']);
            $ArrCommVitrage[$no . $key]['date']          = date('Y-m-d H:i:s');
          }
        }
      }


      if (!empty($data['ext_comm_rail_vitrage'])) {
        $ArrCommRailVitrage = array();
        $no = 0;
        foreach ($data['ext_comm_rail_vitrage'] as $commRail) {
          $no++;
          foreach ($commRail as $key => $x) {
            $ArrCommRailVitrage[$no . $key]['id_quotation']  = $idQuotation;
            $ArrCommRailVitrage[$no . $key]['section']       = $no;
            $ArrCommRailVitrage[$no . $key]['item']          = 'rail-vitrage';
            $ArrCommRailVitrage[$no . $key]['id_pic']        = $x['id_pic'];
            $ArrCommRailVitrage[$no . $key]['persen_fee']    = $x['persen'];
            $ArrCommRailVitrage[$no . $key]['value_fee']     = str_replace(',', '', $x['value']);
            $ArrCommRailVitrage[$no . $key]['date']          = date('Y-m-d H:i:s');
          }
        }
      }
      // echo "<pre>";
      // print_r($ArrCommRailVitrage);
      // print_r($ArrCommVitrage);
      // echo "<pre>";
      // exit;

      if (!empty($data['bc_comp-vitrage'])) {
        $BasicCompRailVitrage = array();
        $no = 0;
        foreach ($data['bc_comp-vitrage'] as $basicComp) {
          $no++;
          foreach ($basicComp as $key => $x) {
            $BasicCompRailVitrage[$no . $key]['id_quotation']   = $idQuotation;
            $BasicCompRailVitrage[$no . $key]['section']        = $no;
            $BasicCompRailVitrage[$no . $key]['item']           = 'vitrage';
            $BasicCompRailVitrage[$no . $key]['id_basic_comp']  = $x['id_rail_basic'];
            $BasicCompRailVitrage[$no . $key]['qty']            = $x['qty'];
            $BasicCompRailVitrage[$no . $key]['uom']            = $x['uom'];
            $BasicCompRailVitrage[$no . $key]['date']           = date('Y-m-d H:i:s');
          }
        }
      }


      if (!empty($data['addt_comp-vitrage'])) {
        $AddtCompRailVitrage = array();
        $no = 0;
        foreach ($data['addt_comp-vitrage'] as $addtComp) {
          $no++;
          foreach ($addtComp as $key => $x) {
            $AddtCompRailVitrage[$no . $key]['id_quotation']   = $idQuotation;
            $AddtCompRailVitrage[$no . $key]['section']        = $no;
            $AddtCompRailVitrage[$no . $key]['item']           = 'vitrage';
            $AddtCompRailVitrage[$no . $key]['id_additional_comp']  = $x['id_comp'];
            $AddtCompRailVitrage[$no . $key]['qty']            = $x['qty'];
            $AddtCompRailVitrage[$no . $key]['uom']            = $x['uom'];
            $AddtCompRailVitrage[$no . $key]['selling_price']  = str_replace(',', '', $x['price']);
            $AddtCompRailVitrage[$no . $key]['t_price']        = str_replace(',', '', $x['t_price']);
            $AddtCompRailVitrage[$no . $key]['date']           = date('Y-m-d H:i:s');
          }
        }
      }
      // echo "<pre>";
      // print_r($BasicCompRailVitrage);
      // echo "<pre>";
      // exit;

      // ACCESSORIES
      //=================================================================================================

      if (!empty($data['product_acc'])) {
        $ArrAccessories = array();
        $no = 0;
        foreach ($data['product_acc'] as $acc) {
          $no++;
          foreach ($acc as $key => $x) {
            $ArrAccessories[$no . $key]['id_quotation']     = $idQuotation;
            $ArrAccessories[$no . $key]['section']          = $no;
            $ArrAccessories[$no . $key]['item']             = 'accessoriess';
            $ArrAccessories[$no . $key]['id_ruangan']       = $id_ruang;
            $ArrAccessories[$no . $key]['id_accessories']   = $x['id_acc'];
            $ArrAccessories[$no . $key]['name_accessories'] = $x['name_accessories'];
            $ArrAccessories[$no . $key]['qty']              = $x['qty'];
            $ArrAccessories[$no . $key]['uom']              = $x['uom'];
            $ArrAccessories[$no . $key]['price']            = str_replace(",", "", $x['price']);
            $ArrAccessories[$no . $key]['sub_price']        = str_replace(",", "", $x['sub_price']);
            $ArrAccessories[$no . $key]['disc_acc']         = $x['disc_acc'];
            $ArrAccessories[$no . $key]['val_disc_acc']     = $x['val_disc_acc'];
            $ArrAccessories[$no . $key]['t_price_acc']      = str_replace(",", "", $x['t_price']);
            $ArrAccessories[$no . $key]['date']             = date('Y-m-d H:i:s');
          }
        }
      }

      // echo "<pre>";
      // print_r($ArrAccessories);
      // echo "<pre>";
      // exit;
      $this->db->trans_begin();

      //SUPPLIER DATA
      $insertData  = array(
        'nomor'          => $nomor,
        'id_customer'    => $data['id_cuctomer'],
        'id_pic'         => $data['id_pic'],
        'address'        => $data['address'],
        'id_cust_cut'    => $data['id_cust_cut'],
        'id_disc_cat'    => $data['id_disc_cat'],
        'val_disc_cat'   => str_replace("%", "", $data['disc_cat']),
        'date'           => $data['date'],
        'sales_category' => $data['cat'],
        'id_type_project' => $data['type_project'],
        'id_karyawan'    => $data['id_karyawan'],
        'net'            => $data['net'],
        'ppn'            => $data['ppn'],
        'project_name'   => $data['pr_name'],
      );

      // echo "<pre>";
      // print_r($data);
      // echo "<pre>";
      // exit;
      if ($type == 'edit') {
        if (strlen($data['nomor']) === 18) {
          $count = 1;
          $num = str_pad($count, 2, "0", STR_PAD_LEFT);
          $rev = '/Rev-' . $num;
        } else {
          $max = $this->db->query('SELECT MAX(RIGHT(nomor,2)) as max_num from quotation_header where left( nomor, 23 ) = "' . substr($data['nomor'], 0, 23) . '" ORDER BY nomor DESC')->row();
          // $no = substr($data['nomor'], -2);
          $count = $max->max_num + 1;
          $num = str_pad($count, 2, "0", STR_PAD_LEFT);
          $rev = '/Rev-' . $num;
        }
        $insertData['id']             = $idQuotation;
        $insertData['nomor']          = substr($data['nomor'], 0, 18) . $rev;
        $insertData['modified_on']    = date('Y-m-d H:i:s');
        $insertData['modified_by']    = $this->auth->user_id();
        $insertData['activation']     = 'aktif';

        $this->db->insert('quotation_header', $insertData);
        // $this->db->where('id', $idQuotation)->update('quotation_header', $insertData);
        // curtain
        // $this->db->delete('quotation_room', ['id_quotation' => $idQuotation]);
        // $this->db->delete('qtt_product_fabric', ['id_quotation' => $idQuotation]);
        // $this->db->delete('qtt_booking_roll', ['id_quotation' => $idQuotation]);
        // $this->db->delete('qtt_ext_commission', ['id_quotation' => $idQuotation]);
        // $this->db->delete('qtt_basic_comp_rail', ['id_quotation' => $idQuotation]);
        // $this->db->delete('qtt_additional_comp_rail', ['id_quotation' => $idQuotation]);
        // $this->db->delete('qtt_accessoriess', ['id_quotation' => $idQuotation]);
      } else {
        $insertData['id'] = $idQuotation;
        $insertData['activation'] = 'aktif';
        $insertData['created_on'] = date('Y-m-d H:i:s');
        $insertData['created_by'] = $this->auth->user_id();
        if (!empty($insertData)) {
          $this->db->insert('quotation_header', $insertData);
        }
      }
      if (!empty($arr_ruang)) {
        $this->db->insert_batch('quotation_room', $arr_ruang);
      }
      // curtain
      if (!empty($ArrCurtain)) {
        $this->db->insert_batch('qtt_product_fabric', $ArrCurtain);
      }
      if (!empty($ArrBookRoll)) {
        $this->db->insert_batch('qtt_booking_roll', $ArrBookRoll);
      }
      if (!empty($ArrComm)) {
        $this->db->insert_batch('qtt_ext_commission', $ArrComm);
      }
      if (!empty($ArrCommRail)) {
        $this->db->insert_batch('qtt_ext_commission', $ArrCommRail);
      }
      if (!empty($BasicCompRail)) {
        $this->db->insert_batch('qtt_basic_comp_rail', $BasicCompRail);
      }
      if (!empty($AddtCompRail)) {
        $this->db->insert_batch('qtt_additional_comp_rail', $AddtCompRail);
      }

      // lining
      if (!empty($ArrLining)) {
        $this->db->insert_batch('qtt_product_fabric', $ArrLining);
      }
      if (!empty($ArrBookRollLining)) {
        $this->db->insert_batch('qtt_booking_roll', $ArrBookRollLining);
      }
      if (!empty($ArrCommLining)) {
        $this->db->insert_batch('qtt_ext_commission', $ArrCommLining);
      }
      if (!empty($ArrCommRailLining)) {
        $this->db->insert_batch('qtt_ext_commission', $ArrCommRailLining);
      }
      if (!empty($BasicCompRailLining)) {
        $this->db->insert_batch('qtt_basic_comp_rail', $BasicCompRailLining);
      }
      if (!empty($AddtCompRailLining)) {
        $this->db->insert_batch('qtt_additional_comp_rail', $AddtCompRailLining);
      }

      // vitrage
      if (!empty($ArrVitrage)) {
        $this->db->insert_batch('qtt_product_fabric', $ArrVitrage);
      }
      if (!empty($ArrBookRollVitrage)) {
        $this->db->insert_batch('qtt_booking_roll', $ArrBookRollVitrage);
      }
      if (!empty($ArrCommVitrage)) {
        $this->db->insert_batch('qtt_ext_commission', $ArrCommVitrage);
      }
      if (!empty($ArrCommRailVitrage)) {
        $this->db->insert_batch('qtt_ext_commission', $ArrCommRailVitrage);
      }
      if (!empty($BasicCompRailVitrage)) {
        $this->db->insert_batch('qtt_basic_comp_rail', $BasicCompRailVitrage);
      }
      if (!empty($AddtCompRailVitrage)) {
        $this->db->insert_batch('qtt_additional_comp_rail', $AddtCompRailVitrage);
      }

      // accessoriess
      if (!empty($ArrAccessories)) {
        $this->db->insert_batch('qtt_accessoriess', $ArrAccessories);
      }

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $Arr_Kembali  = array(
          'pesan'    => 'Failed Add Changes. Please try again later ...',
          'status'  => 0
        );
        $keterangan = 'FAILED';
        $status = 0;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      } else {
        $this->db->trans_commit();
        $Arr_Kembali  = array(
          'pesan'    => 'Success Save Item. Thanks ...',
          'status'  => 1
        );

        $keterangan = 'SUCCESS';
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
    } else {
      $Arr_Kembali  = array(
        'pesan'    => 'Failed Add Changes. Please try again later ...',
        'status'  => 0
      );
    }
    echo json_encode($Arr_Kembali);
  }

  public function saveQuotation2()
  {
    $data                 = $this->input->post();
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // exit;

    if (!empty($data)) {
      if (!empty($data['curtain'])) {
        $af_curtain = array();
        foreach ($data['curtain'] as $curtain => $x) {
          $af_curtain[$curtain]['id_quotation']       = $data['id_quotation'];
          $af_curtain[$curtain]['id_ruangan']         = $x['id_ruangan'];
          $af_curtain[$curtain]['item']               = 'curtain';
          $af_curtain[$curtain]['total_kain']         = str_replace(",", "", $x['t_kain_curtain']);
          $af_curtain[$curtain]['air_freight']        = str_replace(",", "", $x['air_freight_curtain']);
          $af_curtain[$curtain]['total_air_freight']  = str_replace(",", "", $x['t_air_freight_curtain']);
          $af_curtain[$curtain]['created_on']         = date('Y-m-d H:i:s');
          $af_curtain[$curtain]['created_by']         = $this->auth->user_id();
        }
      }

      if (!empty($data['lining'])) {
        $af_lining = array();
        foreach ($data['lining'] as $lining => $x) {
          $af_lining[$lining]['id_quotation']       = $data['id_quotation'];
          $af_lining[$lining]['id_ruangan']         = $x['id_ruangan'];
          $af_lining[$lining]['item']               = 'lining';
          $af_lining[$lining]['total_kain']         = str_replace(",", "", $x['t_kain_lining']);
          $af_lining[$lining]['air_freight']        = str_replace(",", "", $x['air_freight_lining']);
          $af_lining[$lining]['total_air_freight']  = str_replace(",", "", $x['t_air_freight_lining']);
          $af_lining[$lining]['created_on']         = date('Y-m-d H:i:s');
          $af_lining[$lining]['created_by']         = $this->auth->user_id();
        }
      }

      if (!empty($data['vitrage'])) {
        $af_vitrage = array();
        foreach ($data['vitrage'] as $vitrage => $x) {
          $af_vitrage[$vitrage]['id_quotation']       = $data['id_quotation'];
          $af_vitrage[$vitrage]['id_ruangan']         = $x['id_ruangan'];
          $af_vitrage[$vitrage]['item']               = 'vitrage';
          $af_vitrage[$vitrage]['total_kain']         = str_replace(",", "", $x['t_kain_vitrage']);
          $af_vitrage[$vitrage]['air_freight']        = str_replace(",", "", $x['air_freight_vitrage']);
          $af_vitrage[$vitrage]['total_air_freight']  = str_replace(",", "", $x['t_air_freight_vitrage']);
          $af_vitrage[$vitrage]['created_on']         = date('Y-m-d H:i:s');
          $af_vitrage[$vitrage]['created_by']         = $this->auth->user_id();
        }
      }

      $delivery = array();
      $price = str_replace(",", "", $data['price_delivery']);
      $val_disc = (($data['qty_delivery'] * $price) * $data['disc_delivery']) / 100;
      $subtotal_delivery = $data['qty_delivery'] * $price;

      $delivery =
        [
          'id_quotation' => $data['id_quotation'],
          'id_city' => $data['city_delivery'],
          'via' => $data['via_delivery'],
          'qty' => $data['qty_delivery'],
          'price' => $price,
          'subtotal' => $subtotal_delivery,
          'disc' => $data['disc_delivery'],
          'val_disc' => $val_disc,
          'total' => str_replace(",", "", $data['price_aft_disc']),
          'keterangan' => $data['ket_delivery'],

        ];

      $accomodation = array();
      $price_accomm =  str_replace(",", "", $data['price_accomodation']);
      $val_disc_accom = (($data['qty_accomodation'] * $price_accomm) * $data['disc_accomodation']) / 100;
      $subtotal_accom = $data['qty_accomodation'] * $price_accomm;
      $accomodation = [
        'id_quotation' => $data['id_quotation'],
        'id_category' => $data['category_accom'],
        'qty' => $data['qty_accomodation'],
        'price' => $price_accomm,
        'subtotal' => $subtotal_accom,
        'disc' => $data['disc_accomodation'],
        'val_disc' => $val_disc_accom,
        'total' => str_replace(",", "", $data['price_aft_disc_accomodation']),
        'keterangan' => $data['ket_accomodation']
      ];

      if (!empty($data['meal_cost'])) {
        $ArrMeal_cost = array();
        foreach ($data['meal_cost'] as $meal => $x) {
          $ArrMeal_cost[$meal]['id_quotation']   = $data['id_quotation'];
          $ArrMeal_cost[$meal]['area']           = $x['meal_area'];
          $ArrMeal_cost[$meal]['qty_mp']         = $x['qty_mp_meal'];
          $ArrMeal_cost[$meal]['total_day']      = $x['total_day'];
          $ArrMeal_cost[$meal]['cost_mp_day']    = str_replace(",", "", $x['cost_mp_day']);
          $ArrMeal_cost[$meal]['total']          = str_replace(",", "", $x['total_meal']);
          $ArrMeal_cost[$meal]['notes']          = $x['notes_meal'];
          $ArrMeal_cost[$meal]['updated_on']     = date('Y-m-d H:i:s');
          $ArrMeal_cost[$meal]['updated_by']     = $this->auth->user_id();
        }
      }

      if (!empty($data['trans_cost'])) {
        $ArrTransport = array();
        foreach ($data['trans_cost'] as $trans => $x) {
          $ArrTransport[$trans]['id_quotation']   = $data['id_quotation'];
          $ArrTransport[$trans]['item_cost']      = $x['item_cost'];
          $ArrTransport[$trans]['transportation'] = $x['transport'];
          $ArrTransport[$trans]['origin']         = $x['origin'];
          $ArrTransport[$trans]['destination']    = $x['destination'];
          $ArrTransport[$trans]['qty_mp']         = $x['qty_mp'];
          $ArrTransport[$trans]['total']          = str_replace(",", "", $x['total']);
          $ArrTransport[$trans]['notes']         = $x['notes'];
          $ArrTransport[$trans]['updated_on']     = date('Y-m-d H:i:s');
          $ArrTransport[$trans]['updated_by']     = $this->auth->user_id();
        }
      }

      if (!empty($data['housing_cost'])) {
        $ArrHousing = array();
        foreach ($data['housing_cost'] as $housing => $x) {
          $ArrHousing[$housing]['id_quotation']   = $data['id_quotation'];
          $ArrHousing[$housing]['area']      = $x['housing_area'];
          $ArrHousing[$housing]['qty_mp'] = $x['qty_mp_housing'];
          $ArrHousing[$housing]['amount_day']         = $x['amount_day'];
          $ArrHousing[$housing]['cost']          = str_replace(",", "", $x['cost']);
          $ArrHousing[$housing]['total']          = str_replace(",", "", $x['total_housing_cost']);
          $ArrHousing[$housing]['notes']          = $x['notes'];
          $ArrHousing[$housing]['updated_on']     = date('Y-m-d H:i:s');
          $ArrHousing[$housing]['updated_by']     = $this->auth->user_id();
        }
      }

      if (!empty($data['other_cost'])) {
        $ArrOther = array();
        foreach ($data['other_cost'] as $oth => $x) {
          $ArrOther[$oth]['id_quotation']   = $data['id_quotation'];
          $ArrOther[$oth]['item']           = $x['other_item'];
          $ArrOther[$oth]['cost']           = str_replace(",", "", $x['other_cost']);
          $ArrOther[$oth]['updated_on']     = date('Y-m-d H:i:s');
          $ArrOther[$oth]['updated_by']     = $this->auth->user_id();
        }
      }

      if (!empty($data['termin'])) {
        $ArrTermin = [];
        foreach ($data['termin'] as $tr => $x) {
          $ArrTermin[$tr]['id_quotation']  = $data['id_quotation'];
          $ArrTermin[$tr]['payment_term']  = $data['payment_term'];
          $ArrTermin[$tr]['requirement']   = $x['requirement'];
          $ArrTermin[$tr]['value']         =  str_replace(",", "", $x['value']);
          $ArrTermin[$tr]['percent']       = $x['percent'];
          $ArrTermin[$tr]['notes']         = $x['notes'];
        }
      }

      $summary = array();
      $summary = [
        'subtotalFabric'    => str_replace(",", "", $data['subtotalFabric']),
        'discFabric'        => str_replace(",", "", $data['discFabric']),
        'totalFabric'       => str_replace(",", "", $data['totalFabric']),
        'subtotal_rail'     => str_replace(",", "", $data['subtotal_rail']),
        'discount_rail'     => str_replace(",", "", $data['discount_rail']),
        'sumRailAcc'        => str_replace(",", "", $data['sumRailAcc']),
        'sumBiaya'          => str_replace(",", "", $data['sumBiaya']),
        'sumDiscBiaya'      => str_replace(",", "", $data['sumDiscBiaya']),
        't_sumBiaya'        => str_replace(",", "", $data['t_sumBiaya']),
        'subtotal'          => str_replace(",", "", $data['subtotal']),
        'ppn'               => str_replace(",", "", $data['ppn']),
        'total'             => str_replace(",", "", $data['total']),
        'rounding'          => str_replace(",", "", $data['rounding']),
        'grand_total'       => str_replace(",", "", $data['grand_total']),
        'payment_term'      => $data['payment_term'],
        'modified_by'       => $this->auth->user_id(),
        'modified_on'       => date('Y-m-d H:i:s')

      ];

      // echo "<pre>";
      // print_r($data);
      // echo "<pre>";
      // exit;

      $this->db->trans_begin();
      $this->db->delete('qtt_air_freight', ['id_quotation' => $data['id_quotation']]);
      $this->db->delete('qtt_delivery', ['id_quotation' => $data['id_quotation']]);
      $this->db->delete('qtt_accomodation', ['id_quotation' => $data['id_quotation']]);
      $this->db->delete('qtt_moq', ['id_quotation' => $data['id_quotation']]);
      $this->db->delete('qtt_meal_cost', ['id_quotation' => $data['id_quotation']]);
      $this->db->delete('qtt_transport_cost', ['id_quotation' => $data['id_quotation']]);
      $this->db->delete('qtt_housing_cost', ['id_quotation' => $data['id_quotation']]);
      $this->db->delete('qtt_other_cost', ['id_quotation' => $data['id_quotation']]);

      if (!empty($af_curtain)) {
        $this->db->insert_batch('qtt_air_freight', $af_curtain);
      }

      if (!empty($af_lining)) {
        $this->db->insert_batch('qtt_air_freight', $af_lining);
      }

      if (!empty($af_vitrage)) {
        $this->db->insert_batch('qtt_air_freight', $af_vitrage);
      }

      if (!empty($delivery)) {
        $this->db->insert('qtt_delivery', $delivery);
      }

      if (!empty($accomodation)) {
        $this->db->insert('qtt_accomodation', $accomodation);
      }

      if (!empty($accomodation)) {
        $this->db->insert('qtt_accomodation', $accomodation);
      }

      if (!empty($ArrMeal_cost)) {
        $this->db->insert_batch('qtt_meal_cost', $ArrMeal_cost);
      }

      if (!empty($ArrTransport)) {
        $this->db->insert_batch('qtt_transport_cost', $ArrTransport);
      }

      if (!empty($ArrHousing)) {
        $this->db->insert_batch('qtt_housing_cost', $ArrHousing);
      }

      if (!empty($ArrOther)) {
        $this->db->insert_batch('qtt_other_cost', $ArrOther);
      }

      if (!empty($summary)) {
        $this->db->update('quotation_header', $summary, ['id' => $data['id_quotation']]);
      }

      if ($data['type'] == 'add') {
        if (!empty($ArrTermin)) {
          $this->db->insert_batch('payment_term', $ArrTermin);
        }
      } else {
        if (!empty($ArrTermin)) {
          $this->db->delete('payment_term', ['id_quotation' => $data['id_quotation']]);
          $this->db->insert_batch('payment_term', $ArrTermin);
        }
      }


      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $Arr_Kembali  = array(
          'pesan'    => 'Failed Add Changes. Please try again later ...',
          'status'  => 0
        );
        $keterangan = 'FAILED';
        $status = 0;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      } else {
        $this->db->trans_commit();
        $Arr_Kembali  = array(
          'pesan'    => 'Success Save Item. Thanks ...',
          'status'  => 1
        );

        $keterangan = 'SUCCESS';
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
    } else {
      $Arr_Kembali  = array(
        'pesan'    => 'Failed Add Changes. Please try again later ...',
        'status'  => 0
      );
    }
    echo json_encode($Arr_Kembali);
  }

  public function saveUpdloadPo()
  {
    $data                 = $this->input->post();
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // exit;

    if (!empty($data)) {
      $no_po             = $data['po_number'];
      // $path           =   './assets/img/master_fabric/'; //path folder
      $config = array(
        'upload_path' => './assets/po/',
        'allowed_types' => 'gif|jpg|png|jpeg|xlsx|pdf|docx|JPG|PNG|XLSX|PDF|DOCX',
        'file_name' => str_replace("/", "-", $no_po),
        'file_ext_tolower' => TRUE,
        'overwrite' => TRUE,
        'max_size' => 2048222,
        'remove_spaces' => TRUE
      );
      $maxSize = 2048;
      $size_file = ceil($_FILES['file_po_upload']['size'] / 1000);

      if ($size_file > $maxSize) {
        $Arr_Kembali  = array(
          'pesan'    => 'Data file terlalu besar.',
          'status'  => 0
        );
      } else {

        $ext = end((explode(".", $_FILES['file_po_upload']['name'])));
        $dtExt = ['jpg', 'png', 'jpeg', 'pdf', 'JPG', 'PNG', 'PDF'];
        if (in_array($ext, $dtExt)) {
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          if (!$this->upload->do_upload('file_po_upload')) {
            $result = $this->upload->display_errors();
          } else {
            $ext = end((explode(".", $_FILES['file_po_upload']['name'])));
            $name_file = $no_po . "." . strtolower($ext);
            $nm_file = str_replace("/", "-", $name_file);
            $paths = $_SERVER['DOCUMENT_ROOT'] . 'assets/po/' . $nm_file;
            if (file_exists($paths)) {
              unlink($paths);
            }
            $data_foto  = array('upload_data' => $this->upload->data('file_po_upload'));
          }

          // echo "<pre>";
          // print_r($nm_file);
          // echo "<pre>";
          // exit;

          $udatePo = [

            // 'id_quotation'       => $data['id_quotation'],
            'no_po'             => $data['po_number'],
            'tgl_upload_po'     => $data['date_upload'],
            'status'            => '1',
            'upload_po'         => $nm_file,
            'modified_on'       => date('Y-m-d'),
            'modified_by'       => $this->auth->user_id()

          ];

          $this->db->trans_begin();

          $this->db->update('quotation_header', $udatePo, ['id' => $data['id_quotation']]);


          $this->db->trans_complete();

          if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $Arr_Kembali  = array(
              'pesan'    => 'Failed Add Changes. Please try again later ...',
              'status'  => 0
            );
            $keterangan = 'FAILED';
            $status = 0;
            $nm_hak_akses = $this->addPermission;
            $kode_universal = $this->auth->user_id();
            $jumlah = 1;
            $sql = $this->db->last_query();
          } else {
            $this->db->trans_commit();
            $Arr_Kembali  = array(
              'pesan'    => 'Success Save Item. Thanks ...',
              'status'  => 1
            );

            $keterangan = 'SUCCESS';
            $status = 1;
            $nm_hak_akses = $this->addPermission;
            $kode_universal = $this->auth->user_id();
            $jumlah = 1;
            $sql = $this->db->last_query();
          }
          simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        } else {
          $Arr_Kembali  = array(
            'pesan'    => 'Failed File Type. Please try again later ...',
            'status'  => 0
          );
        };
      }
    }
    echo json_encode($Arr_Kembali);
  }

  public function saveLostQtt()
  {
    $data                 = $this->input->post();
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // exit;

    if (!empty($data)) {

      $udateQtt = [

        // 'id_quotation'       => $data['id_quotation'],
        'tgl_lost'          => date('Y-m-d'),
        'status'            => '2',
        'reason'            => $data['reason'],
        'modified_on'       => date('Y-m-d'),
        'modified_by'       => $this->auth->user_id()

      ];

      $this->db->trans_begin();

      $this->db->update('quotation_header', $udateQtt, ['id_quotation' => $data['id_quotation']]);


      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $Arr_Kembali  = array(
          'pesan'    => 'Failed Add Changes. Please try again later ...',
          'status'  => 0
        );
        $keterangan = 'FAILED';
        $status = 0;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      } else {
        $this->db->trans_commit();
        $Arr_Kembali  = array(
          'pesan'    => 'Success Save Item. Thanks ...',
          'status'  => 1
        );

        $keterangan = 'SUCCESS';
        $status = 1;
        $nm_hak_akses = $this->addPermission;
        $kode_universal = $this->auth->user_id();
        $jumlah = 1;
        $sql = $this->db->last_query();
      }
      simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
    } else {
      $Arr_Kembali  = array(
        'pesan'    => 'Failed Add Changes. Please try again later ...',
        'status'  => 0
      );
    }
    echo json_encode($Arr_Kembali);
  }

  public function deleteData()
  {
    $id_delivery    = $this->input->post('id_delivery');
    $this->db->trans_begin();
    $getCat   = $this->db->where('id_delivery', $id_delivery)->update('delivery', array('activation' => 'nonaktif'));
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $Arr_Kembali  = array(
        'msg'    => 'Failed Add Changes. Please try again later ...',
        'status'  => 0
      );
      $keterangan = 'FAILED, Delete Delivery Data ' . $id_delivery;
      $status = 0;
      $nm_hak_akses = $this->addPermission;
      $kode_universal = $this->auth->user_id();
      $jumlah = 1;
      $sql = $this->db->last_query();
    } else {
      $this->db->trans_commit();
      $Arr_Kembali  = array(
        'msg'    => 'Success Delete Item. Thanks ...',
        'status'  => 1
      );

      $keterangan = 'SUCCESS, Delete Delivery Data ' . $id_delivery;
      $status = 1;
      $nm_hak_akses = $this->addPermission;
      $kode_universal = $this->auth->user_id();
      $jumlah = 1;
      $sql = $this->db->last_query();
    }
    simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

    echo json_encode($Arr_Kembali);
  }

  public function load_form()
  {
    $count = $this->input->post('count');
    $id = $this->input->post('id');
    $nomor = $this->input->post('nomor');

    if (!empty($id)) {
      $this->template->set('id', $id);
    }
    if (!empty($nomor)) {
      $this->template->set('nomor', $nomor);
    }

    $this->template->set('count', $count);
    $this->template->render('form');
  }

  public function addCurtain()
  {
    $no = $this->input->post('no');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');
    $curtain = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation, 'item' => 'curtain'])->row();


    $this->template->set('no', $no);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('curtain', $curtain);
    $this->template->render('form_curtain');
  }

  public function addlining()
  {
    $no = $this->input->post('no');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');
    $lining = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation, 'item' => 'lining'])->row();

    $this->template->set('no', $no);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('lining', $lining);
    $this->template->render('form_lining');
  }

  public function addVitrage()
  {
    $no = $this->input->post('no');
    $id_ruangan = $this->input->post('id_ruangan');
    $vitrage = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'item' => 'vitrage'])->row();

    // echo "<pre>";
    // print_r($vitrage);
    // echo "</pre>";
    $this->template->set('no', $no);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('vitrage', $vitrage);
    $this->template->render('form_vitrage');
  }

  public function addaccessories()
  {
    $no = $this->input->post('no');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');
    $accessoriess = $this->db->get_where('qtt_accessoriess', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation, 'section' => $no])->result();

    // echo "<pre>";
    // print_r($no);
    // echo "</pre>";

    $this->template->set('no', $no);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('accessoriess', $accessoriess);

    $this->template->render('form_accessoriess');
  }


  public function addDetail()
  {

    $no = $this->input->post('no');
    $type = $this->input->post('type');
    $dataType = $this->input->post('dataType');
    $id_product = $this->input->post('id_product');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');

    $this->template->set('no', $no);
    $this->template->set('id_product', $id_product);
    $this->template->set('id_ruangan', $id_ruangan);

    if ($type == 'yes') {
      if ($dataType == 'panel-curtain') {
        $this->template->render('form_curtain_panel');
      } else if ($dataType == 'panel-lining') {
        $dataPanel = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation, 'item' => 'lining', 'section' => $no, 'panel' => 'yes'])->row();
        $this->template->set('dataPanel', $dataPanel);
        $this->template->render('form_lining_panel');
      } else if ($dataType == 'panel-vitrage') {
        $dataPanel = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation, 'item' => 'vitrage', 'section' => $no, 'panel' => 'yes'])->row();
        $this->template->set('dataPanel', $dataPanel);
        $this->template->render('form_vitrage_panel');
      } else {
        return false;
      }
    } else if ($type == 'no') {
      if ($dataType == 'panel-curtain') {
        $this->template->render('form_curtain_nonpanel');
      } else if ($dataType == 'panel-lining') {
        $dataPanel = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'item' => 'lining', 'id_quotation' => $id_quotation,  'section' => $no, 'panel' => 'no'])->row();
        $this->template->set('dataPanel', $dataPanel);
        $this->template->render('form_lining_nonpanel');
      } else if ($dataType == 'panel-vitrage') {
        $dataPanel = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'item' => 'vitrage', 'id_quotation' => $id_quotation,  'section' => $no, 'panel' => 'no'])->row();
        $this->template->set('dataPanel', $dataPanel);
        $this->template->render('form_vitrage_nonpanel');
      } else {
        return false;
      }
    } else {
      echo '';
    }
  }

  public function addJahitCurtain()
  {

    $no = $this->input->post('no');
    $type = $this->input->post('type');
    $id_jahitan = $this->input->post('id_jahitan');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');
    // echo "<pre>";
    // print_r($id_ruangan);
    // echo "</pre>";
    $this->template->set('no', $no);
    $this->template->set('id_jahitan', $id_jahitan);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('id_quotation', $id_quotation);
    $this->template->render('form_jahit_curtain');
  }

  public function addJahitLining()
  {

    $no = $this->input->post('no');
    $type = $this->input->post('type');
    $id_jahitan = $this->input->post('id_jahitan');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');
    // echo "<pre>";
    // print_r($id_ruangan);
    // echo "</pre>";
    $this->template->set('no', $no);
    $this->template->set('id_jahitan', $id_jahitan);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('id_quotation', $id_quotation);
    $this->template->render('form_jahit_lining');
  }

  public function addJahitVitrage()
  {

    $no = $this->input->post('no');
    $type = $this->input->post('type');
    $id_jahitan = $this->input->post('id_jahitan');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');
    // exit;
    $vitrage = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation])->row();
    $jahitan = $this->db->get_where('sewing', ['activation' => 'aktif'])->result();

    $this->template->set(
      [
        'no' => $no,
        'id_jahitan' => $id_jahitan,
        'id_ruangan' => $id_ruangan,
        'vitrage' => $vitrage,
        'jahitan' => $jahitan
      ]
    );

    $this->template->render('form_jahit_vitrage');
  }

  public function get_rail_curtain()
  {
    $no = $this->input->post('no');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');

    $this->template->set('no', $no);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('id_quotation', $id_quotation);
    $this->template->render('rail_curtain');
  }


  public function get_rail_lining()
  {
    $no = $this->input->post('no');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');
    $fabrics_lining = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation, 'item' => 'lining'])->row();
    $rails = $this->db->get_where('mp_rail', ['activation' => 'aktif'])->result();

    $this->template->set('no', $no);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('fabrics_lining', $fabrics_lining);
    $this->template->set('rails', $rails);
    $this->template->render('rail_lining');
  }

  public function get_rail_vitrage()
  {
    $no = $this->input->post('no');
    $id_ruangan = $this->input->post('id_ruangan');
    $id_quotation = $this->input->post('id_quotation');
    $fabrics_vitrage = $this->db->get_where('qtt_product_fabric', ['id_ruangan' => $id_ruangan, 'id_quotation' => $id_quotation, 'item' => 'vitrage'])->row();
    $rails = $this->db->get_where('mp_rail', ['activation' => 'aktif'])->result();

    $this->template->set('no', $no);
    $this->template->set('id_ruangan', $id_ruangan);
    $this->template->set('fabrics_vitrage', $fabrics_vitrage);
    $this->template->set('rails', $rails);
    $this->template->render('rail_vitrage');
  }


  public function transport()
  {
    $id = $this->input->post('id');
    $transport = $this->db->get_where('jenis_transportasi', ['id_transportasi' => $id])->result();

    $option = "";
    foreach ($transport as $trans) {
      $option = "<option value=" . $trans->id . ">" . $trans->nama_jenis_transportasi . "</option>";
    }

    // echo $option;
    $data = [
      'option' => $option
    ];

    echo json_encode($data);
  }

  public function reopen_po()
  {
    $id = $this->input->post('id_quotation');

    $this->db->trans_begin();
    $reopenpo   = $this->db->where('id', $id)->update('quotation_header', ['status' => '0', 'tgl_upload_po' => null, 'no_po' => null, 'upload_po' => null]);
    $this->db->trans_complete();


    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $Arr_Kembali  = array(
        'msg'    => 'Failed Add Changes. Please try again later ...',
        'status'  => 0
      );
      $keterangan = 'FAILED, Reopen PO Data ' . $id;
      $status = 0;
      $nm_hak_akses = $this->addPermission;
      $kode_universal = $this->auth->user_id();
      $jumlah = 1;
      $sql = $this->db->last_query();
    } else {
      $this->db->trans_commit();
      $Arr_Kembali  = array(
        'msg'    => 'Success Delete Item. Thanks ...',
        'status'  => 1
      );

      $keterangan = 'SUCCESS, Reopen PO Data ' . $id;
      $status = 1;
      $nm_hak_akses = $this->addPermission;
      $kode_universal = $this->auth->user_id();
      $jumlah = 1;
      $sql = $this->db->last_query();
    }
    echo json_encode($Arr_Kembali);
  }

  public function view_file()
  {
    $filename = $this->input->post('filename');

    // The location of the PDF file 
    // on the server 
    $files = $_SERVER['DOCUMENT_ROOT'] . 'assets/po/' . $filename;

    // Header content type 
    header("Content-type: application/pdf");

    header("Content-Length: " . filesize($files));

    // Send the file to the browser. 
    readfile($files);
  }

  public function print_quotation($id)
  {

    $mpdf = new mPDF('', '', '', '', '', '', '', '', '', '');
    $mpdf->SetImportUse();
    $mpdf->RestartDocTemplate();

    // $newId = str_replace('-', '/', $id);
    $data           = $this->db->get_where('quotation_header', array('id' => $id))->row();
    $customer       = $this->db->get_where('master_customer', array('id_customer' => $data->id_customer))->row();
    $cat_cust       = $this->db->get_where('child_customer_category', array('id_category_customer' => $data->id_cust_cut))->row();
    $disc_cat       = $this->db->get_where('discount_category', array('id_category' => $data->id_disc_cat))->row();
    $type_pro       = $this->db->get_where('type_project', array('id_type_project' => $data->id_type_project))->row();
    $pic_cust       = $this->db->get_where('child_customer_pic', array('id_customer' => $data->id_customer))->row();
    $karyawan       = $this->db->get_where('karyawan', array('id_karyawan' => $data->id_karyawan))->row();
    $rooms         = $this->db->get_where('quotation_room', array('id_quotation' => $id))->result();
    $pay_term         = $this->db->get_where('payment_term', array('id_quotation' => $id))->result();

    // echo "<pre>";
    // print_r($customer);
    // echo "</pre>";
    $this->template->set([
      'data' => $data,
      'customer' => $customer,
      'cat_cust' => $cat_cust,
      'pic_cust' => $pic_cust,
      'disc_cat' => $disc_cat,
      'type_pro' => $type_pro,
      'karyawan' => $karyawan,
      'pay_term' => $pay_term,
      'rooms' => $rooms
    ]);

    $pengantar = $this->template->load_view('print_quotation1', $data);
    $quotation = $this->template->load_view('print_quotation', $data);

    $header = '<div style="text-align:center;"><img src="' . base_url() . '/assets/images/importa.png" style="width: 230px; height: auto; margin: 0;text-align:center" /></div>';
    $this->mpdf->SetHTMLHeader($header);
    $this->mpdf->SetHTMLFooter('<div style="text-align:center;font-size:9px"><hr>Jl Mangga Besar Raya 59 C Jakarta 11180 - INDONESIA Telp: 62-21-6010551-3, website: www.idefabrics.com</div>');
    // $this->mpdf->AddPage(
    //   'P',
    //   '',
    //   '',
    //   '',
    //   '',
    //   15, // margin_left
    //   15, // margin right
    //   30, // margin top
    //   15, // margin bottom
    //   7, // margin header
    //   3 // margin footer
    // );
    // $this->mpdf->WriteHTML($pengantar);
    $this->mpdf->AddPage(
      'L',
      '',
      '',
      '',
      '',
      15, // margin_left
      15, // margin right
      30, // margin top
      15, // margin bottom
      7, // margin header
      3 // margin footer
    );
    $this->mpdf->WriteHTML($quotation);
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
    // echo "<pre>";
    // print_r("askdk");
    // echo "<pre>";
    // exit;

    // Panggil class PHPExcel nya
    // require(APPPATH . 'libraries/PHPExcel_NEW/Classes/PHPExcel.php');
    // require(APPPATH . 'libraries/PHPExcel_NEW/Classes/PHPExcel/Writer/Excel5.php');

    $excel = new PHPExcel();

    // Settingan awal fil excel
    $excel->getProperties()->setCreator('Idefab')
      ->setLastModifiedBy('Idefab')
      ->setTitle("Quotation Lost")
      ->setSubject("Quotation")
      ->setDescription("Report Quotation Lost")
      ->setKeywords("Quotation Lost");

    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    $excel->setActiveSheetIndex(0)->setCellValue('A1', "QUOTATION LOST REPORT"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "NO QUOTATION"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "DATE"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "CUSTOMER"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "MARKETING"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "TOTAL"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "STATUS"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('H3', "REASON"); // Set kolom E3 dengan tulisan "ALAMAT"

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);


    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    $queryQtt = "SELECT
    		  a.id_quotation,a.date,b.name_customer,c.nama_karyawan, a.grand_total,a.status,a.activation,a.reason
    		FROM
    		  quotation_header a LEFT JOIN master_customer b ON a.id_customer = b.id_customer
    		   INNER JOIN karyawan c ON a.id_karyawan = c.id_karyawan WHERE 1=1 and a.status = '2' and a.activation='aktif'";
    $dataQtt = $this->db->query($queryQtt)->result();

    // echo "<pre>";
    // print_r($dataQtt);
    // echo "<pre>";
    // exit;

    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach ($dataQtt as $qtt) { // Lakukan looping pada variabel siswa
      // echo "<pre>";
      // print_r($qtt);
      // echo "<pre>";
      // exit;
      $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $qtt->id_quotation);
      $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $qtt->date);
      $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $qtt->name_customer);
      $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $qtt->nama_karyawan);
      $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $qtt->grand_total);
      $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $qtt->status);
      $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $qtt->reason);

      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);

      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(50); // Set width kolom E

    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("QUOTATION LOST REPORT");
    $excel->setActiveSheetIndex(0);

    // // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="QUOTATION LOST REPORT.xls"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    ob_end_clean();
    $writer->save('php://output');
    exit;
  }
}
