<?php

//Get HTML of the top banner with slogan, logo, description and other contents.
function getBanner($kanff)
{
	ob_start();
?>
	<!-- <div><img src="imgs/banner-test.png" class="w-full rounded-none" alt=""></div> -->
	<div class="sm:mx-0 mx-2 w-auto py-4 xl:py-2 md:my-12 my-6 xl:flex xs:block shadow-xl overflow-hidden rounded-sm border-solid border border-gray-300">
		<div class="flex-1 flex items-center px-2 ">
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
				<div class="mx-4 pt-1 text-center text-sm mb-1 flex justify-center flex-wrap items-center">
					<!-- TODO: translate the shields description -->
					<object class="h-5 mr-1 mb-1" data="https://img.shields.io/github/stars/samuelroland/KanFF?color=green&label=Étoiles&link=https://github.com/samuelroland/KanFF/stargazers" alt="Stars number"></object>
					<object class="h-5 mr-1 mb-1" data="https://img.shields.io/github/contributors/samuelroland/KanFF?color=blue&label=Contributeur%C2%B7ices&link=https://github.com/samuelroland/KanFF/contributors" alt="Contributors number"></object>
					<object class="h-5 mr-1 mb-1" data="https://img.shields.io/badge/Version-En%20cours%20de%20d%C3%A9veloppement.-ffc437?link=https://github.com/samuelroland/kanFF/releases" alt="Stars number"></object>
					<!--<object class="h-5 mr-1 mb-1" data="https://img.shields.io/github/commit-activity/y/samuelroland/KanFF?color=yellowgreen&label=Activit%C3%A9%20en%20commits" alt="Contributors number">
					</object>-->
				</div>
				<div class="mx-4 text-center text-sm mb-1">
					<?= MDToHTML($kanff['pronunciation']) ?>
				</div>
			</div>
		</div>
		<div class="items-center justify-center xs:w-full xl:justify-end py-2 xl:flex hidden">
			<img src="imgs/preview.png" style="margin-right: -2px" class="border-none shadow-xl " alt="">
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
	<div style="background-color: #f0f0f0;" class="overflow-hidden pt-2 shadow-xl sm:rounded-sm md:mb-8 mb-4 border-blue-300 border border-r-0 border-l-0 sm:border-r sm:border-l border-solid <?= ($textAtLeft == false && $advantage['mode'] == 1) ? 'lg:flex-row-reverse' : '' ?>
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
				<h2 class="text-2xl mb-2"><?= $advantage['name'] ?></h2>
				<div class="md:text-base text-sm"><?= MDToHTML($advantage['description']) ?></div>
			</div>
		</div>
		<div class="lg:mx-3 md:mx-2 mx-1 mt-2" style="flex: 4;">
			<?php
			if (isset($advantage['caption'])) {
				if ($advantage['caption'] != '') { ?>
					<div class="w-full flex <?= $textAtLeft ? 'justify-end' : 'justify-start' ?> text-sm">
						<div class="py-1 shadow-md px-2 italic rounded-md rounded-b-none bg-gray-200 border border-gray-300 border-b-0 w-fully w-max <?= $textAtLeft ? 'md:text-right' : 'md:text-left ' ?>  text-center sm:text-sm text-xs">
							<?= $advantage['caption'] ?>
						</div>
					</div>
			<?php }
			}
			?>
			<img src="imgs/<?= $advantage['img'] ?>" class="border-none sm:rounded-md rounded-sm sm:rounded-b-none <?= $textAtLeft ? 'sm:rounded-tr-none' : 'sm:rounded-tl-none' ?>  shadow-2xl" alt="Advantage '<?= $advantage['name'] ?>'" style="">

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
	<div id="about" class=" bg-gray-100 border-blue-300 border border-r-0 border-l-0 sm:border-r sm:border-l  sm:rounded-sm shadow-xl lg:px-6 md:px-4 sm:px-3 px-2 lg:py-4 md:py-3 sm:py-2 py-1 flex items-center md:mb-6 mb-3">
		<div class="w-full">
			<div>
				<h2 class="text-2xl"><?= SECTIONS['about'] ?></h2>
				<div class="flex-1 mr-6 mt-2  md:text-base text-sm">
					<?= MDToHTML($about['intro']) ?>
				</div>
			</div>
			<hr class="border-blue-300 my-2">
			<div class="flex w-full">
				<div class="w-full">
					<h3 class="text-xl mb-2 mt-1"><?= SECTIONS['contributors'] ?></h3>
					<div class="lg:flex block w-full">
						<div class="mr-2">
							<div class="flex w-full">
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
						<div class="mt-2 lg:mt-0 md:text-base text-sm w-full"><?= MDToHTML($about['text']) ?></div>
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
	<a target="_blank" title="<?= $big ? '' : $contributor['name'] ?>" href="<?= 'https://github.com/' . $contributor['username'] ?>" class="hover:text-black block border-solid border-gray-300 border hover:border-yellow-400 hover:bg-yellow-200 overflow-hidden p-1 <?= $index != $nbContributors ? 'mr-2' : '' ?>  rounded-md <?= $big ? 'h-36 w-44' : 'h-12 w-12' ?>  text-center">
		<div class="h-full flex flex-col">
			<span class="<?= $big ? 'text-sm' : 'hidden' ?> my-1"><?= $contributor['name'] ?>
			</span>
			<div class="w-full h-full <?= $big ? '' : 'h-full' ?>  flex justify-center items-center">
				<img src="<?= $contributor['img'] ?>" alt="profil <?= $contributor['username'] ?>" class="rounded-full text-xs <?= $big ? 'h-20' : '' ?>" style="border-radius: 9999px;">
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
	<div id="news" class="bg-gray-100 border-blue-300 border border-r-0 border-l-0 sm:border-r sm:border-l  sm:rounded-sm shadow-xl lg:px-6 md:px-4 sm:px-3 px-2 lg:py-4 md:py-3 sm:py-2 py-1 lg:flex block items-center md:mb-6 mb-3">
		<div style="flex: 4">
			<h2 class="text-2xl mb-2"><?= SECTIONS['newsletter'] ?></h2>
			<div class=" md:text-base text-sm">
				<?= MDToHTML($news['text']) ?>
			</div>
		</div>
		<div style="flex: 3" class="lg:pl-4">
			<div class="sm:flex items-center">
				<span class="text-sm text-gray-400 mr-3"><?= $news['follow-social-networks'] ?></span>
				<div class="flex justify-center items-center">
					<?php foreach ($news['links'] as $link) { ?>
						<div class="h-10 m-1 "><a target="_blank" href="<?= $link['link'] ?>" title="<?= $link['name'] ?>"><img src="imgs/<?= $link['icon'] ?>" class="h-10" alt=""></a></div>
					<?php } ?>
					<div class="h-10 m-1 rounded-full bg-gray-200 hover:bg-gray-300 w-10 flex items-center justify-center text-2xl cursor-help" title="D'autres réseaux sociaux alternatifs seront ajoutés prochainement...">···</div>
				</div>
			</div>
			<span class="text-sm text-gray-400"><?= $news['newsletter-subscription'] ?></span>
			<div>
				<script src="js/jquery-1.5.2.min.js"></script>
				<script src="js/phplist-subscribe-0.2.min.js"></script>

				<div id="phplistsubscriberesult" class="text-green-600"></div>
				<form action="https://kanffnews.hosted.phplist.com/lists/?p=subscribe&id=1" method="post" id="phplistsubscribeform">
					<input type="text" name="email" value="" id="emailaddress" class="w-full p-1 outline-none focus:bg-gray-200 rounded-sm text-black md:text-base text-sm" placeholder="<?= $news['email-placeholder'] ?>" /><br>
					<button type="submit" id="phplistsubscribe" class="bg-gray-300 hover:bg-blue-300 px-3 py-1 rounded-sm mt-2">S'inscrire</button>
					<script>
						var waitImage = "js/busy.gif";
						var pleaseEnter = "";
						var thanksForSubscribing = "<h3 class='text-xl'><?= $news['subscription-response-title'] ?></h3><p class='md:text-base text-sm'><?= $news['subscription-response-text'] ?></p>";
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
	<div id="footer" class="w-full border  border-r-0 border-l-0 sm:border-r sm:border-l px-1 bg-gray-100 sm:rounded-sm border-gray-300 text-xs sm:text-sm">
		<?= $footer['notes'] ?>

	</div>
<?php
	return ob_get_clean();
}
?>