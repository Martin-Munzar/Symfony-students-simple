<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StudentRepository;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $jmeno;

    /**
     * @ORM\Column(type="integer") // ## nullable=true
     */
    private $znamka; // ## = null
    

    // Getters & Setters

    public function getId() {
        return $this->id;
    }

    public function getJmeno() {
        return $this->jmeno;
    }

    public function setJmeno($jmeno) {
        $this->jmeno = $jmeno;
    }

    public function getZnamka() {
        return $this->znamka;
    }

    public function setZnamka($znamka) {
        $this->znamka = $znamka;
    }
}