<?php

/*
Plugin Name: Bizify.me
Plugin Script: bizifyme.php
Plugin URI: https://www.bizify.me/wordpress/
Description: Activates Bizify.me on your WordPress blog. Bizify.me is an e-commerce solution with an included payment gateway that supports VISA, MasterCard, American Express and mobile payments by SMS.
Version: 1.6.6
Author: Bizify.me
Author URI: https://www.bizify.me
License: GPLv2 or later
*/

$plugin_version = '1.6.6';

if(isset($_GET["html"]))
{
	?>
	
	<!DOCTYPE HTML>
	<HTML>
	<HEAD>
	<STYLE>
	html, body
	{
		height: 100%;
		margin: 0px;
		padding: 0px;
	}
	</STYLE>
	</HEAD>
	<BODY>
	
	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
	<tr valign="middle">
	<td align="center">
	<IMG SRC="loader.gif" BORDER="0" WIDTH="64" HEIGHT="64" />
	</td>
	</tr>
	</table>
	
	<script type="text/javascript">
	window.top.send_to_editor('<?php echo preg_replace("/\r|\n/", "", strip_tags($_GET['html'], "<p><br><a><object><param><embed>")) ?>');
	</script>
	
	</BODY>
	</HTML>
	
	<?php
	exit;
}

if(!function_exists('add_action'))
{
	echo 'Hi there! I\'m just a plugin. Not much I can do when called directly.';
	exit;
}

function bizifyme_script()
{
	if(is_ssl())
	{
		wp_enqueue_script('bizifyme', 'https://js.bizify.me/1.1/', false, null, true);
	}
	else
	{
		wp_enqueue_script('bizifyme', 'http://js.bizify.me/1.1/', false, null, true);
	}
}

function bizifyme_image_shortcode($attributes, $content = null)
{
	$src = '';
	$alt = '';
	$width = '';
	$height = '';
	$class = '';
	$style = '';
	
	extract(shortcode_atts(array('src' => '', 'alt' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => ''), $attributes));
	
	if($class === '') $class = 'no-lazy';
	else $class = $class . ' no-lazy';
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
	return '<img alt="' . $alt . '" src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" />';
}

function bizifyme_player_shortcode($attributes, $content = null)
{
	$src = '';
	$width = '';
	$height = '';
	$class = '';
	$style = '';
	
	extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => 'border: none'), $attributes));
	
	if($class === '') $class = 'no-lazy';
	else $class = $class . ' no-lazy';
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
	if($width > 0 && $height > 0)
	{
		return '<div class="BizifyMeContent" style="max-width: ' . $width . 'px;"><div class="BizifyMeIframe" style="padding-bottom: ' . str_replace(",", ".", round($height / $width * 100, 2)) . '%;"><iframe src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" allowfullscreen="true"></iframe></div></div>';
	}
	else
	{
		return '<iframe src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" allowfullscreen="true"></iframe>';
	}
}

function bizifyme_video_shortcode($attributes, $content = null)
{
	$src = '';
	$width = '';
	$height = '';
	$class = '';
	$style = '';
	
	extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => ''), $attributes));
	
	if($class === '') $class = 'no-lazy';
	else $class = $class . ' no-lazy';
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
	return '<video src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" controls="controls"></video>';
}

function bizifyme_audio_shortcode($attributes, $content = null)
{
	$src = '';
	$width = '';
	$height = '';
	$class = '';
	$style = '';
	
	extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => ''), $attributes));
	
	if($class === '') $class = 'no-lazy';
	else $class = $class . ' no-lazy';
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
	return '<audio src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" controls="controls"></audio>';
}

