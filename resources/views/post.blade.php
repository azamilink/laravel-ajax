@extends('layouts.bootstrap')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Infinite Scroll Paginantion</h2>
        </div>
        <div class="col-md-12" id="post-data">
            @extends('data')
        </div>
    </div>

    <div class="ajax-load text-center d-none">
        <p><img src="{{ asset('images/loader.gif') }}" alt="loader"> Loading More Posts</p>
    </div>
@endsection

@push('script')
    <script>
        function loadMoreData(page) {
            $.ajax({
                url: '?page=' + page,
                type: 'get',
                beforeSend: function() {
                    $('.ajax-load').show();
                }
            }).done(function(data) {
                if (data.html == " ") {
                    $('.ajax-load').html("No more record found");
                    return;
                }
                $('.ajax-load').hide();
                $("#post-data").append(data.html);
            }).fail(function(jqXHR, ajaxOPtions, thrownError) {
                alert("Server not responding...");
            })
        }

        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        })
    </script>
@endpush
