<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Content.php');
require_once('../../SDPAccess/AccessControl/Content/ContentControl.php');
 
$contents = ContentControl::getContents();
 
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Management - Services</title>

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
                   <?php $pageKey = PageKey::$PAGE_MAIN_CONTENT; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Main Services
                            <a  href="add_content.php" class="btn btn-primary"  style="float: right;"> Add Service  </a>
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
                            if($contents != null){
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Sub Services</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($contents as $content){ ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $content['id']; ?></td>
                                        <td><?php echo $content['title']; ?></td>
                                        <td><?php echo $content['status']; ?></td>
                                        <td><a href="../SubContent/index.php?contentId=<?php echo $content['id'] ?>" class="btn btn-link " style="padding: 0px;" ><?php echo $content['subCount']; ?> </a></td> 
                                         <td><a href="edit_content.php?id=<?php echo $content['id'] ?>" class="btn btn-link " style="padding: 0px;" > Edit </a></td>
                                         <?php if($content['subCount'] == 0){ ?>
                                         <td><a href="../../Control/Content/DeleteContent.php?id=<?php echo $content['id'] ?>" class="btn btn-link" style="padding: 0px;color: red;" > Delete </a></td>
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

</body>

</html>
