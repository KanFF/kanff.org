<?php

//Get HTML of the top banner with slogan, logo, description and other contents.
function getBanner($kanff)
{
    ob_start();
?>
    <!-- <div><img src="imgs/banner-test.png" class="w-full rounded-none" alt=""></div> -->
    <div class="w-auto py-4 xl:py-2 mb-12 mt-12 xl:flex xs:block shadow-xl overflow-hidden rounded-sm border-solid border border-gray-300">
        <div class="flex-1 flex items-center pl-2 ">
            <div class="w-full">
                <img src="imgs/logo.svg" alt="" class="w-full h-24 border-none mb-3">
                <div class=" mx-4">
                    <div class="m-none text-3xl text-center"><?= $kanff['slogan'] ?></div>
                </div>
                <div class="mx-4 mt-2 text-center mb-1">
                    <?= $kanff['definition'] ?>
                </div>
                <div class="mx-4 mt-2 text-center text-sm mb-1">
                    <?= $kanff['explanation'] ?>
                </div>
                <div class="mx-4 mt-2 text-center text-sm mb-1 flex justify-center">
                    <a href="https://github.com/samuelroland/KanFF/stargazers" class="border px-1 bg-gray-100 hover:bg-gray-200 rounded-sm border-gray-300 flex items-center" target="_blank">
                        <span class="flex items-center text-sm">
                            <img class="inline h-4 mr-1" src="imgs/star.png" alt=""> 8
                        </span>
                    </a>
                    <span class="ml-1 border px-1 bg-gray-100 rounded-sm border-gray-300 flex items-center text-sm">
                        1220 commits
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
    $string = "<div class='mb-12'>";
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
    <div style="background-color: #f0f0f0;" class="overflow-hidden pt-2 shadow-xl rounded-sm mb-8 border-blue-300 border border-solid <?= ($textAtLeft == false && $advantage['mode'] == 1) ? 'lg:flex-row-reverse' : '' ?>
    <?php switch ($advantage['mode']) {
        case 2:
            echo 'block';
        default:
            echo 'lg:flex sm:block';
    } ?>">
        <div class="px-6 flex 
        <?php switch ($advantage['mode']) {
            case 2:
                echo 'py-4';
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
                <div class="text-2xl mb-2"><?= $advantage['name'] ?></div>
                <div class="text-base"><?= MDToHTML($advantage['description']) ?></div>
            </div>
        </div>
        <div class="mx-3 mt-2 flex justify-center" style="flex: 4;">
            <img src="imgs/<?= $advantage['img'] ?>" class="border-none rounded-md rounded-b-none shadow-2xl" alt="Image for advantage '<?= $advantage['name'] ?>'" style="max-height: 70vh;">
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
    <div class=" bg-gray-100 py-4 border-blue-300 border rounded-sm shadow-xl lg:px-6 md:px-4 sm:px-3 px-2 flex items-center mb-6">
        <div class="">
            <div>
                <div class="text-3xl"><?= SECTIONS['about'] ?></div>
                <div class="flex-1 mr-6 mt-2">
                    <?= MDToHTML($about['intro']) ?>
                </div>
            </div>
            <hr class="border-blue-300 my-2">
            <div class="flex">
                <div>
                    <div class="text-2xl mb-2 mt-1"><?= SECTIONS['contributors'] ?></div>
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
                        <div class="mt-2 lg:mt-0"><?= MDToHTML($about['text']) ?></div>
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
    <div class="bg-gray-100 py-4 border-blue-300 border rounded-sm shadow-xl lg:px-6 md:px-4 sm:px-3 px-2 flex items-center mb-6">
        <div style="flex: 4">
            <div class="text-2xl"><?= SECTIONS['newsletter'] ?></div>
            <div>
                <?= MDToHTML($news['text']) ?>
            </div>
        </div>
        <div style="flex: 3" class="pl-4">
            <div class="flex justify-center items-center">
                <?php foreach ($news['links'] as $link) { ?>
                    <div class="h-10 m-1 "><a target="_blank" href="<?= $link['link'] ?>"><img src="imgs/<?= $link['icon'] ?>" class="h-10" alt=""></a></div>
                <?php } ?>
            </div>
            <div>
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
                <script type="text/javascript" src="https://s3.amazonaws.com/phplist/phplist-subscribe-0.2.min.js"></script>

                <div id="phplistsubscriberesult" class="text-green-600"></div>
                <form action="https://kanffnews.hosted.phplist.com/lists/?p=subscribe&id=1" method="post" id="phplistsubscribeform">
                    <input type="text" name="email" value="" id="emailaddress" class="w-full p-1 outline-none focus:bg-gray-200 rounded-sm text-black" placeholder="email@example.com" /><br>
                    <button type="submit" id="phplistsubscribe" class="bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded-sm mt-4">S'inscrire</button>
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
?>