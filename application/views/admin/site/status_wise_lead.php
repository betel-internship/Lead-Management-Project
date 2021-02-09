
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="fa fa-users"></i>                 
              </span>
           <?php echo $_GET['lead_status']; ?> Lead
            </h3>
          </div>
          <div class="row">
           <div class="col-md-12">
            <?php if(isset($_GET['add'])){
                ?>   
            <div class="card">
            <div class="card-header">
              <i class="fa fa-shopping-bag"></i> Add New Lead
            </div>
              <div class="card-body">
               <div class="alert alert-danger" id="error_message_change" style="display:none;"></div> 
                <div class="alert alert-success" id="success_message_submit" style="display:none;"></div> 
               <form method="post" id="lead_creation_form">
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Lead Owner </label>  
                <input type="text" class="form-control" value="" name="lead_owner" id="lead_owner" placeholder="Lead Owner">
                </div>
                 <div class="form-group col-md-6">
                <label>Name </label>  
                <input type="text" class="form-control" value="" name="name" id="name" placeholder="Name">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>City</label>  
                <input type="text" class="form-control" value="" name="city" id="city" placeholder="City">
                </div>
                 <div class="form-group col-md-6">
                <label>Mobile No </label>  
                <input type="text" class="form-control" value="" name="mobile_no" id="mobile_no" placeholder="Mobile No">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Lead Title </label>  
                <input type="text" class="form-control" value="" name="title" id="title" placeholder="Lead Title">
                </div>
                 <div class="form-group col-md-6">
                <label>Lead Status </label>  
                <select type="password" class="form-control" value="" name="status" id="status" placeholder="Mobile No">
                    <option value="">Select Lead Status</option>   
                   <?php foreach($status as $row){ ?>
                   <option value="<?php echo $row->status; ?>"><?php echo $row->status; ?></option>    
                   <?php } ?>
                </select>
                </div>
                </div>    
                   <div class="row">
                    <div class="form-group col-md-6">
                <label>Lead Assigned employee </label>  
                <select type="password" class="form-control" value="" name="userid" id="userid" placeholder="Mobile No">
                    <option value="">Select Lead Assigned</option>   
                   <?php foreach($employee as $row){ ?>
                   <option value="<?php echo $row->id; ?>"><?php echo $row->full_name; ?></option>    
                   <?php } ?>
                </select>
                </div>
                         <div class="form-group col-md-6">
                        <label>Lead Description </label>  
                        <textarea id="description" name="description" class="form-control" placeholder="Lead Description"></textarea>
                         </div>
                   </div>
                  <div class="form-group col-md-2">    
                  <button type="submit" id="submit_button" class="btn btn-gradient-primary mr-2">Add Lead</button>
                  </div>
              
                  </form>
              
              </div>     
            </div>
            <?php }elseif(isset($_GET['update'])){  $id= base64_decode($_GET['update']); 
               $q=$this->db->query("select  *from tbl_lead where id='".$id."'")->result();
            ?>
           <div class="card">
            <div class="card-header">
              <i class="fa fa-leanpub"></i> Update New Lead
            </div>
              <div class="card-body">
               <div class="alert alert-danger" id="error_message_change" style="display:none;"></div> 
                <div class="alert alert-success" id="success_message_submit" style="display:none;"></div> 
               <form method="post" id="update_creation_form">
                   <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/>
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Lead Owner </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->lead_owner; ?>" name="lead_owner" id="lead_owner" placeholder="Lead Owner">
                </div>
                 <div class="form-group col-md-6">
                <label>Name </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->name; ?>" name="name" id="name" placeholder="Name">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>City</label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->city; ?>" name="city" id="city" placeholder="City">
                </div>
                 <div class="form-group col-md-6">
                <label>Mobile No </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->mobile_no; ?>" name="mobile_no" id="mobile_no" placeholder="Mobile No">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Lead Title </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->title; ?>" name="title" id="title" placeholder="Lead Title">
                </div>
                 <div class="form-group col-md-6">
                <label>Lead Status </label>  
                <select type="password" class="form-control" value="" name="status" id="status" placeholder="Mobile No">
                    <option value="<?php echo $q[0]->status; ?>"><?php echo $q[0]->status; ?></option>   
                   <?php foreach($status as $row){ if($q[0]->status!=$row->status){?>
                   <option value="<?php echo $row->status; ?>"><?php echo $row->status; ?></option>    
                   <?php } } ?>
                </select>
                </div>
                </div>    
                   <div class="row">
                    <div class="form-group col-md-6">
                <label>Lead Assigned employee </label>  
                <select  class="form-control" value="" name="userid" id="userid" placeholder="Mobile No">
                     
                   <?php foreach($employee as $row){ ?>
                   <option <?php if($q[0]->userid==$row->id){ echo 'selected'; } ?> value="<?php echo $row->id; ?>"><?php echo $row->full_name; ?></option>    
                   <?php } ?>
                </select>
                </div>
                         <div class="form-group col-md-6">
                        <label>Lead Description </label>  
                        <textarea id="description" name="description" class="form-control" placeholder="Lead Description"><?php echo $q[0]->description; ?></textarea>
                         </div>
                   </div>
                  <div class="form-group col-md-2">    
                  <button type="submit" id="submit_button" class="btn btn-gradient-primary mr-2">Update Lead</button>
                  </div>
              
                  </form>
              
              </div>     
            </div>
            <?php }elseif(isset($_GET['view'])){ 
                $id= base64_decode($_GET['view']); 
               $q=$this->db->query("select  *from tbl_lead where id='".$id."'")->result();
                ?>  
               <div class="row">
                <div class="col-md-6">
             <div class="card">
            <div class="card-header">
                <i class="fa fa-eye"></i> View Lead Details <a href="<?php echo site_url(); ?>detail_lead_details?lead_status=<?php echo $_GET['lead_status']; ?>" class="btn btn-gradient-danger btn-rounded btn-fw btn-sm"> Back</a>
            </div>
                 
              <div class="card-body">
                  <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                      <tr>
                        <th>Loan ID</th>
                       <td><?php echo $q[0]->lead_id; ?></td>
                        </tr> 
                        <tr>
                        <th>Customer Name</th>
                       <td><?php echo $q[0]->customer_name; ?></td>
                        </tr>
                        <tr>
                        <th>Company Name</th>
                       <td><?php echo $q[0]->company_name; ?></td>
                        </tr>
                        <tr>
                        <th>Customer Mobile No</th>
                       <td><?php echo $q[0]->mobile_no; ?> <?php if(!empty($q[0]->secondary_mobile_no)){ echo ', '.$q[0]->secondary_mobile_no; } ?></td>
                        </tr>
                          <tr>
                        <th>Email ID</th>
                       <td><?php echo $q[0]->email_id; ?></td>
                        </tr>
                         <tr>
                        <th>Address</th>
                       <td><?php echo $q[0]->city; if(!empty($q[0]->state)){ echo ','.  $q[0]->state; } ?></td>
                        </tr>
                         <tr>
                        <th>Lead Source</th>
                       <td><?php echo $q[0]->lead_source; ?></td>
                        </tr>
                         <tr>
                        <th>Lead Status</th>
                       <td><?php echo $q[0]->status; ?></td>
                        </tr>
                         <tr>
                        <th>Assigned By</th>
                       <td><?php echo $q[0]->assigned_by; ?></td>
                        </tr>
                        <tr>
                        <th>Assigned To</th>
                       <td><?php echo $q[0]->assigned_to; ?></td>
                        </tr>
                        <tr>
                        <th>Created Date</th>
                       <td><?php echo date('Y-m-d h:i A', strtotime($q[0]->created_date)); ?></td>
                        </tr>
                         <tr>
                        <th>Lead Requirement</th>
                       <td><?php echo $q[0]->requirement; ?></td>
                        </tr>
                       
                      <tr><th>Description</th>
                          <td colspan="3"><?php echo $q[0]->description; ?></td>
                      </tr>
                  </tbody>   
              </table>
                  </div>
                 </div>  
             </div> 
                </div>   
                   <div class="col-md-6">
                    <div class="card">
            <div class="card-header">
                <i class="fa fa-comment"></i> Lead Comment <a href="<?php echo site_url(); ?>detail_lead_details?lead_status=<?php echo $_GET['lead_status']; ?>" class="btn btn-gradient-danger btn-rounded btn-fw btn-sm"> Back</a>
            </div>
                 
              <div class="card-body">
                 <form method="post" id="submited_comment_form">
                     <input type="hidden" name="lead_id" id="lead_id" value="<?php echo base64_decode($_GET['view']); ?>"/>
                     <input type="hidden" name="lead_title" value="<?php echo $q[0]->title; ?>"/>
                      <input type="hidden" name="userid" value="<?php echo $q[0]->userid; ?>"/>
                       <input type="hidden" name="lead_id_ID" value="<?php echo $q[0]->lead_id; ?>"/>
                  <div class="alert alert-danger" id="error_message_change" style="display:none;"></div> 
                <div class="alert alert-success" id="success_message_submit" style="display:none;"></div> 
                    <br>
                 <div class="row">
                     <div class="col-md-12">
                         <textarea id="comment" name="comment" placeholder="Comment" class="form-control"></textarea>   
                     </div> 
                 </div>
                    <div class="row">
                     <div class="col-md-6">
                         <label>Select Lead Status</label>
                         <select id="lead_statuss" name="lead_statuss" placeholder="Comment" class="form-control">
                             <option value="<?php echo $q[0]->status; ?>"><?php echo $q[0]->status; ?></option>   
                             <?php foreach($status as $row){ if($q[0]->status!=$row->status){ ?>
                             <option value="<?php echo $row->status; ?>"><?php echo $row->status; ?></option>     
                             <?php } } ?>
                         </select>   
                     </div>
                        <div class="col-md-6"><br>
                             <button type="submit" id="submit_button" class="btn btn-gradient-primary mr-2">Submit Comment</button>
                        </div>   
                 </div>
                </form>
                  
                     <div class="row" id="get_recent_comment">
  <?php if(count($lead_data)>=1){ ?>
<div class="card-body panel-default widget">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-comment"></span>
                <h3 class="panel-title">
                    Recent Comments</h3>
                <!--<span class="label label-info">78</span>-->
            </div>
            <div class="panel-body">
                <ul class="list-group">
                  <?php foreach($lead_data as $row){ ?>  
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="#">At that time status was: <b><?php echo $row->status; ?></b></a>
                                    <div class="mic-info">
                                        By: <a href="#"><?php echo $row->username; ?></a> on <?php echo date('d M Y h:i A', strtotime($row->created_date)); ?>
                                    </div>
                                </div>
                                <div class="comment-text">
                                   <?php echo $row->comment; ?>
                                </div>
                               
                            </div>
                        </div>
                    </li>
                  <?php } ?>
                </ul>
            </div>
        </div>
<?php } ?>
    </div>
              </div></div></div>
                 
              
            </div>  
            <?php }else{ ?>  
               <input type="hidden" name="lead_status" id="lead_status" value="<?php echo $_GET['lead_status']; ?>">
                <div class="card">
            <div class="card-header">
                <i class="mdi mdi-table-large"></i><?php echo $_GET['lead_status']; ?> Lead List <!--<a href="<?php echo site_url() ?>create_lead?add=new" class="btn btn-gradient-info btn-sm"> Add Lead <i class="fa fa-plus"></i></a>-->
            </div>
              <div class="card-body">
                  
                 <?php if($this->session->userdata('success')){ ?>
                  <div class="alert alert-success">
                      <?php echo $this->session->userdata('success'); ?>
                  </div>
                 <?php $this->session->unset_userdata('success'); } ?>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="all_tables_details">
                          <thead>
                           <tr>
                            <th>Sr.No</th>
                            <th>Customer Name</th>
                            <th>Customer Mobile</th>
                            <th>Address</th>
                            <th>Assigned By</th>
                            <th>Assigned To</th>
                            <th>Date</th> 
                            <th>Status</th>
                            <th style="width:17%;">Action</th>
                            </tr>
                          </thead>    
                      </table>   
                  </div>
              </div>
            </div>
            <?php } ?>
           </div>
          </div>   
        </div>
         
     