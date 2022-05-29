require('./bootstrap');
window.Swal =require("sweetalert2");

// let productLists = document.getElementById('product-lists');
// let productItem = document.querySelectorAll('.product-item');
// let quantityMinus = document.querySelectorAll('.quantityMinus');
// let productModalQuantity = document.querySelectorAll('.productModalQuantity');
// let productModalPriceWithQuantity = document.querySelectorAll('.productModalPriceWithQuantity');
//
// quantityPlus.forEach(function (onePlus){
//     onePlus.addEventListener('click',function (){
//         productModalQuantity.forEach(function (quantity){
//             quantity.valueAsNumber += 1;
//             // let currentPrice = Number(quantity.getAttribute("price"));
//            console.log(Number(quantity.getAttribute("price")));
//             productModalPriceWithQuantity.forEach(function (productQuantityPrice){
//
//             })
//         })
//
//     })
// })
//
// function quantityInc(event){
//     let cartContent = document.getElementsByClassName('cart-content')[0];
//     let quantityPlus = document.querySelectorAll('.quantityPlus');
//     for(let i=0;i < quantityPlus.length;i++){
//         console.log(i);
//     }
// }
// quantityInc();
//
//
// function calcCost(){
//     currentPrice = Number(productModalQuantity.getAttribute("price"));
//     productModalPrice.innerText = productModalQuantity.valueAsNumber * currentPrice
// }
//
//
//
// // productItem.forEach(function (el){
// //     el.addEventListener('click',function (){
// //         let currentId = el.getAttribute("data-id");
// //             // console.log(el)
// //     })
// // } )







let removeItemFromVoucher = document.getElementsByClassName('remove-list');
console.log(removeItemFromVoucher);
for (let i=0;i < removeItemFromVoucher.length;i++){
    let button = removeItemFromVoucher[i];
    button.addEventListener('click',removeVoucherList);
}
//quantity Changes
let quantityInput = document.getElementsByClassName('quantity-input');
for (let i=0;i < quantityInput.length;i++){
    let input = quantityInput[i];
    input.addEventListener('change',quantityChanged);
}

//add to voucher
let addVoucher = document.getElementsByClassName('add-voucher');
for (let i=0;i < addVoucher.length;i++){
    let button = addVoucher[i];
    button.addEventListener('click',addVoucherClicked);

}

//Buy Button Work
document.getElementsByClassName('checkout-btn')[0].addEventListener('click',buyButtonClicked);

//Buy Button
function buyButtonClicked(){
    alert('Your Order is Placed');
     let voucherLists = document.getElementsByClassName('voucherLists')[0];
     while(voucherLists.hasChildNodes()){
         voucherLists.removeChild(voucherLists.firstChild);
     }
    updatetotal();

}







//remove Item from voucher
function removeVoucherList(event){
    let buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    updatetotal();
}

//quantity Changes
function quantityChanged(event){
    let input = event.target;
    if(isNaN(input.value) || input.value <= 0){
        input.value = 1;
    }
    updatetotal();
}

//add to Voucher
function addVoucherClicked(event){
    let button = event.target;
    let shopProducts = button.parentElement;
    let title = shopProducts.getElementsByClassName('product-name')[0].innerText;
    let price = shopProducts.getElementsByClassName('product-price')[0].innerText;
    let productImage = shopProducts.getElementsByClassName('product-img')[0].src;
   addProductToVoucher(title,price,productImage);
   updatetotal();
}
function addProductToVoucher(title,price,productImage) {
    let voucherListLiTag = document.createElement('li');
    voucherListLiTag.classList.add('voucher-list-item','list-group-item','d-flex','justify-content-between','align-items-center','px-0','pe-1','border-0')
    let voucherLists = document.getElementsByClassName('voucherLists')[0];
    let voucherListNames = voucherLists.getElementsByClassName('voucher-product-name');
    let voucherQuantity = voucherLists.getElementsByClassName('quantity-input');


    for (let i = 0; i < voucherListNames.length; i++) {
        if(voucherListNames[i].innerText == title){
           // alert('you have already add this item to cart')
           voucherQuantity[i].valueAsNumber += 1;
           return;
       }
    }
    let voucherListLiTagContent = `<i class="fas fa-times text-danger remove-list px-2" style="cursor: pointer"></i>
                            <div class="w-50">
                                <h6 class="my-0 text-truncate voucher-product-name">${title}</h6>
                                <small class="text-muted unit-price voucher-product-price" >
                                    ${price}
                                </small>
                            </div>
                            <div class="">
                                <input type="number" class="quantity-input form-control" value="1"  style="width: 100px">
                            </div>
                            <div class="text-muted w-25 voucher-cost text-end">2000</div>`;
    voucherListLiTag.innerHTML = voucherListLiTagContent;
    voucherLists.append(voucherListLiTag);
    voucherListLiTag.getElementsByClassName('remove-list')[0].addEventListener('click',removeVoucherList);
    voucherListLiTag.getElementsByClassName('quantity-input')[0].addEventListener('change',quantityChanged);

}
//update Total
function updatetotal(){
    let voucherLists = document.getElementsByClassName('voucherLists')[0];
    let voucherListOfItems = voucherLists.getElementsByClassName('voucher-list-item');
    let listCount = document.querySelector('.list-count');
    listCount.innerText = voucherListOfItems.length;
    let total = 0;
    for (let i=0;i < voucherListOfItems.length;i++) {
        let voucherList = voucherListOfItems[i];
        let priceElement = voucherList.getElementsByClassName('unit-price')[0];
        let price = parseFloat(priceElement.innerText.replace('$',''));
        let quantityElement = voucherList.getElementsByClassName('quantity-input')[0];
        let quantity = quantityElement.value;
        total = total + (price * quantity);
        //if price contain some cent value 24.04
        total = Math.round(total * 100)/100;

        let voucherCoast = voucherList.getElementsByClassName('voucher-cost')[0];
        voucherCoast.innerHTML = price * quantity;
    }
        document.getElementsByClassName('total-price')[0].innerHTML = '$' + total;


}
