<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ContentMessage.php');
require_once('../../SDPAccess/AccessControl/ContentMessage/ContentMessageControl.php');

$id = General::cleanGet("id");
$contentInfo = ContentMessageControl::getContentMessageInfoById($id);
 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Service </title>
    
    <?php include '../Include/header_files.php'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include '../Include/main_header.php'; ?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php $pageKey = PageKey::$MESSAGE_CONTENT_ADMIN; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Edit Message </h1>
                         <?php include '../Include/session_message.php'; ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Message Form Elements
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="../../Control/ContentMessage/EditContentMessage.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                                        <div class="form-group">
                                            <label>Service  </label>
                                            <input class="form-control" readonly value="<?php echo $contentInfo['serviceTitle']; ?>" name="title" />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Sub Service  </label>
                                            <input class="form-control" readonly value="<?php echo $contentInfo['subTitle']; ?>" name="title" />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label> Message Order </label>
                                            <select class="form-control" name="orderId" id="countDiv" >
                                                 <?php
                                                    $messageCounts = General::getMessageOrders();
                                                    for($i=0;$i<$contentInfo['msg_per_day'];$i++) {?>
                                                <option value="<?php echo ($i+1); ?>" <?php if($contentInfo['serial_id'] ==($i+1) ){echo "selected"; } ?> ><?php echo $messageCounts[$i][1]  ?> </option> 
                                                   <?php }
                                          
                                               ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group"  >
                                            <label>Send Date</label>
                                            <input class="form-control"  name="sendDate" id="datetimepicker1" value="<?php echo $contentInfo['sending_date'] ; ?>" />
                                        </div>
                                        
                                        <div class="form-group"  >
                                            <label> Message</label>
                                            <textarea class="form-control" dir="rtl" name="msg" style="text-align: center;" ><?php echo $contentInfo['msg'] ; ?></textarea>
                                         </div>
                                        
                                       
                                         
                                        <button type="submit" class="btn btn-default">Submit</button>
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

    <?php include '../Include/footer.php'; ?>
    
       <script src="../../js/datetimepicker/jquery2.js"></script>
        <script src="../../js/datetimepicker/jquery.datetimepicker.js"></script>
        
         <script>
        var $i = jQuery.noConflict();
        $i('#datetimepicker1').datetimepicker({format:'Y-m-d H:i:s'});
           </script>


</body>

</html>
