<?php

namespace Globe;

use Globe\Traits\SendsSms;
use GuzzleHttp\Client;

class GlobeApi
{
	use Sms;

	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}
}
