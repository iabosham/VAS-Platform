<?php
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ServicePermission.php');
require_once('../../SDPAccess/AccessControl/ServicePermission/ServicePermissionControl.php');

try {
    $providerId = General::cleanGet("providerId");

    $servicePermissions = ServicePermissionControl::getServicePermissionsByProviderId($providerId);
    ?>
    <?php if ($servicePermissions != null) { ?>


        <div class="panel-hdeading" style="padding-left: 15px;">
            <h3>Provider Services</h3> 
        </div>

        <!-- /.panel-heading -->
        <div class="panel-body">

            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th> Service</th>
                        <th> Provider </th>
                        <th> Del </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($servicePermissions != null) {

                        foreach ($servicePermissions as $servicePermission) {
                            ?>
                            <tr>
                                <td><?php echo $servicePermission['id'] ?></td>
                                <td><?php echo $servicePermission['title'] ?></td>
                                <td><?php echo $servicePermission['name'] ?></td>
                                <td><a href="../../Control/ServicePermission/DeleteServicePermission.php?id=<?php echo $servicePermission['id'] ?>" class="btn btn-link" style="padding: 0px;color: red;" > Delete </a></td>

                            </tr>

                        <?php
                        }
                    }
                    ?>   
                </tbody>
            </table>


            <!-- /.table-responsive -->

        </div>

        <?php
    }
} catch (Exception $exception) {
    
}
?>
