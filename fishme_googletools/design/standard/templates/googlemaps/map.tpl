{ezcss_require('fs_google_maps.css')}
{ezscript_require('fs_google_maps.js')}

{if or($google_map_width, $google_map_height)}
    <style>
        #fs_map_canvas {ldelim}
            {if $google_map_width}
                width:{$google_map_width};
            {/if}
            {if $google_map_height}
                height: {$google_map_height};
            {/if}
        {rdelim}
    </style>
{/if}
<div id="fs_map_canvas" data-address="{$googlemap_address}" data-zoom="{$googlemap_zoom}" data-api-url="{ezini( 'GoogleMaps', 'geocode_js_url', 'fishme_googletools.ini' )}&sensor={ezini( 'GoogleMaps', 'sensor_js', 'fishme_googletools.ini' )}" {if ezini_hasvariable('GoogleMaps', 'icon_path', 'fishme_googletools.ini' )}data-pin="{ezini( 'GoogleMaps', 'icon_path', 'fishme_googletools.ini' )}"{/if} ></div>