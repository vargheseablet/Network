
//Function To Display Popup
function div_login_show() {
document.getElementById('login').style.display = "block";
}
//Function to Hide Popup
function div_login_hide(){
document.getElementById('login').style.display = "none";
}

//Function To Display Popup
function div_loginLink_show() {
document.getElementById('loginLink').style.display = "block";
}
//Function to Hide Popup
function div_loginLink_hide(){
document.getElementById('loginLink').style.display = "none";
}

//Function To Display Popup
function div_create_show() {
document.getElementById('create').style.display = "block";
}
//Function to Hide Popup
function div_create_hide(){
document.getElementById('create').style.display = "none";
}

function Submit()
        	{  
        		if( document.create_form.uname.value == "" )
	         	{
	            	alert( "Please enter your Username!" );
		            document.create_form.uname.focus() ;
		            return false;
	         	}
         		var emailID = document.create_form.email.value;
         		atpos = emailID.indexOf("@");
         		dotpos = emailID.lastIndexOf(".");
         
         		if (atpos < 1 || ( dotpos - atpos < 2 )) 
         		{
            		alert("Please enter correct Email ID")
            		document.create_form.email.focus() ;
            		return false;
         		}
         		if( document.create_form.mob_no.value == "" )
	         	{
	            	alert( "Please enter your Mobile number!" );
		            document.create_form.mob_no.focus() ;
		            return false;
	         	}
	         	if( document.create_form.psw.value == "" )
	         	{
	            	alert( "Please enter your Password!" );
		            document.create_form.psw.focus() ;
		            return false;
	         	}
	         	return( true );
        	}
