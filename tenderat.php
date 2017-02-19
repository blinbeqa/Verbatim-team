<?php
/**
 * Plugin Name: Tenderat
 * Plugin URI: wethink.ch
 * Description: Tendera Plugin
 * Version: 1.0.0
 * Author: Blin Beqa
 * Author URI: wethink.ch
 * License: GPL2
 */


//add_action('admin_menu', 'bewertung_plugin_setup_menu');
 
function bewertung_plugin_setup_menu(){
        add_menu_page( 'Bewertung Plugin Page', 'Bewertung Plugin', 'manage_options', 'test-plugin', 'test_init' );
}
 
function test_init(){
	session_start();
    global $wpdb;
	
	if($_SESSION['s_activate']!=NULL)
	{
		foreach($_SESSION['s_activate'] as $to_be_del)
		{
			$result = $wpdb->query("UPDATE {$wpdb->prefix}bp_activity SET `is_activated`=1 WHERE `id`=" . $to_be_del);
		}
	}
    
        
	$active_results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_activity WHERE `is_activated`=0",ARRAY_A);
	
	echo'<h1>Nicht Aktive Kommentare</h1>';
	 
	 
	 echo"<p>
Hier koennen sie nicht aktive Bewertungen der Berater sehen.</p>";
	echo '<form action="http://projekt20.wethink.ch/bridge_activate.php" method="POST">';
	 echo'<table class="tabela_admin">';
	  echo'<tr class="tabela_admin_row">';
		 echo'<td class="tabela_admin_vname" ><b>Vorname</b></td>';
		 echo'<td class="tabela_admin_name" ><b>Name</b></td>';
	     echo'<td class="tabela_admin_komentar" ><b>Kommentar</b></td>';
		 echo'<td class="tabela_admin_active" ><b>Freischalten</b></td>';
		// echo'<td><b>Meldung</b></td>';
          echo"</tr>";
		  
		  foreach($active_results as $ar)
	 {
		 $nameb1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$ar['usercheck']." AND field_id=1",ARRAY_A);
	    $vornameb1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$ar['usercheck']." AND field_id=2",ARRAY_A);
		  echo'<tr >';
		 
		 echo'<td class="tabela_admin_vname">'.$vornameb1['value']."</td>";
	     echo'<td class="tabela_admin_name" >'.$nameb1['value']."</td>";
		 echo'<td class="tabela_admin_komentar" >'.$ar['content']."</td>";
		 echo'<td class="tabela_admin_active" ><input type="checkbox" name="activate[]" value="'.$ar['id'].'"/></td>';
		// echo'<td><b>Meldung</b></td>';
          echo"</tr>";
		  
		 
		 //var_dump($ar);
	 }
       echo"</table>";
	echo '<button class="bewertung_button" name="bewertung_button">Aktualisieren</button>';
	 echo '</form>';
	//var_dump($_SESSION['s_activate']);
}



 add_shortcode('disp_bewertung', 'disp_bew');

