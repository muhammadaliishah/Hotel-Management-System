<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\blog;
use App\Models\ContactUs;
use App\Models\event;
use App\Models\gallery;
use App\Models\navbar;
use App\Models\sitesettings;
use App\Models\trip;
use Illuminate\Http\Request;

class HomeController extends Controller
{




    public function index()
    {


        $navbar =  navbar::find(1);
      $sitesettings =   sitesettings::find(1);
    //    return $sitesettings;
      $blogs =     blog::all();
       $gallery =  gallery::all();
        $events =  event::all();
         $trips =  trip::all();
        $banner = Banner::all();



        return view('Front-Pages.index' , [
            'banner' => $banner,
            'trips' => $trips,
            'events' => $events,
            'gallery' => $gallery,
            'blogs' => $blogs ,
            'sitesettings' =>$sitesettings ,
             'navbar' => $navbar
        ]);

    }






}



