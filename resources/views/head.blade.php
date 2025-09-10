<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"rel="stylesheet" />
        <!-- Estilos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css"/>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link href="{{asset('css/form.css')}}" rel="stylesheet" />
 <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
     <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

     
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        
        <script>
       /* $(document).ready(function () {
            $('#example').DataTable();
        });*/
        </script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
      @vite('resources/js/app.js', 'resources/css/app.css')
</head>