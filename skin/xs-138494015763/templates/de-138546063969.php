<?php
$xContentLeft = array();
$xContentRight = array();

foreach($xContent as $entry) {
	if ($entry['position'] == 'left') {
		$xContentLeft[] = $entry;
	}
	else {
		$xContentRight[] = $entry;
	}
}

$glwc_XcontentSmarty->assign('xContentLeft', $xContentLeft);
$glwc_XcontentSmarty->assign('xContentRight', $xContentRight);
$glwc_XcontentSmarty->assign('pageHeader', $nav_page_header);

?>
