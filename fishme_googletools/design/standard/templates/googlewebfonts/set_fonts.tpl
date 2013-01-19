{foreach ezini( 'GoogleWebFonts', 'include_by', 'fishme_googletools.ini' ) as $key => $include_by}
    {include uri=concat('design:googlewebfonts/include_', $include_by ,'.tpl')}
{/foreach}

