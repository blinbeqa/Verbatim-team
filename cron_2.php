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




$active_results = $wpdb->get_results("SELECT * FROM tendert_f1 WHERE `status`=2 AND `mail_send`=0 ",ARRAY_A);

foreach($active_results as $ar)
	 {
	$to      = 'blinbeqa@hotmail.com'; // Send email to our user
$subject = 'Kerkesa per Raport'; // Give the email a subject 
$message = '
 
JU lutemi te plotesoni raportin per tenderin me emer: '.$ar['titulli_prokurimit'].' dhe me numer te Prukourimit: '.$ar['nr_prokurimi'].'
 
 
'; // Our message above including the link
                     
$headers = 'From:verbatim@rks-gov.net' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
	
	$result = $wpdb->query("UPDATE `tendert_f1` SET `status`=2 , `mail_send`=1 WHERE `tid`='" . $ar['tid'] . "'  ") ;
}



