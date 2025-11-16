<li class="sidebar-search">
    <div class="input-group custom-search-form">
      </div>
    <!-- /input-group -->
</li>

 <?php if (CookieClient::getUserType() == 1) { ?>
<li>
    <a href="#"><i class="fa fa-home fa-home"></i> Home </a>
</li>

<li>
    <a <?php if (PageKey::$ENTER_CONTENT == $pageKey) {
    echo 'class="active"';
    } ?> href="../ContentMessage/new_content.php"><i class="fa fa-edit fa-fw"></i></i> Enter Content </a>
</li>
 

<li>
    <a <?php if (PageKey::$MESSAGE_CONTENT == $pageKey) {
    echo 'class="active"';
} ?> href="../ContentMessage/"><i class="fa fa-inbox fa-fw"></i> Outbox </a>
</li>
 <?php }else if (CookieClient::getUserType() == 2) { ?>
<li>
    <a <?php if (PageKey::$MESSAGE_INBOX == $pageKey) {
    echo 'class="active"';
    } ?> href="../Inbox/"><i class="fa fa-inbox fa-fw"></i> Inbox </a>
</li>

 <?php } ?>

