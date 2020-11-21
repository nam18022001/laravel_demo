@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Sửa {{$tintuc->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{url('admin/tintuc/sua')}}/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if(count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    @endif
                    @if (session('thongbao'))
                        <div class="alert alert-success" role="alert">
                            {{session('thongbao')}} &nbsp;
                            <a href="{{url('admin/tintuc/danhsach')}}" class="btn btn-success">Quay về trang danh sách</a>
                        </div>
                    @endif
                    @if (session('thongbaoimg'))
                        <div class="alert alert-warning" role="alert">
                            {{session('thongbaoimg')}}
                        </div>
                    @endif
                    <div class="form-group">
                <label>Thể loại</label>
                <select class="form-control" name="TheLoai" id="TheLoai">
                    <option value="#">-- Chọn thể loại --</option>
                    
                    @foreach ($theloai as $value)
                    <option 
                        @if($tintuc->loaitin->theloai->id == $value->id)
                            {{"selected"}}
                         @endif
                    value="{{$value->id}}">{{$value->Ten}}</option>
                        
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Loại Tin</label>
                <select class="form-control" name="LoaiTin" id="LoaiTin">
                    <option value="#"-- >Chọn loại tin --</option>
                    @foreach ($loaitin as $value)
                    <option 
                        @if($tintuc->loaitin->id == $value->id)
                            {{"selected"}}
                         @endif
                    value="{{$value->id}}">{{$value->Ten}}</option>
                        
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input class="form-control" name="TieuDe" placeholder="Nhập Tiêu Đề" value="{{ $tintuc->TieuDe}}" />
            </div>
            <div class="form-group">
                <label>Tóm tắt</label>
                <textarea class="form-control ckeditor" id="Demo" name="TomTat" rows="3" placeholder="Nhập Tóm Tắt" >{{ $tintuc->TomTat}}</textarea>
            </div>
            <div class="form-group">
                <label>Nội Dung</label>
                    <textarea class="form-control ckeditor" id="Demo" name="NoiDung" rows="5" placeholder="Nhập Nội Dung" >{{ $tintuc->NoiDung}}</textarea>
            </div>
            <div class="form-group">
                <label>Upload lại Hình ảnh</label><br>
                <p><img src="{{asset('upload/tintuc')}}/{{$tintuc->Hinh}}" width="20%" alt="Không có hình"></p>
                <input type="file" class="form-control" name="Hinh" placeholder="Nhập Nội Dung" />
            </div>
            <div class="form-group">
                <label>Nổi bật</label> 
                <label class="radio-inline">
                    <input name="NoiBat" value="1" 
                        @if($tintuc->NoiBat == 1)
                            {{'checked'}}
                        @endif
                    type="radio">Có
                </label>
                <label class="radio-inline">
                    <input name="NoiBat" value="0"
                        @if($tintuc->NoiBat == 0)
                            {{'checked'}}
                        @endif
                    type="radio">Không
                </label>
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

@section('script')
    <script>
        $basic_url = "http://localhost/laravel_demo/public/admin/ajax/loaitin/";
        $(document).ready(function(){
            $("#TheLoai").change(function(){
                var idTheLoai = $(this).val();
                $.get($basic_url +idTheLoai, function(data){
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection