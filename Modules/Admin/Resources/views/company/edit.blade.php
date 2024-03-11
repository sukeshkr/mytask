@extends('admin::layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <nav aria-label="breadcrumb" class="py-0 mb-1">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                Company
            </li>
            <li class="breadcrumb-item">
                <a>Update </a>
            </li>
        </ol>
    </nav>
    <h4 class="py-2 mb-1"><span class="text-muted fw-light">Update </span> Company
        <a href="{{ route('admin.companies.index') }}"
            class="btn py-0 rounded-pill btn-dark text-muted float-end">Back</a>
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-2">
                <div class="card-body">
                    <form action="{{ route('admin.companies.update',$company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if(session('success'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="row">

                            <div class="mb-2 col-md-6">
                                <label class="form-label" for="basic-default-fullname"> Name *</label>
                                <input name="name" type="text" value="{{old('name',$company->name)}}" class="form-control @error('name') is-invalid @enderror"
                                    id="basic-default-fullname" placeholder="Enter Name" />
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2 col-md-6">
                                <label class="form-label" for="basic-default-fullname"> Email *</label>
                                <input name="email" type="text" value="{{old('email',$company->email)}}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="basic-default-fullname" placeholder="Enter Email" />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-2 col-md-12">
                                <label class="form-label" for="basic-default-fullname"> Website Url *</label>
                                <input name="website" type="text" value="{{old('website',$company->website)}}"
                                    class="form-control @error('website') is-invalid @enderror"
                                    id="basic-default-fullname" placeholder="Enter website Url" />
                                @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="basic-default-fullname">Logo</label>
                                <div class="col-md">
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="{{asset($company->logo)}}" id="imagePreview" class="card-img card-img-right"
                                                    alt=" image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input name="logo" class="form-control @error('logo') is-invalid @enderror" type="file"
                                    id="formFileMultiple" accept="image/*">
                                @error('logo')
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
