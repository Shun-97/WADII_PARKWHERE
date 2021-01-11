<?php
class Carpark {

    public $carparkid;
    public $carparkname;
    public $sat_rate;
    public $wkdy_rate;
    public $lat;
    public $lng;
    public function __construct($carparkid, $carparkname, $sat_rate, $wkdy_rate, $lat, $lng) {
        $this->carparkid = $carparkid;
        $this->carparkname = $carparkname;
        $this->sat_rate = $sat_rate;
        $this->wkdy_rate = $wkdy_rate;
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function getCarparkid() {
        return $this->carparkid;
    }
    public function getCarparkname() {
        return $this->carparkname;
    }
    public function getSatRate() {
        return $this->sat_rate;
    }
    public function getWkdyRate() {
        return $this->wkdy_rate;
    }
    public function getLat() {
        return $this->lat;
    }
    public function getLng() {
        return $this->lng;
    }
}

?>
