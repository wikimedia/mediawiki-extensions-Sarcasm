<?php
/**
 * Sarcasm - this extension adds <sarcasm> tags to the wiki
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * require_once('$IP/extensions/sarcasm.php');
 *
 * @ingroup Extensions
 * @author Inquisitor Ehrenstein <inquisitorsasha@sturmkrieg.de>
 * @version 1.0
 * @link https://www.mediawiki.org/wiki/Extension:Sarcasm
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */
 
/**
 * Protect against register_globals vulnerabilities.
 * This line must be present before any global variable is referenced.
 */
if( !defined( 'MEDIAWIKI' ) ) {
        echo( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
        die( -1 );
}
 
// Extension credits that will show up on Special:Version    
$wgExtensionCredits['other'][] = array(
        'path'           => __FILE__,
        'name'           => 'Sarcasm',
        'version'        => '1.0',
        'author'         => '[http://sturmkrieg.de/User:Inquisitor_Ehrenstein Inquisitor Ehrenstein]', 
        'url'            => 'https://www.mediawiki.org/wiki/Extension:Sarcasm',
        'descriptionmsg' => 'This extension adds sarcasm tags to the wiki in order to more clearly show sarcasm in text.',
        'description'    => 'This extension adds sarcasm tags to the wiki.'
);


$wgHooks['ParserFirstCallInit'][] = 'wfSarcasmParserInit';
 
// Hook our callback function into the parser
function wfSarcasmParserInit( Parser $parser ) {
        // When the parser sees the <sample> tag, it executes 
        // the wfSampleRender function (see below)
        $parser->setHook( 'sarcasm', 'wfSarcasmRender' );
        // Always return true from this function. The return value does not denote
        // success or otherwise have meaning - it just must always be true.
        return true;
}

// Code for tags

function wfSarcasmRender( $text, array $args, Parser $parser, PPFrame $frame ) {
        $output = $parser->recursiveTagParse( $text, $frame );
        return '<span class="sarcasm">' . $output . '</span>';
}

?>