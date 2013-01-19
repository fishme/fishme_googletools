{ezcss_require('fishme_bootstrap.css')}
{ezcss_require('fishme_highlight.css')}
{ezcss_require('fishme_sunburst.css')}
{ezcss_require('fishme_debug.css')}
{ezscript_require('fishme_highlight.pack.js')}
{ezscript_require('fishme_debug.js')}

<div id="fm-wrapper">
    <div id="fm-menu-top" class="fm-constrain">
        <div class="fm-menu-top-container">
            <ul>
                <li><a href="http://www.fishme.de"><img src={'fishme_logo.png'|ezimage()} /></a></li>
                <li class="menu-item"><a href="http://projects.ez.no/fishme_googletools/news" target="_blank">News</a></li>
                <li class="menu-item"><a href="https://github.com/fishme/fishme_googletools/archive/master.zip" target="_blank">Download</a></li>
                <li class="menu-item current"><a href="https://github.com/fishme/fishme_googletools" target="_blank">API Documentation</a></li>
            </ul>
        </div>
    </div>
    <div id="fm-container" class="fm-row">
        <div id="fm-menu">
            <h4>Examples</h4>
            <ul>
                <li>1) <a href="#fm-google-plus-result">Google+</a></li>
                <li>2) <a href="#fm-google-translation-result">Google Translation</a></li>
                <li>3) <a href="#fm-google-webfonts-result">Google Webfonts</a></li>
                <li>4) <a href="#fm-google-webfonts-result">Google Youtube</a></li>
                <li>5) <a href="#fm-google-maps-geocords-result">Google Maps (GeoCords)</a></li>
                <li>6) <a href="#fm-google-analytics-result">Google Analytics</a></li>
                <li>7) <a href="#fm-google-shoppingsearch-result">Google Shopsearch</a></li>
            </ul>
        </div>
        <div id="fm-examples">
{* GOOGLE PLUS *}
            <div id="fm-google-plus-result" class="fm-hide">
                <a name="fm-google-plus-result"></a>
                <h3>Google+ Example</h3>
                <h4>Code</h4>
                <pre><code>{literal}
{def $google_plus = fs_init_GoogleAPI('PlusService')}
{if $google_plus.login}
    {$google_plus.login}
{else}
    {$google_plus.result|attribute(show,1)}
{/if}{/literal}</code></pre>
                <h4>Output</h4>
                <div class="fm-example-output">
                    {def $google_plus = fs_init_GoogleAPI('PlusService')}
                    {if $google_plus.login}
                        <a href="{$google_plus.login}">klick</a>
                    {else}
                        {$google_plus.result|attribute(show,1)}
                    {/if}
                </div>
            </div>
            <hr>
{* GOOGLE TRANSLATOR*}
            <div id="fm-google-translation-result" class="fm-hide">
                <a name="fm-google-translation-result"></a>
                <h3>Google Translator Example</h3>
                <h4>Code</h4>
                <pre><code>{literal}
{def $google_translation = fs_get_GoogleTranslate('Hello World!', 'en', 'de')}
{$google_translation}{/literal}</code></pre>
                <h4>Output</h4>
                <div class="fm-example-output">
                    
                    {def $google_translation = fs_get_GoogleTranslate('Hello World!', 'en', 'de')}
                    {$google_translation}
                </div>
            </div>

            <hr>
{* GOOGLE Webfonts*}
            <div id="fm-google-webfonts-result" class="fm-hide">
                <a name="fm-google-webfonts-result"></a>
                <h3>Google Webfonts Example</h3>
                <h4>Code</h4>
                <pre><code >{literal}
