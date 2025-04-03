<?php

class Etudiant
{
    private $nom;
    private $notes = array();


    public function __construct($nom, $notes = array())
    {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    
    public function afficherNotes()
    {
        
        return $this->notes;
    }

    
    public function calculerMoyenne()
    {
        if (count($this->notes) === 0) {
            return 0; 
        }
        $somme = array_sum($this->notes);
        return $somme / count($this->notes);
    }

    
    public function estAdmis()
    {
        return $this->calculerMoyenne() >= 10;
    }

    
    public function getNom()
    {
        return $this->nom;
    }
}