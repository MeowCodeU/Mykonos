<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Gestión Vet Mykonos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="src/estilos.css"/>
</head>
<body>

  <div class="login-box">
    <div class="logo-placeholder">
        <img src="src/img/Log Ng Transp.png" alt="Logo Gestión Vet Mykonos" style="max-height: 100px;">
      </div>

    <h3 class="login-title">Iniciar Sesión</h3>

    <form method="POST" action="controlador_login.php">
      <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required />
      </div>

      <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="contrasena" name="contrasena" required />
      </div>

      <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select class="form-select" id="rol" name="rol" required>
          <option value="">Selecciona un rol</option>
          <option value="Administrador">Administrador</option>
          <option value="Recepción">Recepción</option>
          <option value="Médico Veterinario">Médico Veterinario</option>
        </select>
      </div>

      <div class="d-grid mb-2">
        <button type="submit" class="btn btn-login">Ingresar</button>
      </div>

      <div class="text-center">
        <a href="recuperacion.html">¿Olvidaste tu contraseña?</a>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

