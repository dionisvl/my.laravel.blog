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
                                        <input type=hidden name=itemCount value=1>
                                        <input type=hidden name=itemTitle value="{{$product->title}}">
                                        <input type=hidden name=itemPrice value={{$product->price}}>
                                        <input type=hidden name=itemImg value="{{$product->getImage()}}">
                                        <input type=hidden name=itemSrc value={{route('product.show', $product->slug)}}>
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
                        <a href=/cart/ class=btn><span>Перейти в корзину</span></a>
                        <a href=# data-dismiss=modal class=modal-link>Продолжить покупки</a>
                    </div>
                </div>
            </div>
        </div>


        @include('pages.promo')


    </main>


@endsection
