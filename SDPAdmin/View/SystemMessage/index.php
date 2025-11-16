<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SystemMessage.php');
require_once('../../SDPAccess/AccessControl/SystemMessage/SystemMessageControl.php');
 
$systemMessages = SystemMessageControl::getSystemMessages();

    
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alwesam SDP | System Message</title>

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
                   <?php $pageKey = PageKey::$SYSTEM_MESSAGE; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">System Messages
                            <a  href="reg_message.php" class="btn btn-primary"  style="float: right;">Register new System Message  </a>
                        </h1>
                        
                        <?php include '../Include/session_message.php'; ?>
 
                    </div>
                    
                    
                   
                    <!-- /.col-lg-12 -->
                </div>
            
                    <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Main Services 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php  
                            if($systemMessages != null){
                                
                               
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                       <th>#</th>
                                                <th> Code</th>
                                                   <th>Title</th>
                                                    <th>Message</th>
                                                   <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($systemMessages as $row){ ?>
                                    <tr class="odd gradeX">
                                                  <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['code'] ?></td>
                                                <td><?php echo $row['description'] ?></td>
                                                 <td><?php echo $row['message'] ?></td>
                                                <td><a href="edit_message.php?code=<?php echo $row['code'] ?>" class="btn btn-link " style="padding: 0px;" > Update </a></td>

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
