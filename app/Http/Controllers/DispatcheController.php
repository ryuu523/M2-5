<?php

namespace App\Http\Controllers;

use App\Models\Dispatche;

use App\Models\Event;
use App\Models\Worker;
use Illuminate\Http\Request;

class DispatcheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dispatches = Dispatche::with("worker", "event")->get();
        return view("dispatches.index", compact("dispatches"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $workers = Worker::all();
        $events = Event::all();
        return view("dispatches.create", compact("workers", "events"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "event" => "required",
            "workers" => "required",
        ]);
        foreach ($request->workers as $worker) {

            $dispatche = Dispatche::where("worker_id", $worker)->where("event_id", $request->event);
            if (!$dispatche->exists()) {

                Dispatche::create([
                    "event_id" => $request->event,
                    "worker_id" => $worker,
                    "memo" => $request->memo ? $request->memo : "",
                ]);
            }
        }
        return redirect()->route("dispatche.index")->with("message", "派遣情報が登録されました");

    }

    /**
     * Display the specified resource.
     */
    public function show(dispatche $dispatche)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dispatche $dispatche)
    
    {
        $workers = Worker::all();
        $events = Event::all();
        return view("dispatches.edit", compact("dispatche","workers","events"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, dispatche $dispatche)
    {
        $request->validate([
            "event" => "required",
            "worker" => "required",
        ]);
        $dispatche->update([
            "event_id" => $request->event,
            "worker_id" => $request->worker,
            "memo" => $request->memo ? $request->memo : "",
        ]);
        return redirect()->route("dispatche.index")->with("message", "派遣情報が更新されました");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dispatche $dispatche)
    {
        $dispatche->delete();
        return redirect()->route("dispatche.index")->with("message", "削除しました");
    }
}
