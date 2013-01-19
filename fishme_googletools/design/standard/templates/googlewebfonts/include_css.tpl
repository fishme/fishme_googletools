{foreach ezini( 'GoogleWebFonts', 'fonts', 'fishme_googletools.ini' ) as $font_key => $font}
    <link rel="stylesheet" type="text/css" href="{concat(ezini( 'GoogleWebFonts', 'api_url', 'fishme_googletools.ini' ), '?',$font)}">
{/foreach}