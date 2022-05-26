<table class="table table-bordered align-middle table-hover">
    <thead>
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
        <tr>
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

{{$categories->links()}}
