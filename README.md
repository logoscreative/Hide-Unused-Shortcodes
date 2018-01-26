# Hide Unused Shortcodes (WordPress Plugin)

Activate this plugin to hide bare, unregistered shortcodes when displaying your content. That's it.

This can be a helpful tool when migrating sites that will no longer be using older shortcodes still present in the content. 

This plugin *does not* remove the shortcodes themselves from the content.

## How It Works

Pretty simple: filter `the_content` at priority 12 or higher—which is after _registered_ shortcodes have been executed—and remove anything that still looks like a shortcode.
