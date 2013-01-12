<?php
/**
 * Operator for GoogleAnalytics
 *
 * @author David Hohl <info@fishme.de>
 * @copyright Copyright (C) 2005-2013 fishme.de All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version 1.0.1
 */

class fs_GoogleAnalytics_operator
{

    var $Operators;

    var $fs_settings = '';

    function fs_GoogleAnalytics_operator()
    {
        $this->Operators = array(
            'fs_get_GoogleAnalyticsCode'
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
            'fs_get_GoogleAnalyticsCode' => array()
        );
    }

    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {

        $this->fs_settings['key'] = eZINI::instance('fishme_googletools.ini')->variable( 'GoogleAnalytics', 'key' );
        $this->fs_settings['extra_code'] = eZINI::instance('fishme_googletools.ini')->variable( 'GoogleAnalytics', 'extra_code' );

        switch ( $operatorName ) {
            case 'fs_get_GoogleAnalyticsCode':
                $operatorValue = $this->fs_get_GoogleAnalyticsCode($namedParameters);
                break;
        }
    }

    public function fs_get_GoogleAnalyticsCode($namedParameters) {

        ob_start();?>
            <script type="text/javascript">

              var _gaq = _gaq || [];
              _gaq.push(['_setAccount', '<?echo $this->fs_settings['key'];?>']);
              _gaq.push(['_trackPageview']);
              <? echo $this->fs_settings['extra_code'];?>

              (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
              })();

            </script>

        <?
        $code = ob_get_contents();
        return $code;
    }

  

}

?>
