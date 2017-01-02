<?php namespace Gefar\Formatter\Parsers;

use InvalidArgumentException;
use League\Csv\Reader;
use Gefar\Formatter\ArrayHelpers;

class CsvParser extends Parser {

	private $csv;

	public function __construct($data) {
		if (is_string($data)) {
			$this->csv = Reader::createFromString($data);
		} else {
			throw new InvalidArgumentException(
				'CsvParser only accepts (string) [csv] for $data.'
			);
		}
	}

	public function toArray() {
		$temp = $this->csv->jsonSerialize();

		$headings = $temp[0];
		$result = $headings;

		if (count($temp) > 1) {
			$result = [];
			for ($i = 1; $i < count($temp); ++$i) {
				$row = [];
				for ($j = 0; $j < count($headings); ++$j) {
					$row[$headings[$j]] = $temp[$i][$j];
				}
				$expanded = [];
				foreach ($row as $key => $value) {
					ArrayHelpers::set($expanded, $key, $value);
				}
				$result[] = $expanded;
			}
		}

		return $result;
	}
}
