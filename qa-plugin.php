<?php

/*
	Plugin Name: Solr search
	Plugin URI: https://github.com/fauguste/qa-search-solr
	Plugin Description: Plugin to replace default search functionality in Question2Answer with Solr.
	Plugin Version: 1.0
	Plugin Date: 2015-03-24
	Plugin Author: Frédéric AUGUSTE
	Plugin Author URI:
	Plugin License: MIT
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_module(
	'search', // type of module
	'qa-search-solr.php', // PHP file containing module class
	'qaSearchSolr', // module class name in that PHP file
	'Solr search' // human-readable name of module
);
