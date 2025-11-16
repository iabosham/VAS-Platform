<?php
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Service.php');
require_once('../../SDPAccess/AccessControl/Service/ServiceControl.php');

try {
    $shortcodeId = General::cleanGet("shortcodeId");
    
          $services = ServiceControl::getServices($shortcodeId);
 
    ?>
    <?php if ($services != null) { ?>
         <option value=""> Select </option>
        <?php
        foreach ($services as $service) {
            echo '<option value="' . $service['id'] . '"  >' . $service['sender_name']." - " . $service['serviceName'] . '</option>';
        }
    }
    ?>
     <?php
} catch (Exception $exception) {
 }
?>
