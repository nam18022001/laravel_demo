<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

use Illuminate\Support\Facades\View;
class PageController extends Controller
{
    //
    function __construct()
    {
        $theloai = TheLoai::all();
        View::share(['theloai' => $theloai]);
    }
    function index()
    {
        return view('page.index');
    }
    function lienhe()
    {
        return view('page.contact');
    }
}
