<?php
/*
Plugin Name: IE6 warning
Plugin URI: http://dany-the-red.net/developpement/ie6-warning
Description: IE6 Warning message. Help the web getting ride of IE6. Based on "Shockingly Big IE6 Warning" plugin by mschertel
Author: Daniel Nautr&eacute;
Version: 0.6
Author URI: http://dany-the-red.net
*/

/*
Copyright 2010  (email : daniel.nautre@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_action('template_redirect', 'ie6w_head');
add_action('admin_menu', 'ie6_menu');
add_action('admin_init', 'ie6_settings');


function ie6_menu() 
{
	add_options_page('IE6 Warning options', 'IE6 Warning', 'administrator', 'ie6-warning06', 'ie6_options');
}

function ie6_options() 
{
	
	$available = array('en' => 'English', 'fr' => 'Fran&ccedil;ais');
	$actual_lang = get_option('ie6_language');
	
	echo '	<div class="wrap">
			<h2>IE6 Warning options</h2>
			<form method="post" action="options.php">';
	settings_fields('ie6-settings');
	echo '	<label for="language">',_e('Language'),'</label>
			<select name="ie6_language" id="language">';
	
	
	foreach($available as $language => $name)
	{
		if($language == $actual_lang)
		{
			echo '<option value="',$language,'" selected="selected">',$name,'</option>';
		}
		else
		{
			echo '<option value="',$language,'">',$name,'</option>';
		}
	}
			
	echo '	</select><br />
			
			<input type="submit" class="button-primary" value="',_e('Save Changes'),'" />
			</form>
			</div>';
}

function ie6_settings()
{
	register_setting( 'ie6-settings', 'ie6_language');
}


function ie6w_head() 
{
	$language_txt['en'] = '<strong style="color:red;">WARNING</strong>: You are using Internet Explorer 6 or an older version, a browser that is not sure and that doesn\'t respect web standards. It is highly recommended to switch to a more modern browser.';
	$language_txt['fr'] = '<strong style="color:red;">ATTENTION</strong>: Vous utilisez Internet Explorer 6 ou une version ant&eacute;rieur, un navigateur peu sur et qui ne respecte pas les standards du web, il est fortement conseill&eacute; d\'installer un navigateur plus moderne.';

	$display = $language_txt[get_option('ie6_language')];

	echo 
	'
	<!--[if lte IE 6]>
		<div id="ie6w_div" style="overflow: hidden; z-index: 1500; left: 0px; top: 0px; height: 34px; width:100%; background-color: rgb(255, 255, 0); font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; color: rgb(0, 0, 0); clear: both; border-bottom: 1px solid rgb(0, 0, 0);">
			<div id="ie6w_icon" style="overflow: hidden; position: absolute; left: 0px; top: 0px; height: 28px; width: 30px; padding: 3px;">
				<img style="width:30px; height:28px;" src="/wp-content/plugins/ie6-warning/img/alert.gif">
			</div>
			<div id="ie6w_text" style="overflow: hidden; position: absolute; left: 36px; top: 0px; height: 28px; width:85%; padding: 3px; text-align: left;">
				',$display,'
			</div>
			<div id="ie6w_browsers" style="overflow: hidden; position: absolute; right: 0px; top: 0px; height: 28px; width:15%; padding: 3px;">
				<a href="http://www.mozilla.com/en-US/">
					<img style="width:28px; height:28px;" alt="get Firefox!" src="/wp-content/plugins/ie6-warning/img/firefox.gif">
				</a>
				<a href="http://www.opera.com/">
					<img style="width:28px; height:28px;" alt="get Opera!" src="/wp-content/plugins/ie6-warning/img/opera.gif">
				</a>
				<a href="http://www.google.com/chrome/">
					<img style="width:28px; height:28px;" alt="get Chrome!" src="/wp-content/plugins/ie6-warning/img/chrome.gif">
				</a>
				<a href="http://www.apple.com/safari/">
					<img style="width:28px; height:28px;" alt="get Safari!" src="/wp-content/plugins/ie6-warning/img/safari.gif">
				</a>
				<a href="http://www.microsoft.com/windows/ie/">
					<img style="width:28px; height:28px;" alt="get IE7!" src="/wp-content/plugins/ie6-warning/img/ie.gif">
				</a>
			</div>
		</div>
	<![endif]-->
	';
}

?>