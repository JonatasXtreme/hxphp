<?php
	//Constantes
	$configs = new HXPHP\System\Configs\Config;

	$configs->env->add('development');

	$configs->env->development->menu->setMenus(array(
		'Home/home' => '%siteURL%home',
		'Projetos/briefcase' => '%baseURI%projetos/listar/',
		'Clientes/users' => array(
			'Listar todos/users' => '%baseURI%clientes/show',
			'Tipos de clientes/users' => '%baseURI%clientes/tipos'
		),
		'Usuários/users' => '%baseURI%usuarios/listar/'
	), 'administrator');

	$configs->env->development->menu->setMenus(array(
		'Home/home' => '%siteURL%home',
		'Projetos/briefcase' => '%baseURI%projetos/listar/'
	));

	/*
		//Globais
		$configs->global->models->directory = APP_PATH . 'models' . DS;

		$configs->global->views->directory = APP_PATH . 'views' . DS;
		$configs->global->views->extension = '.phtml';

		$configs->global->controllers->directory = APP_PATH . 'controllers' . DS;
		$configs->global->controllers->notFound = 'Error404Controller';

		$configs->title = 'Titulo customizado';

		//Configurações de Ambiente - Desenvolvimento
		$configs->env->add('development');

		$configs->env->development->baseURI = '/hxphp/';

		$configs->env->development->database->setConnectionData(array(
			'driver' => 'mysql',
			'host' => 'localhost',
			'user' => 'root',
			'password' => '',
			'dbname' => 'hxphp',
			'charset' => 'utf8'
		));

		$configs->env->development->mail->setFrom(array(
			'from' => 'Remetente',
			'from_mail' => 'email@remetente.com.br'
		));

		//Configurações de Ambiente - Produção
		$configs->env->add('production');

		$configs->env->production->baseURI = '/';

		$configs->env->production->database->setConnectionData(array(
			'driver' => 'mysql',
			'host' => 'localhost',
			'user' => 'usuariodobanco',
			'password' => 'senhadobanco',
			'dbname' => 'hxphp',
			'charset' => 'utf8'
		));

		$configs->env->production->mail->setFrom(array(
			'from' => 'Remetente',
			'from_mail' => 'email@remetente.com.br'
		));
	*/
	 

	return $configs;
