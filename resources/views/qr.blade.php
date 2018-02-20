@extends('templates.default')

@section('header')
<script type="text/javascript" src="{{ url('js/llqrcode.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webqr.js') }}"></script>
@endsection


@section('pagecontent')

<div class="container">
	<div id="main">
<div id="header">
<div style="position:relative;top:+20px;left:0px;"><g:plusone size="medium"></g:plusone></div>
<p id="mp1">
QR Code scanner
</p>
<ul>
<li><a href="index.html">Scan</a></li>
<li><a href="create.html">Create</a></li>
<li><a href="about.html">About</a></li>
<li style="border: medium none;"><a href="contact.html">Contact</a></li>
</ul>
</div>
<div id="mainbody">
<table class="tsel" border="0" width="100%">
<tr>
<td valign="top" align="center" width="50%">
<table class="tsel" border="0">
<tr>
<td><img class="selector" id="webcamimg" src="vid.png" onclick="setwebcam()" align="left" /></td>
<td><img class="selector" id="qrimg" src="cam.png" onclick="setimg()" align="right"/></td></tr>
<tr><td colspan="2" align="center">
<div id="outdiv">
</div></td></tr>
</table>
</td>
</tr>
<tr><td colspan="3" align="center">
<img src="down.png"/>
</td></tr>
<tr><td colspan="3" align="center">
<div id="result"></div>
</td></tr>
</table>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- webqr_2016 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8418802408648518"
     data-ad-slot="2527990541"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>&nbsp;
<div id="footer">
<img style="position:relative;top:0px;left:0px;margin:0;padding:0;" src="comodo_secure_seal_100x85_transp.png"/>
<h5 align="center">Copyright &copy; 2011 <a target="_blank" href="http://www.lazarsoft.info">Lazar Laszlo</a></h5>
</div>
</div>
<canvas id="qr-canvas" width="800" height="600"></canvas>
<script type="text/javascript">load();</script>

</div>

@endsection


@section('scripts')


@endsection