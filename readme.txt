=== Highlight Search Terms ===
Contributors: RavanH
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Highlight%20Search%20Terms&item_number=0%2e2&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: search, search term, highlight, hilite, google, yahoo, lycos, jquery, javascript
Requires at least: 2.3
Tested up to: 2.9.2
Stable tag: 0.3

Lightweight search terms highlighter when referer is a search engine or within wp search results using jQuery. 

== Description ==

Highlights search terms using jQuery when referer is a Google, Yahoo or Lycos search engine _or_ within WordPress generated search results. This plugin is a light weight, low resource demanding and very simple fusion between <a href="http://weblogtoolscollection.com/archives/2009/04/10/how-to-highlight-search-terms-with-jquery/">How to Highlight Search Terms with jQuery - theme hack by Thaya Kareeson</a> and <a href="http://wordpress.org/extend/plugins/google-highlight/">Search Hilite by Ryan Boren</a>.

= What does it do? =

This low impact plugin uses only two action hooks, **init** to insert the jQuery library (already included in your WordPress package) and **wp_head** to add a custom jQuery extension to your page source code. The jQuery extension that runs after the page has loaded, wraps all found search terms on that page in `<span class="hilite term-N"> ... </span>` tags, where N is a number starting with 0 for the first term used in the search phrase increasing 1 for each additional term used. A (part of a) search phrase wrapped in quotes is considered as a single term.

= What do I need to do? =

There are _no_ configuration options and there is _no_ predefined highlight styling. You are completely free to define any CSS styling rule in your themes Stylesheet, style.css, to get result that fits your theme best.

