# Thematic html5 plugin #
Contributors: middlesister
Tags: thematic, html5
Requires at least: 3.4
Tested up to: 3.5.1
License: GPLv2 or later

Convert the markup of the Thematic theme framework to html5

## Description ##

This plugin will convert the markup of themes based on the Thematic theme framework to use html5 elements. Requires Thematic 1.0 or later. New filters were introduced in Thematic 1.0.2 that optimizes the use of this plugin, but it will work with Thematic 1.0 as well using an output buffer. 

It uses the built in filters of Thematic to change the markup in desired places. If you are using any `childtheme_override_*` functions they will still work, and will override this plugin's loops as well. You will then need to make sure that your override loops uses html5 yourself. 

The markup changes are:

* doctype changed to `<!doctype html>`
* conditional comment classes from [html5boilerplate](http://html5boilerplate.com) are added to the opening `<html>` tag
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
 
The plugin will also add a html5shiv javascript so the new elements will work with older IE browsers. It tries to be detect if any other script has been enqueued, like modernizr, and will only add the script if necessary.

The plugin is intentionally very bare bones, no settings or checkboxes, just activate and go. Ideas, bug reports and general feature requests are welcome at the [github issue tracker](https://github.com/middlesister/thematic-html5/issues).


## Installation ##

1. Upload the plugin folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. That's it! No step three! You can verify that your site is using html5 elements with developer tools in chrome or firebug for firefox or similar.


## Changelog ##

### 0.4.1 ###
* Fixed: Correctly closing of the `</aside>` widget areas. Props: emhr

### 0.4 ###
* Added: conditional comments classes to opening `<html>` tag
* Added: html5shiv javascript for older IE
* Changed: Added a structural .inner div to the widget areas for styling flexibility. Props: scottnix
* New filter: thematichtml5_use_html5shiv, defaults to true
* New filter: thematichtml5_html5shiv_url
* New filter: thematichtml5_use_ieconditionals, defaults to true

### 0.3 ###
* Move plugin class to it's own file

### 0.2 ###
* Plugin rewrite to use OOP

### 0.1 ###
* Initial release

