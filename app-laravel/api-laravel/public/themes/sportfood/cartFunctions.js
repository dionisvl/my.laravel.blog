const cart_content_container = 'cart_content'
const number_field_prefix = 'basket-item-quantity-'
const priceForOneItemPrefix = 'basket-item-price-'

/** Кнопка плюс/минус в корзине у каждого товара */
function input_calc (element) {
  let id = element.dataset.item
  let operator = element.dataset.operator
  let input = document.getElementById(number_field_prefix + id)
  if (operator === '-') {
    if (parseInt(input.value) <= 1) {
      return
    }
    input.value = parseInt(input.value) - 1
  } else {
    input.value = parseInt(input.value) + 1
  }
  cart_item_price_recalc(id)
  cart_price_recalc()
  cart_items_count_recalc()
  setCountItemCartData(id, input.value)
}

/** Пересчитать цену этого товара на основе его количества в корзине*/
function cart_item_price_recalc (id) {
  let totalPrice = document.getElementById('total_price_' + id)
  let count = document.getElementById(number_field_prefix + id).value
  let priceForOneItem = document.getElementById(priceForOneItemPrefix + id).dataset.price.replace(/\s+/g, '')
  let newTotalPrice = priceForOneItem * count
  totalPrice.dataset.total = newTotalPrice
  totalPrice.innerHTML = newTotalPrice
}

/** Пересчитать сумму всего заказа на основе количества и цен выбранных товаров */
function cart_price_recalc () {
  let newTotalPrice = 0
  let total_prices = document.querySelectorAll('[data-total]')

  for (let i = 0; i < total_prices.length; i++) {
    newTotalPrice += parseInt(total_prices[i].dataset.total.replace(/\s+/g, ''))
  }

  document.getElementById('modal_basket_total').innerHTML = newTotalPrice.toString()
}

function cart_items_count_recalc () {
  document.getElementById('modal_basket_counter').innerHTML = document.querySelectorAll('.modal__basket__product').length
}

/* установим количество элементов в localstorage */
function setCountItemCartData (itemId, itemCount) {
  let cartData = getCartData()
  if (cartData !== null) {
    for (let id in cartData) {
      if (id === itemId) {
        cartData[id].itemCount = itemCount
        // console.log(cartData);
        setCartData(cartData)
      }
    }
  }
  return false
}

function getCartData () {
  return JSON.parse(localStorage.getItem('cart'))
}

function setCartData (o) {
  localStorage.setItem('cart', JSON.stringify(o))
  return false
}

/** Удалим товар из корзины */
function remove_from_cart (element) {
  let id = element.dataset.item
  id = 'basket_item_' + id
  // console.log(id);
  let node = document.getElementById(id)
  node.remove()
  cart_price_recalc()
  cart_items_count_recalc()
  removeItemCartData(element.dataset.item)
}

/** удалим элемент из localstorage */
function removeItemCartData (itemId) {
  let cartData = getCartData()
  if (cartData !== null) {
    for (let id in cartData) {
      if (id === itemId) {
        delete cartData[id]
        setCartData(cartData)
      }
    }
  }
  return false
}
