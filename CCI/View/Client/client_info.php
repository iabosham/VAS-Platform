<?php 
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Client.php');
require_once('../../SDPAccess/AccessControl/Client/ClientControl.php');
require_once('../../SDPAccess/AccessControl/Security/Secret.php');


$id = General::cleanGet("id");

$clientInfo = ClientControl::getClientInfoById($id);

$providerKey = Secret::getProviderKey($clientInfo['secret'], $clientInfo['login']) ;
 
   
   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alwesam SDP | Client Information</title>
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
                        <?php $pageKey = PageKey::$PAGE_CLIENT; include '../Include/menu.php'; ?>
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-10">
                    
                       <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="#">Client</a>
                                    </li>
                                    <li>
                                        <a href="#">Information</a>
                                    </li>
                                    <li class="active"><?php echo $clientInfo['name'] ;  ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                   
 
                    <div class="row">
                        <div class="col-lg-12">
                              <?php include '../Include/success_message.php' ;?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Client Information</div>
                                    <div class="pull-right">Subscribers count <span class="badge"> <?php echo 0; ?></span></div>
                                </div>
                                <div class="panel-body" style="margin: 0px; ">
                                         
                        <div  style="width: 100%;float: left;" >
                          
                              
                                  <div class="bootstrap-admin-panel-content" style="margin: 0px;">
                                       <table class="table">
                                         
                                        <tbody>
                                            <tr style=" margin: 0px;" >
                                                 <td  style="font-size: 20px;"><?php echo "Client : ".$clientInfo['name']; ?></td>
                                                 <td style="font-size: 20px;">
                                                     <form action="#" method="post" >
                                                         <input   type="submit" value="Deactivate" />  
                                                     </form>
                                                     
                                                 </td>
                                             </tr>
                                             <tr class="warning">
                                                <td>Client ID</td>
                                                <td><?php echo $clientInfo['id']; ?></td>
                                           
                                            </tr>
                                            
                                            <tr class="warning">
                                                <td>Phone</td>
                                                <td><?php echo $clientInfo['phone']; ?></td>
                                               
                                            </tr>
                                           
                                            
                                             <tr class="warning">
                                                <td>Email</td>
                                                <td><?php echo $clientInfo['email']; ?></td>
                                           
                                            </tr>
                                            
                                             <tr class="warning">
                                                <td>Address</td>
                                                <td><?php echo $clientInfo['address']; ?></td>
                                           
                                            </tr>
                                            
                                           
                                            
                                               <tr class="warning">
                                                   <td colspan="2">Provider Key:</td>
                                            
                                            </tr>
                                            
                                             <tr class="warning">
                                                 <td colspan="2"><?php echo $providerKey; ?></td>
                                           
                                            </tr>
                                            
                                              <tr class="warning">
                                                <td>Status</td>
                                                <td><?php if($clientInfo['isActive'] == 1){echo 'Active';}else {echo 'Not Active'.'<br />'.$clientInfo['comment'];} ?></td>
                                           
                                            </tr>
                                            
                                             <tr class="warning">
                                                <td>Provider</td>
                                                <td><?php echo $clientInfo['vendorName']; ?></td>
                                           
                                            </tr>
                                         
                                           
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

       <?php include '../Include/footer.php'; ?>

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="../../vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../js/DT_bootstrap.js"></script>
    </body>
</html>
