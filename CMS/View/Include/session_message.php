<?php if (isset($_SESSION[Session::$SUCCESS_OPERATION])) { ?>

    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php
    echo $_SESSION[Session::$SUCCESS_OPERATION];

    unset($_SESSION[Session::$SUCCESS_OPERATION]);
    echo '</div>';
} 

if (isset($_SESSION[Session::$ENVALED_OPERATION])) {
    ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php
            foreach ($_SESSION[Session::$ENVALED_OPERATION] as $row) {
                echo $row . '<br />';
            }

            unset($_SESSION[Session::$ENVALED_OPERATION]);
            echo '</div>';
        } 
 