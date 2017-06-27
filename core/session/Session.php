<?php

namespace LRS\App\Core\Session;

class SessionManager {
  protected static $flash_message;

  public static function setFlash($message) {
    self::$flash_message = $message;
  }

  public static function hasFlash() {
    return !is_null(self::$flash_message);
  }

  public static function flash() {
    return self::$flash_message;
  }
}
