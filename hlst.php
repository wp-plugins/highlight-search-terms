<?php
/*
Plugin Name: Highlight Search Terms
Plugin URI: http://4visions.nl/en/wordpress-plugins/highlight-search-terms
Description: Highlights search terms when referer is a search engine or within wp search results using jQuery. No options to set, just add a CSS rule for class "hilite" to your stylesheet to make the highlights show up any way you want them to. Example: ".hilite { background-color:yellow }" Read <a href="http://wordpress.org/extend/plugins/highlight-search-terms/other_notes/">Other Notes</a> for instructions and more examples. <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=ravanhagen%40gmail%2ecom&amp;item_name=Highlight%20Search%20Terms&amp;item_number=0%2e5&amp;no_shipping=0&amp;tax=0&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8" title="Thank you!">Tip jar</a>.
Version: 0.5
Author: RavanH
Author URI: http://4visions.nl/
*/

/*  Copyright 2010  RavanH  (email : ravanhagen@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, <http://www.gnu.org/licenses/> or
    write to the Free Software Foundation Inc., 59 Temple Place, 
    Suite 330, Boston, MA  02111-1307  USA.

    The GNU General Public License does not permit incorporating this
    program into proprietary programs.
*/


/*
    For Installation instructions, usage, revision history and other info: see readme.txt included in this package
*/

// -- GLOBALS -- //
define('HLST_VERSION','0.5');

// -- FUNCTIONS -- //

// Get search term
function hlst_get_search_query() {
	$referer = urldecode($_SERVER['HTTP_REFERER']);
	$query_array = array();

	if ( preg_match('@^http://(.*)?\.?(google|yahoo|lycos).*@i', $referer) ) {
		$query =  preg_replace('/^.*(&q|query|p)=([^&]+)&?.*$/i','$2', $referer);
	} else {
		$query = get_search_query();
	}
	preg_match_all('/([^\s"\']+)|"([^"]*)"|\'([^\']*)\'/', $query, $query_array);

	return $query_array[0];
}

// Set style (modify this to fit your need and uncomment the add_action hook at the bottom when you do not want to edit your style.css)
function hlst_style() {
	$bgclr = '#9CD4FF'; // moss:#D3E18A ; lightblue:#9CD4FF; orange:#FFCA61
	echo '
<style type="text/css" media="screen"> .hilite { background:'.$bgclr.'; } </style>
';
}

// Get query variables 
function hlst_query() {
	global $hlst_do_extend;

	$area = '.hentry'; // change this to your themes content div ID (starting with #) or class (starting with .)

	$terms = hlst_get_search_query();
	$filtered = array();
	foreach($terms as $term){
		$term = attribute_escape(trim(str_replace(array('"','\'','%22'), '', $term)));
		if ( !empty($term) ){
			$filtered[] = '"'.$term.'"';
		}
	}	
	if (count($filtered) > 0) { 
		$hlst_do_extend = true;
		echo '
<!-- Highlight Search Terms plugin ( RavanH - http://4visions.nl/ ) -->
<script type="text/javascript">
/* <![CDATA[ */
var hlst_query = new Array(' . implode(",",$filtered) . ');
var hlst_area = "' . $area . '";
/* ]]> */
</script>
<!-- end Highlight Search Terms -->
';
	}
} 

// Extend jQ 
function hlst_extend() {
	global $hlst_do_extend;

	if ($hlst_do_extend) {

	wp_register_script('hlst-extend', plugins_url('hlst-extend.js', __FILE__), array('jquery'), HLST_VERSION, true);
 
	wp_print_scripts('hlst-extend');

/*
Took out the \\b off the var regex variable, to match the term any where in the text - not just at a word boundary.
old:
var regex = new RegExp('(<[^>]*>)|(\\b'+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +')', insensitive ? 'ig' : 'g');
new:
var regex = new RegExp('(<[^>]*>)|('+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +')', insensitive ? 'ig' : 'g');
*/
	}
} 

// -- HOOKING INTO WP -- //

// Set query string as js variable in header
add_action('wp_head', 'hlst_query');

// Extend jQ in footer
add_action('wp_footer', 'hlst_extend');

//Add CSS (uncomment the line below to append CSS styling without editing your style.css)
//add_action('wp_print_styles', 'hlst_style');

?>
