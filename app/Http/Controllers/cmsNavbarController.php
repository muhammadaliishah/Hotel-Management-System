<?php

namespace App\Http\Controllers;

use App\Models\navbar;
use Illuminate\Http\Request;

class cmsNavbarController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {

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
     if(!$request->validate([

        "nav_text1" => 'required',
        "link1" => 'required',

        "nav_text2" => 'required',
        "link2" => 'required',


        "nav_text3" => 'required',
        "link3" => 'required',

        "nav_text4" => 'required',
        "link4" => 'required',

        "nav_text5" => 'required',
        "link5" => 'required'

    ])){
        return back()->with('navbarinputs' ,'ALl Fieds Must Be filled');
    }

    // return $request->all();

    navbar::where('id' , $id)->update([
        "nav_text1"   => request('nav_text1'),
        "link1"   => request('link1') ,
        "nav_text2"   => request('nav_text2') ,
        "link2"   => request('link2') ,
        "nav_text3"   => request('nav_text3') ,
        "link3"   => request('link3') ,
        "nav_text4"   => request('nav_text4') ,
        "link4"   => request('link4') ,
        "nav_text5"   => request('nav_text5'),
        "link5"   => request('link5') ,

     ]);
     return back()->with('message' , "Updated  Successfully");

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {

       if(navbar::destroy($id)){
       return back()->with('message' , "Sorry Their is an Error    ");

       }
       return back()->with('message' , "Deleted Successfully");

   }
}
