<div class="sidebar pb-45px position-sticky top-0 d-none d-md-block">
    <ul class="generic-list-item generic-list-item-highlight fs-15">
        <li class="lh-26 {{ (\Request::is('/')) ? 'active' : '' }}">
            <a class="nav-link custom" href="{{route('home.index')}}"><span><i class="fa fa-home"
                                                               aria-hidden="true"></i></span> Home</a>
        </li>
        <li class="lh-26 {{ (\Request::is('questions')) ? 'active' : '' }}">
            <a class="nav-link custom" href="{{route('home.questions')}}"><span><i class="icon ion-md-list"></i></span>
                Questions</a>
        </li>
        <li class="lh-26">
            <a class="nav-link custom " href="{{route('home.categories')}}"><span><i class="icon ion-md-pricetags"></i></span>
                Categories</a>
        </li>
        <li class="lh-26">
            <a class="nav-link custom " href="{{route('home.users')}}"><span><i class="icon ion-md-contacts"></i></span>
                Users</a>
        </li>
        <li class="lh-26">
            <a class="nav-link custom " href="{{route('home.badges')}}"><span><i class="icon ion-md-infinite"></i></span>
                Badges</a>
        </li>
    </ul>
</div><!-- end sidebar -->