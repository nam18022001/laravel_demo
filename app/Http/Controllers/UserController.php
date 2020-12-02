<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

// Thư viện kiểm tra đăng nhập
use Illuminate\Support\Facades\Auth;


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
       $this->validate($request, 
       [
           'username' => 'required|min:3|max:300',
       ], 
       
       [
           'username.required' => 'Nhập tên người dùng đi bạn ơi',
           'username.min' => 'Nhập tên người dùng ít nhất 3 ký tự nhá',
           'username.max' => 'Nhập tên người dùng ít không được quá 300 từ nha',
       ]);

       $user->name = $request->username;
       if ($request->mu == "on") {
           # code...
           $this->validate($request, 
           [
               'pass' => 'required|min:3|max:50',
               'repass' => 'required|same:pass'
           ], 
           
           [
               'password.required' => 'Nhập mật khẩu đã',
               'pass.min' => 'Nhập mật khẩu nhiều hơn 3 ký tự',
               'pass.max' => 'Nhập mật khẩu ít hơn 50 ký tự',
               'repass.required' => 'Nhập lại mật khẩu nữa',
               'repass.same' => 'Mật khẩu không trừng khớp'
           ]);
           $user->password = bcrypt($request->repass);
       }
       $user->save();
       return redirect('admin/user/sua/'.$id)->with('thongbaoedit', 'Sửa thành công');

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
        $user->password = bcrypt($request->repass);
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao', 'Thêm thành công');
    }
    
    public function postXoa($id) 
    {
        $user = User::where('id',$id)->first();

        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbaoxoa', 'Xóa thành công người dùng: '. $user->name);
    }
   
    public function postloginAdmin(Request $request)
    {
        
        # code...
        $this->validate($request ,
            [
                'email' => 'required', 
                'password' => 'required|min:3|max:100'
            ],

            [
                'email.required' => 'Nhập email đi đã nè',
                'password.required' => 'Password chưa nhập',
                'password.min' => 'Nhập password hơn 3 ký tự',
                'password.max' => 'Nhập ít hơn 100 ký tự hoy'
            ]
        );

        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            # code...
            return redirect('admin/theloai/danhsach');
        }else{

                return redirect('admin/login')->with('error', 'Sai tên hoặc mật khẩu rồi nha');
            }

        }
        public function loginAdmin()
        {
            # code...
            if (Auth::check() && Auth::user()->quyen == 1) {
                # code...
                return redirect('admin/theloai/danhsach');

            }else {
                # code...
                return view('admin.login');

            }
            
        }
    public function logoutAdmin()
    {
        # code...
        Auth::logout();
        return redirect('admin'); 
    }
}

