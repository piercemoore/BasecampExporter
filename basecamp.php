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

var bc_data = {
	acct_id 	: 	"",
	requiredFields : [],
	projects 	:	{},
	todoLists	:	{},
	todos 		:	{},
	overviews 	:	{},
};
var base_url = "https://basecamp.com/{{acct_id}}/api/v1/projects.json";

//var bc_data.requiredFields = [];

function loadFrame( frameID , url ) {

}

function progress( num ) {
	$("#progressBar").css("width",num + "%" );
}

function log( object ) {
	console.log( object );
}

function trimRequired( fieldName , buttonID ) {
	var rf = bc_data.requiredFields;
	var pos = rf.indexOf( fieldName );
	alert( rf );
	if( pos != -1 ) {
		rf.splice( pos , 1 );
	}
	if( rf.length == 0 ) {
		$("#" + buttonID ).attr("disabled","").removeClass("disabled");
	}
	log( "Required fields: " + rf );
	bc_data.requiredFields = rf;
}

function clearButton( buttonID ) {
	log( "Changing button status of #" + buttonID );
	$("#" + buttonID ).attr("disabled",false).removeClass("disabled");
	log( $("#" + buttonID ) );
}

function parse_projects() {

	var projects = bc_data.overviews.projects;
	var obj = jQuery.parseJSON( projects );
	log( obj );
	var count = 0;

	$.each( obj , function( key , val ) {
		count++;
		bc_data.projects[ this.id ] = this;
	});

	bc_data.overviews.projectCount = count;
	log( bc_data );
}

function showGroup_projects() {
	var fieldList = [];
	$.each( bc_data.projects , function( key , val ) {
		var html = '<div class="projectListDiv"> \
						<iframe src=' + this.url + '></iframe> \
						<input type="text" class="input_projectInfo" data-project="' + this.id + '" id="project_' + this.id + '" /> \
						<a href="#" class="btn btn-success btn_action" id="storeProjectInfo" data-project="' + this.id + '" data-input="project_' + this.id + '">Save</a> \
					</div>';
		$("#group_project_list").append( html );
		fieldList.push( "project_" + this.id );
	});
	bc_data.requiredFields = fieldList;
	log( "Field list: " + fieldList );
	log( "Required fields: " );
	log( bc_data.requiredFields );
}

$(document).ready( function() { 

	$("#log").click( function() {
		log( "Required fields: " );
		log( bc_data.requiredFields );
		log(bc_data);
	});
	$("#input_accountId").change( function() {
		clearButton( "goto_2" );
	});
	$("#input_list_projects").change( function() {
		clearButton( "goto_3" );
	});

	$(".btn_action").live( "click" , function() {
		var id = $(this).attr("id");

		switch( id ) {
			case "goto_1":
				$("#step_pressToBegin").slideUp("fast");
				$("#step_1").slideDown("fast");
				progress( 5 );
				break;
			case "goto_2":
				bc_data.acct_id = $("#input_accountId").val();
				base_url = base_url.replace( "{{acct_id}}" , bc_data.acct_id );
				$("#frame_projects").attr("src", base_url );
				$("#step_1").slideUp("fast");
				$("#step_2").slideDown("fast");
				progress( 10 );
				bc_data.requiredFields = [];
				break;
			case "goto_3":
				bc_data.overviews.projects = $("#input_list_projects").val();
				parse_projects();
				$("#info_projectCount").text( bc_data.overviews.projectCount );
				showGroup_projects();
				$("#step_2").slideUp("fast");
				$("#step_3").slideDown("fast");
				progress( 20 );
				bc_data.requiredFields = [];
				break;
			case "goto_4":
				if( bc_data.requiredFields.length != 0 ) {
					return false;
				}

				$("#step_3").slideUp("fast");
				$("#step_4").slideDown("fast");
				bc_data.requiredFields = [];
				break;
			case "goto_5":
				$("#step_4").slideUp("fast");
				$("#step_5").slideDown("fast");
				bc_data.requiredFields = [];
				break;
			case "storeProjectInfo":
				var project = $(this).attr("data-project");
				var input_pair = $(this).attr("data-input");
				var projectInfo = $("#" + input_pair ).val();
				log( "Input Pair: " + input_pair + ", Project: " + project + ", Project Info: " + projectInfo );
				bc_data.projects[ project ].overview = projectInfo;
				$(this).attr('disabled',"disabled");
				trimRequired( "project_" + project , "goto_4" );
				break;
			default:
				alert("You've clicked an unassigned button.");
		}

		log( bc_data );
	});

})
</script>

