<?php

namespace App\Observers;

use App\Feed;

class FeedObserver
{
    /**
     * Handle the feed "created" event.
     *
     * @param  \App\Feed  $feed
     * @return void
     */
    public function created(Feed $feed)
    {
        //
    }

    /**
     * Handle the feed "updated" event.
     *
     * @param  \App\Feed  $feed
     * @return void
     */
    public function updated(Feed $feed)
    {
        //
    }

    /**
     * Handle the feed "deleted" event.
     *
     * @param  \App\Feed  $feed
     * @return void
     */
    public function deleted(Feed $feed)
    {
        //
    }

    /**
     * Handle the feed "restored" event.
     *
     * @param  \App\Feed  $feed
     * @return void
     */
    public function restored(Feed $feed)
    {
        //
    }

    /**
     * Handle the feed "force deleted" event.
     *
     * @param  \App\Feed  $feed
     * @return void
     */
    public function forceDeleted(Feed $feed)
    {
        //
    }
}
