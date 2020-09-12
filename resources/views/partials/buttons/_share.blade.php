<!-- SHARE BUTTONS -->
<!-- FACEBOOK SHARE -->
<a href="http://www.facebook.com/sharer.php?u={{ $metaURL }}" target="_blank">
    <img src="{{ asset('') }}/facebook.png" width="40" />
</a>
<!-- TWITTER SHARE -->
<a href="https://twitter.com/share?url={{ $metaURL }}" target="_blank">
    <img src="{{ asset('') }}/twitter.png" width="40" />
</a>
<!-- GOOGLE PLUS SHARE -->
<a href="https://plus.google.com/share?url={{ $metaURL }}" target="_blank">
    <img src="{{ asset('') }}/googleplus.png" width="40" />
</a>
<!-- PINTEREST SHARE -->
{{-- <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
    <img src="{{ asset('') }}/pinterest.png" width="40" />
</a> --}}
<!-- TUMBLR SHARE -->
{{-- <a href="http://www.tumblr.com/share/link?url={{ $metaURL }}" target="_blank">
    <img src="{{ asset('') }}/tumblr.png" width="40" />
</a> --}}
<!-- VIBER SHARE -->
<a id="viber_share">
    <img src="{{ asset('') }}/viber.png" width="40" />
</a>
<script>
var buttonID = "viber_share";
var text = "";
document.getElementById(buttonID)
.setAttribute('href', "https://3p3x.adj.st/?adjust_t=u783g1_kw9yml&adjust_fallback=https%3A%2F%2Fwww.viber.com%2F%3Futm_source%3DPartner%26utm_medium%3DSharebutton%26utm_campaign%3DDefualt&adjust_campaign=Sharebutton&adjust_deeplink=" + encodeURIComponent("viber://forward?text=" + encodeURIComponent(text + " " + window.location.href)));
</script>
<!-- END SHARE BUTTONS -->
