<li class="sidebar-search">


    <div class="input-group custom-search-form">
        <img src="../../images/ran.JPG" width="220" style="float: left;" />
    </div>
    <!-- /input-group -->
</li>
<li>
    <a href="#"><i class="fa fa-home fa-home"></i> Home </a>
</li>

<?php  if(Cookie::getUserType() == 1 || Cookie::getUserType() == 2 || Cookie::getUserType() == 4  ){?>

<li> 
    <a  <?php if (PageKey::$ENTER_CONTENT_ADMIN == $pageKey) {
    echo 'class="active"';
} ?> href="../ContentMessage/new_message.php"><i class="fa fa-edit fa-inbox"></i> Enter Content </a>
</li>
<?php } ?>

<?php  if(Cookie::getUserType() == 1 || Cookie::getUserType() == 2 || Cookie::getUserType() == 3  ){?>
<li> 
    <a  <?php if (PageKey::$MESSAGE_CONTENT_ADMIN == $pageKey) {
    echo 'class="active"';
} ?> href="../ContentMessage/content_message.php"><i class="fa fa-inbox fa-inbox"></i> Contents </a>
</li>
<?php } ?>

<?php  if(Cookie::getUserType() == 1){?>


<li <?php if (PageKey::$PAGE_MAIN_CONTENT == $pageKey || PageKey::$PAGE_SUB_CONTENT == $pageKey) {
    echo 'class="active"';
} ?>  >
    <a href="#"><i class="fa fa-edit fa-fw"></i> Services<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a  <?php if (PageKey::$PAGE_MAIN_CONTENT == $pageKey) {
    echo 'class="active"';
} ?>  href="../Content">Main Services</a>
        </li>
        <li>
            <a <?php if (PageKey::$PAGE_SUB_CONTENT == $pageKey) {
    echo 'class="active"';
} ?>  href="../SubContent">Sub Services</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>



<li <?php if (PageKey::$PAGE_PROVIDER == $pageKey || PageKey::$PAGE_PROVIDER_ADD == $pageKey) {
    echo 'class="active"';
} ?>>
    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Providers <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a <?php if (PageKey::$PAGE_PROVIDER_ADD == $pageKey) {
    echo 'class="active"';
} ?> href="../Provider/add_provider.php">Add Provider </a>
        </li>
        <li>
            <a  <?php if (PageKey::$PAGE_PROVIDER == $pageKey) {
    echo 'class="active"';
} ?> href="../Provider/">Providers</a>
        </li>

    </ul>
    <!-- /.nav-second-level -->
</li>

<li>
    <a <?php if (PageKey::$PAGE_SERVICE_PERMISSION == $pageKey) {
    echo 'class="active"';
} ?> href="../ServicePermission/"><i class="fa fa-table fa-fw"></i> Provider Services</a>
</li>
<li >
    <a href="#"><i class="fa fa-files-o fa-fw"></i> Reports <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#">...</a>
        </li>

    </ul>
    <!-- /.nav-second-level -->
</li>

<li <?php if (PageKey::$PAGE_USER == $pageKey || PageKey::$PAGE_USER_ADD == $pageKey) {
    echo 'class="active"';
} ?>>
    <a href="#"><i class="fa fa-wrench fa-fw"></i> Administrator <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a  <?php if (PageKey::$PAGE_USER_ADD == $pageKey) {
    echo 'class="active"';
} ?>  href="../User/add_user.php">Add User</a>
        </li>

        <li>
            <a  <?php if (PageKey::$PAGE_USER == $pageKey) {
    echo 'class="active"';
} ?>  href="../User/">Users</a>
        </li>

    </ul>
    <!-- /.nav-second-level -->
</li>

<?php } ?>