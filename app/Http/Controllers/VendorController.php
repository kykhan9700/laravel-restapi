<?php

namespace App\Http\Controllers;
use Lang;
use \Validator;
use App\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* fetching Vendor data*/
        $vendors = Vendor::all();

        /*return object*/
        return response()->json([array(
            'vendor' => $vendors
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Validation rules for fields */
        $rules = [
            'name' => 'bail|required|alpha|max:255',
            'type' => 'bail|required|alpha|max:255',
            'contract' => 'bail|required',
            'expire_date' => 'required',
            'account_details' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
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
            $vendors_data = new Vendor();
            $vendors_data->name = $request->input('name');
            $vendors_data->type = $request->input('type');
            $vendors_data->contract = $request->input('contract');
            $vendors_data->expire_date = $request->input('expire_date');
            $vendors_data->account_details = $request->input('account_details');
            $vendors_data->address = $request->input('address');
            $vendors_data->city = $request->input('city');
            $vendors_data->state = $request->input('state');
            $vendors_data->zip = $request->input('zip');

            /* Saving data into Vendors table */
            $vendors_data->save();
            return json_encode(
                array(
                    'message' => Lang::get('messages.vendor.success.add')

                ), '200');

        } catch (\ErrorException $error) {
            /* Error exception return */
            return json_encode(
                array(
                    'message' => Lang::get('messages.vendor.error.add')
                ), '400');
        }
    }


    public function show($id)
    {
        try {
            $vendor = Vendor::whereid($id)->first();
            return json_encode($vendor);
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
        //
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
        $rules = [
            'name' => 'bail|required|alpha|max:255',
            'type' => 'bail|required|alpha|max:255',
            'contract' => 'bail|required',
            'expire_date' => 'required',
            'account_details' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',

        ];


        /* try catch debug process */
        try {
            /* object and data definition from input */
            $vendors_data = Vendor::find($id);
            $vendors_data->name = $request->input('name');
            $vendors_data->type = $request->input('type');
            $vendors_data->contract = $request->input('contract');
            $vendors_data->expire_date = $request->input('expire_date');
            $vendors_data->account_details = $request->input('account_details');
            $vendors_data->address = $request->input('address');
            $vendors_data->city = $request->input('city');
            $vendors_data->state = $request->input('state');
            $vendors_data->zip = $request->input('zip');

            $validator = Validator::make($request->input(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }
            $vendors_data->save();
            return json_encode(
                array(
                    'message' => Lang::get('messages.vendor.success.update')

                ), '200');

        } catch (\ErrorException $error) {
            /* Error exception return */
            return json_encode(
                array(
                    'message' => Lang::get('messages.vendor.error.update')
                ), '400');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            /* find specific profile and destroy */
            $vendors_data = Vendor::find($id);
            $vendors_data->delete();
            return json_encode(
                array(
                    'message' => Lang::get('messages.vendor.success.delete')
                ), '200');

            /* return the response */
        } catch (\ErrorException $error) {
            /* Error exception return */
            return json_encode(
                array(
                    'message' => Lang::get('messages.vendor.delete')
                ), '400');
        }

        /* return true */
        return json_encode(
            array(
                'message' => "success"
            ), '200');
    }
}
