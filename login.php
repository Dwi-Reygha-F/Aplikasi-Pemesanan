<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login — Bimbob Printing</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    :root{
      --brand-red: #c62828;
      --brand-white: #ffffff;
    }

    body{
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      padding: 2rem;
    }

    .login-card{
      width: 100%;
      max-width: 420px;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.25);
      overflow: hidden;
      background: var(--brand-white);
    }

    .login-header{
      background: linear-gradient(90deg, #b71c1c, #e53935);
      color: var(--brand-white);
      padding: 1.25rem 1.5rem;
    }

    .logo-circle{
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: var(--brand-white);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: var(--brand-red);
      font-weight: 700;
      margin-right: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    a {
  color: var(--brand-red);
  text-decoration: none;
  font-weight: 600;
}

a:hover {
  text-decoration: underline;
  color: #9a1a1a;
}


    .login-body{ padding: 1.5rem; }

    .form-control:focus{ box-shadow: none; border-color: #b71c1c; }
    .btn-primary{
      background-color: var(--brand-red);
      border-color: var(--brand-red);
    }
    .btn-primary:hover{ background-color: #9a1a1a; border-color: #9a1a1a }

    .small-note{ font-size: 0.85rem; color: #666; }

    @media (max-width: 420px){
      body{ padding: 1rem; }
      .login-header{ padding: 1rem; }
    }
  </style>
</head>
<body>
  <main class="login-card">
    <header class="login-header d-flex align-items-center">
      <div class="logo-circle"><img src="img/logo.png" width="50px"></div>
      <div>
        <h5 class="mb-0">Selamat Datang</h5>
        <small>Masuk ke akun Anda</small>
      </div>
    </header>

    <section class="login-body">
      <!-- Arahkan form ke cek_login.php -->
      <form id="loginForm" action="cek_login.php" method="POST" novalidate>
        <div class="mb-3">
          <label for="inputUser" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputUser" name="email" placeholder="contoh@email.com" required>
          <div class="invalid-feedback">Email atau username wajib diisi.</div>
        </div>

        <div class="mb-3">
          <label for="inputPass" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control" id="inputPass" name="password" placeholder="Masukkan kata sandi" required minlength="6">
          <div class="invalid-feedback">Kata sandi minimal 6 karakter.</div>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
        </div>

        <div class="text-center mt-3 small-note">
          Belum punya akun? <a href="register.php">Daftar sekarang</a>
        </div>
        <div class="text-center mt-3"><a href="index.php"> <- Kembali</a></div>
      </form>
    </section>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Validasi Bootstrap biar rapi
    (function () {
      const form = document.getElementById('loginForm');
      form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) {
          e.preventDefault();
          e.stopPropagation();
          form.classList.add('was-validated');
        }
      });
    })();
  </script>
</body>
</html>
