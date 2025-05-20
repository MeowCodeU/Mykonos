<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vista Inicial VetGestión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="src/css/estilos2.css" />
</head>
<body class="vista-inicial">

  <!-- NAVBAR SUPERIOR -->
 <?php require_once 'vista/layout/head.php'; ?>

  <!-- CUERPO PRINCIPAL -->
  <div class="d-flex p-3" style="height: calc(100vh - 56px);">

    
    <!-- BARRA LATERAL -->
 <?php require_once 'vista/layout/nav.php'; ?>



    <!-- CONTENIDO PRINCIPAL -->
    <div class="tab-content flex-grow-1 overflow-auto p-4 content-container">
      <div class="tab-pane fade show active" id="inicio">
        <h3 class="mb-4">Bienvenida, Dra. Valeria 🐶</h3>
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="card text-white" style="background-color: #a460a3;">
              <div class="card-body">
                <h5 class="card-title">Pacientes Registrados</h5>
                <p class="card-text display-6">123</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card text-white" style="background-color: #554357;">
              <div class="card-body">
                <h5 class="card-title">Citas para Hoy</h5>
                <p class="card-text display-6">8</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card text-dark" style="background-color: #e6e3eb;">
              <div class="card-body">
                <h5 class="card-title">Medicamentos en Stock</h5>
                <p class="card-text display-6">42</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="paciente">
        <h4>Pacientes Registrados</h4>
        <p>Acceso a las fichas de los clientes y pacientes (próximamente).</p>
      </div>     

      <div class="tab-pane fade" id="historia">
        <h4>Historia Clínica</h4>
        <p>Acceso a las historias clínicas de los pacientes (próximamente).</p>
      </div>

      <div class="tab-pane fade" id="calendario">
        <h4>Calendario</h4>
        <p>Agenda de citas y turnos médicos (próximamente).</p>
      </div>

      <div class="tab-pane fade" id="peluqueria">
        <h4>Módulo de Peluquería</h4>
        <p>Gestión de servicios de estética para mascotas (próximamente).</p>
      </div>

      <div class="tab-pane fade" id="stock">
        <h4 class="mb-4" style="color: #554357;">Inventario de Medicamentos</h4>
        <button class="btn mb-3 text-white" style="background-color: #a460a3;" data-bs-toggle="modal" data-bs-target="#modalAgregar">
          <i class="bi bi-plus-circle me-2"></i>Agregar Medicamento
        </button>
      
        <div class="table-responsive">
          <table id="tablaStock" class="table table-striped table-bordered w-100">
            <thead class="text-white" style="background-color: #554357;">
              <tr>
                <th>Nombre</th>
                <th>Presentación</th>
                <th>Stock (Frasco)</th>
                <th>Unidades/Frasco</th>
                <th>Total Unidades</th>
                <th>Vencimiento</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listaInventario as $item): ?>
                <tr data-id="<?= $item['id'] ?>">
                  <td><?= $item['nombre'] ?></td>
                  <td><?= $item['presentacion'] ?></td>
                  <td><?= $item['stock'] ?></td>
                  <td><?= $item['unidades'] ?></td>
                  <td><?= $item['unidades']*$item['stock'] ?></td>
                  <td><?= date('d/m/Y', strtotime($item['vencimiento'])) ?></td>
                  <td>
                  <button class="btn btn-sm me-1 text-white editar" style="background-color: #a460a3;" 
                          data-bs-toggle="modal" data-bs-target="#modalEditar">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn btn-danger btn-sm eliminar" data-bs-toggle="modal" 
                            data-bs-target="#modalEliminar" data-medicamento="<?= $item['nombre'] ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      
        <!-- Modal Agregar -->
        <div class="modal fade" id="modalAgregar" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #554357;">
                <h5 class="modal-title">Registrar Nuevo Medicamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="formAgregar" method="POST" action="">
                  <input type="hidden" name="accion" value="agregar">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Nombre del Producto*</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Ej: Amoxicilina 250mg" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Tipo de Presentación*</label>
                      <input type="text" class="form-control" name="presentacion" placeholder="Ej: Frasco de 100 ml" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Cantidad en Stock*</label>
                      <input type="number" class="form-control" name="stock" placeholder="N° de frascos" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Unidades por Presentación*</label>
                      <input type="number" class="form-control" name="unidades" placeholder="Ej: 20 dosis de 5ml" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Fecha de Vencimiento*</label>
                      <input type="date" class="form-control" name="vencimiento" required>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn text-white" style="background-color: #a460a3;">
                      <i class="bi bi-save me-2"></i>Guardar
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      <i class="bi bi-x-circle me-2"></i>Cancelar
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
                

      </div>
    </div>
  </div>

  <!-- MODAL CERRAR SESIÓN -->
  <div class="modal fade" id="modalCerrarSesion" tabindex="-1" aria-labelledby="cerrarSesionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cerrarSesionLabel">¿Cerrar sesión?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          ¿Estás segura de que deseas cerrar sesión? 🐾✨
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" onclick="location.href='login.html'">Sí, cerrar</button>
        </div>
      </div>
    </div>
  </div>
 <!-- Modal Editar -->
 <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #554357;">
                <h5 class="modal-title">Editar Medicamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form id="formEditar" method="POST" action="">
                <div class="modal-body">
                  <input type="hidden" name="accion" value="editar">
                  <input type="hidden" name="id" id="editar-id">

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Nombre del Producto*</label>
                      <input type="text" class="form-control" name="nombre" id="editar-nombre" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Tipo de Presentación*</label>
                      <input type="text" class="form-control" name="presentacion" id="editar-presentacion" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Cantidad en Stock*</label>
                      <input type="number" class="form-control" name="stock" id="editar-stock" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Unidades por Presentación*</label>
                      <input type="text" class="form-control" name="unidades" id="editar-unidades" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Fecha de Vencimiento*</label>
                      <input type="date" class="form-control" name="vencimiento" id="editar-vencimiento" required>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn text-white" style="background-color: #a460a3;">
                    <i class="bi bi-arrow-repeat me-2"></i>Actualizar
                  </button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Cancelar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal Eliminar -->
        <form id="formEliminar" method="POST" action="">
          <input type="hidden" name="accion" value="eliminar">
          <input type="hidden" name="id" id="eliminar-id">

          <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title">❗ Confirmar Eliminación</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <p class="lead">¿Estás segura de eliminar el medicamento <strong id="nombreMedicamentoEliminar">Amoxicilina 250mg</strong>?</p>
                  <p class="text-muted">Esta acción no se puede deshacer</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Cancelar
                  </button>
                  <!-- Aquí el botón que envía el formulario -->
                  <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash me-2"></i>Sí, eliminar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>

  <!-- SCRIPTS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      // Inicializar DataTable solo para inventario
      $('#tablaStock').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
      });
  
      // Pasar nombre del medicamento al modal de eliminar
      $('.eliminar').click(function() {
        const nombreMed = $(this).data('medicamento');
        $('#nombreMedicamentoEliminar').text(nombreMed);
      });
  
      // Lógica para eliminar (simulada)
      $('#confirmarEliminar').click(function() {
        $('#modalEliminar').modal('hide');
        alert('Medicamento eliminado (esto sería AJAX en producción)');
      });
  

    });

    document.querySelectorAll('.editar').forEach(boton => {
  boton.addEventListener('click', function () {
    const fila = this.closest('tr');
    document.getElementById('editar-id').value = fila.dataset.id;
    document.getElementById('editar-nombre').value = fila.children[0].textContent;
    document.getElementById('editar-presentacion').value = fila.children[1].textContent;
    document.getElementById('editar-stock').value = fila.children[2].textContent;
    document.getElementById('editar-unidades').value = fila.children[3].textContent;
    document.getElementById('editar-vencimiento').value = fila.children[5].textContent;
    modalEditar.modal('show');
  });
});

document.querySelectorAll('.eliminar').forEach(boton => {
  boton.addEventListener('click', function () {
    const fila = this.closest('tr');
    const id = fila.dataset.id;
    const nombre = fila.children[0].textContent;

    document.getElementById('eliminar-id').value = id;
    document.getElementById('nombreMedicamentoEliminar').textContent = nombre;
  });
});

  </script>
</body>
       
</html>