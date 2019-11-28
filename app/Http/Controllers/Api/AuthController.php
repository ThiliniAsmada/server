<?php

namespace App\Http\Controllers\Api;

use App\guides;
use App\tourists;
use App\tours;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\timelines;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'userType' => 'required',
        ]);



        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        if ($request->userType == 'guide') {

            DB::table('guides')->insert(array('id' => $request->id, 'name' => $request->name, 'email' => $request->email, 'password' => $request->password));
        } elseif ($request->userType == 'tourist') {

            DB::table('tourists')->insert(array('id' => $request->id, 'name' => $request->name, 'email' => $request->email, 'password' => $request->password));
        }

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'accesstoken' => $accessToken]);
    }

    public function login(Request $request)
    {

        $loginData = $request->validate([

            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'accesstoken' => $accessToken]);
    }

    public function profileRetrieve($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function profileTripsRetrieve($id)
    {
        $trips = tours::where([

            ['status', '=', 'Completed'],
            ['tourist_id', '=', $id],
        ])->get();
        return response()->json($trips);
    }

    public function profileRetrieveGuide($id)
    {
        $user = guides::find($id);
        return response()->json($user, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->profile_image = $request->input('profile_image');
        $user->save();
        return response()->json($user);
    }

    public function RetrieveGuides()
    {
        $user = guides::all();
        return response()->json($user);
    }

    public function addTimeline(Request $request)
    {
        $timeline = new timelines();

        $timeline->place = $request->input('place');
        $timeline->date = $request->input('date');
        $timeline->image = $request->input('image');
        $timeline->save();
        return response()->json($timeline);
    }

    public function retrieveTimeline()
    {
        $timeline = timelines::all();
        return response()->json($timeline);
    }

    public function makeTour(Request $request)
    {
        $tours = new tours();
        $tours->tourist_id = $request->input('tourist_id');
        $tours->guide_id = $request->input('guide_id');
        $tours->tour_type = $request->input('tour_type');
        $tours->place = $request->input('place');
        $tours->date = $request->input('date');
        $tours->No_of_days = $request->input('No_of_days');
        $tours->status = $request->input('status');

        $tours->save();
        return response()->json($tours);
    }


    public function GuideprofileRetrieve($id)
    {
        $guides = guides::find($id);
        return response()->json($guides);
    }

    public function retrieveRequestedTours()
    {
        $tours = tours::where('status', '=', 'Pending')->get();
        return response()->json($tours);
    }

    public function completeTour(Request $request)
    {
        $tours = new tours();
        $tours->tourist_id = $request->input('tourist_id');
        $tours->guide_id = $request->input('guide_id');
        $tours->tour_type = $request->input('tour_type');
        $tours->place = $request->input('place');
        $tours->date = $request->input('date');
        $tours->No_of_days = $request->input('No_of_days');
        $tours->status = $request->input('status');

        $tours->save();
        return response()->json($tours);
    }

    public function tripStatusUpdate(Request $request, $id)
    {
        $tripStatus = tours::find($id);
        $tripStatus->status = $request->input('status');
        $tripStatus->save();
        return response()->json($tripStatus);
    }

    public function retrieveOngoingTrip()
    {
        $tours = tours::where('status', '=', 'Ongoing')->first();
        return response()->json($tours);
    }

    public function guideRating(Request $request, $id)
    {
        $guideRating = tours::find($id);
        $guideRating->guide_rating = $request->input('guide_rating');
        $guideRating->save();
        return response()->json($guideRating);
    }


    //Guides functions

    public function tripRequests($id)
    {
        $tours = tours::where([
            ['guide_id','=',$id],
            ['status', '=', 'Pending'],
        ])->get();
        return response()->json($tours);
    }

    public function currentTrip($id)
    {
        $tours = tours::where(
            [
                ['guide_id', '=', $id],
                ['status', '=', 'Ongoing'],
            ]
        )->first();
        return response()->json($tours);
    }
}
