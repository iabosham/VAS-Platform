 <?php 
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');

$services = ServiceControl::getServices();
   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alwesam SDP | Services</title>
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
                            <div class="page-header bootstrap-admin-content-title">
                                <h1>Services</h1>
                                
                                <a href="#" class="action">
                                    <button class="btn btn-success">Register new service </button>
                                </a>
                            </div>
                        </div>
                    </div>

                     

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Services Table</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table bootstrap-admin-table-with-actions">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> Name</th>
                                                 <th>Type</th>
                                                 <th>Service Key</th>
                                                  <th>Service Code</th>
                                                 <th>Short Code</th>
                                                 <th>Client</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           if($services != null){
                                               foreach ($services as $row) {?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['serviceTypeName'] ?></td>
                                                <td><?php echo $row['service_key'] ?></td>
                                                 <td><?php echo $row['service_code'] ?></td>
                                                 <td><?php echo $row['shortcodeNumber'] ?></td>
                                                 <td><?php echo $row['clientName'] ?></td>
                                                 <td class="actions">
                                                    <a href="#">
                                                        <button class="btn btn-sm btn-primary">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                            Edit
                                                        </button>
                                                    </a>
                                                    
                                                    
                                                    <a href="#">
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                            Delete
                                                        </button>
                                                    </a>
                                                </td>
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

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="../../vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../js/DT_bootstrap.js"></script>
    </body>
</html>

