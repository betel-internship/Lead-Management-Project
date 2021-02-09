<?php 
if(!defined('BASEPATH')) EXIT('No direct script access allowed');
error_reporting(0);
class SupportController extends MY_Controller {
    public function __construct() {
        parent::__construct();
                $this->load->model('Support_Model');
                $this->load->model("GenericModel");
    }
    public function index(){
    $data['template']='index';
    if($this->session->userdata('USERTYPE')=='Employee'){
    $userid=$this->session->userdata('ADMIN_ID');   
    $data['leads']=$this->GenericModel->get_record_with_condition("tbl_lead","SUM(CASE WHEN status = 'Contacted' THEN 1 ELSE 0 END) AS 'contacted',SUM(CASE WHEN status = 'Not Contacted' THEN 1 ELSE 0 END) AS 'notcontacted',SUM(CASE WHEN status = 'E Relevant' THEN 1 ELSE 0 END) AS 'erelevant',SUM(CASE WHEN status = 'Follow Up' THEN 1 ELSE 0 END) AS 'followup',SUM(CASE WHEN status = 'Case Dropped' THEN 1 ELSE 0 END) AS 'casedropped',SUM(CASE WHEN status = 'Lost Lead' THEN 1 ELSE 0 END) AS 'lostlead',SUM(CASE WHEN status = 'Importance' THEN 1 ELSE 0 END) AS 'importance',SUM(CASE WHEN status = 'Negotiation' THEN 1 ELSE 0 END) AS 'negotiation',SUM(CASE WHEN status = 'Deal Done' THEN 1 ELSE 0 END) AS 'dealdone',SUM(CASE WHEN status = 'Quotation Sending' THEN 1 ELSE 0 END) AS 'quotationsending'","userid='".$userid."'");
    }else{
    $data['total_staff']=$this->GenericModel->get_record_with_condition("tbl_registration","count(id) as total_count","user_type='Employee'");    
    $data['leads']=$this->GenericModel->get_record("tbl_lead","SUM(CASE WHEN status = 'Contacted' THEN 1 ELSE 0 END) AS 'contacted',SUM(CASE WHEN status = 'Not Contacted' THEN 1 ELSE 0 END) AS 'notcontacted',SUM(CASE WHEN status = 'E Relevant' THEN 1 ELSE 0 END) AS 'erelevant',SUM(CASE WHEN status = 'Follow Up' THEN 1 ELSE 0 END) AS 'followup',SUM(CASE WHEN status = 'Case Dropped' THEN 1 ELSE 0 END) AS 'casedropped',SUM(CASE WHEN status = 'Lost Lead' THEN 1 ELSE 0 END) AS 'lostlead',SUM(CASE WHEN status = 'Importance' THEN 1 ELSE 0 END) AS 'importance',SUM(CASE WHEN status = 'Negotiation' THEN 1 ELSE 0 END) AS 'negotiation',SUM(CASE WHEN status = 'Deal Done' THEN 1 ELSE 0 END) AS 'dealdone',SUM(CASE WHEN status = 'Quotation Sending' THEN 1 ELSE 0 END) AS 'quotationsending'");
    }
    $data['title'] ='Home';
    $data['page']='Home';
    $this->layout_admin($data);
     }
   public function login_admin(){
      $this->load->view('admin/site/login');  
    }
public function support_login(){
$username=trim($this->input->post('username'));
$password=trim($this->input->post('password'));
$password=md5($password);
  $table='tbl_registration';
  $field='id,full_name,mobile_no,email_address,user_type'; 
  $condition="email_address='$username'  and password='".$password."' and status='active'"; 
  $query=$this->GenericModel->get_record_with_condition($table,$field,$condition);
 // echo $this->db->last_query();
$array=array();
if(count($query)>=1){
 $session_data['ADMIN_ID']=$query[0]->id;
 $session_data['USERNAME']=$query[0]->full_name;
 $session_data['MOBILE']=$query[0]->mobile_no;
 $session_data['EMAIL']=$query[0]->email_address;
 $session_data['USERTYPE']=$query[0]->user_type;
 $session_data['ROLE']=$query[0]->role;
 $this->session->set_userdata($session_data);
 $array=array('code'=>200,'message'=>'Redirecting Login Successfull...');   
 }else{
 $array=array('code'=>400,'message'=>'Email ID No or Password Incorrect');    
 }
 echo json_encode($array);
 //exit;
}
public function login_support_process(){
  echo $this->Support_Model->login_support_process($_POST);
  }
public function support_user_logout(){
  session_destroy();
  redirect('admin-login');
 }
public function employee(){
$data['template']='employee';
$data['title'] ='Globallianz Employee';
$data['role']=$this->GenericModel->get_record('tbl_role',"*");
$data['page']='Globallianz Employee';
$this->layout_admin($data);
 }
 public function change_password(){
    $data['template']='change_password';
    $data['title'] ='Change Password';
    $data['page']='Globallianz Employee';
    $this->layout_admin($data);
 }
 public function detail_lead_details(){
$data['template']='status_wise_lead';
$data['title'] =$_GET['lead_status'].' Lead';
$data['role']=$this->GenericModel->get_record('tbl_role',"*");
$data['status']=$this->GenericModel->get_record('tbl_status',"*");
if(isset($_GET['view'])){
$data['lead_data']=$this->GenericModel->get_record_with_condition("tbl_comment","*","lead_id='". base64_decode($_GET['view'])."' order by id desc");
}
$data['page']=$_GET['lead_status'].' Lead';
$this->layout_admin($data);
 }
 public function create_lead(){
$data['template']='lead';
$data['title'] ='Create Lead';
$data['status']=$this->GenericModel->get_record('tbl_status',"*");
$data['employee']=$this->GenericModel->get_record_with_condition("tbl_registration","full_name,id","user_type='Employee'"); 
$data['page']='Create Lead';
$this->layout_admin($data);
 }
  public function employee_created_leads(){
$data['template']='employee_all_leads';
$data['title'] ='Employee Lead';
$data['status']=$this->GenericModel->get_record('tbl_status',"*");
//$data['employee']=$this->GenericModel->get_record_with_condition("tbl_registration","full_name,id","user_type='Employee'"); 
$data['page']='Employee Lead';
$this->layout_admin($data);
 }
public function update_referral_plans(){
   $amount_array=$_POST['amount'];
    $id_array=$_POST['id'];
   for ($i = 0; $i < count($amount_array); $i++) {
    $amount =$amount_array[$i];
     $id= $id_array[$i];   
     $insert_array=array('amount'=>$amount);
     $where='id='.$id;
     $this->GenericModel->update_generic_record('tbl_payment_type',$insert_array,$where);
   }  
   $this->session->set_userdata('success','Rate changed successfully'); 
   redirect('update_hotel_and_vendor');
  } 
  
