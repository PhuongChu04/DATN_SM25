@extends('client.layout.layout')

@section('content')
    <!-- login -->
    <style>
    .login-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
        padding: 1rem;
    }
    .login-popup {
        width: 100%;
        max-width: 450px; /* Tăng max-width cho desktop */
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
    .social-login .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border-radius: 6px;
        font-weight: 500;
        text-transform: uppercase;
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    .social-login .facebook-btn {
        background-color: #3b5998;
        color: #fff;
    }
    .social-login .facebook-btn:hover {
        background-color: #2f477a;
    }
    .social-login .google-btn {
        background-color: #fff;
        color: #333;
        border: 1px solid #ddd;
    }
    .social-login .google-btn:hover {
        background-color: #f8f9fa;
    }
    .divider-text {
        text-align: center;
        font-size: 0.875rem;
        color: #6c757d;
        margin: 1rem 0;
        position: relative;
    }
    .divider-text::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background: #e9ecef;
        z-index: 1;
    }
    .divider-text span {
        background: #fff;
        padding: 0 1rem;
        position: relative;
        z-index: 2;
    }
    /* Responsive adjustments */
    @media (max-width: 576px) {
        .login-popup {
            max-width: 90%; /* Thu nhỏ trên mobile */
            padding: 0.25rem;
        }
        .popup-header .title {
            font-size: 1.25rem; /* Giảm kích thước tiêu đề */
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
        .btn-primary, .btn-outline-dark {
            padding: 0.65rem;
            font-size: 0.9rem;
        }
        .social-login .btn {
            padding: 0.65rem;
            font-size: 0.85rem;
        }
    }
    @media (min-width: 992px) {
        .login-popup {
            max-width: 500px; /* Tăng kích thước trên màn hình lớn */
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
        .btn-primary, .btn-outline-dark {
            padding: 0.85rem;
            font-size: 1.1rem;
        }
        .social-login .btn {
            padding: 0.85rem;
            font-size: 1rem;
        }
    }
</style>
<br>
    <div class="mb-4; mt-3" >
        <div class="login-popup">
            <div class="popup-header">
                <h2 class="title">Log In</h2>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="popup-inner">
                <form action="{{ route('auth.postLoginClient') }}" accept-charset="utf-8" class="form-login" method="POST">
                    @csrf
                     @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="required">*</span></label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password"
                            name="password">
                    </div>
                    <div class="mb-3 text-end">
                        <a href="#resetPass" data-bs-toggle="offcanvas" class="text-decoration-none text-primary">Forgot
                            your password?</a>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <button class="btn btn-primary w-100" type="submit">Sign In</button>
                        <a href="{{ route('auth.registerClient') }}"  class="btn btn-outline-dark w-100">Create an Account</a>
                        
                    </div>
                </form>
                <div class="other-login">
                    <p class="divider-text"><span>Or sign in with</span></p>
                    <div class="social-login">
                        <a href="account-page.html" class="btn facebook-btn w-100">
                            <svg class="icon" width="24" height="24" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16" cy="16" r="16" fill="#3B5998" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M20.155 10.656L18.649 10.657C17.468 10.657 17.239 11.218 17.239 12.041V13.857H20.056L19.689 16.702H17.239V24H14.302V16.702H11.846V13.857H14.302V11.76C14.302 9.325 15.789 8 17.96 8C19 8 19.894 8.077 20.155 8.112V10.656ZM16 0C7.164 0 0 7.163 0 16C0 24.836 7.164 32 16 32C24.837 32 32 24.836 32 16C32 7.163 24.837 0 16 0Z"
                                    fill="white" />
                            </svg>
                            Facebook
                        </a>
                        <a href="account-page.html" class="btn google-btn w-100">
                            <svg class="icon" width="24" height="24" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_235_18876)">
                                    <path
                                        d="M30.7919 13.218L17.7394 13.2174C17.163 13.2174 16.6958 13.6845 16.6958 14.2609V18.4306C16.6958 19.0068 17.163 19.4741 17.7393 19.4741H25.0897C24.2848 21.5629 22.7825 23.3122 20.8659 24.4237L24.0001 29.8493C29.0277 26.9416 32.0001 21.8398 32.0001 16.1287C32.0001 15.3155 31.9402 14.7342 31.8203 14.0796C31.7292 13.5823 31.2974 13.218 30.7919 13.218Z"
                                        fill="#167EE6" />
                                    <path
                                        d="M16.0002 25.7392C12.4031 25.7392 9.26282 23.7738 7.57625 20.8655L2.15088 23.9926C4.91182 28.7777 10.0839 32 16.0002 32C18.9025 32 21.6411 31.2186 24.0002 29.8568V29.8494L20.866 24.4237C19.4324 25.2552 17.7734 25.7392 16.0002 25.7392Z"
                                        fill="#12B347" />
                                    <path
                                        d="M24 29.8568V29.8493L20.8658 24.4237C19.4322 25.2551 17.7733 25.7391 16 25.7391V32C18.9023 32 21.641 31.2186 24 29.8568Z"
                                        fill="#0F993E" />
                                    <path
                                        d="M6.26088 16C6.26088 14.2269 6.74475 12.5681 7.57606 11.1346L2.15069 8.00745C0.781375 10.3591 0 13.0903 0 16C0 18.9098 0.781375 21.6409 2.15069 23.9926L7.57606 20.8654C6.74475 19.4319 6.26088 17.7731 6.26088 16Z"
                                        fill="#FFD500" />
                                    <path
                                        d="M16.0002 6.26088C18.3459 6.26088 20.5005 7.09437 22.1834 8.48081C22.5986 8.82281 23.2021 8.79813 23.5824 8.41781L26.5368 5.46344C26.9683 5.03194 26.9375 4.32562 26.4766 3.92575C23.6569 1.47956 19.9881 0 16.0002 0C10.0839 0 4.91182 3.22231 2.15088 8.00744L7.57625 11.1346C9.26282 8.22625 12.4031 6.26088 16.0002 6.26088Z"
                                        fill="#FF4B26" />
                                    <path
                                        d="M22.1833 8.48081C22.5984 8.82281 23.2019 8.79813 23.5822 8.41781L26.5366 5.46344C26.968 5.03194 26.9373 4.32562 26.4764 3.92575C23.6567 1.4795 19.9879 0 16 0V6.26088C18.3456 6.26088 20.5003 7.09437 22.1833 8.48081Z"
                                        fill="#D93F21" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_235_18876">
                                        <rect width="32" height="32" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Google
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- /login -->
@endsection
