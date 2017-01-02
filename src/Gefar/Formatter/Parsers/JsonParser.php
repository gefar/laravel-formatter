<?php namespace Gefar\Formatter\Parsers;

class JsonParser extends Parser {

	private $json;

	public function __construct($data) {
		$this->json = json_decode(trim($data));
	}

	public function toArray() {
		return (array) $this->json;
	}

}
