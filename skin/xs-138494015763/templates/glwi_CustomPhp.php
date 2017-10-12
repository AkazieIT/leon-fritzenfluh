<?php 
/****************************************************************************************\
For your personal PHP Code. ENJOY!
\****************************************************************************************/

$home_id = $lng . '-11105527671928';

$body_class = get_root($id) == $home_id
	    ? 'home'
	    : 'follow';

$glwc_Smarty->assign("bodyClass", $body_class);

?>