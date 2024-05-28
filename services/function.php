<?php
    function isEmpty($value) {
        return empty($value);
    }

    function isYearValid($year) {
        return ($year < 0 || $year > 2_147_483_647) ? false : true;
    }
    
    function hasInvalidCharacters($username) {
        return preg_match('/[\s\W_]/', $username);
    }

    function removeWhiteSpace($string) {
        return preg_replace('/\s+/', '', $string);
    }
?>