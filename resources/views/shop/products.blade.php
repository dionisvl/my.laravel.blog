@extends('shop.layout')

@section('content')
    <main class=mn-content>
        <div class="container c-gui-article">
            <h1>Спортивное питание Innovative Base Москва и МО, Одинцово, Трехгорка</h1>
            <div class=catalog-page__catalog-block>
                <div class="row row_inline">

                    @foreach($products as $product)
                        <div class="col-md-6 col-sm-8 col-xs-12 col-xx-24 product" id="{{$product->id}}">
                            <div class=c-thumb>
                                <div class=c-thumb__header>
                                    <div class=c-thumb__ttl>{{$product->title}}</div>
                                    <span>{{$product->composition}}</span>
                                </div>
                                <div class=c-thumb__img>
                                    <a href={{route('product.show', $product->slug)}}>
                                        <img src={{$product->getImage('preview_picture')}} alt="{{$product->title}}"
                                             height=177>
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
                                        <input type=hidden name=itemImg
                                               value="{{$product->getImage('preview_picture')}}">
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
                                {!!$product->features!!}
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        @include('shop.promo')
    </main>

@endsection
