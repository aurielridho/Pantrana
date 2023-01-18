<?php

    function hashString ($string) {
        $method = 'sha256';
        $result = hash($method, $string);

        return $result;
    }