<?php
class comment {

    public $username;
    public $carparkname;
    public $info;
    public $star;

    public function __construct($username, $carparkname, $info, $star) {
        $this->username = $username;
        $this->carparkname = $carparkname;
        $this->info = $info;
        $this->star = $star;
    }

    public function getUsername() {
        return $this->username;
    }
    public function getLocation() {
        return $this->carparkname;
    }
    public function getInfo() {
        return $this->info;
    }
    public function getStar() {
        return $this->star;
   }
}

?>