   public function add_new_location(){
  $types=$this->input->post('types');
  
  $table='tbl_location';
  $condtion="locations='$types'";
  $duplication=$this->GenericModel->get_record_with_condition($table,$field,$condtion); 
  if(count($duplication)==0){
  $array=array('locations'=>$types);
  $con=$this->db->insert('tbl_location',$array);
  if($con==true){
      echo json_encode(array('message'=>'Location added successfully','code'=>200));  
      $this->session->set_userdata('success','location added Successfully'); 
  }else{
    echo json_encode(array('message'=>'some thing went wrong','code'=>400));    
  }
  }else{
    echo json_encode(array('message'=>'This Location already added','code'=>400));      
  }
 }
  public function update_new_location(){
  $types=$this->input->post('types');
  $id=$this->input->post('id');
    $table='tbl_location';
  $condtion="locations='$types' and id<>'".$id."'";
  $duplication=$this->GenericModel->get_record_with_condition($table,$field,$condtion); 
  if(count($duplication)==0){
  $array=array('locations'=>$types);
       $this->db->where('id',$id);
  $con=$this->db->update('tbl_location',$array);
  if($con==true){
      echo json_encode(array('message'=>'Location update successfully','code'=>200));  
      $this->session->set_userdata('success','Location update Successfully'); 
  }else{
    echo json_encode(array('message'=>'some thing went wrong','code'=>400));    
  }
 }else{
    echo json_encode(array('message'=>'This Location already added','code'=>400));      
  }
 }
  public function delete_location_masters(){
 $id=$this->input->post('id');    
 $query=$this->db->query("delete from tbl_location  where id='$id'");
 if($query==true){
    $this->session->set_userdata('success','Location Deleted Successfully'); 
    echo json_encode(array('message'=>'Location Deleted Successfully','code'=>200));
  }else{
    echo json_encode(array('message'=>'deleted unsuccessfull','code'=>400));   
  } 
 }
 public function change_password_process(){
   $new_password=trim($this->input->post('new_password'));
   $ADMIN_ID=$this->session->userdata('ADMIN_ID');
   $array=array();  
   if(empty($new_password)){
   $array=array('code'=>400,'message'=>'Please enter new password'); 
   }else{
   $update=array('password'=> md5($new_password));
   $this->db->where('id',$ADMIN_ID);
   $get =$this->db->update('tbl_registration',$update);
  if($get==true){
   $array=array('code'=>200,'message'=>'Password Change Successfully'); 
   $this->session->set_userdata('success','Password Change Successfully');
  }else{
   $array=array('code'=>400,'message'=>'some thing went wrong');     
    }
   }
   echo json_encode($array);
   exit;
  }
}

?>