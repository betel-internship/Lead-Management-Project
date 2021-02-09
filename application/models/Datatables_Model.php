<?php 
 class Datatables_Model extends CI_Model {
    var $table_payment = 'tbl_registration';
    var $column_order_payment = array(null,'full_name','id','mobile_no','email_address','location','role','user_type','status','created_date'); 
    var $column_search_payment = array('full_name','id','mobile_no','email_address','location','role','user_type','status','created_date');  
    var $order_payment = array('id' => 'desc');
    
    var $table_lead = 'tbl_lead';
    var $column_order_lead = array(null,'customer_name','id','company_name','state','city','mobile_no','assigned_by','assigned_to','created_date','userid','status'); 
    var $column_search_lead = array('customer_name','id','company_name','state','city','mobile_no','assigned_by','assigned_to','created_date','userid','status');  
    var $order_lead = array('id' => 'desc');
    
   	public function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }
    
       private function geting_datatables_emplyee(){
        $this->db->select($this->column_order_payment);	
        $this->db->from($this->table_payment);
        $this->db->where('user_type','Employee');
        $i = 0;
        foreach ($this->column_search_payment as $item) // loop column 
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
                if(count($this->column_search_payment) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_payment[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_payment)){
            $order = $this->order_payment;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
    function get_datatables_employee() {
        $this->geting_datatables_emplyee();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_employee(){
        $this->geting_datatables_emplyee();
        $query = $this->db->get();
        return $query->num_rows();
    }
     public function count_all_employee(){
        $this->db->from($this->table_payment);
         $this->db->where('user_type','Employee');
        return $this->db->count_all_results();
    } 
     
  
  
  
  
       private function geting_datatables_lead($usertype,$userid){
        $this->db->select($this->column_order_lead);	
       if($usertype=='Admin'){  
        $this->db->from($this->table_lead);
       }else{
      $this->db->from($this->table_lead);
      $this->db->where('userid',$userid);
       }
        $i = 0;
        foreach ($this->column_search_lead as $item) // loop column 
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
                if(count($this->column_search_lead) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_lead[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_lead)){
            $order = $this->order_lead;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
    function get_datatables_lead($usertype,$userid) {
        $this->geting_datatables_lead($usertype,$userid);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_lead($usertype,$userid){
        $this->geting_datatables_lead($usertype,$userid);
        $query = $this->db->get();
        return $query->num_rows();
    }
     public function count_all_lead($usertype,$userid){
       if($usertype=='Admin'){  
        $this->db->from($this->table_lead);
       }else{
      $this->db->from($this->table_lead);
      $this->db->where('userid',$userid);
       }
        return $this->db->count_all_results();
    } 
    
    
    private function geting_datatables_lead_details($types,$userid){
        $this->db->select($this->column_order_lead);	
        $this->db->from($this->table_lead);
        $this->db->where('status',$types);
        if(!empty($userid)){
       $this->db->where('userid',$userid);     
        }
        $i = 0;
        foreach ($this->column_search_lead as $item) // loop column 
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
                if(count($this->column_search_lead) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_lead[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_lead)){
            $order = $this->order_lead;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
    function get_datatables_lead_details($types,$userid) {
        $this->geting_datatables_lead_details($types,$userid);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_lead_details($types,$userid){
        $this->geting_datatables_lead_details($types,$userid);
        $query = $this->db->get();
        return $query->num_rows();
    }
     public function count_all_lead_details($types,$userid){
        $this->db->from($this->table_lead);
         $this->db->where('status',$types);
        if(!empty($userid)){
       $this->db->where('userid',$userid);     
        }
        return $this->db->count_all_results();
    } 
    
  }