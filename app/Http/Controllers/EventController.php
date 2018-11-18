<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Bucketlist;

/**
 * Class EventController
 *
 * @package Controllers
 */
class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only'=> ['new', 'store', 'destroy']]);
    }

    /**
     * Show details of an event given id.
     *
     * @param int $event_id - event id
     *
     * @return view
     */
    public function show(int $event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('home.eventshow', compact('event'));
    }


    public function edit()
    {

    }

    public function create()
    {

    }

    /**
     * Create a new event.
     *
     * @param int     $company_id - companies id
     * @param Request $request    - request payload
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($company_id, Request $request)
    {
        $event = new Event();
        $activities = json_encode(explode(",", $request->input("activities")));
        $location = $request->input("location");
        $event->name = $request->input("name");
        $event->location = $location;
        $event->cost = $request->input("cost");
        $event->date = $request->input("date");
        $event->period = $request->input("period");
        $event->activities = $activities;
        $event->company_id = $company_id;
        $event->package = $request->input("package");
        $event->description = $request->input("description");
        $image = $request->file('banner');
        $filename = uniqid(8).'.'.$image->getClientOriginalExtension();
        $folderName = "uploads/";
        $destinationPath = $this->publicPath($folderName);
        $image->move($destinationPath, $filename);

        $event->image = $folderName.$filename;
        $event->save();

        $this->_addNewCategories($location, json_decode($activities));

        return redirect()->to('/companies/'. $company_id);
    }

    /**
     * update new event.
     * @param $company_id
     * @param $event_id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($company_id, $event_id, Request $request)
    {
        if (empty($request)) {
            redirect()->to('/companies/show/'.$company_id)->with('message', 'Nothing to update');
        }
        $event = Event::find($event_id);
        $activities = json_encode(explode(",", $request->input("activities")));
        $payload = $request->input();
        unset($payload['activities']);
        $payload['activities'] = $activities;
        $event->update($payload);

        return redirect()->to('/companies/show/'.$company_id)->with('message', 'update successful!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $location   - event location
     * @param array  $activities - event activities
     *
     * @return void
     */
    private function _addNewCategories($location, $activities)
    {
        Bucketlist::firstOrCreate(['name' => $location], ['type' => 'location']);

        foreach ($activities as $activity) {
                Bucketlist::firstOrCreate(['name'=>$activity], ['type'=> 'activity']);
        }

    }

    /**
     * Delete an event and its associations.
     *
     * @param int $company_id - companies id
     * @param $event_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($company_id, $event_id)
    {
        $event = Event::find($event_id);
        $event->delete();
        return redirect()->to('/companies/show/'.$company_id);
    }
}
