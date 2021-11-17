<?php
namespace Petrik\Rajzfilmek;

class Rajzfilm {
    private $id;
    private $cim;
    private $hossz;
    private $kiadasi_ev;

    public function setAttributes(array $attr) {
       $this->id = $attr['id'] ?? $this->id;
       $this->cim = $attr['cim'] ?? $this->cim;
       $this->hossz = $attr['hossz'] ?? $this->hossz;
       $this->kiadasi_ev = $attr['kiadasi_ev'] ?? $this->kiadasi_ev;
    }

    public static function osszes() : array {
        global $db;
        $result = $db->query('SELECT * FROM rajzfilm ORDER BY kiadasi_ev');
        $rajzfilmek = [];
        
        foreach ($result as $row) {
            $rajzfilm = new Rajzfilm();
            $rajzfilm->setAttributes($row);
            $rajzfilmek[] = $rajzfilm;
        }
        return $rajzfilmek;
    }
}