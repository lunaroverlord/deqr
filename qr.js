user = "";
userHasSlider = false;
$(document).ready(function()
{
	user = $.cookie("user");
	$("#create").click(function()
	{
		$.get("api/index.php", 
			{action: "createNewQueue", name: "test", time: 20},
			function(data)
			{
				//console.log(data);
				queuer("http://olafs.eu/qr/?" + data.id);
				$("#general-controls").hide();
				$("#host-controls").show();
				$("#queue-id").html(data.id);
				queue = data.id;

			}, "json");
		//display qr with link from data
	});
	$("#join").click(function()
	{
		//qr
		/*
		$.get("api/index.php", 
			{action: "createNewQueue", name: "test", time: 45},
			function(data)
			{
				console.log(data);
			}, "json");
			*/
	});
	$("#trade").click(function(){
		$("#charging").html("The person in queue wants $2 to swap places with you.");
		$(".payments").show();
	});
	$("#pay").click(function(){
		$("#charging").html("The vendor is charging $10 for the service, you can pay any time.");
		$(".payments").show();
	});

	$("#next").click(function(){
		$.get("api/index.php", 
			{action: "checkCustomer", queue: queue},
			function(data)
			{

			}, "json");
	});

	if(status == "polling")
	{
		$.get("api/index.php", 
			{action: "createNewCustomer", id: queue},
			function(data)
			{
				console.log(data);
				user = data.id;
				$.cookie("user", data.id);
				setInterval(poll, 1000);
			}, "json");
	}
});

function poll()
{
	$.get("api/index.php", 
		{action: "getStatus", id: user},
		function(data)
		{
			/*$("#info").html("Waiting as " + data.currentNumber + " / " + data.lastPersonNumber + ", time remaining " + data.estimatedTime + " minutes");*/
			$("#info").html("<div id = 'statusContainer'><div id='customerNumber'><span>Your number: </span>" + data.customerNumber + "</div><div id='currentNumber'><span>Currently serving: </span>" + data.currentNumber + "</div><div id='estimatedTime'><span>You have to wait roughly </span>" + data.estimatedTime + " <span>minutes</span></div></div>");
			/*
			console.log(data.customerNumber);
			console.log(data.currentNumber);
			console.log(data.lastPersonNumber);
			*/
			if(data.customerNumber == data.currentNumber && "vibrate" in navigator)
			{
				navigator.vibrate(1000);
			}
			$("#sliderContainer").show();
			if(!userHasSlider)
			{
				$("#slider").slider({
					value:parseInt(-data.customerNumber),
					min:parseInt(-data.lastPersonNumber),
					max:parseInt(-data.currentNumber),
					slide: userChoice
				});
			}
		}, "json");
}

function userChoice(e, ui)
{
	userHasSlider = true;
	$("#trade").html("Trade places with " + -ui.value);
	//alert(ui.value);
}

function queuer(link)
{
    options = 
	{
	// render method: 'canvas', 'image' or 'div'
	render: 'div',

	// version range somewhere in 1 .. 40
	minVersion: 1,
	maxVersion: 40,

	// error correction level: 'L', 'M', 'Q' or 'H'
	ecLevel: 'L',

	// offset in pixel if drawn onto existing canvas
	left: 0,
	top: 0,

	// size in pixel
	size: 400,

	// code color or image element
	fill: '#000',

	// background color or image element, null for transparent background
	background: null,

	// content
	text: link,

	// corner radius relative to module width: 0.0 .. 0.5
	radius: 0,

	// quiet zone in modules
	quiet: 0,

	// modes
	// 0: normal
	// 1: label strip
	// 2: label box
	// 3: image strip
	// 4: image box
	mode: 0,

	mSize: 0.1,
	mPosX: 0.5,
	mPosY: 0.5,

	label: 'no label',
	fontname: 'sans',
	fontcolor: '#000',

	image: null
    };
    $("#client-qr").qrcode(options);
}

