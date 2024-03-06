<?php

declare(strict_types=1);

class Citation
{
    private String $texte; // Déclaration de la propriété texte, qui doit être une chaîne de caractères
    private Datetime $date; // Déclaration de la propriété date, qui doit être un objet Datetime
    private Auteur $auteur; // Déclaration de la propriété auteur, qui doit être un objet de la classe Auteur

    public function __construct($texte, $date, Auteur $auteur)
    {
        // Vérifie que texte est une chaîne non vide
        if (!is_string($texte) || trim($texte) === '') {
            throw new InvalidArgumentException("Le texte de la citation doit être une chaîne non vide.");
        }
        $this->texte = $texte;
        
        // Vérifie que date est un objet DateTime
        if (!$date instanceof DateTime) {
            throw new InvalidArgumentException("La date doit être une instance de DateTime.");
        }
        $this->date = $date;

        // Vérifie que Auteur est un objet de la classe Auteur
        if (!$auteur instanceof Auteur) {
            throw new InvalidArgumentException("L'auteur n'est pas valide.");
        }
        
        // Vérifie si l'année de naissance de l'auteur est postérieure à l'année de la citation
        if ($auteur->getAnneeNaissance() >= $date->format('Y')) {
            throw new InvalidArgumentException("La date de naissance de l'auteur est supérieure ou égale à la date de la citation.");
        }
        $this->auteur = $auteur;
        $this->auteur->ajouterCitation($this); // Appel à la méthode ajouterCitation de l'objet Auteur associé
    }

    public function getTexte(): string
    {
        $texte = $this->texte;
        return trim($texte); // Retourne le texte de la citation avec les espaces inutiles supprimés
    }

    public function getDate(): DateTime
    {
        return $this->date; // Retourne la date de la citation
    }

    public function getAuteur(): Auteur
    {
        return $this->auteur; // Retourne l'auteur de la citation
    }
}
