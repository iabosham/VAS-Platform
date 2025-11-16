<?php 
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Client.php');
require_once('../../SDPAccess/AccessControl/Client/ClientControl.php');

$id = General::cleanGet("id");

$clientInfo = ClientControl::getClientInfoById($id);
  
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

        <!-- Users -->
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
                       <?php $pageKey = PageKey::$PAGE_USER; include '../Include/menu.php'; ?>
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-10">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header bootstrap-admin-content-title">
                                <h1>Client</h1>
                                
                                <a href="index.php" class="action">
                                    <button class="btn btn-success">Client's view</button>
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
                                    <div class="text-muted bootstrap-admin-box-title">Form User</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" action="../../Control/Client/RestPassword.php" method="post">
                                        <fieldset>
                                            <legend>Change Client Password</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Name</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" name="name" type="text" readonly value="<?php echo $clientInfo['name']; ?>" >
                                                </div>
                                            </div>
                                                                                         
                                            
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Login</label>
                                                <div class="col-lg-10">
                                                    <input  class="form-control" id="focusedInput" name="login" type="text" readonly value="<?php echo $clientInfo['login']; ?>" >
                                                </div>
                                            </div>
                                         
                                            
                                              <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Password</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" name="password" type="password" value="" >
                                                </div>
                                            </div>
                                            
                                              <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Confirm Password </label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" name="comfirmpassword" type="password" value="" >
                                                </div>
                                            </div>
                                          
              
                                            <button style="float: right;" type="submit" class="btn btn-primary">Rest Password </button>
                                            <button style="float: right; margin-right: 5px;" type="reset" class="btn btn-default">Cancel</button>
                                        </fieldset>
                                        <input  name="id" type="hidden" value="<?php echo $clientInfo['id']; ?>" />
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

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
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

        <script type="text/javascript">
            $(function() {
                $('.datepicker').datepicker();
                $('.uniform_on').uniform();
                $('.chzn-select').chosen();
                $('.selectize-select').selectize();
                $('.textarea-wysihtml5').wysihtml5({
                    stylesheets: [
                        '../../vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/wysiwyg-color.css'
                    ]
                });

                $('#rootwizard').bootstrapWizard({
                    'nextSelector': '.next',
                    'previousSelector': '.previous',
                    onNext: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.progress-bar').css('width', $percent + '%');
                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $('#rootwizard').find('.pager .next').hide();
                            $('#rootwizard').find('.pager .finish').show();
                            $('#rootwizard').find('.pager .finish').removeClass('disabled');
                        } else {
                            $('#rootwizard').find('.pager .next').show();
                            $('#rootwizard').find('.pager .finish').hide();
                        }
                    },
                    onPrevious: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.progress-bar').css('width', $percent + '%');
                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $('#rootwizard').find('.pager .next').hide();
                            $('#rootwizard').find('.pager .finish').show();
                            $('#rootwizard').find('.pager .finish').removeClass('disabled');
                        } else {
                            $('#rootwizard').find('.pager .next').show();
                            $('#rootwizard').find('.pager .finish').hide();
                        }
                    },
                    onTabShow: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.bar').css({width: $percent + '%'});
                    }
                });
                $('#rootwizard .finish').click(function() {
                    alert('Finished!, Starting over!');
                    $('#rootwizard').find('a[href*=\'tab1\']').trigger('click');
                });
            });
        </script>
    </body>
</html>
