<?php

/**
 *  Project: onepageMD
 *  File: gabarit.php HTML template around the content
 *  Author: Samuel Roland
 *  Creation date: 20.02.2021
 */

//Load php script to get $values (to interpolate in $content)
$values = [];
if ($config['content']['additionnal-values'] != null) {
    include "content/" . $config['content']['additionnal-values'];
}
if (empty($values) == false) {
    $content = interpolateValuesInContent($content, $values);
}

$title = $config['title'];
$defaultlanguage = $config['content']['default_language'];
?>

<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>

    <!-- CSS files -->
    <?php
    ////TODO: choose the CSS file to load
    //$basicstyle = $config['style']['basic-style'];
    //if ($basicstyle != null && in_array($basicstyle, array_keys(CSS_FILES)) == true) {
    //    echo '<link href="' . CSS_FILES[$basicstyle] . '" rel="stylesheet">';
    //}
    //$styles = $config['style']['load-css-files'];
    //foreach ($styles as $style) {
    //    if ($style != null) {
    //        echo '<link href="' . $style . '" rel="stylesheet">';
    //    }
    //}
    ?>

    <link rel="stylesheet" href="./node_modules/tailwindcss/dist/tailwind.min.css">
    <!--    <link rel="stylesheet" href="./css/kanff.css">
    <script src="main.js"></script>-->

</head>

<body class="" style="background-color: <?= $config['style']['body']['background-color'] ?>;
 color: <?= $config['style']['body']['font-color'] ?>;
 font-family: <?= $config['style']['font-list'] ?>;
 max-width: <?= $config['style']['body']['maxwidth'] ?>;
 margin: 30px auto;
 padding: 0 15px;
 ">
    <div class="thinBlackBorderForTitle my-3">
        <?php if ($maintitle != null) { ?>
            <div class="my-3 w-full">
                <h1 class="max-w-max flex-1 text-center my-3"><?= $maintitle; ?></h1>
            </div>
        <?php } ?>
        <span class="flex flex-wrap w-full border-blue-200 border-b border-solid">
            <div class="flex-1">
                <span class=""><strong><?= $config['website-name'] ?></strong></span>
                <span class="text-sm focus-within:cursor-help" title="Version de kanff.org"><?= getTextVersion() ?></span>
                <?php if ($config['content']['hide-select-if-one-language-only'] != true) { ?>
                    <select name="language" id="sltLanguage" required class="rounded-sm px-1">
                        <?php
                        $files = $config['content']['content-files'];
                        foreach ($files as $file) {
                            echo "<option value='{$file['id']}' " . ($language == $file['id'] ? "selected" : "") . " >{$file['language']} - {$file['version']}" . ($defaultlanguage == $file['id'] ? " (default)" : "") . "</option>";
                        }
                        ?>
                    </select>
                <?php } ?>
            </div>
            <div class="max-w-max flex items-center">
                <strong class=""><?= $config['author'] ?></strong>
                <a target="_blank" href="https://github.com/samuelroland/KanFF"><img src="imgs/github.png" class=" border-none h-5 ml-2" alt=""></a>
            </div>
        </span>
    </div>


    <div class="">
        <?= $content ?>
    </div>

</body>

</html>