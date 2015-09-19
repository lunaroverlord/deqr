/*
 * Business logic for the DeQR service
 *
 * Currently the bare minimum functionality is implemented, which lets 
 * you create a queue and other people join it. Joiners get a status view
 * of the current situation and can select a person to trade places with.
 *
 * When it's the client's turn, they get a beep and vibration signal through
 * their HTML5 browser.
 */

//Default - no user
user = "";
userHasSlider = false;
var timerInt;

$(document).ready(function()
{
	// Get user
	user = $.cookie("user");
	 
	// Button: create a queue
	$("#create").click(function()
	{
		$.get("api/index.php", 
			{action: "createNewQueue", name: "test", time: 20},
			function(data)
			{
				queuer("http://olafs.eu/qr/?" + data.id);
				$("#general-controls").hide();
				$("#host-controls").show();
				$("#queue-id").html(data.id);
				queue = data.id;
			}, "json");
	});

	// Button: join an existing queue
	$("#join").click(function()
	{
		// Not implemented
	});

	// Button: trade places
	$("#trade").click(function()
	{
		// Dummy offer
		$("#charging").html("The person in queue wants $2 to swap places with you.");
		$(".payments").show();
	});

	// Button: pay for service
	$("#pay").click(function()
	{
		// Dummy payment
		$("#charging").html("The vendor is charging $10 for the service, you can pay any time.");
		$(".payments").show();
	});

	// Button: next customer
	$("#next").click(function()
	{
		$.get("api/index.php", 
			{ action: "checkCustomer", queue: queue },
			function(data) { }, "json");
	});

	// Queueing in progress, poll server
	if(status == "polling")
	{
		$.get("api/index.php", 
			{ action: "createNewCustomer", id: queue },
			function(data)
			{
				console.log(data);
				user = data.id;
				$.cookie("user", data.id);
				timerInt = setInterval(poll, 1000);
			}, "json");
	}
});

// Retrieve the status page (called every time)
function poll()
{
	$.get("api/index.php", 
		{ action: "getStatus", id: user },
		function(data)
		{
			// TODO: prettify
			$("#info").html("<div id = 'statusContainer'><div id='customerNumber'><span>Your number: </span>" + data.customerNumber + "</div><div id='currentNumber'><span>Currently serving: </span>" + data.currentNumber + "</div><div id='estimatedTime'><span>You have to wait roughly </span>" + Math.abs(data.estimatedTime) + " <span>minutes</span></div></div>");

			// We are the current customer and it's our turn - beep and vibrate
			if(data.customerNumber == data.currentNumber)
			{
				var audio = new Audio('ping.mp3');
				audio.play();

				if("vibrate" in navigator)
					navigator.vibrate(1000);

				clearInterval(timerInt);
			}

			// Show slider to select which person to trade with
			$("#sliderContainer").show();
			if(!userHasSlider)
			{
				$("#slider").slider(
				{
					value:parseInt(-data.customerNumber),
					min:parseInt(-data.lastPersonNumber),
					max:parseInt(-data.currentNumber),
					slide: userChoice
				});
			}
		}, "json");
}

// Handler for trading places
function userChoice(e, ui)
{
	userHasSlider = true;
	$("#trade").html("Trade places with " + -ui.value);
}

// Creates a QR code of given URL
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

