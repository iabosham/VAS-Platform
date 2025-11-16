<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Vendor.php');
require_once('../../SDPAccess/AccessControl/Vendor/VendorControl.php');



     
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alwesam SDP </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-admin-theme-change-size.css">

        <!-- Vendors -->
        <link rel="stylesheet" media="screen" href="../../vendors/bootstrap-datepicker/css/datepicker.css">
        <link rel="stylesheet" media="screen" href="../../css/datepicker.fixes.css">
        <link rel="stylesheet" media="screen" href="../../vendors/uniform/themes/default/../../css/uniform.default.min.css">
        <link rel="stylesheet" media="screen" href="../../css/uniform.default.fixes.css">
        <link rel="stylesheet" media="screen" href="../../vendors/chosen.min.css">
        <link rel="stylesheet" media="screen" href="../../vendors/selectize/dist/../../css/selectize.bootstrap3.css">
        <link rel="stylesheet" media="screen" href="../../vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
    <?php include '../Include/top_header.php'; ?>

        <!-- main / large navbar -->
       <?php include '../Include/main_header.php'; ?>

        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->
                <div class="col-md-2 bootstrap-admin-col-left">
                    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                       <?php $pageKey = PageKey::$PAGE_VENDOR; include '../Include/menu.php'; ?>
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-10">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header bootstrap-admin-content-title">
                                <h1>Providers</h1>
                                
                                <a href="index.php" class="action">
                                    <button class="btn btn-success">Provider's view</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                       
                       if(isset($_SESSION[Session::$ENVALED_LOGIN])){
                           echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a>' ;
                           foreach ($_SESSION[Session::$ENVALED_LOGIN] as $row){
                               echo $row.'<br />';
                           }
                           unset($_SESSION[Session::$ENVALED_LOGIN]) ;
                           echo '</div>'; 
                       } 
                       session_write_close();
                      
                    ?>
                   
                            
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Form Provider</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" action="../../Control/Vendor/AddVendor.php" method="post" enctype="multipart/form-data">
                                        <fieldset>
                                            <legend>Register Vendor</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Provider's name</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" name="name" type="text" placeholder="Enter vendor's name here ..." >
                                                </div>
                                            </div>
                                          
                                            
                                              <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">Address</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" name="address" type="text" placeholder="Enter address here...">
                                                </div>
                                            </div>
                                            
                                              <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">Phone</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" name="phone" type="text" placeholder="Enter phone here...">
                                                </div>
                                            </div> 
                                            
                                            <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">E-mail</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" name="email" type="text" placeholder="Enter an E-mail here...">
                                                </div>
                                            </div>
                                            
                                               <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">Public key file (pem)</label>
                                                <div class="col-lg-10">
                                                    <input  id="focusedInput" name="publicKey" type="file" placeholder="Enter an E-mail here...">
                                                </div>
                                            </div>
                                            
                                               <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">Private key file (pem)</label>
                                                <div class="col-lg-10">
                                                    <input  id="focusedInput" name="privateKey" type="file" placeholder="Enter an E-mail here...">
                                                </div>
                                            </div>
                                             
                                            
                                            
                                              <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Description</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" name="desc" id="focusedInput"></textarea>
                                                 </div>
                                            </div>
                                              
                                             
                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="optionsCheckbox2"> </label>
                                                <div class="col-lg-10">
                                                    <label>
                                                        <input type="checkbox" id="optionsCheckbox2" name="status" value="1" checked=""  >
                                                       Active
                                                    </label>
                                                </div>
                                            </div>
                                           
                                             <button type="submit" class="btn btn-primary">Add Provider</button>
                                            <button type="reset" class="btn btn-default">Cancel</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php include '../Include/footer.php'; ?>

        <script type="text/javascript" src="../../js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="../../vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../js/DT_bootstrap.js"></script>
       
    </body>
</html>
