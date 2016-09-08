<?php

/**
* Autoload any classes that are required
* @param $className class to autoload
*/

function __autoload($className)
{

    $signature = '.php';
    if (file_exists(__DIR__ . $className . $signature)) {

        include_once __DIR__ . $className . $signature;

    } elseif (file_exists(
        __DIR__ . '/Controller/' . $className . $signature
    )) {

        include_once __DIR__ . '/Controller/' . $className . $signature;

    } else if (file_exists(
        __DIR__  . '/Repository/' . $className . $signature
    )) {

        include_once __DIR__ . '/Repository/' . $className . $signature;

    } else if (file_exists(
        __DIR__  . '/Service/' . $className . $signature
    )) {

        include_once __DIR__ . '/Service/' . $className . $signature;

    }
}
