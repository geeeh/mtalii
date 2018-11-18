<?php

namespace App\Http\Controllers;

use App\Bucketlist;
use App\UserBucketList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BucketListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Bucketlist::all();
        $userCategories = Auth::user()->bucketLists()->get()->toArray();
        $categoriesAvailable = $this->_check_diff_multi($categories, $userCategories);
        return view('bucketlist/index', compact('categories', 'categoriesAvailable'));
    }

    /**
     * Opens up a new edit page.
     */
    public function edit()
    {
    }

    /**
     * Opens up a new create page.
     */
    public function create()
    {
    }

    /**
     * Inserts a new instance of user choice.
     * @param Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        $choices = $request->input('choice');
        foreach ($choices as $choice) {
            $item = [
                'user_id' => Auth::user()->getAuthIdentifier(),
                'bucketlist_id' => (int)$choice
            ];
            UserBucketList::create($item);
        }

        return redirect( action('BucketlistController@index'));
    }

    /**
     * Gets all different values between the two arrays.
     * @param $array1
     * @param $array2
     * @return mixed
     */
    private function _check_diff_multi($array1, $array2)
    {
        foreach ($array1 as $key => $value) {
            unset($value['pivot']);
            if (in_array($value, $array2)) {
                unset($array1[$key]);
            }
        }
        return $array1;
    }
}