add_action( 'wp_head', 'print_head_bew' );
 function print_head_bew ()
 {
	 
   $htmlheadtag='
   <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
   <style>
   
   .label_fields
   {
   width: 100%;
vertical-align: text-bottom;
font-weight: bold;
   }
   .tabela_admin
   {
   width: 100%;
   }
   
   .tabela_admin_vname
   {
   width: 15%;
   }
   .tabela_admin_name
   {
   width: 15%;
   }
   .tabela_admin_komentar
   {
   width: 55%;
   }
   .tabela_admin_active
   {
   width: 15%;
   }
   
   div.stars {
      width: 190px;
  
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 19px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: \'\f005\';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: \'\f006\';
  font-family: FontAwesome;
}

div.stars2 {
      width: 190px;
 
}

input.star2 { display: none; }

label.star2 {
  float: right;
  padding: 10px;
  font-size: 19px;
  color: #444;
  transition: all .2s;
}

input.star2:checked ~ label.star2:before {
  content: \'\f005\';
  color: #FD4;
  transition: all .25s;
}

input.star2-5:checked ~ label.star2:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star2-1:checked ~ label.star2:before { color: #F62; }

label.star2:hover { transform: rotate(-15deg) scale(1.3); }

label.star2:before {
  content: \'\f006\';
  font-family: FontAwesome;
}






div.stars3 {
      width: 190px;
  
}

input.star3 { display: none; }

label.star3 {
  float: right;
  padding: 10px;
  font-size: 19px;
  color: #444;
  transition: all .2s;
}

input.star3:checked ~ label.star3:before {
  content: \'\f005\';
  color: #FD4;
  transition: all .25s;
}

input.star3-5:checked ~ label.star3:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star3-1:checked ~ label.star3:before { color: #F62; }

label.star3:hover { transform: rotate(-15deg) scale(1.3); }

label.star3:before {
  content: \'\f006\';
  font-family: FontAwesome;
}


   </style>
   
   <script type="text/javascript"> 
function openwindow(url){
	  NewWindow=window.open(url,\'newWin\',\'width=500,height=300,left=20,top=20,toolbar=No,location=No,scrollbars=no,status=No,resizable=no,fullscreen=No\');  NewWindow.focus(); void(0);  }
</script>

   <script type="text/javascript"> 
function blini_super_search(){



      var textbox = document.getElementById(\'field_1\');
	  var textbox1= textbox.value;
	  
    if(/^[a-zA-Z]+$/.test(textbox.value))
  {
 
     document.getElementById("field_17").value = "";
     document.getElementById("field_1").value = textbox.value.match(/[a-zA-Z]/g).join(\'\');
  }
  else if(/^[0-9]+$/.test(textbox.value))
  {
  
  document.getElementById("field_17").value = textbox.value.match(/[0-9]/g).join(\'\');
    document.getElementById("field_1").value = "";
  }
  else
  {
 
   document.getElementById("field_17").value = textbox.value.match(/[0-9]/g).join(\'\');
     document.getElementById("field_1").value = textbox.value.match(/[a-zA-Z]/g).join(\'\');
  }
   
  
  
  
  
  
  

  
    
}
</script>
<script type="text/javascript">

jQuery(document).ready(function () {
    jQuery(document).on("keyup", function (event) {
        if (event.which == 13) {
		    blini_super_search();
            jQuery("#blini_search_button").trigger(\'click\');
			
			
        }
    });
});
</script>

<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

'
	   
	   
	   
	   ;
   echo $htmlheadtag;
 }


 function disp_bew($atts)
 {
	// require_once("sm_cron.php");
	 
	 
     ob_start();
	 
	  global $wpdb, $blog_id;
		if(isset($_SESSION['bewertung_id']) and $_SESSION['bewertung_id']!= 0 )
	{
		$id_profili=$_SESSION["bewertung_id"];
		$nameb1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=1",ARRAY_A);
	    $vornameb1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=2",ARRAY_A);
		$firmab1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=20",ARRAY_A);
		
			$nameb=$nameb1['value'];
			$vornameb=$vornameb1['value'];
			$firmab=$firmab1['value'];
			
			
			
			
	}
	 
	 $bewertung='
	 <div class="upper_layer">
	 <form action="http://verbatim.wethink.ch/bridge_email.php" method="POST">
	 <div class="inner_layer1">
	 <label class="label_title"></label>
	 <hr class="after_title_hr">
	
	 
	 <div class="container">
	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Numri rendor i prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="nr_prokurimi" placeholder="Numri rendor i prokurimit" value="'.$name.'">'.$nameErr.'<br><br>
	
		
	 <label class="label_fields">Titulli i aktivitetit te prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="titulli_prokurimit" placeholder="Titulli i aktivitetit te prokurimit" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	
	
	<div class="row">
	
	 <label class="label_fields">Data e inicimit te aktivitetit te prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_inicimit" placeholder="Data e inicimit te aktivitetit te prokurimit" value="'.$firma.'">'.$firmaErr.'<br><br>
	
	
	 <label class="label_fields">Data e publikimit të njoftimit për dhënie të kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_publikimit_njoftimit_kontrate" placeholder="Data e publikimit të njoftimit për dhënie të kontratës" value="'.$email.'">'.$emailErr.'<br><br>
	
	</div>
	
	<div class="row">
	
	 <label class="label_fields">Data e publikimit të njoftimit për dhënie të kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_publikimit_dhenje_kontrate" placeholder="Data e publikimit të njoftimit për dhënie të kontratës" value="'.$name.'">'.$nameErr.'<br><br>
	
	
	 <label class="label_fields">Data e nënshkrimit të kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_nenshkrimit_kontrate" placeholder="Data e nënshkrimit të kontratës" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	<div class="row">
	
	 <label class="label_fields">Afatet për implementimin e kontratës </label>
	 <input style="width:82%;" class="fields_input" type="text" name="afati_implementim_kontrate" placeholder="Afatet për implementimin e kontratës " value="'.$name.'">'.$nameErr.'<br><br>
	
	
	 <label class="label_fields">Data e përmbylljes së kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_permbylljes_kontrate" placeholder="Data e përmbylljes së kontratës" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	<div class="row">
	
	 <label class="label_fields">Vlera e parashikuar e kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="vlera_parashikuar" placeholder="Vlera e parashikuar e kontratës" value="'.$name.'">'.$nameErr.'<br><br>
	
	
	</div>
	
  
    </div><br><br>
	
	
	<input name="send_actin" value="set" type="hidden">
   <input type="submit" value="Submit">
	 
	 </div>
	 </form>
	 </div>
	 
	 ';
	 
	 
	 $bewertung1='
	 <div class="upper_layer">
	 <form action="http://verbatim.wethink.ch/bridge_email.php" method="POST">
	 <div class="inner_layer1">
	 <label class="label_title"></label>
	 <hr class="after_title_hr">
	
	 
	 <div class="container">
	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Numri rendor i prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="nr_prokurimi" placeholder="Numri rendor i prokurimit" value="'.$name.'">'.$nameErr.'<br><br>
	
		
	 <label class="label_fields">Titulli i aktivitetit te prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="titulli_prokurimit" placeholder="Titulli i aktivitetit te prokurimit" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	
	
	<div class="row">
	
	 <label class="label_fields">Data e inicimit te aktivitetit te prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_inicimit" placeholder="Data e inicimit te aktivitetit te prokurimit" value="'.$firma.'">'.$firmaErr.'<br><br>
	
	
	 <label class="label_fields">Data e publikimit të njoftimit për dhënie të kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_publikimit_njoftimit_kontrate" placeholder="Data e publikimit të njoftimit për dhënie të kontratës" value="'.$email.'">'.$emailErr.'<br><br>
	
	</div>
	
	<div class="row">
	
	 <label class="label_fields">Data e publikimit të njoftimit për dhënie të kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_publikimit_dhenje_kontrate" placeholder="Data e publikimit të njoftimit për dhënie të kontratës" value="'.$name.'">'.$nameErr.'<br><br>
	
	
	 <label class="label_fields">Data e nënshkrimit të kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_nenshkrimit_kontrate" placeholder="Data e nënshkrimit të kontratës" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	<div class="row">
	
	 <label class="label_fields">Afatet për implementimin e kontratës </label>
	 <input style="width:82%;" class="fields_input" type="text" name="afati_implementim_kontrate" placeholder="Afatet për implementimin e kontratës " value="'.$name.'">'.$nameErr.'<br><br>
	
	
	 <label class="label_fields">Data e përmbylljes së kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="data_permbylljes_kontrate" placeholder="Data e përmbylljes së kontratës" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	<div class="row">
	
	 <label class="label_fields">Vlera e parashikuar e kontratës</label>
	 <input style="width:82%;" class="fields_input" type="text" name="vlera_parashikuar" placeholder="Vlera e parashikuar e kontratës" value="'.$name.'">'.$nameErr.'<br><br>
	
	
	</div>
	
  
    </div><br><br>
	
	
	<input name="nori_1" value="set" type="hidden">
   <input type="submit" value="Submit">
	 
	 </div>
	 </form>
	 </div>
	 
	 ';
	 
	
	 
	 if($_SESSION["clear_step_verify"]=="set")
	 {
		  global $wpdb, $blog_id;
		 
		 $id1= $_SESSION["id_bridge"];
	    $hash1=  $_SESSION["hash_bridge"];
		 
		 $result = $wpdb->query("UPDATE {$wpdb->prefix}bp_activity SET `is_activated`=0 WHERE `id`=" . $id1);
		  session_unset(); 
		 
		 echo "email ok";
		 
	 }
	 elseif($_SESSION["clear_step"]=="set")
	 {
		 global $wpdb, $blog_id;
		 $action="";
		 $primary_link="";
		 $content=$_SESSION["txtcomment_bridge"];
		 
		  if($_SESSION["sstar"]==1)
		 {
			 $content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar"]==2)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==3)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==4)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==5)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 if($_SESSION["sstar2"]==1)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar2"]==2)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==3)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==4)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==5)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 if($_SESSION["sstar3"]==1)
		 {
			 $content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar3"]==2)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==3)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==4)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==5)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		  if($_SESSION["sstar4"]==1)
		 {
			 $content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar4"]==2)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==3)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==4)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==5)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 
		 $date_recorded=date('Y-m-d H:i:s');
		 $hash= md5($date_recorded);
		 $star=($_SESSION["sstar"]+$_SESSION["sstar2"]+$_SESSION["sstar3"]+$_SESSION["sstar4"])/4;
		 $usercheck=$_SESSION["bewertung_id"];
		 $email=$_SESSION["email_bridge"];
		 $emailb=$_SESSION["emailb_bridge"];
		 
		 $result = $wpdb->query($wpdb->prepare(
                    "
            INSERT INTO {$wpdb->prefix}bp_activity
            ( user_id, component, type ,action, content, primary_link,
              item_id, secondary_item_id, date_recorded, hide_sitewide,
              mptt_left, mptt_right, star, usercheck, anonymous,logged_out,is_activated)
            VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %d, %d)
        ", array(
                1,
                "Members",
                "Member_review",
                $action,
                $content,
                $primary_link,
                "0",
                "0",
                $date_recorded,
                "0",
                "0",
                "0",
                $star,
                $usercheck,
                1,
                1,
                2
                    )
    ));
	$lastid = $wpdb->insert_id;	
	
	$activityID=$lastid;
	$metaName=$_SESSION["sname"].",".$_SESSION["email_bridge"].",".$_SESSION["stel1"];
	$metaValue=$_SESSION["sname"];
	
	
	$result12 = $wpdb->query($wpdb->prepare("INSERT INTO {$wpdb->prefix}bp_activity_meta(`activity_id`, `meta_key`, `meta_value`) VALUES (%d,%s,%s)", array($activityID, $metaName, $metaValue)));

     $to      = $email; // Send email to our user
$subject = 'Email Verification'; // Give the email a subject 
$message = '
 

 

 
link to activate:
http://projekt20.wethink.ch/bridge_email.php?id='.$lastid.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@wethink.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

if($emailb != "")
	{
		$to      = $emailb; // Send email to our user
$subject = 'Beratercheck'; // Give the email a subject 
$message = '
 
Hallo, Sie wurden gerade von '.$_SESSION["sname"].' auf Beratercheck bewertet.

Sie koennen hier einen Profil erstellen.

http://projekt20.wethink.ch/register/
 
'; // Our message above including the link
                     
$headers = 'From:noreply@wethink.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
		
	}

	
	echo $_SESSION["sstar"];
	echo $_SESSION["sstar2"];
	echo $_SESSION["sstar3"];
		 session_unset(); 
	 echo "confirm email bla bla :";
		 echo $email;
		 
	 }
	 elseif($_SESSION["clear_step"]!="set" and $_SESSION["bewertung_id"] != "")
     {
		 
		 
		echo $bewertung;
	 
	 }
	 elseif($_SESSION["clear_step"]!="set" and $_SESSION["bewertung_id"] == "")
     {
		 
		 
		echo $bewertung1;
	 
	 }
	 
	  
	 
    
	$output_sm = ob_get_contents();
    ob_end_clean();

    return $output_sm;

 }
 
 
 add_shortcode('disp_bewertung1', 'disp_bew1');
 
 function disp_bew1($atts)
 {
	// require_once("sm_cron.php");
	 
	 
     ob_start();
	 
	  global $wpdb, $blog_id;
		if(isset($_SESSION['bewertung_id']) and $_SESSION['bewertung_id']!= 0 )
	{
		$id_profili=$_SESSION["bewertung_id"];
		$nameb1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=1",ARRAY_A);
	    $vornameb1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=2",ARRAY_A);
		$firmab1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=20",ARRAY_A);
		
			$nameb=$nameb1['value'];
			$vornameb=$vornameb1['value'];
			$firmab=$firmab1['value'];
			
			
			
			
	}
	 
	 $bewertung='
	 <div class="upper_layer">
	 <form action="http://verbatim.wethink.ch/bridge_email_1.php" method="POST">
	 <div class="inner_layer1">
	 <label class="label_title"></label>
	 <hr class="after_title_hr">
	
	 
	 <div class="container">
	 
	 	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Numri rendor i prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="nr_prokurimi" placeholder="Numri rendor i prokurimit" value="'.$name.'">'.$nameErr.'<br><br>
	
		
	 
	
	</div>
	 
	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Çmimi i kontratës, duke përfshirë të gjitha taksat etj. </label>
	 <input style="width:82%;" class="fields_input" type="text" name="qmimi_kontrates" placeholder="Çmimi i kontratës, duke përfshirë të gjitha taksat etj." value="'.$name.'">'.$nameErr.'<br><br>
	
		
	 <label class="label_fields">Emri i OE të cilit i është dhënë kontrata</label>
	 <input style="width:82%;" class="fields_input" type="text" name="emertimi_oe" placeholder="Emri i OE të cilit i është dhënë kontrata" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	
	
	<div class="row">
	
	 <label class="label_fields">OE  vendor (1) ; Jo vendor (2)</label>
	 <input style="width:82%;" class="fields_input" type="text" name="oe_v_j" placeholder="Data e inicimit te aktivitetit te prokurimit" value="'.$firma.'">'.$firmaErr.'<br><br>
	
	
	 <label class="label_fields">Numri i ofertave të dorëzuara</label>
	 <input style="width:82%;" class="fields_input" type="text" name="nurmi_ofertave" placeholder="Numri i ofertave të dorëzuara" value="'.$email.'">'.$emailErr.'<br><br>
	
	</div>
	
	<div class="row">
	
	 <label class="label_fields">Afati kohor normal (1) Afati kohor i shkurtuar (2)</label>
	 <input style="width:82%;" class="fields_input" type="text" name="afati_kohor_n_sh" placeholder="Afati kohor normal (1) Afati kohor i shkurtuar (2)" value="'.$name.'">'.$nameErr.'<br><br>
	
	
	 
	
	</div>
	

	
  
    </div><br><br>
	
	
	<input name="send_actin" value="set" type="hidden">
   <input type="submit" value="Submit">
	 
	 </div>
	 </form>
	 </div>
	 
	 ';
	 
	 
	 $bewertung1='
	  <div class="upper_layer">
	 <form action="http://verbatim.wethink.ch/bridge_email_1.php" method="POST">
	 <div class="inner_layer1">
	 <label class="label_title"></label>
	 <hr class="after_title_hr">
	
	 
	 <div class="container">
	 
	 	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Numri rendor i prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="nr_prokurimi" placeholder="Numri rendor i prokurimit" value="'.$name.'">'.$nameErr.'<br><br>
	
		
	 
	
	</div>
	 
	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Çmimi i kontratës, duke përfshirë të gjitha taksat etj. </label>
	 <input style="width:82%;" class="fields_input" type="text" name="qmimi_kontrates" placeholder="Çmimi i kontratës, duke përfshirë të gjitha taksat etj." value="'.$name.'">'.$nameErr.'<br><br>
	
		
	 <label class="label_fields">Emri i OE të cilit i është dhënë kontrata</label>
	 <input style="width:82%;" class="fields_input" type="text" name="emertimi_oe" placeholder="Emri i OE të cilit i është dhënë kontrata" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	
	
	<div class="row">
	
	 <label class="label_fields">OE  vendor (1) ; Jo vendor (2)</label>
	 <input style="width:82%;" class="fields_input" type="text" name="oe_v_j" placeholder="Data e inicimit te aktivitetit te prokurimit" value="'.$firma.'">'.$firmaErr.'<br><br>
	
	
	 <label class="label_fields">Numri i ofertave të dorëzuara</label>
	 <input style="width:82%;" class="fields_input" type="text" name="nurmi_ofertave" placeholder="Numri i ofertave të dorëzuara" value="'.$email.'">'.$emailErr.'<br><br>
	
	</div>
	
	<div class="row">
	
	 <label class="label_fields">Afati kohor normal (1) Afati kohor i shkurtuar (2)</label>
	 <input style="width:82%;" class="fields_input" type="text" name="afati_kohor_n_sh" placeholder="Afati kohor normal (1) Afati kohor i shkurtuar (2)" value="'.$name.'">'.$nameErr.'<br><br>
	
	
	 
	
	</div>
	

	
  
    </div><br><br>
	
	
	<input name="send_actin" value="set" type="hidden">
   <input type="submit" value="Submit">
	 
	 </div>
	 </form>
	 </div>
	 
	 ';
	 
	
	 
	 if($_SESSION["clear_step_verify"]=="set")
	 {
		  global $wpdb, $blog_id;
		 
		 $id1= $_SESSION["id_bridge"];
	    $hash1=  $_SESSION["hash_bridge"];
		 
		 $result = $wpdb->query("UPDATE {$wpdb->prefix}bp_activity SET `is_activated`=0 WHERE `id`=" . $id1);
		  session_unset(); 
		 
		 echo "email ok";
		 
	 }
	 elseif($_SESSION["clear_step"]=="set")
	 {
		 global $wpdb, $blog_id;
		 $action="";
		 $primary_link="";
		 $content=$_SESSION["txtcomment_bridge"];
		 
		  if($_SESSION["sstar"]==1)
		 {
			 $content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar"]==2)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==3)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==4)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==5)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 if($_SESSION["sstar2"]==1)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar2"]==2)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==3)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==4)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==5)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 if($_SESSION["sstar3"]==1)
		 {
			 $content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar3"]==2)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==3)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==4)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==5)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		  if($_SESSION["sstar4"]==1)
		 {
			 $content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar4"]==2)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==3)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==4)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==5)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 
		 $date_recorded=date('Y-m-d H:i:s');
		 $hash= md5($date_recorded);
		 $star=($_SESSION["sstar"]+$_SESSION["sstar2"]+$_SESSION["sstar3"]+$_SESSION["sstar4"])/4;
		 $usercheck=$_SESSION["bewertung_id"];
		 $email=$_SESSION["email_bridge"];
		 $emailb=$_SESSION["emailb_bridge"];
		 
		 $result = $wpdb->query($wpdb->prepare(
                    "
            INSERT INTO {$wpdb->prefix}bp_activity
            ( user_id, component, type ,action, content, primary_link,
              item_id, secondary_item_id, date_recorded, hide_sitewide,
              mptt_left, mptt_right, star, usercheck, anonymous,logged_out,is_activated)
            VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %d, %d)
        ", array(
                1,
                "Members",
                "Member_review",
                $action,
                $content,
                $primary_link,
                "0",
                "0",
                $date_recorded,
                "0",
                "0",
                "0",
                $star,
                $usercheck,
                1,
                1,
                2
                    )
    ));
	$lastid = $wpdb->insert_id;	
	
	$activityID=$lastid;
	$metaName=$_SESSION["sname"].",".$_SESSION["email_bridge"].",".$_SESSION["stel1"];
	$metaValue=$_SESSION["sname"];
	
	
	$result12 = $wpdb->query($wpdb->prepare("INSERT INTO {$wpdb->prefix}bp_activity_meta(`activity_id`, `meta_key`, `meta_value`) VALUES (%d,%s,%s)", array($activityID, $metaName, $metaValue)));

     $to      = $email; // Send email to our user
$subject = 'Email Verification'; // Give the email a subject 
$message = '
 

 

 
link to activate:
http://projekt20.wethink.ch/bridge_email.php?id='.$lastid.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@wethink.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

if($emailb != "")
	{
		$to      = $emailb; // Send email to our user
$subject = 'Beratercheck'; // Give the email a subject 
$message = '
 
Hallo, Sie wurden gerade von '.$_SESSION["sname"].' auf Beratercheck bewertet.

Sie koennen hier einen Profil erstellen.

http://projekt20.wethink.ch/register/
 
'; // Our message above including the link
                     
$headers = 'From:noreply@wethink.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
		
	}

	
	echo $_SESSION["sstar"];
	echo $_SESSION["sstar2"];
	echo $_SESSION["sstar3"];
		 session_unset(); 
	 echo "confirm email bla bla :";
		 echo $email;
		 
	 }
	 elseif($_SESSION["clear_step"]!="set" and $_SESSION["bewertung_id"] != "")
     {
		 
		 
		echo $bewertung;
	 
	 }
	 elseif($_SESSION["clear_step"]!="set" and $_SESSION["bewertung_id"] == "")
     {
		 
		 
		echo $bewertung1;
	 
	 }
	 
	  
	 
    
	$output_sm = ob_get_contents();
    ob_end_clean();

    return $output_sm;

 }
 
  add_shortcode('disp_bewertung2', 'disp_bew2');
 
 function disp_bew2($atts)
 {
	// require_once("sm_cron.php");
	 
	 
     ob_start();
	 
	  global $wpdb, $blog_id;
		if(isset($_SESSION['bewertung_id']) and $_SESSION['bewertung_id']!= 0 )
	{
		$id_profili=$_SESSION["bewertung_id"];
		$nameb1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=1",ARRAY_A);
	    $vornameb1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=2",ARRAY_A);
		$firmab1 = $wpdb->get_row("SELECT DISTINCT value FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id=".$id_profili." AND field_id=20",ARRAY_A);
		
			$nameb=$nameb1['value'];
			$vornameb=$vornameb1['value'];
			$firmab=$firmab1['value'];
			
			
			
			
	}
	 
	 $bewertung='
	 <div class="upper_layer">
	 <form action="http://verbatim.wethink.ch/bridge_email_2.php" method="POST">
	 <div class="inner_layer1">
	 <label class="label_title"></label>
	 <hr class="after_title_hr">
	
	 
	 <div class="container">
	 
	 	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Numri rendor i prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="nr_prokurimi" placeholder="Numri rendor i prokurimit" value="'.$name.'">'.$nameErr.'<br><br>
	
		
	 
	
	</div>
	 
	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Raporti mbi tenderin</label>
	 <textarea name="komentar" style="width:100%; height: 70px;" maxlength="5005" placeholder="Raporti mbi tenderin" ></textarea><br>
	
		
	 <label class="label_fields">Njesia e llogaritur gabimisht</label>
	 <input style="width:82%;" class="fields_input" type="text" name="njesia_gabim" placeholder="Formati: Njesia1:Qmimi,Njesia2:Qmimi" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	
	

	
  
    </div><br><br>
	
	
	<input name="send_actin" value="set" type="hidden">
   <input type="submit" value="Submit">
	 
	 </div>
	 </form>
	 </div>
	 
	 ';
	 
	 
	 $bewertung1='
	  <div class="upper_layer">
	 <form action="http://verbatim.wethink.ch/bridge_email_2.php" method="POST">
	 <div class="inner_layer1">
	 <label class="label_title"></label>
	 <hr class="after_title_hr">
	
	 
	 <div class="container">
	 
	 	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Numri rendor i prokurimit</label>
	 <input style="width:82%;" class="fields_input" type="text" name="nr_prokurimi" placeholder="Numri rendor i prokurimit" value="'.$name.'">'.$nameErr.'<br><br>
	
		
	 
	
	</div>
	 
	<div class="row">
	
	
	
	
	
	 <label class="label_fields">Raporti mbi tenderin</label>
	 <textarea name="komentar" style="width:100%; height: 70px;" maxlength="5005" placeholder="Raporti mbi tenderin" ></textarea><br>
	
		
	 <label class="label_fields">Njesia e llogaritur gabimisht</label>
	 <input style="width:82%;" class="fields_input" type="text" name="njesia_gabim" placeholder="Formati: Njesia1:Qmimi,Njesia2:Qmimi" value="'.$vorname.'">'.$vornameErr.'<br><br>
	
	</div>
	
	
	

	
  
    </div><br><br>
	
	
	<input name="send_actin" value="set" type="hidden">
   <input type="submit" value="Submit">
	 
	 </div>
	 </form>
	 </div>
	 
	 ';
	 
	
	 
	 if($_SESSION["clear_step_verify"]=="set")
	 {
		  global $wpdb, $blog_id;
		 
		 $id1= $_SESSION["id_bridge"];
	    $hash1=  $_SESSION["hash_bridge"];
		 
		 $result = $wpdb->query("UPDATE {$wpdb->prefix}bp_activity SET `is_activated`=0 WHERE `id`=" . $id1);
		  session_unset(); 
		 
		 echo "email ok";
		 
	 }
	 elseif($_SESSION["clear_step"]=="set")
	 {
		 global $wpdb, $blog_id;
		 $action="";
		 $primary_link="";
		 $content=$_SESSION["txtcomment_bridge"];
		 
		  if($_SESSION["sstar"]==1)
		 {
			 $content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar"]==2)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==3)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==4)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar"]==5)
		 {
			$content.='<br><br>'.'Fachkompetenz    <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 if($_SESSION["sstar2"]==1)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar2"]==2)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==3)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==4)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar2"]==5)
		 {
			$content.='<br><br>'.'Auftreten        <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 if($_SESSION["sstar3"]==1)
		 {
			 $content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar3"]==2)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==3)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==4)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar3"]==5)
		 {
			$content.='<br><br>'.'Weiterempfehlung <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		  if($_SESSION["sstar4"]==1)
		 {
			 $content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		 }
		 elseif($_SESSION["sstar4"]==2)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==3)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==4)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star_off.png"></span>';
		  
		 }
		 elseif($_SESSION["sstar4"]==5)
		 {
			$content.='<br><br>'.'Angebot <span class="ratingtop"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"><img alt="1 star" src="http://projekt20.wethink.ch/wp-content/plugins/bp-wp-profile-page-post-reviews/images/star.png"></span>';
		  
		 }
		 
		 $date_recorded=date('Y-m-d H:i:s');
		 $hash= md5($date_recorded);
		 $star=($_SESSION["sstar"]+$_SESSION["sstar2"]+$_SESSION["sstar3"]+$_SESSION["sstar4"])/4;
		 $usercheck=$_SESSION["bewertung_id"];
		 $email=$_SESSION["email_bridge"];
		 $emailb=$_SESSION["emailb_bridge"];
		 
		 $result = $wpdb->query($wpdb->prepare(
                    "
            INSERT INTO {$wpdb->prefix}bp_activity
            ( user_id, component, type ,action, content, primary_link,
              item_id, secondary_item_id, date_recorded, hide_sitewide,
              mptt_left, mptt_right, star, usercheck, anonymous,logged_out,is_activated)
            VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %d, %d)
        ", array(
                1,
                "Members",
                "Member_review",
                $action,
                $content,
                $primary_link,
                "0",
                "0",
                $date_recorded,
                "0",
                "0",
                "0",
                $star,
                $usercheck,
                1,
                1,
                2
                    )
    ));
	$lastid = $wpdb->insert_id;	
	
	$activityID=$lastid;
	$metaName=$_SESSION["sname"].",".$_SESSION["email_bridge"].",".$_SESSION["stel1"];
	$metaValue=$_SESSION["sname"];
	
	
	$result12 = $wpdb->query($wpdb->prepare("INSERT INTO {$wpdb->prefix}bp_activity_meta(`activity_id`, `meta_key`, `meta_value`) VALUES (%d,%s,%s)", array($activityID, $metaName, $metaValue)));

     $to      = $email; // Send email to our user
