<?php 
session_start();
require_once('../../Control/Include/PublicInclude.php');
 
 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Content Provider </title>
    
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
                        <?php $pageKey = PageKey::$PAGE_PROVIDER_ADD; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Add Content Provider</h1>
                         <?php include '../Include/session_message.php'; ?>
                    </div>
                    
                                         

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                              Form Elements
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="../../Control/Provider/AddProvider.php" method="post">
                                 
                                        <div class="form-group">
                                            <label>Provider Name</label>
                                            <input class="form-control" placeholder="Enter title" name="name" />
                                        </div>
                                        
                                          
                                         <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" placeholder="Enter Phone" name="phone" />
                                        </div>
                                        
                                       
                                          <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" placeholder="Enter Email" name="email" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" placeholder="Enter Address" name="address" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Login</label>
                                            <input class="form-control" placeholder="Enter Address" name="login" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" placeholder="Enter Address" name="password" />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Status</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  name="status" value="1" />Need Approve
                                                </label>
                                            </div>
                                           
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Description </label>
                                            <textarea class="form-control"  name="desc" ></textarea>
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

</body>

</html>
