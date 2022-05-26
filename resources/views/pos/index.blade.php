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
            height: 40%;
            padding: 5px;
        }
        .ticket{
            height: 92vh;
        }
    </style>
@endsection
@section('content')
    <div class=" col-12 col-md-9 col-lg-7 py-5 ps-3">
        <div class="mb-4">
            <ul class="nav nav-pills">
                <li class="nav-item rounded-pill px-1 border me-1">
                    <a class="nav-link " aria-current="page" href="#">Coffee</a>
                </li>
                <li class="nav-item rounded-pill px-1 border me-1">
                    <a class="nav-link " href="#">Drink</a>
                </li>
                <li class="nav-item rounded-pill px-1 border me-1">
                    <a class="nav-link " href="#">Donut</a>
                </li>
                <li class="nav-item rounded-pill px-1 border me-1">
                    <a class="nav-link " href="#">Bread</a>
                </li>
                <li class="nav-item rounded-pill px-1 border me-1">
                    <a class="nav-link " href="#">Cake</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="item">
                    <div class="row row-cols-5 row-cols-md-5 row-cols-lg-4 g-0">
                        @forelse($items as $item)
                            <div class="col">
                                <div class="card pos-card" style="">
                                    @if($item->photo)
                                        <img src="{{ asset('storage/item/'.$item->photo) }}"  alt='{{$item->photo}}' class="pos-card-img-top" alt="">
                                    @elseif($item->photo==null)
                                        <img src="{{asset('image-default.png')}}" class="" alt="">
                                    @endif
{{--                                    <img src="https://www.w3schools.com/w3images/notebook.jpg" class="pos-card-img-top" alt="">--}}
                                    <div class="content">
                                        <p class="h4 mb-0">{{$item->name}}</p>
                                        <p class="fw-bold">$ {{$item->price}}</p>
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
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12  col-lg-3 px-0 d-md-none d-lg-block">
        <div class="bg-white  w-100 shadow-sm ticket" style="position: relative">
            <form action="">
                <table class="table align-middle table-borderless table-hover">
                    <thead class="border-none border-bottom border-dark">
                        <tr class="text-center">
                            <th class="w-50 text-start">Name</th>
                            <th>Qty</th>
                            <th class="text-nowrap">Cost</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center ">
                            <td class="text-start">Coffee<br><small>$2000</small></td>
{{--                            <td>1000</td>--}}
                            <td>2</td>
                            <td>4000</td>
                            <td>
                                <i class="fas fa-times text-danger"></i>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td class="text-start">Bread<br><small>$2500</small></td>
                            <td>2</td>
                            <td>5000</td>
                            <td>
                                <i class="fas fa-times text-danger"></i>
                            </td>
                        </tr>
                        <tr class="text-center border">
                            <td class="text-start fw-bold h5">Total</td>
                            <td>4</td>
                            <td>9000</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                    <button class="btn btn-success btn-lg form-control py-3 position-absolute bottom-0" >
                        <span class="h4">
                            <i class="fas fa-shopping-basket"></i>
                            CheckOut
                        </span>
                    </button>
            </form>

        </div>
    </div>
@endsection
