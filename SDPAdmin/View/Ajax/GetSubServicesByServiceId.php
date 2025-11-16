<?php
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/SubContent.php');
require_once('../../SDPAccess/AccessControl/SubContent/SubContentControl.php');

try {
    $serviceId = General::cleanGet("serviceId");
    
          $subServices= SubContentControl::getSubContents($serviceId);
 
    ?>
    <?php if ($serviceId != null && $subServices != null) { ?>
         <option value="0">All</option>
        <?php
        foreach ($subServices as $subService) {
            echo '<option value="' . $subService['id'] . '"  >' . $subService['title'] . '</option>';
        }
    }
    ?>
     <?php
} catch (Exception $exception) {
 }
?>
