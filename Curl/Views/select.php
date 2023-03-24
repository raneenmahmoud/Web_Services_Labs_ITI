<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <style>
      body{
        background: linear-gradient(#46949b,
                #46949b,
                #a3d4f3,
                #c0e6fa);
                display:flex;
                justify-content:center;
                align-items:center;
                background-attachment: fixed;} 
      </style>
</head>
<body>
    <section class="container p-5 d-flex justify-content-center align-items-center">
      <div style="width:80%;" class="shadow-lg p-5 rounded-5">
        <h1 class="text-center p-5">Get Weather</h1>
        <form method="post" action="index.php">
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="city">
            <option selected>Open this select menu</option>
            <?php
            foreach($Egyptian_Cities as $city){
              echo '<option value=' . $city['id'] . '>' . $city['country'] . '>>' . $city['name'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Get weather" style="margin-left:30vw;" class="rounded-3 border border-white">
        <i class="fa-solid fa-location-dot"></i> 
      </form>
      </div>
    </section>
</body>
</html>
