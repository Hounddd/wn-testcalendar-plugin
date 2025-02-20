<?php namespace Hounddd\Calendar\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Events Backend Controller
 */
class Events extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\CalendarController::class,
    ];

    /**
     * @var array Permissions required to view this page.
     */
    protected $requiredPermissions = [
        'hounddd.calendar.events.manage_all',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Hounddd.Calendar', 'calendar', 'events');

        if ($this->action == 'calendar') {
            BackendMenu::setContext('Hounddd.Calendar', 'calendar', 'calendar');
        }
    }
}
