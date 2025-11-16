<?php 
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Shortcode.php');
require_once('../../SDPAccess/Model/Sender.php');
require_once('../../SDPAccess/AccessControl/Shortcode/ShortcodeControl.php');
require_once('../../SDPAccess/AccessControl/Sender/SenderControl.php');

$shortcodes = ShortcodeControl::getShortcodes();
$id = General::cleanGet("id");
$shortcodeInfo = ShortcodeControl::getShortcodeInfoById($id);

$senders = SenderControl::getSendersByShortcodeId($id);
 
   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alwesam SDP | Short codes</title>
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
                        <?php $pageKey = PageKey::$PAGE_SHORTCODE; include '../Include/menu.php'; ?>
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-10">
                    
                       <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="#">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="#">Settings</a>
                                    </li>
                                    <li class="active">Tools</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                   
 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Panel without data</div>
                                    <div class="pull-right"><span class="badge">0</span></div>
                                </div>
                                <div class="panel-body" >
                                    <div class="no-data" style="height: 400px;">
                                        
                        <div class="row" style="width: 50%;float: left;" >
                        <div class="col-lg-12">
                         
                              <div class="panel panel-default">
                               
                                <div class="bootstrap-admin-panel-content">
                                    <h3><?php echo "Shortcode : ".$shortcodeInfo['number']; ?></h3>
                                      <table class="table">
                                        <thead>
                                            <tr>
                                                
                                                <th colspan="2" style="border: 0px;" ></th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Provider</td>
                                                <td><?php echo $shortcodeInfo['vendorName']; ?></td>
                                               
                                            </tr>
                                            <tr class="warning">
                                                <td>Address</td>
                                                <td><?php echo $shortcodeInfo['address']; ?></td>
                                           
                                            </tr>
                                            <tr >
                                                <td>Email</td>
                                                <td><?php echo $shortcodeInfo['email']; ?></td>
                                        
                                            </tr>
                                            <tr class="warning">
                                                <td>Phone</td>
                                                <td><?php echo $shortcodeInfo['phone']; ?></td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                  </div>
                                
                            </div>
                        </div>
                         </div>
                                         
                        <div class="row" style="width: 50%;float: right;" >
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                               
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                
                                                <th colspan="2" >Sender's names </th>
                                               
                                            </tr>
                                            
                                             <tr>
                                        <form action="../../Control/Sender/AddSender.php" method="post">
                                            <input type="hidden" name="shortcodeId" value="<?php echo $id ; ?>" />
                                                 <th style="border: 0px;">
                                                     <input class="form-control" name="senderName" type="text" placeholder="Enter name... "  />
                                                 </th >
                                                <th style="float: right;border: 0px;" >
                                                    <a href="#"> 
                                                        <button class="btn btn-warning" >Add Sender</button>
                                                    </a>
                                                </th>
                                        </form>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if($senders != null){
                                                
                                                foreach($senders as $sender){
                                                    
                                                    echo '<tr><td>' ;
                                                     echo $sender['senderName'] ;
                                                    echo '</td><td>' ;
                                                     echo $sender['userName'] ;
                                                    echo '</td></tr>' ;
                                                }
                                             }else {
                                                echo "<tr><td colspan=2> There is no sender's names"  ;
                                                  echo '</td></tr>' ;  
                                             } ?>
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
