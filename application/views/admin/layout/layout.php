<!DOCTYPE html>
<html lang="en">
	 <?php $this->load->view('admin/layout/head'); ?>
	<body>
         <div class="container-scroller">
         
	<?php  $this->load->view('admin/layout/header'); ?>
	
	 <?php $this->load->view('admin/layout/main_view',$data);?>
	  <?php $this->load->view('admin/layout/footer');?>   
        
         </div> 
            
  <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <!--<a href="http://www.vjmsoftech.com/" target="_blank">VJMSOFTECH</a>-->. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Globallianz<i class="mdi mdi-user text-danger"></i></span>
          </div>
        </footer>
        </div>
</body>
</html>
    