<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class allWebsLinksController extends Controller
{

  public  function areaOFfocus(){
         return view('areaOFfocus');
    }

     public  function cacoBackground(){
         return view('cacoBackground');
    }



     public  function newshome(){
          $news = News::all();
        return view('newshome', compact('news'));
    }



     public  function ourMission(){
         return view('ourMission');
    }

     public  function ourVision(){
         return view('ourVision');
    }

     public  function  objectives(){
         return view('objectives');
    }


    public function cacoteam(){
        return view('cacoteam');
    }


}
