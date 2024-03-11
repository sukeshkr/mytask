@extends('admin::layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="py-0 mb-1">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Account Settings</a>
                </li>
                
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bx bx-bell me-1"></i>
                            Notifications</a>
                    </li>
                </ul>
                <div class="card mb-1">
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if (!empty($user->image))
                                <img src="{{ asset($user->image) }}" alt="user-avatar" class="d-block rounded"
                                    height="60" width="60" id="uploadedAvatar" />
                            @else
                                <img src="{{ asset('uploads/user/default.png') }}" alt="user-avatar" class="d-block rounded"
                                    height="100" width="100" id="uploadedAvatar" />
                            @endif

                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-2" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input name="image" type="file" id="upload" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-2">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update', $user) }}" id="formAccountSettings" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-1 col-md-4">
                                    <label for="firstName" class="form-label"> Name</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        value="{{ $user->name }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $user->email }}" placeholder="john.doe@example.com" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                            <input value="{{ $user->phone }}" type="text" id="phoneNumber"
                                                name="phone" class="form-control" placeholder="202 555 0111" />
                                    </div>
                                </div>
                              
                            
                                <hr>
                                <div class="mb-3 col-md-4">
                                    <label for="password" class="form-label">New Password</label>
                                    <input class="form-control" type="text" name="password"
                                        placeholder="Enter Password" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <input class="form-control" type="text" name="password_confirmation"
                                        placeholder="Confirm Password" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <script>
        const imageInput = document.querySelector('input[type="file"]');
        const imagePreview = document.getElementById('uploadedAvatar');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(file);

                const formData = new FormData();
                formData.append('image', file);

                // Make an AJAX POST request to upload the image using fetch
                fetch('{{ route('admin.profile.upload') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token if needed
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            // Handle the success response
                            //alert('Image uploaded successfully.');
                        } else {
                            // Handle errors if any
                            //alert('Image upload failed.');
                        }
                    })
                    .catch(error => {
                        // Handle network or fetch-related errors
                        console.error('Error:', error);
                    });
            }

        });
    </script>
@endsection
