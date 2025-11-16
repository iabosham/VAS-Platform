<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Message.php');
require_once('../../SDPAccess/AccessControl/Message/MessageControl.php');

 $code = General::cleanGet("id");
 
$messageInfo = MessageControl::getMessageInfoById($code);

  
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alwesam SDP | Message</title>

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
                        <?php $pageKey = PageKey::$PAGE_MESSAGE; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Updating Message</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         Update Form
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                     <?php include '../Include/session_message.php'; ?>
                                    
                                    <form role="form" action="../../Control/Message/UpdateMessage.php" method="post">
                                     <input type="hidden" name="id" value="<?php echo $messageInfo['id']; ?>" />
                                     <input type="hidden" name="status" value="<?php echo $messageInfo['status']; ?>" />

                                 
                                         <div class="form-group">
                                            <label>Service</label>
                                            <input class="form-control"  readonly name="desc" value="<?php echo $messageInfo['serviceName']; ?>"   />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Shortcode</label>
                                            <input class="form-control" readonly  name="code" value="<?php echo $messageInfo['shortcode']; ?>"   />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea class="form-control" style="text-align: center;" rows="10" cols="1"  name="message" ><?php echo $messageInfo['msg']; ?></textarea>
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
