<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Events\Notify;
class PusherNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
       
        $sendData['userName'] = Auth::user()->name;
        $sendData['description'] = $data['description'];
        $sendData['title'] = $data['title'];
        Notify::dispatch($sendData);
        return redirect("create")->withSuccess('Event send success.');
    }
}
