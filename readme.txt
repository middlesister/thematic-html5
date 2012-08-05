=== Thematic html5 plugin ===
Contributors: middlesister
Tags: thematic, html5
Requires at least: 3.4
Tested up to: 3.4
License: GPLv2 or later

Convert the markup of the Thematic theme framework to html5

== Description ==

This plugin will convert the markup of themes based on the Thematic theme framework to use html5 elements. It uses the built in filters of Thematic to change the markup in desired places. Changes are:

* doctype changed to `<!DOCTYPE html>`
* meta tag "charset" added to `<head>`
* defunkt meta tag http-equiv=Content-type removed (replaced by meta tag above)
* #header uses `<header>` element
* nav_menu and page_menu uses the `<nav>` element
* post pagination links uses the `<nav>` element
* nav-above and nav-below uses the `<nav>` element
* the loops are using the `<article>` element. If you are using `childtheme_override_*` functions they will still work, and will override the plugin's loops as well. You will need to make sure your override loops uses html5 yourself.
* .entry-header uses the `<header>` element
* the post title will always be a `<h1>`
* .entry-utility uses the `<footer>` element
* widget areas are `<aside>` elements, with individual widgets as `<section>` elements. The widget title is `<h1>`
* #footer uses `<footer>` element
 
At the moment, this is all the plugin does. You will need to take care of browser support yourself. New filters were introduced in Thematic 1.0.2 that optimizes the use of this plugin, but it will work with Thematic 1.0 as well using output buffering and string replacing.

Future developments of this plugin might include things like the boilerplate opening html tag or including a html5-shiv. Feature requests, bug reports and general suggestions are welcome at the [github issue tracker](https://github.com/middlesister/thematic-html5/issues).


== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. That's it! No step three! You can verify that your site is using html5 elements with developer tools in chrome or firebug for firefox or similar.


== Changelog ==

= 0.1 =
* Initial release

