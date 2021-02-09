<?php

class Email_Controller  extends MY_Controller{
    public function __construct() {
    parent::__construct();
   error_reporting(0);
   }
   public function forgot_password(){
   $email_address=$this->input->post('email_address');
     $table='tbl_registration';
  $field='id,email_address,full_name';
  $condition_username="email_address='$email_address'";

  $duplicate=$this->GenericModel->get_record_with_condition($table,$field,$condition_username);  
if(count($duplicate)==0){
  $array=array('code'=>400,'message'=>'your entered email id does not exist');  
}else{
    $id=$duplicate[0]->id;
$msg ='<html>
<body style="background-color:#dadada;">
<div style="background-color:#dadada;padding-top: 36px;">
<table style="background-color:#dadada;border-collapse:collapse;border-spacing:0;border-collapse:collapse;border-spacing:0;width:100%; padding-top:30px; margin-top:40px;" width="100%">
<tbody>
  <tr>
    <td align="center"><table style="border-collapse:collapse;border-spacing:0">
        <tbody>
          <tr>
            <td bgcolor="#eeeeee"><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                <tbody>
                  <tr>
                    <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="12">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                        <tbody>
                          <tr>
                            <td width="35">&nbsp;</td>
                            <td><table width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td width="45%"><a href="http://www.setwellhotels.com/" target="_blank">
									<img src="https://www.setwellhotels.com/assets/images/setwelllogo.png" style="height:68px;" alt="logo" class="CToWUd logo-imge"></a></td>
                                    <!--<td style="text-align:right" width="45%"><a href="https://play.google.com/store/apps/details?id=com.timesgroup.techgig&amp;hl=en" target="_blank"><img src="https://ci6.googleusercontent.com/proxy/Sn12C0264rP3Co4oS3sfdvweHgzgRMoeRv4ErU0LvO2RbRK9rDMqE2QP9-NtFkJIwi-9URkuogfn8g0MP96EzxlkHL9MQADxS4Fdx_4=s0-d-e1-ft#http://techgig.com/files/nicUploads/966963038285779.png" alt="android-app" style="text-align:right" class="CToWUd"></a></td>-->
                                  </tr>
                                </tbody>
                              </table></td>
                            <td width="35">&nbsp;</td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                  <tr>
                    <td style="line-height:0;font-size:0;border-bottom:3px solid #f5811e;vertical-align:top;padding:0px;text-align:left" height="18">&nbsp;</td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
          <tr class="m_4947185984318696965m_-460692406907758300content">
            <td style="padding:0px" bgcolor="#ffffff"><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                <tbody>
                  <tr>
                    <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="20">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="padding:0px"><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                        <tbody>
                          <tr>
                            <td width="551"><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:19px;text-align:justify;padding:0px 20px 0px 20px" valign="top"><b>Dear '.$duplicate[0]->full_name.',</b><br>
                                    </td>
                                  </tr>
                            
                                  <tr>
                                    <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="20">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="padding-left: 20px;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#000;padding:10px 20px 0px 20px;line-height:19px;text-align:left;font-weight: bold;">
									Please click on the following  Button to reset your password:<br><br>
									<p style="text-align: center;">
<a href="'.site_url().'reset_password?email='.base64_encode($id).'" style="background-color:#2a9b0e;color:white;padding: 10px;text-decoration: none;border-radius: 5px;">
									Reset Password
									</a>
									<br><br><br>
									<!--<p style="margin-top:30px;">Please note, this link will expire after 24 hours.<br>-->
									If you did not request to reset your password, please ignore this email. Your account is secure.
									</p>
</p> 
									 </td>
                                  </tr>
                                  <tr>
                                    <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="20">&nbsp;</td>
                                  </tr>
                               
                                 
                                  </tr>
                                  <tr>
                                    <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="20">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="font-family:Arial,Helvetica,sans-serif;color:#000;font-size:14px;line-height:19px;padding:10px 20px 0px 20px;padding-bottom: 20px;"><br>
                                      <br>
                                      <br>
                                        Thanking you<br>
                                        With kind regards<br>
                                        Team SetWellHotels<br>
                                        www.setwellhotels.com<br>
                                      <br>
                                      <br>
                                    </td>
                                  </tr>
                                </tbody>
                              </table></td>
                            <td width="35">&nbsp;</td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                  <tr>
                    <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="18">&nbsp;</td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
          <tr class="m_4947185984318696965m_-460692406907758300footer">
            <td bgcolor="#eeeeee"><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                <tbody>
                  <tr>
                    <td width="35">&nbsp;</td>
                    <td width="557"><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                        <tbody>
                          <tr>
                            <td><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:center" height="25">&nbsp;</td>
                                  </tr>
                                  <!--<tr>
                                    <td style="margin:0;color:#999999;font-size:11px;line-height:20px;font-family:Arial,Helvetica,sans-serif;font-style:normal;font-weight:normal;text-align:center">2020 Setwellhotels   |  Terms of Use   |  Contact Us <br>
                                      setwellhotels.com  Sinhgad, Pune, Maharashtra, 411041 </td>
                                  </tr>-->
                                  <tr>
                                    <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="20">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:center"><table style="border-collapse:collapse;border-spacing:0" width="100%" border="0">
                                        <tbody>
                                          <tr>
                                            <td style="margin:0;color:#999999;font-size:14px;line-height:20px;font-family:Arial,Helvetica,sans-serif;font-style:normal;font-weight:normal;text-align:center">Visit Us about Setwellhotels</td>
                                          </tr>
                                          <tr>
                                            <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="10">&nbsp;</td>
                                          </tr>
                                          <tr>
                                          
                                          </tr>
                                        </tbody>
                                      </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                          
                          <tr>
                            <td style="text-align:center" valign="top" align="center"><p align="center"><span style="text-align:center;font:normal 11px arial;color:#000000;line-height:20px;font-size:12px"> Note: If you have any question or feedback please contact us on +91 8265020262 or emailus at info@setwellhotels.com.<br>
							</span>
                              </p>
                              <p></p></td>
                          </tr>
                          <tr>
                            <td style="line-height:0;font-size:0;vertical-align:top;padding:0px;text-align:left" height="25">&nbsp;</td>
                          </tr>
                        </tbody>
                      </table></td>
                    <td width="35">&nbsp;</td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
        </tbody>
      </table></td>
  </tr>
</tbody>
</table>
</div>
</body>
</html>';
           $email=$duplicate[0]->email_address;
            $this->load->library('email');
            $subject = "Setwellhotels Forgot Password";
            
          $successmsg='success';
          $errmsg='error';
       $res= $this->GenericModel->sendEmail($email, "info@setwellhotels.com", $subject, $msg, $successmsg, $errmsg);
     if($res['msg']=='success'){
       $array=array('code'=>200,'message'=>'Reset password link send your registered email address');     
      }else{
      $array=array('code'=>400,'message'=>'Some thing went wrong');     
     } 
    }
  
   echo json_encode($array);
   
      }
      //http://localhost/setwellhotel/reset_password?email=Mjg=
 public function reset_password_setwells(){
 $table='tbl_registration';    
 $id= base64_decode($this->input->post('id'));
 $new_password=$this->input->post('new_password');
  $insert_array=array('password'=> md5($new_password));
  $where='id='.$id; 
    $con=$this->GenericModel->update_generic_record($table,$insert_array,$where);
  if($con=='Error'){
     $array=array('code'=>400,'message'=>'Some thing went wrong'); 
 }else{
 $array=array('code'=>200,'message'=>'password reset successfully');
  $this->session->set_userdata('success','password reset successfully login here');
 }
 echo json_encode($array); 
 }
   
}
   
?>