<?php

namespace Core\Models\Events;

trait CanPublish
{
    /**
     * Indicates if the model can be published.
     *
     * @var boolean
     */
    public $publishes = true;

    /**
     * The name of the "published at" column.
     *
     * @var string
     */
    public static $publishedAt = 'published_at';

    /**
     * The name of the "drafted at" column.
     *
     * @var string
     */
    public static $draftedAt = 'drafted_at';

    /**
     * Update the publishing date to the current
     * timestamp and fire an event.
     *
     * @return boolean
     */
    public function publish()
    {
        if (! $this->canPublish()) {
            return false;
        }

        $this->{self::$publishedAt} = $this->freshTimestamp();

        $this->save();

        $this->fireModelEvent('published', $halt = false);

        return true;
    }

    /**
     * Update the publishing date to null and fire an event.
     *
     * @return boolean
     */
    public function unpublish()
    {
        if (! $this->canPublish()) {
            return false;
        }

        $this->{self::$publishedAt} = null;

        $this->save();

        $this->fireModelEvent('unpublished', $halt = false);

        return true;
    }

    /**
     * Update the drafted date to the current
     * timestamp and fire an event.
     *
     * @return boolean
     */
    public function draft()
    {
        if (! $this->canPublish()) {
            return false;
        }

        $this->{self::$draftedAt} = $this->freshTimestamp();
        $this->{self::$publishedAt} = null;

        $this->save();

        $this->fireModelEvent('drafted', $halt = false);

        return true;
    }

    /**
     * Determine if the model uses timestamps.
     *
     * @return boolean
     */
    public function canPublish()
    {
        return $this->publishes;
    }
}
