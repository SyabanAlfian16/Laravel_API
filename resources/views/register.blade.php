<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
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
                        <h3 class="text-center mb-4">Register</h3>
                        <div id="alert" class="alert d-none"></div>
                        <form id="registerForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                        <div class="text-center mt-3">
                            <p class="mb-0">Sudah punya akun? <a href="/login">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery dan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                
                let formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    confirm_password: $('#confirm_password').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '/api/register',
                    data: formData,
                    success: function(response) {
                        if(response.success) {
                            $('#alert').removeClass('d-none alert-danger').addClass('alert-success')
                                .text('Registrasi berhasil! Anda akan dialihkan...');
                            
                            localStorage.setItem('token', response.data.token);
                            
                            setTimeout(function() {
                                window.location.href = '/login';
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON;
                        $('#alert').removeClass('d-none alert-success').addClass('alert-danger')
                            .text(errors.message || 'Terjadi kesalahan saat registrasi');
                    }
                });
            });
        });
    </script>
</body>
</html> 