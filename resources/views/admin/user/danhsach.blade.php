@extends('admin.layout.index')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                @if (session('thongbaoxoa'))
                    <div class="alert alert-success">
                        {{session('thongbaoxoa')}}
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Ngày tạo</th>
                                <th>Lần đổi mật khẩu gần nhất</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($user as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->email}}</td>
                                <td>
                                    @if($value->quyen == 1)
                                        {{'Quản trị viên'}}
                                    @else
                                        {{'Tác giả'}}
                                    @endif
                                </td>
                                <td>{{$value->created_at}}</td>
                                <td>{{$value->updated_at}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{url('admin/user/xoa')}}/{{$value->id}}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url('admin/user/sua')}}/{{$value->id}}">Sửa</a></td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection