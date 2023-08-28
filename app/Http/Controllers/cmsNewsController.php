<?php

namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Http\Request;

class cmsNewsController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {


      $data =   news::all();



       return view('cms.news' , ['data'  => $data]);
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
       return view('cms.add-news', ['createnewcategory' => $createnewpage]);
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
           'image' => 'required',
           'content' => 'required',
           'date' => 'required',

       ]);

       if(!news::create([
           'title' => $request->title,
           'image' => $request->image,
           'content' => $request->content,
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
  $page =  news::find($id);


  return view('cms.add-news' , ['updatingdata' => $page]);

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

//   return   $request->all();

      $request->validate([
           'title' => 'required',
        //    'image' => 'required',
           'content' => 'required',
           'date' => 'required',

       ]);


    news::where('id' , $id)->update([
        'title' => $request->title,
        'image' => 'image updated',
        'content' => $request->content,
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

       if(news::destroy($id)){
       return back()->with('message' , "Sorry Their is an Error    ");

       }
       return back()->with('message' , "Deleted Successfully");

   }
}
