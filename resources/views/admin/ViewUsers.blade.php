@extends('layouts.SidebarAdmin')

@section('content')
<head>
    <style>
        .container {
            margin-top: 50px;
            margin-left:20px;
            margin-right:20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .actions {
            white-space: nowrap;
        }
        .btn {
            padding: 8px 12px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
@if(session('success'))
    <div id="flash-message" class="alert alert-success" role="alert" style="opacity: 1; transition: opacity 5s ease-in-out;background-color: #28a745; color: #fff; padding: 10px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
    <script>
        // Automatically close the flash message after 5 seconds
        setTimeout(function() {
            document.getElementById('flash-message').style.display = 'none';
        }, 5000);
    </script>
@endif

    <div class="container" >
        <h1 class="mb-4">Users</h1>

        <div class="container">
    <div style="margin-bottom: 20px;">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.users.index') }}" style="display: inline-block;">
            <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}" style="padding: 8px; width: 300px;">
            <button type="submit" style="padding: 8px 12px; background-color: #139C49; color: white; border: none; border-radius: 0.25rem;">Search</button>
        </form>

        <!-- Create New User Button -->
        <a href="{{ route('admin.users.create') }}" style="display: inline-block; margin-left: 10px; font-weight: 400; color: #fff; text-align: center; vertical-align: middle; user-select: none; background-color: #139C49; border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; text-decoration: none; position: relative; overflow: hidden;">
            Create New User
        </a>
    </div>

    <!-- Export Buttons -->
    <div>
    <a href="{{ route('admin.users.export', ['format' => 'txt']) }}" class="btn btn-secondary">Export as Text</a>
                <a href="{{ route('admin.users.export', ['format' => 'pdf']) }}" class="btn btn-danger">Export as PDF</a>

        <a href="{{ route('admin.users.export', ['format' => 'xlsx']) }}" class="btn btn-success" style="margin-right: 10px;">Export as XLSX</a>
        <a href="{{ route('admin.users.export', ['format' => 'csv']) }}" class="btn btn-info">Export as CSV</a>
    </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">ID</th>
                    <th onclick="sortTable(1)">Name</th>
                    <th onclick="sortTable(2)">Email</th>
                    <th onclick="sortTable(3)">Role</th>
                    <th onclick="sortTable(4)">Created At</th>
                    <th onclick="sortTable(5)">Updated At</th>
                    <th>Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class ="">
                            @if ($user->role == 0)
                                Admin
                            @elseif ($user->role == 1)
                                Qualificateur
                            @else
                                Commercial
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td class="actions">
                            <!-- Example of edit and delete links/buttons -->
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" ><svg style="height:30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></a>
                            @if ($user->id != 1)
                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button style="border:none;" type="submit"  onclick="return confirm('Are you sure you want to delete this user?')"><svg style="height:30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#bd0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                            </form>
                            @endif


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script>
    let sortDirection = 1; // 1 for ascending, -1 for descending

    function sortTable(columnIndex) {
        const table = document.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));

        rows.sort((a, b) => {
            const aValue = a.cells[columnIndex].textContent.trim();
            const bValue = b.cells[columnIndex].textContent.trim();

            // You can customize the sorting logic based on your data type (e.g., numeric, string, date)
            const comparison = aValue.localeCompare(bValue) * sortDirection;

            // For numeric sorting:
            // const comparison = (parseFloat(aValue) - parseFloat(bValue)) * sortDirection;

            return comparison;
        });

        // Clear the existing table rows
        table.querySelector('tbody').innerHTML = '';

        // Append the sorted rows back to the table
        rows.forEach(row => table.querySelector('tbody').appendChild(row));

        // Toggle the sort direction for the next click
        sortDirection *= -1;
    }
</script>
</body>
@endsection

@section('profilename')
SaifeddineNajmi
@endsection
@section('role')
Admin
@endsection
