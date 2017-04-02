<!DOCTYPE>
	<html>
		<head>
			<title>
				<?= $pg_title?>
			</title>
			<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
	background-color: #333;
}

#msg li {
    float: none;
    background-color: white;
}

li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}


    
div.panel {
    padding: 0 18px;
    background-color: white;
     border-style: solid;
    border-width: 8px;
     height:1000 px;
     border-color: green;
     padding-bottom:100;
}
</style>
<script>
function validateForm() {
    var x = document.forms["postad"]["contact"].value;
    if (x == "") {
        alert("Contact must not be empty");
        return false;
    }
}
function passwdcheck() {
    var x = document.forms["LoginF"]["passwd123"].value;
    if (x == "") {
        alert("Password cannot empty");
        return false;
    }
}
function passwdmatch() {
    var pass1 = document.getElementById("pwd").value;
    var pass2 = document.getElementById("rpwd").value;
    var ok = true;
    if (pass1 != pass2) {
        //alert("Passwords Do not match");
        document.getElementById("pwd").style.borderColor = "#E34234";
        document.getElementById("rpwd").style.borderColor = "#E34234";
        ok = false;
		alert("Passwords dosent Match!!!");
    }
   /* else {
        alert("Passwords Match!!!");
}*/
    return ok;
}
</script>
		</head>
		<body>
