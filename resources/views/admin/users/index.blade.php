@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container">
    <h2 class="mb-4">User Management</h2>

    {{-- Tabs --}}
    <ul class="nav nav-tabs" id="userTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab">Users</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="admins-tab" data-bs-toggle="tab" data-bs-target="#admins" type="button" role="tab">Admins</button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="userTabsContent">
        {{-- Users Tab --}}
        <div class="tab-pane fade show active" id="users" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <input type="text" class="form-control w-50" id="userSearch" placeholder="Search Users...">
            </div>

            <table class="table table-striped" id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Admins Tab --}}
        <div class="tab-pane fade" id="admins" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-success">+ Add Admin</a>
                <input type="text" class="form-control w-50" id="adminSearch" placeholder="Search Admins...">
            </div>

            <table class="table table-striped" id="adminTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $index => $admin)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
