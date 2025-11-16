<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ContentMessage.php');
require_once('../../SDPAccess/AccessControl/ContentMessage/ContentMessageControl.php');

require_once('../../SDPAccess/Model/Content.php');
require_once('../../SDPAccess/AccessControl/Content/ContentControl.php');

require_once('../../SDPAccess/Model/SubContent.php');
require_once('../../SDPAccess/AccessControl/SubContent/SubContentControl.php');
 

 $serviceId=0; $subServiceId=0; $approveFlag =-1;$contentStaus =-1;

if(isset($_POST['fromDate']) && isValidDate(General::clean('fromDate'))){
    $from = General::clean('fromDate') ;
} else {
     $from =  date("Y-m-d 00:00:00") ;
}

 
if(isset($_POST['toDate']) && isValidDate(General::clean('toDate')) ){
    $to = General::clean('toDate') ;
} else {
    $to = date("Y-m-d 23:59:00") ;
}

if(isset($_POST['serviceId'])){
    $serviceId = General::clean('serviceId') ;
} 

if(isset($_POST['subServiceId'])){
    $subServiceId = General::clean('subServiceId') ;
} 

if(isset($_POST['serviceId'])){
    $serviceId = General::clean('serviceId') ;
} 

if(isset($_POST['serviceId'])){
    $serviceId = General::clean('serviceId') ;
} 

if(isset($_POST['sendStatus'])){
    $contentStaus = General::clean('sendStatus') ;
} 

if(isset($_POST['approveStatus'])){
    $approveFlag = General::clean('approveStatus') ;
} 

 

function isValidDate($date)
{
     $d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return $d && $d->format('Y-m-d H:i:s') === $date;
}


$contents = ContentMessageControl::getContentMessages($from, $to, $serviceId, $subServiceId, $approveFlag,$contentStaus);
 
$mainContents = ContentControl::getContents();

