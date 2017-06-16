<?php

namespace LaravelEnso\Notifications\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    public function getCount()
    {
        return request()->user()->unreadNotifications->count();
    }

    public function getList(int $offset, int $paginate)
    {
        return request()->user()->notifications()
            ->skip($offset)
            ->take($paginate)
            ->get();
    }

    public function markAsRead(DatabaseNotification $notification)
    {
        return $notification->markAsRead();
    }

    public function markAllAsRead()
    {
        request()->user()->unreadNotifications->markAsRead();
    }

    public function clearAll()
    {
        request()->user()->notifications()->delete();
    }
}
