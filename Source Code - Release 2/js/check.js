function CheckCreate()  {
    var first = document.forms['Create']['First'].value;
    var last = document.forms['Create']['Last'].value;
    var user = document.forms['Create']['Username'].value;
    var email = document.forms['Create']['Email'].value;
    var mobile = document.forms['Create']['Mobile'].value;
    var pass = document.forms['Create']['Password'].value;
    var passConfirm = document.forms['Create']['Confirm Password'].value;
    
    if(first == "" || first == null) {
        alert("First Name field must be filled");
        return false;
    }
    
    if(last == "" || last == null) {
        alert("Last Name field must be filled");
        return false;
    }
    
    if(user.length < 5) {
        if(user == "" || user == null)  {
            alert("Username field must be filled");
            return false;
        }
        alert("Username must be longer than 5 characters");
        return false;
    }
    if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))  {
        
    } else {
        alert("Email invalid");
        return false;
        
    }
        
    if(mobile.length != 10)  {
        if(isNaN(mobile))  {
            alert("Mobile can only be a number");
            return false;
        }
        alert("Mobile number is invalid, must be 10 numbers in length");
        return false;
    }
    if(pass.length < 8 || pass != passConfirm)  {
        if(pass != passConfirm)  {
            alert("Password does not match");
            return false;
        }
        alert("Password must be 8 characters long");
        return false;
    }
    
}

function checkTime()  {
    var time = document.forms['edit']['time'].value;
    if(/^(([1]?[0-2])|[0-9]?):[0-5][0-9][aApP][mM]$/.test(time))  {
        
    } else {
        alert("invalid Time, Remember to specify AM or PM")
        return false;
    }
}