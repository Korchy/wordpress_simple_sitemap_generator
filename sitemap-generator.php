<?php
/*
Plugin Name: Simple Sitemap Generator
Version: 1.0.0
Author: Korchiy
Description: Simple Sitemap Generator for Wordpress
*/

// Create the initial sitemap.xml file in the root of your wordpress directory with the fillowing content:
/*
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://yoursite.com/</loc>
  </url>
</urlset>
*/
// Make an owner of this file for Apache (www-data):
// chown www-data:www-data /var/www/your-site/sitemap.xml

//	not run directly
if(!defined('ABSPATH')) {
	exit;
}

function addNewLink($new_status, $old_status, $post) {
	// add new link to the sitemap.xml
	// Only if post becomes pulished
	if($new_status == 'publish' && $old_status !== 'publish' && in_array($post->post_type, ['post', 'page', 'product'])) {
		$sitemapPath = ABSPATH.'sitemap.xml';
		chmod($sitemapPath, 0666);
		$xml = new DOMDocument('1.0','utf-8');
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->load($sitemapPath);
		
		$urlNode = $xml->createElement('url');
		$node = $xml->createElement('loc');
		if($post->post_name != '') {
			$value = $xml->createTextNode(pathinfo(get_permalink($post->ID))['dirname'].'/'.$post->post_name);
		}
		else {
			if($post->post_title != '') $value = $xml->createTextNode(pathinfo(get_permalink($post->ID))['dirname'].'/'.sanitize_title($post->post_title));
		}
		$node->appendChild($value);
		$urlNode->appendChild($node);
		$xml->firstChild->appendChild($urlNode);
		$xml->save($sitemapPath);
		chmod($sitemapPath, 0644);
	}
}
// When post change status
add_action('transition_post_status', 'addNewLink', 10, 3);
