@extends('layout')

@section('content')
    <main class=mn-content>
        <div class="container c-gui-article">
            <h1>Спортивное питание Innovative Base Москва и МО, Одинцово, Трехгорка</h1>
            <div class=catalog-page__catalog-block>
                <div class="row row_inline">

                    @foreach($products as $product)
                        <div class="col-md-6 col-sm-8 col-xs-12 col-xx-24" id=bx_3966226736_103>
                            <div class=c-thumb>
                                <div class=c-thumb__header>
                                    <div class=c-thumb__ttl>{{$product->title}}</div>
                                    <span>{{$product->composition}}</span>
                                </div>
                                <div class=c-thumb__img>
                                    <a href={{route('product.show', $product->slug)}}>
                                        <img src={{$product->getImage()}} alt="{{$product->title}}" height=177>
                                    </a>
                                </div>
                                <div class=c-thumb__price>
                                    <span>Цена: <span class=js_price>{{$product->price}} </span> руб</span>
                                </div>
                                <div class=c-thumb__btn-group>
                                    <form action method=POST class=add_to_cart_form>
                                        <input type=hidden name=itemId value={{$product->id}}>
                                        <input type=hidden name=quantity value=1>
                                        <input type=hidden name=name value="{{$product->title}}">
                                        <input type=hidden name=price value={{$product->price}}>
                                        <span class="btn btn_xs add_to_cart">
                                            <span class="ico ico-thumb-basket"></span>
                                            <input type=submit value="В корзину" class=add_to_cart>
                                        </span>
                                    </form>
                                    <a href="{{route('product.show', $product->slug)}}" class="btn btn_xs btn_bd">
                                        <span>Подробнее</span>
                                    </a>
                                </div>
                                {!!$product->preview_text!!}
                                <ul class="list c-thumb__list">
                                    <li>Самый горячий термогеник</li>
                                    <li>Максимальное снижение аппетита</li>
                                    <li>250% прирост жиросжигания</li>
                                    <li>Made in USA</li>
                                </ul>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div id=modal_basket tabindex=-1 role=dialog class="modal fade">
            <div role=document class=modal-dialog>
                <div class=modal-content>
                    <div class=modal-header>
                        <div class="modal-title empty-state">Товар добавлен в корзину</div>
                    </div>
                    <div class=modal-body id=header_basket>
                        <div id=warning_message></div>
                        <form method=post action name=basket_form class=cart-form>
                            <div id=cart_content>empty cart_content</div>
                            <div class=modal__basket__item id=basket_item_6742>
                                <div class=img>
                                    <img
                                        src=upload/resize_cache/iblock/0d7/200_177_1/0d770dc3b1a56b9fe27e63551932518e.jpg
                                        alt=Taipan>
                                </div>
                                <div class=desc>
                                    <a href=/venom_predtren/><b>Venom</b></a>
                                    <div class=item-group>
                                        <div class=ttl>Кол-во</div>
                                        <div class=e-count>
                                            <i class="minus input_calc" data-operator=- data-item=6742
                                               onclick=input_calc()></i>
                                            <input type=text data-item=6742 value=1 id=NUMBER_FIELD_6742>
                                            <i class="plus input_calc" data-operator=+ data-item=6742
                                               onclick=input_calc()></i>
                                        </div>
                                        <i class="ico ico-remove" data-item=6742 onclick=remove_from_cart(this)></i>
                                    </div>
                                    <span class=js_current_price><span id=price_6742
                                                                       data-price=2700>2700</span> р.</span>
                                    <div class=item-group>
                                        <div class=ttl>Цена:</div>
                                        <div class=i_desc>
                                        <span class="js_price total_span" id=total_price_6742
                                              data-total=2700>2700</span>р.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal__basket__item modal__basket__total">
                                <div class=desc>
                                    <div class=item-group>
                                        <div class=ttl>Выбрано товаров:</div>
                                        <div class="i_desc js_item_count" id=modal_basket_counter>2</div>
                                    </div>
                                    <div class=item-group>
                                        <div class=ttl>На сумму:</div>
                                        <div class=i_desc>
                                            <span class=js_item_price id=modal_basket_total>4 650</span>р
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class=modal-footer>
                        <a href=/cart/ class=btn style=color:blue><span>Перейти в корзину</span></a>
                        <a href=# data-dismiss=modal class=modal-link>Продолжить покупки</a>
                    </div>
                </div>
            </div>
        </div>


        @include('pages.promo')


    </main>


@endsection
