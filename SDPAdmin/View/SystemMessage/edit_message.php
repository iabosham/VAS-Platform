<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SystemMessage.php');
require_once('../../SDPAccess/AccessControl/SystemMessage/SystemMessageControl.php');

 $code = General::cleanGet("code");
 
$messageInfo = SystemMessageControl::getSystemMessagesByCode($code);
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alwesam SDP | System</title>

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
                        <?php $pageKey = PageKey::$SYSTEM_MESSAGE; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Updating System Message</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         Update message form
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                     <?php include '../Include/session_message.php'; ?>
                                    
                                    <form role="form" action="../../Control/SystemMessage/UpdateSystemMessage.php" method="post">
                                     <input type="hidden" name="id" value="<?php echo $messageInfo['id']; ?>" />

                                 
                                         <div class="form-group">
                                            <label>Title</label>
                                            <input class="form-control"  name="desc" value="<?php echo $messageInfo['description']; ?>"   />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>code</label>
                                            <input class="form-control"  name="code" value="<?php echo $messageInfo['code']; ?>"   />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea class="form-control" rows="10" cols="1"  name="message" ><?php echo $messageInfo['message']; ?></textarea>
                                        </div>
                                     
                                       
                                        <button type="submit" class="btn btn-default">Update Message</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
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
        $i('#datetimepicker1').datetimepicker({timepicker:false,format:'Y-m-d'});
          </script>

</body>

</html>
