<?php

/**
 *  Project: onepageMD
 *  File: index.php entry point for all requests
 *  Author: Samuel Roland
 *  Creation date: 20.02.2021
 */

require "helpers.php";
require "constants.php";

checkConfigBeforeLoading();
$config = getConfig();


//TODO: choose the language depending on the cookies
$language = null;
if (isset($_COOKIE['lang']) == true && isLanguageAvailable($_COOKIE['lang'])) {
    $language = $_COOKIE['lang'];
    setcookie("lang", $_COOKIE['lang']);
} else {
    $language = $config['content']['default_language'];
    setcookie("lang", $language);
}

//Get MD content
$rawMDContent = getRawMDForAGivenLanguage($language);
if ($rawMDContent != false) {
    $content = getRawMDForAGivenLanguage($language);
    $maintitle = extractMainTitleInRawMDContent($config, $content);
    $content = removeTheMainTitleInRawMDContent($content);
    $content = lauchOperationsOnContent($content);  //raw MD will be transformed to HTML
    require_once "gabarit.php"; //get the layout and include the content inside
} else {
    $maintitle = "Erreur...";
    require_once "error.php";    //the error page is displayed
}
