      
      @extends('admin.layout.index')
      @section('content')
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{ url('admin/user/them')}}" method="POST">
                            {{ csrf_field() }}
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                            @if (session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>User name</label>
                                <input class="form-control" name="username" placeholder="Nhập username" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Email" type="email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="pass" type="password" placeholder="Nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Re-Password</label>
                                <input class="form-control" name="repass" type="password" placeholder="Nhập lại mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label> 
                                <label class="radio-inline">
                                    <input name="quyen" value="0" checked="" type="radio">Tác giả
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio">Quản trị viên
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection