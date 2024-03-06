<?php 
declare(strict_types=1);

class Auteur {
    private string $nom;
    private string $prenom;
    private int $anneeNaissance;
    private array $citations = [];
    private Systeme $systeme;

    public function __construct(string $prenom, string $nom, int $anneeNaissance, Systeme $systeme) {
        // Valider le prénom
        if (!is_string($prenom) || empty(trim($prenom))) {
            throw new InvalidArgumentException("Le prénom doit être une chaîne non vide.");
        }
        $this->prenom = $prenom;

        // Valider le nom
        if (!is_string($nom) || empty(trim($nom))) {
            throw new InvalidArgumentException("Le nom doit être une chaîne non vide.");
        }
        $this->nom = $nom;

        // Valider l'année de naissance
        if (!is_numeric($anneeNaissance) || $anneeNaissance < 1900 || $anneeNaissance > date("Y")) {
            throw new InvalidArgumentException("L'année de naissance doit être une année valide entre 1900 et l'année en cours.");
        }
        $this->anneeNaissance = $anneeNaissance;

        if (!$systeme instanceof Systeme) {
            throw new InvalidArgumentException('Le systeme doit étre un objet Systeme.');
        }
        $this->systeme = $systeme;  
    }

    public function getNomComplet() {
        return $this->prenom . " " . $this->nom . " " . $this->anneeNaissance;
    }

    public function getCitations() {
        return $this->citations;
    }

    public function getAnneeNaissance(){
        return $this->anneeNaissance;
    }

    public function getSysteme(): Systeme{
        return $this->systeme;
    }

    public function ajouterCitation(Citation $citation) {
        if (!$citation instanceof Citation) {
            throw new InvalidArgumentException('Le tableau doit contenir uniquement des objets Citation.');
        }

        $texte = $citation->getTexte();

        if (!is_string($texte) || empty(trim($texte))) {
            throw new InvalidArgumentException('La citation n\'est pas dans le bon format.');
        }

        if ($this -> systeme -> citationExists($citation)) {
            throw new InvalidArgumentException("La citation existe déjà dans le tableau.");
        }
        $this->citations[] = $citation;
    }


    public function ajouterSysteme(Systeme $systeme) {
        if (!$systeme instanceof Systeme) {
            throw new InvalidArgumentException('L\'objet doit être un système.');
        }
        $this->systeme = $systeme;
    }

}
