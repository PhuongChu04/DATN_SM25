@extends('admin.layouts.layout')
@section('content')
    <div>
        <style>
            .role-form {
                width: auto;
                margin: 50px auto;
                margin-top: 30px;
                padding: 30px;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                font-family: Arial, sans-serif;
            }

            .role-form label {
                display: block;
                margin-bottom: 6px;
                font-weight: bold;
                color: #333;
            }

            .role-form input[type="text"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 14px;
            }

            .role-form button {
                width: 100%;
                padding: 10px;
                background-color: #007BFF;
                color: white;
                border: none;
                font-size: 16px;
                font-weight: bold;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .role-form button:hover {
                background-color: #0056b3;
            }
        </style>


        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif


        <form action="{{ route('admin.auth.postCreateRole') }}" method="POST" class="role-form">
            @csrf
            <label for="name">Tên vai trò:</label>
            <input type="text" id="name" name="name" required>

            <label for="slug">Slug (định danh):</label>
            <input type="text" id="slug" name="slug" required>

            <button type="submit">Tạo vai trò</button>
        </form>


    </div>
    

@endsection
