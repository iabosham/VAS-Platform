<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
 require_once('../../SDPAccess/Model/Shortcode.php');
 require_once('../../SDPAccess/Model/Service.php');
 require_once('../../SDPAccess/AccessControl/Shortcode/ShortcodeControl.php');
 require_once('../../SDPAccess/Model/ServiceType.php');
 require_once('../../SDPAccess/AccessControl/ServiceType/ServiceTypeControl.php');
 require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');
 

$serviceId =  General::cleanGet("id");
 
$serviceInfo= ServiceControl::getServiceInfoById($serviceId);

 
 

 
$serviceTypes = ServiceTypeControl::getServiceTypes();
$shortcodes = ShortcodeControl::getShortCodes(Cookie::getCompanyID());

     
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
                        <?php $pageKey = PageKey::$PAGE_SERVICE; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Update Sub Service</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                               From
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                     <?php include '../Include/session_message.php'; ?>
                                    
                                    <form role="form" action="../../Control/Service/UpdateService.php" method="post">
                                      <input type="hidden" name="id" value="<?php echo $serviceInfo['id']; ?>" />
                                        <input type="hidden" name="oldServiceKey" value="<?php echo $serviceInfo['service_key']; ?>" />
                                        
                                          <?php  if(Cookie::getCompanyID() > 0){
                                                $companyInfo = CompanyControl::getCompanyInfo(Cookie::getCompanyID());
                                                  ?>
                                                
                                        <div class="form-group" style="width: 48%; float: left;">
                                                <label class="col-lg-2 control-label" for="focusedInput">Company</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="companyName" type="text" readonly value="<?php echo $companyInfo['name']; ?>">
                                                    <input  name="companyId" type="hidden"   value="<?php echo $companyInfo['id']; ?>">
                                                </div>
                                            </div>  
                                                
                                            <?php }else {  ?>
                                             <div class="form-group" style="width: 48%; float: left; ">
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
                                       
                                      
                                        <div class="form-group" style="width: 48%; float: right;">
                                            <label> Service </label>
                                            <select class="form-control" name="shortcodeID" >
                                                <option>Select</option>
                                                
                                                <?php 
                                                if($shortcodes != null){
                                                    
                                                    foreach ($shortcodes as $shortcode){  
                                                        
                                                         if($shortcode['id'] == $serviceInfo['shortcode_id']){
                                                                  echo '<option value='.$shortcode['id'].' selected>'.$shortcode['companyName']." - ".$shortcode['number'].'</option>';
                                                               }else {
                                                                    echo '<option value='.$shortcode['id'].'>'.$shortcode['companyName']." - ".$shortcode['number'].'</option>';
                                                               }
                                                         }
                                                }
                                                ?>
                                           
                                            </select>
                                        </div>
                                        
                                            <div class="form-group" style="width: 48%; float: left;">
                                            <label>Sub Service Name</label>
                                            <input class="form-control"  name="serviceName" value="<?php echo $serviceInfo['name']; ?>"  />
                                        </div>
                                        
                                          <div class="form-group" style="width: 48%; float: right;"  >
                                            <label> Service Type </label>
                                            <select class="form-control" name="serviceTypeID" >
                                                <option>Select</option>
                                                
                                                <?php 
                                                if($serviceTypes != null){
                                                    
                                                    foreach ($serviceTypes as $serviceType){   
                                                        if($serviceType['id'] == $serviceInfo['service_type_id']){
                                                            echo '<option value='.$serviceType['id'].' selected >'.$serviceType['name'].'</option>';
                                                            }else{
                                                            echo '<option value='.$serviceType['id'].'>'.$serviceType['name'].'</option>';
                                                            }
                                                        }
                                                }
                                                ?>
                                           
                                            </select>
                                        </div>
                                       
                             
                                         <div class="form-group" style="width: 48%; float: left;">
                                            <label>Service Key</label>
                                            <input class="form-control"  name="serviceKey"  value="<?php echo $serviceInfo['service_key']; ?>"   />
                                        </div>
                                        
                                           <div class="form-group" style="width: 48%; float: right;">
                                            <label>  Sender Name</label>
                                            <input class="form-control"  name="senderName" value="<?php echo $serviceInfo['sender_name']; ?>"  />
                                        </div>
                                        
                                        
                                            <div class="form-group" style="width: 48%; float: left;">
                                            <label> Free Source</label>
                                            <input class="form-control"  name="fs" value="<?php echo $serviceInfo['free_source']; ?>" />
                                        </div>
                                   
                                        
                                           <div class="form-group" style="width: 48%; float: right;">
                                            <label>Sending Method</label>
                                            <select class="form-control" name="method" >
                                                <option>Select</option>
                                                
                                                <?php   $methods = General::getServiceMethod();
                                                if($methods != null){
                                                    
                                                    foreach ($methods as $method){   
                                                        if($serviceInfo['service_method'] == $method[0]){
                                                            echo  '<option value='.  $method[0].' selected>'.$method[1].'</option>';
                                                             }else {
                                                             echo  '<option value='.  $method[0].'>'.$method[1].'</option>';
                                                              }
                                                        
                                                    }
                                                }
                                                ?>
                                           
                                            </select>
                                        </div>
                                        
                                         
                                        <div class="form-group">
                                            <label>Subscription Message</label>
                                            <textarea class="form-control" rows="3" cols="1"   name="subMessage"><?php echo $serviceInfo['sub_message']; ?></textarea>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Un Subscription Message</label>
                                            <textarea class="form-control" rows="3" cols="1"   name="unSubMessage"><?php echo $serviceInfo['unsub_message']; ?></textarea>
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
 
        <script type="text/javascript" src="../../js/ajax.js"></script>

</body>

</html>
