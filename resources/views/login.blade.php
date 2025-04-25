<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ACLC Tacloban Student Tuition Payment System Login">
  <title>Login | ACLC Tacloban Tuition System</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script type="text/javascript" src="{{ asset('javascript/main.js') }}"></script>
</head>
<body>

  <main class="login-container">
    <section class="brand-section" aria-label="ACLC Tacloban branding">
      <img class="brand-logo" src="{{ asset('images/aclctacloban.png') }}" alt="ACLC Tacloban Logo" width="150">
      <h1 class="system-name">Student Tuition Payment System</h1>
      <img class="feature-image" src="{{ asset('images/cash-register.png') }}" alt="Illustration of cash register" width="350">
    </section>

    <section class="login-section" aria-label="Login form">
      <form class="login-form" id="loginForm" action="/login" method="POST">
        @csrf

        {{-- User Icon --}}
        <div class="user-avatar">
          <img src="{{ asset('images/user.png') }}" alt="User profile icon" width="60" height="60">
        </div>

        {{-- Display validation errors --}}
        {{-- @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif --}}

        {{-- Username --}}
        <div class="form-floating mb-3">
          <input type="text" name="loginusername" value="{{ old('loginusername') }}" autocomplete="username" class="form-control" id="floatingInput" placeholder="username"  style="min-width: 350px;">
          <label for="floatingInput">Username</label>
          @error('loginusername')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        {{-- Password --}}
        <div class="form-floating">
          <input type="password" name="loginpassword" autocomplete="current-password" class="form-control" id="floatingPassword" placeholder="password"  style="min-width: 350px;">
          <label for="floatingPassword">Password</label>
          @error('loginpassword')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        {{-- Show Password (optional JS toggle logic) --}}
        {{-- 
        <div class="password-toggle">
          <input type="checkbox" id="togglePassword" name="togglePassword" onchange="displayPw()">
          <label for="togglePassword">Show Password</label>
        </div>
        --}}

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>

        {{-- Forgot Password link --}}
        <div class="form-footer mt-3 text-center">
          <a href="#forgot-password" class="forgot-password">Forgot Password?</a>
        </div>
      </form>
    </section>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"
  ></script>

</body>
</html>
