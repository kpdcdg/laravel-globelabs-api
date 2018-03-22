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
		$this->sender = env('GLOBE_SENDER');
		$this->access_token = env('GLOBE_ACCESS_TOKEN');
	}

	public function send($number, $message)
	{
		$params = [
			'form_params' => [
				'outboundSMSTextMessage' => $message,
				'address' => $number
			]
		];

		$response = $this->client->post('outbound/' . $this->sender . '/requests?access_token=' . $this->access_token, $params);

		return $response->getBody();
	}
}
