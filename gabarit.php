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
$versioninfo = "Version " . $config['version'] . $data['header']['published-at'] . $config['versiondate'] . ".";

$title = $config['title'];
$defaultlanguage = $config['content']['default_language'];
?>

<!DOCTYPE HTML>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Une application web opensource de gestion de projets à l'aide de kanbans, pour les groupes, collectifs et associations." />
	<title><?= $title; ?></title>

	<?php //Open Graph metadata. See https://ogp.me/ 
	?>
	<meta property="og:site_name" content="kanff.org" />
	<meta property="og:title" content="KanFF" />
	<meta property="og:url" content="https://kanff.org" />
	<meta property="og:description" content="Une application web opensource de gestion de projets à l'aide de kanbans, pour les groupes, collectifs et associations." />
	<meta property="og:image" content="https://kanff.org/imgs/kanff.org.png" />
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="834">
	<meta property="og:image:height" content="403">

	<?php
	//<!-- CSS files -->
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
	<link rel="stylesheet" href="fonts/fonts.css" type="text/css" charset="utf-8" />
	<!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet"> -->
	<!--<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet"> -->
	<link rel="stylesheet" href="node_modules/tailwindcss/dist/tailwind.min.css">
	<?php
	//<!--    <link rel="stylesheet" href="./css/kanff.css">
	//<script src="main.js"></script>-->
	?>
</head>

<body class="px-0 m-auto sm:px-2 lg:px-3 my-2 sm:my-3" style="background-color: <?= $config['style']['body']['background-color'] ?>;
 color: <?= $config['style']['body']['font-color'] ?>;
 font-family: <?= $config['style']['font-list'] ?>;
 max-width: <?= $config['style']['body']['maxwidth'] ?>;
 ">
	<span class="underline hover:text-blue-500" hidden>test</span>
	<div class="sm:px-0 px-2 thinBlackBorderForTitle sm:mb-3 pt-2">
		<?php if ($maintitle != null) { ?>
			<div class="my-3 w-full">
				<h1 class="max-w-max flex-1 text-center my-3"><?= $maintitle; ?></h1>
			</div>
		<?php } ?>
		<div class="flex flex-wrap w-full border-blue-200 border-b border-solid">
			<div class="flex-1 mr-2 min-w-max">
				<span class=""><strong><?= $config['website-name'] ?></strong></span>
				<span class="text-sm focus-within:cursor-help" title="<?= $versioninfo ?>"><?= $config['version'] ?></span>
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
		</div>
	</div>

	<div>
		<?= $content ?>
	</div>

</body>

</html>