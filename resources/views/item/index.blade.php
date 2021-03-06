@extends('master')
@section('content')

            <div class="col-12 col-md-9 col-lg-10 py-5 ps-3">

                <div class="mb-4 d-flex justify-content-between align-items-center" >
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{route('item.index') == request()->url()? 'active':''}}" aria-current="page" href="{{route('item.index')}}">Item List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{route('item.create') == request()->url()? 'active':''}}" href="{{route('item.create')}}">Add Item</a>
                        </li>
                    </ul>
                    <span class="p-2 border rounded-2 text-center">
                        Total Item :
                        {{count(\App\Models\Item::all())}}
                    </span>
                </div>

            @if(session('status'))
                    <div class="alert alert-success d-flex justify-content-between align-items-center fade show" role="alert">
                        <div>
                            {{session('status')}}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h3>Item Lists</h3>
                <div class="py-3">
                        <table class="table table-hover table-borderless align-middle">
                            <thead class="table-primary">
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
                                            <a href="{{asset("storage/item/".$item->photo)}}">
                                                <img src="{{asset("storage/item/".$item->photo)}}" style="width: 100%;height: 100%;object-fit: cover;" alt="">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->category->name}}</td>
                                    <td>{{$item->description}}</td>
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
                                <tr class="border-bottom text-center">
                                    <td class="" colspan="7"> No Record Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                <div class="">
                    {{$items->links()}}
                </div>
            </div>

@endsection


@push('scripts')
    <script>
        let itemPreview = document.getElementById('itemPreview');
        let photo = document.getElementById('photo');
        itemPreview.addEventListener('click',_=>photo.click());
        photo.addEventListener("change",_=>{
            let file = photo.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                itemPreview.src = reader.result;
            }
            reader.readAsDataURL(file);
        })
    </script>
@endpush
