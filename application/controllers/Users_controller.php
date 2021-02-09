<?php
error_reporting(0);
require APPPATH."/third_party/src/Payment.php";
require APPPATH."/third_party/src/Validator.php";
require APPPATH."/third_party/src/Crypto.php";
class Users_controller  extends MY_Controller{
    public function __construct() {
    parent::__construct();
   }
   public function index(){
   $data['template']='index';
   $data['title']='Welcome To Home';
   $data['page']='Welcome To Home';
   $data['city']=$this->GenericModel->get_record_with_condition('tbl_location',"locations","id<>'' ORDER BY  RAND() Limit 0,8");
   $data['citydetail']=$this->GenericModel->get_record('tbl_location',"locations");
   $data['Jobcategory']=$this->GenericModel->get_record_with_condition("tbl_service_type","types","id<>'' ORDER BY  RAND() Limit 0,8");
   $data['tbl_experience_master']=$this->GenericModel->get_record('tbl_experience_master',"no_year"); 
   
   $data['vendor_package']=$this->GenericModel->get_record_with_condition('tbl_payment_type',"amount","user_type='NO' AND users_type='Vendor'");
   $data['hotel_package']=$this->GenericModel->get_record_with_condition('tbl_payment_type',"amount","user_type='NO' AND users_type='Hotel'");
   $data['total_staff']=$this->GenericModel->get_record_with_condition('tbl_registration',"count(id) as total","user_type='Staff'");
   $data['total_hotel']=$this->GenericModel->get_record_with_condition('tbl_registration',"count(id) as total","user_type='Hotel'");
   $data['total_vendor']=$this->GenericModel->get_record_with_condition('tbl_registration',"count(id) as total","user_type='Vendor'");
   $data['total_job']=$this->GenericModel->get_record('tbl_job_staff',"count(id) as total");
   $this->layout_users($data);
   }
 public function hotel_registration(){
   $data['template']='hotelsignup';
   $data['title']='Hotel Signup';
   $data['page']='Hotel Signup';
   $this->layout_users($data);
   }
 
   public function staff_registration(){
   $data['template']='staffsignup';
   $data['experience']=$this->db->query("select *from tbl_experience_master")->result();
   $data['services_type']=$this->db->query("select *from tbl_service_type")->result();
   $data['title']='Staff Signup';
   $data['page']='Staff Signup';
   $this->layout_users($data);
   }
  public function Login(){
   $data['template']='login';
   $data['title']='Login';
   $data['page']='Login';
   $this->layout_users($data);
   }  
   public function About_Us(){
   $data['template']='aboutus';
   $data['title']='About Us';
   $data['page']='About Us';
   $this->layout_users($data);
   }
    public function payment_details(){
   $data['template']='success';
   $data['title']='Payment Details';
   $data['page']='Payment Details';
   $this->layout_users($data);
   }
 
