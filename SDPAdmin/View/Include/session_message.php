<?php
 
        if(isset($_SESSION[Session::$SUCCESS_OPERATION])){
         //  echo '<div class="alert alert-success"><a class="close" data-dismiss="success" href="#">&times;</a>' ;
           echo '<div class="alert alert-success"> ' ;
                echo $_SESSION[Session::$SUCCESS_OPERATION];
           unset($_SESSION[Session::$SUCCESS_OPERATION]) ;
           echo '</div>'; 
       } 
       
          if(isset($_SESSION[Session::$ENVALED_OPERATION])){
                           echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a>' ;
                           foreach ($_SESSION[Session::$ENVALED_OPERATION] as $row){
                               echo $row.'<br />';
                           }
                          unset($_SESSION[Session::$ENVALED_OPERATION]) ;
                           echo '</div>'; 
          } 
 