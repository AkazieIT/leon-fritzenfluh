<?php
$boxes_id = 'de-138505675344';
$boxes_tpl_id = 'de-138505657795';

$events_id = 'de-138494429444';
$events_tpl_id = 'de-138546063969';

require_once(DOC_ROOT.'/_lib/xcontent_reader.class.php');

//get boxes
$tpl_file = DOC_ROOT.'/skin/'.$def_skin.'/templates/'.$boxes_tpl_id.'.xml';
$xfields = simplexml_load_file($tpl_file);
$newsReader = new XcontentReader($xfields->content);
$boxes = array();

$sql = "SELECT nav_page.*, page.*";
$sql .= " FROM nav_page, page";
$sql .= " WHERE nav_page.nav_page_page_id = page.page_id";
$sql .= " AND nav_page.nav_page_nav_id = '$boxes_id'";
$sql .= " AND page.page_stat < 11";
$sql .= " AND page.page_dat_pub < '".get_SQL_date()."'";
$sql .= " AND page.page_dat_kill > '".get_SQL_date()."'";
$sql .= " ORDER BY page_ord, page_dat_pub DESC";
//echo $sql;
$result = mysql_query($sql,$dbh);
if (mysql_num_rows($result)) {
	$i = 0;
	//echo mysql_num_rows($result);
	while ($row = mysql_fetch_array($result)) {
		$entry_id = $row['page_id'];
		$entry = $row['page_text'];
		$entry = simplexml_load_string($entry);
		$newsReader->LoadData($entry);
		$boxes[$i] = $newsReader->WriteXmlToArray();
		$boxes[$i]['page_name'] = $row['page_title'];
		$boxes[$i]['pid'] = $row['page_id'];
		$boxes[$i]['cpid'] = substr($row['page_id'],3);
		$boxes[$i] = array_map("parse_out", $boxes[$i]);
		$i++;
	}
}

//print_r($boxes);

//get events
$tpl_file = DOC_ROOT.'/skin/'.$def_skin.'/templates/'.$events_tpl_id.'.xml';
$xfields = simplexml_load_file($tpl_file);
$newsReader = new XcontentReader($xfields->content);
$events = array();

$sql = "SELECT nav_page.*, page.*";
$sql .= " FROM nav_page, page";
$sql .= " WHERE nav_page.nav_page_page_id = page.page_id";
$sql .= " AND nav_page.nav_page_nav_id = '$events_id'";
$sql .= " AND page.page_stat < 11";
$sql .= " AND page.page_dat_pub < '".get_SQL_date()."'";
$sql .= " AND page.page_dat_kill > '".get_SQL_date()."'";
$sql .= " ORDER BY page_ord, page_dat_pub DESC";
//echo $sql;
$result = mysql_query($sql,$dbh);
if (mysql_num_rows($result)) {
	$i = 0;
	//echo mysql_num_rows($result);
	while ($row = mysql_fetch_array($result)) {
		$entry_id = $row['page_id'];
		$entry = $row['page_text'];
		$entry = simplexml_load_string($entry);
		$newsReader->LoadData($entry);
		$events[$i] = $newsReader->WriteXmlToArray();
		$events[$i]['page_name'] = $row['page_title'];
		$events[$i]['pid'] = $row['page_id'];
		$events[$i]['cpid'] = substr($row['page_id'],3);
		$events[$i]['link'] = WEB_ROOT . '/' . parse_mod_rewrite('index.php?id=' . $events_id) . '#e' . $i;
		$events[$i] = array_map("parse_out", $events[$i]);
		if ($i >= 2) {
			break;
		}
		$i++;
	}
}

//print_r($events);

$events_link = WEB_ROOT . '/' . parse_mod_rewrite('index.php?id=' . $events_id);

$glwc_XcontentSmarty->assign('boxes', $boxes);
$glwc_XcontentSmarty->assign('events', $events);
$glwc_XcontentSmarty->assign('eventsLink', $events_link);

$homeClaim = '<h1>' . $xContent[0]['title'] . '</h1>' . $xContent[0]['description'];
$homeBox = $xContent[0]['homebox'];

$glwc_Smarty->assign("homeClaim", $homeClaim);
$glwc_Smarty->assign("homeBox", $homeBox);
?>