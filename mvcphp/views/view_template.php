<!DOCTYPE html>
<html lang="en">
<head>
    <!-- asver=1.1 -->
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Word-by-word Translation</title>
	
	<script src="js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>	
	<script src="js/as-ajax.js"></script>	
	
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/indexas.css?asver=1.1">
	
	<link rel="shortcut icon" href="img/favicon.ico">	
	<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">	
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<?php
	//Test cookies
/*
	$cookie_name = "Testcookie1";
	$cookie_value = "Hello";
	$cookie_expire = time() + (86400 * 3);
	$cookie_available = '/';
	$cookie_domain_name = '.' . $_SERVER['HTTP_HOST'];
	$cookie_HTTPS_only = false;
	$cookie_HTTP_only = false;
	setcookie($cookie_name, $cookie_value, $cookie_expire, $cookie_available, $cookie_domain_name, $cookie_HTTPS_only, $cookie_HTTP_only);
*/
?>

	
	<div class="align-center2-as01">
	<div class="as-container-padding">
	
		<!-- Navbar -->
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="/">
				<img src="img/rocket100.png" alt="translator">
			  </a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="/">MAIN</a></li>
				<li><a href="allwordslist">ALL WORDS</a></li>
				<li><a href="contact">CONTACTS</a></li>
				<li id="menu_login"><a href="login">LOGIN</a></li>
				<li id="menu_admin"><a href="admin">CABINET</a></li>
			  </ul>
			</div>
		  </div>
		</nav>

		
		<div class="bg-grey   jumbas">
		  <h1>
            <a href="/">
                <img src="img/rocket100.png" alt="Translator">
			    Translator
            </a>
		  </h1>
		  <p>Words translation on a site</p>
		  <p class="spaceras0">&nbsp;</p>
		</div>
		
		
		<div class="row">			
			<!-- Main -->
			 <div class="col-sm-9">
				<?php include 'mvcphp/views/'.$content_view; ?>	
				<p class="spaceras0">&nbsp;</p>
			</div>

			
			<!-- Sidebar -->
			<div class="col-sm-3">			  			  	  
				<div id="lang_module" class="sidebar-module">
					<h4>Languages (Языки)</h4>
					<ol id="langPlace" class="list-unstyled">
					  [languages list]
					  <img src="img/rolling-color.svg">
					</ol>

					<!--<button id="change_lang_button" class="btn   btn-default   btn-lg" onclick="db_lang_read('read');">Cancel</button>-->
					<button id="change_lang_button" class="btn   btn-default   btn-lg" onclick="db_lang_read('change');">Change</button>
					<button id="accept_lang_button" class="btn   btn-default   btn-lg   display_none" onclick="db_lang_update();">Accept</button>
				</div>
 
				<div id="word_module" class="sidebar-module">
					<h4>Words (Слова)</h4>
					<ol id="wordPlace" class="list-unstyled">
					  [words list]
					  <img src="img/rolling-color.svg">
					</ol>
					
					<button id="change_word_button" class="btn   btn-default   btn-lg" onclick="db_word_read('change');">Change</button>
					<button id="accept_word_button" class="btn   btn-default   btn-lg   display_none" onclick="db_word_update('change');">Accept</button>
				
					<button id="newword_button" class="btn   btn-default   btn-lg" onclick="db_word_read('addnew');">Add</button>
					<button id="accept_newword_button" class="btn   btn-default   btn-lg   display_none" onclick="db_word_update('addnew');">Accept</button>
				</div>			  
			</div>					
		</div>




		<footer class="container-fluid bg-grey">
		  <p class="developed">Development <a href="http://cogitas.ru" title="Visit us" target="_blank">cogitas.ru</a></p>

  
		  <a href="#myPage" title="To Top">
			<span class="glyphicon glyphicon-chevron-up"></span>
		  </a>


          <i id="hid_temp_request" class="display_none"></i>
		</footer>

		<?php
			//Test cookie show.
/*
			if($_COOKIE)
				{echo "<pre>";	print_r($_COOKIE);	echo "</pre>";	}   
			else
				echo "COOKIE is not set";
*/
		?>
	</div>
	</div>
</body>
</html>