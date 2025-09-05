@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 m-0">Users</h1>
  <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
</div>

<form method="GET" action="{{ route('users.index') }}" class="row g-2 mb-3">
  <div class="col-auto">
    <input type="text" name="q" class="form-control" placeholder="Search name/email" value="{{ $search }}">
  </div>
  <div class="col-auto">
    <!-- <select name="per_page" class="form-select">
      @foreach([5,10,25,50] as $n)
        <option value="{{ $n }}" @selected(request('per_page',10)==$n)>{{ $n }} / page</option>
      @endforeach
    </select> -->
  </div>
  <div class="col-auto">
    <button class="btn btn-outline-secondary">Filter</button>
    <a href="{{ route('users.index') }}" class="btn btn-link">Reset</a>
  </div>
</form>

<div class="table-responsive bg-white shadow-sm rounded">
  <table class="table table-striped align-middle mb-0">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Created</th>
        <th>Modified</th>
        <th class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $u)
      <tr>
        <td>{{ $u->id }}</td>
        <td>{{ $u->first_name }}</td>
        <td>{{ $u->last_name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->created_at }}</td>
        <td>{{ $u->modified_at }}</td>
        <td class="text-end">
          <a class="btn btn-sm btn-outline-primary" href="{{ route('users.edit', $u) }}">Edit</a>
          <button class="btn btn-sm btn-outline-danger btn-delete" data-url="{{ route('users.destroy', $u) }}">Delete</button>
        </td>
      </tr>
      @empty
      <tr><td colspan="7" class="text-center text-muted">No users found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="d-flex justify-content-between align-items-center mt-3">
  <div class="small text-muted">
    Showing {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }} of {{ $users->total() }}
  </div>
  <div>{{ $users->onEachSide(1)->links() }}</div>
</div>
@endsection

@push('scripts')
<script>
  // enable AJAX delete
  bindAjaxDelete('.btn-delete');
</script>
@endpush