function bizifyme_live_shortcode($attributes, $content = null)
{
	$src = '';
	$width = '';
	$height = '';
	$class = '';
	$style = '';
	$chat = '';
	$align = '';
	$html = '';
	
	extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'chat' => '', 'align' => '', 'class' => '', 'style' => ''), $attributes));
	
	if($class === '') $class = 'no-lazy';
	else $class = $class . ' no-lazy';
	
	if($style === '') $style = 'position: absolute; top: 0px; left: 0px; max-width: 100%; height: 100%; border: none;';
	else $style = 'position: absolute; top: 0px; left: 0px; max-width: 100%; height: 100%; border: none; ' . $style;
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
	if($align === 'center')
	{
		$html .= '<div style="max-width: ' . $width . 'px; margin-left: auto; margin-right: auto;">';
	}
	else if($align === 'left')
	{
		$html .= '<div style="max-width: ' . $width . 'px; margin-right: auto;">';
	}
	else if($align === 'right')
	{
		$html .= '<div style="max-width: ' . $width . 'px; margin-left: auto;">';
	}
	else
	{
		$html .= '<div style="max-width: ' . $width . 'px;">';
	}
	
	$html .= '<div style="position: relative; padding-bottom: 75%;">';
	$html .= '<iframe id="BizifyLiveCam" src="' . $src . '" width="' . $width . '" height="' . $height . '" allowfullscreen="true" class="' . $class . '" style="' . $style . '"></iframe>';
	$html .= '</div>';
	
	if($chat === 'white')
	{
		$html .= '<div id="BizifyChatWhite"></div>';
		$html .= '<script type="text/javascript" src="//bizify.me/js/chat.js"></script>';
	}
	else if($chat === 'black')
	{
		$html .= '<div id="BizifyChatBlack"></div>';
		$html .= '<script type="text/javascript" src="//bizify.me/js/chat.js"></script>';
	}
	
	$html .= '</div>';
	
	return $html;
}

function bizifyme_media_button()
{
	global $plugin_version;
	
	if(get_bloginfo('version') >= 3.3)
	{
		echo '<a href="' . esc_url('https://bizify.me/login/?callback=' . urlencode(plugins_url('bizifyme.php', __FILE__ )) . '&shortcode=true&version=' . $plugin_version . '&TB_iframe=true') . '" class="thickbox" title="' . __('Sell your digital products using Bizify.me', 'bizifyme') . '"><button type="button" class="button" data-editor="content"><span class="bizifyme-buttons-icon" style="background: url(\'' . esc_url( plugins_url('icon.png', __FILE__ ) ) . '\') no-repeat top left;"></span> ' . __('Sell Media / Product', 'bizifyme') . '</button></a>';
	}
	else
	{
		echo '<a href="' . esc_url('https://bizify.me/login/?callback=' . urlencode(plugins_url('bizifyme.php', __FILE__ )) . '&shortcode=true&version=' . $plugin_version . '&TB_iframe=true') . '" class="thickbox" title="' . __('Sell your digital products using Bizify.me', 'bizifyme') . '"><img src="' . esc_url( plugins_url('icon.png', __FILE__ ) ) . '" alt="' . __('Sell your digital products using Bizify.me', 'bizifyme') . '" /></a>';
	}
}

function bizifyme_admin()
{
	wp_register_style('prefix-style', plugins_url('admin.css', __FILE__));
	wp_enqueue_style('prefix-style');
	
	wp_enqueue_script('bizifyme_admin', plugins_url('admin.js', __FILE__ ), array('media-upload'), null, true);
}

function bizifyme_wp()
{
	wp_register_style('prefix-style', plugins_url('bizifyme.css', __FILE__));
	wp_enqueue_style('prefix-style');
}

function bizifyme_init()
{
	load_plugin_textdomain('bizifyme', false, dirname(plugin_basename( __FILE__ )) . '/languages/');
}

class options_bizifyme
{
	function __construct()
	{
		add_action('admin_menu', array($this, 'admin_menu'));
		add_filter('cron_schedules', array($this, 'cron_15minutes'));
		add_action('bizifyme_cron', array($this, 'import_feed'));
	}
	
	function admin_menu()
	{
		add_menu_page('Bizify.me', 'Bizify.me', 'edit_posts', 'bizifyme-menu-1', array($this, 'welcome_page'), esc_url( plugins_url('icon.png', __FILE__ ) ));
		add_submenu_page('bizifyme-menu-1', __('Getting started', 'bizifyme'), __('Getting started', 'bizifyme'), 'edit_posts', 'bizifyme-menu-1', array($this, 'welcome_page'));
		add_submenu_page('bizifyme-menu-1', __('Settings', 'bizifyme'), __('Settings', 'bizifyme'), 'manage_options', 'bizifyme-menu-2', array($this, 'settings_page'));
	}
	
	function cron_15minutes($schedules)
	{
		$schedules['15minutes'] = array('interval' => 900, 'display' => __('Every 15 Minutes', 'bizifyme'));
		return $schedules;
	}
	
