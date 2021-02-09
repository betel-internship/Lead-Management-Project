<?php      
 $from_userid=$this->session->userdata('ADMIN_ID');
$count=$this->GenericModel->get_record_with_condition("tbl_notification","count(id) as totopen","to_userid='".$from_userid."' and view=0"); 
$data1=$this->GenericModel->get_record_with_condition("tbl_notification","*","to_userid='".$from_userid."' order by id desc LIMIT 5");
?>
<a class="nav-link dropdown-toggle" id="nontification" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                  <i class="fa fa-2x fa-bell"></i>
                 <?php if($count[0]->totopen>=1){ ?>
                  <span class="count_notification" id="count_ids_get" onclick="return update_notification_count()"><?php echo $count[0]->totopen; ?></span>   
                 <?php } ?>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="nontification">
               <?php if(count($data1)>=1){ ?> 
                   <?php foreach($data1 as $row){ ?> 
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-user mr-2 text-primary"></i>
                <i class="fa fa-user"></i> <b style="color:red"><?php echo $row->from_username; ?></b>&nbsp; <?php echo $row->message; ?>
                <a style="padding-left:20px;"><i class="fa fa-calendar"></i> <?php echo date('d-m-Y h:i A',strtotime($row->created_date)); ?></a>  
              </a>
               <?php } }else{ ?>  
          <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="#">
                <i class="mdi mdi-user mr-2 text-primary"></i>
                No Notification Found
              </a>
            </div>
               <?php  }?>
