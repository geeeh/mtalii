<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class CompanyController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index');
    }

    /**
     * Open single companies page.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        $events = Event::where('company_id', $id)
            ->get();
        return view('companies.show', ['company'=> $company, 'events' => $events]);
    }

    /**
     * Opens to companies edit page.
     * @param $id
     */
    public function edit($id)
    {
    }

    /**
     * New companies creation page.
     */
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $company = new Company();
        $company->name = $request->input("name");
        $company->location = $request->input("location");
        $company->phone = $request->input("phone");
        $company->email = $request->input("email");
        $company->description = $request->input("description");
        $company->user_id = Auth::user()->id;
        $file = $request->file("proof");
        $filename = uniqid(8).'.'.$file->getClientOriginalExtension();
        $folderName = "uploads/";
        $destinationPath = $this->publicPath($folderName);
        $file->move($destinationPath, $filename);
        $company->proof = $folderName.$filename;
        $company->save();

        return redirect()->to('/companies/'.$company->id);
    }

    public function update($id, Request $request)
    {
        if (empty($request)) {
            redirect()->to('/companies/show/'.$id)->with('message', 'Nothing to update');
        }
        $company = Company::findOrFail($id);
        $company->update($request->input());
        return redirect()->to('/companies/'.$company->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $company = Company::findorFail($id);
        $company->delete();
        return redirect()->to('/dashboard/index');
    }
}
