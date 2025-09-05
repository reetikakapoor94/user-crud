@extends('layouts.app')

@section('content')
<h1 class="h4 mb-3">Edit User</h1>

<form id="userEditForm" action="{{ route('users.update', $user) }}" method="POST" class="bg-white p-3 rounded shadow-sm">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label class="form-label">First name *</label>
    <input type="text" name="first_name" class="form-control" required maxlength="100" value="{{ old('first_name', $user->first_name) }}">
    @error('first_name') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Last name</label>
    <input type="text" name="last_name" class="form-control" maxlength="100" value="{{ old('last_name', $user->last_name) }}">
    @error('last_name') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Email *</label>
    <input type="email" name="email" class="form-control" required maxlength="191" value="{{ old('email', $user->email) }}">
    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Password (leave blank to keep same)</label>
    <input type="password" name="password" class="form-control" minlength="6" maxlength="100">
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
  bindAjaxForm('#userEditForm', "{{ route('users.index') }}");
</script>
@endpush
