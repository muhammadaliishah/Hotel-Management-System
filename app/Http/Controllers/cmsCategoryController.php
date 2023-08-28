<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class cmsCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $data =   categories::all();

        return view('cms.categories' , ['data'  => $data]);
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
        return view('cms.add-category', ['createnewcategory' => $createnewpage]);
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

        ]);

        if(!categories::create([

            'name' => $request->name,
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
   $page =  categories::find($id);


   return view('cms.add-category' , ['updatingdata' => $page]);

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
        categories::where('id' , $id)->update([
        'name' => $request->name,

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

        if(categories::destroy($id)){
        return back()->with('message' , "Sorry Their is an Error    ");

        }
        return back()->with('message' , "Deleted Successfully");

    }
}
