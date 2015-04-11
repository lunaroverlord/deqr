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
<link rel="stylesheet" type="text/css" href="qr.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="qr_generate/jquery.qrcode-0.11.0.min.js"></script>
<script src="qr.js"></script>

<!-- variables for js -->
<script type="text/javascript">
status = "<? echo $status; ?>";
queue = "<? echo $queue; ?>";
</script>

</head>

<body>
<? if($status == "default") { ?>
	<button id="create">Create a queue</button>
	<button id="join">Join a queue</button>
	<div id="client-qr">
	</div>
<? } else if($status == "polling") { ?>
	Estimated waiting time: 12:04s
	<button class="small">Trade places</button>
	<button class="small">Leave queue</button>
	You need to pay for the service!
<? } ?>
</body>

</html>
