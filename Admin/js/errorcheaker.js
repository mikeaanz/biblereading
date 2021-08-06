$(document).ready(function(){
var ErrorHomPr = 0,
	ErrorGospCal = 0,
	ErrorMtgHeld = 0,
	ErrorSmGMHeld = 0,
	ErrorSaintsJoinProp = 0,
	ErrorGosfriend = 0,
	ErrorTtlTrainee = 0;
var Msg = "Total Trainee Team-Hours should not be zero (0). Amen Brothers & Sisters!!"
InputCorrection ("txtTeamHours","lblTeamHours","Invalid",Msg);
$("#btnEditProgData").attr("disabled",true);
function InputCorrection(TextName, LabelName, Input,Tooltip){
	if (Input == "Invalid"){
		$("#" + TextName).css("borderColor", "red");
		$("#" + LabelName).css("color", "red");
		// $("#" + LabelName).text("* " + $("#" + LabelName).text());
		$("#" + TextName).attr("title",Tooltip)
		$("#" + TextName).tooltip({});
	}
	else
	{
		$("#" + TextName).css("borderColor", "");
		$("#" + LabelName).css("color", "");
		// $("#" + LabelName).text($("#" + LabelName).text().replace("* ",""));
		$("#" + TextName).attr("title","");
		$("#" + TextName).tooltip('dispose');
	}
	if (ErrorHomPr == 1 || 
	    ErrorGospCal == 1 ||
		ErrorMtgHeld == 1 ||
		ErrorSmGMHeld == 1 ||
		ErrorSaintsJoinProp == 1 ||
		ErrorGosfriend == 1 ||
		ErrorTtlTrainee == 1){
			$("#btnEditProgData")[0].disabled = true;
			// Swal.fire({
  			// 	type: 'error',
  			// 	title: 'Warning! Wrong Input',
 			// 	text: 'Please Re-check your data. Amen Brothers & Sisters!!',
  			// 	footer: '<a >Note! Re-check your inputs before submitting.</a>'
			// });
	} else {
		$("#btnEditProgData")[0].disabled = false;
	}
}


  $("#txtHomePreach, #txtHomeKnock").blur(function(){
	  var knock = $("#txtHomeKnock").val();
      var preach = $("#txtHomePreach").val();
      if(parseInt(knock) < parseInt(preach)){
      	var Msg = "Homes Knocked  must be greater than the Homes Preached. Amen Brothers & Sisters!!"
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Homes Knocked  must be greater than the Homes Preached.Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// });
		ErrorHomPr = 1;
		InputCorrection ("txtHomePreach","lblHomePreach","Invalid",Msg);
    }
	// else if (parseInt(knock >= preach){
	else {
		// Msg Correct Prompt
		// Swal.fire({
  		// 	position: 'top-end',
  		// 	type: 'success',
  		// 	title: 'Hallelujah,Correct Input!',
  		// 	showConfirmButton: false,
  		// 	timer: 1600
		// });
		ErrorHomPr = 0;
		InputCorrection ("txtHomePreach","lblHomePreach","Correct","");
	}
  });

  $("#txtPersonCont, #txtgospelcal").blur(function(){
	var PerCont = $("#txtPersonCont").val();
	var PerRecGos = $("#txtgospelcal").val();
	if(parseInt(PerCont) < parseInt(PerRecGos)){
		var Msg = "Persons who received the gospel/called must not be greater than Persons contacted. Amen Brothers & Sisters!!"
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Person Contact must be greater than the Persons who received the gospel/called.Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// });
		ErrorGospCal = 1;
		InputCorrection ("txtgospelcal","lblgospelcal","Invalid",Msg);
	} else {
		ErrorGospCal = 0;
		InputCorrection ("txtgospelcal","lblgospelcal","Correct","");
	}
  });
  
  $("#txtmtgheld, #txthomemet").blur(function(){
	var TtlHomHeld = $("#txtmtgheld").val();
	var TtlPerMet = $("#txthomemet").val();
	if(parseInt(TtlHomHeld) == 0 && parseInt(TtlPerMet) == 0){
		ErrorMtgHeld = 0;
		InputCorrection ("txthomemet","lblhomemet","Correct","");
	}
	else if (parseInt(TtlPerMet) == 0){
		var Msg = "Total Person Meet should not be zero (0). Amen Brothers & Sisters!!"
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Total Person Meet should not be zero (0).Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// });
		ErrorMtgHeld = 1;
		InputCorrection ("txthomemet","lblhomemet","Invalid",Msg);
	} else if (parseInt(TtlHomHeld) == 0){
		var Msg = "Total Home meetings held should not be zero (0). Amen Brothers & Sisters!!"
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Total Person Meet should not be zero (0).Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// });
		ErrorMtgHeld = 1;
		InputCorrection ("txthomemet","lblhomemet","Invalid",Msg);
	} else if (parseInt(TtlPerMet) < parseInt(TtlHomHeld)) {
		var Msg = 'Total Persons Home Meet must be greater than or equal to the Total Home Held. Amen Brothers & Sisters!!'
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Total Person Meet must be greater than the Total Home Held.Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// });
		txtErrorMtgHeld = 1;
		InputCorrection ("txthomemet","lblhomemet","Invalid",Msg);
	} else {
		ErrorMtgHeld = 0;
		InputCorrection ("txthomemet","lblhomemet","Correct","");
	}
  });

  $("#txtSmGMHeld, #txtTtlSaintsAttend").blur(function(){
	var TtlSaintsAttend = $("#txtTtlSaintsAttend").val();
	var SmGMHeld = $("#txtSmGMHeld").val();
	if(parseInt(TtlSaintsAttend) == 0 && parseInt(SmGMHeld) == 0){
		ErrorSmGMHeld = 0;
		InputCorrection ("txtTtlSaintsAttend","lblTtlSaintsAttend","Correct","");
	} else if(parseInt(TtlSaintsAttend) == 0){
		var Msg = "Total Local Saint Attending Small Group Meeting should not be zero (0). Amen Brothers & Sisters!!"
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Total Local Saint Attending Small Group Meeting should not be zero (0).Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// })
		ErrorSmGMHeld = 1;
		InputCorrection ("txtTtlSaintsAttend","lblTtlSaintsAttend","Invalid",Msg);
	} else if(parseInt(SmGMHeld) == 0){
		var Msg = "Small Group Meetings Held should not be zero (0). Amen Brothers & Sisters!!"
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Total Local Saint Attending Small Group Meeting should not be zero (0).Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// })
		ErrorSmGMHeld = 1;
		InputCorrection ("txtTtlSaintsAttend","lblTtlSaintsAttend","Invalid",Msg);
	} else if (parseInt(TtlSaintsAttend) < parseInt(SmGMHeld)){
		var Msg = "Total Local Saint Attending Small Group Meeting must be greater than or equal to the Small Group Meetings Held. Amen Brothers & Sisters!!"
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Total Local Saint Attending Small Group Meeting must be greater than the Small Group Meetings Held.Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// });
		ErrorSmGMHeld = 1;
		InputCorrection ("txtTtlSaintsAttend","lblTtlSaintsAttend","Invalid",Msg);
	} else {
		ErrorSmGMHeld = 0;
		InputCorrection ("txtTtlSaintsAttend","lblTtlSaintsAttend","Correct","");
	}
  });

  $("#txtSaintsJoinProp, #txtTtlSaintsHours").blur(function(){
	var TtlHours = $("#txtTtlSaintsHours").val();
	var SaintsJoinProp = $("#txtSaintsJoinProp").val();
	if(parseInt(TtlHours) == 0 && parseInt(SaintsJoinProp) == 0){
		ErrorSaintsJoinProp = 0;
		InputCorrection ("txtTtlSaintsHours","lblTtlSaintsHours","Correct","");
	}
	else if(parseInt(SaintsJoinProp) == 0){
		var Msg = "Local Saints Joining Propagation should not be zero (0). Amen Brothers & Sisters!!"
		ErrorSaintsJoinProp = 1;
		InputCorrection ("txtTtlSaintsHours","lblTtlSaintsHours","Invalid",Msg);
	} else if(parseInt(TtlHours) == 0){
		var Msg = "Total Man-Hours of Local Saints Joining Propagation should not be zero (0). Amen Brothers & Sisters!!"
		// Msg Error Prompt
		// Swal.fire({
  		// 	type: 'error',
  		// 	title: 'Warning! Wrong Input',
 		// 	text: 'Total Man-Hours of Local Saints Joining Propagation should have value.Amen Brothers & Sisters!!',
  		// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		// });
		ErrorSaintsJoinProp = 1;
		InputCorrection ("txtTtlSaintsHours","lblTtlSaintsHours","Invalid",Msg);
	} else {
		ErrorSaintsJoinProp = 0;
		ErrorSaintsJoinProp = " ";
		InputCorrection ("txtTtlSaintsHours","lblTtlSaintsHours","Correct","");
	}
  });

  $("#txtgosfriend").on('blur',function (){
	var personreceive = $("#txtgospelcal").val();
	var openfollowup =$("#txtgosfriend").val();
		if( parseInt(personreceive) < parseInt(openfollowup)){
			var Msg = "Gospel friends open for follow-up must not be greater than Persons who received the gospel/called. Amen Brothers & Sisters!!"
			// Msg Error Prompt      
	  		// Swal.fire({
			// 	type: 'error',
			// 	title: 'Warning! Wrong Input',
			// 	text: 'Homes Knocked must be greater than the Homes Preached.Amen Brothers & Sisters!!',
			// 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
	  		// })
			ErrorGosfriend = 1;
			InputCorrection ("txtgosfriend","lblgosfriend","Invalid",Msg);
 		} else {
			// Msg Correct Prompt
			// Swal.fire({
  			// 	position: 'top-end',
  			// 	type: 'success',
  			// 	title: 'Hallelujah,Correct Input!',
  			// 	showConfirmButton: false,
  			// 	timer: 1600
			// });
			ErrorGosfriend = 0;
			InputCorrection ("txtgosfriend","lblgosfriend","Correct","");
 		}
	});

	$("#txtTeamHours").blur(function(){
		var TeamHours = $("#txtTeamHours").val();
		if(parseInt(TeamHours) == 0 || !TeamHours ){
			var Msg = "Total Trainee Team-Hours should not be zero (0). Amen Brothers & Sisters!!"
			ErrorTtlTrainee = 1;
			InputCorrection ("txtTeamHours","lblTeamHours","Invalid",Msg);
		} else {
			ErrorTtlTrainee = 0;
			InputCorrection ("txtTeamHours","lblTeamHours","Correct","");
		}
	});
});
