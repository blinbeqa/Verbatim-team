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


$active_results = $wpdb->get_results("SELECT * FROM tendert_f1 WHERE `status`=3 ",ARRAY_A);
//var_dump($active_results);
$xml_output='<tenderet>';
foreach($active_results as $ar)
	 {
$xml_output.='
	
	
	<tenderi>
	<nr_prokurimi>'.$ar['nr_prokurimi'].'</nr_prokurimi>
	<titulli_prokurimit>'.$ar['titulli_prokurimit'].'</titulli_prokurimit>
	<data_publikimit_njoftimit_kontrate>'.$ar['data_publikimit_njoftimit_kontrate'].'</data_publikimit_njoftimit_kontrate>
	<data_publikimit_dhenje_kontrate>'.$ar['data_publikimit_dhenje_kontrate'].'</data_publikimit_dhenje_kontrate>
	<data_nenshkrimit_kontrate>'.$ar['data_nenshkrimit_kontrate'].'</data_nenshkrimit_kontrate>
	<afati_implementim_kontrate>'.$ar['afati_implementim_kontrate'].'</afati_implementim_kontrate>
	<data_permbylljes_kontrate>'.$ar['data_permbylljes_kontrate'].'</data_permbylljes_kontrate>
	<vlera_parashikuar>'.$ar['vlera_parashikuar'].'</vlera_parashikuar>
	<qmimi_kontrates>'.$ar['qmimi_kontrates'].'</qmimi_kontrates>
	<emertimi_oe>'.$ar['emertimi_oe'].'</emertimi_oe>
	<oe_v_j>'.$ar['oe_v_j'].'</oe_v_j>
	<nurmi_ofertave>'.$ar['nurmi_ofertave'].'</nurmi_ofertave>
	<afati_kohor_n_sh>'.$ar['afati_kohor_n_sh'].'</afati_kohor_n_sh>
	<komenti>'.$ar['komentar'].'</komenti>
	<njesia_gabim>'.$ar['njesia_gabim'].'</njesia_gabim>
	
	</tenderi>';
	
}
$xml_output.='</tenderet>';





//header('Content-Type: text/xml');


header('Content-Type: application/xml');
//$output = "<root><name>sample_name</name></root>";
print ($xml_output);

//var_dump($result);


//header( 'Location: http://verbatim.wethink.ch/?page_id=8' );