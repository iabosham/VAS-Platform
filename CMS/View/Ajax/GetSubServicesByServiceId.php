<?php
require_once('../../SDPAccess/Common/General.php');
require_once('../../SDPAccess/Common/CookieClient.php');
require_once('../../SDPAccess/Model/DBConnection.php');

require_once('../../SDPAccess/Model/SubContent.php');
require_once('../../SDPAccess/AccessControl/SubContent/SubContentControl.php');

try {
    $serviceId = General::cleanGet("serviceId");
    
          $subServices= SubContentControl::getSubContents($serviceId);
 
    ?>
    <?php if ($serviceId != null && $subServices != null) { ?>
         <option value="0">All</option>
        <?php
        foreach ($subServices as $subService) { ?>
         <option   value="<?php echo $subService['id'] ?>"  ><?php echo $subService['title'] ?></option>
      <?php   }
    }
    ?>
     <?php
} catch (Exception $exception) {
 }
?>
