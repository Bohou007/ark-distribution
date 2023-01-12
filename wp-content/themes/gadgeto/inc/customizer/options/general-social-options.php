<?php
/**
 * Header Builder Options
 *
 * @package thebase
 */

namespace TheBase;

use TheBase\Theme_Customizer;
use function TheBase\thebase;
ob_start(); ?>
<div class="thebase-compontent-description">
<h2><?php echo esc_html__( 'Social Network Links', 'gadgeto' ); ?></h2>
</div>
<?php
$compontent_description = ob_get_clean();
$settings = array(
	'social_settings' => array(
		'control_type' => 'thebase_blank_control',
		'section'      => 'general_social',
		'settings'     => false,
		'priority'     => 1,
		'description'  => $compontent_description,
	),
	'facebook_link' => array(
		'control_type' => 'thebase_text_control',
		'sanitize'     => 'esc_url_raw',
		'section'      => 'general_social',
		'default'      => thebase()->default( 'facebook_link' ),
		'label'        => esc_html__( 'Facebook', 'gadgeto' ),
	),
	'twitter_link' => array(
		'control_type' => 'thebase_text_control',
		'sanitize'     => 'esc_url_raw',
		'section'      => 'general_social',
		'default'      => thebase()->default( 'twitter_link' ),
		'label'        => esc_html__( 'Twitter', 'gadgeto' ),
	),
	'instagram_link' => array(
		'control_type' => 'thebase_text_control',
		'sanitize'     => 'esc_url_raw',
		'section'      => 'general_social',
		'default'      => thebase()->default( 'instagram_link' ),
		'label'        => esc_html__( 'Instagram', 'gadgeto' ),
	),
	'youtube_link' => array(
		'control_type' => 'thebase_text_control',
		'sanitize'     => 'esc_url_raw',
		'section'      => 'general_social',
		'default'      => thebase()->default( 'youtube_link' ),
		'label'        => esc_html__( 'YouTube', 'gadgeto' ),
	),
	'vimeo_link' => array(
		'control_type' => 'thebase_text_control',
		'sanitize'     => 'esc_url_raw',
		'section'      => 'general_social',
		'default'      => thebase()->default( 'vimeo_link' ),
		'label'        => esc_html__( 'Vimeo', 'gadgeto' ),
	),
	'facebook_group_link' => array(
		'control_type' => 'thebase_text_control',
		'sanitize'     => 'esc_url_raw',
		'section'      => 'general_social',
		'default'      => thebase()->default( 'facebook_group_link' ),
		'label'        => esc_html__( 'Facebook Group', 'gadgeto' ),
	),
	'pinterest_link' => array(
		'control_type' => 'thebase_text_control',
		'sanitize'     => 'esc_url_raw',
		'section'      => 'general_social',
		'default'      => thebase()->default( 'pinterest_link' ),
		'label'        => esc_html__( 'Pinterest', 'gadgeto' ),
	),
	'linkedin_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'linkedin_link' ),
		'label'        => esc_html__( 'Linkedin', 'gadgeto' ),
	),
	'dribbble_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'dribbble_link' ),
		'label'        => esc_html__( 'Dribbble', 'gadgeto' ),
	),
	'behance_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'behance_link' ),
		'label'        => esc_html__( 'Behance', 'gadgeto' ),
	),
	'patreon_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'patreon_link' ),
		'label'        => esc_html__( 'Patreon', 'gadgeto' ),
	),
	'reddit_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'reddit_link' ),
		'label'        => esc_html__( 'Reddit', 'gadgeto' ),
	),
	'medium_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'medium_link' ),
		'label'        => esc_html__( 'medium', 'gadgeto' ),
	),
	'wordpress_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'wordpress_link' ),
		'label'        => esc_html__( 'WordPress', 'gadgeto' ),
	),
	'github_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'github_link' ),
		'label'        => esc_html__( 'GitHub', 'gadgeto' ),
	),
	'vk_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'vk_link' ),
		'label'        => esc_html__( 'VK', 'gadgeto' ),
	),
	'xing_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'xing_link' ),
		'label'        => esc_html__( 'Xing', 'gadgeto' ),
	),
	'rss_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'rss_link' ),
		'label'        => esc_html__( 'RSS', 'gadgeto' ),
	),
	'google_reviews_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'google_reviews_link' ),
		'label'        => esc_html__( 'Google Reviews', 'gadgeto' ),
	),
	'yelp_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'yelp_link' ),
		'label'        => esc_html__( 'Yelp', 'gadgeto' ),
	),
	'trip_advisor_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'trip_advisor_link' ),
		'label'        => esc_html__( 'Trip Advisor', 'gadgeto' ),
	),
	'imdb_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'imdb_link' ),
		'label'        => esc_html__( 'IMDB', 'gadgeto' ),
	),
	'whatsapp_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'whatsapp_link' ),
		'label'        => esc_html__( 'WhatsApp', 'gadgeto' ),
	),
	'telegram_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'telegram_link' ),
		'label'        => esc_html__( 'Telegram', 'gadgeto' ),
	),
	'soundcloud_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'soundcloud_link' ),
		'label'        => esc_html__( 'SoundCloud', 'gadgeto' ),
	),
	'tumblr_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'tumblr_link' ),
		'label'        => esc_html__( 'Tumblr', 'gadgeto' ),
	),
	'tiktok_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'tiktok_link' ),
		'label'        => esc_html__( 'Tiktok', 'gadgeto' ),
	),
	'discord_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'discord_link' ),
		'label'        => esc_html__( 'Discord', 'gadgeto' ),
	),
	'spotify_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'spotify_link' ),
		'label'        => esc_html__( 'Spotify', 'gadgeto' ),
	),
	'apple_podcasts_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'apple_podcasts_link' ),
		'label'        => esc_html__( 'Apple Podcast', 'gadgeto' ),
	),
	'flickr_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'flickr_link' ),
		'label'        => esc_html__( 'Flickr', 'gadgeto' ),
	),
	'500px_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( '500px_link' ),
		'label'        => esc_html__( '500PX', 'gadgeto' ),
	),
	'bandcamp_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'bandcamp_link' ),
		'label'        => esc_html__( 'Bandcamp', 'gadgeto' ),
	),
	'anchor_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'anchor_link' ),
		'label'        => esc_html__( 'Anchor', 'gadgeto' ),
	),
	'email_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'sanitize_text_field',
		'default'      => thebase()->default( 'email_link' ),
		'label'        => esc_html__( 'Email', 'gadgeto' ),
	),
	'phone_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'sanitize_text_field',
		'default'      => thebase()->default( 'phone_link' ),
		'label'        => esc_html__( 'Phone', 'gadgeto' ),
	),
	'custom1_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'custom1_link' ),
		'label'        => esc_html__( 'Custom 1', 'gadgeto' ),
	),
	'custom2_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'custom2_link' ),
		'label'        => esc_html__( 'Custom 2', 'gadgeto' ),
	),
	'custom3_link' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'general_social',
		'sanitize'     => 'esc_url_raw',
		'default'      => thebase()->default( 'custom3_link' ),
		'label'        => esc_html__( 'Custom 3', 'gadgeto' ),
	),
);

Theme_Customizer::add_settings( $settings );

