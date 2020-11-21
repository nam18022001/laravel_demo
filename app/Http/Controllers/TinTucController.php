<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TinTuc;
use App\Models\TheLoai;
use App\Models\LoaiTin;


class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {

        $TinTuc = TinTuc::all();
        return view('admin.tintuc.danhsach', ['tintuc'=>$TinTuc]);
    }
    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $TinTuc = TinTuc::find($id);

        return view('admin.TinTuc.sua', [
            'TinTuc' => $TinTuc,
            'theloai' => $theloai
        ]);
        
    }

    public function postSua(Request $request, $id)
    {
        $TinTuc = TinTuc::find($id);
        $this->validate($request, 
            [
                'TheLoai' => 'required',
                'txtCateName' => 'required|unique:TinTuc,Ten|min:3|max:100',
            ],
            [
                'TheLoai.required' =>'Chọn thể loại đã bạn ới',
                'txtCateName.required' => 'Nhập loại tin đi nè ',
                'txtCateName.unique' => 'Loại Tin đã tồn tại. Vui lòng nhập tên thể loại khác',
                'txtCateName.min' => 'Nhập nhiều hơn 3 chữ bạn ơi ',
                'txtCateName.max' => 'Nhập ít lại khoảng 100 chữ thui bạn'
            ]
    );
        $TinTuc->idTheLoai = $request->TheLoai;
        $TinTuc->Ten = $request->txtCateName;
        $TinTuc->TenKhongDau = changeTitle($request->txtCateName);
        $TinTuc->save();

        return redirect('admin/TinTuc/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        return view('admin.TinTuc.them', ['theloai'=>$theloai]);
        
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'TheLoai' => 'required',
                'txtCateName' => 'required|unique:TinTuc,Ten|min:3|max:100',
            ], 

            [
                'TheLoai.required' =>'Chọn thể loại đã bạn ới',
                'txtCateName.required' => 'Nhập loại tin đi nè ',
                'txtCateName.unique' => 'Loại Tin có rùi ',
                'txtCateName.min' => 'Nhập nhiều hơn 3 chữ bạn ơi ',
                'txtCateName.max' => 'Nhập ít lại khoảng 100 chữ thui bạn'
            ]);

            $TinTuc = new TinTuc();
            $TinTuc->idTheLoai = $request->TheLoai;
            $TinTuc->Ten = $request->txtCateName;
            $TinTuc->TenKhongDau = changeTitle($request->txtCateName);
            $TinTuc->save();

        return redirect('admin/TinTuc/them')->with('thongbao', 'Thêm thành công');
        
    }
    
    public function postXoa($id) 
    {
        $TinTuc = TinTuc::find($id);
        $TinTuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xóa thành công ' . $TinTuc->Ten);
    }
}
