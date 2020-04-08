let cart_content_container = 'cart_content';
let number_field_frefix = 'basket-item-quantity-';
let priceForOneItemPrefix = 'basket-item-price-';

document.addEventListener("DOMContentLoaded", function () {
    /** Найдем все товары в документе и навесим событие добавления его в корзину */
    let products = document.getElementsByClassName('add_to_cart_form');
    for (let product of products) {
        product.onsubmit = function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            // console.log(formData.get("itemId"));
            addToCart(formData);
            fillCart();
            document.getElementById('modal_product_name').innerHTML = formData.get('itemTitle') + ' добавлен в корзину';
            cart_items_count_recalc();
            $("#modal_basket").modal();
        };
    }

    function clearCart() {
        localStorage.removeItem('cart');
        document.getElementById(cart_content_container).innerHTML = 'Корзина очишена.';
    }


    /** Заполним корзину товарами из localStorage
     * Методы разные из-за разных шаблонов и стилей
     * */
    if (window.location.pathname === '/cart') {
        function fillCart(e) {
            let cartData = getCartData(), totalItems = '';
            if (cartData !== null) {
                for (let itemId in cartData) {
                    let id = cartData[itemId].itemId;
                    let itemPrice = new Intl.NumberFormat('ru-RU').format(cartData[itemId].itemPrice);
                    let itemTitle = cartData[itemId].itemTitle;
                    let itemCount = cartData[itemId].itemCount;
                    let itemImg = cartData[itemId].itemImg;
                    let itemSrc = cartData[itemId].itemSrc;
                    totalItems += `<tr class="basket-items-list-item-container" id="basket-item-${id}"
data-entity="basket-item" data-id="${id}">
<td class="basket-items-list-item-descriptions">
    <div class="basket-items-list-item-descriptions-inner" id="basket-item-height-aligner-${id}">
        <div class="basket-item-block-image">
            <a href="${itemSrc}" class="basket-item-image-link">
                <img class="basket-item-image" alt="${itemTitle}" src="${itemImg}">
            </a>
        </div>
        <div class="basket-item-block-info">
            <span class="basket-item-actions-remove d-block d-md-none" data-entity="basket-item-delete"></span>
            <h2 class="basket-item-info-name">
                <a href="${itemSrc}" class="basket-item-info-name-link">
                    <span data-entity="basket-item-name">${itemTitle}</span>
                </a>
            </h2>
            <div class="basket-item-block-properties"></div>
        </div>
    </div>
</td>
<td class="basket-items-list-item-price basket-items-list-item-price-for-one">
    <div class="basket-item-block-price d-none d-sm-block">
        <div class="basket-item-price-current">
            <span class="basket-item-price-current-text" id="${priceForOneItemPrefix + id}" data-price="${itemPrice}"> ${itemPrice} руб.</span>
        </div>
        <div class="basket-item-price-title"> цена за 1 шт</div>
    </div>
     <span id="total_price_${id}" data-total="${itemPrice}" style="display:none">${itemPrice}</span>
</td>
<td class="basket-items-list-item-amount">
    <div class="basket-item-block-amount" data-entity="basket-item-quantity-block">
        <span class="basket-item-amount-btn-minus" data-entity="basket-item-quantity-minus" data-operator='-' data-item="${id}" onclick="input_calc(this)"></span>
        <div class="basket-item-amount-filed-block">
            <input type="text" class="basket-item-amount-filed" data-entity="basket-item-quantity-field"
             value="${itemCount}" data-value="${itemCount}" data-item="${id}" id="${number_field_frefix + id}">
        </div>
        <span class="basket-item-amount-btn-plus" data-entity="basket-item-quantity-plus" data-operator='+' data-item="${id}" onclick="input_calc(this)"></span>
        <div class="basket-item-amount-field-description"> шт </div>
    </div>
</td>
<td class="basket-items-list-item-remove d-none d-md-block">
    <div class="basket-item-block-actions">
        <span class="basket-item-actions-remove" data-entity="basket-item-delete"></span>
    </div>
</td>
</tr>`;
                }
            }
            document.getElementById(cart_content_container).innerHTML = (totalItems) ? totalItems : 'В корзине пусто!';
            return false;
        }
    } else {
        function fillCart(e) {
            let cartData = getCartData(), totalItems = '';
            if (cartData !== null) {
                for (let itemId in cartData) {
                    let id = cartData[itemId].itemId;
                    let price = cartData[itemId].itemPrice;
                    let name = cartData[itemId].itemTitle;
                    let itemCount = cartData[itemId].itemCount;
                    let itemImg = cartData[itemId].itemImg;
                    let itemSrc = cartData[itemId].itemSrc;
                    // console.log(name);
                    totalItems += `<div class="modal__basket__item modal__basket__product" id="basket_item_${id}">
    <div class="img">
    <img src="${itemImg}" alt="${name}"></div>
    <div class="desc">
        <a href="${itemSrc}" style='color:black'>
            <b>${name}</b>
        </a>
        <div class="item-group">
            <div class="ttl">Кол-во</div>
            <div class="e-count">
                <i class="minus" data-operator='-' data-item="${id}" onclick="input_calc(this)"></i>
                <input type="text" data-item="${id}" value="${itemCount}" id="${number_field_frefix + id}">
                <i class="plus" data-operator='+' data-item="${id}" onclick="input_calc(this)"></i>
            </div>
            <i class="ico ico-remove" data-item="${id}" onclick="remove_from_cart(this)"></i>
    </div>
        <span class="js_current_price"><span id="${priceForOneItemPrefix + id}" data-price="${price}">${price}</span>р.</span>
        <div class="item-group">
            <div class="ttl">Цена:</div>
            <div class="i_desc">
                <span class="js_price" id="total_price_${id}" data-total="${price}">${price}</span>р.
            </div>
        </div>
    </div>
</div>`;
                }
            }
            document.getElementById(cart_content_container).innerHTML = (totalItems) ? totalItems : 'В корзине пусто!';
            return false;
        }
    }

    fillCart(); //заполняем корзину если мы на странице главной корзины "/cart"
});

