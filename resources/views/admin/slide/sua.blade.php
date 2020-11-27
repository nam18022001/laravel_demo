@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>{{$slide->Ten}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{ url('admin/slide/sua')}}/{{$slide->id}}" method="POST">
                    {{ csrf_field() }}

                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}} &nbsp;
                            <a href="{{url('admin/slide/danhsach')}}" class="btn btn-success">Quay về trang danh sách</a>
                        </div>
                    @endif
                    @if(session('thongbaoimg'))
                        <div class="alert alert-success">
                            {{session('thongbaoimg')}} &nbsp;
                            <a href="{{url('admin/slide/danhsach')}}" class="btn btn-warning">Quay về trang danh sách</a>
                        </div>
                    @endif
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label>Tên Slide</label>
                        <input class="form-control" name="tenSlide" placeholder="Điền tên muốn sửa" value="{{$slide->Ten}}" />
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="link" placeholder="Điền đường dẫn muốn sửa" value="{{$slide->link}}" />
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea class="form-control ckeditor" name="ndSlide" placeholder="Điền nội dung muốn sửa">{{$slide->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh</label>
                        <p><img src="{{asset('upload/slide')}}/{{$slide->Hinh}}" width="30%" alt="Không có hình ảnh được thêm"></p>
                        <input class="form-control" name="file" type="file" />
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