$subContents = SubContentControl::getSubContents($serviceId);
 
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alwesam CMS - Contents</title>

    <?php include '../Include/header_files.php'; ?>
    
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
                   <?php $pageKey = PageKey::$MESSAGE_CONTENT_ADMIN; include '../Include/menu.php'; ?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
              
          </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Contents Messages
                            <a  href="new_message.php" class="btn btn-primary"  style="float: right;"> Enter Content  </a>
                        </h1>
                      <?php include '../Include/session_message.php'; ?>
                        
                        <form role="form" action="content_message.php" method="post">
                             
                                 <div class="form-group"  style=" width:160px; float: left;">
                                            <label>From</label>
                                            <input class="form-control"  name="fromDate" id="datetimepicker1" value="<?php echo $from ; ?>" />
                                        </div>
                             
                                <div class="form-group"  style="margin-left: 5px; width:160px; float: left;">
                                            <label>To Date</label>
                                            <input class="form-control"  name="toDate" id="datetimepicker2" value="<?php echo $to; ?>" />
                                        </div>
                         
                                        <div class="form-group" style="margin-left: 5px; width:150px; float: left;">
                                            <label>  Service </label>
                                            <select class="form-control" name="serviceId" >
                                                <option value="0" >All</option>
                                                
                                                <?php 
                                                if($mainContents != null){
                                                    
                                                    foreach ($mainContents as $service){?>
                                                        
                                                <option onclick="getSubServicesByServiceId(<?php echo $service['id']; ?>,'subServiceDiv')" value="<?php echo $service['id']; ?>" <?php if( $service['id'] == $serviceId){ echo "selected" ;} ?>><?php echo $service['title']; ?></option>
                                                    <?php }
                                                }
                                                ?>
                                        
                                            </select>
                                        </div>
                             
                             
                                                <div class="form-group"  style="margin-left: 5px; width:150px; float: left;">
                                                    <label> Sub Service </label>
                                                     <select class="form-control" name="subServiceId" id="subServiceDiv"  >
                                                         <option value="0">All</option>
                                                         
                                                         <?php
                                                         if($subContents != null){
                                                                foreach ($subContents as $subContent){?>
                                                        
                                                         <option  value="<?php echo $subContent['id']; ?>" <?php if( $subContent['id'] == $subServiceId){ echo "selected" ;} ?>><?php echo $subContent['title']; ?></option>
                                                    <?php }
                                                          
                                                         }
                                                         ?>
                                                     </select>
                                                  </div>
                             
                                               <div class="form-group" style="margin-left: 5px;width:150px; float: left;">
                                            <label>  Send Status </label>
                                            <select class="form-control" name="sendStatus" >
                                                <option value="-1" >All</option>
                                                
                                                <?php 
                                                   
                                                 $sendingStatus = General::getContentMessageStatus();
                                                if($sendingStatus != null){
                                                    
                                                    foreach ($sendingStatus as $sendStaus){?>
                                                        
                                                <option  value="<?php echo $sendStaus[0]; ?>" <?php if( $sendStaus[0] == $contentStaus){ echo "selected" ;} ?>><?php echo $sendStaus[1]; ?></option>
                                                    <?php }
                                                }
                                                ?>
                                        
                                            </select>
                                        </div>
                             
                                        <div class="form-group" style="margin-left: 5px;width:150px; float: left;">
                                            <label> Is Approved </label>
                                            <select class="form-control" name="approveStatus" >
                                                <option value="-1" >All</option>
                                                
                                                <?php 
                                                  $approvalStatus = General::getApprovalStatus();
                                                  
                                                 if($sendingStatus != null){
                                                    
                                                    foreach ($approvalStatus as $approveStatus){?>
                                                        
                                                    <option  value="<?php echo $approveStatus[0]; ?>" <?php if( $approveStatus[0] == $approveFlag){ echo "selected" ;} ?>><?php echo $approveStatus[1]; ?></option>
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
                          Content Messages
                        </div>
                          <form role="form" action="../../Control/ContentMessage/DoAction.php" method="post">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php 
                            if($contents != null){
                            ?>
                            <table width="100%" class="table table-striped"  >
                                <thead>
                                    <tr>
                                       <th><INPUT type="checkbox" onchange="checkAll(this)" name="ids[]" /></th>
                                        <th>ID</th>
                                        <th>Service</th>
                                        <th>Sub Service</th>
                                        <th>Message</th>
                                         <th>Status</th>
                                        <th>Send Date</th>
                                        <th>Status Date</th>
                                        <th>Approval  </th>
                                        <th>Edit</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    //$orders = General::getMessageOrders();
                                    $contentMesaageStatus = General::getContentMessageStatus();
                                    $approvalStatus = General::getApprovalStatus();
                                    
                                    foreach($contents as $content){ ?>
                                    <tr class="odd gradeX">
                                        <td> <input class="checkbox" type="checkbox" value="<?php echo $content['id']; ?>"   name="ids[]" /></td>
                                        <td><?php echo $content['id']; ?></td>
                                        <td><?php echo $content['contentTitle']; ?></td>
                                        <td><?php echo $content['subContentTitle']; ?></td>
                                        <td><?php echo $content['msg']; ?></td>
                                         <td style="background: <?php echo $contentMesaageStatus[$content['status']][2];  ?>;"><?php echo $contentMesaageStatus[$content['status']][1]; ?></td>
                                        <td><?php echo $content['sending_date']; ?></td>
                                        <td><?php echo $content['status_date']; ?></td>
                                        <td><?php echo $approvalStatus[$content['approval_flag']][1]; ?></td>
                                       
                                        <td><a href="edit_message.php?id=<?php echo $content['id'] ?>" class="btn btn-link "  style="padding: 0px;" > Edit </a></td>
                                       
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            
                             <div> 
                                 <input type="submit" class="btn btn-success"  style="float: left;" name="approve" value="Approve" />
                                 <input type="submit" class="btn btn-warning"  style="float: left;margin-left: 5px;" name="not_approve" value="Unapprove" />
                                 <input type="submit" class="btn btn-danger"  style="float: left;margin-left: 5px;" name="reject" value="Reject" />
                                 <input type="submit" class="btn btn-warning"  style="float: left;margin-left: 5px;" name="un_reject" value="Undo the rejection" />
                                 <input type="submit" class="btn btn-danger"  style="float: left;margin-left: 5px;" name="delete" value="Delete" />
                            </div>
                            
                            <?php } ?>
                            <!-- /.table-responsive -->
                   
                        </div>
                        </form>
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
    
        
     <script src="../../js/datetimepicker/jquery2.js"></script>
        <script src="../../js/datetimepicker/jquery.datetimepicker.js"></script>
        
         <script>
        var $i = jQuery.noConflict();
        $i('#datetimepicker1').datetimepicker({format:'Y-m-d H:i:s'});
         $i('#datetimepicker2').datetimepicker({format:'Y-m-d H:i:s'});
    
          </script>

</body>

</html>
