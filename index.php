<?php

$status = "default";
$queue = "";

if(isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] != "")
{
	$status = "polling";
	$queue = $_SERVER["QUERY_STRING"];
}


?>
<html>

<head>
<title>Queuer - use your queuing time productively</title>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="qr.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="qr_generate/jquery.qrcode-0.11.0.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="cookie.js"></script>
<script src="qr.js"></script>

<!-- variables for js -->
<script type="text/javascript">
status = "<? echo $status; ?>";
queue = "<? echo $queue; ?>";
</script>

</head>

<body>
<img src="deqr.png" width="80%"></img>
<? if($status == "default") { ?>
	<div id="general-controls">
	<button id="create">Create a queue</button>
	<button id="join">Join a queue</button>
	</div>
	<div id="client-qr">
	</div>
	<p id="queue-id"> </p>
	<div id="host-controls"><button class="small" id="next">Next client</button></div>
<? } else if($status == "polling") { ?>
	<p id="info"></p>
	<div id = 'sliderContainer'><span>You are here</span><div id = 'slider'></div></div>
	<button id="trade" class="small">Trade places</button>
	<button id="leave" class="small">Leave queue</button>
	<button id="pay" class="small">Pay for service</button>

	<div class="payments" id="service-payment">
		<p class="charging">The vendor is charging $10 for the service, you can pay any time.</p>
		<div class="braintree">
		<form id="checkout" method="post" action="/checkout">
		    <div id="dropin"></div>
		    <input type="submit" value="Pay $10">
		</form>
		<fieldset>
		    <legend>Personal information:</legend>
		    First name:<br>
		    <input type="text" name="firstname" value="Mickey">
		    <br>
		    Last name:<br>
		    <input type="text" name="lastname" value="Mouse">
		    <br><br>
		    <input type="submit" value="Submit">
		</fieldset>
		<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
		<script>
		    braintree.setup(
		      // Replace this with a client token from your server
		      "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJkNmMzNzA1ZjQzODA3ZmVjYjY2NzFlMTYxNmQ2YWJmNGYyNmI5OTJjNGRmZmVmNjkxYWMwOThlNzcyM2I5ZTBifGNyZWF0ZWRfYXQ9MjAxNS0wNC0xMVQxNzozOTozNy44MTE0NzAzNzQrMDAwMFx1MDAyNm1lcmNoYW50X2lkPWRjcHNweTJicndkanIzcW5cdTAwMjZwdWJsaWNfa2V5PTl3d3J6cWszdnIzdDRuYzgiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvZGNwc3B5MmJyd2RqcjNxbi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzL2RjcHNweTJicndkanIzcW4vY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIn0sInRocmVlRFNlY3VyZUVuYWJsZWQiOnRydWUsInRocmVlRFNlY3VyZSI6eyJsb29rdXBVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvZGNwc3B5MmJyd2RqcjNxbi90aHJlZV9kX3NlY3VyZS9sb29rdXAifSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQiLCJtZXJjaGFudEFjY291bnRJZCI6InN0Y2gybmZkZndzenl0dzUiLCJjdXJyZW5jeUlzb0NvZGUiOiJVU0QifSwiY29pbmJhc2VFbmFibGVkIjp0cnVlLCJjb2luYmFzZSI6eyJjbGllbnRJZCI6IjExZDI3MjI5YmE1OGI1NmQ3ZTNjMDFhMDUyN2Y0ZDViNDQ2ZDRmNjg0ODE3Y2I2MjNkMjU1YjU3M2FkZGM1OWIiLCJtZXJjaGFudEFjY291bnQiOiJjb2luYmFzZS1kZXZlbG9wbWVudC1tZXJjaGFudEBnZXRicmFpbnRyZWUuY29tIiwic2NvcGVzIjoiYXV0aG9yaXphdGlvbnM6YnJhaW50cmVlIHVzZXIiLCJyZWRpcmVjdFVybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tL2NvaW5iYXNlL29hdXRoL3JlZGlyZWN0LWxhbmRpbmcuaHRtbCJ9LCJtZXJjaGFudElkIjoiZGNwc3B5MmJyd2RqcjNxbiIsInZlbm1vIjoib2ZmbGluZSIsImFwcGxlUGF5Ijp7InN0YXR1cyI6Im1vY2siLCJjb3VudHJ5Q29kZSI6IlVTIiwiY3VycmVuY3lDb2RlIjoiVVNEIiwibWVyY2hhbnRJZGVudGlmaWVyIjoibWVyY2hhbnQuY29tLmJyYWludHJlZXBheW1lbnRzLm1pY2tleXJlaXNzLkR1YWxBcHBsZVBheS5icmFpbnRyZWUiLCJzdXBwb3J0ZWROZXR3b3JrcyI6WyJ2aXNhIiwibWFzdGVyY2FyZCIsImFtZXgiXX19",
		      'dropin', {
			container: 'dropin'
		      });
		    
		</script>
	</div>
    </div>
<? } ?>
</body>

</html>
