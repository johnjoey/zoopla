<?php

namespace mehmetbulut\Zoopla\Groups;

use mehmetbulut\Zoopla\SynthesizeTrait;

class External implements \JsonSerializable
{
	use SynthesizeTrait;

	protected $arrSynthesize = array(
		'minimum' => array('type' => 'number', 'required' => true),
		'maximum' => array('type' => 'number', 'required' => true)
	);
}