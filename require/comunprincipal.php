<?php

function autoload($clase) {
    if (file_exists()) {
        require 'Clases/' . $clase . '.php';
    } else {
        require '../Clases/' . $clase . '.php';
    }
}

spl_autoload_register('autoload');