    public function privacy_policy(){
   $data['template']='privacy_policy';
   $data['title']='Privacy Policy';
   $data['page']='Privacy Policy';
   $this->layout_users($data);
   }
   public function terms_and_condition(){
   $data['template']='terms_and_condition';
   $data['title']='Terms And Condition';
   $data['page']='Terms And Condition';
   $this->layout_users($data);
   }
   public function refund_policy(){
    $data['template']='refund_policy';
   $data['title']='Refund Policy';
   $data['page']='Refund Policy';
   $this->layout_users($data);  
   }
    public function reset_password(){
    $data['template']='reset_password';
   $data['title']='Reset Password';
   $data['page']='Reset Password';
   $this->layout_users($data);  
   }
     public function singup_users(){
    $data['template']='Signup';
   $data['title']='Signup Users';
   $data['page']='Signup Users';
   $data['experience']=$this->db->query("select *from tbl_experience_master")->result();
   $data['services_type']=$this->db->query("select *from tbl_service_type")->result();
    $data['vendors']=$this->db->query("select *from tbl_vendor_master")->result();
    $data['citydetail']=$this->GenericModel->get_record('tbl_location',"locations");
   $this->layout_users($data);  
   }
    public function vendorsignup(){
    $data['template']='vendorsignup';
   $data['title']='Vendor';
   $data['vendors']=$this->db->query("select *from tbl_vendor_master")->result();
   $data['page']='Refund Policy';
   $this->layout_users($data);  
   }
   public function searach_staff_profile(){
      if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){      
   $data['template']='search_staff_profile';    
   $data['title']='Search Staff Profile';
   $data['page']='Search Staff Profile';
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
   public function Contact_Us(){
   $data['template']='contactus';
   $data['title']='Contact Us';
   $data['page']='Contact Us';
   $this->layout_users($data);
   }
   public function Services(){
   $data['template']='services';
   $data['title']='Services';
   $data['page']='Services';
   $this->layout_users($data);
   }
     public function job_details(){
   $data['template']='job_details';
   $data['title']='Job Details';
   $data['page']='Job Details';
   $this->layout_users($data);
   }
  public function ad_requirement_list(){
      if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){   
         
       $userid=$this->session->userdata('Hotel_ID');
        $users=$this->GenericModel->get_record_with_condition('tbl_hotel','membership',"userid='".$userid."' AND membership='Paid'");   
       if(count($users)>=1){   
   $data['template']='post_requirement_list';
   $data['title']='Hotel Requirement Ad';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Hotel Requirement Ad';
   $this->layout_users($data);
    }else{
      redirect('hotel_annual_pacakages');        
       }
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   } 
  }
  public function add_requirement_edit(){
      if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){    
       $userid=$this->session->userdata('Hotel_ID');
        $users=$this->GenericModel->get_record_with_condition('tbl_hotel','membership',"userid='".$userid."' AND membership='Paid'");   
       if(count($users)>=1){  
   $data['template']='need_edit_requirement';
   $data['title']='Hotel Requirement Ad';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['requirement']=$this->GenericModel->get_record_with_condition("tbl_vendor_requirement","*","id='".base64_decode($_GET['edit'])."'"); 
   $data['page']='Hotel Requirement Ad';
   $this->layout_users($data);
   }else{
      redirect('hotel_annual_pacakages');        
       } 
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   } 
  }
  
    public function vendor(){
   if($this->session->userdata('Hotel_Types')=='Hotel'){      
   $data['template']='vendor_list_view_by_hotel'; //$Jobcategory
   $data['city']=$this->GenericModel->get_record_with_condition('tbl_location',"locations","id<>'' ORDER BY  RAND() Limit 0,8");
   $data['Jobcategory']=$this->GenericModel->get_record_with_condition('tbl_vendor_master',"types","id<>'' ORDER BY  RAND() Limit 0,8");
   $data['title']='Vendor List';
   $data['page']='Vendor List';
   $this->layout_users($data);
   }else{
   redirect(site_url());      
    }
   }
   public function view_vendor_profile_by_hotel(){
   if($this->session->userdata('Hotel_Types')=='Hotel'){      
   $data['template']='view_vendor_profile_by_hotel'; //$Jobcategory
   $data['title']='Vendor Profile List';
   $data['page']='Vendor Profile List';
   $this->layout_users($data);
   }else{
   redirect(site_url());      
    }
   }
  
   public function need_vendor_requirement(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){    
       $userid=$this->session->userdata('Hotel_ID');
      $users=$this->GenericModel->get_record_with_condition('tbl_hotel','membership',"userid='".$userid."' AND membership='Paid'");   
       if(count($users)>=1){    
   $data['template']='need_vendor_requirement';
   $data['title']='Hotel Requirement Ad';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Hotel Requirement Ad';
   $this->layout_users($data);
    }else{
      redirect('hotel_annual_pacakages');        
       }
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }   
   
   public function view_job_for_staff(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Staff'){    
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='staff_jobs_view';
   $data['title']='View Job Post';
   $data['page']='View Job Post';
   $this->layout_users($data);
   
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   } 
   
  
   public function view_staff_profiles(){
    if($this->session->userdata('Hotel_ID')){ 
    if($this->session->userdata('Hotel_Types')=='Hotel'){    
    $userid=$this->session->userdata('Hotel_ID');
    $data['template']='view_staff_profile';
    $data['title']='View Staff Profile';
    $data['page']='View Staff Profile';
    $data['packages']=$this->GenericModel->get_record_with_condition("tbl_payment_type","amount","users_type='Staff'");
    $this->layout_users($data);
    }else{
     redirect(site_url());   
    }
    }else{
      redirect(site_url());   
    }  
   }
   public function staff_package_apply(){
    if($this->session->userdata('Hotel_ID')){ 
    if($this->session->userdata('Hotel_Types')=='Staff'){    
    $userid=$this->session->userdata('Hotel_ID');
    $data['template']='staff_annual_package';
    $data['title']='Staff Permium Package';
    $data['page']='Staff Permium Package';
    $data['packages']=$this->GenericModel->get_record_with_condition("tbl_payment_type","amount","users_type='Staff'");
    $this->layout_users($data);
    }else{
     redirect(site_url());   
    }
    }else{
      redirect(site_url());   
    }  
   }
   
   public function staff_jobs_view_search(){
    if($this->session->userdata('Hotel_ID')){ 
    if($this->session->userdata('Hotel_Types')=='Staff'){    
    $userid=$this->session->userdata('Hotel_ID');
    $data['template']='staff_jobs_view_search';
    $data['title']='Staff Job Search';
    $data['page']='Staff Job Search';
    $data['packages']=$this->GenericModel->get_record_with_condition("tbl_payment_type","amount","users_type='Staff'");
    $this->layout_users($data);
    }else{
     redirect(site_url());   
    }
    }else{
      redirect(site_url());   
    }  
   }
   
    public function staff_job_apply_history(){
    if($this->session->userdata('Hotel_ID')){ 
    if($this->session->userdata('Hotel_Types')=='Staff'){    
    $userid=$this->session->userdata('Hotel_ID');
    $data['template']='staff_job_applied';
    $data['title']='Job Applied History';
    $data['page']='Job Applied History';
    $table='tbl_staff'; $field='*';  $condition="userid='".$userid."'"; 
    $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
    $this->layout_users($data);
    }else{
     redirect(site_url());   
    }
    }else{
      redirect(site_url());   
    }  
   }

   public function job_post(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){    
      $userid=$this->session->userdata('Hotel_ID'); 
      $users=$this->GenericModel->get_record_with_condition('tbl_hotel','membership',"userid='".$userid."' AND membership='Paid'");   
       if(count($users)>=1){     
   $data['template']='job_post';
   $data['title']='Job Post';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['experience']=$this->GenericModel->get_record('tbl_experience_master',"*");
   $data['services_type']=$this->GenericModel->get_record('tbl_service_type',"*");
   $data['salary_range']=$this->GenericModel->get_record('tbl_salary_master',"*");
   $data['page']='Job Post';
   $this->layout_users($data);
    }else{
      redirect('hotel_annual_pacakages');        
       }
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
    public function hotel_job_edit(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){    
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='edit_hotel_job';
   $data['title']='Job Post';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['jobs']=$this->GenericModel->get_record_with_condition('tbl_job_staff',"*","id='".base64_decode($_GET['edit'])."'");
   //echo $this->db->last_query();
   //exit;
   $data['experience']=$this->GenericModel->get_record('tbl_experience_master',"*");
   $data['services_type']=$this->GenericModel->get_record('tbl_service_type',"*");
   $data['salary_range']=$this->GenericModel->get_record('tbl_salary_master',"*");
   $data['page']='Job Post';
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
    public function job_listing(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){    
       $userid=$this->session->userdata('Hotel_ID'); 
      $users=$this->GenericModel->get_record_with_condition('tbl_hotel','membership',"userid='".$userid."' AND membership='Paid'");   
       if(count($users)>=1){   
   $data['template']='posted_job_list';
   $data['title']='Job List';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Job List';
   $this->layout_users($data);
    }else{
      redirect('hotel_annual_pacakages');        
       }
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
       public function ad_interested_vendor_list(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){    
       $userid=$this->session->userdata('Hotel_ID'); 
      $users=$this->GenericModel->get_record_with_condition('tbl_hotel','membership',"userid='".$userid."' AND membership='Paid'");   
       if(count($users)>=1){   
   $data['template']='ad_interested_vendor_list';
   $data['title']='Ad Interest Vendor List';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Ad Interest Vendor List';
   $this->layout_users($data);
    }else{
      redirect('hotel_annual_pacakages');        
       }
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   } 
   public function hotel_profile(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){    
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='hotel_profile';
   $data['title']='Hotel Profile';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Hotel Profile';
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
   
    public function hotels_profile(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){    
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='profile_hotels';
   $data['title']='Profile Hotels';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Profile Hotels';
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
   
     public function vendor_profiles(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='vendor_own_profile';
   $data['title']='Vendor Profile Details';
   $table='tbl_vendor'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Vendor Profile Details';
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
   
  public function view_hotel_profile_for_vendor(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='view_hotel_profile_for_vendor';
   $data['title']='Vendor Profile Details';
   $data['page']='Vendor Profile Details';
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
   
   public function hotel_requirement_lists(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='vendor_requirement';
   $data['title']='Hotel Requirement List';
   $data['page']='Hotel Requirement List';
   $data['city']=$this->GenericModel->get_record_with_condition('tbl_location',"locations","id<>'' ORDER BY  RAND() Limit 0,8");
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
   
      public function staffs_profile_details(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Staff'){    
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='staff_own_profile';
   $data['title']='Staff Profiles';
   $table='tbl_staff'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Staff Profiles';
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
   
   
   public function view_staff_profile(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){   
       $userid=$this->session->userdata('Hotel_ID');   
      $users=$this->GenericModel->get_record_with_condition('tbl_hotel','membership',"userid='".$userid."' AND membership='Paid'");   
       if(count($users)>=1){   
   $data['template']='view_staff_profile';
   $data['title']='View Staff Profile';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Hotel Profile';
   $this->layout_users($data);
       }else{
      redirect('hotel_annual_pacakages');        
       }
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
  public function vendor_profile(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');   
   $data['template']='vendor_profile';
    $table='tbl_vendor'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['experience']=$this->db->query("select *from tbl_vendor_master")->result();
   $data['title']='Vendor Profile';
   $data['page']='Vendor Profile';
   $this->layout_users($data);
     }else{
     redirect(site_url());     
     }
    }else{
    redirect(site_url());    
    }
   } 
  public function view_vendor_hotel_list(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');   
   $data['template']='view_vendor_hotel';
   $table='tbl_vendor'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['experience']=$this->db->query("select *from tbl_vendor_master")->result();
   $data['title']='Hotel Listing';
   $data['page']='Hotel Listing';
   $this->layout_users($data);
     }else{
     redirect(site_url());     
     }
    }else{
    redirect(site_url());    
    }
   }
   public function view_vendor_hotel_search(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');   
   $data['template']='view_vendor_hotel_search';
   $table='tbl_vendor'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['experience']=$this->db->query("select *from tbl_vendor_master")->result();
   $data['title']='Hotel Search Listing';
   $data['page']='Hotel Search Listing';
   $this->layout_users($data);
     }else{
     redirect(site_url());     
     }
    }else{
    redirect(site_url());    
    }
   }
   
   public function vendor_interested_hotel_list(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');   
   $data['template']='vendor_interested_hotel_list';
   $table='tbl_vendor'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['experience']=$this->db->query("select *from tbl_vendor_master")->result();
   $data['title']='Vendor Hotel Interest Listing';
   $data['page']='Vendor Hotel Interest Listing';
   $this->layout_users($data);
     }else{
     redirect(site_url());     
     }
    }else{
    redirect(site_url());    
    }
   }
    public function vendor_interested_hotels_list(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');   
   $data['template']='vendor_interested_hotels_list';
   $table='tbl_vendor'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['experience']=$this->db->query("select *from tbl_vendor_master")->result();
   $data['title']='Vendor Hotel Interest Listing';
   $data['page']='Vendor Hotel Interest Listing';
   $this->layout_users($data);
     }else{
     redirect(site_url());     
     }
    }else{
    redirect(site_url());    
    }
   }
    public function change_password_vendors(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){    
       $userid=$this->session->userdata('Hotel_ID');   
   $data['template']='change_password_vendors';
   $table='tbl_vendor'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['experience']=$this->db->query("select *from tbl_vendor_master")->result();
   $data['title']='Change Vendor Password';
   $data['page']='Change Vendor Password';
   $this->layout_users($data);
     }else{
     redirect(site_url());     
     }
    }else{
    redirect(site_url());    
    }
   }
   public function change_hotel_password(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){  
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='change_password_hotel';
   $data['title']='Change Hotel Password';
   $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Hotel Profile';
   $this->layout_users($data);
     }else{
      redirect(site_url());   
     }
    }else{
       redirect(site_url());   
    }
   }
   
   
    public function vendor_annual_package(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Vendor'){  
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='vendor_annual_package';
   $data['title']='Vendor Annual package';
    $data['packages']=$this->GenericModel->get_record_with_condition("tbl_payment_type","amount","users_type='Vendor' AND user_type='NO'");
   $data['page']='Vendor Annual Package';
   $this->layout_users($data);
     }else{
      redirect(site_url());   
     }
    }else{
       redirect(site_url());   
    }
   }
    public function hotel_annual_pacakages(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){  
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='hotel_annual_package';
   $data['title']='Hotel Annual package';
    $data['packages']=$this->GenericModel->get_record_with_condition("tbl_payment_type","amount","users_type='Hotel' AND user_type='NO'");
   $data['page']='Hotel Annual Package';
   $this->layout_users($data);
     }else{
      redirect(site_url());   
     }
    }else{
       redirect(site_url());   
    }
   }
       public function search_staff_and_vendors(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){  
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='search_employe_and_vendor_hotel';
   $data['title']='Search Staff Vendor';
   $data['page']='Search Staff Vendor';
   $this->layout_users($data);
     }else{
      redirect(site_url());   
     }
    }else{
       redirect(site_url());   
    }
   }
   public function hotel_job_applied_staff(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Hotel'){  
        $userid=$this->session->userdata('Hotel_ID');
        $users=$this->GenericModel->get_record_with_condition('tbl_hotel','membership',"userid='".$userid."' AND membership='Paid'");   
       if(count($users)>=1){
        $data['template']='hotel_job_applied_staff';
        $data['title']='Staff Applied Job List';
        $table='tbl_hotel'; $field='*';  $condition="userid='".$userid."'"; 
        $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
        $data['page']='Hotel Profile';
        $this->layout_users($data);
       }else{
          redirect('hotel_annual_pacakages');    
       }
     }else{
      redirect(site_url());   
     }
    }else{
       redirect(site_url());   
    }
   }
   
   
   public function staff_profile(){
   if($this->session->userdata('Hotel_ID')){ 
   if($this->session->userdata('Hotel_Types')=='Staff'){    
   $userid=$this->session->userdata('Hotel_ID');
   $data['template']='staff_profile';
   $data['title']='Staff Profile';
   $table='tbl_staff'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['experience']=$this->db->query("select *from tbl_experience_master")->result();
   $data['services_type']=$this->db->query("select *from tbl_service_type")->result();
   $data['page']='Staff Profile';
   $this->layout_users($data);
   }else{
      redirect(site_url());   
     }
   }else{
       redirect(site_url());   
   }
   }
 
   public function change_staff_password(){
   if($this->session->userdata('Hotel_ID')){ 
     if($this->session->userdata('Hotel_Types')=='Staff'){  
       $userid=$this->session->userdata('Hotel_ID');
   $data['template']='change_password_staff';
   $data['title']='Change Staff Password';
   $table='tbl_staff'; $field='*';  $condition="userid='".$userid."'"; 
   $data['hotels']=$this->GenericModel->get_record_with_condition($table,$field,$condition);
   $data['page']='Staff Profile';
   $this->layout_users($data);
     }else{
      redirect(site_url());   
     }
    }else{
       redirect(site_url());   
    }
   }
   
   public function users_logout(){
  session_destroy();
  redirect(site_url());
 }

}
?>