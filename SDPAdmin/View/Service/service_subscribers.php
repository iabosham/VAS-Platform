<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/Model/Subscriber.php');
require_once('../../SDPAccess/Model/ServiceSubscription.php');
require_once('../../SDPAccess/AccessControl/Subscriber/SubscriberControl.php');

require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');
require_once('../../SDPAccess/AccessControl/ServiceSubscription/ServiceSubscriptionControl.php');

require_once('../../SDPAccess/Model/Company.php');
require_once('../../SDPAccess/AccessControl/SMPP/CompanyControl.php');

$companies= CompanyControl::getCompanies();

  $companyId = General::cleanGet("companyId");
  
  if($companyId == null){
      $companyId = Cookie::getCompanyID();
  }
 
$fromDate = General::cleanGet("fromDate");
$toDate = General::cleanGet("toDate");
$stateId = General::cleanGet("stateId");
 
 $subscribers = ServiceSubscriptionControl::getSerivceSubscribersCount(0,$fromDate,$toDate, $companyId,$stateId);
 $count = SubscriberControl::getSubscribersOfSerivceCount(0,$fromDate,$toDate, $companyId,$stateId);
   
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Management - Subscribers</title>

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
                   <?php $pageKey = PageKey::$PAGE_SUBSCRIPTION; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Subscription Counts
                            <a  href="#" style="float: right;"> Total ( <?php echo  ($count['count']); ?> ) </a>
                        </h1>
                        
                        <?php include '../Include/session_message.php'; ?>

                        <form   action="service_subscribers.php" method="get">
                            
                              <?php  if(Cookie::getCompanyID() > 0){
                                                $companyInfo = CompanyControl::getCompanyInfo(Cookie::getCompanyID());
                              ?>
                                                
                            <div class="form-group" style="width:200px; float: left;">
                                    <label>Operator</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" name="companyName" type="text" readonly value="<?php echo $companyInfo['name']; ?>">
                                        <input  name="companyId" type="hidden"   value="<?php echo $companyInfo['id']; ?>">
                                    </div>
                                </div>  
                                                
                                            <?php }else {  ?>
                                             <div class="form-group" style="width:200px; float: left;margin-right: 5px; ">
                                            <label> Operator</label>
                                            <select class="form-control" name="companyId" >
                                                <option value="0">All </option>
                                                
                                                <?php 
                                                if($companies != null){
                                                    
                                                    
                                                    foreach ($companies as $company){  
                                                        
                                                        $select = "";
                                                            if($company['id'] == $companyId){
                                                                $select = "selected";
                                                            }
                                                        
                                                        echo  '<option value='.  $company['id'].'   '.$select.'  >'.$company['name'].'</option>';
                                                        }
                                                }
                                                ?>
                                           
                                            </select>
                                        </div>
                                            <?php }?>
                            
                               <div class="form-group" style="width:200px; float: left;margin-right: 5px; ">
                                    <label> Subscriber Status </label>
                                    <select class="form-control" name="stateId" >

                                        <?php
                                        
                                          $states = General::getSubscriberStatus();

                                            foreach ($states as $state) {
                                                ?>

                                                <option onclick="setDatesEmpty(<?php echo $state[0]; ?>);" value="<?php echo $state[0]; ?>" <?php if ($state[0] == $stateId) {
                                            echo "selected";
                                        } ?>><?php echo  $state[1]; ?></option>
                                            <?php
                                            }
                                        
                                        ?>

                                    </select>
                                </div>

                            
                              <div class="form-group"  style=" width:170px; float: left;margin-right: 5px;">
                                    <label>From Date</label>
                                    <input class="form-control"  name="fromDate" id="datetimepicker1"  value="<?php echo $fromDate; ?>" />
                                </div>


                                <div class="form-group"  style=" width:170px; float: left; margin-right: 5px;">
                                    <label>To Date</label>
                                    <input class="form-control"  name="toDate" id="datetimepicker2" value="<?php echo $toDate; ?>" />
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
                       Counts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php   
                            if($subscribers != null){
                                
                              
                            ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                          
                                                <th> Operator </th>
                                                <th> Main Service</th>
                                                <th> Sub Service</th>
                                                 <th>Subscribers Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                           if($subscribers != null){
                                               foreach ($subscribers as $row) {?>
                                            <tr>
                                                <td><?php echo $row['operatorName'] ?></td>
                                                <td><?php echo $row['title'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['counts'] ?></td>
                                                
                                            </tr>
                                           <?php } } ?>
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
 
    
     <script src="../../js/datetimepicker/jquery2.js"></script>
        <script src="../../js/datetimepicker/jquery.datetimepicker.js"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });

            var $i = jQuery.noConflict();
            $i('#datetimepicker1').datetimepicker({format: 'Y-m-d H:i:s'});
            $i('#datetimepicker2').datetimepicker({format: 'Y-m-d H:i:s'});
        </script>
</body>

</html>
