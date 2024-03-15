<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
    <a href="index-2.html"><img src="{{asset ('assets/img/logo.png')}}" alt></a>
    <div class="sidebar_close_icon d-lg-none">
    <i class="ti-close"></i>
    </div>
    </div>
    <ul id="sidebar_menu">
    <li class="mm-active">
    <a class="" href="/dashboard" aria-expanded="false">
    <div class="icon_menu">
    <img src="{{asset ('assets/menu-icon/dashboard.svg')}}" alt>
    </div>
    <span>Dashboard</span>
    </a>

    </li>
    <li class>
    <a class="has-arrow" href="#" aria-expanded="false">
    <div class="icon_menu">
    <img src="{{asset ('assets/img/menu-icon/2.svg')}}" alt>
    </div>
    <span>Posts</span>
    </a>
    <ul>
    <li><a href="{{route('post.create')}}">Create Post</a></li>
    <li><a href="#">AI Assistant</a></li>
    <li><a href="#">Manage Post</a></li>
    <li><a href="#">Calander</a></li>
    <li><a href="#">Bulk Shedule</a></li>
    <li><a href="#">Pending Review</a></li>
    <li><a href="#">Drafts</a></li>
    </ul>
    </li>
    <li class>
    <a class="has-arrow" href="#" aria-expanded="false">
    <div class="icon_menu">
    <img src="{{asset ('assets/img/menu-icon/3.svg')}}" alt>
    </div>
    <span>Accounts</span>
    </a>
    <ul>
    <li><a href="{{route('account.connect')}}">Connect Account</a></li>
    <li><a href="{{route('account.manage')}}">Manage Account</a></li>
    </ul>
    </li>
    <li class>
    <a class="has-arrow" href="#" aria-expanded="false">
    <div class="icon_menu">
    <img src="{{asset ('assets/img/menu-icon/4.svg')}}" alt>
    </div>
    <span>Groups</span>
    </a>
    <ul>
    <li><a href="#">Create Group</a></li>
    <li><a href="#">Manage Group</a></li>
    </ul>
    </li>
    <li class>
    <a href="Board.html" aria-expanded="false">
    <div class="icon_menu">
    <img src="{{asset ('assets/img/menu-icon/5.svg')}}" alt>
    </div>
    <span>Analytics</span>
    </a>
    </li>
    <li class>
    <a href="invoice.html" aria-expanded="false">
    <div class="icon_menu">
    <img src="{{asset ('assets/img/menu-icon/6.svg')}}" alt>
    </div>
    <span>Inbox</span>
    </a>
    </li>
    </ul>
    </nav>
