=== Open Graph Protocol Framework ===
Contributors: itthinx
Donate link: http://www.itthinx.com/plugins/open-graph-protocol/
Tags: ogp, open, open graph, open graph protocol, share, sharing, social, social network, twitter, linkedlin, facebook, pinterest, affiliates, meta, meta tag, meta tags, tag, tags
Requires at least: 4.0
Tested up to: 4.6
Stable tag: 1.1.0
License: GPLv3

The Open Graph Protocol enables any web page to become a rich object in a social graph. This plugin renders meta tags within an extension framework.

== Description ==

The [Open Graph protocol](http://ogp.me/) enables any web page to become a rich object in a social graph. For instance, this is used on Facebook to allow any web page to have the same functionality as any other object on Facebook.

This WordPress plugin is aimed at automating the process of adding basic and optional metadata to a site's pages. It is also designed to act as a framework for other plugins or themes and allows to modify and adapt the information provided as needed.

### Usage ###

Install and activate the plugin. It will automatically render the following metadata for posts, pages, etc. :

- `og:title` : The page's title is used, this provides the title for posts, pages, archives etc.
- `og:type` : The type will be `article` in general, `website` for the front page and `blog` for the blog homepage.
- `og:image` : For post types that support featured images, the URL of the featured image is used. Additional metadata `og:image:width` and `og:image:height` is added.
- `og:url` : The URL of the current page.
- `og:site_name` : The name of the site.
- `og:description` : Uses the full excerpt if available, otherwise derives it from the content. For author and archive pages, the type of page and title is used.
- `og:locale` : The current locale.
- `og:locale:alternate` : Indicates additional locales available if [WPML](http://wpml.org/) is installed.

### Filters ###

This section is for developers. If you're not a developer, you can safely skip it.

The plugin provides the following filters:

#### `open_graph_protocol_meta` ####

This filter allows to modify the value of the `content` attribute for a given meta tag.
It is invoked for every supported type of metadata.

Parameters:

- `string` `content` - the current value of the `content` attribute
- `string` `property` - the metadata name, for example `og:title`

Filters must return:

- `string` the desired value of the `content` attribute

#### `open_graph_protocol_meta_tag` ####

This filter allows to modify the actual HTML `<meta>` tag that is rendered in the `<head>` section of pages.

Parameters:

- `string` HTML `<meta>` tag
- `string` `property` - the metadata name, for example `og:title`
- `string` `content` - the value of the `content` attribute

Filters must return:
- `string` the desired output for the HTML `<meta>` tag

#### `open_graph_protocol_metas` ####

This filter allows to add or remove metadata before it is rendered.

Parameters:

- `array` of metadata indexed by metadata name

Filters must return:
- `array` of metadata indexed by metadata name

#### `open_graph_protocol_echo_metas` ####

This filter allows to modify the HTML that renders the plugin's meta tags in the `<head>` section.

Parameters:

- `string` HTML with `<meta>` tags to be rendered

Filters must return:
- `string` HTML with `<meta>` tags to be rendered

### Why this plugin? ###

This plugin was created because we needed an extendable way to render meta tags based on the Open Graph protocol, which would allow to modify the meta tag content rendered or add meta tags when appropriate based on external data.

None of the existing plugins provided a sufficiently flexible way of doing that, among other reasons we needed a solution that would comply with all of these requirements and none of the existing solutions does:

- must be compatible with WordPress 3.5
- must automatically add meta tags for featured images
- must be automated and create sensible meta tag content for each page, we don't want to manually indicate the tag content for every page
- must provide a framework for extension through hooks and filters on every tag, and provide a design that allows other plugins to modify the meta tags in flexible ways
- must not ask to provide your Facebook account details or application ID when there is no need for it
- must not be bloated with features you don't want or need when you simply want Open Graph metatags to be rendered automatically for your pages

### Logo Attribution ###

The logo used for this plugin's icon and banner is the [Open Graph protocol logo](http://commons.wikimedia.org/wiki/File:Open_Graph_protocol_logo.png#/media/File:Open_Graph_protocol_logo.png) by Facebook - [ogp.me](http://ogp.me). Licensed under Public Domain via [Wikimedia Commons](http://commons.wikimedia.org/wiki/).

== Installation ==

See also the [Open Graph Protocol](http://www.itthinx.com/plugin/open-graph-protocol/) plugin pages and [documentation](http://docs.itthinx.com/document/open-graph-protocol-framework/).

1. Use the *Add new* option found in the *Plugins* menu in WordPress and search for *Open Graph Protocol* or upload the plugin zip file or extract the `open-graph-protocol` folder to your site's `/wp-content/plugins/` directory.
2. Enable the plugin from the *Plugins* menu in WordPress.

== Frequently Asked Questions ==

= Where is the documentation? =

The plugin's documentation pages are [here](http://docs.itthinx.com/document/open-graph-protocol-framework/).

= Where can I ask a question? =

You can post a comment on the [plugin page](http://www.itthinx.com/plugins/open-graph-protocol/).

= Where can I find out more about the Open Graph protocol? =

The Open Graph protocol specification is available on [ogp.me](http://ogp.me/).

== Screenshots ==

Not much to see here, the plugin does its job automatically and doesn't need any settings or fancy screenshots. Maybe we'll put some up later ;)

1. Plugin info

== Changelog ==

= 1.1.0 =
* Added support for og:locale.
* Added support for og:locale:alternate with WPML.

= 1.0.10 =
* WordPress 4.4 compatibility tested.
* Fixed an issue with PHP Strict Standards when the deactivation hook is called.

= 1.0.9 =
* Fixed an issue with descriptions so that shortcodes are rendered
  instead of being displayed as such.

= 1.0.8 =
* Fixed static method declaration.
* WordPress 4.1 compatible.

= 1.0.7 =
* Fixed a bug producing PHP Notices when a 404 is returned.

= 1.0.6 =
* WordPress 3.8 compatibility checked.
* Cleaned up whitespace and line endings.

= 1.0.5 =

* Using site description for og:description on home (thanks for the suggestion [Marc](http://www.beyondred.de/)).
* WordPress 3.6 compatibility checked.

= 1.0.4 =

* Using $_SERVER to determine current URL
* Fixed wrong tag used for og:site_name

= 1.0.3 =

* Fixed image metadata.

= 1.0.2 =

* Paths.

= 1.0.1 =

* Fixed path.

= 1.0.0 =

* First public release.

== Upgrade Notice ==

= 1.1.0 =
This release adds support for og:locale (and og:locale:alternate with WPML).
