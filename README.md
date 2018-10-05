[![Software License][ico-license]](LICENSE.txt)

# Quick Not Found
A concrete5 8.4.0+ add-on to quickly return a response if a file isn't found.
This is especially useful if you pull remote databases to your local environment. In that case missing images may cause extremely slow pages because for each one of them, the 'page not found' page is rendered. This add-on will simply return a 404-response, making it way faster.

## Installation
- Download the zip and extract to 'packages'. Make sure '-master' is removed from the directory name.
- Or via Composer: `composer require a3020/quick_not_found`

## Environment
The middleware is only active on **local** environments. For more information about environment configurations, [check the tutorial](https://documentation.concrete5.org/tutorials/loading-configuration-based-host-and-environment).

## License
MIT

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
