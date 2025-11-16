<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServiceSubscription.php');
require_once('../../SDPAccess/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php');

require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');

  $id = Cookie::getUserId();
  $pre = Cookie::getPrefix();
  $defConn = Cookie::getSystemID();
  $companyId= Cookie::getCompanyID();
 
    if($id == null){
         header("location: ../../index.php");
         session_write_close();
    }
    
     if($pre == null || $defConn == null){
        Cookie::removeCookies();
        header("location: ../../index.php");
        session_write_close();
    }

$allServices = ServiceControl::getServices($companyId);


$msisdn = General::cleanGet("msisdn");
$services = null ;

if($msisdn != null && is_numeric($msisdn)){
   $services = ServiceSubscriptionControl::getSubscriberServices($msisdn,$companyId);
}else {
   $msisdn = null;   
}
  
    
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alwesam SDP | CCI</title>

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
              
            <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                   <?php $pageKey = PageKey::$UN_SUBSCRIBE; include '../Include/menu.php'; ?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
              
          </nav>

        <!-- Page SubContent -->
        <div id="page-wrapper">
            <div class="container-fluid">
                
                      <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Customer Care Interface</h1>
                        
                        <?php include '../Include/session_message.php'; ?>
                        
                        <form role="form" action="index.php" method="get" style="margin-left: 35%;">
                             
                                 <div class="form-group"  style=" width:30%; float: left;">
                                            <label>Mobile Number </label>
                                            <input class="form-control"  name="msisdn" placeholder="<?php echo $pre;  ?>" id="datetimepicker1" value="<?php echo $msisdn ; ?>" />
                                        </div>
                                         <button type="submit" class="btn btn-primary" style=" float: left; margin-left: 10px; margin-top: 25px;">Get</button>
                     </form>
 
                    </div>
                    
                    
                   
                    <!-- /.col-lg-12 -->
                </div>
            
                    <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Customer services

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php  
                           
                             if($msisdn != null){    
                               
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr>
                                      <th>#</th>
                                                <th> Service</th>
                                                <th> Shortcode</th>
                                                 <th>Sub Key</th>
                                                 <th>unSub Key</th>
                                                   <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $count = 0; 
                                    
                                          if($services != null){
                                    foreach($services as $row){  $count++; ?>
                                    <tr class="odd gradeX">
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['number'] ?></td>
                                                <td><?php echo $row['service_key'] ?></td>
                                                <td><?php echo $row['unsub_key'] ?></td>
                                                 <td>
                                                     
                                                     <form  action="../../Control/ServiceSubscription/UnSubscribe.php" method="post" >
                                                   <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                                   <input type="hidden" name="serviceId" value="<?php echo $row['serviceId']; ?>" />
                                                    <input type="hidden" name="msisdn" value="<?php echo $msisdn; ?>" />
                                                     <button class="btn btn-danger ">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                      unSubscribe
                                                   </button>
                                                   </form>
                                                 
                                                </td>

                                         </tr>
                                         
                                          
                                     <?php }}else { ?>
                                          <tr class="odd gradeX">
                                               <td colspan="6" >This mobile number is not subscribed in Service </td>
                                           </tr>
                                         
                                     <?php  } ?>
                                            <tr class="odd gradeX">
                                               <td colspan="6" > </td>
                                           </tr>
                                           
                                           <tr class="odd gradeX">
                                               <td colspan="6" ><?php echo Cookie::getUserName() ?> Services</td>
                                           </tr>
                                    <?php 
                                    if($allServices != null){
                                        
                                        foreach($allServices as $allService){ $count++; ?>
                                         <tr class="odd gradeX">
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $allService['serviceName'] ?></td>
                                                <td><?php echo $allService['number'] ?></td>
                                                <td><?php echo $allService['service_key'] ?></td>
                                                <td><?php echo $allService['unsub_key'] ?></td>
                                                 <td>
                                                    -
                                                 
                                                </td>

                                         </tr>
                                    <?php }  
                                    
                                    ?>
                                         
                                         
                                </tbody>
                            </table>
                            
                                     <?php }}else { ?>
                            
                            <h4>Enter Mobile Number !!</h4>
                                     <?php }?>
                            <!-- /.table-responsive -->
                   
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


 <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>

</html>
