<?php

use Carbon\CarbonImmutable;
use Hounddd\Calendar\Models\Event;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hounddd_calendar_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->boolean('is_allday')->default(false);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamps();
        });

        $now = CarbonImmutable::now()->startOfMonth();

        // Generate 10 events from now to 60 days
        for ($i=1; $i <= 10; $i++) {
            $start = rand(0, 60);
            $duration = rand(0, 2);
            $allDay = rand(0, 1) == 1;

            if ($allDay) {
                $startHour = 0;
                $endHour = 23;
            } else {
                $startHour = rand(8, 14);
                $endHour = rand($startHour, 23);
                $startHour = $startHour < 10 ? '0' . $startHour : $startHour;
                $endHour = $endHour < 10 ? '0' . $endHour : $endHour;
            }

            $event = [
                'name' => 'Event #' . $i,
                'start_at' => $now->addDays($start)
                    ->setHours($startHour)
                    ->setMinutes(0)
                    ->setSeconds(0)
                    ->format('Y-m-d H:i:s'),
                'end_at' => $now->addDays($start + $duration)
                    ->setHours($endHour)
                    ->setMinutes(0)
                    ->setSeconds(0)
                    ->format('Y-m-d H:i:s'),
                'is_allday' => $allDay,
            ];
            Event::create($event);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hounddd_calendar_events');
    }
};
