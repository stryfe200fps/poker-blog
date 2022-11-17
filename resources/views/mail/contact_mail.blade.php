<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Email</title>
  </head>
  <body>

    <h1>Life of poker</h1>

  <div class="card" >
  <ul class="list-group list-group-flush">
    <li class="list-group-item">{{ $form->email }}</li>
    <li class="list-group-item">{{ $form->name }}</li>
    <li class="list-group-item">{{ $form->subject }}</li>
    <li class="list-group-item">{{ $form->message }}</li>
    <li class="list-group-item">{{ $form->created_at }}</li>
  </ul>
</div>


  </body>
</html>