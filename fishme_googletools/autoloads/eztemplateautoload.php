<?php

$eZTemplateOperatorArray   = array();

$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_site/classes/operators/GoogleUrlShortener.php',
		'class'          => 'fs_GoogleUrlShortener_operator',
		'operator_names' => array (
			'fs_set_GoogleUrlShortener',
			'fs_get_GoogleUrlShortener'
		)
	);



$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_site/classes/operators/GoogleAnalytics.php',
		'class'          => 'fs_GoogleAnalytics_operator',
		'operator_names' => array (
			'fs_get_GoogleAnalyticsCode'
		)
	);


$eZTemplateOperatorArray[] =
	array(
		'script'         => 'extension/fishme_site/classes/operators/GoogleMaps.php',
		'class'          => 'fs_GoogleMaps_operator',
		'operator_names' => array (
			'fs_get_GoogleMaps_geocode_by_latlng',
			'fs_get_GoogleMaps_geocode_by_address'
		)
	);
