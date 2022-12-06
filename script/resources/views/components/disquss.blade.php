@if(env('DISCUSS_COMMENT_KEY') != null)
<div id="disqus_thread"></div>
<script>
"use strict";	
//disqus comment api
var disqus_config = function () {
this.page.url = "{{ Request::url() }}"; 
this.page.identifier = "{{ Request::url() }}"; 
};
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://'+"{{ env('DISCUSS_COMMENT_KEY') }}"+'/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endif