<?php

$eZTemplateOperatorArray   = array();

$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_googletools/classes/operators/GoogleUrlShortener.php',
		'class'          => 'fs_GoogleUrlShortener_operator',
		'operator_names' => array (
			'fs_set_GoogleUrlShortener',
			'fs_get_GoogleUrlShortener'
		)
	);



$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_googletools/classes/operators/GoogleAnalytics.php',
		'class'          => 'fs_GoogleAnalytics_operator',
		'operator_names' => array (
			'fs_get_GoogleAnalyticsCode'
		)
	);


$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_googletools/classes/operators/GoogleMaps.php',
		'class'          => 'fs_GoogleMaps_operator',
		'operator_names' => array (
			'fs_get_GoogleMaps_geocode_by_latlng',
			'fs_get_GoogleMaps_geocode_by_address'
		)
	);


$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_googletools/classes/operators/GoogleTranslate.php',
		'class'          => 'fs_GoogleTranslate_operator',
		'operator_names' => array (
			'fs_get_GoogleTranslate'
		)
	);


$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_googletools/classes/operators/GoogleShoppingSearch.php',
		'class'          => 'fs_GoogleShoppingSearch_operator',
		'operator_names' => array (
			'fs_get_GoogleShoppingSearch',
			'fs_get_GoogleShoppingSearch_facet',
			'fs_get_GoogleShoppingSearch_filter'
		)
	);

$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_googletools/classes/operators/GoogleAPI.php',
		'class'          => 'fs_GoogleAPI_operator',
		'operator_names' => array (
			'fs_init_GoogleAPI'
		)
	);