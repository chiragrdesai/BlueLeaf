function formValidation()
{
	var fname = document.registration.firstname;
	var lname = document.registration.lastname;
	//var email = document.registration.email; 
	var cmpname = document.registration.compname;
	var postadd = document.registration.postaddress;
	var phone_no = document.registration.phone;
	var uname = document.registration.username;
	var password = document.registration.password;
	var conpass = document.registration.cpassword;
	var user_type = document.registration.user_type;
		
	if(allLetter(fname)) 
	{
		if(lastname(lname)) 
		{
		//	if(ValidateEmail(email))  
		//	{
				if(username(uname)) 
				{
					if(uniqueadduser())
					{
						if(companyname(cmpname))
						{
							if(postaladdress(postadd))
							{
								if(phone(phone_no))
								{
									if(passid_validation(password,5,12))  
									{ 
										if(confirmPass(conpass)) 
										{		
											if(usertype(user_type))
											{	     
												return true;
											}																
										}
									}
								}	
							}	
						}	
					}	
				}
	//		}	
		}
	}
	return false;
} 



function editform()
{
	var fname = document.editadminform.firstname;
	var lname = document.editadminform.lastname;
	var email = document.editadminform.email; 
	var uname = document.editadminform.username;
	var user_type = document.editadminform.user_type;
    var cmpname = document.editadminform.compname;
	var postadd = document.editadminform.postaddress;
	var phone_no = document.editadminform.phone;
		
	if(allLetter(fname)) 
	{
		if(lastname(lname)) 
		{
		//	if(ValidateEmail(email))  
		//	{
				if(username(uname)) 
				{
					if(uniqueedituser())
					{
						if(companyname(cmpname))
						{
							if(postaladdress(postadd))
							{
								if(phone(phone_no))
								{
									if(usertype(user_type))
									{
										return true;
									}	
								}
							}
						}			
					}																						
				}
		//	}	
		}
	}
	return false;
} 

function profileform()
{
	var fname = document.editprofileform.firstname;
	var lname = document.editprofileform.lastname;
//	var email = document.editprofileform.email; 
	var uname = document.editprofileform.username;
	var password = document.editprofileform.password;
	var conpass = document.editprofileform.cpassword;
	var cmpname = document.editadminform.compname;
	var postadd = document.editadminform.postaddress;
	var phone_no = document.editadminform.phone;
		
	if(allLetter(fname)) 
	{
		if(lastname(lname)) 
		{
	//		if(ValidateEmail(email))  
	//		{
				if(username(uname)) 
				{
					if(companyname(cmpname))
						{
							if(postaladdress(postadd))
							{
								if(phone(phone_no))
								{
									if(passprofileid_validation(password,5,12))  
									{ 
										if(confirmPass(conpass)) 
										{			     
											return true;															
										}
									}
								}
							}
									
				}
	//		}	
		}
	}
	return false;
} 
}


function customform()
{
	
	var varname = document.customization.variable_name;
	var varvalue = document.customization.variable_value;
	
	if(variablename(varname)) 
	{	  
		if(variablevalue(varvalue)) 
		{		   
			return true;																			
		}	  	
	}
	return false;
} 


