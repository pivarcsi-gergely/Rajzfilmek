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
}