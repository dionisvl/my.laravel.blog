<!DOCTYPE html>
<html>
<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8"/>
    <meta name=robots content="index, follow"/>
    <meta name=keywords content="Интернет-магазин спортивного питания"/>
    <meta name=description
          content="Купить спортивное питание в Москве, МО, Одинцово и Трехгорке. Прямые поставки из США. Гарантия от производителя"/>
    <title>Спортивное питание в Одинцово, Москве, Московской области, Трехгорке + Отзывы</title>
    <link rel="shortcut icon" type=image/x-icon href="favicon.ico"/>
    <meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic"
          rel=stylesheet>
    <link href=/themes/sportfood/template_48586b61863cda9ef9ffe2b13dd34702_v1.css rel=stylesheet>
    <link href=/themes/sportfood/all.css rel=stylesheet>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js></script>
    <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js></script>
    <script src=/themes/sportfood/cart.js defer></script>
    <script src=/themes/sportfood/main.js defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
</head>
<body>
<header class=mn-header>
    <div class=mn-header__top>
        <div class=container>
            <div class=mn-header__questions>
                <div class=img>
                    <i class="ico ico-phone hidden-sm"></i>
                    <i class="ico ico-phone_sm visible-sm-inline-block"></i>
                </div>
                <div class="cnt hidden-xs">
                    <span>Есть вопросы? Позвоните нам: </span>
                    <span>
                        <a href=tel:+79991140312 rel=nofollow target=_blank>+7 (999) 114-03-12</a><br>
                        <div style=line-height:2.5>
                            <a href=https://wa.me/79991140312 rel=nofollow target=_blank>WhatsApp</a> &nbsp; &nbsp; &nbsp;
                            <a rel=nofollow target=_blank href="viber://add?number=79991140312">Viber</a>&nbsp; &nbsp; &nbsp; &nbsp;
                            <a rel=nofollow target=_blank href=https://t.me/79991140312>Telegram</a>
                        </div>
                    </span>
                    <span>Время работы: пн-сб с 10:00-20:05</span>
                </div>
                <div class="cnt visible-xs">
                <span>Интернет магазин спортивного питания в Москве и Регионах<br>
<br>
<br>
</span><span><a href=tel:+79991140312 rel=nofollow target=_blank>+7 (999) 114-03-12</a>
<br>
<div style=line-height:2.5>
<a href=https://wa.me/79991140312 rel=nofollow target=_blank>WhatsApp</a>
<a rel=nofollow target=_blank href="viber://add?number=79991140312">Viber</a>
<a rel=nofollow target=_blank href=https://t.me/innovativbase>Telegram</a></div>
</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mn-header__bottom @if (Request::path() !== 'shop') mn-header__isSmall @endif">

        <div class=container>
            <div class="mn-header__logo hidden-xs">
                <a href="{{route('shop.index')}}"><img alt=logo src=/upload/template/sportfood/logo.jpg></a>
                <span>Интернет магазин спортивного питания в Москве и Регионах
                    @if(Auth::check())
                        @if(Auth::user()->is_admin)
                            <a href="/admin"><i class="fas fa-users-cog"></i> login</a>
                            <a href="/logout">Logout</a>
                        @endif
                    @endif
                    <br><br><br>
                </span>
            </div>
            <div class=mn-header__right-group>
                <div class="mn-header__nav-trigger visible-xs">
                    <i class="ico ico-hamburger"></i>
                </div>
                <nav class=mn-header__nav>
                    <ul class=list_float id=horizontal-3level-menu>
                        <li class=root-item-selected>
                            <a href="{{route('shop.index')}}">Каталог</a>
                            <ul class=second-level>
                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        <li>
                                            <a href={{route('category.show',$category->slug)}}>{{$category->title}}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li class=root-item>
                            <a href={{route('shop.food.show')}}>Питание</a>
                        </li>
                        <li class=root-item>
                            <a href={{route('shop.payment.show')}}>Оплата и доставка</a>
                        </li>
                        <li class=root-item>
                            <a href={{route('shop.contacts.show')}}>Контакты</a>
                        </li>
                    </ul>
                </nav>
                <div class="mn-header__logo-xs visible-xs-inline-block">
                    <span>
                        <a href="{{route('shop.index')}}">innovativbase</a>
                    </span>
                </div>
                <a href={{route('cart.show')}} class=mn-header__basket id=sw_basket>
                    <i id=top_basket_counter>0</i>
                    <span class="ico ico-basket hidden-sm hidden-xs"></span>
                    <span class="ico ico-basket_sm visible-sm"></span>
                    <span class="icon ico-basket_xs visible-xs"></span>
                </a>
            </div>
        </div>
        @if (Request::path() === 'shop')
            <div class="mn-header__bg"
                 style="background:url(/upload/template/sportfood/background.jpg) top center"></div>
        @else
            <div class="mn-header__bg-gray"></div>
        @endif
    </div>
