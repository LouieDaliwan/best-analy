<?php

namespace Core\Models\Accessors;

use Carbon\Carbon;

trait CommonAttributes
{
    /**
     * Retrieve the parsed created_at fields.
     *
     * @return string
     */
    public function getCreatedAttribute()
    {
        return $this->parseDate($this->attributes['created_at']);
    }

    /**
     * Retrieve the parsed created_at fields.
     *
     * @return string
     */
    public function getModifiedAttribute()
    {
        return $this->parseDate($this->attributes['updated_at']);
    }

    /**
     * Retrieve the parsed created_at fields.
     *
     * @return string
     */
    public function getJoinedAttribute()
    {
        return $this->created;
    }

    /**
     * Parse the passed date.
     *
     * @param  string $date
     * @return string
     */
    protected function parseDate($date)
    {
        switch (settings('format:date')) {
            case ':human:':
                $date = Carbon::parse($date)->diffForHumans();
                break;

            default:
                $date = date(settings('format:date', 'd-M, Y'), strtotime($date));
                break;
        }

        return $date;
    }
}
