<?php
/**
 * Operator for Google Translate
 *
 * @author David Hohl <info@fishme.de>
 * @copyright Copyright (C) 2005-2013 fishme.de All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version 1.0.3
 */

class fs_GoogleTranslate_operator
{

    var $Operators;

    var $fs_settings = '';

    function fs_GoogleTranslate_operator()
    {
        $this->Operators = array(
            'fs_get_GoogleTranslate'
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
            'fs_get_GoogleTranslate' => array(
                'text' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                ),
                'source' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                ),
                'target' => array(
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
        $this->fs_settings['api_url'] = eZINI::instance('fishme_googletools.ini')->variable( 'GoogleTranslate', 'api_url' );

        switch ( $operatorName ) {
            case 'fs_get_GoogleTranslate':
                $operatorValue = $this->fs_get_GoogleTranslate($namedParameters);
                break;
        }
    }

    public function fs_get_GoogleTranslate($namedParameters) {
        return $this->get_Translation($namedParameters,'latlng');
    }

    private function get_Translation($params) {

        $api_url = $this->fs_settings['api_url'];
        $api_url .= '?key=' . $this->fs_settings['key']. '&q=' . urlencode($params['text']) . '&source=' . $params['source'] . '&target=' . $params['target'];

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response =  json_decode($result);
        if($httpCode == '200') {
            return $response->data->translations[0]->translatedText;
        } else {
            eZDebug::writeError( $response->status, "fishme: GoogleMaps" );
            return false;
        }
    }
}

?>
