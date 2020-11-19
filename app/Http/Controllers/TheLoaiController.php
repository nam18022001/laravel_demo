<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;
class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {

        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach', ['theloai'=>$theloai]);
    }
    public function getSua($id)
    {

        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua', ['theloai' => $theloai]);
        
    }

    public function postSua(Request $request, $id)
    {
        $theloai = TheLoai::find($id);
        $this->validate($request, 
            [
                'txtCateName' => 'required|unique:Theloai,Ten|min:3|max:100',
            ],
            [
                'txtCateName.required' => 'Nhập thể loại đã bạn ới ',
                'txtCateName.unique' => 'Thể loại đã tồn tại. Vui lòng nhập tên thể loại khác',
                'txtCateName.min' => 'Nhập nhiều hơn 3 chữ bạn ơi ',
                'txtCateName.max' => 'Nhập ít lại khoảng 100 chữ thui bạn'
            ]
    );

        $theloai->Ten = $request->txtCateName;
        $theloai->TenKhongDau = changeTitle($request->txtCateName);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    public function getThem()
    {
        return view('admin.theloai.them');
        
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'txtCateName' => 'required|min:3|max:100',
            ], 

            [
                'txtCateName.required' => 'Nhập thể loại đã bạn ới ',
                'txtCateName.min' => 'Nhập nhiều hơn 3 chữ bạn ơi ',
                'txtCateName.max' => 'Nhập ít lại khoảng 100 chữ thui bạn'
            ]);

            $theloai = new Theloai();
            $theloai->Ten = $request->txtCateName;
            $theloai->TenKhongDau = changeTitle($request->txtCateName);
            $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao', 'Thêm thành công');
        
    }
    
}
