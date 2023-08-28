<?php

namespace App\Http\Controllers;

use App\Models\gallery;
use Illuminate\Http\Request;

class cmsGalleryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {



      $data =   gallery::all();



       return view('cms.gallery' , ['data'  => $data]);
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
       return view('cms.add-gallery', ['createnewcategory' => $createnewpage]);
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
        'name' => 'required',
        'image' => 'required',
    ]);





       if($request->hasFile('image')){




        $file =  $request->file('image');
        $name = $file->getClientOriginalName();




        $filename =  "images/" . $name;
        $file->move("images/" , $filename );



       gallery::create([
           'title' => $request->name,
           'image' => $filename,
           'added_by' => 1,
        ]);


        return back()->with('message' , "Added Successfully");


    }else{
        return "please select an image";
    }




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
  $page =  gallery::find($id);


  return view('cms.add-gallery' , ['updatingdata' => $page]);

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
        'name' => 'required',
        // 'image' => 'required',

    ]);



    gallery::where('id' , $id)->update([
           'title' => $request->name,
           'image' => 'image link',
           'added_by' =>1,


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

       if(gallery::destroy($id)){
       return back()->with('message' , "Sorry Their is an Error    ");

       }
       return back()->with('message' , "Deleted Successfully");

   }
}
