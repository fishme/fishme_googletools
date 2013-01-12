<?php
/**
 * Operator for GoogleMaps
 *
 * @author David Hohl <info@fishme.de>
 * @copyright Copyright (C) 2005-2013 fishme.de All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version 1.0.2
 */

class fs_GoogleMaps_operator
{

    var $Operators;

    var $fs_settings = '';

    function fs_GoogleMaps_operator()
    {
        $this->Operators = array(
            'fs_get_GoogleMaps_geocode_by_latlng',
            'fs_get_GoogleMaps_geocode_by_address'
        );
    }

    function &operatorList()
    {
        return $this->Operators;
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(
            'fs_get_GoogleMaps_geocode_by_address' => array(
                'address' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                )
            ),
            'fs_get_GoogleMaps_geocode_by_latlng' => array(
                'lat' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                ),
                'lng' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                )
            ),


        );
    }

    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {

        $this->fs_settings['key'] = eZINI::instance('fishme_googletools.ini')->variable( 'Settings', 'key' );
        $this->fs_settings['geocode_api_url'] = eZINI::instance('fishme_googletools.ini')->variable( 'GoogleMaps', 'geocode_api_url' );
        $this->fs_settings['sensor'] = eZINI::instance('fishme_googletools.ini')->variable( 'GoogleMaps', 'sensor' );
        
        switch ( $operatorName ) {
            case 'fs_get_GoogleMaps_geocode_by_address':
                $operatorValue = $this->fs_get_GoogleMaps_geocode_by_address($namedParameters);
                break;
            case 'fs_get_GoogleMaps_geocode_by_latlng':
                $operatorValue = $this->fs_get_GoogleMaps_geocode_by_latlng($namedParameters);
                break;
        }
    }

    public function fs_get_GoogleMaps_geocode_by_latlng($namedParameters) {
        return $this->get_geoCode($namedParameters,'latlng');
    }

    public function fs_get_GoogleMaps_geocode_by_address($namedParameters) {
        return $this->get_geoCode($namedParameters,'address');
    }

    private function get_geoCode($params, $mode) {

        $api_url = $this->fs_settings['geocode_api_url'];

        if($mode == 'address') {
            $api_url .= '?address=' . urlencode($params['address']);
        } elseif($mode == 'latlng') {
            $api_url .= '?latlng=' . $params['lat'] . ',' . $params['lng'];
        }
        
        // add sensor
        $api_url .= '&sensor=' . $this->fs_settings['sensor'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response =  json_decode($result);

        if($response->status == 'OK') {
            $addtional = array(
                    'address_components' => $response->results[0]->address_components,
                    'formatted_address' => $response->results[0]->formatted_address,
                    'geometry' => $response->results[0]->geometry,
                    );
            if($mode == 'address') {
                $return = array(
                    'lat' => $response->results[0]->geometry->location->lat ,
                    'lng' => $response->results[0]->geometry->location->lng,
                    'addtional' => $addtional
                    );
            } elseif($mode == 'latlng') {
                $return = array(
                    'address' => $response->results[0]->formatted_address ,
                    'addtional' => $addtional
                    );
            }
            
            return $return;
        } else {
            eZDebug::writeError( $response->status, "fishme: GoogleMaps" );
            return false;
        }
    }
}

?>
