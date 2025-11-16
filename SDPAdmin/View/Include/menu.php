<li class="sidebar-search">


    <div class="input-group custom-search-form">
        
    </div>
    <!-- /input-group -->
</li>
<li>
    <a href="#"><i class="fa fa-home fa-home"></i> Home </a>
</li>
 

<li <?php if (PageKey::$PAGE_MESSAGE == $pageKey || PageKey::$PAGE_MISSED_SERVICE == $pageKey) {
    echo 'class="active"';
} ?>  >
    <a href="#"><i class="fa fa-home fa-file-text"></i> Content Status<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a  <?php if (PageKey::$PAGE_MESSAGE == $pageKey) {
    echo 'class="active"';
} ?>  href="../Message/">Pushed Messages</a>
        </li>
        <li>
            <a <?php if (PageKey::$PAGE_MISSED_SERVICE == $pageKey) {
    echo 'class="active"';
    } ?>  href="../Message/missed_service.php">Unpushed Content</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>

<li <?php if (PageKey::$PAGE_QUEUE == $pageKey || PageKey::$PAGE_OUTBOX == $pageKey || PageKey::$PAGE_INBOX == $pageKey) {
    echo 'class="active"';
} ?>  >
    <a href="#"><i class="fa fa-home fa-share-square"></i>  Message Log<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a  <?php if (PageKey::$PAGE_QUEUE == $pageKey) {
    echo 'class="active"';
} ?>  href="../Queue/"> Queue </a>
        </li>
        
         <li>
            <a  <?php if (PageKey::$PAGE_INBOX == $pageKey) {
    echo 'class="active"';
} ?>  href="../Inbox/"> Inbox </a>
        </li>
        
        <li>
            <a <?php if (PageKey::$PAGE_OUTBOX == $pageKey) {
    echo 'class="active"';
    } ?>  href="../Outbox"> Outbox </a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>


<li <?php if (PageKey::$PAGE_SHORTCODE == $pageKey || PageKey::$PAGE_SERVICE == $pageKey || PageKey::$PAGE_SERVICE_TYPE == $pageKey) {
    echo 'class="active"';
} ?>  >
    <a href="#"><i class="fa fa-home fa-sort"></i> Service Management<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a  <?php if (PageKey::$PAGE_SHORTCODE == $pageKey) {
    echo 'class="active"';
} ?>  href="../Shortcode/"> Services </a>
        </li>
        
         <li>
            <a  <?php if (PageKey::$PAGE_SERVICE == $pageKey) {
    echo 'class="active"';
    } ?>  href="../Service/"> Sub Services </a>
        </li>
        
        <li>
            <a <?php if (PageKey::$PAGE_SERVICE_TYPE == $pageKey) {
    echo 'class="active"';
    } ?>  href="../ServiceType"> Service Type </a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
 
<li>
    <a <?php if ( PageKey::$PAGE_SUBSCRIPTION == $pageKey) {
    echo 'class="active"';
    } ?> href="../Service/service_subscribers.php"><i class="fa fa-table fa-sort"></i> Subscription</a>
</li>

<li>
    <a <?php if (PageKey::$TRANSC == $pageKey) {
    echo 'class="active"';
    } ?> href="../Trans/"><i class="fa fa-table fa-connectdevelop"></i> Transc</a>
</li>


<li>
    <a <?php if (PageKey::$SMPP== $pageKey) {
    echo 'class="active"';
    } ?> href="../SMPP/"><i class="fa fa-table fa-circle"></i> SMPP</a>
</li>

<li>
    <a <?php if (PageKey::$COMPANY== $pageKey) {
    echo 'class="active"';
    } ?> href="../Company/"><i class="fa fa-table fa-circle"></i> Company</a>
</li>

<li>
    <a <?php if (PageKey::$COUNTRY== $pageKey) {
    echo 'class="active"';
    } ?> href="../Country/"><i class="fa fa-table fa-circle"></i> Country</a>
</li>

<li>
    <a <?php if (PageKey::$SYSTEM_MESSAGE== $pageKey) {
    echo 'class="active"';
    } ?> href="../SystemMessage/"><i class="fa fa-table fa-circle"></i> System Messages</a>
</li>

<li>
    <a <?php if (PageKey::$PAGE_Bulk== $pageKey) {
    echo 'class="active"';
    } ?> href="../Bulk/register_customer.php"><i class="fa fa-table fa-circle"></i> Bulk Subscription</a>
</li>

<li>
    <a <?php if (PageKey::$UN_SUBSCRIBE== $pageKey) {
    echo 'class="active"';
    } ?> href="../Subscriber/un_subscribe.php"><i class="fa fa-table fa-circle"></i> Un Subscribe</a>
</li>

<li>
    <a <?php if (PageKey::$PAGE_TEST_BILLING== $pageKey) {
    echo 'class="active"';
    } ?> href="../Message/send_message.php"><i class="fa fa-table fa-circle"></i> Send Message</a>
</li>
   
 