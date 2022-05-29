@extends('master')
@section('head')
    <style>
        .pos-card{
            /* position: relative; */

            height: 180px;
            max-height: 180px;
            /*height: auto;*/
            cursor: pointer;
            overflow: hidden;
            border: none;
            transition: .4s;
        }
        .pos-card:active{
            transform: scale(0.95);
        }
        .pos-card .pos-card-img-top{
            vertical-align: middle;
            width: 100%;
            height: 100%;
            object-fit: cover;

        }
        .pos-card .content {
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0); /* Fallback color */
            background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
            color: #f1f1f1;
            width: 100%;
            height: 25%;
            padding: 5px;
        }
        .voucher-col{
            position: fixed;
            right: 0;
        }
        .voucher{
            height: 92vh;
        }
        .voucher ul{
            max-height: 68vh;
            overflow: auto;
        }
        .productModalImg{
            width: 100%;
            height: 300px;
            /*height: auto;*/
            overflow: hidden;

        }
        .productModalImg img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .voucher-list-item:hover{
            background: #ddd;
        }
        /*input[type="number"]::-webkit-outer-spin-button,*/
        /*input[type="number"]::-webkit-inner-spin-button{*/
        /*    -webkit-appearance: none;*/
        /*}*/
        /*#productModalQuantity{*/
        /*    -moz-appearance: textfield*/
        /*}*/
    </style>
@endsection
@section('content')
    <div class=" col-12 col-md-9 col-lg-7 mt-4 pb-5 ps-3">
        <div class="mb-4">
            <ul class="nav nav-pills w-100 p-1" >
                @foreach($categories as $category)
                <li class="nav-item rounded-pill px-1 border me-1 mb-1">
                    <a class="nav-link " aria-current="page" href="#">{{$category->name}}</a>
                </li>
                @endforeach
{{--                <li class="nav-item rounded-pill px-1 border me-1">--}}
{{--                    <a class="nav-link " href="#">Drink</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item rounded-pill px-1 border me-1">--}}
{{--                    <a class="nav-link " href="#">Donut</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item rounded-pill px-1 border me-1">--}}
{{--                    <a class="nav-link " href="#">Bread</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item rounded-pill px-1 border me-1">--}}
{{--                    <a class="nav-link " href="#">Cake</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item rounded-pill px-1 border me-1">--}}
{{--                    <a class="nav-link " href="#">Fast Food</a>--}}
{{--                </li>--}}
            </ul>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="item">
                    <div class="row row-cols-5 row-cols-md-5 row-cols-lg-4 g-0" id="product-lists">
                        @forelse($items as $item)
                            <div class="col">
{{--                                data-bs-toggle="modal" data-bs-target="#productDetail{{$item->id}}"--}}
                                <div class="card pos-card product-item add-voucher" data-id="{{$item->id}}" data-cat="{{$item->category_id}}"  style="">
                                    @if($item->photo)
                                        <img src="{{ asset('storage/item/'.$item->photo) }}"  alt='{{$item->photo}}' class="pos-card-img-top product-img" alt="">
                                    @elseif($item->photo==null)
                                        <img src="{{asset('image-default.png')}}" class="pos-card-img-top product-img" alt="">
                                    @endif
{{--                                    <img src="https://www.w3schools.com/w3images/notebook.jpg" class="pos-card-img-top" alt="">--}}
                                    <div class="content d-flex justify-content-between align-items-center">
                                        <p class="h4 mb-0 product-name text-truncate">{{$item->name}}</p>
                                        <p class="fw-bold product-price mb-0">${{$item->price}}</p>
{{--                                        <p>{{$item->category_id}}</p>--}}
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                            <div class="col">
                                <a href="{{route('item.create')}}" class="text-decoration-none text-black-50" title="Add Item">
                                    <div class="card pos-card bg-light border d-flex justify-content-center align-items-center">
                                        <i class="fas fa-plus fa-2x"></i>
                                    </div>
                                </a>
                            </div>
                    </div>
                </div>
                <div class="my-3">
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12  col-lg-3 px-0 d-md-none d-lg-block voucher-col">
        <div class="bg-white  w-100 shadow-sm voucher" style="position: relative">
                    <h4 class="d-flex justify-content-between align-items-center mb-2 py-3">
                        <span class="text-primary">Your Voucher</span>
                        <span class="badge bg-primary rounded-pill list-count">0</span>
                    </h4>
                    <ul class="list-group voucherLists">
{{--                        <li class="list-group-item d-flex justify-content-between align-items-center voucher-list-item px-0 pe-1">--}}
{{--                            <i class="fas fa-times text-danger remove-list px-2" style="cursor: pointer"></i>--}}
{{--                            <div class="w-50">--}}
{{--                                <h6 class="my-0 text-truncate voucher-product-name">IceCream</h6>--}}
{{--                                <small class="text-muted unit-price voucher-product-price" >--}}
{{--                                    $2000--}}
{{--                                </small>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <input type="number" class="quantity-input form-control" value="1" style="width: 100px">--}}
{{--                            </div>--}}
{{--                            <div class="text-muted w-25 voucher-cost text-end">2000</div>--}}
{{--                        </li>--}}
                    </ul>

                    <div class="voucher-total w-100 d-flex justify-content-between align-items-center py-3 h5 border-top">
                        <div class="total-title h5">Total</div>
                        <div class="total-price text-end">$0</div>
                    </div>
                    <button class="btn btn-success btn-lg form-control py-3 position-absolute bottom-0 checkout-btn" >
                        <span class="h4">
                            <i class="fas fa-shopping-basket"></i>
                            CheckOut
                        </span>
                    </button>
            </form>

        </div>
    </div>


{{--    Modal--}}
    @forelse($items as $item)
        <div class="modal fade" id="productDetail{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productModalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalTitle">{{ucwords($item->name)}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-center">
{{--                            <p id="productModalTitle">{{ucwords($item->name)}}</p>--}}
                            <div class="productModalImg border">
                                <img src="{{asset('storage/item/'.$item->photo)}}" id="productModalImg{{$item->id}}" alt="">
                            </div>
                           <div class="d-flex justify-content-between align-items-center py-3">
                               <p class="text-black-50 h5 mb-0" >
                                   <lable>Unit Price :</lable>
                                   $ <span id="productModalUnitPrice">{{$item->price}}</span>
                               </p>
                               <p class="text-black-50 h5 mb-0" >
                                   $ <span class="productModalPriceWithQuantity">{{$item->price}}</span>
                               </p>
                           </div>

                            <div class="input-group mb-3 w-50 mx-auto">
                                <button class="btn btn-outline-secondary quantityMinus" type="button"  id="quantityMinus{{$item->id}}" >
                                    <i class="fa-solid fa-minus fa-fw"></i>
                                </button>
                                <input type="number" class="form-control text-end productModalQuantity" price="{{$item->price}}" min="1" value="1" id="productModalQuantity{{$item->id}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <button class="btn btn-outline-secondary quantityPlus" type="button" id="quantityPlus{{$item->id}}">
                                    <i class="fa-solid fa-plus fa-fw"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" id="addToVoucher">Add To Voucher</button>
                    </div>
                </div>
            </div>
        </div>

    @empty
    @endforelse
{{--    End Modal--}}
@endsection
