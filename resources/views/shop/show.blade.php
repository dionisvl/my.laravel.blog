@extends('shop.layout')

@section('content')
    <!--main content start-->
    <main class="mn-content">
        <div class="container c-gui-article ">
            <div class="c-card ">
                <div class="row">
                    <div class="col-sm-12 col-md-11">
                        <div class="breadcrumb-wrap">
                            <ol class="list_float breadcrumb">
                                <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
                                    <a href="/" itemprop="url">
                                        <span itemprop="title">Главная</span></a>
                                </li>
                                <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
                                    <span itemprop="title">{{$product->title}}</span>
                                </li>
                            </ol>
                        </div>
                        <div class="c-card-view">
                            <div class="c-card-view__header">
                                <h2 class="h2">{{$product->title}}</h2>
                                <span class="hidden-xs">{{$product->composition}}</span>
                            </div>
                            <div class="c-card-view__body">
                                <img src="{{$product->getImage('detail_picture')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="c-card-desc">
                            <h1 class="c-card-desc__ttl h1">{{$product->title}}@if ($product->manufacturer){{$product->manufacturer}}@endif</h1>
                            <div class="c-card-desc__body">
                                <div class="c-card-desc__top">
                                    <div class="e-stars">
                                        <i class="active"></i>
                                        <i class="active"></i>
                                        <i class="active"></i>
                                        <i class="active"></i>
                                        <i class="active"></i>
                                    </div>
                                    <div class="c-card-desc__price">Цена: {{$product->price}} р.</div>
                                    <form action method=POST class=add_to_cart_form>
                                        <input type=hidden name=itemId value={{$product->id}}>
                                        <input type=hidden name=itemCount value=1>
                                        <input type=hidden name=itemTitle value="{{$product->title}}">
                                        <input type=hidden name=itemPrice value={{$product->price}}>
                                        <input type=hidden name=itemImg
                                               value="{{$product->getImage('preview_picture')}}">
                                        <input type=hidden name=itemSrc value={{route('product.show', $product->slug)}}>
                                        @if ($product->balance > 0)
                                            <button class="btn btn_sm hidden-sm hidden-xs add_to_cart"
                                                    data-name=".Red Wasp.">
                                                <i class="ico ico-thumb-busket-sm "></i><span>Купить</span></button>
                                        @else
                                            <button disabled
                                                    class="btn btn_sm hidden-sm hidden-xs add_to_cart inactive">
                                                <span>Нет в наличии</span>
                                            </button>
                                        @endif


                                    </form>
                                </div>
                                <ul class="list c-card-desc__list">
                                    <li>
                                        <b>Производитель: </b><span>{{$product->manufacturer}}</span>
                                    </li>


                                    <li><b>Объем: </b><span>{{$product->size}}</span></li>
                                </ul>

                                <div class="h3">Преимущества:</div>
                                {!! $product->features !!}

                                <div class="h3">Доставка:</div>
                                {!! $product->delivery !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div itemscope itemtype="http://schema.org/Product" style="display:none;">
                <p itemprop="name">{{$product->title}}</p>


                <img src="{{$product->getImage('preview_picture')}}" itemprop="image" alt="{{$product->title}}">

                <div itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
                    <span itemprop="lowPrice">{{$product->price}}</span>
                    <meta itemprop="priceCurrency" content="RUB">


                    <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        <span itemprop="ratingValue">5</span>
                        <span itemprop="reviewCount">1436</span>
                        <span itemprop="worstRating">1</span>
                        <span itemprop="bestRating">5</span>
                    </div>


                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="price" content="{{$product->price}}">
                        <meta itemprop="priceCurrency" content="RUB">
                        <link itemprop="availability" href="http://schema.org/OutOfStock">
                        <link itemprop="itemCondition" href="http://schema.org/NewCondition">
                    </div>
                    <div>
                        <link itemprop="acceptedPaymentMethod"
                              href="http://purl.org/goodrelations/v1#ByBankTransferInAdvance">
                        <link itemprop="acceptedPaymentMethod" href="http://purl.org/goodrelations/v1#Cash">
                    </div>
                </div>
                <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                    <span itemprop="ratingValue">5</span>
                    <span itemprop="reviewCount">1</span>
                </div>

            </div>

        </div>

        {!! $product->detail_text !!}

        <div class="container"></div>

        <div class="container linked_goods">

            <div class="catalog-page__catalog-block">
                <div class="row row_inline">
                    <div class="col-md-6 col-sm-8 col-xs-12 col-xx-24" id="bx_3966226736_54">
                        <div class="c-thumb">
                            <div class="c-thumb__header">
                                <div class="c-thumb__ttl">предтрен Психотик</div>
                                <span>  Предтреник</span>
                            </div>
                            <div class="c-thumb__img">
                                <a href="../insane-labz-psychotic/index.html">
                                    <img
                                        src="../upload/resize_cache/iblock/63c/200_177_1/63c1280f7f03fa30d909ef26c3c6c587.png"
                                        alt="" height="177">
                                </a>
                            </div>
                            <div class="c-thumb__price">
                                <span>Цена: <span class="js_price">2300 </span> руб</span>
                            </div>
                            <div class="c-thumb__btn-group">
                                <form
                                    action="https://innovativebase.ru/bitrix/templates/innovativebase/ajax/basket/put_offers_in_basket.php"
                                    method="POST" class="add_to_cart_form">
                                    <input type="hidden" name="product_id" value="54">
                                    <input type="hidden" name="quantity" value="1">
                                    <a href="index.html#" class="btn btn_xs add_to_cart" data-name="предтрен Психотик">
                                        <span class="ico ico-thumb-busket"></span>
                                        <span>В корзину</span>
                                    </a>
                                </form>
                                <a href="../insane-labz-psychotic/index.html" class="btn btn_xs btn_bd">
                                    <span>Подробнее</span>
                                </a>
                            </div>
                            <ul class="list c-thumb__list">
                                <li>Улучшает силовые</li>
                                <li>Идеален для секса</li>
                                <li>Притупляет боль</li>
                                <li>Максимум энергии</li>
                            </ul>
                        </div>
                    </div>
                    <div itemscope itemtype="http://schema.org/Product" style="display:none;">
                        <p itemprop="name">предтрен Психотик</p>


                        <img src="../upload/resize_cache/iblock/63c/200_177_1/63c1280f7f03fa30d909ef26c3c6c587.png"
                             itemprop="image">

                        <div itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
                            <span itemprop="lowPrice">2300</span>
                            <meta itemprop="priceCurrency" content="RUB">


                            <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                <span itemprop="ratingValue">5</span>
                                <span itemprop="reviewCount">1436</span>
                                <span itemprop="worstRating">1</span>
                                <span itemprop="bestRating">5</span>
                            </div>


                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <meta itemprop="price" content="2300">
                                <meta itemprop="priceCurrency" content="RUB">
                                <link itemprop="availability" href="http://schema.org/InStock">
                                <link itemprop="itemCondition" href="http://schema.org/NewCondition">
                            </div>
                            <div>
                                <link itemprop="acceptedPaymentMethod"
                                      href="http://purl.org/goodrelations/v1#ByBankTransferInAdvance">
                                <link itemprop="acceptedPaymentMethod" href="http://purl.org/goodrelations/v1#Cash">
                            </div>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Олег</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">5</span>
                            </div>
                            <p itemprop="reviewBody">Штука сильная, больше всего в ней нравится что просыпаешься
                                мгновенно и настроение по кайфу</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Алена</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">5</span>
                            </div>
                            <p itemprop="reviewBody">С ним работаешь ударно, настроение отличное. средне пампит. и самое
                                важное, что отходняк вечерний не резкий и нормально засыпаешь.</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Макс</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">5</span>
                            </div>
                            <p itemprop="reviewBody">С ним пробежка с 10ки становится пятнашкой, после силовые тоже
                                максимум выжимаешь.Очень толковая штука особенно помогла мне на сдаче нормативов по физ
                                подготовке. С черпака заряжает примерно на 5 часов. К вечеру усталость постепенно
                                накатывает. Еще настроение душевное с предтреном Psychotic</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Ибрагим</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">4</span>
                            </div>
                            <p itemprop="reviewBody">Лютая вещь. Главное целый черпак не пить. У меня мотор от него чуть
                                не охренел. Начинайте с половины. В начале трясло с него и тошнило. Позже меньше
                                попробовал и процесс пошел. Становишься немного злее. Энергии как его не пей все равно
                                будет слишком много. Плюс с ним в конце трени усталости нету. Ближе к вечеру отпускать
                                начинает и спокойно засыпаешь</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Маша</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">2</span>
                            </div>
                            <p itemprop="reviewBody">Мне не подошел, трясет от него. Как его люди пьют не понимаю?</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Дима</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">5</span>
                            </div>
                            <p itemprop="reviewBody">Годнота, еба***ь с ним как проклятый</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Стас</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">5</span>
                            </div>
                            <p itemprop="reviewBody">В клуб вечерком сходить и закинуться психотиком самое то. Особенно
                                когда за рулем и пить нельзя. Болтаешь весилишься. И даже если настроение не очень,
                                после черпака прикалываешься и угораешь как все</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Анна</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">5</span>
                            </div>
                            <p itemprop="reviewBody">Принимаю психотик уже второй год. Альтернативы для себя за это
                                время так и не нашла. В сша запретили герань, но псих по прежнему тот же самый и не
                                меняется. Это радует</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Александр</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">5</span>
                            </div>
                            <p itemprop="reviewBody">Рабочий предтрен</p>
                        </div>
                        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                            <span itemprop="author">Кирилл</span>
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <span itemprop="ratingValue">5</span>
                            </div>
                            <p itemprop="reviewBody">Очень жесткий предтрен. Пить максимум половинку. Силы мгновенно
                                появляются, усталость улетучивается. Музыку по кайфу с ним слушать. Попробовал вместе с
                                девушкой немного его выпить, траходром начался, бедная кровать. Я теперь даже не знаю,
                                тля зала он или все же для развлечений?</p>
                        </div>
                        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            <span itemprop="ratingValue">5</span>
                            <span itemprop="reviewCount">2</span>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-8 col-xs-12 col-xx-24" id="bx_3966226736_196">
                        <div class="c-thumb">
                            <div class="c-thumb__header">
                                <div class="c-thumb__ttl">Total War Redcon1</div>
                                <span>  Предтреник, памп, 395г</span>
                            </div>
                            <div class="c-thumb__img">
                                <a href="../total-war-redcon1/index.html">
                                    <img
                                        src="../upload/resize_cache/iblock/619/200_177_1/61979bc87dde70b2e2dd90b124578df8.jpg"
                                        alt="" height="177">
                                </a>
                            </div>
                            <div class="c-thumb__price">
                                <span>Цена: <span class="js_price">2890 </span> руб</span>
                            </div>
                            <div class="c-thumb__btn-group">
                                                    <span class="add_to_cart_form" style="cursor: default;">
                                        <span class="btn btn_xs inactive" style="cursor: default;">
                                            <span>Нет в наличии</span>
                                        </span>
                                    </span>
                                <a href="../total-war-redcon1/index.html" class="btn btn_xs btn_bd">
                                    <span>Подробнее</span>
                                </a>
                            </div>
                            <ul class="list c-thumb__list">
                                <li>Для парней и девушек</li>
                                <li>Эйфория</li>
                                <li>Для жесткого секса</li>
                                <li>Можно пить вечером</li>
                            </ul>
                        </div>
                    </div>
                    <div itemscope itemtype="http://schema.org/Product" style="display:none;">
                        <p itemprop="name">Total War Redcon1</p>


                        <img src="../upload/resize_cache/iblock/619/200_177_1/61979bc87dde70b2e2dd90b124578df8.jpg"
                             itemprop="image">

                        <div itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
                            <span itemprop="lowPrice">2890</span>
                            <meta itemprop="priceCurrency" content="RUB">


                            <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                <span itemprop="ratingValue">5</span>
                                <span itemprop="reviewCount">1436</span>
                                <span itemprop="worstRating">1</span>
                                <span itemprop="bestRating">5</span>
                            </div>


                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <meta itemprop="price" content="2890">
                                <meta itemprop="priceCurrency" content="RUB">
                                <link itemprop="availability" href="http://schema.org/OutOfStock">
                                <link itemprop="itemCondition" href="http://schema.org/NewCondition">
                            </div>
                            <div>
                                <link itemprop="acceptedPaymentMethod"
                                      href="http://purl.org/goodrelations/v1#ByBankTransferInAdvance">
                                <link itemprop="acceptedPaymentMethod" href="http://purl.org/goodrelations/v1#Cash">
                            </div>
                        </div>
                        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            <span itemprop="ratingValue">5</span>
                            <span itemprop="reviewCount">1</span>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-8 col-xs-12 col-xx-24" id="bx_3966226736_116">
                        <div class="c-thumb">
                            <div class="c-thumb__header">
                                <div class="c-thumb__ttl">..Mesomorph..</div>
                                <span>  Предтреник</span>
                            </div>
                            <div class="c-thumb__img">
                                <a href="../mesomorph/index.html">
                                    <img
                                        src="../upload/resize_cache/iblock/312/200_177_1/3128738e1550c6a851d64451aea4f445.jpg"
                                        alt="" height="177">
                                </a>
                            </div>
                            <div class="c-thumb__price">
                                <span>Цена: <span class="js_price">2900 </span> руб</span>
                            </div>
                            <div class="c-thumb__btn-group">
                                                    <span class="add_to_cart_form" style="cursor: default;">
                                        <span class="btn btn_xs inactive" style="cursor: default;">
                                            <span>Нет в наличии</span>
                                        </span>
                                    </span>
                                <a href="../mesomorph/index.html" class="btn btn_xs btn_bd">
                                    <span>Подробнее</span>
                                </a>
                            </div>
                            <ul class="list c-thumb__list">
                                <li>Здоровенная банка</li>
                                <li>Для новичков</li>
                                <li>Без герани</li>
                                <li>Экстра силовые</li>
                            </ul>
                        </div>
                    </div>
                    <div itemscope itemtype="http://schema.org/Product" style="display:none;">
                        <p itemprop="name">..Mesomorph..</p>


                        <img src="../upload/resize_cache/iblock/312/200_177_1/3128738e1550c6a851d64451aea4f445.jpg"
                             itemprop="image">

                        <div itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
                            <span itemprop="lowPrice">2900</span>
                            <meta itemprop="priceCurrency" content="RUB">


                            <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                <span itemprop="ratingValue">4</span>
                                <span itemprop="reviewCount">1436</span>
                                <span itemprop="worstRating">1</span>
                                <span itemprop="bestRating">5</span>
                            </div>


                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <meta itemprop="price" content="2900">
                                <meta itemprop="priceCurrency" content="RUB">
                                <link itemprop="availability" href="http://schema.org/OutOfStock">
                                <link itemprop="itemCondition" href="http://schema.org/NewCondition">
                            </div>
                            <div>
                                <link itemprop="acceptedPaymentMethod"
                                      href="http://purl.org/goodrelations/v1#ByBankTransferInAdvance">
                                <link itemprop="acceptedPaymentMethod" href="http://purl.org/goodrelations/v1#Cash">
                            </div>
                        </div>
                        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            <span itemprop="ratingValue">4</span>
                            <span itemprop="reviewCount">1</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <section class="card-faq-section">
            <div class="container">
                <div class="card-faq-section__cnt">
                    <h2 class="h1 text-center"><b>FAQ. Часто задаваемые вопросы.</b></h2>
                    <p>Сколько по времени пить предтреник?</p>
                    <p><span class="text1" style="font-family: Arial, Helvetica; font-size: 14pt;"></span>
                    <p style="text-align: justify;">
                        <span class="text1" style="font-family: Arial, Helvetica; font-size: 14pt;">Пользоваться предтреником можно в среднем <b>один-два месяца при каждодневном приеме</b>. Потом стоит сделать паузу в несколько недель. Так же стоит держать в уме следующее о предтрениках:</span><br>
                        <span style="font-family: Arial, Helvetica; font-size: 14pt;"> </span><span class="text1"
                                                                                                    style="font-family: Arial, Helvetica; font-size: 14pt;"> </span>
                    </p>
                    <ul>
                        <li><span class="text1" style="font-family: Arial, Helvetica; font-size: 14pt;">Лучше принимать в тяжелые дни</span>
                        </li>
                        <li><span style="font-family: Arial, Helvetica; font-size: 14pt;"> </span><span class="text1"
                                                                                                        style="font-family: Arial, Helvetica; font-size: 14pt;">
	Вызывают привыкание</span></li>
                        <li><span style="font-family: Arial, Helvetica; font-size: 14pt;"> </span><span class="text1"
                                                                                                        style="font-family: Arial, Helvetica; font-size: 14pt;">
	Предтреники содержат стимуляторы (это вредно)</span></li>
                        <li><span style="font-family: Arial, Helvetica; font-size: 14pt;"> </span><span class="text1"
                                                                                                        style="font-family: Arial, Helvetica; font-size: 14pt;">
	Без них можно спокойно жить</span></li>
                    </ul>
                    <span style="font-family: Arial, Helvetica; font-size: 14pt;"> </span><span class="text1"
                                                                                                style="font-family: Arial, Helvetica; font-size: 14pt;">
Например вы устали на работе и не хотите заниматься в зале. Выпили предтрен, желание появилось и вы не прогуляли. Или намечается просто тяжелый день и, чтобы не свалиться от усталости, принимаем предтреник. Вот для чего они служат в первую очередь. Далее идет возможность поднять себе настроение и покрасоваться в зале, но это как по мне вторичные плюсы.</span>
                    <p>
                    </p>
                    <span class="text1" style="font-family: Arial, Helvetica; font-size: 14pt;"></span><br></p><br/>
                </div>
            </div>
        </section>
        <div class="container">


            <form class="c-reviews-form" method="POST" id="add_review_form" enctype="multipart/form-data"
                  action="https://innovativebase.ru/bitrix/templates/innovativebase/ajax/feedback.php">
                <div class="container">
                    <div class="h1">
                        <b>Добавить отзыв</b></div>
                    <input type="hidden" name="PROP[ATT_RPRODUCT]" value="201">
                    <input type="hidden" name="subject" value="Новый отзыв на сайте">
                    <input type="hidden" name="IBLOCK_ID" value="3">
                    <input type="hidden" name="PROP[ATT_RATING]" id="hidden_product_rating" value="1">
                    <div class="form-group max_sm">
                        <div class="form-label">Имя:</div>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group max_sm">
                        <div class="form-label">E-mail:</div>
                        <input type="text" class="form-control" name="email" required>
                    </div>

                    <div class="form-group max_sm">
                        <div class="form-label">Фото:</div>
                        <input type="file" name="file" multiple accept="image/*,image/jpeg">
                    </div>

                    <div class="form-group">
                        <span>Ваша оценка	</span>
                        <div class="e-stars" id="rating_option">
                            <i class="stable"></i>
                            <i></i>
                            <i></i>
                            <i></i>
                            <i></i>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="form-label">Ваш отзыв:</div>
                        <textarea class="form-control" name="PROP[ATT_RECALL]" required></textarea>
                    </div>

                    <div class="form-group form_result">

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn_xlg btn_green">
                            <span>Отправить</span></button>
                    </div>
                </div>
            </form>


        </div>
        </div>
    </main>

    <!-- end main content-->
@endsection
