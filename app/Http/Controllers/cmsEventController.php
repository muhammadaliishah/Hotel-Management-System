<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class cmsEventController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {



      $data =   event::all();



       return view('cms.event' , ['data'  => $data]);
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
       return view('cms.add-event', ['createnewcategory' => $createnewpage]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {

       $request->validate([
           'title' => 'required',
           'detail' => 'required',
           'location' => 'required',
           'image' => 'file|required',
           'date' => 'required',
           'time' => 'required',
       ]);

 $file = $request->file('image');
 $filename = $file->getClientOriginalName();

 $path = 'images/' . $filename;

 $file->move('images' , $path);



       if(!event::create([
           'title' => $request->title,
           'detail' => $request->detail,
           'location' => $request->location,
           'image' => $path,
           'date' => $request->date,
       ])){


           return back()->with('message' , "Sorry Their is an error");

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
  $page =  event::find($id);


  return view('cms.add-event' , ['updatingdata' => $page]);

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
        'image' => 'file|required',
        'date' => 'required',
    ]);


    $file  = $request->file('image');
    $filename  = $file->getClientOriginalName();

    $path = 'images/' . $filename;

    $file->move('images' , $path);






       event::where('id' , $id)->update([
           'title' => $request->title,
           'detail' => $request->detail,
           'location' => $request->location,
           'image' =>$path,
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

       if(event::destroy($id)){
       return back()->with('message' , "Sorry Their is an Error    ");

       }
       return back()->with('message' , "Deleted Successfully");

   }
}
