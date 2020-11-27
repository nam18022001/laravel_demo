@extends('admin.layout.index')
@section('content')
   <!-- Page Content -->
   
        <div id="page-wrapper">
            <div class="container-fluid">
                @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
        @endif
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Nội Dung</th>
                                <th>Link</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{$value->id}}</td>
                                <td>{{$value->Ten}}</td>
                                <td><img src="{{asset('upload/slide')}}/{{$value->Hinh}}" width="20%" alt=""></td>
                                <td>{{$value->NoiDung}}</td>
                                <td>{{$value->link}}</td>

                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{url('admin/slide/xoa')}}/{{$value->id}}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url('admin/slide/sua')}}/{{$value->id}}">Sửa</a></td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection