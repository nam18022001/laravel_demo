<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>
        @foreach ($theloai as $value)

        <li href="#" class="list-group-item menu1">
            {{$value->Ten}}
        </li>
        @if (count($value->loaitin) > 0)
            <ul>
                @foreach ($value->loaitin as $lt)
                    <li class="list-group-item">
                        <a href="#">{{$lt->Ten}}</a>
                    </li>
                                    
                @endforeach
            </ul>                
        @endif
        @endforeach
     </ul>
</div>