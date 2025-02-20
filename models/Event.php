<?php

namespace Hounddd\Calendar\Models;

use Winter\Storm\Database\Model;

/**
 * Event Model
 */
class Event extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'hounddd_calendar_events';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->bindEvent('model.form.filterFields', function ($formWidget, $fields, $context) {
            if ($fields->is_allday->value) {
                $formWidget->getFormWidget('start_at')->mode = 'date';
                $formWidget->getFormWidget('end_at')->mode = 'date';
            } else {
                $formWidget->getFormWidget('start_at')->mode = 'datetime';
                $formWidget->getFormWidget('end_at')->mode = 'datetime';
            }
        });
    }

    public function beforeSave()
    {
        if ($this->is_allday) {
            $this->start_at = $this->start_at->setHours(0)->setMinutes(0)->setSeconds(0);
            $this->end_at = $this->end_at->setHours(59)->setMinutes(59)->setSeconds(59);
        }
    }
}
