<?php

Illuminate\Routing\UrlGenerator 
__construct(RouteCollection $routes, Request $request) Both parameter ar from Symfony
full() // Get the full URL for the current request.
current() // Get the current URL for the request.
previous() // Get the URL for the previous request.
to($path, $parameters = array(), $secure = null) // Generate a absolute URL to the given path.
secure($path, $parameters = array()) // Generate a secure, absolute URL to the given path.
asset($path, $secure = null) // Generate a URL to an application asset.
secureAsset($path)
Protected : removeIndex($root) // Remove the index.php file from a path.
getScheme($secure)  // Get the scheme for a raw URL.
route($name, $parameters = array(), $absolute = true) //Get the URL to a named route.
action($action, $parameters = array(), $absolute = true) // Get the URL to a controller action.
isValidUrl($path) // Determine if the given path is a valid URL.
getRequest() // Get the request instance.
setRequest(Request $request) //Set the current request instance.
getGenerator() // Get the Symfony URL gener instan. @return \Symfony\Component\Routing\Generator\UrlGenerator
setGenerator(SymfonyGenerator $generator) // Set the Symfony URL generator instance.

Generating the current URL : 
===============================
return URL::current() ; if http://myapp.dev/current/url?foo=bar  ---> the result strips off the query strings
return URL::full() ;  Returns the full url (with query string -- if present-- ) 
return Redirect::to('second');
return URL::previous();
Generating Framework URLs :
================================
return URL::to('another/route');
return URL::to('another/route', array('foo', 'bar'));
return  URL::to('another/route', array('foo', 'bar'), true);  // for https  url's
URL::secure('another/route') ;
URL::secure('another/route', array('foo', 'bar')) ;
return URL::route('ironman'); Route::get('the/best/avenger', array('as' => 'ironman', function()
return URL::route('irm', array('best', 'ever')); Route::get('the/{first}/av/{sec}', array('as' => 'irm',function($first,$second)
return URL::action('Stark@tony'); Route::get('i/am/iron/man', 'Stark@tony');
URL::action('Stark@tony', array('narcissist')); Route::get('tony/the/{first}/genius', 'Stark@tony');
Asset URLs : 
===================
return URL::asset('img/logo.png');
return URL::asset('img/logo.png', true); secure URL
return URL::secureAsset('img/logo.png');

Using the HTML facade (Illuminate\Html\HtmlBuilder class ) - 
==============================================================
HTML::script($url, $attributes = array()) //  Generate a link to a JavaScript file.
/*
return HTML::script('js/jquery.js' , $attributes = array())  ;
<script src="http://localhost/testproject/public/js/jquery.js"></script>
*/
HTML::style($url, $attributes = array()) //  Generate a link to a CSS file.
/*
return  HTML::style('packages/tournasdim/getgravatar/bootstrap/css/bootstrap.min.css' ,['ena'=> 'one' , 'dio'=>'two']) ;
<link ena="one" dio="two" media="all" type="text/css" rel="stylesheet" href="http://localhost/testingproject/public/packages/tournasdim/getgravatar/bootstrap/css/bootstrap.min.css">
*/
HTML::image($url, $alt = null, $attributes = array()) // Generate an HTML image element.
/*
return HTML::image( 'img/bg.jpeg' , $alt = null, $attributes = array()) ; 
<img src="http://localhost/testproject/public/img/bg.jpeg">
*/
HTML::link($url, $title = null, $attributes = array(), $secure = null) // Generate a HTML link.
/*
return HTML::link('someurl' , $title = null, $attributes = array(), $secure = null) ; 
<a href="http://localhost/testproject/public/index.php/someurl">http://localhost/testproject/public/index.php/someurl</a>
*/
HTML::secureLink($url, $title = null, $attributes = array()) //  Generate a HTTPS HTML link.
HTML::linkAsset($url, $title = null, $attributes = array(), $secure = null) // Generate a HTML link to an asset.
/*
return HTML::linkAsset('css/main.css' , $title = null, $attributes = array(), $secure = null) ; 
<a href="http://localhost/testproject/public/css/main.css">http://localhost/testproject/public/css/main.css</a>
*/
HTML::linkSecureAsset($url, $title = null, $attributes = array()) // Generate a HTTPS HTML link to an asset.
HTML::linkRoute($name, $title = null, $parameters = array(), $attributes = array())//Generate a HTML link to anamed route
HTML::linkAction($action, $title = null, $parameters = array(), $attributes = array())// HTML link to a controller action
HTML::mailto($email, $title = null, $attributes = array()) // Generate a HTML link to an email address.
HTML::email($email) // Obfuscate an e-mail address to prevent spam-bots from sniffing it.
Generation shortcuts : 
=========================
<a href="{{ url('my/route', array('foo', 'bar'), true) }}">MyRte</a> --> <a href="https://demo.dev/my/route/foo/bar">My Rte</a>
<a href="{{ secure_url('my/route', array('foo', 'bar')) }}">My Route</a>
<a href="{{ route('myroute') }}">My Route</a>
<a href="{{ action('MyController@myAction') }}">My Link</a>
<a href="{{ action('MyController@myAction', array('foo'), true) }}">My Link </a>
<img src="{{ asset('img/logo.png') }}" />
<img src="{{ secure_asset('img/logo.png') }}" />



Using helper functions 
========================
link_to($url, $title = null, $attributes = array(), $secure = null) : return app('html')->link($url, $title, $attributes, $secure);
link_to_asset($url, $title = null, $attributes = array(), $secure = null) : return app('html')->linkAsset($url, $title, $attributes, $secure);
link_to_route($name, $title = null, $parameters = array(), $attributes = array()):return app('html')->linkRoute($name, $title, $parameters, $attributes);
link_to_action($action, $title = null, $parameters = array(), $attributes = array()):return app('html')->linkAction($action, $title, $parameters, $attributes);
route($route, $parameters = array(), $absolute = true):return app('url')->route($route, $parameters, $absolute);// Generate a URL to a named route.
secure_asset($path):return asset($path, true); Generate an asset path for the application.
secure_url($path, $parameters = array()) :return url($path, $parameters, true); Generate a HTTPS url for the application.
url($path = null, $parameters = array(), $secure = null) : return app('url')->to($path, $parameters, $secure); //Generate a url for the application.
asset($path, $secure = null) : return app('url')->asset($path, $secure); // Generate an asset path for the application.
base_path($path = '') : return app()->make('path.base').($path ? '/'.$path : $path);// Get the path to the base of the install.
app_path($path = '') return app('path').($path ? '/' . $path : $path) ; 
public_path($path = ''):return app()->make('path.public').($path ? '/'.$path : $path);// Get the path to the public folder.
storage_path($path = '') : return app('path.storage').($path ? '/'.$path : $path);


