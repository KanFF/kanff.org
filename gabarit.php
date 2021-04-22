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
    <link rel="stylesheet" href="./node_modules/tailwindcss/dist/tailwind.css">
    <link rel="stylesheet" href="./node_modules/@tailwindcss/typography/dist/typography.min.css">
    <link rel="stylesheet" href="./css/kanff.css">
    <script src="main.js"></script>
    <style>
        /**Thanks to https://github.com/tailwindlabs/tailwindcss/discussions/3006 
        Disable top margins to avoid a very big spacing between elements
        */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        ul,
        ol,
        span,
        img,
        p,
        li {
            margin-top: 0 !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            padding-top: 5px;
            /**When section is opened with the anchor, the titles should not be without any space with the top of the browser */
        }

        li {
            margin-left: 10px;
        }

        .border-none {
            border: none !important;
        }

        .iconsToCopySection img {
            margin: 0 !important;
        }

        @font-face {
            font-family: "Jetbrains Mono";
            src: url("css/JetbrainsMono-Regular.ttf");
        }
    </style>
</head>

<body class="prose mdstyle" style="background-color: <?= $config['style']['body']['background-color'] ?>;
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
        <span class="flex flex-wrap w-full">
            <div class="flex-1">
                <span class="text-lg cursor-help" title="Version of the text (highest version of the translations)."><?= getTextVersion() ?></span>
                <select name="language" id="sltLanguage" required class="rounded-sm px-1">
                    <?php
                    $files = $config['content']['content-files'];
                    foreach ($files as $file) {
                        echo "<option value='{$file['id']}' " . ($language == $file['id'] ? "selected" : "") . " >{$file['language']} - {$file['version']}" . ($defaultlanguage == $file['id'] ? " (default)" : "") . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="max-w-max">
                <strong class=""><?= $config['author'] ?></strong> - <a href="mailto:<?= $config['email'] ?>">Email</a> <a href="<?= prefixURLIfRelative($config['link']) ?>"><?= $config['link-placeholder'] ?></a> <a href="<?= prefixURLIfRelative($config['sourcelink']) ?>">Source</a>
            </div>
        </span>
    </div>


    <div class="mdstyle">
        <?= $content ?>
    </div>

</body>

</html>