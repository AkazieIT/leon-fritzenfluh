<?php 
/***************************************\
Navigationsgenerator: HANDLE WITH CARE!
\***************************************/
//echo $id;
//echo get_root($id);
function getChildren($id) {
	global $dbh;
	$sql_nav = "SELECT nav_id FROM nav
	    WHERE nav_stat < 15
	    AND nav_dat_pub < '".get_SQL_date()."'
	    AND nav_dat_kill > '".get_SQL_date()."'
	    AND nav_parent = '$id'";
	$result_nav = mysql_query($sql_nav,$dbh) or die ("Fehler bei Zugriff auf Navigation");
	if (mysql_num_rows($result_nav)) {
		return true;
	}
	return false;
}


$nav_level = 0;
$last_parent = $lng . '-root';
$nav_str = '<ul class="nav clearfix">'."\n";
$subnav_str = '<ul class="subnav clearfix">'."\n";
$first = true;
foreach($nav_tree as $v1) {
//print_r($v1);
	if (!$skip_home) {
		if ($first == true) {
			$first = false;
		}
		else {
			if ($nav_level < $v1['level']) {  //new item is onhigher level
				$start_tag = "\n".'<ul class="dropdown-menu">'."\n";
			}
			else if ($nav_level > $v1['level']) {  //new item ison lower level
				$dif_level = $nav_level - $v1['level'];
				$start_tag = '';
				for ($i = 0; $i < $dif_level; $i++) {
					$start_tag .= '</li>'."\n".'</ul>'."\n";
				}
				$start_tag .= '</li>'."\n";
			}
			else {  //new item is on same level
				$start_tag = '</li>'."\n";
			}
		}
		$actClass = $v1['act'] == 'act'
			  ? 'current'
			  : '';
		if (true === getChildren($v1['id'])) {
			$nav_str .= $start_tag.'<li class="dropdown '. $actClass. '"><a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$v1['name'].'</a>';
		}
		else {
			//echo $v1['parent'];
			$nav_str .= $start_tag.'<li class="'. $actClass. '"><a href="'.$v1['link'].'">'.$v1['name'].'</a>';
			if ((int)$v1['level'] > 0 && $v1['parent'] == get_root($id)) {
				$subnav_str .= '<li class="'. $actClass. '"><a href="'.$v1['link'].'">'.$v1['name'].'</a></li>';
			}

		}
	}
	$nav_level = $v1['level'];
	$last_parent = $v1['parent'];
	$skip_home = false;
}
//echo $nav_level;
for ($i = 0; $i < $nav_level; $i++) {
	$nav_str .= '</li>'."\n".'</ul>'."\n";
}
$nav_str .= '</li>'."\n".'</ul>'."\n";
$subnav_str .= '</ul>'."\n";



$glwc_Smarty->assign("glwp_NavLevel0Plus", $nav_str);
$glwc_Smarty->assign("glwp_SubNav", $subnav_str);
?>