<?php

//Get HTML of the top banner with slogan, logo, description and other contents.
function getBanner($kanff)
{
    ob_start();
?>
    <!-- <div><img src="imgs/banner-test.png" class="w-full rounded-none" alt=""></div> -->
    <div class="w-auto py-4 xl:py-2 md:my-12 my-6 xl:flex xs:block shadow-xl overflow-hidden rounded-sm border-solid border border-gray-300">
        <div class="flex-1 flex items-center pl-2 ">
            <div class="w-full">
                <img src="imgs/logo.svg" alt="" class="w-full h-24 border-none mb-3">
                <div class=" mx-4">
                    <h1 class="m-none text-3xl text-center"><?= $kanff['slogan'] ?></h1>
                </div>
                <div class="mx-4 mt-2 text-center mb-1">
                    <?= $kanff['definition'] ?>
                </div>
                <div class="mx-4 mt-2 text-center text-sm mb-1">
                    <?= $kanff['explanation'] ?>
                </div>
                <div class="mx-4 text-center text-sm mb-1 flex justify-center flex-wrap">
                    <a href="https://github.com/samuelroland/KanFF/stargazers" class="border  mt-2  px-1 bg-gray-100 hover:bg-gray-200 rounded-sm border-gray-300 flex items-center" target="_blank">
                        <span class="flex items-center text-sm">
                            <img class="inline h-4 mr-1" src="imgs/star.png" alt=""><strong>8</strong>
                        </span>
                    </a>
                    <span class="ml-1 mt-2 border px-1 bg-gray-100 rounded-sm border-gray-300 text-sm">
                        1220 commits
                    </span>
                    <span class="ml-1 mt-2 border px-1 bg-gray-100 rounded-sm border-gray-300 text-sm">
                        Pas de version utilisable. Développement en cours.
                    </span>
                </div>
            </div>
        </div>
        <div class="items-center justify-center xs:w-full xl:justify-end py-2 xl:flex hidden">
            <img src="imgs/preview.png" style="dmax-height: 30vh; margin-right: -2px" class="border-none shadow-xl ml-2 " alt="">
        </div>
    </div>
<?php
    return ob_get_clean();
}

//Get HTML advantages blocks
function getAdvantages($advantages)
{
    $string = "<div class='md:mb-12 mb-6'>";
    $textAtLeft = true; //text at left for the start element 
    foreach ($advantages as $key => $advantage) {
        $string .= buildAnAdvantage($advantage, $textAtLeft);
        if ($advantage['mode'] == 1) {
            $textAtLeft = !$textAtLeft;
        }
    }
    $string .= "</div>";
    return $string;
}

//Get HTML of the block of one advantage
function buildAnAdvantage($advantage, $textAtLeft)
{
    ob_start();
?>
    <div style="background-color: #f0f0f0;" class="overflow-hidden pt-2 shadow-xl rounded-sm md:mb-8 mb-4 border-blue-300 border border-solid <?= ($textAtLeft == false && $advantage['mode'] == 1) ? 'lg:flex-row-reverse' : '' ?>
    <?php switch ($advantage['mode']) {
        case 2:
            echo 'block';
        default:
            echo 'lg:flex sm:block';
    } ?>">
        <div class="lg:px-6 md:px-4 sm:px-3 px-2 flex 
        <?php switch ($advantage['mode']) {
            case 2:
                echo 'lg:px-4 md:px-3 sm:px-2 px-1';
                break;
            default:
                echo 'sm:py-4 lg:py-0';
        } ?> items-center h-auto" style="flex: 2;">
            <div class="<?php switch ($advantage['mode']) {
                            case 2:
                                echo '';
                                break;
                            default:
                                echo 'm-auto';
                        } ?>">
                <d2 class="text-2xl mb-2"><?= $advantage['name'] ?></d2>
                <div class="md:text-base text-sm"><?= MDToHTML($advantage['description']) ?></div>
            </div>
        </div>
        <div class="lg:mx-3 md:mx-2 mx-1 mt-2" style="flex: 4;">
            <img src="imgs/<?= $advantage['img'] ?>" class="border-none sm:rounded-md rounded-sm  rounded-b-none shadow-2xl" alt="Image for advantage '<?= $advantage['name'] ?>'" style="">
        </div>
    </div>

<?php
    return ob_get_clean();
}

