<?php
 
        if(isset($_SESSION[Session::$SUCCESS_INSERTION])){
         //  echo '<div class="alert alert-success"><a class="close" data-dismiss="success" href="#">&times;</a>' ;
           echo '<div class="alert alert-success"> ' ;
                echo $_SESSION[Session::$SUCCESS_INSERTION];
            unset($_SESSION[Session::$SUCCESS_INSERTION]) ;
           echo '</div>'; 
       } 
       session_write_close();

 ?>