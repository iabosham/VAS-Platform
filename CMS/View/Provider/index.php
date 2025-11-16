<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Vendor.php');
require_once('../../SDPAccess/AccessControl/Vendor/VendorControl.php');
 
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

    <title>Alwesam CMS - Providers</title>

    <?php include '../Include/header_files.php'; ?>
    
       <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
          <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

          <?php include '../Include/main_header.php'; ?>
              
            <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                   <?php $pageKey = PageKey::$PAGE_PROVIDER; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Content Providers
                            <a  href="add_provider.php" class="btn btn-primary"  style="float: right;"> Add Content Provider  </a>
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
                          Content Providers
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php 
                            if($vendors != null){
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Provider Name</th>
                                        <th>Status</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Description</th>
                                        <th>Edit</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    $userStatus = General::getUserStatus();
                                    foreach($vendors as $vendor){ ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $vendor['id']; ?></td>
                                        <td><?php echo $vendor['name']; ?></td>
                                        <td style="color:<?php echo $userStatus[$vendor['status']][2]; ?> ;"><?php echo $userStatus[$vendor['status']][1]; ?></td>
                                        <td><?php echo $vendor['address']; ?></td>
                                        <td><?php echo $vendor['phone']; ?></td>
                                        <td><?php echo $vendor['email']; ?></td>
                                        <td><?php echo $vendor['description']; ?></td>
                                        <td><a href="edit_provider.php?id=<?php echo $vendor['id'] ?>" class="btn btn-link " style="padding: 0px;" > Edit </a></td>
                                      
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

</body>

</html>
