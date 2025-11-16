<?php
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Shortcode.php');
require_once('../../SDPAccess/AccessControl/Shortcode/ShortcodeControl.php');

try {
    $comId = General::cleanGet("companyId");
    
          $shortcodes = ShortcodeControl::getShortcodes($comId);
 
    ?>
    <?php if ($shortcodes != null) { ?>
         <option value=""> Select </option>
        <?php
        foreach ($shortcodes as $shortcode) {?>
         
         <option onclick="getServicesByShortcodeId(<?php echo $shortcode['id']; ?>, 'serviceDiv')" value="<?php echo $shortcode['id']; ?>"><?php echo $shortcode['number']." - ".$shortcode['title']; ?></option>

        <?php  }
    }
    ?>
     <?php
} catch (Exception $exception) {
 }
?>
