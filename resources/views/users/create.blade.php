@extends('layouts.app')

@section('content')
<h1 class="h4 mb-3">Create User</h1>

<form id="userCreateForm" action="{{ route('users.store') }}" method="POST" class="bg-white p-3 rounded shadow-sm">
  @csrf

  <div class="mb-3">
    <label class="form-label">First name *</label>
    <input type="text" name="first_name" class="form-control" required maxlength="100" value="{{ old('first_name') }}">
    @error('first_name') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Last name *</label>
    <input type="text" name="last_name" class="form-control" maxlength="100" value="{{ old('last_name') }}">
    @error('last_name') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Email *</label>
    <input type="email" name="email" class="form-control" required maxlength="191" value="{{ old('email') }}">
    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Password *</label>
    <input type="password" name="password" class="form-control" required minlength="6" maxlength="100">
    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="d-flex gap-2">
    <button class="btn btn-primary" type="submit">Save</button>
    <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancel</a>
  </div>
</form>
@endsection

@push('scripts')
<script>
  $(document).ready(function () {
    $('#userCreateForm').validate({
      rules: {
        first_name: {
          required: true,
          maxlength: 100
        },
        last_name: {
          required: true,
          maxlength: 100
        },
        email: {
          required: true,
          email: true,
          maxlength: 191
        },
        password: {
          required: true,
          minlength: 6,
          maxlength: 100
        }
      },
      messages: {
        first_name: {
          required: "First name is required",
          maxlength: "First name cannot exceed 100 characters"
        },
        last_name: {
          required: "Last name is required",
          maxlength: "Last name cannot exceed 100 characters"
        },
        email: {
          required: "Email is required",
          email: "Please enter a valid email",
          maxlength: "Email cannot exceed 191 characters"
        },
        password: {
          required: "Password is required",
          minlength: "Password must be at least 6 characters",
          maxlength: "Password cannot exceed 100 characters"
        }
      },
      errorElement: 'div',
      errorClass: 'text-danger small',
      highlight: function (element) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element) {
        $(element).removeClass('is-invalid');
      },
      submitHandler: function (form) {
        form.submit();
      }
    });
  });
</script>
@endpush


