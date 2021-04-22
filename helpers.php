<?php

/**
 *  Project: onepageMD
 *  File: helpers.php helpers functions used by several files
 *  Author: Samuel Roland
 *  Creation date: 20.02.2021
 */
function MDToHTML($raw)
{
    require_once "vendor/erusev/parsedown/Parsedown.php";
    $Parsedown = new Parsedown();
    return $Parsedown->text($raw);
}

//Check config.json validity before loading the one page
function checkConfigBeforeLoading()
{
    //TODO: write validity checks
}

function getRawMDForAGivenLanguage($language_id)
{
    $filepath = "content/content-" . $language_id . ".md";
    if (file_exists($filepath) == false) {
        return false;
    }
    return file_get_contents($filepath);
}

function isLanguageAvailable($lang)
{
    $config = getConfig();
    $contents = $config['content']['content-files'];
    foreach ($contents as $content) {
        if ($content['id'] == $lang) {
            return true;
        }
    }
    return false;
}

function getConfig()
{
    return json_decode(file_get_contents("config.json"), true);
}

function prefixURLIfRelative($url)
{
    if (substr($url, 0, 7) != "http://" || substr($url, 0, 8) != "https://") {
        return "http://" . $url;
    }
    return $url;
}

function getTextVersion()
{
    $config = getConfig();
    $contents = $config['content']['content-files'];
    $highestVersion = null;
    foreach ($contents as $content) {
        if ($content['version'] > $highestVersion) {
            $highestVersion = $content['version'];
        }
    }
    return $highestVersion;
}

//Return if the string start with the specified substring
function startwith($text, $with)
{
    return (substr($text, 0, strlen($with)) == $with);
}

function contains($haystack, $needle)
{
    return (strpos($haystack, $needle) !== false);
}


function DTToHumanDate($datetime, $mode = "simpleday", $isTimestamp = false)
{
    $timestamp = $datetime;

    if ($isTimestamp == false) {
        $timestamp = strtotime($datetime);
    }
    switch ($mode) {
        case "simpleday":
            return date("d.m.Y", $timestamp);
            break;
        case "simpletime":
            return date("d.m.Y à H:i", $timestamp);
            break;
        case "completeday":
            return date("j F Y", $timestamp);
            break;
        case "completetime":
            return date("j F Y à H:i:s", $timestamp);
            break;
        default:
            return "ERROR!";
            break;
    }
}

//Trim value of spaces, tab, ... in " \t\n\r\0\x0B"
function trimIt($string)
{
    return trim($string, " \t\n\r\0\x0B");
}

//Create HTML element with a copylink icon for a link to a section of the manual
function createCopyLinkIconForManual($section)
{
    return "<span data-hrefcopy='" . $_SERVER['HTTP_HOST'] . "/#" . createKeyNameForElementId($section) . "' class='inline-block cursor-pointer ml-3 iconsToCopySection items-center'>" . printAnIcon("copy.svg", "Copier le lien de cette section.", "copy link icon", "inline w-7 p-1 mb-0 border-none hover:bg-gray-300 bg-gray-200", false) . "</span>";
}

//Get the title in html (including the id attribute), if the line is a title (no other possibility to add the id to the title in markdown).
function getTitleWithIdAttributeInHTMLIfIsTitle($line, $startWith, $markup)
{
    if (startwith($line, $startWith) == false) {    //if the line is not a title
        return $line;   //return the unchanged line
    } else {
        $text = trimIt(substr($line, strpos($line, $startWith) + strlen($startWith), strrpos($line, "</") - strpos($line, $startWith) - strlen($startWith)));  //get the text after the space (the space is after the symbol at the start of line)
        $id = createKeyNameForElementId($text);    //convert to lowercase, replace accent chars, and replace " " and "'"
        $result = "<$markup id='" . $id . "' class=''>" . $text . createCopyLinkIconForManual($text) . "</$markup>";  //ex: "<h1 id='introduction'>Introduction</h1>"

        //Add the copylink icon:
        // $result .= createCopyLinkIconForManual($text);

        $result .= "";
        return $result;
    }
}

