<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Shortcode.php');
require_once('../../SDPAccess/Model/ShortcodeConnection.php');
require_once('../../SDPAccess/Model/SMPPConnectionDataSource.php');
require_once('../../SDPAccess/Model/Sender.php');
require_once('../../SDPAccess/AccessControl/Shortcode/ShortcodeControl.php');
require_once('../../SDPAccess/AccessControl/Sender/SenderControl.php');

   $id = General::cleanGet("id");
$shortcodeInfo = ShortcodeControl::getShortcodeInfoById($id);
 
 $shortcodeConnection = new ShortcodeConnectionDataSource();
$connections = $shortcodeConnection->getConnectionsByShortCodeIdData($id);
$shortcodeConnection->close();
$smppConnection = new SMPPConnectionDataSource();
$smpps = $smppConnection->getSMPPConnectionsByCompanyIdData($shortcodeInfo['company_id']);

?>
<!DOCTYPE html>
<html lang="en">

    <head>

     
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alwesam SDP | Services</title>

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
                            <?php $pageKey = PageKey::$PAGE_SHORTCODE;
                            include '../Include/menu.php';
                            ?>
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
                            <h1 class="page-header">Services</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            
                              <?php include '../Include/session_message.php'; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  Trans
                                </div>
                        
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                          <div class="panel">
                               
                                <div class="bootstrap-admin-panel-content">
                                      <h3><?php echo "Shortcode : ".$shortcodeInfo['number']; ?></h3>
                                       <table class="table" style="direction: ltr;text-align: left;">
                                        <thead>
                                          <tr>
                                                <td>Provider</td>
                                                <td><?php echo $shortcodeInfo['vendorName']; ?></td>
                                               
                                            </tr>
                                            <tr class="warning">
                                                <td>Address</td>
                                                <td><?php echo $shortcodeInfo['address']; ?></td>
                                           
                                            </tr>
                                            <tr >
                                                <td>Email</td>
                                                <td><?php echo $shortcodeInfo['email']; ?></td>
                                        
                                            </tr>
                                            <tr class="warning">
                                                <td>Phone</td>
                                                <td><?php echo $shortcodeInfo['phone']; ?></td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                  </div>
                                
                            </div>
                                        </div>

                                        <div class="col-lg-8">

                                            
                                            <div class="panel panel-default" id="providerServices">

                                                <div class="panel-hdeading" style="padding-left: 15px;">
                                                      <h3>Connections</h3> 
                                                </div>
                                                <div class="col-lg-3" style="float: right;" >   
                                             <form action="../../Control/Shortcode/AddConnection.php" method="post" >
                                               <input type="hidden" name="shortcodeId" value="<?php echo $id ; ?>" />
                                                <div class="form-group" style="float: left;">
                                                     <select class="form-control" name="connectionId" >
                                                        <option value="0">Select</option>

                                                        <?php
                                                        if ($smpps != null) {

                                                            foreach ($smpps as $smpp) {
                                                                ?>
                                                         <option value="<?php echo $smpp['id']; ?>">  <?php echo $smpp['title']; ?>  </option>
                                                            <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                             
                                               <button type="submit" class="btn btn-default" style="float: right;">Add</button>
                                              
                                              </form>
                                             </div>  
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                  
                                                     <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                               
                                                        <tbody>
                                                         <?php
                                                         if($connections != null){
                                                             
                                                             foreach($connections as $info){ 
                                                                 
                                                                     echo '<tr><td>' ;
                                                    echo $info['id'] ;
                                                    echo '</td><td>' ;
                                                    echo $info['title']."</td>" ; ?>
                                                     <td><a href="../../Control/Shortcode/DeleteConnection.php?id=<?php echo $info['id']; ?>&shortcodeId=<?php echo $id; ?>" class="btn btn-link " style="padding: 0px;" > Remove </a></td>
                                                   
                                                    <?php echo '</tr>' ;
                                                                 
                                                             }
                                                             
                                                         }
                                                         
                                                         ?>   
                                                        </tbody>
                                                    </table>


                                                    <!-- /.table-responsive -->

                                                </div>
                                                <!-- /.panel-body -->
                                            </div>
                                            <!-- /.panel -->
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

 

    </body>

</html>
