<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function postXoa($id, $idTinTuc)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/' .$idTinTuc)->with('thongbaocmt', 'Xóa cmt thành công ');
    }
    
}
