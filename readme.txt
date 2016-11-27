GENIUS
Theme Version: 1.0.4
Author: Michael Van Den Berg 
Author URL: https://michaelvandenberg.com/

--------------------
=== Description ===
--------------------

Genius is a simple portfolio theme powered by Isotope. It has a clean, minimal design; supports a slider for featured posts; and has a filterable portfolio. 


--------------------
=== Copyright ===
--------------------

Genius WordPress Theme, Copyright 2016 Michael Van Den Berg.
Genius is distributed under the terms of the GNU GPL license 3.0 or later.


--------------------
=== Installation ===
--------------------

1. Sign into your WordPress dashboard, go to Appearance > Themes, and click Add New.
2. Click Add New.
3. Click Upload.
4. Click Choose File and select the theme zip file.
5. Click Install Now.
6. Click Add New, then click Upload, then click Choose File.
7. After WordPress installs the theme, click Activate.
8. You've successfully installed your new theme!

-- Front page setup.

This theme uses the featured content module and the portfolio custom content type of the Jetpack plugin
to setup the featured posts sections and the portfolio sections on the front page and the portfolio
page templates. Visit this page: http://jetpack.me/ to read more about Jetpack and how to install it.

After installing and activating the Jetpack plugin follow these steps:

1. Create a new page and select the front page template in Page Attributes section on the right.
2. Add a new post/page or modify an existing one and give this page a 'featured' tag and add a featured image.
3. Repeat step 2 for any additional featured posts.
4. Create a new portfolio item and make sure it has a featured image and a Project Type.
5. Repeat step 4 for any additional portfolio items.

The front page template will show both featured posts and portfolio items. The portfolio template will
only show the portfolio items. Additionally the maximum number of portfolio items to be shown on the
front page can be adjusted in the customizer while the maximum number of portfolio items to be shown
on the portfolio page can be adjusted under Settings > Writing (at the bottom).


--------------------
=== Licenses ===
--------------------

-- Fonts.
*
*  Open Sans / by Steve Matteson
*  URL: https://www.google.com/fonts/specimen/Open+Sans
*  License: Apache License 2.0 / https://www.apache.org/licenses/LICENSE-2.0
*
*  Genericons / by Automattic
*  URL: http://genericons.com/
*  License: GNU GPL License 2.0 / https://www.gnu.org/licenses/gpl-2.0.html
*

-- Images.
*
*  The images on the theme screenshot are based on the pictures of Kamesh Vedula, Veeterzy, Sweet Icecream Photography, Vladimir Kudinov, Denise Chan and Hannes Ri.
*  URL: https://unsplash.com/kvedula
*  URL: https://unsplash.com/veeterzy
*  URL: https://unsplash.com/sweeticecreamphotography
*  URL: https://unsplash.com/madbyte
*  URL: https://unsplash.com/denmychan
*  URL: https://unsplash.com/foto_hari
*  All Licensed under: CC0 / http://creativecommons.org/publicdomain/zero/1.0/
*

-- Other.
*
*  Based on Underscores, Copyright (C) 2012-2016 Automattic, Inc.
*  URL: http://underscores.me/
*  License: GNU GPL License 2.0 [or later] / https://www.gnu.org/licenses/gpl-2.0.html
*
*  Normalize.css, Copyright (C) 2012-2016 Nicolas Gallagher and Jonathan Neal.
*  URL: http://necolas.github.io/normalize.css/
*  License: MIT License / http://opensource.org/licenses/MIT
*
*  Isotope, Copyright (C) 2012-2016 MetaFizzy.
*  URL: http://isotope.metafizzy.co/
*  License: GNU GPL License 3.0 [or later] / https://www.gnu.org/licenses/gpl-3.0.html
*
*  Flickity, Copyright (C) 2012-2016 MetaFizzy.
*  URL: http://flickity.metafizzy.co
*  License: GNU GPL License 3.0 [or later] / https://www.gnu.org/licenses/gpl-3.0.html
*

