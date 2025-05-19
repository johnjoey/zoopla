<?php

namespace mehmetbulut\Zoopla\Groups;

use mehmetbulut\Zoopla\SynthesizeTrait;

class GroundRent implements \JsonSerializable
{
	use SynthesizeTrait;

	protected $arrSynthesize = array(
		'amount' => array('type' => 'number', 'required' => true),
		'review_period' => array('type' => 'number', 'required' => false),
		'date_of_next_review' => array('type' => 'date', 'required' => false)
	);

	public function __construct(float $amount, int $review_period = null, string $date_of_next_review = null)
	{
		$this->amount = $amount;

		if (!empty($review_period)) {
			$this->review_period = $review_period;
		}

		if (!empty($date_of_next_review)) {
			$this->date_of_next_review = $date_of_next_review;
		}
	}
}