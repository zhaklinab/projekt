<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" > </script>

  <meta charset="utf-8">
  <title>Flete Provimi</title>
</head>

<body>
  <div class="container">

    <!-- Nav tabs -->
    <ul id="mytabs" class="nav nav-tabs" role="tablist">
      <li class="active">
          <a href="#first" role="tab" data-toggle="tab">
              <icon class="fa fa-home"></icon> First tab
          </a>
      </li>
      <li><a href="#second" role="tab" data-toggle="tab">
          <i class="fa fa-user"></i> Second tab
          </a>
      </li>
      <li>
          <a href="#third" role="tab" data-toggle="tab">
              <i class="fa fa-envelope"></i> Third tab
          </a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" id="first">
          <h2>First tab</h2>
          <button type="button" id="changetabbutton" class="btn btn-primary">Set second tab</button>
      </div>
      <div class="tab-pane fade" id="second">
          <h2>Second tab</h2>
      </div>
      <div class="tab-pane fade" id="third">
          <h2>Third tab</h2>
      </div>
    </div>

</div>
</body>
</html>
