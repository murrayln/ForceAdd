$(document).ready(function()
{
$("#course").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;
    //console.log("js called");
    var n = dataString.indexOf(";");
    var space = dataString.indexOf(" ");
    var newDataString = 'id=' + dataString.substring(space+1, n);
$.ajax
({
type: "POST",
url: "getSection.php",
data: newDataString,
cache: false,
success: function(html)
{
    //console.log("sucess!");
    console.log(newDataString);
$("#section").html(html);
} 
});

});




});

function validate(){

    var userText = document.getElementById("text").value;
    var course = document.getElementById("course").value;
    var section = document.getElementById("section").value;

    if(course === "Select a class:" || section === "Choose a section..."){
	alert("You need to specify both a course and section.");
	return false;
    }
	
    
    if(userText.length == 0){

	$("#formAlert").removeClass("hide");
	return false;

    }
    else{
	
	return true;

    }
    





}