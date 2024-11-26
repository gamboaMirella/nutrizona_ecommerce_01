<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ticket de Compra</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .ticket {
      max-width: 400px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2, h3, h4 {
      text-align: center;
      margin-bottom: 10px;
      color: #333;
    }

    .info {
      margin-bottom: 20px;
    }

    .info div {
      margin-bottom: 5px;
      font-size: 14px;
      color: #555;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      color: #777;
      margin-top: 20px;
    }

  </style>
</head>

<body>

  <div class="ticket">
    <h4>Número de Orden: {{ $order->id }}</h4>

    <div class="info">
      <h3>Información de la Compañía</h3>
      <div>Nombre: NutrizonaUnt S.A.C.</div>
      <div>RUC: 2076835644</div>
      <div>Teléfono: 985495789</div>
      <div>Correo: nutrizonaunt@gmail.com</div>
    </div>

    <div class="info">
      <h3>Datos del Cliente</h3>

      {{-- Asegúrate de que $order->address es un array antes de acceder a sus propiedades --}}
      @if(is_array($order->address) && isset($order->address['receiver_info']))
        <div>Nombre: {{ $order->address['receiver_info']['name'] . ' ' . $order->address['receiver_info']['last_name'] }}</div>
        <div>Documento: {{ $order->address['receiver_info']['document_number'] }}</div>
        <div>Dirección: {{ $order->address['description'] }} - {{ $order->address['zone'] }} ({{ $order->address['reference'] }})</div>
        <div>Teléfono: {{ $order->address['receiver_info']['phone'] }}</div>
      @else
        <div>Información del cliente no disponible.</div>
      @endif
    </div>

    <div class="footer">
      ¡Gracias por tu compra!
    </div>
  </div>

</body>
</html>
