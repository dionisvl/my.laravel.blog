@extends('shop.layout')

@section('content')

<link href=/themes/sportfood/basketNew.css rel=stylesheet>
<main class="mn-content">
    <div class="container c-gui-article ">
        <h1>Корзина</h1>
        <div class="breadcrumb-wrap">
            <ol class="list_float breadcrumb">
                <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url">
                        <span itemprop="title">Главная</span></a>
                </li>
                <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title">Корзина</span>
                </li>
            </ol>
        </div>
        <br>
        <div id="basket-root" class="bx-basket bx-blue bx-step-opacity" style="opacity: 1;">
            <div class="row">
                <div class="col">
                    <div class="alert alert-warning alert-dismissable" id="basket-warning" style="display: none;">
                        <span class="close" data-entity="basket-items-warning-notification-close">×</span>
                        <div data-entity="basket-general-warnings" style="display: none;"></div>
                        <div data-entity="basket-item-warnings" style="display: none;">
                            В вашей корзине <a href="javascript:void(0)"
                                               data-entity="basket-items-warning-count"></a> требует внимания.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div
                        class="mb-3 basket-items-list-wrapper basket-items-list-wrapper-height-fixed basket-items-list-wrapper-light"
                        id="basket-items-list-wrapper">
                        <div class="basket-items-list-header" data-entity="basket-items-list-header">
                            <div class="basket-items-search-field" data-entity="basket-filter">
                                <div class="form input-group">
                                    <input type="text" class="form-control" placeholder="Фильтр"
                                           data-entity="basket-filter-input">
                                </div>
                                <button class="basket-items-search-clear-btn" type="button"
                                        data-entity="basket-filter-clear-btn">×
                                </button>
                            </div>
                            <div class="basket-items-list-header-filter">
                                <a href="javascript:void(0)" class="basket-items-list-header-filter-item active"
                                   data-entity="basket-items-count" data-filter="all" style="">В корзине 2
                                    товара</a>
                                <a href="javascript:void(0)" class="basket-items-list-header-filter-item"
                                   data-entity="basket-items-count" data-filter="similar"
                                   style="display: none;"></a>
                                <a href="javascript:void(0)" class="basket-items-list-header-filter-item"
                                   data-entity="basket-items-count" data-filter="warning"
                                   style="display: none;"></a>
                                <a href="javascript:void(0)" class="basket-items-list-header-filter-item"
                                   data-entity="basket-items-count" data-filter="delayed"
                                   style="display: none;"></a>
                                <a href="javascript:void(0)" class="basket-items-list-header-filter-item"
                                   data-entity="basket-items-count" data-filter="not-available"
                                   style="display: none;"></a>
                            </div>
                        </div>
                        <div class="basket-items-list-container" id="basket-items-list-container">
                            <div class="basket-items-list-overlay" id="basket-items-list-overlay"
                                 style="display: none;"></div>
                            <div class="basket-items-list" id="basket-item-list">
                                <div class="basket-search-not-found" id="basket-item-list-empty-result"
                                     style="display: none;">
                                    <div class="basket-search-not-found-icon"></div>
                                    <div class="basket-search-not-found-text">По данному запросу товаров не
                                        найдено
                                    </div>
                                </div>
                                <table class="basket-items-list-table" id="basket-item-table">
                                    <tbody id="cart_content">
                                    {{-- Вот тут будут автоматически заполняться товары методом fillCart()--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="order_row">
                <form action="/shop/cart/order" id="order_form">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Ваше имя*:</label>
                            <input type="text" class="form-control" id="title" name="title" required>

                            <label for="phone">Телефон*:</label>
                            <input type="tel" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="notes">Примечания к заказу:</label>
                            <textarea name="notes" id="notes" cols="50" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                </form>

            </div>
            <div class="row">
                <div class="col" data-entity="basket-total-block">
                    <div class="basket-checkout-container" data-entity="basket-checkout-aligner">
                        <div class="basket-checkout-section">
                            <div class="basket-checkout-section-inner justify-content-between">
                                <div class="basket-checkout-block basket-checkout-block-total">
                                    <div class="basket-checkout-block-total-inner">
                                        <div class="basket-checkout-block-total-title">Итого:</div>
                                        <div class="basket-checkout-block-total-description">
                                        </div>
                                    </div>
                                </div>
                                <div class="basket-checkout-block basket-checkout-block-total-price">
                                    <div class="basket-checkout-block-total-price-inner">
                                        <div class="basket-coupon-block-total-price-current"
                                             data-entity="basket-total-price" id="modal_basket_total">0
                                        </div>
                                        руб.
                                    </div>
                                </div>
                                <div class="basket-checkout-block basket-checkout-block-btn">
                                    <button id="submit" form="order_form"
                                            class="btn btn-lg btn-primary basket-btn-checkout"
                                            data-entity="basket-checkout-button">
                                        Оформить заказ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
</main>

@endsection
