@extends('layouts.bootstrap')


@section('content')
    <div class="rom">
        <div class="col-md-12">
            <div class="card-header d-flex justify-content-between">
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#studentModal">Add New Student</a>
                <div class="h5">All of Students</div>
                <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord">Deleted Selected</a>
            </div>
            <div class="card-body">
                <table id="studentTable" class="table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                            <th><input type="checkbox" id="chkCheckAll"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr id="sid{{ $student->id }}">
                                <td>{{ $student->firstname }}</td>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>
                                    <a href="javascript:void(0)" onclick="editStudent({{ $student->id }})" class="btn btn-info">Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteStudent({{ $student->id }})" class="btn btn-danger">Delete</a>
                                </td>
                                <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{ $student->id }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<!-- Add Student Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="studentForm">
                    @csrf
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit this student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="studentEditForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="firstname2" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname2">
                    </div>
                    <div class="mb-3">
                        <label for="lastname2" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname2">
                    </div>
                    <div class="mb-3">
                        <label for="email2" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email2">
                    </div>
                    <div class="mb-3">
                        <label for="phone2" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone2">
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    {{-- ADD STUDEBT --}}
    <script>
        $("#studentForm").submit(function(e) {
            e.preventDefault();

            let firstname = $("#firstname").val();
            let lastname = $("#lastname").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('student.add') }}",
                type: "POST",
                data: {
                    firstname,
                    lastname,
                    email,
                    phone,
                    _token
                },
                success: function(res) {
                    if (res) {
                        $("#studentTable tbody").prepend(`
                            <tr>
                                <td>${res.firstname}</td>
                                <td>${res.lastname}</td>
                                <td>${res.email}</td>
                                <td>${res.phone}</td>
                            </tr>
                        `);
                        $("#studentForm")[0].reset();
                        $("#studentModal").modal("hide");
                    }
                }
            })
        })
    </script>

    {{-- EDIT STUDENT --}}
    <script>
        function editStudent(id) {
            $.get(`/students/${id}`, function(student) {
                $("#id").val(student.id);
                $("#firstname2").val(student.firstname);
                $("#lastname2").val(student.lastname);
                $("#email2").val(student.email);
                $("#phone2").val(student.phone);
                $("#studentEditModal").modal('toggle');
            })
        }

        $("#studentEditForm").submit(function(e) {
            e.preventDefault();
            let id = $("#id").val();
            let firstname = $("#firstname2").val();
            let lastname = $("#lastname2").val();
            let email = $("#email2").val();
            let phone = $("#phone2").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('student.update') }}",
                type: "PUT",
                data: {
                    id,
                    firstname,
                    lastname,
                    email,
                    phone,
                    _token
                },
                success: function(response) {
                    $('#sid' + response.id + ' td:nth-child(1)').text(response.firstname);
                    $('#sid' + response.id + ' td:nth-child(2)').text(response.lastname);
                    $('#sid' + response.id + ' td:nth-child(3)').text(response.email);
                    $('#sid' + response.id + ' td:nth-child(4)').text(response.phone);
                    $('#studentEditModal').modal('toggle');
                    $('#studentEditForm')[0].reset();
                }
            })
        })
    </script>

    {{-- DELETE STUDENT  --}}
    <script>
        function deleteStudent(id) {
            if (confirm("Do you realy want to delete this record")) {
                $.ajax({
                    url: '/students/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $("input[name=_token]").val(),
                    },
                    success: function(response) {
                        $('#sid' + id).remove();
                    }
                })
            }
        }
    </script>

    {{-- DELETE SELECTED STUDENT --}}
    <script>
        $(function(e) {
            $("#chkCheckAll").click(function() {
                $('.checkBoxClass').prop('checked', $(this).prop('checked'));
            });

            $('#deleteAllSelectedRecord').click(function(e) {
                e.preventDefault();

                var allids = [];
                $("input:checkbox[name=ids]:checked").each(function() {
                    allids.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('student.deleteselected') }}",
                    type: "DELETE",
                    data: {
                        _token: $("input[name=_token]").val(),
                        ids: allids
                    },
                    success: function(respones) {
                        $.each(allids, function(key, val) {
                            $('#sid' + val).remove();
                        });
                    }
                })
            })
        })
    </script>
@endpush
