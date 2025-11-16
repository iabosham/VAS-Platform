<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Vendor.php');
require_once('../../SDPAccess/AccessControl/Vendor/VendorControl.php');

require_once('../../SDPAccess/Model/Company.php');
require_once('../../SDPAccess/AccessControl/SMPP/CompanyControl.php');

 $companies= CompanyControl::getCompanies();
 
 $vendors = VendorControl::getVendors();

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alwesam SDP | Services</title>

    <?php include '../Include/header_files.php'; ?>
      <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    
     <?php include '../Include/footer2.php'; ?>
    
     <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include '../Include/main_header_1.php'; ?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php $pageKey = PageKey::$PAGE_SHORTCODE; include '../Include/menu.php'; ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Service</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Registration From
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                     <?php include '../Include/session_message.php'; ?>
                                    
                                    <form role="form" action="../../Control/Shortcode/AddShortcode.php" method="post">
                                 
                                        
                                          <?php  if(Cookie::getCompanyID() > 0){
                                                $companyInfo = CompanyControl::getCompanyInfo(Cookie::getCompanyID());
                                                  ?>
                                                
                                              <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Company</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="companyName" type="text" readonly value="<?php echo $companyInfo['name']; ?>">
                                                    <input  name="companyId" type="hidden"   value="<?php echo $companyInfo['id']; ?>">
                                                </div>
                                            </div>  
                                                
                                            <?php }else {  ?>
                                             <div class="form-group">
                                            <label> Company</label>
                                            <select class="form-control" name="companyId" >
                                                <option>Select</option>
                                                
                                                <?php 
                                                if($companies != null){
                                                    
                                                    foreach ($companies as $company){   echo  '<option value='.  $company['id'].'>'.$company['name'].'</option>'; }
                                                }
                                                ?>
                                           
                                            </select>
                                        </div>
                                            <?php }?>
                                       
                                      
                                        
                                         <div class="form-group">
                                            <label>Service Name</label>
                                            <input class="form-control"  name="title"  />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Shortcode</label>
                                            <input class="form-control"  name="code"  />
                                        </div>
                                        
                                        
                                           <div class="form-group">
                                            <label> Provider</label>
                                            <select class="form-control" name="vendorID" >
                                                <option>Select</option>
                                                
                                                <?php 
                                                if($vendors != null){
                                                    
                                                    foreach ($vendors as $vendor){    echo '<option value='.$vendor['id'].'>'.$vendor['name'].'</option>'; }
                                                }
                                                ?>
                                           
                                            </select>
                                        </div>
                                       
                                       
                                        <button type="submit" class="btn btn-default">Register</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

     
     <script src="../../js/datetimepicker/jquery2.js"></script>
        <script src="../../js/datetimepicker/jquery.datetimepicker.js"></script>
        
         <script>
        var $i = jQuery.noConflict();
        $i('#datetimepicker1').datetimepicker({timepicker:false,format:'Y-m-d'});
          </script>

</body>

</html>
