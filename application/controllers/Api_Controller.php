<?php
class Api_Controller  extends MY_Controller{
    public function __construct() {
    parent::__construct();
   error_reporting(0);
   date_default_timezone_set('Asia/Kolkata');
   }
    public function generateByMicrotime() {
        $microtime = str_replace('.', '', microtime(true));
        return (substr($microtime, 0, 14));
    } 
    public function  registration_employee(){
   
   $full_name=trim($this->input->post('full_name'));
   $mobile_no=trim($this->input->post('mobile_no'));
   $email_address=trim($this->input->post('email_address'));
   $password=trim($this->input->post('password'));
   $location=trim($this->input->post('location'));
   $role=trim($this->input->post('role'));
  
  $table='tbl_registration';
  $field='id';
  $condition_username="email_address='$email_address'";
  $duplicate_username=$this->GenericModel->get_record_with_condition($table,$field,$condition_username); 
   $array=array();

   if(count($duplicate_username)>=1){ 
     $array=array('code'=>400,'message'=>'This email id already register');
   }elseif(empty($full_name)){
     $array=array('code'=>400,'message'=>'Please enter full name');
   }elseif(empty ($password)){
     $array=array('code'=>400,'message'=>'Please enter password');
   }elseif(empty ($mobile_no)){
     $array=array('code'=>400,'message'=>'Please enter mobile number');
   }else{
     $insert_array=array('full_name'=>$full_name,'mobile_no'=>$mobile_no,'email_address'=>$email_address,'password'=>md5($password),'created_date'=>date('Y-m-d H:i:s'),'user_type'=>'Employee','status'=>'active','location'=>$location,'role'=>$role);
     $con=$this->GenericModel->insert_generic_record($table,$insert_array);
  if($con=='Error'){
    $array=array('code'=>400,'message'=>'Some thing went wrong');
  }else{
    $array=array('code'=>200,'message'=>'Employee register successfully..');
    $this->session->set_userdata('success','Employee register successfully');
   }
  }
  echo json_encode($array);
 }
   public function change_status_employee(){
    $id=$this->input->post('id');
   $type=$this->input->post('type');
  $status='';
   if($type==1){
  $status='inactive';    
  }else{
   $status='active';   
  }
  $query=$this->db->query("update  tbl_registration set status='$status' where id='$id'");
 if($query==true){ 
    $this->session->set_userdata('success','Status Changed Successfully'); 
    echo json_encode(array('message'=>'update successfull','code'=>200));
  }else{
    echo json_encode(array('message'=>'update unsccessfull','code'=>400));   
  } 
 } 
 public function updates_employee(){
   $full_name=trim($this->input->post('full_name'));
   $mobile_no=trim($this->input->post('mobile_no'));
   $email_address=trim($this->input->post('email_address'));
   $location=trim($this->input->post('location'));
   $role=trim($this->input->post('role')); 
   $id=trim($this->input->post('id')); 
   $insert_array=array('full_name'=>$full_name,'mobile_no'=>$mobile_no,'email_address'=>$email_address,'location'=>$location,'role'=>$role);
   $where='id='.$id; 
    $con=$this->GenericModel->update_generic_record('tbl_registration',$insert_array,$where);
     if($con=='Error'){
     $array=array('code'=>400,'message'=>'Some thing went wrong'); 
      echo json_encode($array);
     exit;
    }else{
    $this->session->set_userdata('success','Employee information updated successfully..');     
    $array=array('code'=>200,'message'=>'Employee information updated successfully..');
    }
  echo json_encode($array);  
 }
 
 
 public function lead_creation_process_employee(){
  
  $info=$this->input->post();
  $customer_name=trim($info['customer_name']); $company_name=trim($info['company_name']); $city=trim($info['city']);
  $mobile_no=trim($info['mobile_no']); $state=trim($info['state']); $description=trim($info['description']); 
  $secondary_mobile_no=trim($info['secondary_mobile_no']); $email_id=trim($info['email_id']); 
  $lead_source=trim($info['lead_source']); $requirement=trim($info['requirement']);
  $status=trim($info['status']);
  $lead_ids=time();
     
  $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name,id","user_type='Admin'");
  $from_userid=$this->session->userdata('ADMIN_ID'); $to_userid=$to_user[0]->id;
  $from_username=$this->session->userdata('USERNAME'); $to_username=$to_user[0]->full_name;
     
  $insert_array=array('customer_name'=>$customer_name,'company_name'=>$company_name,'city'=>$city,'mobile_no'=>$mobile_no,'state'=>$state,'secondary_mobile_no'=>$secondary_mobile_no,'lead_source'=>$lead_source,'email_id'=>$email_id,'requirement'=>$requirement,'description'=>$description,'status'=>$status,'userid'=>$from_userid,'created_date'=>date('Y-m-d H:i:s'),'lead_id'=>$lead_ids,'assigned_by'=>$from_username,'assigned_to'=>$from_username);
  $con=$this->GenericModel->insert_generic_record('tbl_lead',$insert_array);
   if($con=='Error'){
     $array=array('code'=>400,'message'=>'Some thing went wrong'); 
      echo json_encode($array);
     exit;
    }else{
     $lead_id=$con;
     $Notification_type='Lead';
     $message='<b style="color:green">'.$from_username.'</b> This Employee Created New Lead';
     $notification=array('from_username'=>$from_username,'to_username'=>$to_username,'from_userid'=>$from_userid,'to_userid'=>$to_userid,'message'=>$message,'view'=>'0','created_date'=>date('Y-m-d H:i:s'),'status'=>'active','lead_id'=>$lead_id,'Notification_type'=>$Notification_type);
     $con=$this->GenericModel->insert_generic_record('tbl_notification',$notification);
    $this->session->set_userdata('success','Lead Created successfully..');     
    $array=array('code'=>200,'message'=>'Lead Created successfully..');
    }
  echo json_encode($array);   
  }
  
