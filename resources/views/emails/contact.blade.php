<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Nuevo mensaje de contacto</title>
    </head>

    <body style="font-family: Arial, sans-serif; color: #243746;">

        <div style="max-width: 650px; margin: auto; padding: 25px;">

            <h2 style="color: #2F3A73;">
                Nuevo mensaje de contacto
            </h2>

            <p>Se ha recibido una consulta desde Servicios Valensa.</p>

            <hr>

            <p><strong>Nombre:</strong> {{ $contactName }}</p>
            <p><strong>Correo:</strong> {{ $contactEmail }}</p>
            <p><strong>Asunto:</strong> {{ $contactSubject }}</p>

            <h3>Mensaje</h3>

            <div style="background: #f3f5fa; padding: 20px;
                    border-radius: 8px; white-space: pre-wrap;">{{ $contactBody }}</div>

            <hr>

            <small>Mensaje enviado desde el sitio web de Servicios Valensa.</small>

        </div>

    </body>

</html>