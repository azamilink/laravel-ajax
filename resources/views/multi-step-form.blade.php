@extends('layouts.bootstrap')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        section {
            padding-top: 15px;
        }

        .form-section {
            padding-left: 15px;
            display: none;
        }

        .form-section.current {
            display: inherit;
        }

        .btn-info,
        .btn-success {
            margin-top: 10px;
        }

        .parsley-errors-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            color: red;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card-header text-white bg-info">
                        <h5>Multi Step Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('form.submit') }}" class="contact-form" method="POST">
                            @csrf
                            <div class="form-section">
                                <label for="firstname" class="form-label">First Name:</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" required>

                                <label for="lastname" class="form-label">Last Name:</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>

                            <div class="form-section">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required>

                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>

                            <div class="form-section">
                                <label for="msg" class="form-label">Message:</label>
                                <textarea name="msg" id="msg" class="form-control" required> </textarea>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="previous btn btn-info float-start">Previous</button>
                                <button type="button" class="next btn btn-info float-end">Next</button>
                                <button type="submit" class="btn btn-success float-end">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(function() {
            var $sections = $('.form-section');

            function navigateTo(index) {
                $sections.removeClass('current').eq(index).addClass('current');
                $('.form-navigation .previous').toggle(index > 0);

                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [type=submit]').toggle(atTheEnd);
            }

            function currIndex() {
                return $sections.index($sections.filter('.current'));
            }

            $('.form-navigation .previous').click(function() {
                navigateTo(currIndex() - 1);
            });

            $('.form-navigation .next').click(function() {
                $('.contact-form').parsley().whenValidate({
                    group: 'block-' + currIndex()
                }).done(function() {
                    navigateTo(currIndex() + 1);
                });
            });

            $sections.each(function(index, section) {
                $(section).find(':input').attr('data-parsley-group', 'block-' + index)
            })

            navigateTo(0);
        });
    </script>
@endpush
