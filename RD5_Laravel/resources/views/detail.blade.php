<!DOCTYPE html>
<html lang="en">

    <head>
    <title>明細</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <style>
       body{
        padding: 0;
        margin: 0;
        background-color: #FFF5EE;
      }


      #page-container {
      position: relative;
      min-height: 100vh;
      }


        .navbar-nav{
        margin-left: 60px;
        }

      #navbarCollapse{
        position: relative;
      }

      #guest{
        position: absolute;
        right: 50px;
        color: white;
      }
    
    </style>

    </head>

<body>


<nav class="navbar navbar-expand-md navbar-light" style="background-color: 	#BDB76B;">

<a href="http://localhost:8000/RD5_Assignment/RD5_Laravel/public/" class="navbar-brand">網銀</a>

<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarCollapse">

    <ul class="navbar-nav">

    <li class="nav-item index">
        <a href="./" class="nav-link">首頁</a>
    </li>

    <li class="nav-item withdrawal">
        <a href="action?action=withdrawal" class="nav-link">提款</a>
    </li>

    <li class="nav-item deposit">
        <a href="action?action=deposit" class="nav-link">存款</a>
    </li>

    <li class="nav-item detail">
        <a href="detail" class="nav-link">明細</a>
    </li>

    <li class="nav-item">
        <a href="login?logout=1" class="nav-link">登出</a>
    </li>

    </ul>

    <span id="guest">
    <a href="./" class="btn btn-outline-light btn-sm">你好！{{ Session::get('bank_login') }}</a> 
</span>

</div>
</nav>

<div style="margin-top: 30px;" class="container">

<h2 align="center" style="padding-top:20px;">明細</h2>
             
  <table style="margin-top: 50px;" class="table table-hover table-striped">

    <thead>
      <tr>
        <th>日期</th>
        <th>提出</th>
        <th>存入</th>
        <th>餘額</th>
        <th>備註</th>
      </tr>
    </thead>

    <tbody>

    <?php foreach($customer as $row){ ?>

      <tr>
        <td><?= $row['date'] ?></td>
        <td><?= ($row['action']=="withdrawal" ? $row["cash"]:"") ?></td>
        <td><?= ($row['action']=="deposit" ? $row["cash"]:"") ?></td>
        <td><?= $row['nowBalance'] ?></td>
        <td><?= $row['remarks'] ?></td>
      </tr>

    <?php } ?>


    </tbody>

  </table>

</div>

<script>

    $('.detail').addClass("active");

</script>

</body>
</html>
