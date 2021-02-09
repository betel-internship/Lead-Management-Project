<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Globallianz Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>support_assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>support_assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>support_assets/css/style.css">
     <link href="<?php echo base_url(); ?>support_assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo site_url(); ?>support_assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="<?php echo base_url(); ?>support_assets/images/Globallianz.png">
              </div>
              <h3>Globallinz Login</h3>
             
              <form class="pt-3" method="post" id="loging_submit">
                  <div class="alert alert-danger" id="error_message_login" style="display:none;"></div>
                  <div class="alert alert-success" id="success_message_login" style="display:none;"></div>
                <div class="form-group">
                    <input type="text" maxlength="100" class="form-control form-control-lg" id="username" name="username" placeholder="Email ID">
                </div>
                <div class="form-group">
                    <input type="password" maxlength="100" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                    <button type="submit" id="Login_customers" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
               
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> 
              </form>
              
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
     <script src="<?php echo base_url(); ?>support_assets/js/jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>support_assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>support_assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>support_assets/js/jquery.validate.min.js"></script>
 <script src="<?php echo base_url(); ?>support_assets/js/main.js"></script>

  <script src="<?php echo site_url(); ?>support_assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo site_url(); ?>support_assets/vendors/js/vendor.bundle.addons.js"></script>
  <script src="<?php echo site_url(); ?>support_assets/js/off-canvas.js"></script>
  <script src="<?php echo site_url(); ?>support_assets/js/misc.js"></script>
</body>
</html>
<script>
var BASE_URL='<?php echo site_url(); ?>';
</script>
