<?php 

 $userid = Cookie::getUserId() ;
?>   <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="collapse navbar-collapse">
                             <li style="float: left;">
                                 Company :  <?php echo Cookie::getCompanyName(); ?>
                                </li>
                            <ul class="nav navbar-nav navbar-right">
                               
                               
                                
                                <li>
                                    <a href="../../Control/User/Logout.php"> Logout <i class="glyphicon glyphicon-share-alt"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $username; ?> <i class="caret"></i></a>
                                    <ul class="dropdown-menu">
                                         <li><a href="../../View/User/change_password.php?id=<?php echo $userid ?>"> Change password</a></li>
                                         <li role="presentation" class="divider"></li>
                                        <li><a href="../../Control/User/Logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>