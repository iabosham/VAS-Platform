<?php
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Vendor.php');
require_once('../../SDPAccess/AccessControl/Vendor/VendorControl.php');

require_once('../../SDPAccess/Model/Content.php');
require_once('../../SDPAccess/AccessControl/Content/ContentControl.php');

require_once('../../SDPAccess/Model/ServicePermission.php');
require_once('../../SDPAccess/AccessControl/ServicePermission/ServicePermissionControl.php');

$services = ContentControl::getContents();

$vendors = VendorControl::getVendors();

$servicePermissions = ServicePermissionControl::getLastServicePermissions();

 ?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Provider Services   </title>

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
                            <?php $pageKey = PageKey::$PAGE_SERVICE_PERMISSION;
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
                            <h1 class="page-header"> Provider Services </h1>
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
                                    Provider Services Form  
                                </div>
                        
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <form role="form" action="../../Control/ServicePermission/AddServicePermission.php" method="post">

                                                <div class="form-group">
                                                    <label>  Provider  </label>
                                                    <select class="form-control" name="providerId" >
                                                        <option value="">Select</option>

                                                        <?php
                                                        if ($vendors != null) {

                                                            foreach ($vendors as $vendor) {
                                                                ?>

                                                        <option onclick="getServicePermissionsByProviderId(<?php echo $vendor['id']; ?>)" value="<?php echo $vendor['id']; ?>"  ><?php echo $vendor['name']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>  Service </label>
                                                    <select class="form-control" name="serviceId" >
                                                        <option value="0">All</option>

                                                        <?php
                                                        if ($services != null) {

                                                            foreach ($services as $service) {
                                                                ?>
                                                        
                                                        <option onclick="getSubServicesByServiceId(<?php echo $service['id']; ?>,'subServiceDiv')" value="<?php echo $service['id']; ?>"><?php echo $service['title']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label> Sub Service </label>
                                                     <select class="form-control" name="subServiceId" id="subServiceDiv"  >
                                                         <option value="0">All</option>
                                                     </select>
                                                  </div>
                                                <button type="submit" class="btn btn-default">Add</button>
                                            </form>
                                        </div>

                                        <div class="col-lg-8">


                                            <div class="panel panel-default" id="providerServices">

                                                <div class="panel-hdeading" style="padding-left: 15px;">
                                                      <h3>Last Provider Services</h3> 
                                                </div>

                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                  
                                                     <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th> Service</th>
                                                                <th> Provider </th>
                                                                <th> Del </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                         <?php
                                                         if($servicePermissions != null){
                                                             
                                                             foreach($servicePermissions as $servicePermission){?>
                                                                 <tr>
                                                                <td><?php echo $servicePermission['id'] ?></td>
                                                                <td><?php echo $servicePermission['title'] ?></td>
                                                                <td><?php echo $servicePermission['name'] ?></td>
                                                                <td><a href="../../Control/ServicePermission/DeleteServicePermission.php?id=<?php echo $servicePermission['id'] ?>" class="btn btn-link" style="padding: 0px;color: red;" > Delete </a></td>
                                        
                                                            </tr>
                                                                 
                                                            <?php }
                                                             
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

<?php include '../Include/footer.php'; ?>

    </body>

</html>
