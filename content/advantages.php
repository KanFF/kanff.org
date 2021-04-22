<?php

function getAdvantages($advantages)
{
    $string = "";
    $textAtLeft = true; //text at left for the start element 
    foreach ($advantages as $key => $advantage) {
        $string .= buildAnAdvantage($advantage, $textAtLeft);
        if ($advantage['mode'] == 1) {
            $textAtLeft = !$textAtLeft;
        }
    }
    return $string;
}

function buildAnAdvantage($advantage, $textAtLeft)
{
    ob_start();
?>
    <div style="background-color: #f0f0f0;" class="shadow-xl rounded-sm mb-6 border-blue-500 border border-solid <?= ($textAtLeft == false && $advantage['mode'] == 1) ? 'lg:flex-row-reverse' : '' ?>
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
                <h2 class="text-2xl mb-2"><?= $advantage['name'] ?></h2>
                <div><?= $advantage['description'] ?></div>
            </div>
        </div>
        <div class="lg:py-0 block overflow-hidden pl-3" style="flex: 4;">
            <img src="imgs/<?= $advantage['img'] ?>" style="box-shadow: -2px 0px 8px 1px #aaa;" class="m-5 shadow-xl border-none m-none" alt="Image for advantage '<?= $advantage['name'] ?>'">
        </div>
    </div>

<?php
    return ob_get_clean();
}

function getBanner()
{
    ob_start();
?>
    <!-- <div><img src="imgs/banner-test.png" class="w-full rounded-none" alt=""></div> -->
    <div class="w-full bg-gray-200 h-64 flex shadow-xl border-blue-200 border border-simple rounded-sm">
        <div class="flex-1 h-full pl-2 pr-5 mt-2">
            <img src="/imgs/logo.svg" alt="" class="ml-2 h-1/3 border-none">
            <div class="text-left ml-2">
                <div class="m-none text-3xl">Beaucoup de projets commençent, peu aboutissent.</div>
            </div>
            <div class="ml-2 mt-2">
                Une application web libre de gestion de projets à l'aide de kanbans, pour les groupes, collectifs et associations.
            </div>
        </div>
        <div class="h-full overflow-hidden pl-3">
            <img src="/imgs/preview.png" style="box-shadow: -2px 0px 8px 1px #aaa;" class="h-full border-none" alt="">
        </div>
    </div>
<?php
    return ob_get_clean();
}

function getAboutSection($aboutText)
{
    ob_start();
?>
    <div class=" bg-gray-200 p-2 border-blue-600 border rounded-lg">
        <h2>A propos</h2>
        <div class="flex">
            <div class="flex-1 pr-2 mr-2"><?= $aboutText['text'] ?></div>
            <div class="border border-blue-300 py-2 px-4 rounded-md">
                <h3 class="p-0">Contributeur·ices</h3>
                <div class="flex">
                    <?php foreach ($aboutText['contributors'] as $contributor) { ?>
                        <div class="bg-blue-300 rounded-md w-40 h-44 mr-2 p-1 text-center">
                            <span class="text-sm"><?= $contributor['name'] ?> <br><a href="<?= 'https://github.com/' . $contributor['username'] ?>" class="hover:text-gray-500">@<?= $contributor['username'] ?></a></span>
                            <div class="w-full flex justify-center items-center  mt-2">
                                <img src="<?= $contributor['img'] ?>" alt="profil icon of <?= $contributor['username'] ?>" class="rounded-full h-24" style="border-radius: 9999px;">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
<?php
    return ob_get_clean();
}
?>