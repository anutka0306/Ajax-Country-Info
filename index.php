<?php require "ajax.php"; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Ajax Related Forms</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css.css">

</head>

<body>
<div class="container">
  <h3>Choose any country and city and get information <span class="badge badge-success"> Without reloading the page</span></h3>
  <form>
<div class="form-group">
  <label for="name" class="col-sm-2 control-label">Country</label>
  <div class="col-sm-6">
    <select class="form-control" name="country" id="country">
      <option disabled selected>Choose country</option>
      <?php foreach($countries as $country): ?>
      <option value="<?=$country['Code']?>"><?=$country['Name']?></option>
    <?php endforeach; ?>
    </select>
  </div>
</div>

<div class="form-group city-select">
<label for="name" class="col-sm-2 control-label">City</label>
<div class="col-sm-6">
  <select class="form-control" name="city" id="city">

  </select>
</div>
</div>
</form>
  <div class="row">
    <div class="col-sm-8 country-info shadow-lg p-3 mb-5 bg-white rounded">
      <h3 class="text-primary">Country Information</h3>
      <div id="coutryInfo"></div>
      <div id="population" class="city-population"></div>

    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
$(function(){

 $('#country').change(function(){
  var code = $(this).val();
  $('#city').load('ajax.php', {code: code}, function(){
 $('.city-select').fadeIn('slow');
$('.city-population').fadeOut('fast');

  });
  $('#coutryInfo').load('ajax.php',{code2: code});


 });

 $('#city').change(function(){
   var cityId = $(this).val();
   $('#population').load('ajax.php', {cityId: cityId}, function(){
     $('.country-info').fadeIn('slow');
     $('.city-population').fadeIn('slow');
   });
 });

});
</script>
</body>
</html>
