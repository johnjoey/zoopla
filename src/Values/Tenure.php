<?php

namespace mehmetbulut\Zoopla\Values;

class Tenure extends ValuesBase
{
	// TODO: oneOf these objects: https://www.zoopla.co.uk/realtime-documentation/#object_tenure
	const Feudal = 'feudal';
	const freehold = 'freehold';
	const Leasehold = 'leasehold';
	const ShareOfFreehold = 'share_of_freehold';
}