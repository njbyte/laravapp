<div id="loader"></div>
    <div id="content" style="display: none;">
    <link rel="icon" href="{{ url('assets/logo.ico') }}" type="image/x-icon">
@extends('layouts.navbar')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convert | Export html Table to CSV & EXCEL File</title>
    <link rel="icon" href="{{ url('assets/logo.ico') }}" type="image/x-icon">

<style>
    .alert {
            position: fixed;
            top:20px;
            right: 30px;
            transform: translateX(-50%);
            z-index: 1000;
            opacity: 1;
            transition: opacity 5s ease-in-out, visibility 5s ease-in-out;
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            visibility: visible;
            border: 1px solid #1e7e34;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 16px;
    line-height: 1.5;
        }

        .alert.hide {
            opacity: 0;
            visibility: hidden;
        }

    * {
    margin: 0;
    padding: 0;

    box-sizing: border-box;
    font-family: sans-serif;
}
@media print {
 .table, .table__body {
  overflow: visible;
  height: auto !important;
  width: auto !important;
 }
}

/*@page {
    size: landscape;
    margin: 0;
}*/

body {
    min-height: 100vh;
    background: url(images/html_table.jpg) center / cover;
    display: flex;
    justify-content: center;
    align-items: center;
}

main.table {
    width: 82vw;
    height: 90vh;
    background-color: #fff5;
    z-index: 1;
    backdrop-filter: blur(7px);
    box-shadow: 0 .4rem .8rem #0005;
    border-radius: .8rem;

    overflow: hidden;
}

