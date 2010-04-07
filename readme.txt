=== Highlight Search Terms ===
Contributors: RavanH
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Highlight%20Search%20Terms&item_number=0%2e4&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: search, search term, highlight, hilite, google, yahoo, lycos, jquery, javascript
Requires at least: 2.3
Tested up to: 2.9.2
Stable tag: 0.4

Lightweight search terms highlighter using jQuery to wrap search terms with span tags when referer is a search engine or within wp search results using jQuery. No options to set, just add a CSS rule for class "hilite" to your stylesheet to make the highlights show up any way you want them to.

== Description ==

Highlights search terms using jQuery when referer is a Google, Yahoo or Lycos search engine _or_ within WordPress generated search results. This plugin is a light weight, low resource demanding and very simple fusion between <a href="http://weblogtoolscollection.com/archives/2009/04/10/how-to-highlight-search-terms-with-jquery/">How to Highlight Search Terms with jQuery - theme hack by Thaya Kareeson</a> and <a href="http://wordpress.org/extend/plugins/google-highlight/">Search Hilite by Ryan Boren</a>.

= What does it do? =

This low impact plugin uses only two action hooks, **init** to insert the jQuery library (already included in your WordPress package) and **wp_head** to add a custom jQuery extension to your page source code. The jQuery extension that runs after the page has loaded, finds all search terms on that page inside each div with class `hentry` and wraps them in `<span class="hilite term-N"> ... </span>` tags. Note that N is a number starting with 0 for the first term used in the search phrase increasing 1 for each additional term used. A (part of a) search phrase wrapped in quotes is considered as a single term.

= What do I need to do? =

