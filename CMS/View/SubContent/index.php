<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SubContent.php');
require_once('../../SDPAccess/AccessControl/SubContent/SubContentControl.php');

require_once('../../SDPAccess/Model/Content.php');
require_once('../../SDPAccess/AccessControl/Content/ContentControl.php');

$mainContentId = General::cleanGet("contentId") ;

$mainContents = ContentControl::getContents();
 
$subContents = SubContentControl::getSubContents($mainContentId);
 
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Management - Sub Services</title>

    <?php include '../Include/header_files.php'; ?>
      <!-- DataTables CSS -->
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
                   <?php $pageKey = PageKey::$PAGE_SUB_CONTENT; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Sub Services
                            <a  href="add_content.php" class="btn btn-primary"  style="float: right;"> Add Sub Service  </a>
                        </h1>
                        
                        <?php include '../Include/session_message.php'; ?>

                        <form role="form" action="index.php" method="get">
                                  
                                        <div class="form-group" style="width:200px; float: left;">
                                            <label>Main Service </label>
                                            <select class="form-control" name="contentId" >
                                                <option value="0" >All</option>
                                                
                                                <?php 
                                                if($mainContents != null){
                                                    
                                                    foreach ($mainContents as $service){?>
                                                        
                                                <option value="<?php echo $service['id']; ?>" <?php if( $service['id'] == $mainContentId){ echo "selected" ;} ?>><?php echo $service['title']; ?></option>
                                                    <?php }
                                                }
                                                ?>
                                        
                                            </select>
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
                          Sub Services 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php 
                            if($subContents != null){
                                
                                $contentTypes = General::getContentTypes();
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Service</th>
                                        <th>Sub Services</th>
                                        <th> Type</th>
                                        <th> Msg/Day</th>
                                        <th> Content length</th>
                                        <th> Approved Required</th>
                                        <th>Edit</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($subContents as $content){ ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $content['id']; ?></td>
                                         <td><?php echo $content['contentTitle']; ?></td>
                                         <td><?php echo $content['title']; ?></td>
                                         <td><?php echo $contentTypes[$content['content_type']-1][1]; ?></td>
                                         <td><?php echo $content['msg_per_day']; ?></td>
                                         <td><?php echo $content['content_length']; ?></td>
                                         <td><?php if($content['need_approval'] == 1){echo "Yes";} else {echo "No" ; } ?></td>

                                         <td><a href="edit_content.php?id=<?php echo $content['id'] ?>" class="btn btn-link " style="padding: 0px;" > Edit </a></td>
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
    
     <!-- DataTables JavaScript -->
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
