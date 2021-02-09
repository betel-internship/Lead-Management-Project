
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="fa fa-users"></i>                 
              </span>
            Employee
            </h3>
          </div>
          <div class="row">
           <div class="col-md-12">
            <?php if(isset($_GET['add'])){
                ?>   
            <div class="card">
            <div class="card-header">
              <i class="fa fa-shopping-bag"></i> Add New Employee
            </div>
              <div class="card-body">
               <div class="alert alert-danger" id="error_message_change" style="display:none;"></div> 
                <div class="alert alert-success" id="success_message_submit" style="display:none;"></div> 
               <form method="post" id="add_emplyee_form">
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Employee Name </label>  
                <input type="text" class="form-control" value="" name="full_name" id="full_name" placeholder="Employee Name">
                </div>
                 <div class="form-group col-md-6">
                <label>Employee Mobile No </label>  
                <input type="text" class="form-control" value="" name="mobile_no" id="mobile_no" placeholder="Mobile No">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Email ID </label>  
                <input type="email" class="form-control" value="" name="email_address" id="email_address" placeholder="Employee Name">
                </div>
                 <div class="form-group col-md-6">
                <label>Employee Password </label>  
                <input type="password" class="form-control" value="" name="password" id="password" placeholder="Mobile No">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Location </label>  
                <input type="text" class="form-control" value="" name="location" id="location" placeholder="Location">
                </div>
                 <div class="form-group col-md-6">
                <label>Employee Role </label>  
                <select type="password" class="form-control" value="" name="role" id="role" placeholder="Mobile No">
                    <option value="">Select Employee Role</option>   
                   <?php foreach($role as $row){ ?>
                   <option value="<?php echo $row->role_name; ?>"><?php echo $row->role_name; ?></option>    
                   <?php } ?>
                </select>
                </div>
                </div>     
                  <div class="form-group col-md-2">    
                  <button type="submit" id="submit_button" class="btn btn-gradient-primary mr-2">Add Employee</button>
                  </div>
              
                  </form>
              
              </div>     
            </div>
            <?php }elseif(isset($_GET['update'])){  $id= base64_decode($_GET['update']); 
               $q=$this->db->query("select  *from tbl_registration where id='".$id."'")->row();
            ?>
           <div class="card">
            <div class="card-header">
              <i class="fa fa-edit"></i> Update New Employee
            </div>
              <div class="card-body">
               <div class="alert alert-danger" id="error_message_change" style="display:none;"></div> 
                <div class="alert alert-success" id="success_message_submit" style="display:none;"></div> 
               <form method="post" id="update_emplyee_form">
                <div class="row">  
                <div class="form-group col-md-6">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" id="id"/>
                <label>Employee Name </label>  
                <input type="text" class="form-control" value="<?php echo $q->full_name; ?>" name="full_name"  id="full_name" placeholder="Employee Name">
                </div>
                 <div class="form-group col-md-6">
                <label>Employee Mobile No </label>  
                <input type="text" class="form-control" value="<?php echo $q->mobile_no; ?>" name="mobile_no" id="mobile_no" placeholder="Mobile No">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-12">
                <label>Email ID </label>  
                <input type="email" class="form-control" value="<?php echo $q->email_address; ?>" name="email_address" id="email_address" placeholder="Employee Name">
                </div>
               
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Location </label>  
                <input type="text" class="form-control" value="<?php echo $q->location; ?>" name="location" id="location" placeholder="Location">
                </div>
                 <div class="form-group col-md-6">
                <label>Employee Role </label>  
                <select type="password" class="form-control" value="" name="role" id="role" placeholder="Mobile No">
                    <option value="<?php echo $q->role; ?>"><?php echo $q->role; ?></option>   
                   <?php foreach($role as $row){  if($q->role!=$row->role_name){?>
                   <option value="<?php echo $row->role_name; ?>"><?php echo $row->role_name; ?></option>    
                   <?php } } ?>
                </select>
                </div>
                </div>     
                  <div class="form-group col-md-2">    
                  <button type="submit" id="submit_button" class="btn btn-gradient-primary mr-2">Update Employee</button>
                  </div>
              
                  </form>
              
              </div>     
            </div>
            <?php }elseif(isset($_GET['view'])){ 
                 $id= base64_decode($_GET['view']); 
               $q=$this->db->query("select  *from tbl_registration where id='".$id."'")->result();
               $leads=$this->GenericModel->get_record_with_condition("tbl_lead","SUM(CASE WHEN status = 'Contacted' THEN 1 ELSE 0 END) AS 'contacted',SUM(CASE WHEN status = 'Not Contacted' THEN 1 ELSE 0 END) AS 'notcontacted',SUM(CASE WHEN status = 'E Relevant' THEN 1 ELSE 0 END) AS 'erelevant',SUM(CASE WHEN status = 'Follow Up' THEN 1 ELSE 0 END) AS 'followup',SUM(CASE WHEN status = 'Case Dropped' THEN 1 ELSE 0 END) AS 'casedropped',SUM(CASE WHEN status = 'Lost Lead' THEN 1 ELSE 0 END) AS 'lostlead',SUM(CASE WHEN status = 'Importance' THEN 1 ELSE 0 END) AS 'importance',SUM(CASE WHEN status = 'Negotiation' THEN 1 ELSE 0 END) AS 'negotiation',SUM(CASE WHEN status = 'Deal Done' THEN 1 ELSE 0 END) AS 'dealdone',SUM(CASE WHEN status = 'Quotation Sending' THEN 1 ELSE 0 END) AS 'quotationsending'","userid='".$id."'");
                ?> 
              <?php $total_leads=$leads[0]->contacted+$leads[0]->notcontacted+$leads[0]->erelevant+$leads[0]->followup+$leads[0]->casedropped+$leads[0]->lostlead+$leads[0]->importance+$leads[0]->negotiation+$leads[0]->dealdone+$leads[0]->quotationsending; ?>    
               <div class="card">
            <div class="card-header">
                <i class="fa fa-eye"></i> View Lead Details <a href="<?php echo site_url(); ?>employee" class="btn btn-gradient-danger btn-rounded btn-fw btn-sm"> Back</a>
            </div>
              <div class="card-body">
              <table class="table table-bordered">
                  <tbody>
                      <tr>
                        <th>Employee Name</th>
                       <td><?php echo $q[0]->full_name; ?></td>
                        </tr> 
                        <tr>
                        <th>Mobile No</th>
                       <td><?php echo $q[0]->mobile_no; ?></td>
                        </tr>
                     
                          <tr>
                        <th>Email ID</th>
                       <td><?php echo $q[0]->email_address; ?></td>
                        </tr>
                         <tr>
                        <th>Location</th>
                       <td><?php echo $q[0]->location; ?></td>
                        </tr>
                         <tr>
                        <th>Role</th>
                       <td><?php echo $q[0]->role; ?></td>
                        </tr>
                        <tr>
                        <th>Created Date</th>
                       <td><?php echo date('Y-m-d h:i A', strtotime($q[0]->created_date)); ?></td>
                        </tr>
                   </tbody>   
              </table>
              </div>     
            </div> 
                <div class="card">
            <div class="card-header">
                <i class="fa fa-eye"></i> Lead Statistics <a href="<?php echo site_url(); ?>employee" class="btn btn-gradient-danger btn-rounded btn-fw btn-sm"> Back</a>
            </div>
                    <div class="card-body">
                  <div class="row">
          
         <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                     <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-bullhorn"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                          <h2 class="mb-5"><?php if(!empty($total_leads)){ echo $total_leads; }else{ echo '0'; }?></h2>
                          <h4>Total Lead</h4>
                         </div>  
                     </div>
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                  
                
                
                </div>
              </div>
            </div>
              
               <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-phone"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->contacted)){ echo $leads[0]->contacted; }else{ echo '0'; }?></h2>
                          <h4>Contacted Lead</h4>
                         </div>  
                     </div>
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                  
               
                
                </div>
              </div>
            </div>
              
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    
                     <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-mobile"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->notcontacted)){ echo $leads[0]->notcontacted; }else{ echo '0'; }?></h2>
                          <h4>Not Contacted Lead</h4>
                         </div>  
                     </div>
                    
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                                    
              
                  </div>
              </div>
            </div>
          
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    
                     <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-random"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->erelevant)){ echo $leads[0]->erelevant; }else{ echo '0'; }?></h2>
                          <h4>E-Relevant Lead</h4>
                         </div>  
                     </div>
                    
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                                    
                
                  </div>
              </div>
            </div>
              
           <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    
                      <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-plus"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->followup)){ echo $leads[0]->followup; }else{ echo '0'; }?></h2>
                          <h4>Follow Up Leads</h4>
                         </div>  
                     </div>
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                                    
                
                  </div>
              </div>
            </div>
              
           <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                     <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-dropbox"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->casedropped)){ echo $leads[0]->casedropped; }else{ echo '0'; }?></h2>
                          <h4>Case Dropped Leads</h4>
                         </div>  
                     </div>
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                                    
                 
                  </div>
              </div>
            </div>
              
             <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                     <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-unlink"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->lostlead)){ echo $leads[0]->lostlead; }else{ echo '0'; }?></h2>
                          <h4>Lost Leads</h4>
                         </div>  
                     </div>
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                                    
                 
                  </div>
              </div>
            </div>
              
              
                <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                     <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-inbox"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->importance)){ echo $leads[0]->importance; }else{ echo '0'; }?></h2>
                          <h4>Importance Leads</h4>
                         </div>  
                     </div>
              
                  </div>
              </div>
            </div>
              
           <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                     <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-handshake-o"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->negotiation)){ echo $leads[0]->negotiation; }else{ echo '0'; }?></h2>
                          <h4>Negotiation Leads</h4>
                         </div>  
                     </div>
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                                    
               
                  </div>
              </div>
            </div>
              
           <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                      <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-weight-normal"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->dealdone)){ echo $leads[0]->dealdone; }else{ echo '0'; }?></h2>
                          <h4>Deal Done Leads</h4>
                         </div>  
                     </div>
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                                    
                 
                  </div>
              </div>
            </div>
              
             <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                     <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-envelope-o"></i>       
                        </div>
                         <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                        <h2 class="mb-5"><?php if(!empty($leads[0]->quotationsending)){ echo $leads[0]->quotationsending; }else{ echo '0'; }?></h2>
                          <h4>Quotation Sending Leads</h4>
                         </div>  
                     </div>
                <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->                                    
                 
                  </div>
              </div>
            </div>

           
          </div>   
                        
                    </div>
                </div>
            <?php }else{ ?>  
                <div class="card">
            <div class="card-header">
                <i class="mdi mdi-table-large"></i> Employee List <a href="<?php echo site_url() ?>employee?add=new" class="btn btn-gradient-info btn-sm"> Add Employee <i class="fa fa-plus"></i></a>
            </div>
              <div class="card-body">
                  
                 <?php if($this->session->userdata('success')){ ?>
                  <div class="alert alert-success">
                      <?php echo $this->session->userdata('success'); ?>
                  </div>
                 <?php $this->session->unset_userdata('success'); } ?>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="employee_table">
                          <thead>
                            <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>Email ID</th>
                            <th>Location</th>
                            <th>Role</th>   
                            <th style="width:22%;">Action</th>
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
         
     