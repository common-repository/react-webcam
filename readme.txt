=== React Webcam ===

Contributors: nikdo
Tags: webcam, image, ajax
Requires at least: 4.3
Tested up to: 4.7.2
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add auto-refreshing image from your webcam to any page.


== Description ==

A very simple yet effective solution to display the actual image from your webcam on any page. Directory with webcam images is periodically scanned and the most recent image is displayed without the need to refresh whole page.

* Webcam images filenames need to be timestamped (for example `20150923.jpg`).
* Uses [React JavaScript library](http://facebook.github.io/react/) to provide good performance and seamless user experience.


== Installation ==

1. Install and activate the plugin.
2. Configure your webcam to periodically upload timestamped images to `/wp-content/uploads/webcam/` directory.
3. Insert `[reactwebcam]` shortcode to the page.
4. *(optional)* Set refresh interval in seconds: `[reactwebcam refreshinterval=30]` The default value is *60 seconds*.
5. *(optional)* To have multiple webcams create subdirectories in `webcam` directory and specify directory name in the shortcode: `[reactwebcam dir=seaview]`  Only alphanumeric characters are allowed.


== Changelog ==

= 1.0 =
* Intial public version.

= 1.1.0 =
* Configurable refresh interval.

= 1.1.1 =
* Fix bug with disappearing text after shortcode.

= 1.2.0 =
* Add support for multiple webcams.
