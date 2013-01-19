{foreach ezini( 'GoogleWebFonts', 'fonts', 'fishme_googletools.ini' ) as $font_key => $font}
    <script type="text/javascript">
      WebFontConfig = {ldelim}
        {foreach ezini( 'GoogleWebFonts', 'webfont_loader', 'fishme_googletools.ini' ) as $webfont_loader_key => $webfont_loader_value}
            {$webfont_loader_key}: {$webfont_loader_value}{delimiter},{/delimiter}
        {/foreach}
      {rdelim};
      (function() {ldelim}
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://{ezini( 'GoogleWebFonts', 'api_url_loader', 'fishme_googletools.ini' )}';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      {rdelim})();
    </script>
{/foreach}