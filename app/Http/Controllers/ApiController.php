<?php

namespace App\Http\Controllers;

use App\Models\Dispatche;
use App\Models\Event;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_events(Request $request)
    {
        $request->validate([
            "worker_id" => "required",
            "worker_id.required" => "worker_idは必須です",
        ]);
        $event_ids = Dispatche::where("worker_id", $request->worker_id)->pluck("event_id");
        if ($event_ids->isEmpty()) {
            return response()->json("error", 404);
        }
        $query = Event::whereIn("id", $event_ids);
        if (filled($request->title)) {
            $query->where("title", "like", "%" . $request->title . "%");
        }
        if (filled($request->place)) {
            $query->where("place", $request->place);
        }
        if (filled($request->date)) {
            $query->where("date", $request->date);
        }
        $events = $query->get();
        if ($events->isEmpty()) {
            return response()->json("error", 404);
        }
        return response()->json($events, 200);

    }
    public function set_approval(Request $request)
    {
        $request->validate([
            "worker_id" => "required",
            "event_id" => "required",
            "worker_id.required" => "worker_idは必須です",
            "event_id.required" => "event_idは必須です",
        ]);
        $dispatche = Dispatche::where("worker_id", $request->worker_id)->where("event_id", $request->event_id);
        if (!$dispatche->exists()) {
            return response()->json("error", 404);
        }
        $dispatche->update([
            "approval" => true,
        ]);
        return response()->noContent();
    }
}
