<?php

namespace Globe;

use Illuminate\Support\Facades\Facade;

class Globe extends Facade {

	public static function getFacadeAccessor()
	{
		return 'globe';
	}
}
