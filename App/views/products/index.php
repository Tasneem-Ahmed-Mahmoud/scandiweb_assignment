<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OOP Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
  ul {
    list-style-type: none;
  }
</style>

<body>


  <section>
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center py-5">
          <h1>Product List</h1>
          <div class="buts">
            <a href="addProduct" class="btn btn-primary   text-uppercase">ADD</a>
            <button class="btn btn-danger  text-uppercase " id="delete-product-btn">MASS DELETE</button>
          </div>

        </div>
        <hr>

        <div class="alert alert-info d-none message text-center" role="alert">

        </div>

        <!-- start product -->
        <?php foreach ($products as $product) : ?>
          <div class="col-md-3">
            <div class="  card  border-3 m-1">
              <div class="card-body mt-0">
                <div class="check ">
                  <div class="form-check"></div>
                  <input class="form-check-input delete-checkbox" type="checkbox" value="<?= $product['id'] ?>">
                </div>
                <div class="content ">
                  <ul class=" ms-3">
                    <li>sku: <?= $product['sku'] ?></li>
                    <li class="my-1">Name: <?= $product['name'] ?></li>
                    <li class="mb-1">price: <?= $product['price'] ?>$</li>
                    <li> <?= $product['attribute'] ?></li>
                  </ul>
                </div>


              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </section>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      // submit delete form
      $('#delete-product-btn').click(function() {
        var ids = [];

        $('.delete-checkbox:checked').each(function() {
          ids.push($(this).val());
        });

        if (ids.length > 0) {

          $.ajax({
            url: '/products/delete',
            type: 'POST',
            data: {
              ids: ids
            },
            success: function(response) {
              console.log(response);
              location.reload();
            },
            error: function(xhr, status, error) {

              $('.message').removeClass('d-none');
              $('.message').text('An error occurred while deleting products');
              $('.message').removeClass('alert-info');
              $('.message').addClass('alert-danger');
            }
          });
        } else {
          $('.message').removeClass('d-none');
          $('.message').text('Please select at least one product');
          $('.message').removeClass('d-none');
          $('.message').removeClass('alert-danger').addClass('alert-info');

        }
      });


    })
  </script>
</body>

</html>