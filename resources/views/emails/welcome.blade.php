<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border: 1px solid #e5e7eb; border-radius: 8px; }
        .header { font-size: 20px; font-weight: bold; color: #1e3a8a; margin-bottom: 15px; }
        .footer { margin-top: 20px; font-size: 12px; color: #6b7280; border-top: 1px solid #e5e7eb; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">¡Hola, {{ $nombreUsuario }}! 👋</div>
        <p>Tu cuenta ha sido creada con éxito en nuestra plataforma de gestión de incidencias.</p>
        <p>A partir de este momento puedes iniciar sesión para reportar fallas técnicas, realizar el seguimiento de tus solicitudes y recibir soporte especializado por parte de nuestro equipo de ingenieros.</p>
        <p>Atentamente,<br><strong>El Equipo de Soporte Técnico UTN</strong></p>
        <div class="footer">Este es un correo automático, por favor no respondas a este mensaje.</div>
    </div>
</body>
</html>