function cart_items_count_recalc() {
    document.getElementById('modal_basket_counter').innerHTML = document.querySelectorAll('.modal__basket__product').length;
}

/** добавление товара в объект "корзина" учитывая localStorage*/
function addToCart(formData) {
    let itemId = formData.get("itemId");
    let cartData = getCartData() || {};
    // console.log('first get cartada:');
    // console.log(cartData);
    if (cartData.hasOwnProperty(itemId)) {
        cartData[itemId].itemCount = parseInt(cartData[itemId].itemCount) + parseInt(1);
    } else {
        cartData[itemId] = {
            itemId: itemId,
            itemTitle: formData.get("itemTitle"),
            itemPrice: formData.get("itemPrice"),
            itemCount: formData.get("itemCount"),
            itemImg: formData.get("itemImg"),
            itemSrc: formData.get("itemSrc")
        }
    }
    if (!setCartData(cartData)) {
    }
    return false;
}

/* удалим элемент из localstorage*/
function removeItemCartData(itemId) {
    let cartData = getCartData();
    if (cartData !== null) {
        for (let id in cartData) {
            if (id === itemId) {
                delete cartData[id];
                setCartData(cartData)
            }
        }
    }
    return false;
}

/* установим количество элементу в localstorage*/
function setCountItemCartData(itemId, itemCount) {
    let cartData = getCartData();
    if (cartData !== null) {
        for (let id in cartData) {
            if (id === itemId) {
                cartData[id].itemCount = itemCount;
                // console.log(cartData);
                setCartData(cartData);
            }
        }
    }
    return false;
}

function getCartData() {
    return JSON.parse(localStorage.getItem('cart'));
}

function setCartData(o) {
    localStorage.setItem('cart', JSON.stringify(o));
    return false;
}

/** Кнопка плюс/минус в корзине у каждого товара */
function input_calc(element) {
    let id = element.dataset.item;
    let operator = element.dataset.operator;
    let input = document.getElementById(number_field_frefix + id);
    if (operator === '-') {
        if (parseInt(input.value) <= 1) {
            return;
        }
        input.value = parseInt(input.value) - 1;
    } else {
        input.value = parseInt(input.value) + 1;
    }
    cart_item_price_recalc(id);
    cart_price_recalc();
    cart_items_count_recalc();
    setCountItemCartData(id, input.value);
}

/** Удалим товар из корзины */
function remove_from_cart(element) {
    let id = element.dataset.item;
    id = 'basket_item_' + id;
    // console.log(id);
    let node = document.getElementById(id);
    node.remove();
    cart_price_recalc();
    cart_items_count_recalc();
    removeItemCartData(element.dataset.item);
}

/** Пересчитать цену этого товара на основе его количества в корзине*/
function cart_item_price_recalc(id) {
    let totalPrice = document.getElementById('total_price_' + id);
    let count = document.getElementById(number_field_frefix + id).value;
    let priceForOneItem = document.getElementById(priceForOneItemPrefix + id).dataset.price;
    let newTotalPrice = priceForOneItem * count;
    totalPrice.dataset.total = newTotalPrice;
    totalPrice.innerHTML = newTotalPrice;
}

/** Пересчитать сумму всего заказа на основе количества и цен выбранных товаров */
function cart_price_recalc() {
    let newTotalPrice = 0;
    let total_prices = document.querySelectorAll('[data-total]');
    for (let i = 0; i < total_prices.length; i++) {
        newTotalPrice += parseInt(total_prices[i].dataset.total);
    }
    document.getElementById('modal_basket_total').innerHTML = newTotalPrice;
}

/** Оформление заказа */
if (document.getElementById('order_form')) {
    document.getElementById('order_form').onsubmit = function (event) {
        event.preventDefault();
        let url = this.getAttribute('action');
        let submit = document.querySelectorAll('.basket-btn-checkout');
        let formData = new FormData(this);
        submit[0].innerHTML = '';
        submit[0].append('Загрузка...');
        submit[0].setAttribute('disabled', 'true');
        return fetch(url, {
            method: 'POST',
            body: formData  //data
        })
            .then(response => response.json())
            .then(data => {
                if (data['status'] === true) {
                    submit[0].innerHTML = '';
                    submit[0].append(data.msg);
                    submit[0].setAttribute('disabled', 'true');
                    window.top.location = "/thankyou_page/";
                } else {
                    console.log(data);// Prints result from `response.json()` in getRequest
                }
            })
            .catch(error => console.error(error))
    };
}

