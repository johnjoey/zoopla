<?php

namespace mehmetbulut\Zoopla\Groups;

use mehmetbulut\Zoopla\SynthesizeTrait;

class Areas implements \JsonSerializable
{
	use SynthesizeTrait;

	protected $arrSynthesize = array(
		'external' => array('type' => 'object', 'class' => MinMaxArea::class, 'required' => true),
		'internal' => array('type' => 'object', 'class' => MinMaxArea::class, 'required' => true)
	);
}