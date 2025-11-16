<?php


require_once('../../SDPAccess/Common/General.php');
require_once('../../SDPAccess/Common/CookieClient.php');
require_once('../../SDPAccess/Model/DBConnection.php');

require_once('../../SDPAccess/Model/SubContent.php');
require_once('../../SDPAccess/AccessControl/SubContent/SubContentControl.php');

try {
    $count = General::cleanGet("count");
    $messageCounts = General::getMessageOrders();
    ?>
    <?php if ($count > 0) { ?>
        <option value=""> Select  </option>
        <?php
         for($i=0;$i<$count;$i++) {
            echo '<option value="' .($i+1) . '"  >' . $messageCounts[$i][1] . '</option>';
        }
    }
    ?>
    <?php

} catch (Exception $exception) {
    
}
?>