//Get table of content element in Markdown, if the line is a title
function getTableOfContentElementInMDIfIsTitle($line, $startWith, $level)
{
    if (startwith($line, $startWith) == false) {    //if line is not a markdown title, return "" to add nothing to the list
        return "";
    } else {
        $tabs = "";
        for ($i = 0; $i < $level - 1; $i++) {   //create tabulations before each TOC line to create the different levels of titles
            $tabs .= "  ";
        }
        /*if ($level != 1) {
            $tabs .= "-";
        }*/
        $text = trimIt(substr($line, strpos($line, $startWith) + strlen($startWith), strrpos($line, "</") - strpos($line, $startWith) - strlen($startWith)));  //get the text after the space (the space is after the symbol at the start of line)
        $id = createKeyNameForElementId($text);
        $result = "$tabs- [$text](#$id)\n";  //ex: "    - [Introduction](#introduction)" (here with 1 tab if title is level 2).
        return $result;
    }
}

//print (or return) an icon with a file, a title, alt attribute, and personalized or default css classes
function printAnIcon($iconname, $title, $alt, $cssClasses = "icon-small ml-2 mr-2", $echo = true, $id = "", $hidden = false)
{
    if ($id != "") {    //if not null
        $id = "id='$id'";   ///build attribute string
    }   //if null the $id will just be "" so attribute id will not exist at all.
    $html = "<img title=\"" . $title . "\" class=\"$cssClasses\" src='icons/$iconname' $id alt='$alt' " . (($hidden) ? "hidden" : "") . ">";
    if ($echo) {
        echo $html;
    } else {
        return $html;
    }
}

define("ARRAY_ACCENT_CHARS", array(
    'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
    'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
    'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
    'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
    'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'Ğ' => 'G', 'İ' => 'I', 'Ş' => 'S', 'ğ' => 'g', 'ı' => 'i', 'ş' => 's', 'ü' => 'u'
));
//replace accent chars like é, à, ... with the corresponding letter without accent.
function replaceAccentChars($string)
{
    return strtr($string, ARRAY_ACCENT_CHARS);
}

function indexAnArrayById($array)
{
    $newarray = [];
    foreach ($array as $item) {
        $newarray[$item['id']] = $item;
    }
    return $newarray;
}

function createKeyNameForElementId($text)
{
    $anchor = clearAllNonAlphabeticalChars(strtolower(replaceAccentChars(str_replace(" ", "-", str_replace("'", "-", trimIt($text))))), "-");
    return $anchor;
}


function clearAllNonAlphabeticalChars($text, $exceptions = "")
{
    $characters = str_split('0123456789abcdefghijklmnopqrstuvwxyz' . $exceptions);

    $newText = "";
    foreach (str_split($text) as $char) {
        if (in_array($char, $characters) == true) {
            $newText .= $char;
        }
    }
    return $newText;
}


