
<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8" />
    <title>Service Centres</title>
    <script data-require="jquery@*" data-semver="3.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
  </head>

  <body>
    <h1 align="center">Service Centres</h1>
    <table border="1"  id="service_table" class="display">
      <thead>
        <tr>
          <th>Centre Postcode</th>
          <th>Centre Type</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>12345</td>
          <td>Standard</td>
        </tr>
        <tr>
          <td>12345</td>
          <td>Standard</td>
        </tr>
        <tr>
          <td>12345</td>
          <td>Standard1</td>
        </tr>
      </tbody>
    </table>
    <script type="text/javascript">
      $(document).ready(
        function() {
          $('#service_table').DataTable();
        });

    </script>
  </body>

</html>
