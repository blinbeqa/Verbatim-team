<?php
function find_wordpress_base_path() 
	 {
        $dir = dirname(__FILE__);
        do {
            //it is possible to check for other files here
            if( file_exists($dir."/wp-config.php") ) {
                return $dir;
            }
        } while( $dir = realpath("$dir/..") );
        return null;
    }
define( 'BASE_PATH', find_wordpress_base_path()."/" );
    define('WP_USE_THEMES', false);
    global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header, $wpdb;
    require(BASE_PATH . 'wp-load.php');
session_start();
//$_SESSION['dumpdump']=$_POST['menu'];





//mysql_query("UPDATE `menu` SET `sort`=" . $i . " WHERE `id`='" . $menu[$i] . "'") or die(mysql_error());
//$active_results = $wpdb->get_row("SELECT * FROM `wp_neu_blini_sender_db` WHERE `kid`='" . $lochen . "'  ",ARRAY_A);




$active_results = $wpdb->get_results("SELECT * FROM tendert_f1 WHERE `status`=1 ",ARRAY_A);

//$xml_output='';
foreach($active_results as $ar)
	 {
	
	
	$blini=$ar['vlera_parashikuar']-$ar['qmimi_kontrates'];
		$rinor=0.05*$ar['vlera_parashikuar'];
	if($blini>$rinor)
	{
		$result = $wpdb->query("UPDATE `tendert_f1` SET `status`=2 WHERE `tid`='" . $ar['tid'] . "'  ") ;
	}
	else
	{
		$result = $wpdb->query("UPDATE `tendert_f1` SET `status`=4 WHERE `tid`='" . $ar['tid'] . "'  ") ;
	}
	
	
}





