<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/Model/Subscriber.php');
require_once('../../SDPAccess/AccessControl/Subscriber/SubscriberControl.php');

require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');

 $serviceID = General::cleanGet("id");

$serviceInfo =  ServiceControl::getServiceInfoById($serviceID);

if($serviceInfo == null ){
    
    header("location: index.php");
}
$subscribers = SubscriberControl::getSubscribersOfService($serviceID);
    
   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alwesam SDP | Subscribers</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-admin-theme-change-size.css">

        <!-- Datatables -->
        <link rel="stylesheet" media="screen" href="../../css/DT_bootstrap.css">

        <!-- HTML5 shim and Respond.../../js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="../../js/html5shiv.../../js"></script>
           <script type="text/javascript" src="../../js/respond.min.../../js"></script>
        <![endif]-->
    </head>
    <body class="bootstrap-admin-with-small-navbar">
          <!-- small navbar -->
     <?php include '../Include/top_header.php'; ?>

        <!-- main / large navbar -->
    <?php include '../Include/main_header.php'; ?>

        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->
                <div class="col-md-2 bootstrap-admin-col-left">
                    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                        <?php $pageKey = PageKey::$PAGE_SERVICE; include '../Include/menu.php'; ?>
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-10">
                    
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="index.php">Service</a>
                                    </li>
                                    
                                    <li ><a href="service_info.php?id=<?php echo $serviceInfo['id'] ;  ?>"><?php echo $serviceInfo['name'] ;  ?></a></li>
                                    
                                    <li class="active">
                                        Subscribers 
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    
                  
                    <div class="row">
                        <div class="col-lg-12">
                             <?php include '../Include/success_message.php' ;?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Subscribers</div>
                                     <div class="pull-right">Subscribers count <span class="badge"> <?php echo count($subscribers); ?></span></div>

                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped table-bordered" id="example" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th> MSISDN</th>
                                                 <th>Subscription Date</th>
                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           if($subscribers != null){
                                               foreach ($subscribers as $row) {?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['msisdn'] ?></td>
                                                <td><?php echo $row['creationDate'] ?></td>
                                                
                                            </tr>
                                           <?php } } ?>
                                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                      
 

                       
                    </div>
                </div>
            </div>
        </div>

       <?php include '../Include/footer.php'; ?>

        <script type="text/javascript" src="../../js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="../../vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../js/DT_bootstrap.js"></script>
    </body>
</html>
