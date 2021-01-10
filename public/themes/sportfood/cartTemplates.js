export function modalCartTemplate(cartData) {
    return `<div class="modal__basket__item modal__basket__product" id="basket_item_${cartData.itemId}">
    <div class="img">
    <img src="${cartData.itemImg}" alt="${cartData.itemTitle}"></div>
    <div class="desc">
        <a href="${cartData.itemSrc}" style='color:black'>
            <b>${cartData.itemTitle}</b>
        </a>
        <div class="item-group">
            <div class="ttl">Кол-во</div>
            <div class="e-count">
                <i class="minus" data-operator='-' data-item="${cartData.itemId}" onclick="input_calc(this)"></i>
                <input type="text" data-item="${cartData.itemId}" value="${cartData.itemCount}" id="${number_field_prefix + cartData.itemId}">
                <i class="plus" data-operator='+' data-item="${cartData.itemId}" onclick="input_calc(this)"></i>
            </div>
            <i class="ico ico-remove" data-item="${cartData.itemId}" onclick="remove_from_cart(this)"></i>
    </div>
        <span class="js_current_price">
        <span id="${priceForOneItemPrefix + cartData.itemId}" data-price="${cartData.itemPrice}">${cartData.itemPrice}</span>р.
        </span>
        <div class="item-group">
            <div class="ttl">Цена:</div>
            <div class="i_desc">
                <span class="js_price" id="total_price_${cartData.itemId}" data-total="${cartData.itemPrice}">${cartData.itemPrice}</span>р.
            </div>
        </div>
    </div>
</div>`
}

export function checkoutCartTemplate(cartData) {
    let id = cartData.itemId;
    let itemPrice = new Intl.NumberFormat('ru-RU').format(cartData.itemPrice);
    let itemTitle = cartData.itemTitle;
    let itemCount = cartData.itemCount;
    let itemImg = cartData.itemImg;
    let itemSrc = cartData.itemSrc;
    return `<tr class="basket-items-list-item-container" id="basket-item-${id}"
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
             value="${itemCount}" data-value="${itemCount}" data-item="${id}" id="${number_field_prefix + id}">
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
