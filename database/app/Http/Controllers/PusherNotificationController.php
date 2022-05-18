<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use Pusher\Pusher;
class PusherNotificationController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|min:6',
            'description' => 'required',
        ]);
           
        $data = $request->all();
        $check = Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => Auth::id()
        ]);
        $options = array(
			'cluster' => env('PUSHER_APP_CLUSTER'),
			'encrypted' => true
		);
        $pusher = new Pusher(
			env('PUSHER_APP_KEY'),
			env('PUSHER_APP_SECRET'),
			env('PUSHER_APP_ID'), 
			$options
		);
        $sendData['userName'] = Auth::user()->name;
        $sendData['description'] = $data['description'];
        $sendData['title'] = $data['title'];
        $pusher->trigger('tasks-submit', 'App\\Events\\Notify', $sendData);
        return redirect("create")->withSuccess('Event send success.');
    }
}
