<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/User.php');
require_once('../../SDPAccess/AccessControl/User/UserControl.php');
 
$users = UserControl::getUsers(2);
 
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Management - User Setting</title>

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
                   <?php $pageKey = PageKey::$PAGE_USER; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">User Setting
                            <a  href="add_user.php" class="btn btn-primary"  style="float: right;"> Add User  </a>
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
                          User Setting
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php 
                            if($users != null){
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>User Name</th>
                                        <th>User Type</th>
                                        <th> User Status</th>
                                         <th>Registration Date</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Edit</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    $userTypes = General::getContentUserTypes();
                                    $userStatus = General::getUserStatus();
                                    
                                    foreach($users as $user){ ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['login']; ?></td>
                                        <td><?php echo $userTypes[$user['user_type']-1][1]; ?></td>
                                        <td style="color:<?php echo $userStatus[$user['status']][2]; ?> ;"><?php echo $userStatus[$user['status']][1]; ?></td>
                                        <td><?php echo $user['creation_date']; ?></td>
                                        <td><?php echo $user['phone']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><a href="edit_user.php?id=<?php echo $user['id'] ?>" class="btn btn-link " style="padding: 0px;" > Edit </a></td>
                                   
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
