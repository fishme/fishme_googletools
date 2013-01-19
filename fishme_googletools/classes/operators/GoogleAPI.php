<?php
/**
 * Operator for the GoogleAPI
 *
 * @author David Hohl <info@fishme.de>
 * @copyright Copyright (C) 2005-2013 fishme.de All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version 1.0.7
 */

class fs_GoogleAPI_operator
{

    var $Operators;

    var $fs_settings = '';

    var $client;

    function fs_GoogleAPI_operator()
    {
        $this->Operators = array(
            'fs_init_GoogleAPI'
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
            'fs_init_GoogleAPI' => array(
                'service' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                ),
                'redirect_url' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                ),
                'params' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                ),
            )
        );
    }

    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {

        $this->fs_settings['key']           = eZINI::instance('fishme_googletools.ini')->variable( 'Settings', 'key' );
        $this->fs_settings['clientId']      = eZINI::instance('fishme_googletools.ini')->variable( 'Settings', 'clientID' );
        $this->fs_settings['clientSecret']  = eZINI::instance('fishme_googletools.ini')->variable( 'Settings', 'clientSecret' );
        $this->fs_settings['developerkey']  = eZINI::instance('fishme_googletools.ini')->variable( 'Settings', 'developerkey' );

        switch ( $operatorName ) {
            case 'fs_init_GoogleAPI':
                $operatorValue = $this->fs_init_GoogleAPI($namedParameters);
                break;
        }
    }

    public function fs_init_GoogleAPI($namedParameters) {
        session_start();
       
        $service = $namedParameters['service'];
        $params = $namedParameters['params'];


        // set auth2 configuration
        $this->client = new Google_Client();
        $this->client->setClientId($this->fs_settings['clientId']);
        $this->client->setClientSecret($this->fs_settings['clientSecret']);
        $this->client->setRedirectUri('http://' . $_SERVER['HTTP_HOST']);
        $this->client->setDeveloperKey($this->fs_settings['developerkey']);

        // get service
        switch($service) {

            case 'adExchangeBuyerService':
                // not yet included
                break;
            case 'adExchangeSellerService':
                // not yet included
                break;
            case 'adSenceService':
                // not yet included
                break;
            case 'adSenceHostService':
                // not yet included
                break;
            case 'AnalyticsService':
                // not yet included
                break;
            case 'BigqueryService':
                // not yet included
                break;
            case 'BloggerService':
                // not yet included
                break;
            case 'BooksService':
                // not yet included
                break;
            case 'CalendarService':
                // not yet included
                break;
            case 'ComputerService':
                // not yet included
                break;
            case 'CustomSearchService':
                // not yet included
                break;
            case 'DfareportingService':
                // not yet included
                break;
            case 'DriveService':
                // not yet included
                break;
            case 'FreebaseService':
                // not yet included
                break;
            case 'FusiontablesService':
                // not yet included
                break;
            case 'GanService':
                // not yet included
                break;
            case 'LatidudeService':
                // not yet included
                break;
            case 'LicensingService':
                // not yet included
                break;
            case 'ModeratorService':
                // not yet included
                break;
            case 'Oauth2Service':
                // not yet included
                break;
            case 'OrkutService':
                // not yet included
                break;
            case 'PagespeedonlineService':
                // not yet included
                break;
            case 'PlusMomentService':
                // not yet included
                break;
            case 'PlusService':
                /*
                 * Todo - register in eZ
                 *      - login in eZ
                 *      - update profil in eZ
                 */
                return $this->get_PlusService($params);
                break;
            case 'PredictionService':
                // not yet included
                break;
            case 'ShoppingService':
                // not yet included
                break;
            case 'SiteVerficationService':
                // not yet included
                break;
            case 'StorageService':
                // not yet included
                break;
            case 'TaskqueueService':
                // not yet included
                break;
            case 'TasksService':
                // not yet included
                break;
            case 'TranslateService':
                // not yet included
                break;
            case 'UrlshortenerService':
                // not yet included
                break;
            case 'WebfontsService':
                // not yet included
                break;
            case 'YoutubeService':
                // not yet included
                break;
            default:
                eZDebug::writeError( 'service not founded: ' . $service, "fishme: GoogleApi" );
        }
        return false;
    }


    private function get_PlusService($params) {
        $plus = new Google_PlusService($this->client);

        // default settings
        $activate_maxResults = 100;

        if($params['activate_maxResults']) {
            $activate_maxResults = $params['activate_maxResults'];
        }

        if (isset($_GET['code'])) {
            $this->client->authenticate();
            $_SESSION['token'] = $this->client->getAccessToken();
            //header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
            eZHTTPTool::redirect('http://' . $_SERVER['HTTP_HOST'].'?g_api=true');
            return true;
        }

        if (isset($_SESSION['access_token'])) {
          $this->client->setAccessToken($_SESSION['access_token']);
        }

        if ($this->client->getAccessToken()) {
            $me = $plus->people->get('me');
            $result = array();

            // person informations
            $result['url']        = filter_var($me['url'], FILTER_VALIDATE_URL);
            $result['img']        = filter_var($me['image']['url'], FILTER_VALIDATE_URL);
            $result['name']       = filter_var($me['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $result['gender']     = ezpI18n::tr( 'design/standard/googletools_api_plus', $me['gender']);
            $result['person_markup'] = '<a rel="me" href="' . $result['url'] . '">' . $result['name'] . '</a><div><img src="' . $result['img'] . '"></div>';


            $result['private_urls']        = $me['urls'];
            $result['places_lived']        = $me['placesLived'];
            $result['isPlusUser']          = $me['isPlusUser'];
            $result['cover_image']         = $me['cover']['coverPhoto'];

            $optParams = array('maxResults' => $activate_maxResults);
            $result['activities'] = $plus->activities->listActivities('me', 'public', $optParams);
            // The access token may have been updated lazily.
            $_SESSION['access_token'] = $this->client->getAccessToken();
            return array('result' => $result);
        } else {
            return array('login' => $this->client->createAuthUrl());
        }
    }
}

?>