You can find basic instructions and CSS examples under the [Other Notes](http://wordpress.org/extend/plugins/highlight-search-terms/other_notes/) tab.

== Installation ==

To make it work, you will need to take two steps. (I) A normal installation and activation procedure _and_ (II) editing your Theme Stylesheet to contain your personal highlight styling rules.

I. Use the slick search and install feature (Plugins -> Add New) in your WP2.7+ admin section or follow these basic steps.

- Download archive and unpack.
- Upload (and overwrite) the /highlight-search-terms/ folder and its content to the /plugins/ folder. 
- Activate plugin on the Plug-ins page

II. Add at least _one_ new rule to your themes styleheet (style.css) to style highlightable text. 

For example use `#content .hilite { background:#D3E18A; }` to get a moss green background on search terms found in the content section (not header, sidebar or footer; assuming your Theme uses a div with ID "content").

Please find more examples under the [Other Notes](http://wordpress.org/extend/plugins/highlight-search-terms/other_notes/) tab.

== Frequently Asked Questions ==

**Q: I do not see any highlighting!**

**A:** This plugin has _no_ configuration options page and there is _no_ predefined highlight styling. You have to complete step II of the installation process for any highliting to become visible. Edit your themes Stylesheet (style.css) to contain a rule that will give you exactly the styling that fits your theme.

**Q: I have no idea what to put in my stylesheet. Can you give me some examples?**

**A:** Sure! See tab [Other Notes](http://wordpress.org/extend/plugins/highlight-search-terms/other_notes/) for instructions and some examples to get you started.

**Q: I _STILL_ do not see any highlighting!**

**A:** Due to a problem with jQuery's `$('body')` call in combination with many other scripts (like Google Ads, Analytics, Skype Check and other, even basic, javascript code) in the ever increasingly popular Firefox browser, I have had to limit the script highlighting to a particular div instead of the whole document body. I chose div with ID "content" since that is the most commonly used content layer ID in WordPress themes. However, in your particular theme, that might be different... 

Let's suppose your theme has no `<div id="content">` but wraps the main content in a `<div id="main" class="content"> ... </div>`. You can do two things to solve this:

1. Change your theme and stylesheet so the main content div has ID "content". But this might involve some real timeconsuming tinkering with your stylesheet and several theme template files.

2. Change the source of wp-content/plugins/highlight-search-terms/hlst.php on line 71 so that the string reflects your main content ID or class name. In the above example that can be either `$area = '#main';` or `$area = '.content';` where a prefix '#' is used for ID and '.' for class. 

As soon as I have found a solution for this issue with FireFox, I will put it in the next release! If anyone has tips for me, please let me know :)    


== Screenshots ==

1. An example image provided by [How to Highlight Search Terms with jQuery](http://weblogtoolscollection.com/archives/2009/04/10/how-to-highlight-search-terms-with-jquery/ "How to Highlight Search Terms with jQuery | Weblog Tools Collection") on which this plugin is largely based.

== Other Notes ==

Many blogs are already top-heavy with all kinds of resource hungry plugins that require a lot of options to be set and subsequently more database queries. The Highlight Search Terms plugin for WordPress is constructed to be as low impact / low resource demanding as possible. This is done by going without any back-end options page and no extra database entries. Just two action hooks are used: init and wp_head. The rest is done by jQuery javascript extention and your own CSS.

To get you started with your own CSS styling that fits your theme, see the following examples.

= Basic CSS Instructions =

Go in your WP admin section to Themes > Edit and find your Stylesheet. Scroll all the way to the bottom and add one of the examples (or your modification of it) on a fresh new line. 

= Basic CSS Examples =

    .hilite { background-color:#D3E18A }

For a moss green background highlighting on every search term on your webpage.

    .hilite { background-color:yellow }

Yellow background highlighting on every search term on your webpage.

These following examples work in the Default theme included in WordPress and should work in many others. However, you might find you need different markup for the first ID or class name, depending on which part of the page you want the highlighting limited to.

    #content .hilite { background-color:#9CD4FF; font-weight:bold }

A light blue background with bold fonts but limited to search terms in your main content section and not the header, sidebar or footer (assuming your theme uses a div with id "content" for the content section).

    .post .hilite { background-color:#FFCA61; color:#0000 }

Orange background with black font limited to post content only and not comments (assuming your theme wraps your post in a div with class "post").

For more intricate styling, see the advanced example below. 

= Advanced CSS Example =

If you want to give different terms used in a search phrase a different styling, use the class "term-N" (where N is a number starting with 0, increasing 1 with each additional search term) to define your CSS rules. The below example will make every term have bold text, the first term will have a yellow background, the second, third and fourth term will have respectively a light green, light blue and orange background and subsequent terms will have a yellow background again.

    .post .hilite { background-color:yellow; font-weight:bold } /* default */
    .post .term-1 { background-color:#D3E18A } /* second search term only */
    .post .term-2 { background-color:#9CD4FF } /* third search term only */
    .post .term-3 { background-color:#FFCA61 } /* fourth search term only */

Keep in mind that for the _first_ search term the class "term-0" is used, not "term-1"! 

= Known issues =

1. If your theme does not wrap the main content section of your pages in a div with ID "content", this plugin will not work for you. However, you can make it work by a simple edit of the plugin file. See the last of the [FAQ's](http://wordpress.org/extend/plugins/highlight-search-terms/faq/) for an explanation.

2. [Josh](http://theveganpost.com) pointed out a conflict with the [ShareThis button](http://sharethis.com/wordpress). I have no clue why this happens and have no solution but to resort to an alternative for the ShareThis button _or_ for this highlighter plugin, untill I hear from the ShareThis developers. Sorry. :(

Thank you, [Jason](http://wordpress.org/support/profile/412612) for pointing out a bug for IE7+, fixed in 0.2. 

Please provide me with a bugreport, suggestion or question if you run into any problems!

== Changelog ==

= 0.4 =
Date: 2010-04-07
- Bugfix for IE8
- fixed Regular Expression to allow parts of words to be higlighted

= 0.3 =
Date: 2009-04-16
- Bugfix for Firefox 2+ (forcefully highlights now limited to div#content)

= 0.2 =
Date: 2009-04-15
- Allowing for multiple search term styling + Bugfix for IE7 / IE8

= 0.1 =
Date: 2009-04-14
- Basic plugin aimed at low impact / low resource demand on your WP installation using client side javascript.

