<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <p>
        {{ $alarmaIva_message }} <br />
        @foreach ($cuentas as $cta)
            <td><small>{{ $cta->cuenta_banco }}</small></td>
            <td><small>{{ $cta->cuenta_tipo }}</small></td>
            <td><small>{{ $cta->cuenta_numero }}</small></td>
        @endforeach

    </p>
  </body>
</html>
