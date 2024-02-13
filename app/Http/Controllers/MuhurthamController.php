<?php

namespace App\Http\Controllers;

use App\Models\Muhurthambooking;
use Illuminate\Http\Request;

class MuhurthamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $muhurtham = new Muhurthambooking;
        $muhurtham->full_name = $request->full_name;
        $muhurtham->spouse_name = $request->spouse_name;
        $muhurtham->stars = $request->stars;
        $muhurtham->seeking_muhurtham = $request->seeking_muhurtham;
        $muhurtham->place_of_muhurtham = $request->place_of_muhurtham;
        $muhurtham->contact_details = $request->contact_details;
        $muhurtham->save();

        return redirect()->back()->with('success','Data has been submitted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
