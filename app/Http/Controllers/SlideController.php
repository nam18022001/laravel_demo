<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use File;

use App\Models\Slide;

class SlideController extends Controller
{
    //
     public function getDanhSach()
    {

        $slide = Slide::all();
        return view('admin.slide.danhsach', ['slide'=>$slide]);
    }
    public function getSua($id)
    {
        $slide = Slide::find($id);

        return view('admin.slide.sua', [
            'slide' => $slide
        ]);
        
    }

    public function postSua(Request $request, $id)
    {
        $slide = Slide::find($id);
        $this->validate($request,
            [
                'tenSlide' => 'required|min:3|max:100',
                'ndSlide' => 'required|min:3',
            ], 

            [
                'tenSlide.required' =>'Nhập Tên slide đi đã',
                'ndSlide.required' => 'Nhập Nội Dung đi nè ',
                'ndSlide.min' => 'Nhập nội dung nhiều hơn 3 chữ bạn ơi ',
                'tenSlide.min' => 'Nhập tên nhiều hơn 3 chữ nha',
                'tenSlide.max' => 'Nhập ít lại khoảng 100 chữ thui bạn'
            ]);
        $slide->Ten = $request->tenSlide;
        $slide->NoiDung = $request->ndSlide;
        if ($request->has('link')) {
            # code...
            $slide->link = $request->link;
        }
        if ($request->hasFile('file')) {
            # code...
            $file = $request->file('file');
            $filetype = $file->getClientOriginalExtension();
            if ($filetype == 'png' || $filetype == 'jpg' || $filetype == 'gif' || $filetype == 'jpeg') {
                # code...

                $filename = $file->getClientOriginalName();
                $upload = Str::random(5)."-".$filename;

                while(file_exists($upload)) {
                    $upload = Str::random(5)."-".$filename;
                }
                $file -> move('upload/slide', $upload);
                $slide->Hinh = $upload;
            }else{
                return redirect('admin/slide/sua')->with('thongbaoimg', 'Không phải định dạng file ảnh, vui lòng chọn file có đuôi là PNG, JPG, GIF, JPEG');
            }
        }else{
            
        }
        $slide ->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    public function getThem()
    {
        $slide = slide::all();
        return view('admin.slide.them', ['silde'=>$slide]);
        
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'tenSlide' => 'required|unique:Slide,Ten|min:3|max:100',
                'ndSlide' => 'required|min:3',
                'file' => 'required'

            ], 

            [
                'tenSlide.required' =>'Nhập Tên slide đi đã',
                'ndSlide.required' => 'Nhập Nội Dung đi nè ',
                'file.required' => 'Chọn hình ảnh đi bạn ơi',
                'tenSlide.unique' => 'Slide có rùi ',
                'ndSlide.min' => 'Nhập nội dung nhiều hơn 3 chữ bạn ơi ',
                'tenSlide.min' => 'Nhập tên nhiều hơn 3 chữ nha',
                'tenSlide.max' => 'Nhập ít lại khoảng 100 chữ thui bạn'
            ]);
                
            $slide = new Slide();
            $slide->Ten = $request->tenSlide;
            $slide->NoiDung = $request->ndSlide;

            if ($request->has('link')) {
                # code...
                $slide->link = $request->link;
            }else{
                $slide->link = "";
                
            }
            

            if ($request->hasFile('file')) {
                # code...
                $file = $request->file('file');                
                $filetype = $file->getClientOriginalExtension();

                if ($filetype == 'png' || $filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif') {
                    # code...
                    $filename = $file->getClientOriginalName();

                    $hinh =  Str::random(5)."-".$filename;
                    while (file_exists('upload/slide/'.$hinh)) {
                        # code...
                        $hinh =  Str::random(5)."-".$filename;  
                    }
                    $file -> move('upload/slide', $hinh);
                    $slide->Hinh = $hinh;
                }else{
                    return redirect('admin/slide/them')->with('thongbaoimg', 'Không phải định dạng file ảnh, vui lòng chọn file có đuôi là PNG, JPG, GIF, JPEG');
                }
            }
            $slide->save();

        return redirect('admin/slide/them')->with('thongbao', 'Thêm thành công');
        
    }
    
    public function postXoa($id) 
    {
        $slide = Slide::find($id);

        $image_path = 'upload/slide/' . $slide->Hinh;

        if (file_exists('upload/slide/'.$slide->Hinh)) {

            File::delete($image_path);
            
        }

        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao', 'Xóa thành công ' . $slide->Ten);
    }
}
