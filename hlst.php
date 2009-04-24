<?php
/*
Plugin Name: Highlight Search Terms
Plugin URI: http://wordpress.org/extend/plugins/highlight-search-terms
Description: Highlights search terms when referer is a search engine or within wp search results using jQuery. No options to set, just add a CSS rule for class "hilite" to your stylesheet to make the highlights show up any way you want them to. Example: " .post .hilite { background-color:yellow } " Read <a href="http://wordpress.org/extend/plugins/highlight-search-terms/other_notes/">Other Notes</a> for instructions and more examples.
Version: 0.3
Author: RavanH
Author URI: http://4visions.nl/
*/

/*  Copyright 2009  RavanH  (email : ravanhagen@gmail.com)

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

// Call jQ library in header
function hlst_init_jquery() {
	wp_enqueue_script('jquery');
}

// Set style (modify this to fit your need and uncomment the add_action hook at the bottom when you do not want to edit your style.css)
function hlst_style() {
	$bgclr = '#9CD4FF'; // moss:#D3E18A ; lightblue:#9CD4FF; orange:#FFCA61
	echo '
<style type="text/css" media="screen"> .hilite { background:'.$bgclr.'; } </style>
';
}
// Extend jQ 
function hlst_extend() {
	$terms = hlst_get_search_query();
	if(count($terms) == 0)
		return;

	$area = '#content'; // change this to your themes content div ID (starting with #) or class (starting with .)
	$filtered = array();

	foreach($terms as $term){
		$term = attribute_escape(trim(str_replace(array('"','\'','%22'), '', $term)));
		if ( !empty($term) ){
			$filtered[] = '"'.$term.'"';
		}
	}	

	if (count($filtered) > 0) {
?>
<script type="text/javascript">
  var hlst_query  = new Array(<?php echo implode(",",$filtered); ?>);
  jQuery.fn.extend({
    highlight: function(search, insensitive, span_class){
      var regex = new RegExp('(<[^>]*>)|(\\b'+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,'\\$1') +')', insensitive ? 'ig' : 'g');
      return this.html(this.html().replace(regex, function(a, b, c){
        return (a.charAt(0) == '<') ? a : '<span class=\"'+ span_class +'\">' + c + '</span>';
      }));
    }
  });
  jQuery(document).ready(function($){
    if(typeof(hlst_query) != 'undefined'){
      for (i in hlst_query){
        $('<?php echo $area; ?>').highlight(hlst_query[i], 1, 'hilite term-' + i);
      }
    }
  });
</script> 
<?php
	}
} 

// -- HOOKING INTO WP -- //

// Call jQ library in header TODO: make this happen only when there is a search term or if referrer is search engine
add_action('init', 'hlst_init_jquery');

// Set query string as js variable and extend jQ in header
add_action('wp_head', 'hlst_extend');

//Add CSS (uncomment the line below to append CSS styling without editing your style.css)
//add_action('wp_print_styles', 'hlst_style');

?>
