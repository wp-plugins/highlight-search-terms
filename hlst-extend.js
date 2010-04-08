  jQuery.fn.extend({
    highlight: function(search, insensitive, span_class){
      var regex = new RegExp('(<[^>]*>)|('+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +')', insensitive ? 'ig' : 'g');
      return this.html(this.html().replace(regex, function(a, b, c){
        return (a.charAt(0) == '<') ? a : '<span class="'+ span_class +'">' + c + '</span>';
      }));
    }
  });
  var $hlst = jQuery.noConflict();
  jQuery(document).ready($hlst(function(){
    if(typeof(hlst_query) != 'undefined'){
      for (i in hlst_query){
        $hlst(hlst_area).highlight(hlst_query[i], 1, 'hilite term-' + i);
      }
    }
  }));