.table__header {
    width: 100%;
    height: 10%;
    background-color: #fff4;
    padding: .8rem 1rem;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table__header .input-group {
    width: 35%;
    height: 100%;
    background-color:#EBEDED;
    padding: 0 .8rem;
    border-radius: 2rem;

    display: flex;
    justify-content: center;
    align-items: center;

    transition: .2s;
}

.table__header .input-group:hover {
    width: 45%;
    background-color: #fff8;
    box-shadow: 0 .1rem .4rem #0002;
}

.table__header .input-group img {
    width: 1.2rem;
    height: 1.2rem;
}

.table__header .input-group input {
    width: 100%;
    padding: 0 .5rem 0 .3rem;
    background-color: transparent;
    border: none;
    outline: none;
}

.table__body {
    width: 95%;
    max-height: calc(89% - 1.6rem);
    background-color: #fffb;

    margin: .8rem auto;
    border-radius: .6rem;

    overflow: auto;
    overflow: overlay;
}


.table__body::-webkit-scrollbar{
    width: 0.5rem;
    height: 0.5rem;
}

.table__body::-webkit-scrollbar-thumb{
    border-radius: .5rem;
    background-color: #0004;
    visibility: hidden;
}

.table__body:hover::-webkit-scrollbar-thumb{
    visibility: visible;
}


table {
    width: 100%;
}

td img {
    width: 36px;
    height: 36px;
    margin-right: .5rem;
    border-radius: 50%;

    vertical-align: middle;
}

table, th, td {
    border-collapse: collapse;
    padding: 1rem;
    text-align: left;
}

thead th {
    position: sticky;
    top: 0;
    left: 0;
    background-color: #d5d1defe;
    cursor: pointer;
    text-transform: capitalize;
}

tbody tr:nth-child(even) {
    background-color: #0000000b;
}

tbody tr {
    --delay: .1s;
    transition: .5s ease-in-out var(--delay), background-color 0s;
}

tbody tr.hide {
    opacity: 0;
    transform: translateX(100%);
}

tbody tr:hover {
    background-color: #fff6 !important;
}

tbody tr td,
tbody tr td p,
tbody tr td img {
    transition: .2s ease-in-out;
}

tbody tr.hide td,
tbody tr.hide td p {
    padding: 0;
    font: 0 / 0 sans-serif;
    transition: .2s ease-in-out .5s;
}

tbody tr.hide td img {
    width: 0;
    height: 0;
    transition: .2s ease-in-out .5s;
}

.status {
    padding: .4rem 0;
    border-radius: 2rem;
    text-align: center;
}

.status.commercial {
    background-color: #86e49d;
    color: #006b21;
}

.status.admin {
    background-color: #d893a3;
    color: #b30021;
}

.status.qualificateur {
    background-color: #ebc474;
}

.status.shipped {
    background-color: #6fcaea;
}


@media (max-width: 1000px) {
    td:not(:first-of-type) {
        min-width: 12.1rem;
    }
}

thead th span.icon-arrow {
    display: inline-block;
    width: 1.3rem;
    height: 1.3rem;
    border-radius: 50%;
    border: 1.4px solid transparent;

    text-align: center;
    font-size: 1rem;

    margin-left: .5rem;
    transition: .2s ease-in-out;
}

thead th:hover span.icon-arrow{
    border: 1.4px solid #6c00bd;
}

thead th:hover {
    color: #6c00bd;
}

thead th.active span.icon-arrow{
    background-color: #6c00bd;
    color: #fff;
}

thead th.asc span.icon-arrow{
    transform: rotate(180deg);
}

thead th.active,tbody td.active {
    color: #6c00bd;
}
.export__file {
    position: relative;
    margin-left: 1rem;
}

.export__file .export__file-btn {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    background: #fff6 url(images/export.png) center / 80% no-repeat;
    border-radius: 50%;
    transition: .2s ease-in-out;
}

.export__file .export__file-btn:hover {
    background-color: #fff;
    transform: scale(1.15);
    cursor: pointer;
}

.export__file input {
    display: none;
}

.export__file .export__file-options {
    position: absolute;
    right: 0;
    width: 12rem;
    border-radius: .5rem;
    overflow: hidden;
    text-align: center;
    opacity: 0;
    transform: scale(.8);
    transform-origin: top right;
    box-shadow: 0 .2rem .5rem #0004;
    transition: .2s;
    z-index: -1;
}

.export__file input:checked + .export__file-options {
    opacity: 1;
    transform: scale(1);
    z-index: 100;
}

.export__file .export__file-options label {
    display: block;
    width: 100%;
    padding: .6rem 0;
    background-color: #f2f2f2;
    display: flex;
    justify-content: space-around;
    align-items: center;
    transition: .2s ease-in-out;
}

.export__file .export__file-options label:first-of-type {
    padding: 1rem 0;
    background-color: #86e49d !important;
}

.export__file .export__file-options label:hover {
    transform: scale(1.05);
    background-color: #fff;
    cursor: pointer;
}

.export__file .export__file-options img {
    width: 2rem;
    height: auto;
}
/* custom.css */

/* General body styling to include background blur when form is active */

/* Form container */

/* Form container */
.container {
    max-width: 600px;
    margin: 5px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    -webkit-border-top-left-radius: 30px;
    -webkit-border-bottom-right-radius: 30px;
    -moz-border-radius-topleft: 30px;
    -moz-border-radius-bottomright: 30px;
    border-top-left-radius: 30px;
    border-bottom-right-radius: 30px;
    animation: fadeInSlideUp 0.5s ease-in-out;
}

.form-label {
    font-weight: 600;
    margin-bottom: 8px;
}

.form-control,
.form-select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 16px;
    font-size: 14px;
}

.form-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg fill="%23808080" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12"><path d="M11.8 3.2a.75.75 0 0 0-1.06 0L6 8.94 1.26 4.2a.75.75 0 1 0-1.06 1.06l5 5a.75.75 0 0 0 1.06 0l5-5a.75.75 0 0 0 0-1.06" fill-rule="evenodd"></path></svg>');
    background-repeat: no-repeat;
    background-position-x: calc(100% - 10px);
    background-position-y: 50%;
    padding-right: 30px;
}

.btn-primary {
    background-color: #FF9800;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: #4CAF50;
}

