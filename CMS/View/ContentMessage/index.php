<?php 
session_start();
require_once('../../Control/Include/PublicRequirementClient.php');
require_once('../../SDPAccess/Model/ContentMessage.php');
require_once('../../SDPAccess/AccessControl/ContentMessage/ContentMessageControl.php');
 

if(isset($_POST['fromDate'])){
    $from = General::clean('fromDate') ;
} else {
     $from =  date("Y-m-d 00:00:00") ;
}

 
if(isset($_POST['toDate']) ) {
    $to = General::clean('toDate') ;
} else {
    $to = date("Y-m-d 23:59:00") ;
}

 $contents = ContentMessageControl::getContentMessagesByClientId($from,$to,CookieClient::getUserId());

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alwesam CMS - Outbox</title>

    <?php include '../Include/header_files.php'; ?>
    
       <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
          <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

          <?php include '../Include/main_header_client.php'; ?>
              
            <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                   <?php $pageKey = PageKey::$PAGE_MAIN_CONTENT; include '../Include/menu_client.php'; ?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
              
          </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Outbox
                            <a  href="new_content.php" class="btn btn-primary"  style="float: right;"> Enter Content  </a>
                        </h1>
                      <?php include '../Include/session_message.php'; ?>
                    </div>
                    
                    
                   
                    <!-- /.col-lg-12 -->
                </div>
                
                  <div class="row">
                      <div class="col-lg-12">
                          
                           <form role="form" action="index.php" method="post">
                            <div class="form-group"  style=" width:160px; float: left;">
                                            <label>From</label>
                                            <input class="form-control"  name="fromDate" id="datetimepicker1" value="<?php echo $from ; ?>" />
                                        </div>
                             
                                <div class="form-group"  style="margin-left: 5px; width:160px; float: left;">
                                            <label>To Date</label>
                                            <input class="form-control"  name="toDate" id="datetimepicker2" value="<?php echo $to; ?>" />
                                        </div>
                          
                                  <button type="submit" class="btn btn-primary" style=" float: left; margin-left: 10px; margin-top: 25px;">Get</button>
                           </form>
                          
                      </div>
                      
                  </div>
                    <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Content Messages
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php 
                            if($contents != null){
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Service</th>
                                        <th>Sub Service</th>
                                        <th>Message</th>
                                        <th>Serial</th>
                                        <th>Send Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    $orders = General::getMessageOrders();
                                    $contentMesaageStatus = General::getContentMessageStatus();
                                    $approvalStatus = General::getApprovalStatus();
                                    
                                    foreach($contents as $content){ ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $content['id']; ?></td>
                                        <td><?php echo $content['contentTitle']; ?></td>
                                        <td><?php echo $content['subContentTitle']; ?></td>
                                        <td><?php echo $content['msg']; ?></td>
                                        <td><?php echo $orders[$content['serial_id']-1][1]; ?></td>
                                        <td><?php echo $content['sending_date']; ?></td>
                                       
                                          <td><a href="edit_content.php?id=<?php echo $content['id'] ?>" class="btn btn-link " style="padding: 0px;" > Edit </a></td>
                                         <?php if($content['status'] == 0){ ?>
                                          <td><a href="../../Control/ContentMessage/DeleteMessageContentClient.php?id=<?php echo $content['id'] ?>" class="btn btn-link" style="padding: 0px;color: red;" > Delete </a></td>
                                         <?php } else {
                                             echo "<td> - </td>" ; 
                                         }?>
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

 <?php include '../Include/footer.php'; ?>
    
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
 <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
    
       <script src="../../js/datetimepicker/jquery2.js"></script>
        <script src="../../js/datetimepicker/jquery.datetimepicker.js"></script>
        
         <script>
        var $i = jQuery.noConflict();
        $i('#datetimepicker1').datetimepicker({format:'Y-m-d H:i:s'});
         $i('#datetimepicker2').datetimepicker({format:'Y-m-d H:i:s'});
    
          </script>

</body>

</html>
