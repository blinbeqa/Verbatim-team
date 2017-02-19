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
$nr_prokurimi = $_POST['nr_prokurimi'];
$komentar = $_POST['komentar'];
$njesia_gabim = $_POST['njesia_gabim'];




//mysql_query("UPDATE `menu` SET `sort`=" . $i . " WHERE `id`='" . $menu[$i] . "'") or die(mysql_error());
//$active_results = $wpdb->get_row("SELECT * FROM `wp_neu_blini_sender_db` WHERE `kid`='" . $lochen . "'  ",ARRAY_A);






$result = $wpdb->query("UPDATE `tendert_f1` SET `komentar`='" . $komentar . "' , `njesia_gabim`='" . $njesia_gabim . "', `status`=3   WHERE `nr_prokurimi`='" . $nr_prokurimi . "'  ") ;



header( 'Location: http://verbatim.wethink.ch/?page_id=12' );