<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/User.php');
require_once('../../SDPAccess/AccessControl/User/UserControl.php');

$id = General::cleanGet("id");

$userInfo = UserControl::getUserInfoById($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Service </title>
    
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
                        <?php $pageKey = PageKey::$PAGE_USER; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Edit User</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User Form Elements
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="../../Control/User/UpdateUser.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                                        <div class="form-group">
                                            <label>  Full Name</label>
                                            <input class="form-control" placeholder="Enter Name" name="name" type="text" value="<?php echo $userInfo['name']; ?>" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>  User Type </label>
                                            <select class="form-control" name="type" >
                                                 
                                                  <option value="">Select ... </option>
                                                        <?php
                                                        $userTypes = General::getContentUserTypes();
                                                        if($userTypes != null){
                                                        foreach($userTypes as $userType){
                                                            if($userInfo['user_type'] == $userType[0]){
                                                            echo  '<option value='.  $userType[0].' selected>'.$userType[1].'</option>';
                                                             }else {
                                                             echo  '<option value='.  $userType[0].'>'.$userType[1].'</option>';
                                                              }
                                                        }
                                                        }
                                                        ?>
                                           
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" placeholder="Enter Phone" name="phone" type="text" value="<?php echo $userInfo['phone']; ?>" />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" placeholder="Enter Email" name="email" type="text" value="<?php echo $userInfo['email']; ?>" />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Login</label>
                                            <input class="form-control" placeholder="Enter Login" value="<?php echo $userInfo['login']; ?>" name="login" type="text"   />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Status</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  name="status" <?php if($userInfo['status'] == 1){echo 'checked'; } ?>  />Is Active
                                                </label>
                                            </div>
                                           
                                        </div>
                                        
                                        
                                         <div class="form-group">
                                            <label> New Secret (Left it an empty if you don't change the current password) </label>
                                            <input class="form-control" placeholder="Enter the new user's password" name="secret" type="password" value="" autocomplete="off" />
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
