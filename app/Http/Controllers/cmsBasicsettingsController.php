<?php

namespace App\Http\Controllers;

use App\Models\sitesettings;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Nette\Utils\FileInfo;
use PDO;

class cmsBasicsettingsController extends Controller
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
        //
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
        return view('cms.site-settings');
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



        if($request->hasFile("logo")){
            $file =  $request->file('logo');
            $name = $file->getClientOriginalName();

            $filename =  "images/" . $name;
            $file->move("images/" , $filename );


            $about_file =  $request->file('about_image');
            $about_file_name = $about_file->getClientOriginalName();

            $filenameabout =  "images/" . $about_file_name;
            $about_file->move("images/" , $filenameabout );


            sitesettings::where('id' , $id)->update([
                "logo"  => $filename ,
                "title" => $request->title,
                "detail" => $request->detail,
                "about_image" => $filenameabout,
                "detail2" => $request->detail2,
                "metatag" => $request->metatag,
                "facebook" => $request->facebook,
                "linkedin" => $request->linkedin,
                "twitter" => $request->twitter,
                "email" => $request->email,
                "number" => $request->number,
                "address" => $request->address,
                "map_link" => $request->map_link
             ]);

         }

         return back()->with('message'  , 'Data Saved Succesfully');
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
