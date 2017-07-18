
@if(count($category)> 0)
    @foreach($category as $c)
        <div><a href="#">{{ $c->title }}</a></div>
    @endforeach
@else
    No record found
@endif