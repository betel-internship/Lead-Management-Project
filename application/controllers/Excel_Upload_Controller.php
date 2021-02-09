 <?php 
if(!defined('BASEPATH')) EXIT('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
require_once APPPATH."/third_party/PHPExcel/IOFactory.php";
class Excel_Upload_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
		//$this->load->library('session/session');

    }
public function upload_excel_sheet_staff(){
 $objPHPExcel = new PHPExcel();
$file_info = pathinfo($_FILES["uploadsheet"]["name"]);
 $pid=$this->input->post('pid');
$file_directory = "assets/seets/";
$new_file_name = date("d-m-Y ") . rand(000000, 999999) .".". $file_info["extension"];
if(move_uploaded_file($_FILES["uploadsheet"]["tmp_name"], $file_directory . $new_file_name))
{   // PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
    $file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
    $objReader	= PHPExcel_IOFactory::createReader($file_type);
    $objPHPExcel = $objReader->load($file_directory . $new_file_name);
    $sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $highestRow=count($sheet_data);
    $success=0;
    $fail=0;
       if($highestRow<=101){
	 for ($row = 2; $row <= $highestRow; $row++) {
	  $full_name =trim($objPHPExcel->getActiveSheet()->getCell('A' . $row)->getValue());
	  $mobile_no =trim($objPHPExcel->getActiveSheet()->getCell('B' . $row)->getValue());
	  $service_type =trim($objPHPExcel->getActiveSheet()->getCell('C' . $row)->getValue());
	  $years_of_experiance =$objPHPExcel->getActiveSheet()->getCell('D' . $row)->getValue();
	  $location_of_work =trim($objPHPExcel->getActiveSheet()->getCell('E' . $row)->getValue());
	  $email_id =trim($objPHPExcel->getActiveSheet()->getCell('F' . $row)->getValue());
	  $description_of_specilation =trim($objPHPExcel->getActiveSheet()->getCell('G' . $row)->getValue());
	  $gender =trim($objPHPExcel->getActiveSheet()->getCell('H' . $row)->getValue());
          $identification=trim($objPHPExcel->getActiveSheet()->getCell('I' . $row)->getValue());
          $dob=trim($objPHPExcel->getActiveSheet()->getCell('J' . $row)->getValue());
          $password=trim($objPHPExcel->getActiveSheet()->getCell('K' . $row)->getValue());
$table='tbl_registration';
  $field='id';
  $condition_mobile="mobile_no='$mobile_no'";
  $condition_username="email_address='$email_id'";

        $duplicate_mobile=$this->GenericModel->get_record_with_condition($table,$field,$condition_mobile);
       $duplicate_username=$this->GenericModel->get_record_with_condition($table,$field,$condition_username);
      if(count($duplicate_mobile)>=1){ 
      $fail=$fail+1;
      }elseif(count($duplicate_username)>=1){ 
      $fail=$fail+1;    
      }else{
  if(!empty($full_name) && !empty($mobile_no) && !empty($password) && !empty($email_id)){     
     $insert_array=array('full_name'=>$full_name,'mobile_no'=>$mobile_no,'email_address'=>$email_id,'password'=>md5($password),'created_date'=>date('Y-m-d H:i:s'),'user_type'=>'Staff','status'=>'active','own_referral_code'=>time().mt_rand(00000,99999));
     $con=$this->GenericModel->insert_generic_record($table,$insert_array); 
     $insert_array_staff=array('full_name'=>$full_name,'mobile_no'=>$mobile_no,'userid'=>$con,'password'=>md5($password),'email_id'=>$email_id,'gender'=>$gender,'service_type'=>$service_type,'years_of_experiance'=>$years_of_experiance,'location_of_work'=>$location_of_work,'description_of_specilation'=>$description_of_specilation,'identification'=>$identification,'dob'=>$dob,'created_date'=>date('Y-m-d H:i:s'),'status'=>'active','membership'=>'Unpaid');
     $this->GenericModel->insert_generic_record('tbl_staff',$insert_array_staff);
     $success=$success+1;
     }else{
     $fail=$fail+1;        
    }
    }
   }
 }else{
 $this->session->set_userdata('error','Only 100 Record Uploaded excel sheet at time');
 redirect('import_excel_sheet_staff');   
 }
}else{
 $this->session->set_userdata('error','File not uploaded properly'); 
redirect('import_excel_sheet_staff'); 
}
$total=$fail+$success;
unlink($file_directory.$new_file_name);
 $this->session->set_userdata('success','Excel Sheet Imported Successfully.. and out off '.$total.'record '.$success.' is imported succesfully and '.$fail.' is fail'); 
 redirect('import_excel_sheet_staff');
  }
}
?>