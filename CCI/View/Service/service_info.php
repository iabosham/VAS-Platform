<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/Model/Subscriber.php');
require_once('../../SDPAccess/Model/ReSendConfig.php');
require_once('../../SDPAccess/Model/ServiceSubscription.php');
require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');
require_once('../../SDPAccess/AccessControl/Subscriber/SubscriberControl.php');
require_once('../../SDPAccess/AccessControl/ReSendConfig/ReSendConfigControl.php');

$id = General::cleanGet("id");
 
$serviceInfo = ServiceControl::getServiceInfoById($id);
 
$resendConfig = ReSendConfigControl::getReSendConfigsInfo($id);

   
  $countInfo = SubscriberControl::getServiceSubscriptionCount($id);
   
  $count = $countInfo['counts']; 
  
  $keys = ServiceControl::getkeysByServiceId($id);
 
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
                            <?php $pageKey = PageKey::$PAGE_SERVICE;
                            include '../Include/menu.php';
                            ?>
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
                            <h1 class="page-header">Service Information</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            
                              <?php include '../Include/session_message.php'; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  Trans
                                </div>
                        
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                          <div class="panel">
                               
                                <div class="bootstrap-admin-panel-content">
                                      <h3><?php echo "Service : ".$serviceInfo['name']; ?></h3>
                                       <table class="table" style="direction: ltr;text-align: left;">
                                           <tbody>
                                         <tr>
                                                <td>Shortcode</td>
                                                <td><?php echo $serviceInfo['number']; ?></td>
                                               
                                            </tr>
                                            
                                             <tr>
                                                <td>Sender Name</td>
                                                <td><?php echo $serviceInfo['sender_name']; ?></td>
                                               
                                            </tr>
                                            
                                            <tr class="warning">
                                                <td>Service Key</td>
                                                <td><?php echo $serviceInfo['service_key']; ?></td>
                                           
                                            </tr>
                                            
                                             <tr class="warning">
                                                <td>Sender Name</td>
                                                <td><?php echo $serviceInfo['sender_name']; ?></td>
                                           
                                            </tr>
                                            
                                            <tr class="warning">
                                                <td>Free Source</td>
                                                <td><?php echo $serviceInfo['free_source']; ?></td>
                                           
                                            </tr>
                                            
                                              <tr class="warning">
                                                <td>Sending Method</td>
                                                <td><?php echo General::getServiceMethod()[$serviceInfo['service_method']][1] ; ?></td>
                                           
                                            </tr>
                                            
                                             <tr class="warning">
                                                <td>Content</td>
                                                <td><?php echo $serviceInfo['contentTitle']; ?></td>
                                           
                                            </tr>
                                            
                                             <tr class="warning">
                                                <td>Sub Content </td>
                                                <td><?php echo $serviceInfo['subContentTitle']; ?></td>
                                           
                                            </tr>
                                            
                                              <tr class="warning">
                                                <td>Status</td>
                                                <td><?php if($serviceInfo['isActive'] == 1){echo 'Active';}else {echo 'Not Active'.'<br />'.$serviceInfo['comment'];} ?></td>
                                           
                                            </tr>
                                            
                                             <tr class="warning">
                                                <td>Provider</td>
                                                <td><?php echo $serviceInfo['vendorName']; ?></td>
                                           
                                            </tr>
                                            
                                          
                                            
                                             
                                             <tr class="warning">
                                                <td>Address</td>
                                                <td><?php echo $serviceInfo['vendorAddress']; ?></td>
                                           
                                            </tr>
                                            
                                           
                                            <tr >
                                                <td>Email</td>
                                                <td><?php echo $serviceInfo['email']; ?></td>
                                        
                                            </tr>
                                            <tr class="warning">
                                                <td>Phone</td>
                                                <td><?php echo $serviceInfo['vendorPhone']; ?></td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                      
                                      
                                      <h3><?php echo "Service keys: " ; ?></h3>
                                      
                                      
                                                <div class="col-lg-6" style="float: right;" >   
                                             <form action="../../Control/Service/AddKey.php" method="post" >
                                             <input type="hidden" name="serviceID" value="<?php echo $serviceInfo['id']; ?> " />
                                              
                                               <button  type="submit" class="btn btn-default" style="  float: right;margin-left: 4px;"> Add </button>
                                                <div class="form-group" style="  float: right;">
                                                   <input class="form-control"  name="key" placeholder="Enter a key here "   />
                                            </div>
                                               
                                               
                                              </form>
                                                    
                                                    
                                             </div> 
                                       <?php if($keys != null){ ?>
                                       
                                        
                                       <table class="table" style="direction: ltr;text-align: left;">
                                           <tbody>
                                               
                                                <?php foreach($keys as $key){ ?>
                                               <tr> <td>Key</td>
                                                <td><?php echo $key['service_key'] ?></td>
                                                <td><?php if($key['key_type'] == 1){ echo "Default"; }else { echo "-"; }  ?></td>
                                                <td>
                                                    
                                                  <?php if($key['key_type'] == 0) {?>   
                                                    <form action="../../Control/Service/RemoveKey.php" method="post">
                                                   <input type="hidden" name="serviceID" value="<?php echo $serviceInfo['id']; ?> " />
                                                   <input type="hidden" name="keyId" value="<?php echo $key['id']; ?> " />
                                                    <button class="btn btn-link"  >  Remove </button>
                                                </form>
                                                  <?php }else { ?> 
                                                      &nbsp; -
                                                  <?php }?>
                                                </td></tr>
                                            
                                                <?php } ?>
                                           </tbody>
                                       </table>
                                        
                                        
                                       <?php } ?>
                                  </div>
                                
                            </div>
                                        </div>

                                        <div class="col-lg-6">

                                            
                                            <div class="panel panel-default" >

                                                <div class="panel-hdeading" style="padding-left: 15px;">
                                                      <h3>Status:  </h3> 
                                                </div>
                                                <div class="col-lg-6" style="float: right;" >   
                                             <form action="../../Control/Service/UpdateStatus.php" method="post" >
                                              <input type="hidden" name="shortcodeId" value="<?php echo $id ; ?>" />
                                              
                                               <input type="hidden" name="serviceID" value="<?php echo $serviceInfo['id']; ?> " />
                                               <input type="hidden" name="status" value=<?php if($serviceInfo['isActive'] == 1){echo 0;}else {echo 1;} ?> />
                                              <button  type="submit" class="btn btn-default" style="  float: right;margin-left: 4px;"><?php if($serviceInfo['isActive'] == 1){echo 'Deactivate';}else {echo 'Active';} ?></button>
                                                <div class="form-group" style="  float: right;">
                                                   <input class="form-control"  name="comment" placeholder="comment..."  />
                                            </div>
                                               
                                               
                                              </form>
                                                    
                                                    
                                             </div>  
                                                
                                                 <table class="table">
                                        <thead>
                                            <tr>
                                                
                                                <th colspan="2" >Re-Send Configuration </th>
                                               
                                            </tr>
                                            
                                            <tr style="padding: 15px;" >
                                        <form action="../../Control/ReSendConfig/AddConfig.php" method="post">
                                            <input type="hidden" name="shortcodeId" value="<?php echo $id ; ?>" />
                                                 <th style="border: 0px;float: left;">
                                                     <input type="hidden" name="serviceID" value="<?php echo $serviceInfo['id']; ?> " />
                                                     Time: <input  name="time" readonly="" style="width: 100px;" id="datetimepicker1"  type="text"  />
                                                 </th>
                                                
                                                 <th>
                                                     Number : <input  name="attemp" style="width: 100px;" type="number" />
                                                 </th>
                                                <th style="float: right;border: 0px;" >
                                                    <a href="#"> 
                                                        <button class="btn btn-group" >Add</button>
                                                    </a>
                                                </th>
                                        </form>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                  
                                                     <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                               
                                                        <tbody>
                                                         <?php
                                                         if($resendConfig != null){
                                                             
                                                             foreach($resendConfig as $config){ 
                                                                 
                                                               echo '<tr><td>' ;
                                                                echo $config['attemp_number'] ;
                                                               echo '</td><td>' ;
                                                                echo $config['send_time'] ;
                                                               echo '</td></tr>' ;
                                                                 
                                                             }
                                                             
                                                         }
                                                         
                                                         ?>   
                                                        </tbody>
                                                    </table>


                                                    <!-- /.table-responsive -->

                                                </div>
                                                <!-- /.panel-body -->
                                            </div>
                                            <!-- /.panel -->
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
        $i('#datetimepicker1').datetimepicker({datepicker:false,format:'H:i:s'});
          </script>

    </body>

</html>
