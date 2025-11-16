<?php 
session_start();
require_once('../../Control/Include/PublicRequirementClient.php');
require_once('../../SDPAccess/Model/Content.php');
require_once('../../SDPAccess/AccessControl/Content/ContentControl.php');

$services = ContentControl::getContentsByClientId(CookieClient::getUserId());
 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>  Enter Bulk Content </title>
    
    <?php include '../Include/header_files.php'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include '../Include/main_header_client.php'; ?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php $pageKey = PageKey::$ENTER_CONTENT; include '../Include/menu_client.php'; ?>
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
                                    
                                    <form role="form" action="../../Control/ContentMessage/AddContentMessage.php" method="post">
                                 
                                       
                                        
                                         <div class="form-group">
                                            <label>  Service </label>
                                            <select class="form-control" name="contentId" >
                                                <option>Select</option>
                                                
                                                <?php 
                                                if($services != null){
                                                    
                                                    foreach ($services as $service){?>
                                                        
                                                <option  onclick="getSubServicesByServiceId2(<?php echo $service['id']; ?>,'subServiceDiv')" value="<?php echo $service['id']; ?>"><?php echo $service['title']; ?></option>
                                                    <?php }
                                                }
                                                ?>
                                           
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label> Sub Service </label>
                                             <select class="form-control" name="subServiceId" id="subServiceDiv"  >
                                              </select>
                                         </div>
                                         
                                        
                                         <div class="form-group">
                                            <label> Message Order </label>
                                            <select class="form-control" name="orderId" id="countDiv" >
                                           
                                            </select>
                                        </div>
                                         
                                          <div class="form-group">
                                            <label>Messages file(CSV):</label>
                                            <input type="file" name="file" />
                                        </div>
                                        
                                      <div class="form-group">
                                            <label>Ex:</label>
                                            <textarea class="form-control" readonly rows="3" name="msg">
                                            <?php echo  date("Y-m-d").","."السلام عليكم"."\n" ?>
                                            <?php echo  date("Y-m-d").","."Hello" ?>
                                            </textarea>
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
