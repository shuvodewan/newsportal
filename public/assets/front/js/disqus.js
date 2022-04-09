(function($) {
    "use strict";

    (function () { // DON'T EDIT BELOW THIS LINE
        var d = document,
        s = d.createElement('script');
        s.src = 'https://{{ $gs->disqus}}.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();

})(jQuery);