	function welcome_page()
	{
		global $plugin_version;
		
		echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div><h2>' . __('Getting started with Bizify.me', 'bizifyme') . '</h2>';
		echo '<iframe style="width: 100%; height: 100%; border: none;" id="bizifymeiframe" allowtransparency="true" scrolling="no" src="https://bizify.me/wordpress/?language=' . strtolower(get_bloginfo('language')) . '&version=' . $plugin_version . '"></iframe>';
		echo '<script type="text/javascript">window.addEventListener("message", function(e) { if(e.origin == "https://bizify.me" && isNaN(e.data) == false) { document.getElementById("bizifymeiframe").style.height = e.data + "px"; } }, false);</script>';
		echo '</div>';
	}
	
	function settings_page()
	{
		if(!current_user_can('manage_options'))
		{
			wp_die( __( 'You do not have sufficient permission to access this page.', 'bizifyme'));
		}
		
		if(isset($_POST) && wp_verify_nonce($_POST['bizifyme_nonce'], 'settings_page'))
		{
			$selection = $_POST['selection'];
			if($selection === 'date' && $_POST['history'] === 'on') $selection = 'complete';
			
			$settings = array(
				'selection' => $selection,
				'bizifyme_id' => preg_replace('/[^0-9]/', '', $_POST['bizifyme_id']),
				'device' => $_POST['device'],
				'post_status' => $_POST['post_status'],
				'post_category' =>  $_POST['post_category'],
				'post_author' => $_POST['post_author'],
				'comment_status' => $_POST['comment_status'],
				'ping_status' => $_POST['ping_status'],
				'chat_status' => $_POST['chat_status'],
				'hashtag_status' => $_POST['hashtag_status'],
				'latest_import' => gmdate("Y-m-d H:i:s")
			);
			
			update_option('bizifyme_options', array('settings' => $settings));
			wp_clear_scheduled_hook('bizifyme_cron');
			
			if(is_numeric($settings['bizifyme_id']))
			{
				wp_schedule_event(time(), '15minutes', 'bizifyme_cron');
				$this->import_feed();
			
				?>
				<div id="message" class="updated">
					<p><strong><?php _e('Settings saved.', 'bizifyme') ?></strong></p>
				</div>
				<?php
			}
			else
			{
				?>
				<div id="message" class="error">
					<p><strong><?php _e('Your Bizify.me account ID is missing.', 'bizifyme') ?><BR /><?php _e('You can find your account ID by <A HREF="https://bizify.me/login/" TARGET="_blank">login in to your Bizify.me account</A> and then go to <EM>Settings</EM> and click on <EM>Automatic publishing</EM>.', 'bizifyme') ?></strong></p>
				</div>
				<?php
			}
		}
		
		$options = get_option('bizifyme_options');
		
		include(plugin_dir_path( __FILE__ ) . 'bizifyme-ui.php');
	}
	
	function import_feed()
	{
		global $plugin_version;
		
		include_once(ABSPATH . WPINC . '/feed.php');
		$options = get_option('bizifyme_options');
		
		if(($options['settings']['selection'] === 'complete' || $options['settings']['selection'] === 'date') && is_numeric($options['settings']['bizifyme_id']))
		{
			$callback_filter = function($seconds)
			{
				return 0;
			};

			add_filter('wp_feed_cache_transient_lifetime', $callback_filter);
			
			$rss = fetch_feed('http://bizify.me/feed/wordpress/' . $options['settings']['bizifyme_id'] . '?selection=' . $options['settings']['selection'] . '&version=' . $plugin_version);
			
			if(!is_wp_error($rss))
			{
				$max_items = $rss->get_item_quantity(0);
				$rss_items = $rss->get_items(0, $max_items);
				
				foreach($rss_items as $item)
				{
					if(!$this->post_exists($item->get_permalink()))
					{
						if($options['settings']['selection'] === 'complete' || strtotime($item->get_date('Y-m-d H:i:s')) >= strtotime($options['settings']['latest_import']))
						{
							if(($options['settings']['selection'] === 'complete') || (stripos($options['settings']['device'], $item->get_category()->get_label()) !== false))
							{
								$new_post = array(
									'post_title'    	=> $item->get_title(),
									'post_content'  	=> $item->get_content() !== "" ? $item->get_content() : $item->get_description(),
									'post_status'   	=> $options['settings']['post_status'],
									'post_author'   	=> $options['settings']['post_author'],
									'post_category' 	=> array($options['settings']['post_category']),
									'comment_status'	=> $options['settings']['comment_status'],
									'ping_status'	=> $options['settings']['ping_status'],
									'post_date'		=> get_date_from_gmt($item->get_date('Y-m-d H:i:s'), "Y-m-d H:i:s")
								);
								
								$post_id = wp_insert_post($new_post);
								add_post_meta($post_id, 'bizifyme_permalink', esc_url($item->get_permalink()));
							}
						}
					}
				}
				
				if($options['settings']['selection'] === 'complete') $options['settings']['selection'] = 'date';
				
				$options['settings']['latest_import'] = gmdate("Y-m-d H:i:s");
				update_option('bizifyme_options', $options);
			}
			
			remove_filter('wp_feed_cache_transient_lifetime', $callback_filter);
		}
		
		if(!wp_next_scheduled('bizifyme_cron')) wp_schedule_event(time(), '15minutes', 'bizifyme_cron');
	}
	
