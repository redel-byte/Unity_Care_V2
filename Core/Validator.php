<?php

// - Validation email
// - Validation téléphone
// - Validation date
// - Vérification champ non vide
// - Sanitization (nettoyage des entrées)
// - Échappement XSS pour les sorties

// **Objectif**

// Centraliser toute la validation. Utiliser dans les setters des models.

// **À chercher :**
// - « PHP filter_var validation »
// - « PHP htmlspecialchars XSS »
// - « sanitize input PHP »
class Validator
{
    //regex of text;
    private static $strRegex = "/^[a-zA-Z\s]+$/";
    //regex of phone number;
    private static $phoneRegex = "/^0[67][0-9]{8}$/";
    //regex of email;
    private static $emailRegex = "/^[a-zA-Z0-9_-%]+@(gmail|outlook)\\.com$/";
    //regex of date;
    private static $dateRegex = "/^\d{4}-\d{2}-\d{2}$/";
    //check if string not empty;
    public static function NotEmpty(string $input): bool
    {
        return !empty($input);
    }

    //validatie if text is string;
    public static function isstring(string $input): bool
    {
        return preg_match(self::$strRegex, $input) ? true : false;
    }
    //validation if date is valid;
    public static function isValidDate(string $input): bool
    {
        return preg_match(self::$dateRegex, $input) ? true : false;
    }

    //validate email;
    public static function validateEmail(string $input): bool
    {
        return preg_match(self::$emailRegex, $input) ? true : false;
    }

    //validate the phone number;
    public static function validatePhone(string $input): bool
    {
        return preg_match(self::$phoneRegex, $input) ? true : false;
    }

    //remove special characters;
    public static function rmSpecialChar(string $input): string
    {
        return htmlspecialchars(trim($input));
    }

    //sanitize the input;
    public static function sanitize(string $input): string
    {
        return self::rmSpecialChar($input);
    }

}
