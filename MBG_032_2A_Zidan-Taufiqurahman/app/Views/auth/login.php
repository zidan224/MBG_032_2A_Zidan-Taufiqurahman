<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.6s ease-in-out;
        }
        .login-card h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .btn-primary {
            background-color: #2575fc;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #1a5fd6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <?php 
        // Ambil flashdata error dan validasi
        $error = session()->getFlashdata('error'); 
        $validation = session()->getFlashdata('errors'); // CodeIgniter 4 menyimpan error validasi di 'errors'
        $is_error = $error || $validation;
    ?>
    <div class="login-card">
        <h2>Login</h2>
        
        <form method="post" action="/auth/doLogin">
            
            <?php if ($error): // Tampilkan pesan error utama (validasi/autentikasi) ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="nameInput" class="form-label">Username</label>
                <input type="text" name="name" id="nameInput" 
                        class="form-control <?= ($is_error || isset($validation['name'])) ? 'is-invalid' : '' ?>" 
                        value="<?= old('name') ?>" required>
                <?php if (isset($validation['name'])): // Tampilkan error validasi spesifik nama ?>
                    <div class="invalid-feedback">
                        <?= $validation['name'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" name="password" id="passwordInput" 
                        class="form-control <?= ($is_error || isset($validation['password'])) ? 'is-invalid' : '' ?>" 
                        required>
                <?php if (isset($validation['password'])): // Tampilkan error validasi spesifik password ?>
                    <div class="invalid-feedback">
                        <?= $validation['password'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
    
    <script>
        // Script untuk menghapus kelas is-invalid saat user mulai mengetik
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('nameInput');
            const passwordInput = document.getElementById('passwordInput');

            function handleInput(event) {
                // Hapus kelas 'is-invalid' saat input diubah
                event.target.classList.remove('is-invalid');
            }

            if (nameInput) {
                nameInput.addEventListener('input', handleInput);
            }
            if (passwordInput) {
                passwordInput.addEventListener('input', handleInput);
            }
            
            // Sembunyikan alert error saat user mulai mengetik
            const alertDiv = document.querySelector('.alert-danger');
            if (alertDiv) {
                [nameInput, passwordInput].forEach(input => {
                    input.addEventListener('input', () => {
                        alertDiv.style.display = 'none';
                    });
                });
            }
        });
    </script>
</body>
</html>