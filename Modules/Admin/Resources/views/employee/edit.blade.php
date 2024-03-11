@extends('admin::layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <nav aria-label="breadcrumb" class="py-0 mb-1">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                Employee
            </li>
            <li class="breadcrumb-item">
                <a>Edit </a>
            </li>
        </ol>
    </nav>
    <h4 class="py-2 mb-1"><span class="text-muted fw-light">Update </span> Employee
        <a href="{{ route('admin.employees.index') }}"
            class="btn py-0 rounded-pill btn-dark text-muted float-end">Back</a>
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-2">
                <div class="card-body">
                    <form action="{{ route('admin.employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if(session('success'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="row">

                            <div class="mb-2 col-md-6">
                                <label class="form-label" for="basic-default-fullname">First Name *</label>
                                <input name="first_name" type="text" value="{{old('first_name',$employee->first_name)}}"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    id="basic-default-fullname" placeholder="Enter First Name" />
                                @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2 col-md-6">
                                <label class="form-label" for="basic-default-fullname">Last Name *</label>
                                <input name="last_name" type="text" value="{{old('last_name',$employee->last_name)}}"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    id="basic-default-fullname" placeholder="Enter Last Name" />
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2 col-md-6">
                                <label class="form-label" for="basic-default-fullname"> Email *</label>
                                <input name="email" type="text" value="{{old('email',$employee->email)}}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="basic-default-fullname" placeholder="Enter Email" />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-2 col-md-6">
                                <label class="form-label" for="basic-default-fullname"> Phone *</label>
                                <input name="phone" type="text" value="{{old('phone',$employee->phone)}}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="basic-default-fullname" placeholder="Enter Phone" />
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="basic-default-fullname">Company</label>
                                <select name="company_id" class="form-select @error('company_id') is-invalid @enderror"
                                    aria-label=".form-select-sm example">
                                    <option value="" selected="true" disabled="disabled">Select Brand
                                    </option>
                                    @if ($companies)
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id',$employee->company_id)==$company->id ? 'selected' :
                                        '' }}>
                                        {{ $company->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- / Content -->
<!-- / Content -->
<script>
    // Add an event listener to the file input
        document.getElementById('formFileMultiple').addEventListener('change', function(event) {
            // Get the selected file
            var file = event.target.files[0];

            // If a file is selected, update the image preview
            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Update the source of the image preview and display it
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(file);
            } else {
                // If no file is selected, hide the image preview
                document.getElementById('imagePreview').style.display = 'none';
            }
        });
</script>
@endsection
