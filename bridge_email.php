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
$titulli_prokurimit = $_POST['titulli_prokurimit'];
$data_inicimit = $_POST['data_inicimit'];
$data_publikimit_njoftimit_kontrate = $_POST['data_publikimit_njoftimit_kontrate'];
$data_publikimit_dhenje_kontrate = $_POST['data_publikimit_dhenje_kontrate'];
$data_nenshkrimit_kontrate = $_POST['data_nenshkrimit_kontrate'];
$afati_implementim_kontrate = $_POST['afati_implementim_kontrate'];
$data_permbylljes_kontrate = $_POST['data_permbylljes_kontrate'];
$vlera_parashikuar = $_POST['vlera_parashikuar'];



//mysql_query("UPDATE `menu` SET `sort`=" . $i . " WHERE `id`='" . $menu[$i] . "'") or die(mysql_error());
//$active_results = $wpdb->get_row("SELECT * FROM `wp_neu_blini_sender_db` WHERE `kid`='" . $lochen . "'  ",ARRAY_A);

$result12 = $wpdb->query($wpdb->prepare("INSERT INTO tendert_f1 (`nr_prokurimi`,`titulli_prokurimit`,`data_inicimit`,`data_publikimit_njoftimit_kontrate`,`data_publikimit_dhenje_kontrate`,`data_nenshkrimit_kontrate`,`afati_implementim_kontrate`,`data_permbylljes_kontrate`,`vlera_parashikuar`) VALUES (%d,%s,%s,%s,%s,%s,%s,%s,%s)", array($nr_prokurimi,$titulli_prokurimit,$data_inicimit,$data_publikimit_njoftimit_kontrate,$data_publikimit_dhenje_kontrate,$data_nenshkrimit_kontrate,$afati_implementim_kontrate,$data_permbylljes_kontrate,$vlera_parashikuar)));




header( 'Location: http://verbatim.wethink.ch/?page_id=5' );