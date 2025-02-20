<?php

namespace Hounddd\Calendar;

use Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;

/**
 * Calendar Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'hounddd.calendar::lang.plugin.name',
            'description' => 'hounddd.calendar::lang.plugin.description',
            'author'      => 'Hounddd',
            'icon'        => 'icon-calendar'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {

    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return []; // Remove this line to activate

        return [
            \Hounddd\Calendar\Components\MyComponent::class => 'myComponent',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return []; // Remove this line to activate

        return [
            'hounddd.calendar.some_permission' => [
                'tab' => 'hounddd.calendar::lang.plugin.name',
                'label' => 'hounddd.calendar::lang.permissions.some_permission',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return [
            'calendar' => [
                'label'       => 'hounddd.calendar::lang.plugin.name',
                'url'         => Backend::url('hounddd/calendar/events/calendar'),
                'icon'        => 'icon-calendar',
                'permissions' => ['hounddd.calendar.*'],
                'order'       => 500,
                'sideMenu'=> [
                    'calendar' => [
                        'label'       => 'hounddd.calendar::lang.models.event.calendar',
                        'url'         => Backend::url('hounddd/calendar/events/calendar'),
                        'icon'        => 'icon-calendar',
                        'permissions' => ['hounddd.calendar.*'],
                    ],
                    'events' => [
                        'label'       => 'hounddd.calendar::lang.models.event.label_plural',
                        'url'         => Backend::url('hounddd/calendar/events'),
                        'icon'        => 'icon-list',
                        'permissions' => ['hounddd.calendar.*'],
                    ],
                ],
            ],
        ];
    }
}