.btn-secondary {
    background-color: #6c757d;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.has-error .form-control {
    border-color: #ff0000;
}

/* Ensure the form is hidden initially */
.hidden {
    display: none;
}

/* Overlay effect for the background */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999; /* Higher than other elements */
    display: none;
}

/* Style for the form container to be centered */
.form-container {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000; /* Higher than the overlay */
    width: 90%; /* Adjust as needed */
    max-width: 500px;
    -webkit-border-top-left-radius: 30px;
    -webkit-border-bottom-right-radius: 30px;
    -moz-border-radius-topleft: 30px;
    -moz-border-radius-bottomright: 30px;
    border-top-left-radius: 30px;
    border-bottom-right-radius: 30px;
    animation: fadeIn 0.5s ease-in-out;
}

/* To blur the background when the form is active */
body.blur {
    filter: blur(5px);
    overflow: hidden; /* Prevent scrolling */
}

/* Keyframes for fade-in and slide-in animation */
@keyframes fadeInSlideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* HTML: <div id="loader"></div> */
#loader {
  width: 120px;
  height: 22px;
  border-radius: 20px;
  color: #514b82;
  border: 2px solid;
  position: relative;
}
#loader::before {
  content: "";
  position: absolute;
  margin: 2px;
  inset: 0 100% 0 0;
  border-radius: inherit;
  background: currentColor;
  animation: l6 2s infinite;
}
@keyframes l6 {
    100% {inset:0}
}
</style>
</head>

<body>

@if(session('success'))
    <div id="flash-message" class="alert alert-success" role="alert" style="z-index:1; opacity: 1; transition: opacity 5s ease-in-out; background-color: #28a745; color: #fff; padding: 10px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="flash-message" class="alert alert-danger" role="alert" style="z-index:1; opacity: 1; transition: opacity 5s ease-in-out; background-color: #dc3545; color: #fff; padding: 10px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

<script>
        // Automatically close the flash message after 5 seconds
        setTimeout(function() {
            document.getElementById('flash-message').style.display = 'none';
        }, 5000);
    </script>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Users</h1>

            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="{{ asset('images/search.png') }}" alt="">

            </div>
            <div class="export__file">
            <a title="New User" href="#" id="newUserLink" style="margin-right: 10px; display: inline-block;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 11C10.2091 11 12 9.20914 12 7C12 4.79086 10.2091 3 8 3C5.79086 3 4 4.79086 4 7C4 9.20914 5.79086 11 8 11ZM8 9C9.10457 9 10 8.10457 10 7C10 5.89543 9.10457 5 8 5C6.89543 5 6 5.89543 6 7C6 8.10457 6.89543 9 8 9Z" fill="currentColor" /><path d="M11 14C11.5523 14 12 14.4477 12 15V21H14V15C14 13.3431 12.6569 12 11 12H5C3.34315 12 2 13.3431 2 15V21H4V15C4 14.4477 4.44772 14 5 14H11Z" fill="currentColor" /><path d="M18 7H20V9H22V11H20V13H18V11H16V9H18V7Z" fill="black" /></svg>
    </a>

    <label for="export-file" title="Export File" style="display: inline-block;">
  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/>
    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z"/>
  </svg>
