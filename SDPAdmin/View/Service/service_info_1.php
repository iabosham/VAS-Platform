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
        
       <link rel="stylesheet" type="text/css" href="../../js/datetimepicker/jquery.datetimepicker.css"/>


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
                                    <li class="active"><?php echo $serviceInfo['name'] ;  ?></li>
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
                                    <div class="pull-right">Subscribers count <span class="badge"> <?php echo $count; ?></span></div>
                                </div>
                                <div class="panel-body" style="margin: 0px;padding-left: 10px;">
                                         
                        <div class="row" style="width: 55%;float: left;" >
                        <div class="col-lg-12">
                         
                              <div class="panel panel-default" style="margin: 0px; ">
                               
                                  <div class="bootstrap-admin-panel-content" style="margin: 0px;">
                                    <h3><?php echo "Service : ".$serviceInfo['name']; ?></h3>
                                    <table class="table" >
                                        <thead>
                                            <tr>
                                                
                                                <th colspan="2" style="border: 0px;" ></th>
                                              
                                            </tr>
                                        </thead>
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
                                                <td><?php echo General::getServiceMethod()[$serviceInfo['service_method']-1][1] ; ?></td>
                                           
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
                                    
                                  </div>
                                  
                                  
                                    <div class="bootstrap-admin-panel-content" style="margin: 0px;">
                                          <h4><?php echo "Service keys:"; ?></h4>
                                          
                                          <form action="../../Control/Service/AddKey.php" method="post">
                                             <input type="hidden" name="serviceID" value="<?php echo $serviceInfo['id']; ?> " />
                                             <input class="form-control" style="width: 70%;float: left; " name="key" type="text" placeholder="Enter a key here "  />
                                             <button class="btn btn-primary" style="float: right;width: 20%;" >  Add </button>
                                          
                                            
                                        </form>
                                        
                                    </div>
                                  
                                   <div class="bootstrap-admin-panel-content"  style="margin: 0px;">
                                  
                                    <?php if($keys != null){ ?>
                                    <table class="table" >
                                        <thead>
                                            <tr>
                                                
                                                <th colspan="2" style="border: 0px;" ></th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach($keys as $key){ ?>
                                            <tr>
                                                <td>Key</td>
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
                                                </td>
                                            </tr>
                                             <?php } ?>
                                            
                                             
                                       
                                            
                                        </tbody>
                                    </table>
                                    
                                   
                                    <?php } ?>
                             </div>
                                  
                                
                                
                            </div>
                        </div>
                         </div>
                                         
                        <div class="row" style="width: 50%;float: right;" >
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                               
                                     <table class="table">
                                        <thead>
                                            <tr>
                                                
                                                <th colspan="2" >Service Subscribers </th>
                                               
                                            </tr>
                                            
                                             <tr >
                                        <form action="../../Control/Service/UpdateStatus.php" method="post">
                                            <input type="hidden" name="shortcodeId" value="<?php echo $id ; ?>" />
                                                 <th style="border: 0px;" >
                                                     <input type="hidden" name="serviceID" value="<?php echo $serviceInfo['id']; ?> " />
                                                     <input type="hidden" name="status" value=<?php if($serviceInfo['isActive'] == 1){echo 0;}else {echo 1;} ?> />
                                                     <input class="form-control" name="comment" type="text" placeholder="Comment... "  />
                                                 </th >
                                                <th style="float: right;border: 0px;" >
                                                    <a href="#"> 
                                                        <button class="btn btn-warning" ><?php if($serviceInfo['isActive'] == 1){echo 'Deactivate';}else {echo 'Active';} ?></button>
                                                    </a>
                                                </th>
                                        </form>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                 
                                
                               
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
                               
                                
                                 <div class="bootstrap-admin-panel-content">
                                      <?php   if($resendConfig != null){ ?>
                                    <table class="table table-striped table-bordered"   >
                                        <thead>
                                            <tr>
                                                <th>Attemp Count</th>
                                                <th>Time</th>
                                                 
                                            </tr>
                                        </thead>
                                      
                                        <tbody>
                                            <?php 
                                                 
                                                foreach($resendConfig as $config){
                                                    
                                                    echo '<tr><td>' ;
                                                     echo $config['attemp_number'] ;
                                                    echo '</td><td>' ;
                                                     echo $config['send_time'] ;
                                                    echo '</td></tr>' ;
                                                }
                                        
                                               
                                              ?>
                                         </tbody>
                                       
                                    </table>
                                      <?php } else {
                                             echo "<tr><td colspan=2> There is no Subscribers for this service"  ;
                                                  echo '</td></tr>' ;  
                                        }?>
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

       <script type="text/javascript" src="../../js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="../../vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../js/DT_bootstrap.js"></script>
        
        <script src="../../js/datetimepicker/jquery2.js"></script>
        <script src="../../js/datetimepicker/jquery.datetimepicker.js"></script>
        
         <script>
        var $i = jQuery.noConflict();
        $i('#datetimepicker1').datetimepicker({datepicker:false,format:'H:i:s'});
          </script>
    </body>
</html>
