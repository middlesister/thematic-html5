=== Thematic html5 plugin ===
Contributors: middlesister
Tags: thematic, html5
Requires at least: 3.4
Tested up to: 3.4
License: GPLv2 or later

Convert the markup of the Thematic theme framework to html5

== Description ==

This plugin will convert the markup of themes based on the Thematic theme framework to use html5 elements. Requires Thematic 1.0 or later. New filters were introduced in Thematic 1.0.2 that optimizes the use of this plugin, but it will work with Thematic 1.0 as well using an output buffer. 

It uses the built in filters of Thematic to change the markup in desired places. Changes are:

* doctype changed to `<!doctype html>`
* meta tag "charset" added to `<head>`
* defunkt meta tag http-equiv=Content-type removed (replaced by meta tag above)
* #header uses `<header>` element
* nav_menu and page_menu uses the `<nav>` element
* post pagination links uses the `<nav>` element
* nav-above and nav-below uses the `<nav>` element
* the loops are using the `<article>` element for individual posts. 
* .entry-header uses the `<header>` element
* the post title will always be a `<h1>`
* .entry-utility uses the `<footer>` element
* widget areas are `<aside>` elements, with individual widgets as `<section>` elements. The widget title is `<h1>`
* #footer uses `<footer>` element
 
At the moment, this is all the plugin does. It does not add any javascript so browser support is up to the child theme. Use [modernizr](http://modernizr.com/), [html5-shiv](http://code.google.com/p/html5shiv/) or equivalent. If you are using `childtheme_override_*` functions they will still work, and will override this plugin's loops as well. You will then need to make sure that the override loops uses html5 yourself.

The plugin is intentionally very bare bones, but there is always room for improvement. Ideas, bug reports and general feature requests are welcome at the [github issue tracker](https://github.com/middlesister/thematic-html5/issues).


== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. That's it! No step three! You can verify that your site is using html5 elements with developer tools in chrome or firebug for firefox or similar.


== Changelog ==

= 0.3 =
* Move plugin class to it's own file

= 0.2 =
* Plugin rewrite to use OOP

= 0.1 =
* Initial release

