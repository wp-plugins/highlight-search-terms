=== Highlight Search Terms ===
Contributors: RavanH
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Highlight%20Search%20Terms&item_number=2%2e6%2e2%2e9&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: search, highlight, jquery, hilite, google, yahoo, lycos, search engine
Requires at least: 2.3
Tested up to: 2.7.1
Stable tag: 0.1

Lightweight search terms highlighter when referer is a search engine or within wp search results using jQuery. 

== Description ==

Highlights search terms using jQuery when referer is a Google, Yahoo or Lycos or within wp search results. This plugin is a lightweight, low impact fusion between <a href="http://weblogtoolscollection.com/archives/2009/04/10/how-to-highlight-search-terms-with-jquery/">How to Highlight Search Terms with jQuery - theme hack by Thaya Kareeson</a> and <a href="http://wordpress.org/extend/plugins/google-highlight/">Search Hilite by Ryan Boren</a>.

= What does it do? =

This low impact plugin uses only two action hooks, **init** and **wp_head** to insert the jQuery library (already is included in your WordPress package) and a custom jQuery extension to your page source code. The jQuery extension that runs after the page has loaded, wraps all found search terms on that page in `<span class="hilite"> ... </span>` tags. 

There are _no_ configuration option and there is _no_ predefined highlight styling. You are completely free to define any style in your themes style.css to get result that fits your theme best.

== Installation ==

I. Use the slick search and install feature on your WP2.7+ Pugins admin section or follow these steps.

1. Download archive and unpack.
2. Upload (and overwrite) the /highlight-search-terms/ folder and its content to the /plugins/ folder. 
3. Activate plugin on the Plug-ins page

II. Add a new rule to your themes styleheet (style.css) to style the highlighted text. 

for example use `#content .hilite { background:#D3E18A; }` to get a moss green background.

Please find more examples under the "Other Notes" tab.

== Frequently Asked Questions ==

**Q: I do not see any highlighting!**

**A:** This plugin has no configuration options page and there is _no_ predefined highlight styling. You have to complete step II of the installation process for any highliting to become visible. Edit your themes Stylesheet (style.css) to contain a rule that will give you exactly the styling you need. See tab "Other Notes" for some examples to get you started.

== Screenshots ==

1. An example image provided by [How to Highlight Search Terms with jQuery](http://weblogtoolscollection.com/archives/2009/04/10/how-to-highlight-search-terms-with-jquery/ "How to Highlight Search Terms with jQuery | Weblog Tools Collection") on which this plugin is largely based.

= Notes =

Many blogs are already top-heavy with all kinds of hungy plugins that require a lot of options to be set and subsequently more database queries. The Highlight Search Terms plugin for WordPress is constructed to be as low impact / low resource demanding as possible. This is done by going without any back-end options page and no extra database entries. Just two action hooks are used: init and wp_head. The rest is done by jQuery javascript extention and your own CSS.

To get you started with your own CSS styling that fits your theme, see the following examples.

= CSS Examples =

Go in your WP admin section to Themes > Edit and find your Stylesheet. Scroll all the way to the bottom and add one of the examples (or your modification of it) on a fresh new line.

To get a moss green background highlighting on every search term on your webpage:

    .hilite { background-color:#D3E18A }

Yellow background highlighting on every search term on your webpage:

    .hilite { background-color:yellow }

Or light blue background with bold fonts but limited to search terms in your main content section and not the header, sidebar or footer (assuming your theme uses a div with id "content" for the content section):

    #content .hilite { background-color:#9CD4FF; font-weight:bold }

Orange background with black font limited to post content only and not comments (for example, assuming your theme wraps your post in a div with class "post"):

    .post .hilite { background-color:#FFCA61; color:#0000 }

= Known issues =

None so far :) Please provide me with a bugreport, suggestion or question if you run into any problems!

= Revision History =

- [2009-04-14] version 0.1: Basic plugin aimed at low impact / low resource demand on your WP installation using client side javascript.

