@props(['product'])
<div class="tab-pane fade" id="reviews">
    @if ($product->comments)
        @foreach ($product->comments as $item)
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>{{ $item->user->name }}</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i><time>
                                {{ $item->user->created_at->format('F j, Y, g:i a') }}
                            </time></a></li>
                </ul>
                <p>{{ $item->body }}</p>
            </div>
        @endforeach
        
    @else
        <h3>Hi there is currently no comment on this product yet</h3>
    @endif
    @auth
        <form action="{{ route('product.comment.store', $product->id) }}" method="POST">
            @csrf
            <h2>Want to participate</h2>


            <h3>Hi {{ auth()->user()->name }} What do you want to discuss</h3>
            <textarea placeholder="content" name="body"></textarea>
            <button type="submit" class="btn btn-default pull-right">
                Submit
            </button>
        </form>
    @else
        <h2>Hi! Want to participate</h2>
        <h3><a href="/register">Register an account</a> </h3> or <h3> <a href="/login">Login to an account</a> </h3> in
        order
        to comment
    @endauth

</div>
