@extends('admin.layout.index')
@section('content')
         <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>{{$theloai->Ten}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{ url('admin/theloai/sua')}}/{{$theloai->id}}" method="POST">
                            {{ csrf_field() }}

                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            
                            @if(session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}} &nbsp;
                                    <a href="{{url('admin/theloai/danhsach')}}" class="btn btn-success">Quay về trang danh sách</a>
                                </div>
                            @endif
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="txtCateName" placeholder="Điền tên muốn sửa" value="{{$theloai->Ten}}" />
                            </div>
                           
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection