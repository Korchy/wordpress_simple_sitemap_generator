#Simple Sitemap Generator for Wordpress

A WordPress plugin to automatically add entries to the sitemap.xml file.

Plugin functionality
-
When each post is published this plugin automatically adds an entry with its web-address to the main sitemap.xml file.

Entry example:

    <url>
        <loc>https://your-site-url.com/post/hello-world</loc>
    </url>

OpenSource
-
The plugin is OpenSource: you can see the source code on GitHub: https://github.com/Korchy/wordpress_simple_sitemap_generator

Installation
-
Install the plugin as usual.

Create the initial sitemap.xml file in the root of your wordpress directory with the fillowing content:
    <?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://yoursite.com/</loc>
    </url>
    </urlset>

(Optionally) Make an owner of this file for Apache:

    chown www-data:www-data /var/www/your-site.com/sitemap.xml

Activate the plugin.

Now the plugin will work automatically.

Current version
-
1.0.0
