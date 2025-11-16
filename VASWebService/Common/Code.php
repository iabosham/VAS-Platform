<?php


class Code
{

  public static function getSDPAccessPath()
  {
    $rootPath = filter_input(INPUT_SERVER, "DOCUMENT_ROOT");
    return $rootPath . '/SDPAccess';
  }
  public static function checkLogin()
  {
    $res = false;
    $username = "";
    $password = "";
    if (isset($_SERVER['PHP_AUTH_USER'])) {
      $username = $_SERVER['PHP_AUTH_USER'];
    }
    if (isset($_SERVER['PHP_AUTH_PW'])) {
      $password = $_SERVER['PHP_AUTH_PW'];
    }
    $result = Model::all("operators", [
      ["username", "=", $username],
      ["password", "=", md5($password)],
    ]);
    if ($result) {
      $res = true;
    }
    return $res;
  }

}
