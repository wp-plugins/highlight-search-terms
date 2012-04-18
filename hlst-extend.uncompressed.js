jQuery.fn.extend({
  highlight: function(term, insensitive, span_class){
    var regex = new RegExp('(<[^>]*>)|('+ term.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +')', insensitive ? 'ig' : 'g');
    return this.html(this.html().replace(regex, function(a, b, c){
      return (a.charAt(0) == '<') ? a : '<mark class="'+ span_class +'">' + c + '</mark>';
    }));
  }
});
jQuery(document).ready((function($){
  if(typeof(hlst_query) != 'undefined'){
    var area; var i; var s;
    for (s in hlst_areas){
      area = $(hlst_areas[s]);
      if (area.length != 0){
        for (var l = 0; l<area.length; l++) {
		for (i in hlst_query){
		  area.eq(l).highlight(hlst_query[i], 1, 'hilite term-' + i);
		}
	}
      	break;
      }
    }
  }
  if ('function'==typeof Cufon) Cufon.refresh();
}));
