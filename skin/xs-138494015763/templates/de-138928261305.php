<?php

$span = 3;

if ($xContent[0]['imagebox4'] == '') {
	$span = 4;
}

if ($xContent[0]['imagebox3'] == '') {
	$span = 6;
}

$glwc_XcontentSmarty->assign('span', $span);
?>
