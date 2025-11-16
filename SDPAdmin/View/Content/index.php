<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');

require_once('../../SDPAccess/Model/Shortcode.php');
require_once('../../SDPAccess/AccessControl/Shortcode/ShortcodeControl.php');

require_once('../../SDPAccess/Model/Message.php');
require_once('../../SDPAccess/AccessControl/Message/MessageControl.php');

$fromDate = General::cleanGet("fromDate");
$toDate = General::cleanGet("toDate");
$serviceId = General::cleanGet("serviceId");


if ($fromDate == null) {
     $fromDate = date("Y-m-d 00:00:00");
}

if ($toDate == null) {
     $toDate = date("Y-m-d 23:59:59");
}
 
$services = ServiceControl::getServices(0, $shortcodeId, Cookie::getCompanyID());

  
$messages = MessageControl::getMessages($serviceId, $fromDate, $toDate);

print_r($messages);
 
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Management - Content </title>

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
              
            <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                   <?php $pageKey = PageKey::$PAGE_SERVICE; include '../Include/menu.php'; ?>
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
                            <a  href="reg_service.php" class="btn btn-primary"  style="float: right;"> Add Message  </a>
                        </h1>
                        
                        <?php include '../Include/session_message.php'; ?>

                        <form   action="index.php" method="get">
                                  
                                        <div class="form-group" style="width:200px; float: left;">
                                            <label>Main Service </label>
                                            <select class="form-control" name="serviceId" >
                                                <option value="0" >All</option>
                                                
                                                <?php  
                                                if($shortcodes != null){
                                                    
                                                    foreach ($shortcodes as $shortcode){?>
                                                        
                                                    <option value="<?php echo $shortcode['id']; ?>" <?php if( $shortcode['id'] == $shortcodeId){ echo "selected" ;} ?>><?php echo $shortcode['title']; ?></option>
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
                            
                            <?php  $subContents = null;
                            if($services != null){
                                
                                $contentTypes = General::getContentTypes();
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                           <th> ID </th>
                                                <th> Service</th>
                                                <th> Sub Service</th>
                                                 <th>Company</th>
                                                 <th> Key</th>
                                                  <th>Code</th>
                                                  <th># </th>
                                                  <th># </th>
                                                  <th># </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($services as $row){ ?>
                                    <tr class="odd gradeX">
                                              <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['mainServiceName'] ?></td>
                                                <td><?php echo $row['serviceName'] ?></td>
                                                <td><?php echo $row['companyName'] ?></td>
                                                <td><?php echo $row['service_key'] ?></td>
                                                  <td><?php echo $row['number'] ?></td>
                                       

                                         <td><a href="edit_service.php?id=<?php echo $row['id'] ?>" class="btn btn-link " style="padding: 0px;" > Edit </a></td>
                                         <td><a href="service_info.php?id=<?php echo $row['id'] ?>" class="btn btn-link " style="padding: 0px;" > Info </a></td>
                                         <td><a href="service_subscribers.php?id=<?php echo $row['id'] ?>" class="btn btn-link " style="padding: 0px;" > Subscribers </a></td>
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


 <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>

</html>