$subject = 'Email Verification'; // Give the email a subject 
$message = '
 

 

 
link to activate:
http://projekt20.wethink.ch/bridge_email.php?id='.$lastid.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@wethink.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

if($emailb != "")
	{
		$to      = $emailb; // Send email to our user
$subject = 'Beratercheck'; // Give the email a subject 
$message = '
 
Hallo, Sie wurden gerade von '.$_SESSION["sname"].' auf Beratercheck bewertet.

Sie koennen hier einen Profil erstellen.

http://projekt20.wethink.ch/register/
 
'; // Our message above including the link
                     
$headers = 'From:noreply@wethink.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
		
	}

	
	echo $_SESSION["sstar"];
	echo $_SESSION["sstar2"];
	echo $_SESSION["sstar3"];
		 session_unset(); 
	 echo "confirm email bla bla :";
		 echo $email;
		 
	 }
	 elseif($_SESSION["clear_step"]!="set" and $_SESSION["bewertung_id"] != "")
     {
		 
		 
		echo $bewertung;
	 
	 }
	 elseif($_SESSION["clear_step"]!="set" and $_SESSION["bewertung_id"] == "")
     {
		 
		 
		echo $bewertung1;
	 
	 }
	 
	  
	 
    
	$output_sm = ob_get_contents();
    ob_end_clean();

    return $output_sm;

 }
 
 add_shortcode('disp_bewertung3', 'disp_bew3');
 
 function disp_bew3($atts)
 {
	 $pull_quote_atts = shortcode_atts( array(
        'cat' => 'Category',
        
    ), $atts );
 $num_att=0;
	// require_once("sm_cron.php");
	 
	 
     ob_start();
	 
	  global $wpdb, $blog_id;
	  
      //blinifaq_create_db();
	  
	  	$active_results = $wpdb->get_results("SELECT * FROM tendert_f1 WHERE `status`=3 ORDER BY tid ",ARRAY_A);
	
	echo'<h1></h1>';
	 
	 echo '<br>';
	// echo"<p>Hier koennen sie alle Sender sehen.</p>";
	//echo '<form action="http://projekt20.wethink.ch/bridge_activate_senden.php" method="POST">';
	 echo'<table  id="keywords"  class="tabela_sender tablesorter">';
	 echo '<thead>';
	  echo'<tr  class="tabela_sender_row">';
		 echo'<th class="tabela_sender_senderplatz" ><b>Numri rendor i prokurimit</b></th>';
		 echo'<th class="tabela_sender_senderlogo" ><b>Titulli i aktivitetit te prokurimit</b></th>';
	     echo'<th class="tabela_sender_sendername" ><b>Data e inicimit te aktivitetit te prokurimit</b></th>';
		 echo'<th class="tabela_sender_hd" ><b>Data e publikimit të njoftimit për dhënie të kontratës</b></th>';
		 echo'<th class="tabela_sender_versch" ><b>Data e publikimit të njoftimit për dhënie të kontratës</b></th>';
		 echo'<th class="tabela_sender_sprache" ><b>Data e nënshkrimit të kontratës</b></th>';
		 echo'<th class="tabela_sender_freq" ><b>Afatet për implementimin e kontratës</b></th>';
		  echo'<th class="tabela_sender_sprache" ><b>Data e përmbylljes së kontratës</b></th>';
		 echo'<th class="tabela_sender_freq" ><b>Vlera e parashikuar e kontratës</b></th>';
		 echo'<th class="tabela_sender_sprache" ><b>Çmimi i kontratës, duke përfshirë të gjitha taksat etj. </b></th>';
		 echo'<th class="tabela_sender_freq" ><b>Emri i OE të cilit i është dhënë kontrata</b></th>';
		  echo'<th class="tabela_sender_freq" ><b>Numri i ofertave të dorëzuara</b></th>';
		 
		 //echo'<td class="tabela_sender_cat" ><b>Category</b></td>';
		 
		// echo'<td><b>Meldung</b></td>';
          echo"</tr>";
		   echo '</thead>';
		  echo '<tbody >';
		  foreach($active_results as $ar)
	 {
		
		  echo'<tr >';
		 
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['nr_prokurimi'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['titulli_prokurimit'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['data_inicimit'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['data_publikimit_njoftimit_kontrate'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['data_publikimit_dhenje_kontrate'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['data_nenshkrimit_kontrate'].'</td>';
		  echo'<td class="tabela_sender1_senderplatz" >'.$ar['afati_implementim_kontrate'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['data_permbylljes_kontrate'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['vlera_parashikuar'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['qmimi_kontrates'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['emertimi_oe'].'</td>';
		 echo'<td class="tabela_sender1_senderplatz" >'.$ar['nurmi_ofertave'].'</td>';
		 
		  
		 
		 //echo'<td class="tabela_sender1_cat" >'.$ar['cat'].'</td>';
		
		 //echo'<td class="tabela_admin_active" ><input type="checkbox" name="activate[]" value="'.$ar['kid'].'"/></td>';
		// echo'<td><b>Meldung</b></td>';
          echo"</tr>";
		  
		 
		 //var_dump($ar);
	 }
	  echo '</tbody>';
       echo"</table>";
	//echo '<button class="artani1_button" name="bewertung_button">Aktualisieren</button>';
	 //echo '</form>'
	 
    
	$output_sm = ob_get_contents();
    ob_end_clean();

    return $output_sm;

 }
 
 //http://www.cssscript.com/simple-5-star-rating-system-with-css-and-html-radios/


