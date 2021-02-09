
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <!-- <img src="<?php echo base_url(); ?>support_assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/> -->
                    <div class="row">
                        <div class="col-md-3 col-xs-3 col-sm-3 custom-col-4">
                      <i class="fa fa-3x fa-users"></i>       
                        </div>
                        <div class="col-md-9 col-xs-9 col-sm-9 custom-col-8">
                         <h2 class="mb-5"><?php if(!empty($total_staff[0]->total_count)){  echo $total_staff[0]->total_count; }else{ echo '0'; }?></h2>    
                        <h4>Total Employee</h4>  
                          </div>
                      </div>  
                  
                    
                   
                
                </div>
              </div>
            </div>
            <?php $total_leads=$leads[0]->contacted+$leads[0]->notcontacted+$leads[0]->erelevant+$leads[0]->followup+$leads[0]->casedropped+$leads[0]->lostlead+$leads[0]->importance+$leads[0]->negotiation+$leads[0]->dealdone+$leads[0]->quotationsending; ?>  
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
      
            
         
          <!--<div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <h4 class="card-title float-left">Visit And Sales Statistics</h4>
                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>                                     
                  </div>
                  <canvas id="visit-sale-chart" class="mt-4"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Traffic Sources</h4>
                  <canvas id="traffic-chart"></canvas>
                  <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>                                                      
                </div>
              </div>
            </div>
          </div>-->
        
        
        </div>
       