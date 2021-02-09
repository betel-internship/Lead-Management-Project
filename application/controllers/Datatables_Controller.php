<?php
class Datatables_Controller  extends MY_Controller{
    public function __construct() {
    parent::__construct();
   }
      // Job Requirement
      public function employee_listing_paging(){  
      
        $list = $this->Datatables_Model->get_datatables_employee();
        $data = array();
        $no = $_POST['start'];
		$status='';
		
        foreach ($list as $rows) {
            $status='';
            if($rows->status=='active'){
            $status='<a  class="btn btn-gradient-success btn-rounded btn-fw btn-sm" href="#" onclick="update_employee_status('.$rows->id.',1)"><i class="mdi mdi-check-circle"></i> Active</a>';
            }else{
            $status='<a class="btn btn-gradient-danger btn-rounded btn-fw btn-sm" href="#" onclick="update_employee_status('.$rows->id.',2)"><i class="mdi mdi-window-close"></i> Inactive</a>';    
            }
            $edit='<a class="btn btn-gradient-primary btn-rounded btn-fw btn-sm" href="'. site_url().'employee?update='.base64_encode($rows->id).'" title="Edit"><i class="fa fa-edit"></i></a>';
             $view='<a class="btn btn-gradient-info btn-rounded btn-fw btn-sm" href="'. site_url().'employee?view='.base64_encode($rows->id).'" title="View"><i class="fa fa-eye"></i></a>';
             $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->full_name;
            $row[] = $rows->mobile_no;
            $row[] = $rows->email_address;
            $row[] = $rows->location;
            $row[] = $rows->role;
            $row[] = $status.'&nbsp;'.$edit.'&nbsp;'.$view;
            $data[] = $row;
        }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_employee(),"recordsFiltered" => $this->Datatables_Model->count_filtered_employee(),"data" => $data,);
        //output to json format
        echo json_encode($output);
    }
    
     // Job Requirement
      public function lead_details_pagination(){   
           $usertype=$this->session->userdata('USERTYPE');
       $userid=$this->session->userdata('ADMIN_ID');
        $list = $this->Datatables_Model->get_datatables_lead($usertype,$userid);
        $data = array();
        $no = $_POST['start'];
		$status='';
                
	 if($usertype=='Admin'){	
        foreach ($list as $rows) {
         
            $status='<a class="btn btn-gradient-primary btn-rounded btn-fw btn-sm" href="#">'.$rows->status.'</a>';    
            $edit='<a class="btn btn-gradient-primary btn-rounded btn-fw btn-sm" href="'. site_url().'create_lead?update='.base64_encode($rows->id).'" title="Edit"><i class="fa fa-edit"></i></a>';
            $delete='<a class="btn btn-gradient-danger btn-rounded btn-fw btn-sm" href="#" onclick="return delete_lead_creation('.$rows->id.')" title="Delete"><i class="fa fa-trash"></i></a>';
            $view='<a class="btn btn-gradient-info btn-rounded btn-fw btn-sm" href="'. site_url().'create_lead?view='.base64_encode($rows->id).'" title="View"><i class="fa fa-eye"></i></a>';
             $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->customer_name;
            $row[] = $rows->mobile_no;
            $row[] = $rows->city.','.$rows->state;
            $row[] = $rows->assigned_by;
            $row[] = $rows->assigned_to;
            $row[] = date('Y-m-d h:i A', strtotime($rows->created_date));
            $row[]=$status;
            $row[] = $edit.'&nbsp;'.$delete.'&nbsp;'.$view;
            $data[] = $row;
       
        }
      }else{
       foreach ($list as $rows) {
         
            $status='<a class="btn btn-gradient-primary btn-rounded btn-fw btn-sm" href="#">'.$rows->status.'</a>';    
            $edit='<a class="btn btn-gradient-primary btn-rounded btn-fw btn-sm" href="'. site_url().'employee_created_leads?update='.base64_encode($rows->id).'" title="Edit"><i class="fa fa-edit"></i></a>';
            $view='<a class="btn btn-gradient-info btn-rounded btn-fw btn-sm" href="'. site_url().'employee_created_leads?view='.base64_encode($rows->id).'" title="View"><i class="fa fa-eye"></i></a>';
            
             $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->customer_name;
            $row[] = $rows->mobile_no;
            $row[] = $rows->city.','.$rows->state;
            $row[] = $rows->assigned_by;
            $row[] = $rows->assigned_to;
            $row[] = date('Y-m-d h:i A', strtotime($rows->created_date));
            $row[]=$status;
            $row[] = $edit.'&nbsp;'.'&nbsp;'.$view;
            $data[] = $row;
       
        }    
      }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_lead($usertype,$userid),"recordsFiltered" => $this->Datatables_Model->count_filtered_lead($usertype,$userid),"data" => $data,);
        //output to json format
        echo json_encode($output);
    }
    public function lead_details_pagination_details(){
        $types=$this->input->post('lead_status');
        $ADMIN_ID=$this->session->userdata('ADMIN_ID');
        if($this->session->userdata('USERTYPE')=='Employee'){
        $list = $this->Datatables_Model->get_datatables_lead_details($types,$ADMIN_ID);
        }else{
            $ADMIN_ID='';
         $list = $this->Datatables_Model->get_datatables_lead_details($types,$ADMIN_ID);    
        }
      //  echo $this->db->last_query();
        $data = array();
        $no = $_POST['start'];
		$status='';
		
        foreach ($list as $rows) {
            $status='';
          
            $status='<a class="btn btn-gradient-primary btn-rounded btn-fw btn-sm" href="#">'.$rows->status.'</a>';  
           
            $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name","id='".$rows->userid."'"); 
            $view='<a class="btn btn-gradient-info btn-rounded btn-fw btn-sm" href="'. site_url().'detail_lead_details?view='.base64_encode($rows->id).'&lead_status='.$types.'" title="View"><i class="fa fa-eye"></i></a>';
             $no++;
            $row = array();
           $row[] = $no;
            $row[] = $rows->customer_name;
            $row[] = $rows->mobile_no;
            $row[] = $rows->city.','.$rows->state;
            $row[] = $rows->assigned_by;
            $row[] = $rows->assigned_to;
            $row[] = date('Y-m-d h:i A', strtotime($rows->created_date));
            $row[]=$status;
            $row[] = $view;
            $data[] = $row;
        }
     if($this->session->userdata('USERTYPE')=='Employee'){    
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_lead_details($types,$ADMIN_ID),"recordsFiltered" => $this->Datatables_Model->count_filtered_lead_details($types,$ADMIN_ID),"data" => $data,);
     }else{
   $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_lead_details($types,$ADMIN_ID),"recordsFiltered" => $this->Datatables_Model->count_filtered_lead_details($types,$ADMIN_ID),"data" => $data,);      
     }
        //output to json format
        echo json_encode($output);
    } 
    
    
}
?>