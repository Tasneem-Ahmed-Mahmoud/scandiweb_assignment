<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OOP Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>



  <section>
    <div class="container">
      <div class="row">
        <div class=" d-flex justify-content-between align-items-center py-5">
          <h1>Product Add</h1>
          <div class="buts">
            <button class="btn btn-primary  text-capitalize" id="save" type="submit">save</button>
            <a class="btn btn-danger  text-capitalize " href="/" id="cancel">Cancel</a>
          </div>
        </div>
        <hr>
        <form class="w-75 py-2" id="product_form">


          <div class="alert alert-info d-none message">

          </div>

          <div class="form-group mt-2 row">
            <label class="col-sm-2 col-form-label" for="sku">SKU:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="sku" aria-describedby="textHelp" placeholder="sku" name="sku">
            </div>

          </div>

          <div class="form-group mt-2 row">
            <label class="col-sm-2 col-form-label" for="name">Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" aria-describedby="textHelp" placeholder="name" name="name">
            </div>
          </div>

          <div class="form-group mt-2 row">
            <label class="col-sm-2 col-form-label" for="price">Price ($):</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="price" aria-describedby="emailHelp" placeholder="price" name="price">
            </div>
          </div>

          <div class="form-group mt-2 row mb-4">
            <label class="col-sm-2 col-form-label" for="productType">Switcher:</label>
            <div class="col-sm-10">
              <select class="form-select" id="productType" name="type">
                <option selected>Type Switcher</option>
                <?php foreach ($types as $type) : ?>
                  <option value="<?= $type ?>"><?= $type ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!-- Container for additional inputs -->
          <div id="additionalInputs"></div>
          <!-- DVD specific input -->
          <small class="form-text text-muted dvd d-none">Please, provide size</small>
          <div class="form-group mt-2 row dvd d-none">
            <label class="col-sm-2 col-form-label" for="size">Size (MB):</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="size" aria-describedby="emailHelp" placeholder="size" name="size">
            </div>
          </div>

          <!-- Book specific input -->
          <small class="form-text text-muted weight book d-none">Please, provide weight</small>
          <div class="form-group mt-2 row weight  book d-none">
            <label class="col-sm-2 col-form-label" for="weight">Weight (KG):</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="weight" aria-describedby="emailHelp" placeholder="weight" name="weight">
            </div>
          </div>

          <!-- Furniture specific inputs -->
          <small class="form-text text-muted furniture d-none">Please, provide dimensions</small>
          <div class="form-group mt-2 row furniture d-none">
            <label class="col-sm-2 col-form-label" for="height">Height (CM):</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="height" aria-describedby="emailHelp" placeholder="height" name="height">
            </div>
          </div>
          <div class="form-group mt-2 row furniture d-none">
            <label class="col-sm-2 col-form-label" for="width">Width (CM):</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="width" aria-describedby="emailHelp" placeholder="width" name="width">
            </div>
          </div>
          <div class="form-group mt-2 row furniture d-none">
            <label class="col-sm-2 col-form-label" for="length">Length (CM):</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="length" aria-describedby="emailHelp" placeholder="length" name="length">
            </div>
          </div>

        </form>

      </div>
    </div>
  </section>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      // select product type
      $('#productType').change(function() {
        var selectedOption = $(this).val();
        // Hide all specific input fields
        $('.dvd, .book, .furniture').addClass('d-none');
        // Show input fields based on selection
        if (selectedOption === 'DVD') {
          $('.dvd').removeClass('d-none');
        } else if (selectedOption === 'Book') {
          $('.book').removeClass('d-none');
        } else if (selectedOption === 'Furniture') {
          $('.furniture').removeClass('d-none');
        }
      });
      // save data
      $('#save').click(function(event) {
        event.preventDefault();
        let formData = $('#product_form').serialize();
        $.post('/products', formData)
          .done(function(response) {
            console.log(response);
            if (response === "success") {
              window.location.href = '/';
            } else {
              $('.message').removeClass('d-none')
                .text(response)
                .removeClass('alert-success alert-info')
                .addClass('alert-danger');
            }
          })
          .fail(function(jqXHR, textStatus, errorThrown) {
            $('.message').removeClass('d-none')
              .text(errorThrown)
              .removeClass('alert-success alert-info')
              .addClass('alert-danger');
          });
      });
    });
  </script>
</body>

</html>