There are _no_ configuration options and there is _no_ predefined highlight styling. You are completely free to define any CSS styling rules in your themes Stylesheet, style.css, to get a result that fits your theme best. You can find basic instructions and CSS examples under the [Other Notes](http://wordpress.org/extend/plugins/highlight-search-terms/other_notes/) tab.

In most up to date themes (including WP's own Default theme) post and page content is shown inside a div with class `hentry`. This means only search terms found in post and page content are highlighted. Not search terms that accidentaly show in the page header, sidebar or footer. If your current theme does not do this (yet) this plugin will not work for you out of the box. See the last of the [FAQ's](http://wordpress.org/extend/plugins/highlight-search-terms/faq/) for ways to make it work.


== Installation ==

To make it work, you will need to take two steps. (I) A normal installation and activation procedure _and_ (II) editing your Theme Stylesheet to contain your personal highlight styling rules.

**I.** Use the slick search and install feature (Plugins -> Add New) in your WP2.7+ admin section _or_ follow these basic steps.

- Download archive and unpack.
- Upload (and overwrite) the /highlight-search-terms/ folder and its content to the /plugins/ folder. 
- Activate plugin on the Plug-ins page

**II.** Add at least _one_ new rule to your themes styleheet (style.css) to style highlightable text. 

For example use `.hilite { background:#D3E18A; }` to get a moss green background on search terms found in the content section (not header, sidebar or footer; assuming your Theme uses a div with class "hentry").

Please find more examples under the [Other Notes](http://wordpress.org/extend/plugins/highlight-search-terms/other_notes/) tab.

== Frequently Asked Questions ==

**Q: I do not see any highlighting!**

**A:** This plugin has _no_ configuration options page and there is _no_ predefined highlight styling. You have to complete step II of the installation process for any highliting to become visible. Edit your themes Stylesheet (style.css) to contain a rule that will give you exactly the styling that fits your theme.

**Q: I have no idea what to put in my stylesheet. Can you give me some examples?**

**A:** Sure! See tab [Other Notes](http://wordpress.org/extend/plugins/highlight-search-terms/other_notes/) for instructions and some examples to get you started.

**Q: I _STILL_ do not see any highlighting!**

**A:** Due to a problem with jQuery's `$('body')` call in combination with many other scripts (like Google Ads, Analytics, Skype Check and other, even basic, javascript code) in the ever increasingly popular Firefox browser, I have had to limit the script search term wrapping to a particular div instead of the whole document body. I chose div with class "hentry" since that is the most commonly used content layer class in WordPress themes. However, in your particular theme, that might be different... 

Let's suppose your theme's index.php or single.php has no `<div <?php post_class() ?> ... >` but wraps the post/page content in a `<div id="main" class="content"> ... </div>`. You can do two things to solve this:

1. Change your theme and stylesheet so the post/page content div has either `class="hentry"` or `<?php post_class() ?>`. TIP: Take a look at how it is done in the Default theme included in each WordPress release. But this might involve some real timeconsuming tinkering with your stylesheet and several theme template files.

2. Change the source of wp-content/plugins/highlight-search-terms/hlst.php on line 69 so that the string reflects your main content ID or class name. In the above example that can be either `$area = '#main';` or `$area = '.content';` where a prefix '#' is used for ID and '.' for class.

3. Switch to a theme that does abide by the current WordPress conventions :)

As soon as I have found a solution for this issue with FireFox, I will put it in the next release! If anyone has tips for me, please let me know :)    


== Screenshots ==

1. An example image provided by [How to Highlight Search Terms with jQuery](http://weblogtoolscollection.com/archives/2009/04/10/how-to-highlight-search-terms-with-jquery/ "How to Highlight Search Terms with jQuery | Weblog Tools Collection") on which this plugin is largely based.

== Other Notes ==

Many blogs are already top-heavy with all kinds of resource hungry plugins that require a lot of options to be set and subsequently more database queries. The Highlight Search Terms plugin for WordPress is constructed to be as low impact / low resource demanding as possible. This is done by going without any back-end options page and no extra database entries. Just two action hooks are used: init and wp_head. The rest is done by jQuery javascript extention and your own CSS.

To get you started with your own CSS styling that fits your theme, see the following examples.

= CSS Instructions =

Go in your WP admin section to Themes > Edit and find your Stylesheet. Scroll all the way to the bottom and add one of the examples (or your modification of it) on a fresh new line. 

= Basic CSS Examples =

    .hilite { background-color:#D3E18A }

For a moss green background highlighting.

    .hilite { background-color:yellow }

Yellow background highlighting.

    .hilite { background-color:#9CD4FF; font-weight:bold }

A light blue background with bold font.

    .hilite { background-color:#FFCA61; color:#0000 }

Orange background with black font.

For more intricate styling, see the advanced example below. 

= Advanced CSS Example =

If you want to give different terms used in a search phrase a different styling, use the class "term-N" where N is a number starting with 0, increasing 1 with each additional search term, to define your CSS rules. The below example will make every instance of any term used in the query show up in bold text and a yellow background except for any instance of a second, third and fourth term which will have respectively a light green, light blue and orange background.

    .hilite { background-color:yellow; font-weight:bold } /* default */
    .term-1 { background-color:#D3E18A } /* second search term only */
    .term-2 { background-color:#9CD4FF } /* third search term only */
    .term-3 { background-color:#FFCA61 } /* fourth search term only */

Keep in mind that for the _first_ search term the additional class "term-0" is used, not "term-1"! 

= Known issues =

1. If your theme does not wrap the main content section of your pages in a div with class "hentry", this plugin will not work for you out of the box. However, you _can_ make it work. See the last of the [FAQ's](http://wordpress.org/extend/plugins/highlight-search-terms/faq/) for an explanation.

2. [Josh](http://theveganpost.com) pointed out a conflict with the [ShareThis button](http://sharethis.com/wordpress). I have no clue why this happens and have no solution but to resort to an alternative for the ShareThis button _or_ for this highlighter plugin, untill I hear from the ShareThis developers. Sorry. :(

Thank you, [Jason](http://wordpress.org/support/profile/412612) for pointing out a bug for IE7+, fixed in 0.2. 

Please provide me with a bugreport, suggestion or question if you run into any problems!

== Changelog ==

= 0.4 =
Date: 2010-04-07
- fixed Regular Expression to allow parts of words to be highlighted
- search term wrapping limited to .hentry divs

= 0.3 =
Date: 2009-04-16
- Bugfix for Firefox 2+ (forcefully highlights now limited to div#content)

= 0.2 =
Date: 2009-04-15
- Allowing for multiple search term styling + Bugfix for IE7 / IE8

= 0.1 =
Date: 2009-04-14
- Basic plugin aimed at low impact / low resource demand on your WP installation using client side javascript.

