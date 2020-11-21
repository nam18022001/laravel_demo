<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;
use App\Models\LoaiTin;

class AjaxController extends Controller
{
    //
    public function getLoaiTin($idTheLoai)
    {   
        # code...
        $loaitin = LoaiTin::where('idTheLoai', $idTheLoai)->get();
        foreach($loaitin as $value){
            echo "<option value='".$value->id."'>".$value->Ten."</option>";
        }
    }
}
