      
      @extends('admin.layout.index')
      @section('content')
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Silde
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{url('admin/slide/them')}}" method="POST" enctype="multipart/form-data">
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
                                    <a href="{{url('admin/slide/danhsach')}}" class="btn btn-success">Quay về trang danh sách</a>
                                </div>
                            @endif
                             @if (session('thongbaoimg'))
                                <div class="alert alert-warning" role="alert">
                                    {{session('thongbaoimg')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Tên Slide</label>
                                <input class="form-control" name="tenSlide" placeholder="Nhập tên slide muốn thêm " />
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link" placeholder="Nhập Link muốn thêm " />
                            </div>
                            <div class="form-group">
                                <label>Nội dung Slide</label>
                                <textarea class="form-control ckeditor" id="demo" name="ndSlide" placeholder="Nhập nội dung muốn thêm "></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Upload Hình ảnh</label>
                                <input class="form-control" name="file" type="file" />
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