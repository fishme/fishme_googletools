{if $googleyoutube_code}
    {def $gyt_url = concat(
                    ezini( 'GoogleYouTube', 'api_url', 'fishme_googletools.ini' ),
                    $googleyoutube_code,
                    '?version=', ezini( 'GoogleYouTube', 'version', 'fishme_googletools.ini' ),
                    '&autoplay=', ezini( 'GoogleYouTube', 'autoplay', 'fishme_googletools.ini' ),
                    '&color=', ezini( 'GoogleYouTube', 'color', 'fishme_googletools.ini' ),
                    '&controls=', ezini( 'GoogleYouTube', 'controls', 'fishme_googletools.ini' ),
                    '&disablekb=', ezini( 'GoogleYouTube', 'disablekb', 'fishme_googletools.ini' ),
                    '&iv_load_policy=', ezini( 'GoogleYouTube', 'iv_load_policy', 'fishme_googletools.ini' ),
                    '&rel=', ezini( 'GoogleYouTube', 'rel', 'fishme_googletools.ini' ),
                    '&theme=', ezini( 'GoogleYouTube', 'theme', 'fishme_googletools.ini' )
                    )

    }
    <object width="{ezini( 'GoogleYouTube', 'width', 'fishme_googletools.ini' )}" height="{ezini( 'GoogleYouTube', 'height', 'fishme_googletools.ini' )}">
      <param name="movie" value="{$gyt_url}"></param>
      <param name="allowScriptAccess" value="always"></param>
      <embed src="{$gyt_url}"
             type="application/x-shockwave-flash"
             allowscriptaccess="always"
             width="{ezini( 'GoogleYouTube', 'width', 'fishme_googletools.ini' )}" height="{ezini( 'GoogleYouTube', 'height', 'fishme_googletools.ini' )}"></embed>
    </object>
    {undef $gyt_url}
{/if}