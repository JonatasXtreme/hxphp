<?php

namespace HXPHP\System\Services;

use HXPHP\System\Storage as Storage;
use HXPHP\System\Http as Http;
use HXPHP\System\Modules\Messages\Messages;


class Auth
{

	/**
	 * Injeção do Response
	 * @var object
	 */
	public $response;

	/**
	 * Injeção do controle de sessão
	 * @var object
	 */
	public $storage;

	/**
	 * Injeção do módulo de Mensagens
	 * @var object
	 */
	public $messages;

	/**
	 * Método construtor
	 */
	public function __construct()
	{
		//Instância dos objetos injetados
		$this->response = new Http\Response;
		$this->storage  = new Storage\Session;
		$this->messages = new Messages('auth');
		$this->messages->setBlock('alerts');

		return $this;
	}

	/**
	 * Autentica o usuário
	 * @param  integet $user_id  ID do usuário
	 * @param  string $username  Nome de usuário
	 */
	public function login($user_id, $username)
	{
		$this->storage->set('user_id', preg_replace("/[^0-9]+/", "", $user_id));
		$this->storage->set('username', preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username));
		$this->storage->set('login_string', hash('sha512', $username.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));

		return $this->response->redirectTo(URL_REDIRECT_AFTER_LOGIN);
	}

	/**
	 * Método de logout de usuários
	 */
	public function logout()
	{
		$this->storage->clear('user_id');
		$this->storage->clear('username');
		$this->storage->clear('login_string');

		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		session_destroy();

		$this->response->redirectTo(URL_REDIRECT_AFTER_LOGOUT);
	}

	/**
	 * Valida a autenticação e redireciona mediante o estado do usuário
	 * @param  boolean $redirect Parâmetro que define se é uma página pública ou não
	 */
	public function redirectCheck($redirect = false)
	{
		if ($redirect && $this->login_check())
			$this->response->redirectTo(URL_REDIRECT_AFTER_LOGIN);
		elseif (!$this->login_check())
			if (!$redirect)
				$this->logout();
	}

	/**
	 * Verifica se o usuário está logado
	 * @return boolean Status da autenticação
	 */
	public function login_check()
	{
		if ($this->storage->exists('user_id') && $this->storage->exists('username') && $this->storage->exists('login_string'))
			return((hash('sha512', $this->storage->get('username').$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']) == $this->storage->get('login_string')) ? true : false);
	}	

	/**
	 * Retorna a ID do usuário autenticado
	 * @return integer ID do usuário
	 */
	public function getUserId()
	{
		return $this->storage->get('user_id');
	}
}