  public function update_creation_process_employee(){
  
  $info=$this->input->post();
 $customer_name=trim($info['customer_name']); $company_name=trim($info['company_name']); $city=trim($info['city']);
  $mobile_no=trim($info['mobile_no']); $state=trim($info['state']); $description=trim($info['description']); 
  $secondary_mobile_no=trim($info['secondary_mobile_no']); $email_id=trim($info['email_id']); 
  $lead_source=trim($info['lead_source']); $requirement=trim($info['requirement']);
  $status=trim($info['status']);
  
  $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name","user_type='Admin'");
  $from_userid=$this->session->userdata('ADMIN_ID'); $to_userid=$userid;
  $from_username=$this->session->userdata('USERNAME'); $to_username=$to_user[0]->full_name;
  
  $lead_ids=time();
  $id=$info['id'];
  $insert_array=array('customer_name'=>$customer_name,'company_name'=>$company_name,'city'=>$city,'mobile_no'=>$mobile_no,'state'=>$state,'secondary_mobile_no'=>$secondary_mobile_no,'lead_source'=>$lead_source,'email_id'=>$email_id,'requirement'=>$requirement,'description'=>$description,'status'=>$status,'assigned_by'=>$from_username,'assigned_to'=>$to_username);
  $where='id='.$id;
   $con=$this->GenericModel->update_generic_record('tbl_lead',$insert_array,$where);
   if($con=='Error'){
     $array=array('code'=>400,'message'=>'Some thing went wrong'); 
      echo json_encode($array);
     exit;
    }else{
    /* $lead_id=$id;
     $Notification_type='Lead';
      $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name","id='".$userid."'");
     $from_userid=$this->session->userdata('ADMIN_ID'); $to_userid=$userid;
     $from_username=$this->session->userdata('USERNAME'); $to_username=$to_user[0]->full_name;
     $message='<b style="color:green">'.$title.'</b> This Lead Updated By '.$from_username;
     $notification=array('from_username'=>$from_username,'to_username'=>$to_username,'from_userid'=>$from_userid,'to_userid'=>$to_userid,'message'=>$message,'view'=>'0','created_date'=>date('Y-m-d H:i:s'),'status'=>'active','lead_id'=>$lead_id,'Notification_type'=>$Notification_type);
     $con=$this->GenericModel->insert_generic_record('tbl_notification',$notification);*/
    $this->session->set_userdata('success','Lead Updated successfully..');     
    $array=array('code'=>200,'message'=>'Lead Updated successfully..');
    }
  echo json_encode($array);   
  }
 
 
public function lead_creation_process(){
  
  $info=$this->input->post();
  $customer_name=trim($info['customer_name']); $company_name=trim($info['company_name']); $city=trim($info['city']);
  $mobile_no=trim($info['mobile_no']); $state=trim($info['state']); $description=trim($info['description']); 
  $secondary_mobile_no=trim($info['secondary_mobile_no']); $email_id=trim($info['email_id']); 
  $lead_source=trim($info['lead_source']); $requirement=trim($info['requirement']);
  $status=trim($info['status']); $userid=trim($info['userid']);
  $lead_ids=time();
     
  $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name","id='".$userid."'");
  $from_userid=$this->session->userdata('ADMIN_ID'); $to_userid=$userid;
  $from_username=$this->session->userdata('USERNAME'); $to_username=$to_user[0]->full_name;
     
  $insert_array=array('customer_name'=>$customer_name,'company_name'=>$company_name,'city'=>$city,'mobile_no'=>$mobile_no,'state'=>$state,'secondary_mobile_no'=>$secondary_mobile_no,'lead_source'=>$lead_source,'email_id'=>$email_id,'requirement'=>$requirement,'description'=>$description,'status'=>$status,'userid'=>$userid,'created_date'=>date('Y-m-d H:i:s'),'lead_id'=>$lead_ids,'assigned_by'=>$from_username,'assigned_to'=>$to_username);
  $con=$this->GenericModel->insert_generic_record('tbl_lead',$insert_array);
   if($con=='Error'){
     $array=array('code'=>400,'message'=>'Some thing went wrong'); 
      echo json_encode($array);
     exit;
    }else{
     $lead_id=$con;
     $Notification_type='Lead';
     $message='<b style="color:green">Lead ID '.$lead_ids.'</b> This Lead Assign you';
     $notification=array('from_username'=>$from_username,'to_username'=>$to_username,'from_userid'=>$from_userid,'to_userid'=>$to_userid,'message'=>$message,'view'=>'0','created_date'=>date('Y-m-d H:i:s'),'status'=>'active','lead_id'=>$lead_id,'Notification_type'=>$Notification_type);
     $con=$this->GenericModel->insert_generic_record('tbl_notification',$notification);
    $this->session->set_userdata('success','Lead Created successfully..');     
    $array=array('code'=>200,'message'=>'Lead Created successfully..');
    }
  echo json_encode($array);   
  }
  
