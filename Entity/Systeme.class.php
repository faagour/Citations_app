<?php

declare(strict_types=1); // Active le typage strict pour s'assurer que les types de tous les arguments de fonction et les types de retour sont corrects.

class Systeme
{
    private array $citations = []; // Tableau pour stocker les citations
    private array $auteurs = []; // Tableau pour stocker les auteurs

    public function __construct()
    {
        // Crée des instances d'auteurs avec leurs informations
        $auteur1 = new Auteur("Hugo", "Victor", 1901, $this);
        $auteur2 = new Auteur("Camus", "Albert", 1913, $this);
        $auteur3 = new Auteur("Lobato", "Felipe", 1999, $this);

        // Crée des instances de citations et les associe à leurs auteurs respectifs
        $citation1 = new Citation("Demain, dès l'aube, à l'heure où blanchit la campagne, Je partirai. Vois-tu, je sais que tu m'attends.", new Datetime(), $auteur1);
        $citation2 = new Citation("La liberté est un bagne aussi longtemps qu’un seul homme est asservi sur la terre.", new DateTime(), $auteur2);
        $citation3 = new Citation("La vie est belle.", new DateTime(), $auteur3);
        $citation4 = new Citation("La vie est beaucoup belle.", new DateTime(), $auteur3);

        // Ajoute les auteurs au tableau d'auteurs
        $this->ajouterAuteur($auteur1);
        $this->ajouterAuteur($auteur2);
        $this->ajouterAuteur($auteur3);

        // Ajoute les citations au tableau de citations
        $this->ajouterCitation($citation1);
        $this->ajouterCitation($citation2);
        $this->ajouterCitation($citation3);
        $this->ajouterCitation($citation4); 
    }

    // Ajoute une citation au tableau de citations
    public function ajouterCitation(Citation $citation)
    {
        // Vérifie si la citation existe déjà dans le tableau
        if ($this->citationExists($citation)) {
            throw new InvalidArgumentException("La citation existe déjà dans le tableau.");
        }
            
        $this->citations[] = $citation;

    }

    // Vérifie si une citation égale existe déjà dans le tableau
    public function citationExists(Citation $citation): bool
    {
        foreach ($this->citations as $existingCitation) {
            // Comparaison des textes des citations
            if ($existingCitation->getTexte() === $citation->getTexte()) {
                // Si une citation avec le même texte existe déjà, retourne vrai
                return true;
            }
        }
        // Si aucune citation égale n'est trouvée, retourne faux
        return false;
    }

    // Ajoute un auteur au tableau d'auteurs
    public function ajouterAuteur(Auteur $auteur) {
        $this->auteurs[] = $auteur;
        $auteur->ajouterSysteme($this);
    }

    // Retourne le tableau de toutes les citations
    public function getCitations()
    {
        return $this->citations;
    }

    // Retourne le tableau de tous les auteurs
    public function getAuteurs() {
        return $this->auteurs;
    }

    // Retourne toutes les citations d'un auteur spécifique
    public function getCitationsParAuteur(Auteur $auteur)
    {
        // Cette méthode semble incomplète car elle tente de récupérer les citations directement depuis l'objet auteur,
        // ce qui impliquerait que l'objet Auteur devrait avoir une méthode getCitations() ou un attribut contenant ses citations.
        return $auteur->getCitations();
    }

    // Récupère un auteur par son nom complet. Si l'auteur n'existe pas, en crée un nouveau et l'ajoute à la liste des auteurs
    public function getAuteur(Auteur $new_auteur, $auteurs) {
        foreach ($auteurs as $auteur) {
            // Vérifie si le nom complet correspond à celui de l'auteur recherché
            if ($auteur->getNomComplet() === $new_auteur->getNomComplet()) {
                return $auteur;
            }
        }
         // Note: l'année est arbitrairement fixée à 1800
        $this->ajouterAuteur($new_auteur);
        return $new_auteur;
    }

    public function test_input($data, string $champ)
    {
        if (empty($data)) {
            throw new InvalidArgumentException("Les données saisies dans le champ " . $champ . " sont vides");
        }
    
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
