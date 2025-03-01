import {
  modalCartTemplate,
  checkoutCartTemplate,
} from './cartTemplates.js'

document.addEventListener('DOMContentLoaded', function () {
  /** Найдем все товары в документе и навесим событие добавления его в корзину */
  let products = document.getElementsByClassName('add_to_cart_form')

  for (let product of products) {
    product.onsubmit = function (event) {
      event.preventDefault()
      let formData = new FormData(this)

      addToCart(formData)
      fillCart()
      document.getElementById('modal_product_name').innerHTML = formData.get('itemTitle') + ' добавлен в корзину'
      cart_items_count_recalc()
      $('#modal_basket').modal()
    }
  }

  function clearCart () {
    localStorage.removeItem('cart')
    document.getElementById(cart_content_container).innerHTML = 'Корзина очишена.'
  }

  /**
   * Заполним корзину товарами из localStorage
   * Методы разные из-за разных шаблонов и стилей
   */
  function fillCart () {
    let cartData = getCartData(), totalItems = ''
    if (cartData !== null) {
      for (let itemId in cartData) {
        if (cartData.hasOwnProperty(itemId)) {
          if (window.location.pathname === '/shop/cart') {
            totalItems += checkoutCartTemplate(cartData[itemId])
          } else {
            totalItems += modalCartTemplate(cartData[itemId])
          }
        }
      }
    }

    document.getElementById(cart_content_container).innerHTML = (totalItems) ? totalItems : 'В корзине пусто!'
    return false
  }

  fillCart() //заполняем корзину если мы на странице главной корзины "/cart"
  cart_price_recalc() // заполним поле "Итого товаров На сумму"
})

/** добавление товара в объект "корзина" учитывая localStorage */
function addToCart (formData) {
  let itemId = formData.get('itemId')
  let cartData = getCartData() || {}
  if (cartData.hasOwnProperty(itemId)) {
    cartData[itemId].itemCount = parseInt(cartData[itemId].itemCount) + parseInt(1)
  } else {
    cartData[itemId] = {
      itemId: itemId,
      itemTitle: formData.get('itemTitle'),
      itemPrice: formData.get('itemPrice'),
      itemCount: formData.get('itemCount'),
      itemImg: formData.get('itemImg'),
      itemSrc: formData.get('itemSrc')
    }
  }
  if (!setCartData(cartData)) {
  }
  return false
}

/** Оформление заказа */
if (document.getElementById('order_form')) {
  document.getElementById('order_form').onsubmit = function (event) {
    event.preventDefault()
    let url = this.getAttribute('action')
    let submit = document.querySelectorAll('.basket-btn-checkout')

    let formData = new FormData(this)
    let formDataJson = JSON.stringify(Object.fromEntries(formData))

    submit[0].innerHTML = ''
    submit[0].append('Загрузка...')
    // submit[0].setAttribute('disabled', 'true');

    postData(url, formDataJson)
      .then((data) => {
        console.log(data) // JSON data parsed by `response.json()` call
        submit[0].innerHTML = data.result.message
        alert(data.result.message + ' Номер заказа: ' + data.result.order_id)
      })
  }
}

// Пример отправки POST запроса:
async function postData (url = '', data = {}) {
  // console.log(url);
  // console.log(data);
  let csrf = $('meta[name="csrf-token"]').attr('content')
  // console.log(csrf);

  // Default options are marked with *
  const response = await fetch(url, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrf
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *client
    body: JSON.stringify(data) // body data type must match "Content-Type" header
  })

  return await response.json() // parses JSON response into native JavaScript objects
}