	function post_exists($permalink)
	{
		$args = array('post_status' => 'any', 'meta_key' => 'bizifyme_permalink', 'meta_value' => esc_url($permalink));
		$posts = get_posts($args);
		
		return(count($posts) > 0);
	}
}

function on_activation()
{
	if(!is_multisite())
	{
		$options = get_option('bizifyme_options');
		
		if(is_numeric($options['settings']['bizifyme_id']) && !wp_next_scheduled('bizifyme_cron')) wp_schedule_event(time(), '15minutes', 'bizifyme_cron');
	}
	else
	{
		$current_blog_id = get_current_blog_id();
		
		global $wpdb;
		$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
		
		foreach($blog_ids as $blog_id) 
		{
			switch_to_blog($blog_id);
			
			$options = get_option('bizifyme_options');
			
			if(is_numeric($options['settings']['bizifyme_id']) && !wp_next_scheduled('bizifyme_cron')) wp_schedule_event(time(), '15minutes', 'bizifyme_cron');
		}
		
		switch_to_blog($current_blog_id);
	}
}

function on_deactivation()
{
	if(!is_multisite())
	{
		wp_clear_scheduled_hook('bizifyme_cron');
	}
	else
	{
		$current_blog_id = get_current_blog_id();
		
		global $wpdb;
		$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
		
		foreach($blog_ids as $blog_id) 
		{
			switch_to_blog($blog_id);
			wp_clear_scheduled_hook('bizifyme_cron');
		}
		
		switch_to_blog($current_blog_id);
	}
}

function hashtag_replace($content)
{
	$options = get_option('bizifyme_options');
	
	if($options['settings']['hashtag_status'] !== 'closed')
	{
		$content = str_replace('>#','> #', $content);
		$content = preg_replace('/(?<!:|\s|&|"|\')(\s)#([^\s<]+)/i', '\1<a href="' . site_url() . '?s=%23\2">#\2</a>', $content);
	}
	
	return $content;
}

function chat_include()
{
	$options = get_option('bizifyme_options');
	
	if(($options['settings']['chat_status'] !== 'closed') && is_numeric($options['settings']['bizifyme_id']))
	{
		echo '<div class="BizifyMeChat" onClick="window.open(\'https://bizify.me/chat/' . $options['settings']['bizifyme_id'] . '\', \'chat\', \'width=550, height=600, location=no, menubar=no, resizable=yes, status=no, titlebar=yes, toolbar=no\');">Start chat &#xBB;<div id="nrChatMessages" style="margin-left: 10px; background-color: rgb(255, 0, 0); width: 19px; height: 18px; border-radius: 18px; font-size: 15px; display: none;"></div></div><script type="text/javascript">var threadId = "' . $options['settings']['bizifyme_id'] . '";</script><script type="text/javascript" src="https://bizify.me/js/mail.status.js"></script>';
	}
}

new options_bizifyme;

add_action('init', 'bizifyme_init');
add_action('media_buttons_context',  'bizifyme_media_button');

register_activation_hook(__FILE__, 'on_activation');
register_deactivation_hook( __FILE__, 'on_deactivation');

add_action('admin_enqueue_scripts', 'bizifyme_admin');
add_action('wp_enqueue_scripts', 'bizifyme_wp');

add_shortcode('BizifyMeImage', 'bizifyme_image_shortcode');
add_shortcode('BizifyMePlayer', 'bizifyme_player_shortcode');
add_shortcode('BizifyMeVideo', 'bizifyme_video_shortcode');
add_shortcode('BizifyMeAudio', 'bizifyme_audio_shortcode');
add_shortcode('BizifyMeLive', 'bizifyme_live_shortcode');

add_filter('the_content', 'hashtag_replace');
add_action('wp_footer', 'chat_include');

add_action('wp_enqueue_scripts', 'bizifyme_script', 1000);

?>