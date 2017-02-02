<?php

use SilverStripe\Core\Extension;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\View\Parsers\TextParser;
use SilverStripe\ORM\FieldType\DBField;

class DBTextParserExtension extends Extension {

	/**
	 * Allows a sub-class of TextParser to be rendered.
	 *
	 * @see TextParser for implementation details.
	 * @param string $parser Class name of parser (Must extend {@see TextParser})
	 * @return DBField Parsed value in the appropriate type
	 */
	public function Parse($parser) {
		$reflection = new \ReflectionClass($parser);
		if($reflection->isAbstract() || !$reflection->isSubclassOf(TextParser::class)) {
			throw new InvalidArgumentException("Invalid parser {$parser}, a parser must extend must extend TextParser");
		}

		/** @var TextParser $obj */
		$obj = Injector::inst()->createWithArgs($parser, [$this->forTemplate()]);
		return $obj->parse();
	}

}