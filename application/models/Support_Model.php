<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Support_Model extends CI_Model {

    
    var $table_trade = 'TRADE T';
    var $column_order_trade = array(null, 'U.EMAIL','U.MOBILE','T.ID','T.USERID','T.TRADE_ID','T.MARKET_RATE','T.GOLD_WEIGHT','T.TOTAL_INR','T.FEES','T.STATUS','T.TRADE_TYPE','T.DATES','T.GST'); 
    var $column_search_trade = array('U.EMAIL','U.MOBILE','T.ID','T.USERID','T.TRADE_ID','T.MARKET_RATE','T.GOLD_WEIGHT','T.TOTAL_INR','T.FEES','T.STATUS','T.TRADE_TYPE','T.DATES','T.GST');  
    var $order_trade = array('T.ID' => 'desc');
    
    var $table_deposit = 'DEPOSIT G';
    var $column_order_deposit = array(null,'U.EMAIL','U.MOBILE','G.ID','G.USERID','G.AMOUNT','G.STATUS','G.CURRENCY','G.TRANACTION_ID','G.CRATED_DATE','G.FIAT_TYPE'); 
    var $column_search_deposit = array('U.EMAIL','U.MOBILE','G.ID','G.USERID','G.AMOUNT','G.STATUS','G.CURRENCY','G.TRANACTION_ID','G.CRATED_DATE','G.FIAT_TYPE');  
    var $order_deposit = array('G.ID' => 'desc');
    
    var $table_users = 'USERS';
    var $column_order_users = array(null,'FULLNAME','EMAIL','ID','MOBILE','STATUS','CREATED_DATE','OTP_VERIFY'); 
    var $column_search_users = array('FULLNAME','EMAIL','ID','MOBILE','STATUS','CREATED_DATE','OTP_VERIFY');  
    var $order_users = array('ID' => 'desc');
    
    var $table_kyc = 'Lo_kyc_verification l';
    var $column_order_kyc= array(null,'l.id','l.userid','l.aadhar_frant_side','l.aadhar_back_side','l.pan_card','l.bank_statement','l.aadhar_status','l.pan_card_status','l.bank_statement_status','l.created_date','l.username','l.email','l.account_no','l.ifsc_code','l.acount_holder','l.bank_date'); //set column database for datatable orderable
    var $column_search_kyc = array('l.id','l.userid','l.aadhar_frant_side','l.aadhar_back_side','l.pan_card','l.bank_statement','l.aadhar_status','l.pan_card_status','l.bank_statement_status','l.created_date','l.username','l.email','l.account_no','l.ifsc_code','l.acount_holder','l.bank_date');  //set column field database for datatable searchable
    var $order_kyc = array('l.id' => 'desc');
    
    var $table_withdraw = 'WITHDRAW l';
    var $column_order_withdraw= array(null,'l.ID','l.USERID','l.AMOUNT','l.FEES','l.FIAT_TYPE','l.STATUS','l.CRATED_DATE','l.REQUEST_ID','l.username','l.email'); //set column database for datatable orderable
    var $column_search_withdraw = array('l.ID','l.USERID','l.AMOUNT','l.FEES','l.FIAT_TYPE','l.STATUS','l.CRATED_DATE','l.REQUEST_ID','l.username','l.email');  //set column field database for datatable searchable
    var $order_withdraw = array('l.ID' => 'desc');
	
    public function __construct() {
        parent::__construct();
    }
    
    // Withdraw Request Listing
       private function _get_datatables_query_withdraw(){
        $this->db->select($this->column_order_withdraw);	
     
        $this->db->from($this->table_withdraw);
     
        $i = 0;
        foreach ($this->column_search_withdraw as $item) // loop column 
        {
         if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_withdraw) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_withdraw[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_withdraw))
        {
            $order = $this->order_withdraw;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables_withdraw() {
        $this->_get_datatables_query_withdraw();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_withdraw(){
        $this->_get_datatables_query_withdraw();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_withdraw(){
          $this->db->from($this->table_withdraw);
          return $this->db->count_all_results();
    }
    
    // KYC Users List
       private function _get_datatables_query_kyc(){
        $this->db->select($this->column_order_kyc);	
        $this->db->from($this->table_kyc);
     
        $i = 0;
        foreach ($this->column_search_kyc as $item) // loop column 
        {
         if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_kyc) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_kyc[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_kyc))
        {
            $order = $this->order_kyc;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables_kyc() {
        $this->_get_datatables_query_kyc();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_kyc(){
        $this->_get_datatables_query_kyc();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_admin_kyc(){
          $this->db->from($this->table_kyc);
          return $this->db->count_all_results();
    }
    // Users Get History
    
    private function _get_datatables_query_users()
            {    
                 $this->db->select($this->column_order_users);
                 $this->db->from($this->table_users);
		
        $i = 0;
        foreach ($this->column_search_users as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_users) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_users[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_users))
        {
            $order1 = $this->order_users;
            $this->db->order_by(key($order1), $order1[key($order1)]);
        }
    }
 
    function get_datatables_users() {
        $this->_get_datatables_query_users();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_users(){
        $this->_get_datatables_query_users();
        $query = $this->db->get();
	//	echo $this->db->last_query();
        return $query->num_rows();
    }
    public function count_all_users(){
                $this->db->from($this->table_users);
                return $this->db->count_all_results();
    }
	/*---------------------------notification paginations-------------------------------------------------------------*/
	/*support team paginations*/
	
	/**/
	 private function _get_datatables_query_trade($type)
            {    
                 $this->db->select($this->column_order_trade);
                 $this->db->from($this->table_trade);
		$this->db->where('T.TRADE_TYPE',$type);
		$this->db->join('USERS U', 'U.ID = T.USERID','inner');
        $i = 0;
        foreach ($this->column_search_trade as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_trade) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_trade[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_trade))
        {
            $order1 = $this->order_trade;
            $this->db->order_by(key($order1), $order1[key($order1)]);
        }
    }
 
    function get_datatables_trade($type) {
        $this->_get_datatables_query_trade($type);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_trade($type){
        $this->_get_datatables_query_trade($type);
        $query = $this->db->get();
	//	echo $this->db->last_query();
        return $query->num_rows();
    }
    public function count_all_trade($type){
                $this->db->from($this->table_trade);
		$this->db->where('T.TRADE_TYPE',$type);
		$this->db->join('USERS U', 'U.ID = T.USERID','inner');
               
        return $this->db->count_all_results();
    }
	
 private function _get_datatables_query_deposit()
            {    
                 $this->db->select($this->column_order_deposit);
                 $this->db->from($this->table_deposit);
		$this->db->join('USERS U', 'U.ID = G.USERID','inner');
        $i = 0;
        foreach ($this->column_search_deposit as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_deposit) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_deposit[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_deposit))
        {
            $order1 = $this->order_deposit;
            $this->db->order_by(key($order1), $order1[key($order1)]);
        }
    }
 
    function get_datatables_deposit() {
        $this->_get_datatables_query_deposit();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_deposit(){
        $this->_get_datatables_query_deposit();
        $query = $this->db->get();
	//	echo $this->db->last_query();
        return $query->num_rows();
    }
    public function count_all_deposit(){
                $this->db->from($this->table_deposit);
		$this->db->join('USERS U', 'U.ID = G.USERID','inner');
               
        return $this->db->count_all_results();
    }
    public function login_support_process($data) {
	    $username=$data['username'];
	    $password=md5($data['password']);
        $login=$this->db->query("select ID,USERNAME,PASSWORD,EMAIL from ADMIN where USERNAME='$username' and PASSWORD='$password'")->row();
		//echo $this->db->last_query();
        //exit;
        
		if(count($login)==1){
        $session_data['ADMIN_ID']=$login->ID;
		$session_data['SUPPORT_USRNAME']=$login->USERNAME;
        $session_data['SUPPORT_EMAIL']=$login->EMAIL;
        $this->session->set_userdata($session_data);
		return 1;
		//echo 'Hii'; exit;
		}else{
		$_SESSION['errormsg']='Username or Password Incorrect?';
		return 0;
		}    
	
  }
}
