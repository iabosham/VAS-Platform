<?php 
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Content.php');
require_once('../../SDPAccess/AccessControl/Content/ContentControl.php');

$services = ContentControl::getContents();
 
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
                        <?php $pageKey = PageKey::$PAGE_SUB_CONTENT; include '../Include/menu.php'; ?>
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
                        <h1 class="page-header">Add Sub Service</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                       <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sub Service Form Elements
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="../../Control/SubContent/AddContent.php" method="post">
                                 
                                       
                                        
                                         <div class="form-group">
                                            <label>  Service </label>
                                            <select class="form-control" name="contentId" >
                                                <option>Select</option>
                                                
                                                <?php 
                                                if($services != null){
                                                    
                                                    foreach ($services as $service){?>
                                                        
                                                <option value="<?php echo $service['id']; ?>"><?php echo $service['title']; ?></option>
                                                    <?php }
                                                }
                                                ?>
                                        
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" placeholder="Enter title" name="title" />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label> Content Type </label>
                                            <select class="form-control" name="contentTypeId" >
                                                <option>Select</option>
                                                
                                                <?php 
                                                
                                                $contentTypes = General::getContentTypes();
                                                if($contentTypes != null){
                                                    
                                                    foreach ($contentTypes as $contentType){?>
                                                        
                                                <option value="<?php echo $contentType[0]; ?>"><?php echo $contentType[1]; ?></option>
                                                    <?php }
                                                }
                                                ?>
                                        
                                            </select>
                                        </div>
                                        
                                        <div class="form-group" style="  height: 70px;">
                                            <div style="width: 210px;float: left; ">
                                            <label>Msgs / Day</label>
                                            <input class="form-control"  name="msgCount" />
                                            </div>
                                            
                                              <div style="width: 210px;float: right;">
                                            <label> Content length </label>
                                            <input class="form-control" placeholder="Enter title" name="contentLength" />
                                            </div>
                                            
                                        </div>
                                        
                                          
                                        <div class="form-group" style="  height: 70px;">
                                            <div style="width: 210px;float: left; ">
                                            <label>Status</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  name="status" />Is Active
                                                </label>
                                            </div>
                                            </div>
                                            
                                          <div style="width: 210px;float: right;">
                                            <label>Approve Status</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  name="needApproval" />Approve Required
                                                </label>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                      <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="3" name="desc"></textarea>
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