<div style="width: 50px;height: 50px;position: fixed;top:10px;right:0;">
	<a href="#" class="btn btn-primary" id="log" alt="Log the BaseCamp Data Object" title="Log the BaseCamp Data Object"><i class="icon-list-alt icon-white"></i></a>
</div>
<div class="container">
	<div class="row">
		<div class="span12 logo">
			<h1>Basecamp Exporter</h1>
		</div>
		<div class="span12">
			<p>The step-by-step way to get your data out of the new Basecamp.</p>
			
		</div>
	</div>

	<div class="row">
		<div class="span1">
			Start
		</div>
		<div class="span10">
			<div class="progress progress-striped active">
				<div class="bar" id="progressBar" style="width: 0%;"></div>
			</div>
		</div>
		<div class="span1">
			All done!
		</div>
	</div>

	<!--<div class="row alert alert-warning">
		<button class="close" href="#" data-dismiss="alert"><i class="icon-remove"></i></button>
		<p>This web utility is designed for <b><i>modern</i></b> browsers. Use in an aged browser is not tested.</p>
	</div>-->

	<div class="row" id="step_pressToBegin" style="">
		<div class="span6 offset3">
			<p>To begin exporting your data, click this giant button</p>
			<button class="btn btn-primary btn-large btn_action" id="goto_1" style="font-size: 2em;font-family:Ubuntu;">Start Exporting my Data!</button>
		</div>
	</div>

	<div class="row" id="step_1" style="display:none;">
		<div class="span6 offset3">
			<p>What is your Basecamp account number?</p>
			<p style="font-size: 1em;">ex: https://www.basecamp.com/{ACCOUNT_ID}/</p>
			<input type="text" id="input_accountId" alt="Enter your Basecamp Account Number Here" title="Enter your Basecamp Account Number Here" /> <button class="btn btn-success"><i class="icon-hdd icon-white"></i></button> <!-- value="1932925" REMOVE THIS ACCOUNT ID IN THE FUTURE -->
			<button class="btn btn-primary btn-large btn_action  stepper disabled" id="goto_2" style="font-size: 2em;font-family:Ubuntu;" disabled="disabled">
				Next step: Get your project listing
			</button>
		</div>
	</div>

	<div class="row" id="step_2" style="display:none;">
		<div class="span8 offset2">
			<p>Below is a big block of text in a textarea. Select it all, copy it, and paste it in the box below. Seriously.</p>
			<p>This is the list of your projects, in case you were wondering.</p>
			<iframe id="frame_projects" src=""></iframe>
			<input type="text" id="input_list_projects" alt="Enter the Text Here" title="Enter the Text Here" /><button class="btn btn-success"><i class="icon-hdd icon-white"></i></button> <!-- value="1932925" REMOVE THIS ACCOUNT ID IN THE FUTURE -->

			<button class="btn btn-primary btn-large btn_action  stepper disabled" id="goto_3" style="font-size: 2em;font-family:Ubuntu;" disabled="disabled">
				Next step, Projects Breakdown
			</button>
		</div>
	</div>

	<div class="row" id="step_3" style="display:none;">
		<div class="span6 offset3">
			<p>Looks like you have <span id="info_projectCount"></span> project(s). Copy the text below to the field under it again.</p>
			<div id="group_project_list"></div>
			<button class="btn btn-primary btn-large btn_action  stepper disabled" id="goto_4" style="font-size: 2em;font-family:Ubuntu;" disabled="disabled">
				Next step: To-Do Lists
			</button>
		</div>
	</div>

	<div class="row" id="step_4" style="display:none;">
		<div class="span6 offset3">
			<p>This is where the two projects are located.</p>
			<button class="btn btn-primary btn-large btn_action stepper disabled" id="goto_5" style="font-size: 2em;font-family:Ubuntu;">
				Something
			</button>
		</div>
	</div>

	<div class="row" id="step_5" style="display:none;">
		<div class="span6 offset3">
			<p>To begin exporting your data, click this giant button</p>
			<button class="btn btn-primary btn-large btn_action stepper disabled" id="goto_6" style="font-size: 2em;font-family:Ubuntu;">
				
			</button>
		</div>
	</div>


</div>



	</body>
</html>