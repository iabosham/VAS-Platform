<?php 

$username = Cookie::getUserName() ;
 ?>  
<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
    <a class="navbar-brand" href="#"><font style="color: #6ac608;" >Alwesam </font>SDP (<font style="font-weight: bold;color: #000;"> <?php echo $username; ?></font>)</a>
            </div>
            <!-- /.navbar-header -->
           
            <ul class="nav navbar-top-links navbar-right">
       
                <!-- /.dropdown -->
       
                <!-- /.dropdown -->
            
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       
                       
                       
                        <li><a href="../../Control/User/Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
 
          
  