<?php

class Sarcasm {

	/**
	 * Hook our callback function into the parser
	 *
	 * @param $parser Parser
	 * @return bool
	 */
	static function wfSarcasmParserInit( Parser $parser ) {
		// When the parser sees the <sarcasm> tag, it executes
		// the wfSarcasmRender function (see below)
		$parser->setHook( 'sarcasm', 'Sarcasm::wfSarcasmRender' );
		// Always return true from this function. The return value does not denote
		// success or otherwise have meaning - it just must always be true.
		return true;
	}

	/**
	 * Code for tags
	 *
	 * @param $text string
	 * @param $args array
	 * @param $parser Parser
	 * @param $frame PPFrame
	 * @return string
	 */
	static function wfSarcasmRender( $text, array $args, Parser $parser, PPFrame $frame ) {
		$output = $parser->recursiveTagParse( $text, $frame );
		return '<span class="sarcasm">' . $output . '</span>';
	}
}
