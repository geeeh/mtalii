<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lava;
use Carbon\Carbon;
Use App\Event;
Use App\Company;
Use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->setupDoughnut();
        $this->setUpAreaChart();
        $this->setupColumn();
        $this->setupBarChart();
        return view('dashboard.index', [
            'allusers'      => $this->getCompanyAndUserCount()['users'],
            'allcompanies'  => $this->getCompanyAndUserCount()['companies'],
            'myevents'      => $this->getUserCompanyAndEventCount()['events'],
            'mycompanies'   => $this->getUserCompanyAndEventCount()['companies']
        ]);
    }


    /**
     * Show the application dashboard.
     *
     * @return void
     */
    public function setupColumn()
    {
        $finances = Lava::DataTable();

        $now = Carbon::now();
        $startDate = Carbon::now()->subYear();

        $finances->addDateColumn('month')
            ->addNumberColumn('users')
            ->addNumberColumn('Companies');

        for ($date = $startDate; $date->lte(Carbon::now()); $date->addMonth()) {
            $users = User::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year) -> count();
            $companies = Company::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year) -> count();
            $finances->addRow([$date->toDateTimeString(), $users, $companies]);
        }

        Lava::ColumnChart('Finances', $finances, [
            'title' => 'Company Performance',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14,
                'fontFamily'=> ['Kievit_book', 'sansSerif'],
            ]
        ]);

    }

    private function setupDoughnut()
    {

        $eventsCount = Lava::DataTable();

        $luxuryEvents = Event::where('package', 'luxury')
            ->count();
        $mixedEvents = Event::where('package', 'mixed')
            ->count();
        $budgetEvents= Event::where('package', 'budget')
            ->count();
        $eventsCount->addStringColumn('Events per package')
            ->addNumberColumn('Percent')
            ->addRow(['Luxury', $luxuryEvents])
            ->addRow(['Mixed', $mixedEvents])
            ->addRow(['Budget', $budgetEvents]);

        Lava::PieChart('IMDB', $eventsCount, [
            'title' => 'Events per package'
        ]);

    }

    /**
     * Sets up the Area chart for each package.
     */
    private function setUpAreaChart()
    {

        $events = Lava::DataTable();
        $startDate = Carbon::now()->subYear();

        $events->addDateColumn('Date')
            ->addNumberColumn('Luxury package')
            ->addNumberColumn('Mixed package')
            ->addNumberColumn('Budget package');

        for ($date = $startDate; $date->lte(Carbon::now()); $date->addMonth()) {
            $luxuryEvents = Event::where('package', 'luxury')
            ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year) -> count();

            $mixedEvents = Event::where('package', 'luxury')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year) -> count();

            $budgetEvents = Event::where('package', 'luxury')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year) -> count();

            $events->addRow([$date->toDateTimeString(),  $luxuryEvents, $mixedEvents, $budgetEvents]);
        }


        Lava::LineChart('Temps', $events, [
            'title' => 'users per package every month'
        ]);
    }

    /**
     * Setup Bar chart data for monthly requests.
     */
    private function setupBarChart()
    {
        $requests = Lava::DataTable();

        $requests->addStringColumn('Monthly requests')
            ->addNumberColumn('Requests')
            ->addRow(['luxury',  rand(1000,5000)])
            ->addRow(['mixed',  rand(1000,5000)])
            ->addRow(['budget',  rand(1000,5000)]);

        Lava::BarChart('Requests', $requests);
    }

    /**
     * Retrieves the number of companies and users registered.
     * @return array
     */
    public function getCompanyAndUserCount()
    {
        return [
            'companies' => Company::all()->count(),
            'users' => User::all()->count()
            ];
    }

    /**
     * Retrieves the number of companies and users registered.
     * @return array
     */
    public function getUserCompanyAndEventCount()
    {
        $allEvents = [];

        $companies = Company::where(
            'user_id', Auth::user()->getAuthIdentifier())
            ->get()
            ->toArray();
        foreach ($companies as $company) {
            $allEvents = array_merge($allEvents, Event::where('company_id', $company['id'])
                ->get()->toArray());
        }
        return [
            'companies' => count($companies),
            'events'    => count($allEvents)
        ];
    }

    /**
     * Delete user account.
     */
    public function deleteAccount()
    {
        User::destroy(Auth::user()->id);
        return redirect()->to('/dashboard/index');
    }

}
