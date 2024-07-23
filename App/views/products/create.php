<?php include_once __DIR__ . '/../layouts/header.php';?>



<section>
    <div class="container">
        <div class="row">
            <div class=" d-flex justify-content-between align-items-center py-5">
            <h1>Product Add</h1>
            <div class="buts">
                <button class="btn btn-primary  text-capitalize" id="save" type="submit">save</button>
                <a  class="btn btn-danger  text-capitalize " href="/" id="cancel">Cancel</a>
            </div>
            </div>
            <hr>
<form action="products" method="POST" class="w-75 py-2" id="product_form">
<?php if (isset($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errors ?>
    </div>
    <?php endif;?>
  <div class="form-group mt-2 row">
    <label class="col-sm-2 col-form-label" for="sku">SKU:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="sku" aria-describedby="textHelp" placeholder="Enter SKU" name="sku">
    </div>
  </div>

  <div class="form-group mt-2 row">
    <label class="col-sm-2 col-form-label" for="name">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" aria-describedby="textHelp" placeholder="Enter Name" name="name">
    </div>
  </div>

  <div class="form-group mt-2 row">
    <label class="col-sm-2 col-form-label" for="price">Price ($):</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="price" aria-describedby="emailHelp" placeholder="Enter price" name="price">
    </div>
  </div>

  <div class="form-group mt-2 row mb-4">
    <label class="col-sm-2 col-form-label" for="productType">Switcher:</label>
    <div class="col-sm-10">
      <select class="form-select" id="productType" name="type">
      <option selected >Select Type</option>
      <?php foreach ($types as $type): ?>
        <option value="<?=$type?>"><?=$type?></option>
        <?php endforeach;?>
      </select>
    </div>
  </div>

  <!-- DVD specific input -->
  <small class="form-text text-muted dvd d-none">Please, provide size</small>
  <div class="form-group mt-2 row dvd d-none">
    <label class="col-sm-2 col-form-label" for="size">Size (MB):</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="size" aria-describedby="emailHelp" placeholder="Enter size" name="size">
    </div>
  </div>

  <!-- Book specific input -->
  <small class="form-text text-muted weight book d-none">Please, provide weight</small>
  <div class="form-group mt-2 row weight  book d-none">
    <label class="col-sm-2 col-form-label" for="weight">Weight (KG):</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="weight" aria-describedby="emailHelp" placeholder="Enter weight" name="weight">
    </div>
  </div>

  <!-- Furniture specific inputs -->
   <small class="form-text text-muted furniture d-none">Please, provide dimensions</small>
  <div class="form-group mt-2 row furniture d-none">
    <label class="col-sm-2 col-form-label" for="height">Height (CM):</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="height" aria-describedby="emailHelp" placeholder="Enter height" name="height">
    </div>
  </div>
  <div class="form-group mt-2 row furniture d-none">
    <label class="col-sm-2 col-form-label" for="width">Width (CM):</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="width" aria-describedby="emailHelp" placeholder="Enter width" name="width">
    </div>
  </div>
  <div class="form-group mt-2 row furniture d-none">
    <label class="col-sm-2 col-form-label" for="length">Length (CM):</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="length" aria-describedby="emailHelp" placeholder="Enter length" name="length">
    </div>
  </div>

</form>

</div>
    </div>
</section>



<?php include_once __DIR__ . '/../layouts/footer.php'?>

