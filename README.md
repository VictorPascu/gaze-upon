# GazeUpon
Digital signage through your browser. Allows you to control streaming pages supporting multiple types of content (currently YouTube and Vimeo videos) from a dashboard. The original use case is aimed at displaying consistent data on or across multiple screens.

## How to use

After completing the installation, open a webpage to `localhost` or wherever you're hosting the project root. Default links have been provided for accessing the default feed (currently, the only one that can be used) and the control panel, which will require you to log in.

You can access the stream from multiple browsers and control it from the control panel. Some default preset videos have been provided to exemplify functionality.

## Installation

Requirements:
1. redis -- Windows: https://github.com/MicrosoftArchive/redis/releases | Linux: get the redis-server package. | Make sure Redis is running on port 6379.
2. Node and laravel-echo-server
-- Install node.js on your machine if you don't already have it: https://nodejs.org/en/ | then install laravel-echo-server with `npm install -g laravel-echo-server`

Steps:
1. Configure your .env file. `.env.example` is provided to start you off. Make sure you're using redis as a broadcast and queue driver.
Once done, run `php artisan key:generate` to create an app key.

2. Configure laravel-echo-server.json. An example file is provided that should work out of the box.

3. Install project dependencies using Composer. Run `composer install`.

4. Initialize defaults to get you started. Open a terminal and run `php artisan app:init`. This will also create your admin user,
which by default is `admin@example.com` with the password `password`. 

5. Start up laravel-echo-server by opening a terminal in the project root and running `laravel-echo-server start`.
You should receive a confirmation in your terminal that the server is now running.

6. Open another terminal and run `php artisan queue:work --tries=1`. Without this, real-time events will not be processed.

## Development

You can watch js/css files using: 

`npm run watch-poll`

PHP tests are run using:
 
 `/vendor/bin/phpunit`

PHP code style is PSR2. Checks against it can be run using:

`/vendor/bin/phpcs`

Minor code style problems can be fixed using:

`/vendor/bin/phpcbf` 

## Known bugs

- Transitioning to Vimeo after running YouTube videos can fail. The default video for Vimeo causes this by firing end-of-video events
right after initializing.

## Todo

- More test coverage;
- Support multiple feeds / multiple users;
- Simplify / automate install;
- Find easier way to keep required processes alive;
- Test syncing on 2/4 adjacent monitors by sending a sync event to all channel listeners simultaneously with different image position offsets.

## License

GNU GPLv3 (www.gnu.org/licenses/gpl-3.0.en.html)
