@extends('client.layout.layout')

@section('content')
    <style>
        .register-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            padding: 1rem;
        }

        .register-popup {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background: #fff;
            padding: 0.5rem;
        }

        .popup-header {
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .popup-header .title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .popup-header .btn-close {
            font-size: 0.875rem;
        }

        .popup-inner {
            padding: 1.5rem;
        }

        .form-control {
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 1rem;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            font-size: 0.95rem;
        }

        .required {
            color: #dc3545;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.75rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-dark {
            border: 1px solid #333;
            border-radius: 6px;
            padding: 0.75rem;
            font-weight: 500;
            font-size: 1rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-outline-dark:hover {
            background-color: #333;
            color: #fff;
        }

        .text-main-2 {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .register-popup {
                max-width: 90%;
                padding: 0.25rem;
            }

            .popup-header .title {
                font-size: 1.25rem;
            }

            .popup-inner {
                padding: 1rem;
            }

            .form-control {
                padding: 0.65rem;
                font-size: 0.9rem;
            }

            .form-label {
                font-size: 0.85rem;
            }

            .btn-primary,
            .btn-outline-dark {
                padding: 0.65rem;
                font-size: 0.9rem;
                
            }

            .text-main-2 {
                font-size: 0.8rem;
            }
        }

        @media (min-width: 992px) {
            .register-popup {
                max-width: 500px;
            }

            .popup-header .title {
                font-size: 1.75rem;
            }

            .form-control {
                padding: 0.85rem;
                font-size: 1.1rem;
            }

            .form-label {
                font-size: 1rem;
            }

            .btn-primary,
            .btn-outline-dark {
                padding: 0.85rem;
                font-size: 1.1rem;
                
            }
        }
    </style>
    <div class="mb-3,mt-3">
        <div class="register-container">
            <div class="register-popup">
                <div class="popup-header">
                    <h2 class="title">Create Account</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div>

                </div>
                <div class="popup-inner">
                    <form action="{{ route('auth.postRegisterClient') }}" class="form-login" method="POST">
                        @csrf
                       

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Enter your first name">

                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Enter your last name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="required">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="required">*</span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password" required>
                        </div>

                        <div class="bot">
                            <p class="text text-sm text-main-2">Đăng ký tài khoản để sử dụng tất cả dịch vụ của chúng tôi
                            </p>
                            <div class="button-wrap d-flex flex-column gap-2">
                                <button class="btn btn-primary w-100" type="submit">Sign Up</button>

                                <a href="{{ route('auth.loginClient') }}" class="btn btn-outline-dark w-100" style="text-decoration: none;">Sign In</a>
                                {{-- <button type="submit" data-bs-target="#login" data-bs-toggle="offcanvas"></button> --}}
                            </div>

                        </div>
                        @if ($errors->has('error'))
                            <div class="alert alert-danger">
                                {{ $errors->first('error') }}
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
