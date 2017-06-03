<?php

namespace LRS\App\Core\Session;

class SessionManager {
  protected $type;
  public $id;

  public function __construct($type) {
    $this->type = $type;
    $this->id = 0;
  }

  public function store($data) {
    // Get returned id from stored row
    $this->id = 0;
  }

  public function release($id) {
    // Get returned id from released row
    $this->id = 0;
  }
}
