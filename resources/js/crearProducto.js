<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
$('#crearProductoForm').submit(function(e) {
    e.preventDefault(); // Prevenir el envío normal del formulario

    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
            // Mostrar la alerta de éxito
            alert(response.message);

            // Recargar la página después de que el usuario cierre la alerta
            location.reload();
        },
        error: function(xhr) {
            // Si hubo un error en la solicitud, mostrar un mensaje de error
            alert('Hubo un error al crear el producto');
        }
    });
});