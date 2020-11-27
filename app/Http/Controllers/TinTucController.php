<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\TinTuc;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\Comment;


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
        $loaitin = LoaiTin::all();
        $TinTuc = TinTuc::find($id);

        return view('admin.tintuc.sua', [
            'tintuc' => $TinTuc,
            'theloai' => $theloai,
            'loaitin' => $loaitin
        ]);
        
    }

    public function postSua(Request $request, $id)
    {
        $TinTuc = TinTuc::find($id);
        $this->validate($request,
            [
                'TheLoai' => 'required',
                'LoaiTin' => 'required',

                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3|max:100',
                'TomTat' => 'required|min:3',
                'NoiDung' => 'required|min:3',

            ], 

            [
                'TheLoai.required' =>'Chọn thể loại đã bạn ới',
                'LoaiTin.required' =>'Chọn loại tin đi nè',

                'TieuDe.required' => 'Nhập Tiêu đề đi nè ',
                'TieuDe.unique' => 'Tiêu đề có rùi ',
                'TieuDe.min' => 'Nhập Tiêu đề nhiều hơn 3 chữ bạn ơi ',
                'TieuDe.max' => 'Nhập Tiêu đề ít lại khoảng 100 chữ thui bạn',

                'TomTat.required' => 'Nhập Tóm tắt đi nè ',
                'TomTat.min' => 'Nhập Tóm tắt nhiều hơn 3 chữ bạn ơi ',

                'NoiDung.required' => 'Nhập Nội dung đi nè ',
                'NoiDung.min' => 'Nhập Nội dung nhiều hơn 3 chữ bạn ơi '
            ]);

            $TinTuc->TieuDe = $request->TieuDe;
            $TinTuc->TieuDeKhongDau = changeTitle($request->TieuDe);
            $TinTuc->TomTat = $request->TomTat;
            $TinTuc->NoiDung = $request->NoiDung;
            $TinTuc->NoiBat = $request->NoiBat;
            
            $TinTuc->idLoaiTin = $request->LoaiTin;

            if ($request->hasFile('Hinh')) {
                # code...   
                $file = $request->file('Hinh');
                $fileType = $file->getClientOriginalExtension('Hinh');
                if ($fileType == "png" || $fileType == "jpg" || $fileType == "gif" || $fileType == "jpeg") { 
                # code...
                    $filename = $file->getClientOriginalName('Hinh');

                    $Hinh =  Str::random(5)."-".$filename;

                    while (file_exists('upload/tintuc'.$Hinh)) {
                        # code...
                        $Hinh =  Str::random(5)."-".$filename;

                    }
                    $file->move('upload/tintuc', $Hinh);

                    $TinTuc->Hinh = $Hinh;
                }else{
                    return redirect('admin/tintuc/them')->with('thongbaoimg', 'Không phải định dạng file ảnh, vui lòng chọn file có đuôi PNG, JPG, JPEG, GIF');
                    
                }
            }
            $TinTuc->save();

        return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.TinTuc.them', [
            'theloai'=>$theloai,
            'loaitin'=>$loaitin
            ]);
        
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'TheLoai' => 'required',
                'LoaiTin' => 'required',

                'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3|max:100',
                'TomTat' => 'required|min:3',
                'NoiDung' => 'required|min:3',

            ], 

            [
                'TheLoai.required' =>'Chọn thể loại đã bạn ới',
                'LoaiTin.required' =>'Chọn loại tin đi nè',

                'TieuDe.required' => 'Nhập Tiêu đề đi nè ',
                'TieuDe.unique' => 'Tiêu đề có rùi ',
                'TieuDe.min' => 'Nhập Tiêu đề nhiều hơn 3 chữ bạn ơi ',
                'TieuDe.max' => 'Nhập Tiêu đề ít lại khoảng 100 chữ thui bạn',

                'TomTat.required' => 'Nhập Tóm tắt đi nè ',
                'TomTat.min' => 'Nhập Tóm tắt nhiều hơn 3 chữ bạn ơi ',

                'NoiDung.required' => 'Nhập Nội dung đi nè ',
                'NoiDung.min' => 'Nhập Nội dung nhiều hơn 3 chữ bạn ơi '
            ]);

            $TinTuc = new TinTuc();
            $TinTuc->TieuDe = $request->TieuDe;
            $TinTuc->TieuDeKhongDau = changeTitle($request->TieuDe);
            $TinTuc->TomTat = $request->TomTat;
            $TinTuc->NoiDung = $request->NoiDung;
            $TinTuc->NoiBat = $request->NoiBat;
            
            $TinTuc->idLoaiTin = $request->LoaiTin;

            if ($request->hasFile('Hinh')) {
                # code...   
                $file = $request->file('Hinh');
                $fileType = $file->getClientOriginalExtension('Hinh');
                if ($fileType == "png" || $fileType == "jpg" || $fileType == "gif" || $fileType == "jpeg") { 
                # code...
                    $filename = $file->getClientOriginalName('Hinh');

                    $Hinh =  Str::random(5)."-".$filename;

                    while (file_exists('upload/tintuc'.$Hinh)) {
                        # code...
                        $Hinh =  Str::random(5)."-".$filename;

                    }
                    $file->move('upload/tintuc', $Hinh);

                    $TinTuc->Hinh = $Hinh;
                }else{
                    return redirect('admin/tintuc/them')->with('thongbaoimg', 'Không phải định dạng file ảnh');
                    
                }
            }else{
                $TinTuc->Hinh = "Không có hình ảnh";
            }
            $TinTuc->save();

        return redirect('admin/tintuc/them')->with('thongbao', 'Thêm thành công');
        
    }
    
    public function postXoa($id) 
    {
        $TinTuc = TinTuc::find($id);
        $image_path = 'upload/tintuc/' . $TinTuc->Hinh;

        if (file_exists('upload/tintuc/'.$TinTuc->Hinh)) {

            File::delete($image_path);
            
        }
        $TinTuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xóa thành công ' . $TinTuc->TieuDe);
    }
}