function taskform()
{
	var title = document.tasklist.appsname;
	var manufact = document.tasklist.manufact;
	var version = document.tasklist.version;
	var install = document.tasklist.install;
	var aname = document.tasklist.aname;
	var aphone = document.tasklist.aphone;
	var aemail = document.tasklist.aemail;
	var tname = document.tasklist.tname;
	var tphone = document.tasklist.tphone;
	var temail = document.tasklist.temail;
	var bg = document.tasklist.bg;		
	var database = document.tasklist.database;
	var status = document.tasklist.status;
		
	if(tasktitle(title)) 
	{	  
		if(manufacture(manufact)) 
		{
			if(versions(version)) 
			{
				if(installs(install)) 
				{
					if(name(aname)) 
					{
						if(phone(aphone)) 
						{							
							if(email(aemail)) 
							{
								if(name(tname)) 
								{
									if(phone(tphone)) 
									{	
										if(email(temail)) 
										{
											if(bgs(bg)) 
											{									
												if(taskdb(database)) 
												{	
													if(taskstatus(status)) 
													{				   
														return true;
													}																			
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}													
	return false;
}
/*Function created by Bhavna Dodiya for validate admin_customization form 15/04/2016 */ 
function admin_customization()
{
	var admin_email = document.admin_cust.admin_email;
	var sender_email_address = document.admin_cust.sender_email_address;
	var smtp_port = document.admin_cust.smtp_port;
	var hyperlinks = document.admin_cust.hyperlinks;
	var header_bar_color = document.admin_cust.header_bar_color;
	var records_per_page = document.admin_cust.records_per_page;
	if(username(admin_email)) 
	{
		if(hex_color(header_bar_color))
		{
			if(hex_color(hyperlinks)) 
			{
				if(number_only(smtp_port)) 
				{
					if(username(sender_email_address)) 
					{
						if(number_only(records_per_page)) 
						{
							return true;
						}
					}
				}
			}
		}
	}
	return false;
}
/*Function created by Bhavna Dodiya for validate hex color code 15/04/2016 */ 
function hex_color(color)
{
	if(!/^#[A-Fa-f0-9]{6}$/.test(color.value) && color.value!="")
	{
		alert('Enter Valid Color!');  
		color.focus();
		return false;  	
	}
	return true;
}

/*Function created by Bhavna Dodiya for validate smtp port 15/04/2016 */ 
function number_only(num)
{
	if(!/^[0-9]+$/.test(num.value) && num.value!="")
	{
		alert('Please Enter Valid Number!');  
		num.focus();
		return false; 
	}
	return true;
}



function tasktitle(fname)  
{   	
//	var letters = /^([0-9]|[a-z] )+([0-9a-z]+ )$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Application Name is required');  
		fname.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
	

}  

function companyname(fname)  
{   	
//	var letters = /^([0-9]|[a-z] )+([0-9a-z]+ )$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Company Name is required');  
		fname.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
	

}  

function postaladdress(fname)  
{   	
//	var letters = /^([0-9]|[a-z] )+([0-9a-z]+ )$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Postal Address is required');  
		fname.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
	

}  




function manufacture(fname)  
{   	
//	var letters = /^([0-9]|[a-z] )+([0-9a-z]+ )$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Manufacturer Field is required');  
		fname.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
	

}  

function versions(fname)  
{   	
//	var letters = /^([0-9]|[a-z] )+([0-9a-z]+ )$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Version Field is required');  
		fname.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
	

}  

function installs(fname)  
{   	
//	var letters = /^([0-9]|[a-z] )+([0-9a-z]+ )$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Install Instruction Field is required');  
		fname.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
	

}  

function name(fname)  
{   	
//	var letters = /^([0-9]|[a-z] )+([0-9a-z]+ )$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Name Field is required');  
		fname.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
	

}  

function bgs(fname)  
{   	
//	var letters = /^([0-9]|[a-z] )+([0-9a-z]+ )$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Business Group Field is required');  
		fname.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
	

}  


function phone(fname)  
{   	
	var letters = /^[0-9]*$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Phone No. Field is required');  
		fname.focus();
		return false;  	
	}	
	else if(fname.value.match(letters)) 
	{  
		return true;  
	} 
	else
	{
		alert('Phone No. must have numeric characters only');  
		fname.focus();  
		return false; 
	}

}  

function email(fname)  
{   	
	var letters = /^[A-Z0-9+_.-]+@[A-Z0-9.-]+$/i;  
	
	if(fname.value == null || fname.value == "")
	{
		alert('Email Field is required');  
		fname.focus();
		return false;  	
	}	
	else if(fname.value.match(letters)) 
	{  
		return true;  
	} 
	else
	{
		alert('This email is invalid');  
		fname.focus();  
		return false; 
	}

}  



function taskdb(varname)  
{   	
	
  if(varname.value == null || varname.value == "0")
	{
		alert('please select database connectivity');  
		varname.focus();
		return false;  	
	}	
 
	else
	{
		return true;
	}
		
}  

function taskstatus(varname)  
{   	
	
  if(varname.value == null || varname.value == "0")
	{
		alert('please select status');  
		varname.focus();
		return false;  	
	}	
 
	else
	{
		return true;
	}
		
}  

function usertype(varname)  
{   	
	
  if(varname.value == null || varname.value == "0")
	{
		alert('please select usertype');  
		varname.focus();
		return false;  	
	}	
 
	else
	{
		return true;
	}
		
}  




function variablename(fname)  
{   		
  if(fname.value == null || fname.value == "0")
	{
		alert('please select variablename');  
		fname.focus();
		return false;  	
	}	
	else
	{
		return true;
	}
		
}  

function variablevalue(varvalue)  
{   	
	if(varvalue.value == null || varvalue.value == "")
	{
		alert('Business Group Field is required');  
		varvalue.focus();
		return false;  	
	}	
	else 
	{  
		return true;  
	} 
}  



function loginForm()
{
	var user=document.login.username.value;
	var pass=document.login.password.value;
 
	if(user == '')
	{
		alert('Please Enter Username');
		document.login.username.focus();
		return false;
	}
 
	if(pass == '')
	{
		alert('Please Enter Password');
		document.login.password.focus();
		return false;
	}
}
	

	 
function allLetter(fname)  
{   	
	var letters = /^([0-9]|[a-z])+([0-9a-z]+)$/i;  	
	if(fname.value.match(letters))  
	{  
		return true;  
	}
	else if(fname.value == null || fname.value == "")
	{
		alert('Firstname is required');  
		fname.focus();
		return false;  	
	}
	else  
	{  
		alert('Firstname must have alphanumeric characters only');  
		fname.focus();  
		return false;  
	}  

}  
 
function lastname(lname)  
{   
	var letters = /^([0-9]|[a-z])+([0-9a-z]+)$/i;  
	if(lname.value.match(letters))  
	{  
	    return true;  
	}
	else if(lname.value == null || lname.value == "")
	{
		alert('Lastname is required');  
		lname.focus();
		return false;  	
	}	  
	else  
	{  
		alert('Lastname must have alphanumeric characters only');  
		lname.focus();  
		return false;  
	}  
}  



function middlename(mname)  
{   
	var letters = /^([0-9]|[a-z])+([0-9a-z]+)$/i;  
	if(mname.value.match(letters))  
	{  
	    return true;  
	}
	else if(mname.value == null || mname.value == "")
	{
		alert('Middlename is required');  
		mname.focus();
		return false;  	
	}	  
	else  
	{  
		alert('Middlename must have alphanumeric characters only');  
		mname.focus();  
		return false;  
	}  
}  
/* This function is edit by Bhavna Dodiya 15/04/2016 */
function username(uname)  
{   
	var letters = /^[a-zA-Z0-9_-]+@[A-Za-z]+\.[a-zA-Z]{2,}$/g;  
	if(uname.value.match(letters))  
	{  
		return true;  
	}
	else if(uname.value == null || uname.value == "")
	{
		alert('Email is required');  
		uname.focus();  
		return false;  	
	}
	else  
	{  
		alert('You Have entered Invalid Email Address!');  
		uname.focus();  
		return false;  
	}  
}         
/*

function username(uname)  
{   
	var letters = /^([0-9]|[a-z])+([0-9a-z]+)$/i;  
	if(uname.value.match(letters))  
	{  
		return true;  
	}
	else if(uname.value == null || uname.value == "")
	{
		alert('Username is required');  
		uname.focus();  
		return false;  	
	}
	else  
	{  
		alert('Username must have alphanumeric characters only');  
		uname.focus();  
		return false;  
	}  
} 
*/        
		
function passid_validation(password,mx,my)  
{
	var passid_len = password.value.length;  
	if (passid_len == 0)  
	{  
		alert("Password should not be empty"); 
		password.focus();
		return false;  
	}  
	else if(passid_len >= my || passid_len < mx)
	{
		alert("Password length be between "+mx+" to "+my);  
		password.focus();
		return false;
	}
	else
	{
	     return true;	
	}
}  

function passprofileid_validation(password,mx,my)  
{
	var passid_len = password.value.length;  
	if (passid_len == 0)  
	{  
		return true;
	}  
	else if(passid_len >= my || passid_len < mx)
	{
		alert("Password length be between "+mx+" to "+my);  
		password.focus();
		return false;
	}
	else
	{
	     return true;	
	}
}
	 	 
function ValidateEmail(email)
{	
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(email.value.match(mailformat))
	{
		return true;
	}
	else if(email.value == "" || email.value == null)
	{
		alert("Email is required");
		email.focus();
		return false;
	}
	else
	{
		alert("You have entered an invalid email address!");
		email.focus();
		return false;
	}
}
   

function confirmPass(conpass) 
{
	var pass = document.getElementById("pass1").value
	var confPass = document.getElementById("pass2").value
	if(pass != confPass) 
	{
		alert('Confirm password does not match.');
		conpass.focus();
		return false;
	}
	return true;
}



function uniqueadduser()
{
	var uname = document.getElementById('username').value;
//var id = document.getElementById('edit_hidden_id').value;
  //  var strurl = "http://localhost/codeIgniter/admin/adminmanagment/checkadduser" 
    var strurl = window.location.protocol+"//"+window.location.host+"/projects/blpms/admin/usermanagement/checkadduser";
   
	var check = '';
		$.ajax({
		type:"post",
		async:false,
		url:strurl,
		data:"username="+uname,
		success:function(data){
			//alert(data);
								if(data==0)
								
										{																						
											check = 1;
										}
										else
										{										
											check = 0; 
										}
							  }
			   });			   
	if(check)
	return true;
	else
	alert("Username Already Exist");
	return false;
}

function uniqueedituser()
{
var uname = document.getElementById('username').value;
var id = document.getElementById('edit_hidden_id').value;

	var check = '';
		$.ajax({
		type:"post",
		async:false,
		url:"../checkedituser",
		data:"username="+uname+'&id='+id,
		success:function(data){
			//alert(data);
								if(data==0)
								
										{																						
											check = 1;
										}
										else
										{											
											check = 0; 
										}
							  }
			   });			   
	if(check)
	return true;
	else
	alert("Username Already Exist");
	return false;
}









