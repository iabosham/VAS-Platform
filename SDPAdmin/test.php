
<?php
class My extends Thread {
    public function run() {
     echo "aaa <br />" ;
    }
}
$my = new My();
($my->start());
?>