//Include in your page_head_style.tpl about any eZ Includes follow line
{include uri='design:googlewebfonts/set_fonts.tpl'}
{/literal}</code></pre>
                <h4>Output</h4>
                <div class="fm-example-output">
                    <b>LOAD GOOGLE FONTS ABOUT CSS</b>
                    <div style="font-family: 'Tangerine', serif;font-size:40px;margin-left:50px;margin-top:50px;" class="font-effect-shadow-multiple">Hello World!</div>
                    <b>LOAD GOOGLE FONTS ABOUT JS</b>
                    {* JS LOADER *}
                    {literal}
                    <style type="text/css">
                      .wf-loading p {
                        font-family: serif
                      }
                      .wf-inactive p {
                        font-family: serif
                      }
                      .wf-active p {
                        font-family: 'Tangerine', serif
                        font-size:20px;
                      }
                      .wf-loading h1 {
                        font-family: serif;
                        font-weight: 400;
                        font-size: 16px
                      }
                      .wf-inactive h1 {
                        font-family: serif;
                        font-weight: 400;
                        font-size: 16px
                      }
                      .wf-active h1 {
                        font-family: 'Cantarell', serif;
                        font-weight: 400;
                        font-size: 16px
                      }
                    </style>
                    {/literal}
                    <h1>This is using Cantarell</h1>
                    <p>This is using Tangerine!</p>
                </div>
            </div>
            <hr>
{* GOOGLE YOUTUBE*}
            <div id="fm-google-youtube-result" class="fm-hide">
                <a name="fm-google-youtube-result"></a>
                <h3>Google YouTube Example</h3>
                <h4>Code</h4>
                <pre><code>{literal}
{include uri='design:googleyoutube/player.tpl' googleyoutube_code='WwwqiCgRf8M'}{/literal}</code></pre>
                <h4>Output</h4>
                <div class="fm-example-output">
                    {include uri='design:googleyoutube/player.tpl' googleyoutube_code='WwwqiCgRf8M'}
                </div>
            </div>

            <hr>
{* GOOGLE GEOCORDS*}
            <div id="fm-google-maps-geocords-result" class="fm-hide">
                <a name="fm-google-maps-geocords-result"></a>
                <h3>Google Maps GeoCords Example</h3>
                <h4>Code</h4>
                <pre><code>{literal}
{def $google_maps = fs_get_GoogleMaps_geocode_by_address('Bonner Straße 484, 50968 Köln, Deutschland')}
LAT: {$google_maps.lat}
LNG:{$google_maps.lng}
{$google_maps.addtional}
// or
{def $google_maps = fs_get_GoogleMaps_geocode_by_latlng('52.5153264','13.4718734')}
Adress: {$google_maps.address}
{$google_maps.addtional}{/literal}</code></pre>
                <h4>Output</h4>
                <div class="fm-example-output">
                    {def $google_maps = fs_get_GoogleMaps_geocode_by_address('Bonner Straße 484, 50968 Köln, Deutschland')}
                    LAT: {$google_maps.lat}<br>
                    LNG {$google_maps.lng}
                    <br/><span>or</span><br/>
                    {set $google_maps = fs_get_GoogleMaps_geocode_by_latlng('52.5153264','13.4718734')}
                    Address: {$google_maps.address}<br />
                </div>
            </div>
            <hr>
 {* GOOGLE Analytics*}
            <div id="fm-google-analytics-result" class="fm-hide">
                <a name="fm-google-analytics-result"></a>
                <h3>Google Analytics Example</h3>
                <h4>Code</h4>
                <pre><code>{literal}
{def $google_analytics = fs_get_GoogleAnalyticsCode()}
{$google_analytics}{/literal}</code></pre>
                <h4>Output</h4>
                <div class="fm-example-output">
                    output the JS Script for Google Analytics
                </div>
            </div>
            <hr>
             {* GOOGLE Analytics*}
            <div id="fm-google-shoppingsearch-result" class="fm-hide">
                <a name="fm-google-shoppingsearch-result"></a>
                <h3>Google Shopping Search Example</h3>
                <h4>Code</h4>
                <pre><code>{literal}
{def $filter = fs_get_GoogleShoppingSearch_filter()
$products = fs_get_GoogleShoppingSearch($search_text, $offset, $filter)}
// try the live example :) include follow line
{include uri='design:googleshopping/list.tpl'}
{/literal}</code></pre>
                <h4>Output</h4>
                <div class="fm-example-output">
                    {include uri='design:googleshopping/list.tpl'}
                </div>
            </div>
            <hr>
        </div>






        <div class="fm-clear"></div>
        <div id="fm-footer">Copyright (C) 2005-2013 <a href="http://www.fishme.de" target="_blank">www.fishme.de</a> - GNU General Public License v2.0</div>
    </div>
</div>
