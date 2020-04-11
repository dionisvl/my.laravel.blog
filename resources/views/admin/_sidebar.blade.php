<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview">
        <a href="/admin/posts">
            <i class="fas fa-tachometer-alt"></i> <span>Админ-панель</span>
        </a>
    </li>
    <li><a href="{{route('products.index')}}"><i class="fa fa-users"></i> <span>Товары</span></a></li>
    <li><a href="{{route('categories.index')}}"><i class="fa fa-list-ul"></i> <span>Категории</span></a></li>
    <li><a href="{{route('orders.index')}}"><i class="fa fa-list-ul"></i> <span>Заказы</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-green">{{$newOrdersCount}}</small>
            </span>
        </a>
    </li>

    <li><a href="{{route('posts.index')}}"><i class="fas fa-sticky-note"></i> <span>Посты</span></a></li>
    <li><a href="{{route('tags.index')}}"><i class="fa fa-tags"></i> <span>Теги</span></a></li>
    <li>
        <a href="/admin/comments">
            <i class="fas fa-comments"></i> <span>Комментарии</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-green">{{$newCommentsCount}}</small>
            </span>
        </a>
    </li>
    <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>
    <li><a href="{{route('subscribers.index')}}"><i class="fa fa-user-plus"></i> <span>Подписчики</span></a></li>
    <li><a href="{{route('portfolios.index')}}"><i class="fa fa-users"></i> <span>Портфолио</span></a></li>
    <li><a href="{{route('incomings.index')}}"><i class="fa fa-users"></i> <span>Входящие сообщения</span></a></li>
</ul>
