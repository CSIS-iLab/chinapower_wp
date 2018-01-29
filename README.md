# chinapower_wp
WordPress theme for [ChinaPower](https://chinapower.csis.org). Developed from the [_s starter theme](http://underscores.me).

## Contributing
1. New features & updates should be created on individual branches. Branch from `master`
2. When ready, submit pull request back into `master`. Rebase the feature branch first.
3. TravisCI will automatically deploy changes on `master` to the staging site
4. After reviewing your work on the staging site, use WPEngine to move from staging to live

## Development
### Composer
This project uses [Composer](https://getcomposer.org/) to manage WordPress plugin dependencies.
To update dependencies, run `composer update`.

**Note**: This project depends on Visual Composer and WPML, which are premium plugins and cannot be installed via composer at this time.

#### Required Plugins
- AddToAny Share
- Disable Comments
- Disable Emojis
- Google Authenticator
- Jetpack
- Search by Aloglia
- TinyMCE Advanced
- WPML
- Visual Composer
- Yoast SEO

## Compass
This project uses [Compass](http://compass-style.org/) to compile the SASS files. To run the compiler:
1. Navigate to `wp-content/themes/chinapower` folder
2. Run `compass watch`
