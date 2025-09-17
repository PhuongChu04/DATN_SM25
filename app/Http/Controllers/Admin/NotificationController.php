<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class NotificationController extends Controller
{
    public function read($id)
    {
        $user = Sentinel::getUser();
        $n = $user->notifications()->findOrFail($id);
        $n->markAsRead();

        return response()->json(['status' => 'ok']);
    }
}
