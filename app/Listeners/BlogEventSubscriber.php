<?php

namespace App\Listeners;

use App\Notifications\FacebookBlogPublished;

/**
 * Class BlogEventSubscriber
 *
 * @package App\Listeners
 */
class BlogEventSubscriber
{

    /**
     * Handle blog creating events.
     *
     * @param $blog
     */
    public function onCreated($blog)
    {
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'eloquent.created: App\Models\Blog',
            'App\Listeners\BlogEventSubscriber@onCreated'
        );
    }
}