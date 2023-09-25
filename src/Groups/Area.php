<?php

namespace mehmetbulut\Zoopla\Groups;

use mehmetbulut\Zoopla\SynthesizeTrait;
use mehmetbulut\Zoopla\Values\AreaUnit;

class Area implements \JsonSerializable
{
	use SynthesizeTrait;

	protected $arrSynthesize = array(
		'value' => array('type' => 'number', 'required' => true),
		'units' => array('type' => 'enum','class' => AreaUnit::class, 'required' => true),
	);
}