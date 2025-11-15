<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register — Merah Putih</title>

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

    .register-card{
      width: 100%;
      max-width: 480px;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.25);
      overflow: hidden;
      background: var(--brand-white);
    }

    .register-header{
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

    .register-body{ padding: 1.5rem; }

    .form-control:focus{ box-shadow: none; border-color: #b71c1c; }
    .btn-primary{
      background-color: var(--brand-red);
      border-color: var(--brand-red);
    }
    .btn-primary:hover{ background-color: #9a1a1a; border-color: #9a1a1a }

    .small-note{ font-size: 0.85rem; color: #666; }

    @media (max-width: 420px){
      body{ padding: 1rem; }
      .register-header{ padding: 1rem; }
    }
  </style>
</head>
<body>
  <main class="register-card">
    <header class="register-header d-flex align-items-center">
      <div class="logo-circle">RI</div>
      <div>
        <h5 class="mb-0">Buat Akun Baru</h5>
        <small>Gabung dengan tema Merah & Putih</small>
      </div>
    </header>

    <section class="register-body">
      <form id="registerForm" action="proses_register.php" method="POST" novalidate>
        <div class="mb-3">
          <label for="namaLengkap" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="namaLengkap" name="nama" placeholder="Masukkan nama lengkap Anda" required>
          <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required>
          <div class="invalid-feedback">Masukkan email yang valid.</div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" required minlength="6">
          <div class="invalid-feedback">Kata sandi minimal 6 karakter.</div>
          <input type="hidden" name="sebagai" value="cust">
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary btn-lg">Daftar</button>
        </div>

        <div class="text-center mt-3 small-note">
          Sudah punya akun? <a href="login.php">Masuk di sini</a>
        </div>
      </form>
    </section>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    (function () {
      const form = document.getElementById('registerForm');
      form.addEventListener('submit', function (e) {
        const pass = document.getElementById('password').value;
        const confirm = document.getElementById('confirmPass').value;

        // Validasi Bootstrap
        if (!form.checkValidity()) {
          e.preventDefault();
          e.stopPropagation();
          form.classList.add('was-validated');
          return;
        }

        // Cek konfirmasi password
        if (pass !== confirm) {
          e.preventDefault();
          e.stopPropagation();
          Swal.fire({
            title: 'Oops!',
            text: 'Konfirmasi kata sandi tidak cocok!',
            icon: 'error',
            confirmButtonColor: '#b71c1c'
          });
          return;
        }

        // Jika valid, tampilkan alert sukses (sementara)
        Swal.fire({
          title: 'Berhasil!',
          text: 'Pendaftaran berhasil! (Simulasi)',
          icon: 'success',
          confirmButtonColor: '#b71c1c'
        });
      });
    })();
  </script>
</body>
</html>
