      
      @extends('admin.layout.index')
      @section('content')
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại tin
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{url('admin/loaitin/them')}}" method="POST">
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
                                    <a href="{{url('admin/loaitin/danhsach')}}" class="btn btn-success">Quay về trang danh sách</a>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="TheLoai">
                                    <option value="">---Chọn Thể Loại---</option>
                                    @foreach($theloai as $value)
                                        <option value="{{$value->id}}">{{ $value->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Loại Tin</label>
                                <input class="form-control" name="txtCateName" placeholder="Nhập thên loại tin" />
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