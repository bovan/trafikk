# Trafikk #

This project is currently online at http://www.trafikk.org

It is not intended for others to install, but feel free to use bits of code or 
look at it for whatever reason.

Due to the data being from Norway only, it will only work if your browser
pretends to be in Norway (or actually is!).

## Uses ##

* CakePHP 2.0
* jQuery 1.7.1
* jQuery Mobile 1.0
* Google Maps 3

## Goals ##

* Allow a user to retrieve the traffic information nearby using location details from his/her mobile device.
* Present this information in a simple, low effort UI.
* Optimize it for mobile usage.
* Make the system somewhat reliable (several updates per hour, iphone/android compatible + firefox)

## TODO ##

The TODO-list is updated as I go...

### Done ###

These are implemented (but not necessarily tried & tested yet)

* <del>Add jQuery Mobile</del>
* <del>Add Google Maps</del>
* <del>Add normalized CSS</del>
* <del>Get a working mobile map thingy</del>
* <del>Detect current location</del>
* <del>Fetch XML from vegvesen.no</del>
* <del>Cache data in Cake (db?)</del>
* <del>Create list-of-markers-near-your-position JSON on request</del>
* <del>Set up a second page to force manual update (for development)</del>
* <del>Set up functionality to draw markers from JSON map</del>
* <del>Add a third page with optional filters</del>
* <del>Make map auto-zoom to bounds </del>(make it possible to disable it in settings)
* <del>Set up cronjob for cache</del>
* <del>Remove second page</del>

### Next ###

These items will be implemented as soon as possible

* Add "Your position" marker
* Add a fourth page with predefined counties in Norway
* Add a "list nearby messages by distance" page
* Add an Info page explaining wtf is going on
* Need a fallback solution if user doesn't allow location sharing

### And Then ###

Then at the end we can add some low priority items

* Add manual refresh icon (but only show a message, w/possibly a timer if an update isn't available yet) (ok bad idea! but come up with something from the realm of usability!)
* Try to gzip static content or use CDN (possibly a combination with libs on CDN)
* UI feedback : User not in Norway
* UI feedback : Waiting for location, possible timeout
* UI feedback : No messages found, show goto counties button.
* Strip CSS from jquery.mobile if possible
* Allow using localStorage instead of sessionStorage in settings
* Enable browser caching of js/css files (partially done, completing later in the development process)

## License ##

  Copyright (C) 2011 by Børge Antonsen

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  THE SOFTWARE.
  
  
