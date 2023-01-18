<?php

function validateEmail ($email) {
    $result = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($result) {
        return true;
    }

    return false;
}

function validateString ($string) {
    $pattern = '/^[a-zA-Z0-9]*$/';
    $result = preg_match($pattern, $string);

    if ($result) {
        return true;
    }

    return false;
}