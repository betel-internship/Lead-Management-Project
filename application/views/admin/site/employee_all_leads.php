
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="fa fa-users"></i>                 
              </span>
            Lead
            </h3>
          </div>
          <div class="row">
           <div class="col-md-12">
            <?php
             $tbl_lead_source=$this->GenericModel->get_record('tbl_source',"name");
            if(isset($_GET['add'])){
                ?>   
            <div class="card">
            <div class="card-header">
              <i class="fa fa-shopping-bag"></i> Add New Lead
            </div>
              <div class="card-body">
               <div class="alert alert-danger" id="error_message_change" style="display:none;"></div> 
                <div class="alert alert-success" id="success_message_submit" style="display:none;"></div> 
               <form method="post" id="lead_creation_form_employee">
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Customer Name </label>  
                <input type="text" class="form-control" value="" name="customer_name" id="customer_name" placeholder="Customer Name">
                </div>
                 <div class="form-group col-md-6">
                <label>Company Name </label>  
                <input type="text" class="form-control" value="" name="company_name" id="company_name" placeholder="Company Name">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>City</label>  
                <input type="text" class="form-control" value="" name="city" id="city" placeholder="City">
                </div>
                 <div class="form-group col-md-6">
                <label>State </label>  
                <input type="text" class="form-control" value="" name="state" id="state" placeholder="State">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Mobile No </label>  
                <input type="text" class="form-control" value="" name="mobile_no" id="mobile_no" placeholder="Mobile No">
                </div>
                  <div class="form-group col-md-6">
                <label>Secondary Mobile </label>  
                <input type="text" class="form-control" value="" name="secondary_mobile_no" id="secondary_mobile_no" placeholder="Secondary Mobile No">
                </div>
                </div>
                   
                       
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Email ID </label>  
                <input type="email" class="form-control" value="" name="email_id" id="email_id" placeholder="Email ID">
                </div>
                  <div class="form-group col-md-6">
                <label>Select Lead Source </label>  
                
                <select type="text" class="form-control" value="" name="lead_source" id="lead_source" placeholder="Secondary Mobile No">
                    <option value="">Select Lead Source</option>    
                    <?php foreach($tbl_lead_source as $row){ ?>
                     <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
                    <?php } ?>
                </select>
                </div>
                </div>
                   <div class="row">  
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
                        <label>Lead Requirement </label>  
                        <textarea id="requirement" name="requirement" class="form-control" placeholder="Lead Requirement"></textarea>
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
               <form method="post" id="update_creation_form_employee">
                   <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/>
                 <div class="row">  
                <div class="form-group col-md-6">
                <label>Customer Name </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->customer_name; ?>" name="customer_name" id="customer_name" placeholder="Customer Name">
                </div>
                 <div class="form-group col-md-6">
                <label>Company Name </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->company_name; ?>" name="company_name" id="company_name" placeholder="Company Name">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>City</label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->city; ?>" name="city" id="city" placeholder="City">
                </div>
                 <div class="form-group col-md-6">
                <label>State </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->state; ?>" name="state" id="state" placeholder="State">
                </div>
                </div>     
                   
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Mobile No </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->mobile_no; ?>" name="mobile_no" id="mobile_no" placeholder="Mobile No">
                </div>
                  <div class="form-group col-md-6">
                <label>Secondary Mobile </label>  
                <input type="text" class="form-control" value="<?php echo $q[0]->secondary_mobile_no; ?>" name="secondary_mobile_no" id="secondary_mobile_no" placeholder="Secondary Mobile No">
                </div>
                </div>
                   
                       
                <div class="row">  
                <div class="form-group col-md-6">
                <label>Email ID </label>  
                <input type="email" class="form-control" value="<?php echo $q[0]->email_id; ?>" name="email_id" id="email_id" placeholder="Email ID">
                </div>
                  <div class="form-group col-md-6">
                <label>Select Lead Source </label>  
                <!--<input type="text" class="form-control" value="<?php echo $q[0]->lead_source; ?>" name="lead_source" id="lead_source" placeholder="Secondary Mobile No">-->
                
                <select type="text" class="form-control" value="" name="lead_source" id="lead_source" placeholder="Secondary Mobile No">
                    <?php if(empty($q[0]->lead_source)){ ?>
                    <option value="">Select Lead Source</option>    
                    <?php }else{ ?>
                     <option value="<?php echo $q[0]->lead_source; ?>"><?php echo $q[0]->lead_source; ?></option> 
                    <?php foreach($tbl_lead_source as $row){  ?>
                     <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
                    <?php }  } ?>
                </select>
                </div>
                </div>
                   <div class="row">   
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
                        <label>Lead Requirement </label>  
                        <textarea id="requirement" name="requirement" class="form-control" placeholder="Lead Requirement"><?php echo $q[0]->requirement; ?></textarea>
                         </div>
                         <div class="form-group col-md-6">
                        <label>Lead Description </label>  
                        <textarea id="description" name="description" class="form-control" placeholder="Lead Description"><?php echo $q[0]->requirement; ?></textarea>
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
             <div class="card">
            <div class="card-header">
                <i class="fa fa-eye"></i> View Lead Details <a href="<?php echo site_url(); ?>employee_created_leads" class="btn btn-gradient-danger btn-rounded btn-fw btn-sm"> Back</a>
            </div>
              <div class="card-body">
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
            <?php }else{ ?>  
                <div class="card">
            <div class="card-header">
                <i class="mdi mdi-table-large"></i> Lead List <a href="<?php echo site_url() ?>employee_created_leads?add=new" class="btn btn-gradient-info btn-sm"> Add Lead <i class="fa fa-plus"></i></a>
            </div>
              <div class="card-body">
                  
                 <?php if($this->session->userdata('success')){ ?>
                  <div class="alert alert-success">
                      <?php echo $this->session->userdata('success'); ?>
                  </div>
                 <?php $this->session->unset_userdata('success'); } ?>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="lead_creation_tables">
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
         
     