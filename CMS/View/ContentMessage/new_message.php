<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Content.php');
require_once('../../SDPAccess/AccessControl/Content/ContentControl.php');

$services = ContentControl::getContents();
 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>  Enter Content </title>
    
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
                        <?php $pageKey = PageKey::$ENTER_CONTENT; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Enter Content</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Form
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                     <?php include '../Include/session_message.php'; ?>
                                    
                                    <form role="form" action="../../Control/ContentMessage/AddContentMessageAdmin.php" method="post" enctype="multipart/form-data" >
                                 
                                       
                                        
                                         <div class="form-group">
                                            <label>  Service </label>
                                            <select class="form-control" name="contentId" id="contentId" onchange="getSubServicesByServiceId2(this);" >
                                                <option>Select</option>
                                                
                                                <?php 
                                                if($services != null){
                                                    
                                                    foreach ($services as $service){?>
                                                        
                                                <option  value="<?php echo $service['id']; ?>"><?php echo $service['title']; ?></option>
                                                    <?php }
                                                }
                                                ?>
                                           
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label> Sub Service </label>
                                             <select class="form-control" name="subServiceId" id="subServiceDiv"  onchange="getMessageOrders(this);"  >
                                              </select>
                                         </div>
                                         
                                        
                                         <div class="form-group">
                                            <label> Content Type </label>
                                            <select class="form-control" name="contentType" id="contentType" onchange="contentTypeCheck(this);">
                                                <option   value="1">Single</option>
                                                <option   value="2">Bulk</option>
                                                <option   value="3">WAP</option>
                                                
                                            </select>
                                         </div>
                                        
                                         <div class="form-group"  id="orderDiv">
                                            <label> Message Order </label>
                                            <select class="form-control" name="orderId" id="countDiv" >
                                           
                                            </select>
                                        </div>
                                        
                                               <div id="singleDiv">
                                            
                                         <div class="form-group">
                                            <label>Send Date</label>
                                            <input class="form-control"  name="sendDate" id="datetimepicker1" />
                                        </div>
                                 
                                        
                                      <div class="form-group">
                                            <label>Message</label>
                                            <textarea class="form-control" rows="3" name="msg" style="text-align: center;"></textarea>
                                        </div>
                                            
                                        </div>  
                                        
                                        <div id="bulkDiv" style="visibility: hidden;display: none;">
                                             
                                       <div class="form-group">
                                            <label>Messages file(xls):</label>
                                            <input type="file" name="bulk_file" />
                                        </div>
                                        
                                      <div class="form-group">
                                            <label>Ex:</label>
                                            <a href="../../lib/PHPExcel-1.8/Classes/PHPExcel/Bulk_SMS.xls" > Download Bulk SMS Template</a>
                                        </div>
                                            
                                        </div>  
                                        
                                         <div id="wapDiv" style="visibility: hidden;display: none;">
                                             
                                       <div class="form-group">
                                            <label>Media file:</label>
                                            <input type="file" name="media_file" id="fileUpload" />
                                        </div>
                                       
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
        $i('#datetimepicker1').datetimepicker({timepicker:false,format:'Y-m-d'});
          </script>
         
</body>

</html>
