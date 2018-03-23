<?php

namespace Globe;

use GuzzleHttp\Client;

class GlobeApi {
	public $sender;
	public $access_token;

	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->sender = config('globe.sender');
		$this->access_token = config('globe.access_token');
	}

	public function send($number, $message)
	{
		$params = [
			'form_params' => [
				'senderAddress' => $this->sender,
				'message' => $message,
				'address' => $number
			]
		];

		$response = $this->client->post('outbound/' . $this->sender . '/requests?access_token=' . $this->access_token, $params);

		return $response->getBody();
	}
}
