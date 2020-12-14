<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
  <p> Estimados: <b> {{ $alarmaIva_empresa }} </b> <br /> <br />

            {{ $alarmaIva_message }} <br /><br /><br />

      El monto total de Neto pendiente segun el tipo de moneda corresponde a: <br /><br /><br />
      Agradeceremos regularizar esta situaci&oacute;n a la brevedad, para lo cual, disponemos de las siguientes cuentas bancarias  <br /><br /><br />
        <table class="egt">
            <head class="thead-dark">
            <tr>
                <th scope="col">BANCO </th>
                <th scope="col"> </th>
                <th scope="col"> </th>
                <th scope="col">CUENTA </th>
                <th scope="col"> </th>
                <th scope="col"> </th>
                <th scope="col">TIPO </th>
            </tr>
            </head>
            <body>
            @foreach ($cuentas as $cta)
                <tr>

                    <td>{{ $cta->cuenta_banco }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $cta->cuenta_numero }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $cta->cuenta_tipo }}</td>

                </tr>
            @endforeach
            </body>
        </table>

  <br />  <br />
  <b> SURAGRA S.A. </b>  <br /> <br />

  <b> RUT 76.148.635-7 </b>



    </p>
  </body>
</html>
