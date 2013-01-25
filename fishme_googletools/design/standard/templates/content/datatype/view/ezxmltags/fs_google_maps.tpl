{if is_unset($zoom)}{def $zoom = '6'}{/if}
{if is_unset($map_width)}{def $map_width = ''}{/if}
{if is_unset($map_height)}{def $map_height = ''}{/if}
{include uri='design:googlemaps/map.tpl' googlemap_address=$address googlemap_zoom=$zoom google_map_width=$map_width google_map_height=$map_height}