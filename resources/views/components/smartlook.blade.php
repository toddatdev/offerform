<script type='text/javascript'>
    window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', '58a64f73ec3761cf5afc156dfb21f9cdd3bdb4d3', { region: 'eu' });
    @auth
        smartlook('identify', {{ auth()->user()->id }}, {
            "name": "{{ auth()->user()->full_name }}",
            "email": "{{ auth()->user()->email }}",
            "phone": "{{ auth()->user()->phone }}"
        })
    @endauth
</script>
