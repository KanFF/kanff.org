<?php
require 'content/views.php';
$advantages = [
    [
        'name' => "Gestion de projets collaborative",
        'description' => 'Vous galèrez à faire participer tout le monde dans vos projets ? Les informations sont éparpillées et se perdent ? La communication interne est fatiguante et demande trop de travail ? 
        <br>Par défaut, les projets sont visibles à l\'interne pour tout le monde. Les projets sont gérés par des groupes et non par des personnes seules.',
        'img' => 'projets.png',
        'mode' => 1
    ],
    [
        'name' => "Tâches gérées à l'aide de kanbans",
        'description' => 'Le kanban est un système visuel de gestion de tâches sous diverses formes possibles. Ici les principes sont: Une tâche a 3 états possibles: À faire, En cours ou Terminé. Le kanban permet de gérer les tâches selon leur état via 3 colonnes. Chaque tâche a un·e responsable (obligatoir sauf si À faire).',
        'img' => 'kanban.png',
        'mode' => 2
    ],
    [
        'name' => "Gestion collaborative des projets !",
        'description' => 'Vous galèrez à faire participer tout le monde dans vos projets ? Les informations sont éparpillées et se perdent ? La communication est plus complexe et demande plus de travail ?',
        'img' => 'projets.png',
        'mode' => 1
    ],
    [
        'name' => "Gestion collaborative des projets !",
        'description' => 'Vous galèrez à faire participer tout le monde dans vos projets ? Les informations sont éparpillées et se perdent ? La communication est plus complexe et demande plus de travail ?',
        'img' => 'projets.png',
        'mode' => 1
    ]
];

$aboutText = [
    'intro' => "Le projet KanFF n'est pas encore utilisable, il reste une grosse partie de développement, de réflexion et de tests avant une première version utilisable (dite 'version de production').",
    'text' => "Le projet a commencé le xx.04.2020 sur un projet scolaire avec un groupe de 6 personnes. Le projet s'est passé sur plusieurs cours et à la maison, et maintenant 2 apprentis en informatique continuent le projet afin de poursuivre l'aventure de ce projet ambitieux et passionnant.",
    'contributors' => [
        ['name' => 'Samuel Roland', 'username' => 'samuelroland', 'img' => 'https://avatars.githubusercontent.com/u/47849646?v=4', 'major' => true],
        ['name' => 'Benoît Pierrehumbert', 'username' => 'cpnvbenoit', 'img' => 'https://avatars.githubusercontent.com/u/47849605?v=4', 'major' => true],
        ['name' => 'LPOdev', 'username' => 'LPOdev ', 'img' => 'https://avatars.githubusercontent.com/u/47849666?v=4', 'major' => false],
        ['name' => 'Miguel Soares', 'username' => 'miguelsoaresking500', 'img' => 'https://avatars.githubusercontent.com/u/47849626?v=4', 'major' => false],
        ['name' => 'Simon Cuany', 'username' => 'SimonCuany', 'img' => 'https://avatars.githubusercontent.com/u/47849679?v=4', 'major' => false],
        ['name' => 'KevinVaucher', 'username' => 'KevinVaucher', 'img' => 'https://avatars.githubusercontent.com/u/47849513?v=4', 'major' => false],
        ['name' => 'XCarrel', 'username' => 'XCarrel', 'img' => 'https://avatars.githubusercontent.com/u/7465241?v=4', 'major' => false],
    ]
];

define("START_DATE_BLOG", strtotime("2020-05-18"));

$values['blogAgeInString'] = date("d.m.Y",  START_DATE_BLOG);
$values['advantages'] = getAdvantages($advantages);
$values['banner'] = getBanner();
$values['about'] = getAboutSection($aboutText);
$values['newsletter'] = getNewsLetterSection();