</label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                <label>Export As &nbsp; &#10140;</label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" id="toPDF" class="btn btn-danger">
                            <img src="{{ asset('images/pdf.png') }}" alt="PDF Icon">
                        </button>

                    </label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" class="btn btn-danger">
                            <a href="{{ route('admin.users.export', ['format' => 'txt']) }}">
                                <img src="{{ asset('images/json.png') }}" alt="JSON Icon">
                            </a>
                        </button>
                    </label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" class="btn btn-danger">
                            <a href="{{ route('admin.users.export', ['format' => 'csv']) }}">
                                <img src="{{ asset('images/csv.png') }}" alt="CSV Icon">
                            </a>
                        </button>
                    </label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" class="btn btn-danger">
                            <a href="{{ route('admin.users.export', ['format' => 'xlsx']) }}">
                                <img src="{{ asset('images/excel.png') }}" alt="Excel Icon">
                            </a>
                        </button>
                    </label>
                </div>

            </div>

        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Role <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Created At <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Updated At <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td >
                           <p class="@if ($user->role == 0) status admin @elseif ($user->role == 1) status qualificateur @else status commercial @endif">
                            @if ($user->role == 0)
                                Admin
                            @elseif ($user->role == 1)
                                Qualificateur
                            @else
                                Commercial
                            @endif</p>
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td class="actions">
                            <!-- Example of edit and delete links/buttons -->
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" ><svg style="height:21px;margin-bottom:1px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></a>
                            @if ($user->id != 1)
                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button style="border:none;" type="submit"  onclick="return confirm('Are you sure you want to delete this user?')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="25" color="#c90d0d" fill="none">
    <path d="M5.18007 15.2964C3.92249 16.0335 0.625213 17.5386 2.63348 19.422C3.6145 20.342 4.7071 21 6.08077 21H13.9192C15.2929 21 16.3855 20.342 17.3665 19.422C19.3748 17.5386 16.0775 16.0335 14.8199 15.2964C11.8709 13.5679 8.12906 13.5679 5.18007 15.2964Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    <path d="M14 7C14 9.20914 12.2091 11 10 11C7.79086 11 6 9.20914 6 7C6 4.79086 7.79086 3 10 3C12.2091 3 14 4.79086 14 7Z" stroke="currentColor" stroke-width="1.5" />
    <path d="M22 6.5L17 6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg>


                            </button>
                            </form>
                            @endif


                        </td>
                    </tr>
                @endforeach
            </tbody>

            </table>

        </section>
        <div id="formContainer" class="form-container hidden">
    <div class="container">
        <h1 style="margin-bottom:20px;">Create New User</h1>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="0">Admin</option>
                    <option value="1">Qualificateur</option>
                    <option value="2">Commercial</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
            <button type="button" id="cancelButton" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
</div>
    </main>

  </div>
    <script>
//Loader script
document.addEventListener("DOMContentLoaded", function() {
    // Wait until the page is fully loaded
    window.onload = function() {
        // Set a delay (e.g., 2 seconds)
        setTimeout(function() {
            // Hide the loader
            document.getElementById('loader').style.display = 'none';

            // Show the main content
            document.getElementById('content').style.display = 'block';
        }, 1000);
    };
});



//Create user
document.getElementById('newUserLink').addEventListener('click', function(event) {
        event.preventDefault();
        const formContainer = document.getElementById('formContainer');
        if (formContainer.classList.contains('show')) {
            formContainer.classList.remove('show');
            document.body.classList.remove('form-active');
            setTimeout(() => {
                formContainer.classList.add('hidden');
            }, 300); // Duration matches the CSS transition time
        } else {
            formContainer.classList.remove('hidden');
            setTimeout(() => {
                formContainer.classList.add('show');
                document.body.classList.add('form-active');
            }, 10); // Delay to ensure the transition applies
        }
    });

    document.getElementById('cancelButton').addEventListener('click', function() {
        const formContainer = document.getElementById('formContainer');
        formContainer.classList.remove('show');
        document.body.classList.remove('form-active');
        setTimeout(() => {
            formContainer.classList.add('hidden');
        }, 300); // Duration matches the CSS transition time
    });



///////
         document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('.input-group input');
        const tableRows = document.querySelectorAll('tbody tr');

        // Add event listener to search input
        searchInput.addEventListener('input', searchTable);

        function searchTable() {
            const searchTerm = searchInput.value.trim().toLowerCase();

            tableRows.forEach((row, i) => {
                let rowData = row.textContent.toLowerCase();
                let shouldShow = rowData.includes(searchTerm);

                if (shouldShow) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });

            // Reset background colors and apply alternating colors to visible rows
            let visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])');
            visibleRows.forEach((visibleRow, i) => {
                visibleRow.style.backgroundColor = i % 2 === 0 ? 'transparent' : '#0000000b';
            });
        }
    });
