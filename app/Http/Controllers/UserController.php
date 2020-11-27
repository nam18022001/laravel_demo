<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
     public function getDanhSach()
    {

        $user = User::all();
        return view('admin.user.danhsach', ['user'=>$user]);
    }
    public function getSua($id)
    {
    
        $user = User::find($id);

        return view('admin.user.sua', ['user' => $user]);
    }

    public function postSua(Request $request, $id)
    {
       $user = User::find($id);

       $user->name = $request->name;
       $user->email = $request->email;
       if (has($request->pass)) {
           # code...
           $user->password = $request->pass;
       }

    }

    public function getThem()
    {
       return view('admin.user.them'); 
    }
    public function postThem(Request $request)
    {
        $this->validate($request, 
        [
            'username' => 'required|unique:users,name|min:3|max:300',
            'email' => 'required|unique:users,email',
            'pass' => 'required|min:3|max:50',
            'repass' => 'required|same:pass'

        ], 
        
        [
            'username.required' => 'Nhập tên người dùng đi bạn ơi',
            'username.unique' => 'Tên người dùng đã tồn tại',
            'username.min' => 'Nhập tên người dùng ít nhất 3 ký tự nhá',
            'username.max' => 'Nhập tên người dùng ít không được quá 300 từ nha',
            'email.required' => 'Nhập email đi nè',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Nhập mật khẩu đã',
            'pass.min' => 'Nhập mật khẩu nhiều hơn 3 ký tự',
            'pass.max' => 'Nhập mật khẩu ít hơn 50 ký tự',
            'repass.required' => 'Nhập lại mật khẩu nữa',
            'repass.same' => 'Mật khẩu không trừng khớp'
        ]);
        

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = md5($request->repass);
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao', 'Thêm thành công');
    }
    
    public function postXoa($id) 
    {
        $user = User::where('id',$id)->first();

        $user->delete();
        return view('admin.user.danhsach')->with('thongbaoxoa', 'Xóa thành công người dùng'. $user->name);
    }
}