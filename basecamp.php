<!DOCTYPE html>
<html>
	<head>
		<title>Basecamp Fetch</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Anonymous+Pro' rel='stylesheet' type='text/css'>

<style type="text/css">
/*
Color Scheme: CS04 from Adobe Kuler

@yellow: #F6F792
@dark: #333745
@light: #77C4D3
@highlight: #DAEDE2
@red: #EA2E49
*/
*{font-family: Open Sans Condensed,sans-serif;}
body {background: #DAEDE2;color: #333745;text-align: center;}
h1,h2,h3,h4 {font-family: Ubuntu,sans-serif;}
h1 {color: #EA2E49;}
h2 {color: #F6F792;}
h3 {color: #77C4D3;}
.logo {margin-top: 40px;}
	.logo h1 {font-size: 5em;margin-bottom:10px;}
p {font-size: 3em;line-height: 100%;}
input,select {font-family: Ubuntu, Open Sans Condensed, sans-serif;}
code,pre,textarea {font-family: Anonymous Pro, Inconsolata, monospace;}
input,select,code,pre,textarea,iframe{ border-radius: 3px; border: 1px #999 solid;background: #eee;}
input[type="text"],input[type="password"] {padding: 10px 20px;width: 80%;font-size: 2em;}
iframe{ width: 90%;height: 30px;}
</style>
	</head>

	<body>

<script type="text/javascript">

function loadFrame( frameID , url ) {

}

function getFrameText( frameId ) { 

	/*
		Found this snippet at: http://skirtlesden.com/articles/selected-text-in-an-iframe
	*/
    var frame = document.getElementById(frameId); 
 
    var frameWindow = frame && frame.contentWindow; 
    var frameDocument = frameWindow && frameWindow.document; 
 
    if (frameDocument) { 
        if (frameDocument.getSelection) { 
            // Most browsers 
            return String(frameDocument.getSelection()); 
        } 
        else if (frameDocument.selection) { 
            // Internet Explorer 8 and below 
            return frameDocument.selection.createRange().text; 
        } 
        else if (frameWindow.getSelection) { 
            // Safari 3 
            return String(frameWindow.getSelection()); 
        } 
    } 
 
    /* Fall-through. This could happen if this function is called 
       on a frame that doesn't exist or that isn't ready yet. */ 
    return ''; 
}

$(document).ready( function() { 

	var base_url = "https://basecamp.com/{{acct_id}}/api/v1/projects.json";

	loadFrame( "frame_projects" , base_url );

})
</script>

<div class="container">
	<div class="row">
		<div class="span12 logo">
			<h1>Basecamp Exporter</h1>
		</div>
		<div class="span12">
			<p>The step-by-step way to get your data out of the new Basecamp.</p>
		</div>
	</div>

	<hr />

	<div class="row alert alert-warning">
		<button class="close" href="#" data-dismiss="alert"><i class="icon-remove"></i></button>
		<p>This web utility is designed for <b><i>modern</i></b> browsers. Use in an aged browser is not tested.</p>
	</div>

	<div class="row" id="step_pressToBegin" style="display:none;">
		<div class="span6 offset3">
			<p>To begin exporting your data, click this giant button</p>
			<a href="#" class="btn btn-primary btn-large btn_action" id="goto_1" style="font-size: 2em;font-family:Ubuntu;">Start Exporting my Data!</a>
		</div>
	</div>

	<div class="row" id="step_1" style="display:none;">
		<div class="span6 offset3">
			<p>What is your Basecamp account number?</p>
			<p style="font-size: 1em;">ex: https://www.basecamp.com/{ACCOUNT_ID}</p>
			<input type="text" id="input_accountId" alt="Enter your Basecamp Account Number Here" title="Enter your Basecamp Account Number Here" />
			<a href="#" class="btn btn-primary btn-large btn_action" id="goto_2" style="font-size: 2em;font-family:Ubuntu;">
				Next step: Get your project listing
			</a>
		</div>
	</div>

	<div class="row" id="step_2">
		<div class="span8 offset2">
			<p>Below is a big block of text in a textarea. Select it all, copy it, and paste it in the box below. Seriously.</p>

			<table class="table table-bordered">
				<tr>
					<td><a href="#" class="btn btn-primary"><i class="icon-book" alt="Select all Text in the Page" title="Select all Text in the Page"></i></a></td>
					<td><iframe id="frame_projects" src="https://basecamp.com/1932925/api/v1/projects.json"></iframe></td>
				</tr>
				<tr>
					<td colspan="2"><input type="text" id="input_list_projects" alt="Enter the Text Here" title="Enter the Text Here" /></td>
				</tr>
			</table>
			<a href="#" class="btn btn-primary btn-large btn_action" id="goto_1" style="font-size: 2em;font-family:Ubuntu;">
				Next step
			</a>
		</div>
	</div>

	<div class="row" id="step_pressToBegin">
		<div class="span6 offset3">
			<p>To begin exporting your data, click this giant button</p>
			<a href="#" class="btn btn-primary btn-large btn_action" id="goto_1" style="font-size: 2em;font-family:Ubuntu;">
				
			</a>
		</div>
	</div>

	<div class="row" id="step_pressToBegin">
		<div class="span6 offset3">
			<p>To begin exporting your data, click this giant button</p>
			<a href="#" class="btn btn-primary btn-large btn_action" id="goto_1" style="font-size: 2em;font-family:Ubuntu;">
				
			</a>
		</div>
	</div>

	<div class="row" id="step_pressToBegin">
		<div class="span6 offset3">
			<p>To begin exporting your data, click this giant button</p>
			<a href="#" class="btn btn-primary btn-large btn_action" id="goto_1" style="font-size: 2em;font-family:Ubuntu;">
				
			</a>
		</div>
	</div>


</div>



	</body>
</html>