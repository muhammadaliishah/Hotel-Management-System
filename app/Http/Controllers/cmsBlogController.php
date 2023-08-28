<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;

class cmsBlogController extends Controller
{ /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {



      $data =   blog::all();


       return view('cms.blog' , ['data'  => $data]);
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
       return view('cms.add-blog', ['createnewcategory' => $createnewpage]);
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
           'content' => 'required',
       ]);

       if($request->hasFile("image")){

        $file =  $request->file('image');
        $name = $file->getClientOriginalName();

        $filename =  "images/" . $name;
        $file->move("images/" , $filename );


       if(!blog::create([
           'title' => $request->title,
           'image' => $filename,
           'content' => $request->content,
           'add_by' => 1,
       ]));
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
  $page =  blog::find($id);


  return view('cms.add-blog' , ['updatingdata' => $page]);

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

//   return  $request->all();

    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);


    if($request->has('image')){

  $file =       $request->file('image');
  $name  = $file->getClientOriginalName();


  $path = "images/" . $name;

  $file->move("images/" , $path);






       //
       blog::where('id' , $id)->update([
       'title' => $request->title,
       'image' => $path,
       'content' => $request->content,
       'added_by' => 1,

     ]);
    }
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

       if(blog::destroy($id)){
       return back()->with('message' , "Sorry Their is an Error    ");

       }
       return back()->with('message' , "Deleted Successfully");

   }
}
