<?php

namespace mehmetbulut\Zoopla;

use DateTime;

trait SynthesizeTrait
{
	protected $_data = [];

	public function __set($property, $value)
	{
		if ($this->hasProperty($property)) {
			$this->setProperty(...func_get_args());
		} else {
			throw new \Exception('The '.$property.' param not found', Response::HTTP_NOT_FOUND);
		}
	}

	public function __isset($property)
	{
		return isset($this->_data[$property]);
	}

	public function __get($property)
	{
		if (isset($this->_data[$property])) {
			return $this->_data[$property];
		}

		if (!$this->hasProperty($property)) {
			throw new \Exception('Invalid param', Response::HTTP_BAD_REQUEST);
		}

		$class = $this->arrSynthesize[$property]['class'];
		return $this->_data[$property] = new $class();
	}

	private function hasProperty($property): bool
	{
		return isset($this->arrSynthesize[$property]);
	}

	private function setProperty($property, $value)
	{
		$param = $this->arrSynthesize[$property];
		$check = null;
		switch ($param['type']) {
			case 'string':
				$check = is_string($value);
				break;

			case 'integer':
				$check = is_int($value);
				break;

			case 'number':
				$check = is_numeric($value);
				break;

			case 'enum':
				$check = $param['class']::isValid($value);
				break;

			case 'array':
				$check = is_array($value);
				break;

			case 'objectArray':
				$check = is_array($value);
				if ($value && is_array($value)) {
					foreach ($value as $item) {
						if (!$param['class']::isValid($item)) {
							$check = false;
							break;
						}
					}
				}
				break;

			case 'objectString':
				$check = false;
				if ($value) {
					if (is_string($value)) {
						$check = true;
					} else if ($value instanceof $param['class']) {
						$check = true;
					}
				}
				break;

			case 'object':
				$check = is_object($value);
				break;

			case 'float':
				$check = is_float($value);
				break;

			case 'email':
				$check = filter_var($value, FILTER_VALIDATE_EMAIL);
				break;

			case 'boolean':
				$check = is_bool($value);
				break;

			case 'date'://Y-m-d
				$format = 'Y-m-d';
				$d = DateTime::createFromFormat($format, $value);
				$check = $d && $d->format($format) === $value;
				break;

			case 'datetime'://Y-m-d H:i:s
				$format = 'Y-m-d H:i:s';
				$d = DateTime::createFromFormat($format, $value);
				$check = $d && $d->format($format) === $value;
				break;
		}

		if (!$check) {
			throw new \Exception('Invalid type '.$property.' '.$param['type'], Response::HTTP_BAD_REQUEST);
		}

		if (!$value) {
			return;
		}

		$this->_data[$property] = $value;
	}

	public function jsonSerialize():array
	{
		return $this->_data;
	}
}