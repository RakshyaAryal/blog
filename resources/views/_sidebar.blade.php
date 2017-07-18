<ul class="list-group">
    <li class="list-group-item"><a href="{{url('post/index')}}">Post</a></li>

    @if(Auth::user()->user_type == 1)
        <li class="list-group-item"><a href="{{url('category/index')}}">Categories</a></li>
        <li class="list-group-item"><a href="{{ url('user-management/index') }}">User Management</a></li>
    @endif
</ul>