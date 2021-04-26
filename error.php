<?php
ob_start();
?>
<p style="color: darkred;" class="mdstyle">Error in the configuration file <code>localconfig.json</code>.</p>

<?php
$content = ob_get_clean();
require "gabarit.php";
