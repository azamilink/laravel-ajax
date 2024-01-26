@extends('layouts.bootstrap')

@push('style')
    <style>
        .parsley-errors-list li {
            list-style: none;
            color: red;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form action="{{ route('auth.registersubmit') }}" method="POST" id="registerForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required data-parsley-pattern="[a-zA-Z]+$" data-parsley-trigger="keyup">
                        </div>
                        <div class="mb-3">
                            <label for="emai" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required data-parsley-length="[6,12]" data-parsley-trigger="keyup">
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" name="cpasswprd" id="cpasswprd" class="form-control" required data-parsley-equalto="#password" data-parsley-trigger="keyup">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" required data-parsley-pattern="[0-9]+$" data-parsley-length="[10,13]" data-parsley-trigger="keyup">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            $("#registerForm").parsley();
        })
    </script>
@endpush


@push('library')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
