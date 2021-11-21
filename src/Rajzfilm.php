<?php
namespace Petrik\Rajzfilmek;

use Exception;

class Rajzfilm {
    public $id;
    public $cim;
    public $hossz;
    public $kiadasi_ev;

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

    public static function getById(int $id) : ?Rajzfilm {
        global $db;
        $stmt = $db->prepare('SELECT * FROM rajzfilm WHERE id = :id');
        $stmt->execute([':id' => $id]);
        if ($stmt->rowCount() !== 1) {
            return null;
        }
        $rajzfilm = new Rajzfilm();
        $rajzfilm->setAttributes($stmt->fetch(\PDO::FETCH_ASSOC)/* $stmt->fetchAll()[0]*/);
        return $rajzfilm;
    }
    
    public function uj()
    {
        global $db;
        $stmt = $db->prepare('INSERT INTO rajzfilm (cim, hossz, kiadasi_ev) VALUES (:cim, :hossz, :kiadasi_ev)');
        $stmt->execute([
            ':cim' => $this->cim,
            ':hossz' => $this->hossz,
            ':kiadasi_ev' => $this->kiadasi_ev

        ]);
        $this->id = $db->lastInsertId();
    }

    public function torles() {
        if ($this->id === null) {
            throw new Exception("null ID-jüt nem lehet törölni");
        }

        global $db;
        $stmt = $db->prepare('DELETE FROM rajzfilm WHERE id = :id');
        $stmt->execute([':id' => $this->id]);
        if ($stmt->rowCount() !== 1) {
            throw new Exception("Ilyen ID-jű nem volt");
        }
    }

    public function modositas() {
        if ($this->id === null) {
            throw new Exception("null ID-jüt nem lehet módosítani");
        }

        global $db;
        $stmt = $db->prepare('UPDATE rajzfilm SET cim = :cim, hossz = :hossz, kiadasi_ev = :kiadasi_ev');
        $stmt->execute([
            ":cim" => $this->cim,
            ":hossz" => $this->hossz,
            ":kiadasi_ev" => $this->kiadasi_ev
        ]);
    }
}