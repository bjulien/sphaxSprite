<?php
/**
 * Définition d'une classe d'exception personnalisée
 */
class DirectoryException extends Exception
{
    // Redéfinition du constructeur pour rendre le message obligatoire
    public function __construct($message, $code = 0) {
        // du code ici
    
        // Appel du parent
        parent::__construct($message, $code);
    }

    // Représentation de l'objet sous forme de chaine personnalisée
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function customFunction() {
        echo "Une méthode personnalisée pour cette exception\n";
    }
}
?>