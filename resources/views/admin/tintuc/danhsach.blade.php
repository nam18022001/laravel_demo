@extends('admin.layout.index')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Dánh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Tóm tắt</th>
                                <th>Hình ảnh</th>
                                <th>Thể Loại</th>
                                <th>Loại Tin</th>
                                <th>Xem</th>
                                <th>Nổi bật</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{$value->id}}</td>
                                <td>{{$value->TieuDe}}</td>
                                <td>{{$value->TomTat}}</td>
                                <td>
                                    <img width="100px" src="{{asset('upload/tintuc')}}/{{$value->Hinh}}" alt="Hình ảnh bị lỗi hoặc không có">
                                </td>
                                <td>{{$value->LoaiTin->TheLoai->Ten}}</td>
                                <td>{{$value->LoaiTin->Ten}}</td>
                                <td>{{$value->SoLuotXem}}</td>
                                <td>
                                    @if($value->NoiBat == 1)
                                        {{"Có"}}
                                    @else
                                        {{"Không"}}
                                    @endif
                                </td>

                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{url('admin/tintuc/xoa')}}/{{$value->id}}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url('admin/tintuc/sua')}}/{{$value->id}}">Sửa</a></td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection