//Global
var CUR_TEXT = 'Russian';

var CUR_LANG_ID = 1;
var MAX_LANG_ID = 1;

var MAX_WORD_ID = 1;
var CUR_WORD_ID = 1;

var MAX_EQUAL = 1;
var CUR_EQUAL = 1;
	
window.onload = function() {				//Start only after page load.
	initas();
};

	 
function initas() {
	loadtext(CUR_TEXT, CUR_TEXT);
	db_lang_read("read");	
}

//Scroll up smooth.
$(document).ready(function() {
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
	// Make sure this.hash has a value before overriding default behavior
	if (this.hash !== "") {
	  // Prevent default anchor click behavior
	  event.preventDefault();

	  // Store hash
	  var hash = this.hash;

	  // Using jQuery's animate() method to add smooth page scroll
	  // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
	  $('html, body').animate({
		scrollTop: $(hash).offset().top
	  }, 900, function(){  
				// Add hash (#) to URL when done scrolling (default click behavior)
				window.location.hash = hash;
			  });
	}
  });
  
  $(window).scroll(function() {
	$(".slideanim").each(function() {
	  var pos = $(this).offset().top;

	  var winTop = $(window).scrollTop();
		if (pos < winTop + 600) {
		  $(this).addClass("slide");
		}
	});
  });
});


function loadtext(old_langName, new_langName) {
	//1 Set initial.

	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if(document.getElementById("textPlace"))
				document.getElementById("textPlace").innerHTML = xmlhttp.responseText;	
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/loadtext.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "old_langName="; 		paramsa += old_langName;
		paramsa += "&new_langName=";		paramsa += new_langName;
	xmlhttp.send(paramsa);	
}	

/* ------------------ Language CRUD ----------------------- */
function db_lang_read(in_action) {
	//1 Set initial.
	var lang_action = in_action;
	if(in_action == "change") {
		document.getElementById("change_lang_button").style.display = "none";	
		document.getElementById("accept_lang_button").style.display = "inline";	
	}		
	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("langPlace").innerHTML = xmlhttp.responseText;	
			MAX_LANG_ID = parseInt(document.getElementById("hidden_maxID").innerHTML) + 1;
			db_word_read("read");
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/db_lang_read.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "CUR_LANG_ID="; 		paramsa += CUR_LANG_ID;
		paramsa += "&lang_action=";			paramsa += lang_action;
		paramsa += "&MAX_LANG_ID=";			paramsa += MAX_LANG_ID;
	xmlhttp.send(paramsa);		
}

function lang_choose(in_id)	{
	CUR_LANG_ID = in_id;
	db_lang_read("read");
	
	var index = "textname" + in_id;
	var langname = document.getElementById(index).innerHTML;
	
	loadtext(CUR_TEXT, langname);
}	

function db_lang_delete(in_cur_langID) {
	//Delete <li>			
	var parent = document.getElementById("langPlace");	
	var childID = "langname_li" + in_cur_langID;
	var child = document.getElementById(childID);
	parent.removeChild(child);

	//Delete from db.
	//1 Set initial.

	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			db_lang_read("change");
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/db_lang_delete.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "in_cur_langID="; 
		paramsa += in_cur_langID;	
	xmlhttp.send(paramsa);		
}

function db_lang_create() {
	//1 Set initial.
	var input_lang_name = document.getElementById("input_lang_nameID").value;

	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//Add new string.
			document.getElementById("langPlace").innerHTML += xmlhttp.responseText;	
			MAX_LANG_ID++;		
			
			document.getElementById("input_lang_nameID").value = "";	
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/db_lang_create.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "input_lang_name="; 
		paramsa += input_lang_name;	
		paramsa += "&MAX_LANG_ID=";
		paramsa += MAX_LANG_ID;	
	xmlhttp.send(paramsa);		
}

function db_lang_update() {
	//1 Set initial.
	document.getElementById("change_lang_button").style.display = "inline";	
	document.getElementById("accept_lang_button").style.display = "none";
	
	var paramsF1 = "";
	var paramsF = "";
	var numNames = 0;	
	var childID;
	var childVal;
	var exister;
	for(var i=0; i<MAX_LANG_ID; i++) {
		childID = "langname_inp" + i;
		exister = document.getElementById(childID);
		if(exister) {
			childVal = "langname_val" + i;	
			paramsF += "&" + childID + "=";	paramsF += i;
			paramsF += "&" + childVal + "=";
            //Anti injections
			paramsF1 = document.getElementById(childID).value;
			paramsF1 = htmlDecodeAS(paramsF1);
			paramsF1 = SQLDecodeAS(paramsF1);
			paramsF += paramsF1;
			numNames++;
		}	
	}
	
	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			db_lang_read("read");
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/db_lang_update.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "MAX_LANG_ID=";		paramsa += MAX_LANG_ID;	
		paramsa += "&numNames=";			paramsa += numNames;	
		paramsa += "&paramsF=";				paramsa += paramsF;		
	xmlhttp.send(paramsa);		
}



/* ------------------ Word CRUD ----------------------- */
function db_word_read(in_action)			
{
	//1 Set initial.
	var word_action = in_action;
	if(in_action == "change") {
		document.getElementById("accept_word_button").style.display = "inline";	
		
		document.getElementById("change_word_button").style.display = "none";	
		document.getElementById("newword_button").style.display = "none";	
		document.getElementById("lang_module").style.display = "none";
	}
	if(in_action == "addnew") {
		document.getElementById("accept_newword_button").style.display = "inline";	
		
		document.getElementById("change_word_button").style.display = "none";			
		document.getElementById("newword_button").style.display = "none";	
		document.getElementById("lang_module").style.display = "none";
	}	
	
	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("wordPlace").innerHTML = xmlhttp.responseText;	
			MAX_WORD_ID = parseInt(document.getElementById("hidden_maxWordID").innerHTML) + 1;
			MAX_EQUAL = parseInt(document.getElementById("hidden_maxEqual").innerHTML);		
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/db_word_read.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "CUR_LANG_ID="; 		paramsa += CUR_LANG_ID;
		
		paramsa += "&word_action=";			paramsa += word_action;
		paramsa += "&CUR_WORD_ID=";			paramsa += CUR_WORD_ID;
		paramsa += "&MAX_WORD_ID=";			paramsa += MAX_WORD_ID;
		
		paramsa += "&CUR_EQUAL=";			paramsa += CUR_EQUAL;
		paramsa += "&MAX_EQUAL=";			paramsa += MAX_EQUAL;
	xmlhttp.send(paramsa);		
}

function word_choose(in_id, in_equal) {
	CUR_WORD_ID = in_id;
	CUR_EQUAL = in_equal;
	db_word_read("read");
}

function db_word_delete(in_cur_wordID) {
	//Delete <li>			
	var parent = document.getElementById("wordPlace");	
	var childID = "wordname_li" + in_cur_wordID;
	var child = document.getElementById(childID);
	parent.removeChild(child);
		
	//Delete from db.
	//1 Set initial.

	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			db_word_read("change");
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/db_word_delete.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "in_cur_wordID="; 
		paramsa += in_cur_wordID;	
	xmlhttp.send(paramsa);		
}

function db_word_create() {
	//1 Set initial.
	var input_wordlang_name = document.getElementById("input_wordlang_nameID").value;
	var input_word_name = document.getElementById("input_word_nameID").value;

	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//Add new string.
			document.getElementById("wordPlace").innerHTML += xmlhttp.responseText;	
			MAX_WORD_ID++;
			
			document.getElementById("input_wordlang_nameID").value = "";	
			document.getElementById("input_word_nameID").value = "";	
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/db_word_create.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "input_wordlang_name="; 		paramsa += input_wordlang_name;
		paramsa += "&input_word_name=";				paramsa += input_word_name;
		paramsa += "&MAX_WORD_ID=";					paramsa += MAX_WORD_ID;
		paramsa += "&CUR_EQUAL=";					paramsa += CUR_EQUAL;
	xmlhttp.send(paramsa);		
}

function db_word_update(in_action) {
	//1 Set initial.
	document.getElementById("change_word_button").style.display = "inline";	
	document.getElementById("accept_word_button").style.display = "none";
	
	document.getElementById("newword_button").style.display = "inline";
	document.getElementById("accept_newword_button").style.display = "none";
	
	document.getElementById("lang_module").style.display = "block";

	var paramsF = "";
    var paramsF1 = "";
	var numNames = 0;	
	var childID;
	var childVal;
	var childLangVal;
	var exister;	
	for(var i=0; i<MAX_WORD_ID; i++) {
		childID = "wordname_inp" + i;
		exister = document.getElementById(childID);
		if(exister) {
			childVal = "wordname_val" + i;	
			childLangVal = "wordlangname" + i;	
			paramsF += "&" + childID + "=";	paramsF += i;
            paramsF += "&" + childVal + "=";

            //Anti injections
            paramsF1 = document.getElementById(childID).value;
            paramsF1 = htmlDecodeAS(paramsF1);
            paramsF1 = SQLDecodeAS(paramsF1);
            paramsF += paramsF1;

			paramsF += "&" + childLangVal + "=";
			paramsF += document.getElementById(childLangVal).innerHTML;
			numNames++;		
		}	
	}
		
	//2 Ready to receive data.	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			db_word_read("read");
		}	
	};

	//3 Send, wait data.	
	xmlhttp.open("POST", "php/db_word_update.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		var paramsa = "MAX_WORD_ID="; 		paramsa += MAX_WORD_ID;	
		paramsa += "&numNames=";			paramsa += numNames;	
		paramsa += "&paramsF=";				paramsa += paramsF;	
		paramsa += "&in_action=";			paramsa += in_action;	
		paramsa += "&MAX_EQUAL=";			paramsa += MAX_EQUAL;			
	xmlhttp.send(paramsa);	
}


//Anti XSS-injection
function htmlDecodeAS(t) {
	if (t)
		t = $('<div />').html(t).text();

	return t;
}

//Anti SQL-injection
//Replace all '=' on 'EQ'
function SQLDecodeAS(t) {
    if(t)
    	t = t.replace(/=/gi, "EQ");

    return t;
}