-- Special thanks.
*
*  To Chip Bennett for his fix on custom loops.
*  See: http://wordpress.stackexchange.com/questions/120407/how-to-fix-pagination-for-custom-loops/120408#120408
*
*  To WebDevStudios for their article on Isotope filtering with Jetpack and WordPress.
*  See: https://webdevstudios.com/2015/01/27/create-a-filterable-portfolio-with-wordpress-and-jetpack/
*

--------------------
=== Changelog ===
--------------------

*
* 1.0.4 / 27.11.2016
* - Fixed jagged animation of Menu Toggle caused by new version of Autoprefixer.
* - For more info on the previous issue see: https://github.com/postcss/autoprefixer/issues/748
* - Added aria-hidden="true" to span.meta-nav in cases where it wasn't already there.
* - Reduced margin-top for .site-title on smaller screens.
* - Focus state added for first level menu items.
* - Published by and the author name in the bio section are combined into a single line.
*
* 1.0.3 / 25.11.2016
* - When changing the theme URI one should not forget the footer.
* - Fixed: "Uncaught TypeError: $container.isotope is not a function".
*
* 1.0.2 / 24.11.2016
* - Fixed accessibility issue with links in the footer.
* - Fixed bottom gutter margin for portfolio items on portfolio pages.
* - Changed theme URI to: https://michaelvandenberg.com/themes/#genius
*
* 1.0.1 / 18.11.2016
* - Removed style I added to check if new sass compiler was working. Oops! :)
* - Removed unused navigation.js file.
*
* 1.0.0 / 17.11.2016
* - Landmark role added for social media menu.
* - Focus state added for submit button.
* - Contrast fixed in comments form and widgets and menus.
* - Changed font-weight of body text to 300.
* - Some additional style improvements.
* - Added some Javascript to improve accessibility.
*
* 0.9.4 / 29.09.2016
* - Removed the sass files from the (WordPress.org) distribution copy.
*
* 0.9.3 / 29.09.2016
* - Fixed missing text-domain on line 212 in functions.php.
*
* 0.9.2 / 29.09.2016
* - Added -webkit-backface-visibility: hidden; to thumbnail img to prevent movement on hover.
* - Made message by Genius_Theme_Plugin_Enhancements dismissable.
* - Replaced support for jetpack_the_site_logo() with Custom Logo.
* - The "Read more" and "Discover more" texts in template-tags.php are now translatable.
* - Made the WordPress link in the footer translatable.
* - The "Search Toggle" text in functions.php has also been made translatable.
* - Added prefix to a function in extras.php on line 49.
* - Improved default (empty) state of part-portfolio.php.
* - Improved default (empty) state of part-featured-posts.php.
* - Added support for custom site logo (and removed support for Jetpack site logo).
* - Removed the sass files from the (WordPress.org) distribution copy.
* - Removed "implode" from genius_fonts_url().
* - Updated the language pot file.
* - Some additional style improvements.
*
* 0.9.1 / 06.06.2016
* - Changed content width in functions.php and added content width for full width pages.
* - Removed the "No Comments" tag for posts without comments on the blog page.
* - Improved genius.js by using single quotes instead of mixed quotes.
* - Added "'capability' => 'edit_theme_options'," to customizer settings.
* - Added original un-minified script of Isotope and Flickity in the js directory.
* - Added genius_fonts_url().
* - New image for screenshot.png.
* - Fixed styling of portfolio pagination.
* - Updated the theme tags with the new theme tags.
* - The contrast has been toned down a bit.
* - Added support for editor styles.
* - Fixed attributes and content output that should have been escaped.
* - Replaced esc_textarea() with wp_kses on line 28 in part-author-bio.php.
* - Fixed multiple translations that needed to be escaped.
* - Removed second link to my website from the footer.
* - And finally some minor style improvements.
*
* 0.9.0 / 19.04.2016
* Initial (early) release.
*