</header>


@yield('content')
<div class=mn-footer>
    <div class=mn-footer__top>
        <div class=container>
            <div class=row>
                <div class=col-sm-18>
                    <nav class="mn-footer__nav hidden-xs">
                        <ul class=list_float>
                            <li class=active><a href="{{route('shop.index')}}">Каталог</a></li>
                            <li><a href={{route('shop.food.show')}}>Питание</a></li>
                            <li><a href={{route('shop.payment.show')}}>Оплата и доставка</a></li>
                            <li><a href={{route('shop.contacts.show')}}>Контакты</a></li>
                        </ul>
                    </nav>
                    <div class="mn-footer__txt hidden-xs">
                        <p>
                        </p>
                        <p>
                            ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ&nbsp;
                        </p>
                        <p>
                            Хранить в недоступном для детей месте. Продукты, представленные на сайте, не являются
                            лекарственным средством. Перед началом применения обязательно проконсультируйтесь у
                            специалиста.&nbsp;Продукция обмену и возврату не подлежит. 1436
                        </p>
                        <p>
                            &nbsp;
                        </p></div>
                </div>
                <div class="col-xs-12 visible-xs">
                    <div class="mn-header__logo-xs visible-xs-inline-block"><span>innovativbase</span></div>
                    <div class="mn-footer__tel visible-xs"></div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class=mn-footer__soc>
<span class=hidden-xs>
Почта:&nbsp;<a href=mailto:info@innovativlab.ru>info@innovativlab.ru</a><br>
Тел: +7 (999) 114-03-12<br>
Время работы: <br>
пн-сб с 10:00-20:05<br>
<br>
<br> </span>
                        <span class=hidden-xs></span>
                    </div>
                </div>
                <div class="mn-footer__txt visible-xs col-xs-24">
                    <p>
                    </p>
                    <p>
                        ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ&nbsp;
                    </p>
                    <p>
                        Хранить в недоступном для детей месте. Продукты, представленные на сайте, не являются
                        лекарственным средством. Перед началом применения обязательно проконсультируйтесь у специалиста.&nbsp;Продукция
                        обмену и возврату не подлежит. 1436
                    </p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <div class=mn-footer__bottom>
        <div class=container>
            <span>Copyright © <?php echo date('Y') ?> Innovative Base®. Все права защищены.</span>
        </div>
    </div>
</div>

<div id=modal_basket tabindex=-1 role=dialog class="modal fade">
    <div role=document class=modal-dialog>
        <div class=modal-content>
            <div class=modal-header>
                <div class="modal-title">
                    <span id="modal_product_name"></span>
                </div>
            </div>
            <div class=modal-body id=header_basket>
                <div id=warning_message></div>
                <form method=post action name=basket_form class=cart-form>
                    <div id=cart_content>empty cart_content</div>
                    <div class="modal__basket__item modal__basket__total">
                        <div class=desc>
                            <div class=item-group>
                                <div class=ttl>Выбрано товаров:</div>
                                <div class="i_desc js_item_count" id=modal_basket_counter>1</div>
                            </div>
                            <div class=item-group>
                                <div class=ttl>На сумму:</div>
                                <div class=i_desc>
                                    <span class=js_item_price id=modal_basket_total>777</span>р
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class=modal-footer>
                <a href={{route('cart.show')}} class=btn><span>Перейти в корзину</span></a>
                <a href=# data-dismiss=modal class=modal-link>Продолжить покупки</a>
            </div>
        </div>
    </div>
</div>

<div itemscope itemtype=https://schema.org/SportingGoodsStore style=display:none>
    <span itemprop=name>innovativbase</span><span itemprop=url>https://innovativlab.ru</span>
    <span itemprop=priceRange>от 2600 руб до 5500 руб</span>
    <img itemprop=logo src="/upload/template/sportfood/logo.jpg"/>
    <img itemprop=image src="/upload/template/sportfood/innova.jpg"/>
    <div itemprop=address itemscope itemtype=https://schema.org/PostalAddress><span
            itemprop=addressCountry>Россия</span><span itemprop=addressLocality>Москва</span><span
            itemprop=addressRegion>Московская область</span><span
            itemprop=streetAddress>улица Бутырский Вал, 68/70с1</span>
    </div>
    <span itemprop=telephone>+79991140312</span>
    <a itemprop=email href=mailto:info@innovativlab.ru>info@innovativlab.ru</a>
    <time itemprop=openingHours datetime="Mo-Su 10:00-22:00"></time>
</div>
</body>
</html>