//Get HTML of the About section
function getAboutSection($about, $contributors)
{
    ob_start();
?>
    <div class=" bg-gray-100 border-blue-300 border rounded-sm shadow-xl lg:px-6 md:px-4 sm:px-3 px-2 lg:py-4 md:py-3 sm:py-2 py-1 flex items-center md:mb-6 mb-3">
        <div class="">
            <div>
                <h2 class="text-2xl"><?= SECTIONS['about'] ?></h2>
                <div class="flex-1 mr-6 mt-2  md:text-base text-sm">
                    <?= MDToHTML($about['intro']) ?>
                </div>
            </div>
            <hr class="border-blue-300 my-2">
            <div class="flex">
                <div>
                    <h3 class="text-xl mb-2 mt-1"><?= SECTIONS['contributors'] ?></h3>
                    <div class="lg:flex block">
                        <div class="mr-2">
                            <div class="flex">
                                <?php
                                $index = 1;
                                foreach ($contributors as $contributor) {
                                    if ($contributor['major'] == true) {
                                        printContributor($contributor, count($contributors), $index);
                                        $index++;
                                    }
                                }
                                echo "</div><div class='flex mt-2'>";
                                foreach ($contributors as $contributor) {
                                    if ($contributor['major'] != true) {
                                        printContributor($contributor, count($contributors), $index);
                                        $index++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mt-2 lg:mt-0 md:text-base text-sm"><?= MDToHTML($about['text']) ?></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

//Get HTML a contributor rectangle (in the About section)
function printContributor($contributor, $nbContributors, $index)
{
    $big = $contributor['major'];
?>
    <a target="_blank" title="<?= $big ? '' : $contributor['name'] ?>" href="<?= 'https://github.com/' . $contributor['username'] ?>" class="hover:text-black block bg-yellow-200 border-solid border-yellow-400 border hover:bg-yellow-300 p-1 <?= $index != $nbContributors ? 'mr-2' : '' ?>  rounded-md <?= $big ? 'h-40 w-40' : 'h-12 w-12' ?>  text-center">
        <div class="">
            <span class="<?= $big ? 'text-sm' : 'hidden' ?> mb-2"><?= $contributor['name'] ?>
                <br>@<?= $contributor['username'] ?>
            </span>
            <div class="w-full <?= $big ? '' : 'h-full' ?>  flex justify-center items-center">
                <img src="<?= $contributor['img'] ?>" alt="profil icon of <?= $contributor['username'] ?>" class="rounded-full <?= $big ? 'h-24' : '' ?>" style="border-radius: 9999px;">
            </div>
        </div>
    </a>
<?php
}

//Get HTML of the Newsletter section
function getNewsLetterSection($news)
{
    ob_start();
?>
    <div class="bg-gray-100 border-blue-300 border rounded-sm shadow-xl lg:px-6 md:px-4 sm:px-3 px-2 lg:py-4 md:py-3 sm:py-2 py-1 lg:flex block items-center md:mb-6 mb-3">
        <div style="flex: 4">
            <h2 class="text-2xl"><?= SECTIONS['newsletter'] ?></h2>
            <div class=" md:text-base text-sm">
                <?= MDToHTML($news['text']) ?>
            </div>
        </div>
        <div style="flex: 3" class="lg:pl-4">
            <div class="flex justify-center items-center">
                <?php foreach ($news['links'] as $link) { ?>
                    <div class="h-10 m-1 "><a target="_blank" href="<?= $link['link'] ?>"><img src="imgs/<?= $link['icon'] ?>" class="h-10" alt=""></a></div>
                <?php } ?>
            </div>
            <span class="text-sm text-gray-400">Inscription à la lettre d'information</span>
            <div>
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
                <script type="text/javascript" src="https://s3.amazonaws.com/phplist/phplist-subscribe-0.2.min.js"></script>

                <div id="phplistsubscriberesult" class="text-green-600"></div>
                <form action="https://kanffnews.hosted.phplist.com/lists/?p=subscribe&id=1" method="post" id="phplistsubscribeform">
                    <input type="text" name="email" value="" id="emailaddress" class="w-full p-1 outline-none focus:bg-gray-200 rounded-sm text-black md:text-base text-sm" placeholder="email@example.com" /><br>
                    <button type="submit" id="phplistsubscribe" class="bg-gray-300 hover:bg-blue-300 px-3 py-1 rounded-sm mt-2">S'inscrire</button>
                    <script type="text/javascript">
                        var pleaseEnter = "";
                    </script>
                    <script type="text/javascript">
                        var thanksForSubscribing = "<h3>Merci pour votre inscription !</h3><p>Vérifiez svp votre boîte mail et cliquez sur le lien de confirmation.</p>";
                    </script>
                </form>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

function getFooter($footer)
{
    ob_start();
?>
    <div class="w-full border px-1 bg-gray-100 rounded-sm border-gray-300 text-xs sm:text-sm">
        <?= $footer['notes'] ?>

    </div>
<?php
    return ob_get_clean();
}
?>