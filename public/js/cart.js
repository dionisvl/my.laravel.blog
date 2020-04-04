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
        document.getElementById('cart_content').innerHTML = 'Корзина очишена.';
    }
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

/** Заполним корзину товарами из localStorage */
function fillCart(e) {
    let cartData = getCartData(), totalItems = '';
    if (cartData !== null) {
        totalItems = '';
        for (let itemId in cartData) {
            let id = cartData[itemId].itemId;
            let price = cartData[itemId].itemPrice;
            let name = cartData[itemId].itemTitle;
            let itemCount = cartData[itemId].itemCount;
            let itemImg = cartData[itemId].itemImg;
            let itemSrc = cartData[itemId].itemSrc;
            // console.log(name);
            totalItems += `
                <div class="modal__basket__item modal__basket__product" id="basket_item_${id}">
    <div class="img">
    <img src="${itemImg}" alt="${name}"></div>
    <div class="desc">
        <a href="${itemSrc}" style='color:black'>
            <b>${name}</b>
        </a>
        <div class="item-group">
            <div class="ttl">Кол-во</div>
            <div class="e-count">
                <i class="minus input_calc" data-operator='-' data-item="${id}" onclick="input_calc(this)"></i>
                <input type="text" data-item="${id}" value="${itemCount}" id="NUMBER_FIELD_${id}">
                <i class="plus input_calc" data-operator='+' data-item="${id}" onclick="input_calc(this)"></i>
            </div>
            <i class="ico ico-remove" data-item="${id}" onclick="remove_from_cart(this)"></i>
    </div>
        <span class="js_current_price"><span id="price_${id}" data-price="${price}">${price}</span>р.</span>
        <div class="item-group">
            <div class="ttl">Цена:</div>
            <div class="i_desc">
                <span class="js_price total_span" id="total_price_${id}" data-total="${price}">${price}</span>р.
            </div>
        </div>
    </div>
</div>
                `;
        }
        document.getElementById('cart_content').innerHTML = totalItems;
    } else {
        document.getElementById('cart_content').innerHTML = 'В корзине пусто!';
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
                console.log(cartData);
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


/** Пересчет цен в корзине/заказе */
let minuses = document.getElementsByClassName("input_calc");
for (let i = 0; i < minuses.length; i++) {
    minuses[i].addEventListener('click', input_calc, false);
}

/** Кнопка плюс/минус в корзине у каждого товара */
function input_calc(element) {
    let id = element.dataset.item;
    let operator = element.dataset.operator;
    let input = document.getElementById('NUMBER_FIELD_' + id);
    if (operator === '-') {
        if (parseInt(input.value) === 0) {
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
    let count = document.getElementById('NUMBER_FIELD_' + id).value;
    let one_price = document.getElementById('price_' + id).dataset.price;
    let newTotalPrice = one_price * count;
    totalPrice.dataset.total = newTotalPrice;
    totalPrice.innerHTML = newTotalPrice;
}

/** Пересчитать сумму всего заказа на основе количества и цен выбранных товаров */
function cart_price_recalc() {
    let newTotalPrice = 0;
    let total_prices = document.getElementsByClassName('total_span');
    for (let i = 0; i < total_prices.length; i++) {
        newTotalPrice += parseInt(total_prices[i].dataset.total);
    }
    document.getElementById('modal_basket_total').innerHTML = newTotalPrice;
}

