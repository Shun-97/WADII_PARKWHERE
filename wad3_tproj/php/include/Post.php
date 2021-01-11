<?php
class Post {

    public $username;
    public $carparkname;
    public $info;
    public $stars;
    public function __construct($username, $carparkname, $info, $stars) {
        $this->username = $username;
        $this->carparkname = $carparkname;
        $this->info = $info;
        $this->stars = $stars;
    }
}

?>