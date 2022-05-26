@extends('layouts/app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-3"></div>
            <div class="col-12 col-md-9">
                @if(session('status'))
                    <div class="alert alert-success d-flex justify-content-between align-items-center fade show" role="alert">
                        <div>
                            {{session('status')}}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h3>Item Lists</h3>
                <table class="table table-hover table-borderless align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>
                            #
                        </th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $item)
                        <tr class="border-bottom">
                            <td>{{$item->id}}</td>
                            <td class="">
                                <div class="rounded-circle overflow-hidden bg-secondary" style="height: 100px;width: 100px;">
                                    <img src="{{asset("storage/item/".$item->photo)}}" style="width: 100%;height: 100%;object-fit: cover;" alt="">
                                </div>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->category_id}}</td>
                            <td>
                                <div class="">

                                    <a href="{{route('item.edit',$item->id)}}" class="btn btn-outline-warning text-decoration-none me-1">
                                        <i class="fas fa-edit fa-fw fa-1x"></i>
                                    </a>
                                    <form action="{{route('item.destroy',$item->id)}}" method="post" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger me-1">
                                            <i class="fas fa-trash-alt fa-fw fa-1x"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
