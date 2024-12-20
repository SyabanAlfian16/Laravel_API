<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 1rem;
            border: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Login</h3>
                        <div id="alert" class="alert d-none"></div>
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <p class="mb-0">Belum punya akun? <a href="/register">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                let formData = {
                    email: $('#email').val(),
                    password: $('#password').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '/api/login',
                    data: formData,
                    success: function(response) {
                        if(response.success) {
                            $('#alert').removeClass('d-none alert-danger').addClass('alert-success')
                                .text('Login berhasil! Anda akan dialihkan...');
                            
                            localStorage.setItem('token', response.data.token);
                            
                            setTimeout(function() {
                                window.location.href = '/dashboard';
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON;
                        $('#alert').removeClass('d-none alert-success').addClass('alert-danger')
                            .text(errors.message || 'Email atau password salah');
                    }
                });
            });
        });
    </script>
</body>
</html> 