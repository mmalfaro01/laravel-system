@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<style>
    .person-cell {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 600;
    }
    .person-avatar {
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(243, 154, 18, 0.12);
        border: 1px solid rgba(243, 154, 18, 0.25);
        color: var(--burger-gold, #ffcb72);
        flex-shrink: 0;
    }
    .person-avatar i {
        font-size: 1.15rem;
    }
</style>
<div class="container">
    <h2 class="mb-4">User Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tabs --}}
    <ul class="nav nav-tabs" id="userTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab">Users</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="admins-tab" data-bs-toggle="tab" data-bs-target="#admins" type="button" role="tab">Admins</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="staff-tab" data-bs-toggle="tab" data-bs-target="#staff" type="button" role="tab">Staff</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="drivers-tab" data-bs-toggle="tab" data-bs-target="#drivers" type="button" role="tab">Drivers</button>
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
                        <th>Role</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="person-cell">
                                    <span class="person-avatar" aria-hidden="true">
                                        <i class='bx bx-user'></i>
                                    </span>
                                    <span>{{ $user->name }}</span>
                                </span>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-secondary text-uppercase">{{ $user->role ?? 'customer' }}</span></td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    <button type="button" class="btn btn-sm btn-secondary" disabled>No Edit</button>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="button" data-confirm="Delete this user?" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                    </form>
                                </div>
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
                            <td>
                                <span class="person-cell">
                                    <span class="person-avatar" aria-hidden="true">
                                        <i class='bx bx-user-circle'></i>
                                    </span>
                                    <span>{{ $admin->name }}</span>
                                </span>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="staff" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('admin.staff.create') }}" class="btn btn-success">+ Add Staff</a>
                <div class="text-muted align-self-center">Staff accounts can access the staff panel only.</div>
            </div>

            @if ($staff->isEmpty())
                <div class="alert alert-info">
                    No staff accounts found yet.
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $index => $member)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="person-cell">
                                        <span class="person-avatar" aria-hidden="true">
                                            <i class='bx bxs-id-card'></i>
                                        </span>
                                        <span>{{ $member->name }}</span>
                                    </span>
                                </td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="tab-pane fade" id="drivers" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('admin.drivers.create') }}" class="btn btn-success">+ Add Driver</a>
                <input type="text" class="form-control w-50" id="driverSearch" placeholder="Search Drivers...">
            </div>

            <table class="table table-striped" id="driverTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drivers as $index => $driver)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="person-cell">
                                    <span class="person-avatar" aria-hidden="true">
                                        <i class='bx bx-car'></i>
                                    </span>
                                    <span>{{ $driver->name }}</span>
                                </span>
                            </td>
                            <td>{{ $driver->email }}</td>
                            <td>{{ $driver->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-secondary" disabled>No Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
