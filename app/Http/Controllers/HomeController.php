<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event AS Events;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home/index', ['upcomingEvents'=>$this->fetchUpcomingEvents()]);
    }

    /**
     * Head to about page.
     */
    public function about()
    {
        return view('home/about');
    }

    /**
     * Head to events page.
     */
    public function events()
    {
        $allEvents = [];
        $events = $this->fetchUpcomingEvents()->toArray();
        foreach ($events as $event) {
            $description = str_split($event['description'], 255);
            $event['description'] = $description[0]. '...';
            array_push($allEvents, (object)$event);
        }

        return view('home/event', ['events'=>$allEvents]);
    }

    /**
     * Search events by name or location.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchEvents(Request $request)
    {
        $nameKey = $request->input('query');

        $searchedEvents = Event::whereRaw('LOWER(location) LIKE ?', strtolower($nameKey).'%')
            ->orWhereRaw('LOWER(name) LIKE ?', strtolower($nameKey).'%')
            ->orWhereJsonContains('activities', $nameKey)
            ->get();
        return view('home.event', ['events' => $searchedEvents]);
    }

    /**
     * Add a new experience
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addExperience(Request $request)
    {
        $experience = new Experiences();
        $experience->name = $request->input("name");
        $experience->link = $request->input("link");
        $image = $request->file("image");
        $filename = uniqid(8).'.'.$image->getClientOriginalExtension();
        $folderName = "uploads/";
        $destinationPath = $this->publicPath($folderName);
        $image->move($destinationPath, $filename);

        $experience->image = $folderName.$filename;
        $experience->save();
        return redirect('home');
    }

    /**
     * Fetching the next eight upcoming events.
     * @return Collection - upcoming events.
     */
    private function fetchUpcomingEvents()
    {
        $today = Carbon::now();
        $upcomingEvents = Events::where('date', '>', $today)
        ->orderBy('date', 'asc')
        ->limit(8)
        ->get();
        return $upcomingEvents;
    }

    public function sendRequests($event_id, Request $request)
    {
        $name = $request->input('name');
        $email =  $request->input('email');
        $phone =  $request->input('phone');
        $text = "I am Interested in this event: ". $name . "\n phone: ". $phone ."\n Email: ". $email;
        $data[] = $request->input("email");

        $companyEmail = Event::find($event_id)->company()->get(['email'])->toArray()[0]['email'];

        Mail::raw($text, function($message) use ($companyEmail)
        {
            $message->subject('Mtalii event');
            $message->from('no-reply@mtalii.co.ke', 'Mtalii');
            $message->to($companyEmail);
            $message->cc('mtaliigroup@gmail.com');
        });

        Session::put('message', "Request sent!");
        return redirect('home');
    }
}
