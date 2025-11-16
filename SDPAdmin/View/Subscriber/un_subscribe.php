<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServiceSubscription.php');
require_once('../../SDPAccess/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php');


$msisdn = General::cleanGet("msisdn");
$services = null ;

if($msisdn != null && is_numeric($msisdn)){
   $services = ServiceSubscriptionControl::getSubscriberServices($msisdn);
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

    <title>Alwesam SDP | Un subscribe</title>

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
                        <h1 class="page-header">Un-subscribe  </h1>
                        
                        <?php include '../Include/session_message.php'; ?>
                        
                        <form role="form" action="un_subscribe.php" method="get">
                             
                                 <div class="form-group"  style=" width:160px; float: left;">
                                            <label>Customer's Number</label>
                                            <input class="form-control"  name="msisdn" id="datetimepicker1" value="<?php echo $msisdn ; ?>" />
                                        </div>
                         
                                         
                                        <button type="submit" class="btn btn-default" style=" float: left; margin-left: 10px; margin-top: 25px;">Get</button>
                     </form>
 
                    </div>
                    
                    
                   
                    <!-- /.col-lg-12 -->
                </div>
            
                    <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Subscriber services

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php  
                            if($services != null){
                                
                               
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                                <th> Service</th>
                                                 <th>Key</th>
                                                  <th>Subscription Date</th>
                                                  <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $count = 0;  foreach($services as $row){  $count++; ?>
                                    <tr class="odd gradeX">
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['service_key'] ?></td>
                                                <td><?php echo $row['subscription_date'] ?></td>
                                                <td>
                                                    
                                                     <form  action="../../Control/ServiceSubscription/UnSubscribe.php" method="post" >
                                                   <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                                    <input type="hidden" name="msisdn" value="<?php echo $msisdn; ?>" />
                                                     <button class="btn btn-link ">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                      Un-Subscribe
                                                   </button>
                                                   </form>
                                                 
                                                </td>

                                         </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            
                            <?php } ?>
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