  public function update_creation_process(){
  
  $info=$this->input->post();
  
 $customer_name=trim($info['customer_name']); $company_name=trim($info['company_name']); $city=trim($info['city']);
  $mobile_no=trim($info['mobile_no']); $state=trim($info['state']); $description=trim($info['description']); 
  $secondary_mobile_no=trim($info['secondary_mobile_no']); $email_id=trim($info['email_id']); 
  $lead_source=trim($info['lead_source']); $requirement=trim($info['requirement']);
  $status=trim($info['status']); $userid=trim($info['userid']);
  
  $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name","id='".$userid."'");
  $from_userid=$this->session->userdata('ADMIN_ID'); $to_userid=$userid;
  $from_username=$this->session->userdata('USERNAME'); $to_username=$to_user[0]->full_name;
  
  $lead_ids=time();
  $id=$info['id'];
  $insert_array=array('customer_name'=>$customer_name,'company_name'=>$company_name,'city'=>$city,'mobile_no'=>$mobile_no,'state'=>$state,'secondary_mobile_no'=>$secondary_mobile_no,'lead_source'=>$lead_source,'email_id'=>$email_id,'requirement'=>$requirement,'description'=>$description,'status'=>$status,'userid'=>$userid,'assigned_by'=>$from_username,'assigned_to'=>$to_username);
  $where='id='.$id;
   $con=$this->GenericModel->update_generic_record('tbl_lead',$insert_array,$where);
   if($con=='Error'){
     $array=array('code'=>400,'message'=>'Some thing went wrong'); 
      echo json_encode($array);
     exit;
    }else{
    /* $lead_id=$id;
     $Notification_type='Lead';
      $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name","id='".$userid."'");
     $from_userid=$this->session->userdata('ADMIN_ID'); $to_userid=$userid;
     $from_username=$this->session->userdata('USERNAME'); $to_username=$to_user[0]->full_name;
     $message='<b style="color:green">'.$title.'</b> This Lead Updated By '.$from_username;
     $notification=array('from_username'=>$from_username,'to_username'=>$to_username,'from_userid'=>$from_userid,'to_userid'=>$to_userid,'message'=>$message,'view'=>'0','created_date'=>date('Y-m-d H:i:s'),'status'=>'active','lead_id'=>$lead_id,'Notification_type'=>$Notification_type);
     $con=$this->GenericModel->insert_generic_record('tbl_notification',$notification);*/
    $this->session->set_userdata('success','Lead Updated successfully..');     
    $array=array('code'=>200,'message'=>'Lead Updated successfully..');
    }
  echo json_encode($array);   
  }
  public function submitted_your_commenting(){
      $array=array();
      $info=$this->input->post();
     $lead_id=trim($info['lead_id']);
     $lead_title=trim($info['lead_title']);
     $comment=trim($info['comment']);
     $lead_statuss=trim($info['lead_statuss']);
     $userid=trim($info['userid']);
     $lead_id_ID=trim($info['lead_id_ID']);
   $lead_getting=$this->GenericModel->get_record_with_condition("tbl_comment","id","lead_id='".$lead_id."'");  
   $to_userid='';
   $to_username='';
   if($this->session->userdata('USERTYPE')=='Admin'){
   $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name","id='".$userid."'");
   $to_userid=$userid;
   $to_username=$to_user[0]->full_name;
   }else{
    $to_user=$this->GenericModel->get_record_with_condition("tbl_registration","full_name,id","user_type='Admin'");   
    $to_userid=$to_user[0]->id;
    $to_username=$to_user[0]->full_name;
   }
   $from_username=$this->session->userdata('USERNAME');
   $from_userid=$this->session->userdata('ADMIN_ID');
   $Notification_type='Lead';
   $message='<b style="color:green">ID ID'.$lead_id_ID.'</b> Commented';
   $notification=array('from_username'=>$from_username,'to_username'=>$to_username,'from_userid'=>$from_userid,'to_userid'=>$to_userid,'message'=>$message,'view'=>'0','created_date'=>date('Y-m-d H:i:s'),'status'=>'active','lead_id'=>$lead_id,'Notification_type'=>$Notification_type);
    $con=$this->GenericModel->insert_generic_record('tbl_notification',$notification);
  
   if(count($lead_getting)<=100){
    $from_username=$this->session->userdata('USERNAME');
   $from_userid=$this->session->userdata('ADMIN_ID');
    $comment_array=array('username'=>$from_username,'userid'=>$from_userid,'comment'=>$comment,'status'=>$lead_statuss,'created_date'=>date('Y-m-d H:i:s'),'lead_id'=>$lead_id);
    $con=$this->GenericModel->insert_generic_record('tbl_comment',$comment_array); 
    
    
    if($con=='Error'){
      $array=array('code'=>400,'message'=>'Your submitted data is inconsistent. Please contact to globallianz');  
    }else{   
        $lead_array=array('status'=>$lead_statuss);
       $where='id='.$lead_id;
      $this->GenericModel->update_generic_record('tbl_lead',$lead_array,$where);  
     $data['data']=$this->GenericModel->get_record_with_condition("tbl_comment","*","lead_id='".$lead_id."' order by id desc"); 
     $datas=$this->load->view('admin/site/ajax_loan_comment', $data, TRUE); 
     $array=array('code'=>200,'message'=>'Comment Submitted Successfully','comments'=>$datas); 
    }
   }else{
    $array=array('code'=>400,'message'=>'Your are already 100 comment is reach');    
   }
   echo json_encode($array);
  }
  public function get_notification_users(){
    $from_userid=$this->session->userdata('ADMIN_ID');
     $data['data']=$this->GenericModel->get_record_with_condition("tbl_notification","*","to_userid='".$from_userid."' order by id desc limit 1,3"); 
   echo $this->load->view('admin/site/notification', $data, TRUE); 
    
  }
 public function update_notification_count(){
   $from_userid=$this->session->userdata('ADMIN_ID');
 $where='to_userid='.$from_userid.' and view=0';
 $insert_array=array('view'=>1);
   $con=$this->GenericModel->update_generic_record('tbl_notification',$insert_array,$where);  
   if($con=='Error'){
   $array=array('code'=>400,'message'=>'Your are already 100 comment is reach');      
   }else{
   $array=array('code'=>200,'message'=>'success');      
   }
    echo json_encode($array);
 }
 public function backend_curl_execute(){
   
     $json_array='[
    {
        "RN": "1",
        "QUERY_ID": "203128345",
        "QTYPE": "P",
        "SENDERNAME": null,
        "SENDEREMAIL": null,
        "SUBJECT": "Buyer Call",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 05:51:21 PM",
        "GLUSR_USR_COMPANYNAME": null,
        "READ_STATUS": null,
        "SENDER_GLUSR_USR_ID": null,
        "MOB": "+919618372347",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": null,
        "LOG_TIME": "20200313000000",
        "QUERY_MODREFID": null,
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "81479943",
        "ENQ_MESSAGE": null,
        "ENQ_ADDRESS": null,
        "ENQ_CALL_DURATION": "51 Secs",
        "ENQ_RECEIVER_MOB": "2026995626",
        "ENQ_CITY": null,
        "ENQ_STATE": null,
        "PRODUCT_NAME": null,
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Feb-2019",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "2",
        "QUERY_ID": "203120893",
        "QTYPE": "P",
        "SENDERNAME": null,
        "SENDEREMAIL": null,
        "SUBJECT": "Buyer Call",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 05:23:16 PM",
        "GLUSR_USR_COMPANYNAME": null,
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": null,
        "MOB": "+919618372347",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": null,
        "LOG_TIME": "20200313000000",
        "QUERY_MODREFID": null,
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "81479943",
        "ENQ_MESSAGE": null,
        "ENQ_ADDRESS": null,
        "ENQ_CALL_DURATION": "114 Secs",
        "ENQ_RECEIVER_MOB": "8669462085",
        "ENQ_CITY": null,
        "ENQ_STATE": null,
        "PRODUCT_NAME": null,
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Feb-2019",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "3",
        "QUERY_ID": "1283710190",
        "QTYPE": "W",
        "SENDERNAME": "Vivekamanad",
        "SENDEREMAIL": "drsvivekanand@gmail.com",
        "SUBJECT": "Requirement for LED Clock",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 04:41:38 PM",
        "GLUSR_USR_COMPANYNAME": "Sham Lal Chandra Shekar Nursing College",
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "61831434",
        "MOB": "+91-8789053341",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313164138",
        "QUERY_MODREFID": "40757097459",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "61831434",
        "ENQ_MESSAGE": "Digital tower clock\n\n Quantity:   4   piece\n Approximate Order Value:   1 to 2 Lakh \n Currency:   INR - Indian Rupee \n",
        "ENQ_ADDRESS": "Ns 31, , Khagaria, Bihar, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Khagaria",
        "ENQ_STATE": "Bihar",
        "PRODUCT_NAME": "LED Clock",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Apr-2018",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "4",
        "QUERY_ID": "1283552634",
        "QTYPE": "W",
        "SENDERNAME": "Ajinath Shinde",
        "SENDEREMAIL": "shindeajinath607@gmail.com",
        "SUBJECT": "Requirement for LED Display Panel",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 02:48:01 PM",
        "GLUSR_USR_COMPANYNAME": "shivkrupa mobile shopi&electronics",
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "99482501",
        "MOB": "+91-9011703769",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313144801",
        "QUERY_MODREFID": "40725452975",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "99482501",
        "ENQ_MESSAGE": "I want to buy LED Display Panel.\r\n\r\nKindly send me price and other details.\n\n Quantity:   2   Piece\n Dimension:   32 Inch \n Why do you need this:   For Reselling \n\n\nAdditional Updates on Buyer s Requirement :\nPreferred Location: Suppliers from Local Area will be Preferred\n",
        "ENQ_ADDRESS": ", Ahmednagar, Maharashtra, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Ahmednagar",
        "ENQ_STATE": "Maharashtra",
        "PRODUCT_NAME": "LED Display Panel",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Jan-2020",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "5",
        "QUERY_ID": "1283497182",
        "QTYPE": "W",
        "SENDERNAME": "Asim Kumar",
        "SENDEREMAIL": null,
        "SUBJECT": "Requirement for LED Clock",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 02:13:31 PM",
        "GLUSR_USR_COMPANYNAME": null,
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "102651782",
        "MOB": "+91-7319683865",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313141331",
        "QUERY_MODREFID": "40755702434",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "102651782",
        "ENQ_MESSAGE": "I am interested in LED Clock\n\n",
        "ENQ_ADDRESS": ", Khagaria, Bihar, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Khagaria",
        "ENQ_STATE": "Bihar",
        "PRODUCT_NAME": "LED Clock",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Mar-2020",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "6",
        "QUERY_ID": "1283489813",
        "QTYPE": "W",
        "SENDERNAME": "Mahendra Ramjibhai Chauhan",
        "SENDEREMAIL": "amdchauhan@gmail.com",
        "SUBJECT": "Requirement for Message Fan",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 02:09:07 PM",
        "GLUSR_USR_COMPANYNAME": "The God Gifte Graphics",
        "READ_STATUS": null,
        "SENDER_GLUSR_USR_ID": "2471685",
        "MOB": "+91-9898378220",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313140907",
        "QUERY_MODREFID": "40773009475",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "2471685",
        "ENQ_MESSAGE": "I am interested in LED Message fan\n\n Quantity:   5   Piece\n",
        "ENQ_ADDRESS": "No. 6\/2400, Khodiyarkrupa, Nagarshari,, , Surat, Gujarat, 395003",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Surat",
        "ENQ_STATE": "Gujarat",
        "PRODUCT_NAME": "Message Fan",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Aug-2010",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "7",
        "QUERY_ID": "1283382117",
        "QTYPE": "W",
        "SENDERNAME": "Hemant Bhorde",
        "SENDEREMAIL": "hemantbhorde@gmail.com",
        "SUBJECT": "Requirement for Scrolling Displays",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 01:00:21 PM",
        "GLUSR_USR_COMPANYNAME": null,
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "61957213",
        "MOB": "+91-9657678822",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313130021",
        "QUERY_MODREFID": "40771313067",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "61957213",
        "ENQ_MESSAGE": "I want to buy Scrolling Displays.\n\nKindly send me price and other details.\n\n Quantity:   1   piece\n Viewing Distance:   500 \n Dimensions:   1?3 \n Total Order Value(Rs):   1,000 to 3,000 \n",
        "ENQ_ADDRESS": ", Pune, Maharashtra, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Pune",
        "ENQ_STATE": "Maharashtra",
        "PRODUCT_NAME": "Scrolling Displays",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Apr-2018",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "8",
        "QUERY_ID": "1283307750",
        "QTYPE": "W",
        "SENDERNAME": "Jitender Rathore",
        "SENDEREMAIL": "jeeturathorenoida@gmail.com",
        "SUBJECT": "Requirement for Scrolling Displays",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 12:08:00 PM",
        "GLUSR_USR_COMPANYNAME": "Deep Graphics Advertising & Marketing",
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "24273470",
        "MOB": "+91-9310053583",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313120800",
        "QUERY_MODREFID": "40801812885",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "24273470",
        "ENQ_MESSAGE": "I want to buy Scrolling Displays.\r\n\r\nKindly send me price and other details.\n\n Quantity:   1   piece\n Dimensions:   5*3 Sqft \n Why do you need this:   Business Use \n",
        "ENQ_ADDRESS": "G-246. Sector -63, , Noida, Uttar Pradesh, 201307",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Noida",
        "ENQ_STATE": "Uttar Pradesh",
        "PRODUCT_NAME": "Scrolling Displays",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": "studio@deepgraphicsnoida.com",
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Nov-2015",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "9",
        "QUERY_ID": "1283297027",
        "QTYPE": "W",
        "SENDERNAME": "Bilal Ahmad Langnoo",
        "SENDEREMAIL": "bilallangnoo85@gmail.com",
        "SUBJECT": "Requirement for Rectangle Electronic Scroller",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 12:02:17 PM",
        "GLUSR_USR_COMPANYNAME": null,
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "102670633",
        "MOB": "+91-9797830536",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313120217",
        "QUERY_MODREFID": "40767935875",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "102670633",
        "ENQ_MESSAGE": "I am interested in buying Rectangle Electronic Scroller. \n\nKindly send me price and other details.\n\n Probable Requirement Type:   Business Use \n Viewing Distance:   12 INCH \n Approximate Order Value:   Upto 1,000 \n Currency:   INR - Indian Rupee \n",
        "ENQ_ADDRESS": ", Srinagar, Jammu & Kashmir, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Srinagar",
        "ENQ_STATE": "Jammu & Kashmir",
        "PRODUCT_NAME": "Rectangle Electronic Scroller",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Mar-2020",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "10",
        "QUERY_ID": "1283202530",
        "QTYPE": "W",
        "SENDERNAME": "Ganpo",
        "SENDEREMAIL": "ganpati.0203@gmail.com",
        "SUBJECT": "Requirement for Black P 10 LED Module",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 10:39:48 AM",
        "GLUSR_USR_COMPANYNAME": "Srushti Adds PVT LTD",
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "17822268",
        "MOB": "+91-7387999601",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313103948",
        "QUERY_MODREFID": "40798590534",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "17822268",
        "ENQ_MESSAGE": "I want to buy Black P 10 LED Module.\n\n Quantity:   300   piece\n Approximate Order Value:   2 to 5 Lakh \n Currency:   INR - Indian Rupee \n Why do you need this:   For Business Use \n",
        "ENQ_ADDRESS": ", Pune, Maharashtra, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Pune",
        "ENQ_STATE": "Maharashtra",
        "PRODUCT_NAME": "Black P 10 LED Module",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Jun-2015",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "11",
        "QUERY_ID": "1283191902",
        "QTYPE": "W",
        "SENDERNAME": "Arvind",
        "SENDEREMAIL": null,
        "SUBJECT": "Requirement for SMD LED Modules",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 10:32:44 AM",
        "GLUSR_USR_COMPANYNAME": null,
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "87408504",
        "MOB": "+91-7621810296",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313103244",
        "QUERY_MODREFID": "40764215552",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "87408504",
        "ENQ_MESSAGE": "I want to buy SMD LED Modules for signage and board.\r\n\r\nBefore purchasing I would like to know the price details.\r\n\r\nKindly send me price and quote first.\n\n Type:   Outdoor Type \n Shape:   Rectangle \n Color:   White And Red \n Application:   For Home And Business \n",
        "ENQ_ADDRESS": ", Surat, Gujarat, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Surat",
        "ENQ_STATE": "Gujarat",
        "PRODUCT_NAME": "SMD LED Modules",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "May-2019",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "12",
        "QUERY_ID": "1283147944",
        "QTYPE": "W",
        "SENDERNAME": "Akshay Anantwal",
        "SENDEREMAIL": null,
        "SUBJECT": "Requirement for Running LED Display Board",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 09:42:13 AM",
        "GLUSR_USR_COMPANYNAME": "Sai Radium Led Board",
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "92150674",
        "MOB": "+91-7620408017",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313094213",
        "QUERY_MODREFID": "40792505359",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "92150674",
        "ENQ_MESSAGE": "I want to buy Running LED Display Board.\r\n\r\nKindly send me price and other details.\n\n Quantity:   1   piece\n Text Color:   Red \n Language Supported:   Hindi \n Why do you need this:   For Business Use \n Size Required:   1x10.5 Feet \n",
        "ENQ_ADDRESS": ", Udgir, Maharashtra, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Udgir",
        "ENQ_STATE": "Maharashtra",
        "PRODUCT_NAME": "Running LED Display Board",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Aug-2019",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "13",
        "QUERY_ID": "1283143663",
        "QTYPE": "W",
        "SENDERNAME": "Sanket Santosh Shitole",
        "SENDEREMAIL": "sanket.shitole77@gmail.com",
        "SUBJECT": "Requirement for P4 LED Video Wall",
        "DATE_RE": "13 Mar 2020",
        "DATE_R": "13-Mar-20",
        "DATE_TIME_RE": " 13-Mar-2020 09:39:06 AM",
        "GLUSR_USR_COMPANYNAME": "Matrix LED",
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "79833230",
        "MOB": "+91-8380893299",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200313093906",
        "QUERY_MODREFID": "40788811334",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "79833230",
        "ENQ_MESSAGE": "I want to buy P4 LED Video Wall.\n\n Quantity:   1   piece\n Viewing Distance:   200 Meter \n Dimensions:   8 X 12 Feet \n",
        "ENQ_ADDRESS": "Ravet, , Pune, Maharashtra, 412101",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Pune",
        "ENQ_STATE": "Maharashtra",
        "PRODUCT_NAME": "P4 LED Video Wall",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Jan-2019",
        "TOTAL_COUNT": "14"
    },
    {
        "RN": "14",
        "QUERY_ID": "1283021679",
        "QTYPE": "W",
        "SENDERNAME": "Mr. Abhishek",
        "SENDEREMAIL": "joshia440@gmail.com",
        "SUBJECT": "Requirement for Message Fan",
        "DATE_RE": "12 Mar 2020",
        "DATE_R": "12-Mar-20",
        "DATE_TIME_RE": " 12-Mar-2020 11:17:54 PM",
        "GLUSR_USR_COMPANYNAME": "Shri Ameging",
        "READ_STATUS": "-1",
        "SENDER_GLUSR_USR_ID": "9117147",
        "MOB": "+91-8058535673",
        "COUNTRY_FLAG": "https:\/\/1.imimg.com\/country-flags\/small\/in_flag_s.png",
        "QUERY_MODID": "ASTBUY",
        "LOG_TIME": "20200312231754",
        "QUERY_MODREFID": "40791596613",
        "DIR_QUERY_MODREF_TYPE": "0",
        "ORG_SENDER_GLUSR_ID": "9117147",
        "ENQ_MESSAGE": "I want to purchase Message Fan. \n\nKindly send me price and other details.\n\n Other Products Viewed by Buyer:   USB Powered Mini LED Fan DIY Programmable Message With Fan, Type of Lighting Application: Indoor lighting \n",
        "ENQ_ADDRESS": ", Jaipur, Rajasthan, ",
        "ENQ_CALL_DURATION": null,
        "ENQ_RECEIVER_MOB": null,
        "ENQ_CITY": "Jaipur",
        "ENQ_STATE": "Rajasthan",
        "PRODUCT_NAME": "Message Fan",
        "COUNTRY_ISO": "IN",
        "EMAIL_ALT": null,
        "MOBILE_ALT": null,
        "PHONE": null,
        "PHONE_ALT": null,
        "IM_MEMBER_SINCE": "Jan-2014",
        "TOTAL_COUNT": "14"
    }
]';
    echo '<pre>';
     $count=json_decode($json_array);   
    // print_r($count);
     //exit;
     if(count($count)>=1){
       foreach($count as $key=>$value){
        $rn= $value->RN.'<br>';
       echo  $QUERY_ID= $value->QUERY_ID.'<br>';
       echo  $SUBJECT=$value->SUBJECT.'<br>';
       echo  $DATE_TIME_RE=$value->DATE_TIME_RE.'<br>';
      echo   $GLUSR_USR_COMPANYNAME=$value->GLUSR_USR_COMPANYNAME.'<br>';
      echo   $PRODUCT_NAME=$value->PRODUCT_NAME.'<br>';
      echo   $ENQ_CITY=$value->ENQ_CITY.'<br>';
      echo   $ENQ_STATE=$value->ENQ_STATE.'<br>';
      echo   $ENQ_ADDRESS=$value->ENQ_ADDRESS.'<br>';
      echo   $ENQ_MESSAGE=$value->ENQ_MESSAGE.'<br>';
       }     
     }
     // print_r($count);
     exit;
    $start_time=date("d-M-Y H:i:m", strtotime('-1 day'));
    $end_time=date('d-M-Y H:i:m');
    $start_time= $start_time;
    $end_time= $end_time;
    
     $ch = curl_init();
  //  $urls= "https://mapi.indiamart.com/wservce/enquiry/listing/GLUSR_MOBILE/7507012305/GLUSR_MOBILE_KEY/MTU4NDAyNTY0OC4yNTM5IzIzMTE4MjY=/Start_Time/$start_time/End_Time/$end_time/";
    $urls='http://mapi.indiamart.com/wservce/enquiry/listing/GLUSR_MOBILE/7507012305/GLUSR_MOBILE_KEY/MTU4NDAyNTY0OC4yNTM5IzIzMTE4MjY=/Start_Time/'.urlencode($start_time).'/End_Time/'.urlencode($end_time).'/';
   
    $headers = array('Accept: application/json','Content-Type: application/json'); 
     $url= $urls;
     curl_setopt($ch, CURLOPT_URL,$url);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_HEADER, 0);
     curl_setopt($ch, CURLOPT_TIMEOUT,30);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
     $return = curl_exec($ch);
    $array=json_decode($return);
    if(!empty($array[0]->Error_Message)){
        echo $array[0]->Error_Message;
    }else{
      echo '<pre>';  
      print_r($return);  
      echo '</pre>';
    }
     curl_close($ch); 
    
 } 
}
?>