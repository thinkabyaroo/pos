@extends('master')
@section('content')
    <div class="col-12 col-md-9 col-xl-10 vh-100 py-5 ps-3">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{route('category.index') == request()->url()? 'active':''}}" aria-current="page" href="{{route('category.index')}}">Category List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('category.create') == request()->url()? 'active':''}}" href="{{route('category.create')}}">Add Category</a>
                </li>
            </ul>
            <span class="p-2 border rounded-2 text-center">
                Total Categories :
                {{count(\App\Models\Category::all())}}
            </span>
        </div>



        <h3>Category Lists</h3>

       <div class="py-3">
           <table class="table table-hover table-borderless align-middle">
               <thead class="table-primary">
               <tr>
                   <th>#</th>
                   <th>Title</th>
                   <th>Owner</th>
                   <th>Control</th>
                   <th>Created_at</th>
               </tr>
               </thead>
               <tbody>
               @forelse($categories as $category)
                   <tr class="border-bottom">
                       <td>{{$category->id}}</td>
                       <td>{{$category->name}}</td>
                       <td>{{$category->user->name}}</td>

                       <td>
                           <div class="btn-group">
                               <a href="{{route('category.edit',$category->id)}}" class="btn btn-outline-primary btn-sm">
                                   <i class="fa-solid fa-edit fa-fw"></i>
                               </a>
                               <form action="{{route('category.destroy',$category->id)}}" class="d-inline-flex" method="post">
                                   @csrf
                                   @method('delete')
                                   <button class="btn btn-outline-primary btn-sm">
                                       <i class="fa-solid fa-trash-alt fa-fw"></i>
                                   </button>
                               </form>
                           </div>

                       </td>

                       <td>
                           <p class="small mb-0">
                               <i class="fas fa-calendar"></i>
                               {{$category->created_at->format('d m Y')}}
                           </p>
                           <p class="small mb-0">
                               <i class="fas fa-clock"></i>
                               {{$category->created_at->format('h i a')}}
                           </p>
                       {{$category->created_at->diffForHumans()}}
                   </tr>

               @empty
                   <tr>
                       <td colspan="5">There is no data</td>
                   </tr>
               @endforelse
               </tbody>
           </table>
       </div>

       <div class="">
           {{$categories->links()}}
       </div>

    </div>


@endsection
