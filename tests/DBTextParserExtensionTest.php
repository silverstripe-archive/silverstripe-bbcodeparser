<?php

use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\Parsers\BBCodeParser;

/**
 * @package bbcodeparser
 * @subpackage tests
 */
class DBHTMLTextTest extends SapphireTest {

    /**
     * @covers {@link BBCodeParser}
     */
	public function testParse() {
		// Test parse
		/** @var DBHTMLText $obj */
		$html = DBField::create_field(
			'HTMLText',
			'<p>[b]Some content[/b] [test_shortcode] with shortcode</p>'
		);

		/** @var BBCodeParser $obj */
		$obj = BBCodeParser::create($html->RAW());

		// BBCode strips HTML and applies own formatting
		$this->assertEquals(
			'<strong>Some content</strong> shortcode content with shortcode',
            $obj->parse()->forTemplate()
		);
	}
}
