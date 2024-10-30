===  mcjh button shortcode ===
Contributors: MarcusHartmann
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=AWUVYPCNHCC2E
Tags: shortcode button, button shortcode, cta button, buttons, cta, shortcode, cta buttons, shortcode buttons, call to action buttons, call to action button, call-to-action buttons, call-to-action button, button plugin, buttons plugin, create buttons, create button, simple button, simple buttons, shortcode generator,
Requires at least: 3.0.1
Tested up to: 5.0.3
Stable tag: trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create nice Buttons with one simple Shortcode, suitable for beginners and pros

== Description ==
Create nice call-to-action Buttons (cta buttons) in 12 predefined colors or whole hexadecimalcode, using own labelling and individual target-URLs. A special settings-page offers an easy-to-use shortcode-generator with preview feature.

* Define custom button text
* Set a custom text color
* Define custom link
* Define a custom link title
* Define, if target should be opened in a new window/tab or the current one
* Use 12 predefined colors or custom hexadecimal color code
* Define a javascript onclick action
* Use Placeholders for page-id, button-id, target-url, text and current page as arguments in javascript functions
* Define inline button behavior
* Add custom css
* Activate/deactivate rounded corners
* Make clicks trackable
* Usable in Widgets, Content and theme-parts
* Easy to use Shortcode Generator in backend with color picker

**QuickDocs Shortcode**

* `text`: defines the text of the button
* `link`: the link your button points to, must start with "http://" to work properly
* `color`: the color of your button
* `title`: the mouse over title
* `onclick`: an onclick action to be executed before switching to the given link
* `target`: defines the target window of the link 
* `style`: defines the intext behavior for the button (float, block etc)
* `rounded`: defines, if button corners are rounded, or not
* `tcolor`: defines the text color by hexdec code
* `css`: custom css for buttons

**QuickDocs Javascript Placeholders**

These placeholders only work in the "onlick" attribute and can be used as button-specific arguments in javacript functions.

They generally would be used like this: `onclick="your_awesome_js_function({buttonid},{link},{pageurl})"`;

* `{link}` will be replaced by the button-link
* `{pageid}` will be replaced by the page id that contains this button
* `{pageurl}` will be replaced by the page url that contains this button
* `{text}` will be replaced by the button text
* `{buttonid}` will be replaced by the button id

*Important: Don't use quotes in combination with the placeholders, since they are rendered with quotes automatically!*

**Example shortcode**
`[createButton text="my text" link="http://google.de" color="gold" title="my awesome button" onclick="alert({url})" target="_blank" style="blockleft" rounded="false" tcolor="#123" css="a{min-height:300px;}" ]`

== Installation ==
1. Upload folder `mcjh-buttons` to the `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. Ready. Now create your first button with [createButton]! See more Information in the Settings-Page 

== Frequently Asked Questions ==

**Will there be more shapes available?**
Updates for more different shapes and styles are not excluded. But not promised, too.

**Is this plugin free with its full functionallity?**
Yes, it is. And for sure it will allways be.

**How can I track button-clicks?**
You can track button-clicks by using services like GoogleAnalytics and its Event Tracker. The docus of GoogleEventTracker with very good examples can be found under https://developers.google.com/analytics/devguides/collection/analyticsjs/events

** How can I use this plugin in a theme part outside the loop?**
You can use the shortcode by calling the function `echo do_shortcode("[createButton]")`;

== Screenshots ==
1. A screenshot of the old documentation-page in the admin-dashboard. Still available, but deprecated
2. The new backend with the simple generator interface and button preview

== Changelog ==

= 1.6.4 =
* restrucutred plugin folder structure
* reworked software architecture

= 1.6.3 =
* moved generator page from options to menu
* added color picker to custom background color field
* added color picker to text color field
* userroles that can edit posts can now use the shortcode generator

= 1.6.2 =
* fixed second admin notification bug in backend

= 1.6.1 =
* fixed admin notification bug in backend

= 1.6 =
* reworked id generating algorithm of buttons
* new attribute "style" to add predefined button behavior
* new attribute "css" to add custom css
* new attribute "borderradius" to set rounded corners
* new attribute "tcolor" to set custom text-color
* added placeholders for button-id, current page address, current page id, target url and text. They can be used as arguments in javascript functions within the "onclick"-attribute
* updated shortcode generator

= 1.5.5 =
* the shortcode-attribute "enabletracking" has been disabled due to url parsing problems. Tracking can still be managed by using tracking services like GoogleEventTracker
* new attribute "target" can be used to define if a link should open a new tab, window or stay in the current window/tab
* plugin backend documentation was replaced by a shortcode generator

= 1.5.4 =
* removed auto-p-actions to prevent compatibility issues with other plugins

= 1.5.3 =
* new attribute "onclick" to add a onclick javascript action: [createButton onclick=""]
* changed generator of html ids, each button-id will now be absolutelly unique 

= 1.5.2 =
* reworked predefined colors
	* changed "lightgrey" to grey and "grey" to darkgrey
	* added predefined color "gold"
	* improved predefined colors
	* reduced load of images by introducing combination of background-image and background-color
* improved error-handling on predefined colors
* userdefined hexadecimal colors can now be given with or without "#"
* improved userdefined button colors with algorithm to calculate suitable border colors
* new attribute "title" to add a custom title to the buttons. Default value is the button text
* reduced execution time of searching and matching predefined colors
* updated Plugin URI
* several little Bugfixes

= 1.5.1 =
* bugfixes

= 1.5 =
* fixed wrong behaviour on floating elements, added block behavior to button
* changed fix width to min-width of buttons
* fixed wrong admin css script enqueueing
* added tracking-values to urls
	* Tracking can be enabled by adding 'enableTracking="true"' to the shortcode

= 1.1 =
* fixed Bugs and completed german language .mo and .po

= 1.0 =
* plugin-Release on 20. February 2015