// 2. Sorting | Ordering data of HTML table


    document.addEventListener('DOMContentLoaded', function () {
        const tableHeadings = document.querySelectorAll('thead th');
        const tableRows = document.querySelectorAll('tbody tr');

        let sortAsc = true;

        tableHeadings.forEach((head, i) => {
            head.addEventListener('click', () => {
                // Remove 'active' class from all headings
                tableHeadings.forEach(head => head.classList.remove('active'));

                // Add 'active' class to clicked heading
                head.classList.add('active');

                // Remove 'active' class from all cells
                document.querySelectorAll('td').forEach(td => td.classList.remove('active'));

                // Add 'active' class to cells in the sorted column
                tableRows.forEach(row => {
                    row.querySelectorAll('td')[i].classList.add('active');
                });

                // Toggle 'asc' class and update sorting order
                head.classList.toggle('asc', sortAsc);
                sortAsc = !sortAsc;

                // Perform sorting based on column index and sort order
                sortTable(i, sortAsc);
            });
        });

        function sortTable(column, sortAsc) {
            // Convert NodeList to Array and sort rows based on column content
            const rowsArray = Array.from(tableRows);
            rowsArray.sort((a, b) => {
                let firstRow = a.querySelectorAll('td')[column].textContent.trim().toLowerCase();
                let secondRow = b.querySelectorAll('td')[column].textContent.trim().toLowerCase();

                return sortAsc ? (firstRow > secondRow ? 1 : -1) : (firstRow < secondRow ? 1 : -1);
            });

            // Remove current rows from table
            tableRows.forEach(row => row.parentNode.removeChild(row));

            // Append sorted rows back to the table
            rowsArray.forEach(row => document.querySelector('tbody').appendChild(row));
        }
    });



// 3. Converting HTML table to PDF

