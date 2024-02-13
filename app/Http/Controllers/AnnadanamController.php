<?php

namespace App\Http\Controllers;

use App\Models\Annadanam;
use Illuminate\Http\Request;

class AnnadanamController extends Controller
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
        $annadanam = new Annadanam();
        $annadanam->occasion = $request->occasion;
        $annadanam->full_name = $request->full_name;
        $annadanam->gotram = $request->gotram;
        $annadanam->star = $request->star;
        $annadanam->residence = $request->residence;
        $annadanam->email = $request->email;
        $annadanam->date = $request->date;
        $annadanam->contact_details = $request->contact_details;
        $annadanam->save();

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
