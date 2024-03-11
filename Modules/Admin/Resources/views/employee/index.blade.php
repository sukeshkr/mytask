@extends('admin::layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb" class="py-0 mb-1">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>Employee</a>
            </li>
        </ol>
    </nav>
    <h4 class="py-2 mb-1"><span class="text-muted fw-light">Employee </span> List</h4>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="mb-1">
        <a href="{{ route('admin.employees.create') }}" class="btn createbtn btn-primary">Create</a>

    </div>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table id="myTable" class="table table-striped  nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Sl No</th>
                        <th class="whitespace-nowrap">Name</th>
                        <th class="whitespace-nowrap">Company Name</th>
                        <th class="whitespace-nowrap">Email</th>
                        <th class="whitespace-nowrap">Phone</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
<!-- / Content -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="exampleModalLongTitle"> Employee Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

<script>
    $(document).ready(function () {
      $('#exampleModalLong').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('name'); // Extract value from data-* attributes
        var email = button.data('email'); // Extract value from data-* attributes
        var modal = $(this);

        modal.find('.modal-body').html("Name: " + name + "<br>Email: " + email + "<br>phone: " + phone + "<br>address: " + address);

      });
    });
</script>
<script type="text/javascript">
    var appBaseUrl = "{{ url('') }}";
    $(function() {
        if ($('#myTable').length > 0) {
            table = $('#myTable').DataTable({
                "bLengthChange": false,
                "bInfo": true,
                "lengthMenu": [
                    [10]
                ],
                "paging": true,
                "sorting": false,
                "processing": true,
                "serverSide": true,
                "bFilter": true,
                "searching": false,
                "ordering": true,
                ajax: {
                    url: '{{ route('admin.employee.list') }}',
                    data: function(data) {
                        data.search = $('#searchInput').val();
                    }
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        render: function(data, type, full) {
                            if (full.first_name)
                                return full.first_name + ' ' + full.last_name;
                            else
                                return 'NIL';
                        }
                    },
                    {
                        render: function(data, type, full) {
                            if (full.company_id)
                                return full.company.name;
                            else
                                return 'NIL';
                        }
                    },
                    {
                        render: function(data, type, full) {
                            if (full.email)
                                return full.email;
                            else
                                return 'NIL';
                        }
                    },



                    {
                        render: function(data, type, full) {
                            if (full.phone)
                                return full.phone;
                            else
                                return 'NIL';
                        }
                    },





                ],
                "columnDefs": [{
                    "targets": 5,
                    "visible": true,
                    left: '500px',
                    "render": function(data, type, full) {

                        return  '<a class="btn btn-info" href="" data-toggle="modal" data-name="' + full.first_name +'"  data-email="' + full.email +'" data-target="#exampleModalLong">More</a>'+

                        '<a class="btn btn-primary" href="{{ url('admin/employees') }}/' +
                            full.id +
                            '/edit">Edit</a>' +
                            '<a class="btn btn-danger" href="javascript:void(0);" onclick="confirmDelete(' +
                            full.id + ');">Delete</i></a>';

                    }
                }],
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('text-center');
                }
            });
            $('#searchInput').bind("keyup change", function() {
                table.draw();
            });

        }
    });
</script>
<script type="text/javascript">
    function changeStatus(status, id, url) {

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "id": id,
                "status": status,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                table.draw();
                toastr.success(data.success);
            },

            error: function(e) {
                toastr.error(e);
            }
        })
    }
</script>

<script>
    function confirmDelete(id) {
        // Use the built-in JavaScript `confirm` method
        var confirmed = confirm("Are you sure you want to delete?");

        if (confirmed) {

            $.ajax({
                url: 'employees/' + id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#closemodal').click();
                    table.draw();
                },

                error: function(e) {
                    //toastr.error(e);
                }
            })

        }
    }
</script>
@endpush
