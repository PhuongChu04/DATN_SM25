@extends('admin.layouts.layout')

@section('content')
<div class="container mt-5">
    <h2>Chi tiết liên hệ</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $contact->id }}</p>
            <p><strong>Họ tên:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Nội dung:</strong></p>
            <p>{{ $contact->message }}</p>
            <p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>

            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>
@endsection
