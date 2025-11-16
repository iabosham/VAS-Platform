<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SystemMessage.php');
require_once('../../SDPAccess/AccessControl/SystemMessage/SystemMessageControl.php');

 $code = General::cleanGet("code");
 
$messageInfo = SystemMessageControl::getSystemMessagesByCode($code);
  
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alwesam SDP</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="../../css/bootstrap-admin-theme-change-size.css">

        <!-- Shortcodes -->
        <link rel="stylesheet" media="screen" href="../../vendors/bootstrap-datepicker/css/datepicker.css">
        <link rel="stylesheet" media="screen" href="../../css/datepicker.fixes.css">
        <link rel="stylesheet" media="screen" href="../../vendors/uniform/themes/default/../../css/uniform.default.min.css">
        <link rel="stylesheet" media="screen" href="../../css/uniform.default.fixes.css">
        <link rel="stylesheet" media="screen" href="../../vendors/chosen.min.css">
        <link rel="stylesheet" media="screen" href="../../vendors/selectize/dist/../../css/selectize.bootstrap3.css">
        <link rel="stylesheet" media="screen" href="../../vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
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
                       <?php $pageKey = PageKey::$SYSTEM_MESSAGE; include '../Include/menu.php'; ?>
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-10">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header bootstrap-admin-content-title">
                                <h2>System Messages</h2>
                                
                                <a href="index.php" class="action">
                                    <button class="btn btn-success">System messages's view</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                       
                       if(isset($_SESSION[Session::$ENVALED_LOGIN])){
                           echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a>' ;
                           foreach ($_SESSION[Session::$ENVALED_LOGIN] as $row){
                               echo $row.'<br />';
                           }
                           unset($_SESSION[Session::$ENVALED_LOGIN]) ;
                           echo '</div>'; 
                       } 
                       session_write_close();
                      
                    ?>
                   
                            
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Update message form </div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" action="../../Control/SystemMessage/UpdateSystemMessage.php" method="post">
                                        
                                        <input type="hidden" name="id" value="<?php echo $messageInfo['id']; ?>" />
                                        <fieldset>
                                            <legend>Update System message</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Title</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" style="text-align: center;" value="<?php echo $messageInfo['description']; ?>" name="desc" type="text" placeholder="Enter shortcode value here ..." >
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label"  for="focusedInput">code</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" readonly value="<?php echo $messageInfo['code']; ?>" name="code" type="text" placeholder="Enter shortcode value here ..." >
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Message</label>
                                                <div class="col-lg-10">
                                                    <textarea  class="form-control" id="focusedInput" name="message" type="text" placeholder="Type message here ..." style="text-align: center" ><?php echo $messageInfo['message']; ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <button style="float: right;" type="submit" class="btn btn-primary">Update Message</button>
                                            <button style="float: right; margin-right: 5px;" type="reset" class="btn btn-default">Cancel</button>
                                        </fieldset>
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php include '../Include/footer.php'; ?>

        <script type="text/javascript" src="../../js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="../../vendors/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="../../vendors/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="../../vendors/selectize/dist/js/standalone/selectize.min.js"></script>
        <script type="text/javascript" src="../../vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../../vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>
        <script type="text/javascript" src="../../vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>
        <script type="text/javascript" src="../../vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>
        <script type="text/javascript" src="../../vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>

       
    </body>
</html>
