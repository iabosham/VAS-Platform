<?php
                        if(isset($_SESSION[Session::$ENVALED_INSERTION])){
                           echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a>' ;
                           foreach ($_SESSION[Session::$ENVALED_INSERTION] as $row){
                               echo $row.'<br />';
                           }
                           unset($_SESSION[Session::$ENVALED_INSERTION]) ;
                           echo '</div>'; 
                       } 
                       session_write_close();
                      
                    ?>