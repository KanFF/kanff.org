<?php
require 'content/views.php';

$data = json_decode(file_get_contents("content/texts-fr.json"), true);
define("SECTIONS", $data['SECTIONS']);
$kanff = $data['kanff'];
$advantages = $data['advantages'];
$news = $data['news'];
$about = $data['about'];

// Contributors are listed here and not in texts-*.json because they don't need any translations.
$contributors = [
    ['name' => 'Samuel Roland', 'username' => 'samuelroland', 'img' => 'https://avatars.githubusercontent.com/u/47849646?v=4', 'major' => true],
    ['name' => 'Benoît Pierrehumbert', 'username' => 'cpnvbenoit', 'img' => 'https://avatars.githubusercontent.com/u/47849605?v=4', 'major' => true],
    ['name' => 'LPOdev', 'username' => 'LPOdev ', 'img' => 'https://avatars.githubusercontent.com/u/47849666?v=4', 'major' => false],
    ['name' => 'Miguel Soares', 'username' => 'miguelsoaresking500', 'img' => 'https://avatars.githubusercontent.com/u/47849626?v=4', 'major' => false],
    ['name' => 'Simon Cuany', 'username' => 'SimonCuany', 'img' => 'https://avatars.githubusercontent.com/u/47849679?v=4', 'major' => false],
    ['name' => 'KevinVaucher', 'username' => 'KevinVaucher', 'img' => 'https://avatars.githubusercontent.com/u/47849513?v=4', 'major' => false],
    ['name' => 'XCarrel', 'username' => 'XCarrel', 'img' => 'https://avatars.githubusercontent.com/u/7465241?v=4', 'major' => false],
];

define("START_DATE_BLOG", strtotime("2020-05-18"));

//Interpolate values in markdown content
$values['advantages'] = getAdvantages($advantages);
$values['banner'] = getBanner($kanff);
$values['about'] = getAboutSection($about, $contributors);
$values['newsletter'] = getNewsLetterSection($news);
