# Test plugin for the backend calendar controller

This plugin is just a test case for the new Winter's backend Calendar Controller.

## Installation

Clone this plugins under `./plugins/hounddd/calendar` folder of your app.
Then run migrations `php artisan migrate`

## Seeding/refreshing events

To get fresh events data, simply refresh the plugin to generate new events.

```
php artisan plugin:refresh Hounddd.Calendar --force
```

The plugin will generate 10 events between the beginning of the month and the next 60 days, with a random duration.
