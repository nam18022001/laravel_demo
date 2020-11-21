<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {

        $LoaiTin = LoaiTin::all();
        return view('admin.LoaiTin.danhsach', ['LoaiTin'=>$LoaiTin]);
    }
    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $LoaiTin = LoaiTin::find($id);

        return view('admin.loaitin.sua', [
            'loaitin' => $LoaiTin,
            'theloai' => $theloai
        ]);
        
    }

    public function postSua(Request $request, $id)
    {
        $LoaiTin = LoaiTin::find($id);
        $this->validate($request, 
            [
                'TheLoai' => 'required',
                'txtCateName' => 'required|unique:LoaiTin,Ten|min:3|max:100',
            ],
            [
                'TheLoai.required' =>'Chọn thể loại đã bạn ới',
                'txtCateName.required' => 'Nhập loại tin đi nè ',
                'txtCateName.unique' => 'Loại Tin đã tồn tại. Vui lòng nhập tên thể loại khác',
                'txtCateName.min' => 'Nhập nhiều hơn 3 chữ bạn ơi ',
                'txtCateName.max' => 'Nhập ít lại khoảng 100 chữ thui bạn'
            ]
    );
        $LoaiTin->idTheLoai = $request->TheLoai;
        $LoaiTin->Ten = $request->txtCateName;
        $LoaiTin->TenKhongDau = changeTitle($request->txtCateName);
        $LoaiTin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        return view('admin.loaitin.them', ['theloai'=>$theloai]);
        
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'TheLoai' => 'required',
                'txtCateName' => 'required|unique:LoaiTin,Ten|min:3|max:100',
            ], 

            [
                'TheLoai.required' =>'Chọn thể loại đã bạn ới',
                'txtCateName.required' => 'Nhập loại tin đi nè ',
                'txtCateName.unique' => 'Loại Tin có rùi ',
                'txtCateName.min' => 'Nhập nhiều hơn 3 chữ bạn ơi ',
                'txtCateName.max' => 'Nhập ít lại khoảng 100 chữ thui bạn'
            ]);

            $LoaiTin = new LoaiTin();
            $LoaiTin->idTheLoai = $request->TheLoai;
            $LoaiTin->Ten = $request->txtCateName;
            $LoaiTin->TenKhongDau = changeTitle($request->txtCateName);
            $LoaiTin->save();

        return redirect('admin/loaitin/them')->with('thongbao', 'Thêm thành công');
        
    }
    
    public function postXoa($id) 
    {
        $LoaiTin = LoaiTin::find($id);
        $LoaiTin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Xóa thành công ' . $LoaiTin->Ten);
    }
}
