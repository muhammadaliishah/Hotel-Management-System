<?php

namespace App\Http\Controllers;

use App\Models\pages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $data =   pages::all();

    //    return $data;

        return view('cms.pages' , ['data'  => $data]);
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
        return view('cms.add-page', ['createnewpage' => $createnewpage]);
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
            'category' => 'required',


        ]);
        //
        if(!pages::create([

            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'added_by' => $request->added_by,

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
   $page =  pages::find($id);


   return view('cms.add-page' , ['updatingdata' => $page]);

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


      pages::where('id' , $id)->update([
        'title' => $request->title,
        'content' => $request->content,
        'category' => $request->category,
        'added_by' => 1,
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

        if(pages::destroy($id)){
        return back()->with('message' , "Sorry Their is an Error    ");

        }
        return back()->with('message' , "Deleted Successfully");

    }
}
