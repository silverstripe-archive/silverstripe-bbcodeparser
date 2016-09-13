<?php

use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Dev\SapphireTest;

/**
 * @package framework
 * @subpackage tests
 */
class DBHTMLTextTest extends SapphireTest {
	public function testParse() {
		// Test parse
		/** @var DBHTMLText $obj */
		$obj = DBField::create_field(
			'HTMLText',
			'<p>[b]Some content[/b] [test_shortcode] with shortcode</p>'
		);

		// BBCode strips HTML and applies own formatting
		$this->assertEquals(
			'<strong>Some content</strong> shortcode content with shortcode',
			$obj->Parse('SilverStripe\\View\\Parsers\\BBCodeParser')->forTemplate()
		);
	}
}
