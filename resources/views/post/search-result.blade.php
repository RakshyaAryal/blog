@if(count($post)> 0)
    @foreach($post as $p)
        <div><a href="#">{{ $p->title }}</a></div>
        @endforeach
    @else
No record found
    @endif