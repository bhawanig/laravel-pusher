<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Score;
class ScoreController extends Controller
{
    /**
     * Get the user score.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $data = Score::select([DB::raw("SUM(score) as total_score"), "user_id"])->with('user')->orderBy('total_score','desc')
        ->groupBy('user_id')->get();
        return response()->json(["success" =>true,'leaderboard' => $data]);
    }
}
