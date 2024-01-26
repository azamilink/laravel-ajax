@foreach ($posts as $post)
    <div class="card mt-5">
        <div class="card-header">
            <h3><a href="#">{{ $post->title }}</a></h3>
        </div>
        <div class="card-body">
            <p>{{ $post->body }}</p>
            <div class="text-center">
                <button class="btn btn-success" type="button">Read More</button>
            </div>
        </div>
    </div>
@endforeach