function lauchOperationsOnContent($rawTextContent)
{
    $linkImages = "https://raw.githubusercontent.com/samuelroland/KanFF/develop/doc";
    $linkDocGithub = "https://github.com/samuelroland/KanFF/tree/develop/doc";
    $dev = true;
    //Get the documentation content:
    $doc = $rawTextContent;
    $msg = null;
    $doc = MDToHTML($doc);

    //Manage and work on the content:
    $lines = explode("\n", $doc);   //explode the documentation to work with each line separately
    $toc = "\n\n";  //insert line break at start and end of TOC to avoid error in interpretation of Parsedown.
    foreach ($lines as $key => $line) {
        for ($i = 1; $i <= 6; $i++) {
            $toc .= getTableOfContentElementInMDIfIsTitle($line, "<h$i>", $i);  //concat the markdown text of the list element to the TOC if the line is title level 1
            $line = getTitleWithIdAttributeInHTMLIfIsTitle($line, "<h$i>", "h$i");    //get the html text of the title with his attribute id if the line is title level 1
        }
        $lines[$key] = $line;   //save final value of line (updated if is title, no change if not).
    }
    $toc .= "\n";   //insert line break at start and end of TOC to avoid error in interpretation of Parsedown.

    $tocInLines = explode("\n", MDToHTML($toc));
    foreach ($tocInLines as $key => $line) {
        if (contains($line, "<a")) {
            $line = substr($line, 0, strpos($line, "<a") + 2) . " class='linkOfTOC' " . substr($line, strpos($line, "<a") + 2);
        }
        $tocInLines[$key] = $line;
    }
    $toc = implode("", $tocInLines);

    $currentLinesAreComment = false;    //the current lines are inside some comments and must be not included
    foreach ($lines as $key => $line) {
        $acceptLine = true; //the current line is accepted (or not)

        //Manage images and relative linkss
        if ((strpos($line, "src") != false || strpos($line, "href") != false) && strpos($line, "http") == false) {    //if line contains src or href and doesn't contain http (absolute links)
            if (strpos($line, "/icons/") != false) {    //for little icons
                $additionnalCssForImages = "icon-middlesmall nomargin noborder";
            } else if (strpos($line, "manual_title.png") != false) {  //for the title banner
                $additionnalCssForImages = "fullwidth mt-3 mb-0";
            } else {
                $additionnalCssForImages = "width-max-content"; //for other illustrations images
            }
            $line = str_replace("src=\"", " onerror='this.src = \"icons/imagenotfound.png\"; this.style.height = \"50px\"; this.classList = \"\"; ' class=\"$additionnalCssForImages \" src=\"$linkImages/", $line);
            $line = str_replace("href=\"", "target='_blank' href=\"$linkDocGithub/", $line);
        }

        //Extract the version number in the cartouche at the top
        if (startwith($line, " *  Version:")) {
            $docVersion = substr($line, strrpos($line, " ") + 1);
            $docVersion = htmlentities($docVersion);
        }

        //Extract the version date in the cartouche at the top
        if (startwith($line, " *  Versiondate:")) {
            $posSpaceBeforeDate = strrpos($line, " ", (strlen($line) - strrpos($line, " ")) * (-1) - 3);
            $docVersionDate = substr($line, $posSpaceBeforeDate + 1);
            $docVersionDate = htmlentities($docVersionDate);
            $docVersionDate = DTToHumanDate($docVersionDate, "simpletime");
        }

        //if line is a HTML comment start, the whole line will be excluded
        if (contains($line, "<!--")) {
            $currentLinesAreComment = true; //current and next lines will be inside the comment markup
        }
        if (contains($line, "[INSERT TOC HERE]")) { //if line contains mention to insert the table of content
            $line = "<div style='display: flex; align-items: center;' class='flexdiv  box-verticalaligncenter'><h2 id=\"table-des-matieres\" class=\"width-max-content\">Table des matières</h2>" . createCopyLinkIconForManual("Table des matières") .
                "</div><div class='mdTOC'>" . MDToHTML($toc) . "</div>";    //insert the table of content on this line
        }
        if ($currentLinesAreComment == false && $acceptLine == true) {  //if current lines are no comments and the line is accepted
            $newLines[] = $line;    //include the line in the list of new lines
        }
        if (contains($line, "-->")) {   //if it's the end of comments, no other comments will be after.
            $currentLinesAreComment = false;
        }
    }
    $doc = implode("\n", $newLines);
    return $doc;
}

//Extract the main title (the first "# ..." title of level1) in the markdown raw text, if config main title is [INSIDE]
function extractMainTitleInRawMDContent($config, $content)
{
    $maintitle = $config['main-title'];
    if ($maintitle == "[INSIDE]") {
        $startPositionTitle = strpos($content, "# ");
        if ($startPositionTitle !== false) {
            $startPositionTitle = strpos($content, "# ") + 2;
            $titleInMD = substr($content, $startPositionTitle, strpos($content, "\n", $startPositionTitle + 1) - $startPositionTitle);
            $maintitle = $titleInMD;
        } else {
            $maintitle = "No title";
        }
    }
    return $maintitle;
}

//Remove the main title in the markdown raw text, regardless the config
function removeTheMainTitleInRawMDContent($content)
{
    $newContent = "";
    foreach (explode("\n", $content) as $line) {
        if (strpos(trim($line), "# ") !== 0) {   //validate the line only if it's not a h1 title (start with "# ")
            $newContent .= "\n" . $line;
        }
    }
    return $newContent;
}

//Interpolate values stored in $values inside reference ({keyname}) in $content
function interpolateValuesInContent($content, $values)
{
    $words =  preg_split("/[{}]/", $content);   //split with '{' or '}', then some of the $words will be equal to $values key
    foreach ($words as $key => $word) {
        if (in_array($word, array_keys($values))) {
            $words[$key] = $values[$word];    //save the value that replaced the {yyy}
        }
    }
    $content = implode("", $words);
    return $content;
}
