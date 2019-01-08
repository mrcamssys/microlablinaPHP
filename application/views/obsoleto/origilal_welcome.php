<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en-US">
<head>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8" />
<META HTTP-EQUIV="X-UA-Compatible" CONTENT="IE=EmulateIE7" >
	<title>Welcome to CodeIgniter</title>


<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#paraEcuaciones{
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Bienvenido a LINA!</h1>

	<div id="body">
		<p>Plataforma esta en programacion</p>

		<p></p>
		
		<div id="paraEcuaciones"> sea un sistema de la forma $a \neq 0$ donde se define la ecuacion cuadratica de la forma: $ax^2+bx+c=0$ se puede deducir la ecuacion cuadratica: <br>
			\[ \frac{-b\pm\sqrt{b^2-4ac}}{2a} \]

		si se calcula la integral de este sistema podemos decir como muestra la ecuacion:

		\begin{equation}
			\label{ss}
			\int_{0}^{\infty} (ax^2+bx+c)dx
		\end{equation}

		</div>
		<p></p>


		<div id="paraEcuaciones"> 
			Ingreso de ecuaciones mediante texto por htmkl
			<textarea id="carlos" ondblclick="camssys()"></textarea>
			<div id="mostrar">ecuacion</div>
		</div>
		<!--<code></code>-->

		<p>hoja de datos del gestor de configuracion de codigo... <a href="user_guide/">Guia de usuario</a>.</p>
	</div>
</div>


</body>
</html>