document.addEventListener('DOMContentLoaded', function () {
    const pdfBtn = document.querySelector('#toPDF');
    const customersTable = document.querySelector('#customers_table');

    const toPDF = function (element) {
        // Clone the table and exclude actions column and header
        const clonedTable = element.cloneNode(true);

        // Remove actions column from table body
        const actionsColumn = clonedTable.querySelectorAll('.actions');
        actionsColumn.forEach(col => {
            col.parentNode.removeChild(col); // Remove each actions column
        });

        // remove the arrowicons
        const arrowIcons = clonedTable.querySelectorAll('.icon-arrow');
        arrowIcons.forEach(icon => {
            icon.parentNode.removeChild(icon); // Remove each arrow icon
        });

        // Remove actions header from table header
        const actionsHeader = clonedTable.querySelector('thead th.actions');
        if (actionsHeader) {
            actionsHeader.parentNode.removeChild(actionsHeader); // Remove actions header
        }

        // Extracting only the table body section
        const tableBodyContent = clonedTable.querySelector('.table__body').innerHTML;

        // Create HTML content for PDF
        const htmlContent = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Export to PDF</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <style>
                /* Additional styles for PDF layout */
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                th .actions{display:none;}

            </style>
        </head>
        <body>
            <main class="table" id="customers_table">
                <section class="table__body">
                    ${tableBodyContent}
                </section>
            </main>
        </body>
        </html>`;

        // Open new window and write HTML content
        const newWindow = window.open();
        newWindow.document.open();
        newWindow.document.write(htmlContent);
        newWindow.document.close();

        // Delay before printing and closing window
        setTimeout(() => {
            newWindow.print();
            newWindow.close();
        }, 400);
    };

    // Event listener for PDF button click
    pdfBtn.addEventListener('click', () => {
        toPDF(customersTable);
    });
});



// 4. Converting HTML table to JSON

const json_btn = document.querySelector('#toJSON');

const toJSON = function (table) {
    let table_data = [],
        t_head = [],

        t_headings = table.querySelectorAll('th'),
        t_rows = table.querySelectorAll('tbody tr');

    for (let t_heading of t_headings) {
        let actual_head = t_heading.textContent.trim().split(' ');

        t_head.push(actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase());
    }

    t_rows.forEach(row => {
        const row_object = {},
            t_cells = row.querySelectorAll('td');

        t_cells.forEach((t_cell, cell_index) => {
            const img = t_cell.querySelector('img');
            if (img) {
                row_object['customer image'] = decodeURIComponent(img.src);
            }
            row_object[t_head[cell_index]] = t_cell.textContent.trim();
        })
        table_data.push(row_object);
    })

    return JSON.stringify(table_data, null, 4);
}

json_btn.onclick = () => {
    const json = toJSON(customers_table);
    downloadFile(json, 'json')
}

// 5. Converting HTML table to CSV File

const csv_btn = document.querySelector('#toCSV');

const toCSV = function (table) {
    // Code For SIMPLE TABLE
    // const t_rows = table.querySelectorAll('tr');
    // return [...t_rows].map(row => {
    //     const cells = row.querySelectorAll('th, td');
    //     return [...cells].map(cell => cell.textContent.trim()).join(',');
    // }).join('\n');

    const t_heads = table.querySelectorAll('th'),
        tbody_rows = table.querySelectorAll('tbody tr');

    const headings = [...t_heads].map(head => {
        let actual_head = head.textContent.trim().split(' ');
        return actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase();
    }).join(',') + ',' + 'image name';

    const table_data = [...tbody_rows].map(row => {
        const cells = row.querySelectorAll('td'),
            img = decodeURIComponent(row.querySelector('img').src),
            data_without_img = [...cells].map(cell => cell.textContent.replace(/,/g, ".").trim()).join(',');

        return data_without_img + ',' + img;
    }).join('\n');

    return headings + '\n' + table_data;
}

csv_btn.onclick = () => {
    const csv = toCSV(customers_table);
    downloadFile(csv, 'csv', 'customer orders');
}

// 6. Converting HTML table to EXCEL File

const excel_btn = document.querySelector('#toEXCEL');

const toExcel = function (table) {
    // Code For SIMPLE TABLE
    // const t_rows = table.querySelectorAll('tr');
    // return [...t_rows].map(row => {
    //     const cells = row.querySelectorAll('th, td');
    //     return [...cells].map(cell => cell.textContent.trim()).join('\t');
    // }).join('\n');

    const t_heads = table.querySelectorAll('th'),
        tbody_rows = table.querySelectorAll('tbody tr');

    const headings = [...t_heads].map(head => {
        let actual_head = head.textContent.trim().split(' ');
        return actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase();
    }).join('\t') + '\t' + 'image name';

    const table_data = [...tbody_rows].map(row => {
        const cells = row.querySelectorAll('td'),
            img = decodeURIComponent(row.querySelector('img').src),
            data_without_img = [...cells].map(cell => cell.textContent.trim()).join('\t');

        return data_without_img + '\t' + img;
    }).join('\n');

    return headings + '\n' + table_data;
}

excel_btn.onclick = () => {
    const excel = toExcel(customers_table);
    downloadFile(excel, 'excel');
}

const downloadFile = function (data, fileType, fileName = '') {
    const a = document.createElement('a');
    a.download = fileName;
    const mime_types = {
        'json': 'application/json',
        'csv': 'text/csv',
        'excel': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    }
    a.href = `
        data:${mime_types[fileType]};charset=utf-8,${encodeURIComponent(data)}
    `;
    document.body.appendChild(a);
    a.click();
    a.remove();
}
</script>

</body>


@endsection
@section('profilename')
{{ $userName }}
@endsection
@section('role')
Admin
@endsection



@section('routeprospects')

"{{ route('admin.prospects') }}"
@endsection
