if (typeof jQuery == 'undefined') {
    // jQuery is loaded => print the version
    alert('Please activate jQuery in your design.ini!');
} else {
    $(function() {
//        $('#fm_google_plus_result');
          $('pre code').each(function(i, e) {
              hljs.tabReplace = '<span class="indent">\t</span>';
              hljs.initHighlightingOnLoad();
              hljs.highlightBlock(e)});

    });

}
