@extends('admin.layout.index')
@section('content')
         <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Sửa {{$user->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    {{-- @if ($user -> quyen == 1) --}}
                        
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{ url('admin/user/sua')}}/{{$user->id}}" method="POST">
                            {{ csrf_field() }}

                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            
                            @if(session('thongbaoedit'))
                                <div class="alert alert-success">
                                    {{session('thongbaoedit')}} &nbsp;
                                    <a href="{{url('admin/user/danhsach')}}" class="btn btn-success">Quay về trang danh sách</a>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="username" placeholder="Điền tên muốn sửa" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Điền email muốn sửa" readonly value="{{$user->email}}" />
                            </div>
                            <div class="form-group">
                                <label for="mu">Muốn đổi mật khẩu bấm vào đây</label><br>
                                <input style="display: none;" type="checkbox" class="" name="mu" id="mu"><br>
                                <label>Password</label>
                                <input class="form-control password" type="password" name="pass" placeholder="Điền pass muốn sửa" disabled />
                            </div>
                           <div class="form-group">
                                <label>Password Retype</label>
                                <input class="form-control password" type="password" name="repass" placeholder="Điền pass muốn sửa" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Quyền</label> 
                                <label class="radio-inline">
                                    <input name="quyen" 
                                        @if ($user->quyen == 0)
                                            {{'checked'}}
                                        @endif
                                    value="0" type="radio">Tác giả
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" 
                                         @if ($user->quyen == 1)
                                            {{'checked'}}
                                        @endif
                                    value="1" type="radio">Quản trị viên
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>


                         {{-- @else  --}}

                    {{-- @endif --}}

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#mu').change(function(){
                if($(this).is(':checked')){
                    $('.password').removeAttr('disabled');
                }
                else{
                    $('.password').attr('disabled', '');
                }
            });
        });
    </script>
@endsection