<?php
//Route starts methods of CONTROLLERS, that generate VIEWS of pages
class Route
{
	static function start()
	{
		// 0 Set default controller and action to Main and index.
        //(in http://translator/allwordslist    controller: allwordslist, action: "" i.e. index)
		$controller_name = 'Main';
		$action_name = 'index';
		//$path_index = 4;  //http://localhost/as/learn/mvc/   as=1  learn=2   mvc=3
		$path_index = 1;  //http://translater/   
		
		
		//1 Take model, controller and action names form URL:
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// - take controller's name
		if ( !empty($routes[$path_index]) )
			$controller_name = $routes[$path_index];
		// - take name of action
		if ( !empty($routes[$path_index+1]) )
			$action_name = $routes[$path_index+1];

		// Add prefixes for model, controller and action
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		
		//2 Include current page Model and Controller:
		//- Model class file could be absent
		$model_file = strtolower($model_name).'.php';
		$model_path = "mvcphp/models/".$model_file;
		if(file_exists($model_path))
			include $model_path;

		//- Controller class file.
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "mvcphp/controllers/".$controller_file;
		if(file_exists($controller_path))
			include $controller_path;
		else
			//Route::ErrorPage404();
			echo "<br>File '{$controller_path}' is not exists";


		//3 Create controller and call controller action
		$controller = new $controller_name;
		$action = $action_name;
		
		// call controller action
		if(method_exists($controller, $action))
			$controller->$action();
		else
			//Route::ErrorPage404();
			echo "<br>Method '{$action}' for '{$controller}' is not exists";
	}



	function ErrorPage404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
	}
	function NotFoundRedirect()
	{
		$host = 'http://translator/';
		header('Location:'.$host);
	}			
}
