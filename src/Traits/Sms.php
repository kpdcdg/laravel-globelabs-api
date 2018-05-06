<?php

namespace Globe\Traits;

trait Sms
{
	protected function setPassphrase($passphrase)
	{
		$this->passphrase = $passphrase;
	}

	protected function setAppId($app_id)
	{
		$this->app_id = $app_id;
	}

	protected function setAppSecret($app_secret)
	{
		$this->app_secret = $app_secret;
	}

	public function setCredentials($passphrase, $app_id, $app_secret)
	{
		$this->setPassphrase($passphrase);
		$this->setAppId($app_id);
		$this->setAppSecret($app_secret);
	}

	public function getPassphrase()
	{
		if (isset($this->passphrase)) {
			return $this->passphrase;
		} else {
			throw new \Exception("Globe passphrase is not set");
		}
	}

	public function getAppId()
	{
		if (isset($this->app_id)) {
			return $this->app_id;
		} else {
			throw new \Exception("Globe app_id is not set");
		}
	}

	public function getAppSecret()
	{
		if (isset($this->app_secret)) {
			return $this->app_secret;
		} else {
			throw new \Exception("Globe app_secret is not set");
		}
	}

	protected function getCredentials()
	{
		$this->getPassphrase();
		$this->getAppId();
		$this->getAppSecret();
	}

	public function send($number, $message)
	{
		$this->getCredentials();

		$url = '/requests/';
		
		$params = [
			'form_params' => [
				'address' => $number,
				'message' => $message,
				'passphrase' => $this->passphrase,
				'app_id' => $this->app_id,
				'app_secret' => $this->app_secret
			]
		];

		$response = $this->client->post($url, $params);

		return $response->getBody();
	}
}