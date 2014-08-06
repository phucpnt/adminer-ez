<?php

function adminer_object() {

  $server   = $_SERVER;
  $hostname = $server['SERVER_NAME'];

  // required to run any plugin
  include_once "./plugins/plugin.php";

  class AdminerExtend extends AdminerPlugin
  {

    protected $hostname = 'localhost.com';

    public function setHostname($hostname) {
      $this->hostname = $hostname;
    }

    public static function isDevHost($hostname) {
      return (preg_match('/localhost/i', $hostname));
    }

    public function autoLogin($username) {
      if (isset($_REQUEST['username'])) {
        return;
      }
      if (self::isDevHost($this->hostname)) {
        header('Location: ' . $_SERVER['SCRIPT_NAME'] . '?username=' . $username);
        exit();
      }
    }

    public function credentials() {
      if (self::isDevHost($this->hostname)) {
        return array('127.0.0.1', 'admin', 'abc123');
      }
      return array();
    }

  }
  // autoloader
  foreach (glob("plugins/*.php") as $filename) {
    include_once "./$filename";
  }

  $plugins = array(
    // specify enabled plugins here
    new AdminerTablesFilter,
    new AdminerJsonColumn,
  );

  if (AdminerExtend::isDevHost($hostname)) {
    $plugins[] = new AdminerSchemaLog;
  }

  /**
   * myadminer customization including plugins
   */
  $myAdminer = new AdminerExtend($plugins);
  $myAdminer->setHostname($hostname);
  $myAdminer->autoLogin('admin');

  return $myAdminer;
}

// include original Adminer or Adminer Editor
include "./adminer.php";
