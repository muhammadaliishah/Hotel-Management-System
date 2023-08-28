<?php

namespace App\Http\Controllers;

use App\Models\trip;
use Illuminate\Http\Request;

class cmsTripsController extends Controller
{


    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {



      $data =   trip::all();




       return view('cms.trip' , ['data'  => $data]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       //
       $createnewpage = '';
       return view('cms.add-trip', ['createnewcategory' => $createnewpage]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {


//  return    $request->all();


       $request->validate([
           'title' => 'required',
           'detail' => 'required',
           'location' => 'required',
           'date' => 'required',
           'image' => 'required',

       ]);

       if($request->has('image')){

   $file =       $request->file('image');

   $name  = $file->getClientOriginalName();

   $path = 'images/' . $name;
   $file->move('images' , $path);




       if(!trip::create([
           'title' => $request->title,
           'detail' => $request->detail,
           'location' => $request->location,
           'date' => $request->date,
           'image' => $path ,


       ])){
           return back()->with('message' , "Sorry Their is an error");

       }
    }

       return back()->with('message' , "Added Successfully");
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
  $page =  trip::find($id);


  return view('cms.add-trip' , ['updatingdata' => $page]);

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



$request->validate([
    'title' => 'required',
    'detail' => 'required',
    'location' => 'required',
    'image' => 'required',
    'date' => 'required',

]);

 $file =  $request->file('image');
 $name = $file->getClientOriginalName();
 $path = "images/" . $name;
 $file->move('images' , $path);

       trip::where('id' , $id)->update([
        'title' => $request->title,
        'detail' => $request->detail,
        'location' => $request->location,
        'image' => $path,
        'date' => $request->date,

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

       if(trip::destroy($id)){
       return back()->with('message' , "Sorry Their is an Error    ");

       }
       return back()->with('message' , "Deleted Successfully");

   }
}
