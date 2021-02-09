
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account"></i>                 
              </span>
              Change Password 
            </h3>
          </div>
          <div class="row">
           <div class="col-md-12">
             <div class="card">
            <div class="card-header">
              <i class="mdi mdi-table-large"></i> Change Password
            </div>
              <div class="card-body">
                 <?php if($this->session->userdata('success')){ ?>
                  <div class="alert alert-success">
                      <?php echo $this->session->userdata('success'); ?>
                  </div>
                 <?php $this->session->unset_userdata('success'); } ?>
                  <div class="alert alert-danger" id="error_message_change" style="display:none;"></div>
                  <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                        <form method="post" id="changed_password">
                        <div class="form-group">
                        <label>New Password </label>  
                        <input type="password" class="form-control" value="" name="new_password" id="new_password" placeholder="New Password">

                        </div>
                        <div class="form-group">
                        <label>Confirm Password </label>  
                        <input type="password" class="form-control" name="con_password" id="con_password" placeholder="Confrim Password">
                        </div>
                             <button type="submit" id="change_Password" class="btn btn-gradient-primary mr-2">Change Password</button>
                        </form>
                      </div>       
                  </div>     
              </div>
            </div>
           </div>
          </div>
        </div>
       