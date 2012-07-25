jQuery.fn.extend({
  highlight: function(term, insensitive, span_class){
    var regex = new RegExp('(<[^>]*>)|('+ term.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +')', insensitive ? 'ig' : 'g');
    return this.html(this.html().replace(regex, function(a, b, c){
      return (a.charAt(0) == '<') ? a : '<mark class="'+ span_class +'">' + c + '</mark>';
    }));
  }
});
jQuery(document).ready((function($){

  function get_hlst_query() {
    var ref = document.referrer.split('?');
    if (typeof(ref[1]) != 'undefined'){
      var term;
      if (document.referrer.indexOf(document.domain) < 9) {
        term = 's';
      } else if (document.referrer.indexOf('yahoo.com') > -1) {
        term = 'p';
      } else if (document.referrer.indexOf('goodsearch.com') > -1) {
        term = 'keywords';
      } else if (document.referrer.indexOf('mywebsearch.com') > -1) {
        term = 'searchfor';
      } else if (document.referrer.indexOf('baidu.') > -1) {
        term = 'wd';
      } else {
        term = 'q';
      }
      /* document.referrer.indexOf('google.') > -1 || document.referrer.indexOf('bing.com') > -1 || document.referrer.indexOf('aol.') > -1 || document.referrer.indexOf('lycos.') > -1 || document.referrer.indexOf('ask.com') > -1 || document.referrer.indexOf('dogpile.com') > -1 || document.referrer.indexOf('search.com') > -1 || document.referrer.indexOf('webcrawler.com') > -1 || document.referrer.indexOf('info.com') > -1 || document.referrer.indexOf('youdao.com') > -1 */

      var parms = ref[1].split('&');
      for (var i=0; i < parms.length; i++) {
        var pos = parms[i].indexOf('=');
        if (pos > 0) {
            if(term == parms[i].substring(0,pos)) {
              qstr = parms[i].substring(pos+1);
              qstr = qstr.replace(/\%22/g,'"');
              qstr = qstr.replace(/\%20|\+/g," ");
              qstr = qstr.replace(/\%2B/g,"+");
              qarr = qstr.match(/([^\s"]+)|"([^"]*)"/g)
              for (i in qarr){
                hlst_query[i] = qarr[i].replace(/"/g,'');
              }
            }
        }
      }
    }
  }

  if (typeof(hlst_query) != 'undefined') {
    if (hlst_query.length == 0) {
    	get_hlst_query();
    }
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
