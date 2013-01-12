<?php
/**
 * Operators for GoogleUrlShortener
 *
 * @author David Hohl <info@fishme.de>
 * @copyright Copyright (C) 2005-2013 fishme.de All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version 1.0.1
 */

class fs_GoogleUrlShortener_operator
{

    var $Operators;

    var $fs_settings = '';

    function fs_GoogleUrlShortener_operator()
    {
        $this->Operators = array(
            'fs_set_GoogleUrlShortener',
            'fs_get_GoogleUrlShortener'
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
            'fs_set_GoogleUrlShortener' => array(
                'url' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                )
            ),
            'fs_get_GoogleUrlShortener' => array(
                'url' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                )
            )
        );
    }

    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {

        $this->fs_settings['key'] = eZINI::instance('fishme_googletools.ini')->variable( 'Settings', 'key' );
        $this->fs_settings['api_url'] = eZINI::instance('fishme_googletools.ini')->variable( 'GoogleUrlShortener', 'api_url' );

        switch ( $operatorName ) {
            case 'fs_set_GoogleUrlShortener':
                $operatorValue = $this->fs_set_GoogleUrlShortener($namedParameters);
                break;
            case 'fs_get_GoogleUrlShortener':
                $operatorValue = $this->fs_get_GoogleUrlShortener($namedParameters);
                break;
        }
    }

    public function fs_set_GoogleUrlShortener($namedParameters) {
        $url = $namedParameters['url'];
        if(!$url) {
            $url =  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        return $this->send($url);
    }

    public function fs_get_GoogleUrlShortener($namedParameters) {
        return $this->send($namedParameters['url'], false);
    }

    private function send($url, $shorten = true) {

        $api_url = $this->fs_settings['api_url'] . '?key=' . $this->fs_settings['key'];

        $ch = curl_init();
        if($shorten) {
          curl_setopt($ch, CURLOPT_URL, $api_url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("longUrl" => $url)));
          curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        }
        else {
          if(!strstr($url, 'http://')) {
              $url = 'http://' . $url;
          }
          curl_setopt($ch, CURLOPT_URL, $api_url . '&shortUrl=' . $url);
        }
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);
        $response =  json_decode($result,true);

        // return the result
        if($shorten) {
            return isset($response['id']) ? $response['id'] : false;
        } else {
            return isset($response['longUrl']) ? $response['longUrl'] : false;
        }

    }

}

?>
