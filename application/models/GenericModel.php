<?php
class GenericModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
   public function get_record_with_condition($table,$field,$condition){
       $this->db->select($field);
       $this->db->from($table);
       $this->db->where($condition);
       $get=$this->db->get();
       $query=$get->result();
     return $query;
   }
   public function get_record($table,$field){
       $this->db->select($field);
       $this->db->from($table);
       $get=$this->db->get();
       $query=$get->result();
     return $query;
   }
 public function insert_generic_record($table,$fields){
  $con= $this->db->insert($table,$fields);
    $id=$this->db->insert_id();
   if($con==true){
     return $id;  
   }else{
       return 'Error';
   }
  }
public function update_generic_record($table,$fields,$where){
    $this->db->where($where);
   $query=$this->db->update($table,$fields);
   if($query==true){
    return 'Success';   
   }else{
   return 'Error';    
   }
 }
     public function sendEmail($to, $from, $subject, $messagebody, $successmsg = "Email Sent Successfully", $errmsg = "Some Error Occured") {
        //if Unabla to send or exceed sending limit then send with grid
        $url = 'https://api.sendgrid.com/';
        $user = 'setwellhotels';
        $pass = 'Setwellhotels@123';
        $params = array(
            'api_user' => $user,
            'api_key' => $pass,
            'to' => $to,
            'subject' => $subject,
            'html' => $messagebody,
            'text' => $messagebody,
            'from' => $from,
        );
        $request = $url . 'api/mail.send.json';
        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);
        curl_close($session);
        $res = json_decode($response);
        // print everything out
        if ($res->message == 'success') {
            $data = array(
                'status' => true,
                'msg' => $successmsg
            );
            return $data;
        } else {
            $data = array(
                'status' => false,
                'msg' => $errmsg
            );
            return $data;
        }
    }
}

