<?php

namespace App\Http\Controllers;

use Lang;

use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* fetching profile data*/
        $profiles = Profile::all();
        $dob_greetings = (Profile::dob_check()==true? Lang::get('Happy Birthday!!!'):false);
        /*return object*/
        return response()->json([array(
            'profile' => $profiles,
            'dob_greetings' => $dob_greetings
        )]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /** a newly created resource in profile table
     *
     * @param  $request - passing profile request input fields
     * @return Data saved into profile table successfully
     * TODO: @mosrur please look at the method line : lineNumber for this logic implementation
     */
    public function store(Request $request)
    {
        /*Validation rules for fields */
        $rules = [
            'firstname' => 'bail|required|alpha|max:255',
            'lastname' => 'bail|required|alpha|max:255',
            'email' => 'bail|required|unique:profiles,email',
            'gender' => 'required',
            'merital_status' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'bail|required|numeric',
        ];

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => $validator->errors()
                ]);
        }

        /* try catch debug process */
        try {


            /* object and data definition from input */
            $profile_data = new Profile();
            $profile_data->firstname = $request->input('firstname');
            $profile_data->lastname = $request->input('lastname');
            $profile_data->email = $request->input('email');
            $profile_data->gender = $request->input('gender');
            $profile_data->merital_status = $request->input('merital_status');
            $profile_data->dob = $request->input('dob');
            $profile_data->address = $request->input('address');
            $profile_data->city = $request->input('city');
            $profile_data->state = $request->input('state');
            $profile_data->zip = $request->input('zip');
            $profile_data->phone = $request->input('phone');


            /* Saving data into Profile table */
            $profile_data->save();
            return json_encode(
                array(
                    'message' => Lang::get('messages.profile.success.add')

                ), '200');

        } catch (\ErrorException $error) {
            /* Error exception return */
            return json_encode(
                array(
                    'message' => Lang::get('messages.profile.error.add')
                ), '400');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return display the profile of selected id
     */
    public function show($id)
    {
        try {
            $profile = Profile::whereid($id)->first();
            return json_encode($profile);
            return json_encode(
                array(
                    'message' => "success"
                ), '200');
        } catch (\ErrorException $error) {
            /* Error exception return */
            return json_encode(
                array(
                    'message' => $error
                ), '400');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {
            /*Validation rules for fields */
            $rules = [
                'firstname' => 'bail|required|alpha|max:255',
                'lastname' => 'bail|required|alpha|max:255',
                'email' => 'required',
                'gender' => 'required',
                'merital_status' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'phone' => 'bail|required|numeric',
            ];

            /*find the specific profile */
            $profile_data = Profile::find($id);
            $profile_data->firstname = $request->input('firstname');
            $profile_data->lastname = $request->input('lastname');
            $profile_data->email = $request->input('email');
            $profile_data->gender = $request->input('gender');
            $profile_data->merital_status = $request->input('merital_status');
            $profile_data->dob = $request->input('dob');
            $profile_data->address = $request->input('address');
            $profile_data->city = $request->input('city');
            $profile_data->state = $request->input('state');
            $profile_data->zip = $request->input('zip');
            $profile_data->phone = $request->input('phone');

            $validator = Validator::make($request->input(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }
            $profile_data->save();
            return json_encode(
                array(
                    'message' => Lang::get('messages.profile.success.update')

                ), '200');

        } catch (\ErrorException $error) {
            /* Error exception return */
            return json_encode(
                array(
                    'message' => Lang::get('messages.profile.error.update')
                ), '400');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return delete record corresponding to that id
     */

    public function destroy($id)
    {
        /* try catch debug process */
        try {
            /* find specific profile and destroy */
            $profile = Profile::find($id);
            $profile->delete();
            return json_encode(
                array(
                    'message' => Lang::get('messages.profile.success.delete')
                ), '200');

            /* return the response */
        } catch (\ErrorException $error) {
            /* Error exception return */
            return json_encode(
                array(
                    'message' => Lang::get('messages.profile.error.delete')
                ), '400');
        }

        /* return true */
        return json_encode(
            array(
                'message' => "success"
            ), '200');
    }

    public function save (  Request $request ) {
        $model = new Model;
        $model->id = $request->input('id');
        $model->vendor_id = $request->input('vendor_id');
        $model->profile_id = $request->input('profile_id');
        $model->visa_status = $request->input('visa_status');
        $model->visa_expiration = $request->input('visa_expiration');
        $model->work_location_preference = $request->input('work_location_preference');
        $model->expected_salary = $request->input('expected_salary');
        $model->references = $request->input('references');
        $model->social_info = $request->input('social_info');
        $model->resume_uri = $request->input('resume_uri');
        $model->save();
    }
}

