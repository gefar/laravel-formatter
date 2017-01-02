<?php namespace Gefar\Formatter\Parsers;

class XmlParser extends Parser {

	private $xml;

	/**
	 * Ported from laravel-formatter
	 * https://github.com/SoapBox/laravel-formatter
	 *
	 * @author  Daniel Berry <daniel@danielberry.me>
	 * @license MIT License (see LICENSE.readme included in the bundle)
	 *
	 */
	private function objectify($value) {
		$temp = is_string($value) ?
			simplexml_load_string($value, 'SimpleXMLElement', LIBXML_NOCDATA) :
			$value;

		$result = [];

		foreach ((array) $temp as $key => $value) {
			$result[$key] = (is_array($value) or is_object($value)) ? $this->objectify($value) : $value;
		}

		return $result;
	}

	public function __construct($data) {
		$this->xml = $this->objectify($data);
	}

	public function toArray() {
		return (array) $this->xml;
	}
}
