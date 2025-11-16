<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Vendor.php');
require_once('../../SDPAccess/AccessControl/Vendor/VendorControl.php');
 

$id = General::cleanGet("id");
$vendorInfo = VendorControl::getVendorInfoByID($id);

    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alwesam SDP | Short codes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-admin-theme-change-size.css">

        <!-- Datatables -->
        <link rel="stylesheet" media="screen" href="../../css/DT_bootstrap.css">

        <!-- HTML5 shim and Respond.../../js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="../../js/html5shiv.../../js"></script>
           <script type="text/javascript" src="../../js/respond.min.../../js"></script>
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
                        <?php $pageKey = PageKey::$PAGE_SERVICE; include '../Include/menu.php'; ?>
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-10">
                    
                       <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="#">Service</a>
                                    </li>
                                    <li>
                                        <a href="#">Information</a>
                                    </li>
                                    <li class="active"><?php echo $vendorInfo['name'] ;  ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                   
 
                    <div class="row">
                        <div class="col-lg-12">
                              <?php include '../Include/success_message.php' ;?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Service Information</div>
                                    <div class="pull-right">Subscribers count <span class="badge"> <?php echo count(0); ?></span></div>
                                </div>
                                <div class="panel-body" style="margin: 0px;padding-left: 10px;">
                                         
                        <div class="row" style="width: 37%;float: left;" >
                        <div class="col-lg-12">
                         
                              <div class="panel panel-default" style="margin: 0px; ">
                               
                                  <div class="bootstrap-admin-panel-content" style="margin: 0px;">
                                    <h3><?php echo "Service : ".$vendorInfo['name']; ?></h3>
                                      <table class="table">
                                        <thead>
                                            <tr>
                                                
                                                <th colspan="2" style="border: 0px;" ></th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Shortcode</td>
                                                <td><?php echo $vendorInfo['address']; ?></td>
                                               
                                            </tr>
                                            <tr class="warning">
                                                <td>Service Key</td>
                                                <td><?php echo $vendorInfo['phone']; ?></td>
                                           
                                            </tr>
                                            
                                             <tr class="warning">
                                                <td>Service Number</td>
                                                <td><?php echo $vendorInfo['email']; ?></td>
                                           
                                            </tr>
                                            
                                               <tr class="warning">
                                                <td>Service Date</td>
                                                <td><?php echo $vendorInfo['email']; ?></td>
                                           
                                            </tr>
                                            
                                              <tr class="warning">
                                                <td>Description</td>
                                                <td><?php echo $vendorInfo['description']; ?></td>
                                           
                                            </tr>
                                            
                                              <tr class="warning" >
                                                  <td colspan="2">Description</td>
                                            
                                            </tr>
                                            
                                           
                                          
                                             
                                        </tbody>
                                    </table>
                                    
                                  </div>
                                
                            </div>
                        </div>
                         </div>
                                         
                        <div class="row" style="width: 68%;float: right;" >
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                               
                                    <div class="bootstrap-admin-panel-content">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                
                                                <th colspan="2" >Service Subscribers </th>
                                               
                                            </tr>
                                            
                                             <tr>
                                        <form action="../../Control/Service/UpdateStatus.php" method="post">
                                            <input type="hidden" name="shortcodeId" value="<?php echo $id ; ?>" />
                                                 <th style="border: 0px;">
                                                     <input type="hidden" name="serviceID" value="<?php echo $vendorInfo['id']; ?> " />
                                                     <input type="hidden" name="status" value=<?php if($vendorInfo['status'] == 1){echo 0;}else {echo 1;} ?> />
                                                     <input class="form-control" name="comment" type="text" placeholder="Comment... "  />
                                                 </th >
                                                <th style="float: right;border: 0px;" >
                                                    <a href="#"> 
                                                        <button class="btn btn-warning" ><?php if($vendorInfo['status'] == 1){echo 'Deactivate';}else {echo 'Active';} ?></button>
                                                    </a>
                                                </th>
                                        </form>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                                
                                 <div class="bootstrap-admin-panel-content">
                                    
                                 </div>
                            
                            </div>
                        </div>
                    </div>
                            
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                      
 

                       
                    </div>
                </div>
            </div>
        </div>

       <?php include '../Include/footer.php'; ?>

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="../../vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../js/DT_bootstrap.js"></script>
    </body>
</html>
