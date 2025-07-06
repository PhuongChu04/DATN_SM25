@extends('admin.layouts.layout')
@section('content')
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
    <div>
        

        {{-- @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif --}}

        <form action="{{ route('admin.auth.attachUserRole') }}" method="POST" class="role-form">
            @csrf

            <label for="email">Email Người dùng:</label>
            <input type="email" name="email" id="email" required>

            <label for="role_name">Tên Quyền (Role):</label>
            <select name="role_name" id="role_name" required>
                <option value="">-- Chọn Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->slug }}">{{ $role->name }}</option>
                @endforeach
            </select>

            <button type="submit">Thêm quyền</button>
        </form>
         @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif


    </div>

@endsection
