<?php
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/DBConnectionArchive.php');

require_once('../../SDPAccess/Model/Inbox.php');

require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');

require_once('../../SDPAccess/Model/MessageHistoryArchive.php');
require_once('../../SDPAccess/AccessControl/MessageHistoryArchive/MessageHistoryArchiveControl.php');


require_once('../../SDPAccess/Model/Lookup.php');
require_once('../../SDPAccess/AccessControl/Lookup/LookupControl.php');

require_once('../../SDPAccess/Model/Company.php');
require_once('../../SDPAccess/AccessControl/SMPP/CompanyControl.php');

$companies= CompanyControl::getCompanies();

  $companyId = General::cleanGet("companyId");
  
  if($companyId == null){
      $companyId = Cookie::getCompanyID();
  }


$states = LookupControl::getStatusLookup();

$fromDate = General::cleanGet("fromDate");
$toDate = General::cleanGet("toDate");
$stateId = General::cleanGet("stateId");
$resendCount = General::cleanGet("resendCount");


if ($fromDate == null) {
     $fromDate = date("Y-m-d 00:00:00");
}

if ($toDate == null) {
     $toDate = date("Y-m-d 23:59:59");
}

if ($stateId == null) {
     $stateId = -1;
}

if ($resendCount == null) {
     $resendCount = -1;
}



$messages = MessageHistoryArchiveControl::getHistoryMessageCounts($stateId, $fromDate, $toDate,$resendCount,$companyId);

 
 
?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SDP - Outbox</title>

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
<?php $pageKey = PageKey::$PAGE_OUTBOX;
include '../Include/menu.php'; ?>
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
                            <h1 class="page-header">Outbox
                            </h1>

                            <?php include '../Include/session_message.php'; ?>

                            <form   action="index.php" method="get">

                                <div class="form-group"  style=" width:170px; float: left;margin-right: 5px;">
                                    <label>From Date</label>
                                    <input class="form-control"  name="fromDate" id="datetimepicker1"  value="<?php echo $fromDate; ?>" />
                                </div>


                                <div class="form-group"  style=" width:170px; float: left; margin-right: 5px;">
                                    <label>To Date</label>
                                    <input class="form-control"  name="toDate" id="datetimepicker2" value="<?php echo $toDate; ?>" />
                                </div>
                                
                                 <?php  if(Cookie::getCompanyID() > 0){
                                                $companyInfo = CompanyControl::getCompanyInfo(Cookie::getCompanyID());
                              ?>
                                                
                            <div class="form-group" style="width:100px; float: left;margin-right: 5px;">
                                    <label>Operator</label>
                                    <div>
                                        <input class="form-control" name="companyName" type="text" readonly value="<?php echo $companyInfo['name']; ?>">
                                        <input  name="companyId" type="hidden"   value="<?php echo $companyInfo['id']; ?>">
                                    </div>
                                </div>  
                                                
                                            <?php }else {  ?>
                                             <div class="form-group" style="width:100px; float: left;margin-right: 5px; ">
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



                                <div class="form-group" style="width:200px; float: left; margin-right: 5px;">
                                    <label> Status </label>
                                    <select class="form-control" name="stateId" >
                                        <option value="-1" >All</option>

                                        <?php
                                        if ($states != null) {

                                            foreach ($states as $state) {
                                                ?>

                                                <option value="<?php echo $state['status_code']; ?>" <?php if ($state['status_code'] == $stateId) {
                                            echo "selected";
                                        } ?>><?php echo  $state['status_name']; ?></option>
                                            <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                
                                  <div class="form-group" style="width:200px; float: left;">
                                    <label> Round </label>
                                    <select class="form-control" name="resendCount" >
                                        <option value="-1" >All</option>

                                        <?php
                                        
                                             $rounds= General::getRounds();

                                            foreach ($rounds as $round) {
                                                ?>

                                                <option value="<?php echo $round[0]; ?>" <?php if ($round[0] == $resendCount) {
                                            echo "selected";
                                        } ?>><?php echo  $round[1]; ?></option>
                                            <?php
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
                                    Outbox
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">

                                    <?php
                                    if ($messages != null) {
                                        ?>
                                        <table width="100%" class="table table-striped table-bordered table-hover"  >
                                            <thead>
                                                <tr>
                                                   
                                                    <th> Operator  </th>
                                                   
                                                     <th>  # </th>
                                                     <th>  Status </th>
                                                    <th>  MSG Count </th>
                                                   

                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php 
                                             $rounds = General::getRounds();
                                                 
                                              foreach ($messages as $row) {                                              ?>
                                                    <tr class="odd gradeX">
                                                       
                                                        <td><?php echo $row['operatorName'] ?></td>
                                                        
                                                        <td style="color: #fff; background: <?php echo $rounds[$row['resend_count']][2]; ?>" ><?php echo $rounds[$row['resend_count']][1]; ?></td>
                                                          <td><?php echo $row['status_name'] ?></td>
                                                        <td><?php echo $row['counts'] ?></td>
                                                       

                                                    </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>

                                            <?php }else { ?> <h5>Outbox is empty</h5> <?php } ?>
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
