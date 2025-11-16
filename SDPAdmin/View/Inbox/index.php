<?php
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/Inbox.php');

require_once('../../SDPAccess/Model/Shortcode.php');
require_once('../../SDPAccess/AccessControl/Shortcode/ShortcodeControl.php');


$fromDate = General::cleanGet("fromDate");
$toDate = General::cleanGet("toDate");
$shortcodeId = General::cleanGet("shortcodeId");


if ($fromDate != null) {
    $fromDate = General::cleanGet("fromDate");
} else {
    $fromDate = date("Y-m-d 00:00:00");
}

if ($toDate != null) {
    $toDate = General::cleanGet("toDate");
} else {
    $toDate = date("Y-m-d 23:59:00");
}
 
$inboxDataSource = new Inbox();

$inbox = $inboxDataSource->getInboxMessages(Cookie::getCompanyID(), $fromDate, $toDate, $shortcodeId);

$inboxDataSource->close();

$shortcodes = ShortcodeControl::getShortcodes(Cookie::getCompanyID());
?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SDP - Inbox</title>

<?php include '../Include/header_files.php'; ?>
        <!-- DataTables CSS -->
        <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

<?php include '../Include/footer2.php'; ?>

        <!-- DataTables JavaScript -->
        <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

<?php include '../Include/main_header_1.php'; ?>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
<?php $pageKey = PageKey::$PAGE_INBOX;
include '../Include/menu.php'; ?>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>

            </nav>

            <!-- Page SubContent -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Inbox
                            </h1>

                            <?php include '../Include/session_message.php'; ?>

                            <form   action="index.php" method="get">

                                <div class="form-group"  style=" width:170px; float: left;margin-right: 5px;">
                                    <label>From Date</label>
                                    <input class="form-control"  name="fromDate" id="datetimepicker1"  value="<?php echo $fromDate; ?>" />
                                </div>


                                <div class="form-group"  style=" width:170px; float: left; margin-right: 5px;">
                                    <label>To Date</label>
                                    <input class="form-control"  name="toDate" id="datetimepicker2" value="<?php echo $toDate; ?>" />
                                </div>



                                <div class="form-group" style="width:200px; float: left;">
                                    <label> Service </label>
                                    <select class="form-control" name="shortcodeId" >
                                        <option value="0" >All</option>

                                        <?php
                                        if ($shortcodes != null) {

                                            foreach ($shortcodes as $shortcode) {
                                                ?>

                                                <option value="<?php echo $shortcode['number']; ?>" <?php if ($shortcode['number'] == $shortcodeId) {
                                            echo "selected";
                                        } ?>><?php echo $shortcode['title']; ?></option>
                                            <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <button type="submit" class="btn btn-default" style=" float: left; margin-left: 10px; margin-top: 25px;">Get</button>
                            </form>
                        </div>



                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Inbox
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">

                                    <?php
                                    if ($inbox != null) {
                                        ?>
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Message Time</th>
                                                    <th> From MDN </th>
                                                    <th> Message </th>
                                                    <th> Shortcode </th>
                                                    <th> Connection </th>

                                                </tr>
                                            </thead>
                                            <tbody>

    <?php foreach ($inbox as $row) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $row['ID'] ?></td>
                                                        <td><?php echo $row['MSGTIME'] ?></td>
                                                        <td><?php echo $row['FROMMDN'] ?></td>
                                                        <td><?php echo $row['SHORTMSG'] ?></td>
                                                        <td><?php echo $row['SHORTCODESTR'] ?></td>
                                                        <td><?php echo $row['operatorName'] ?></td>

                                                    </tr>
    <?php } ?>
                                            </tbody>
                                        </table>

                                            <?php }else { ?> <h5>No messages</h5> <?php } ?>
                                    <!-- /.table-responsive -->

                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <script src="../../js/datetimepicker/jquery2.js"></script>
        <script src="../../js/datetimepicker/jquery.datetimepicker.js"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });

            var $i = jQuery.noConflict();
            $i('#datetimepicker1').datetimepicker({format: 'Y-m-d H:i:s'});
            $i('#datetimepicker2').datetimepicker({format: 'Y-m-d H:i:s'});
        </script>
    </body>

</html>
