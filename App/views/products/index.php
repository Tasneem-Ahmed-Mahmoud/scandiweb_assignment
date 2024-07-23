<?php include_once __DIR__ . '/../layouts/header.php';?>




<section>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center py-5">
            <h1>Product List</h1>
            <div class="buts">
                <a href="addProduct" class="btn btn-primary  text-capitalize">add</a>
                <button  class="btn btn-danger  text-capitalize " id="delete-product-btn">mass delete</button>
            </div>

            </div>
            <hr>
           
         <div class="alert alert-info d-none message text-center" role="alert">

         </div>

<!-- start product -->
 <?php foreach ($products as $product): ?>
        <div class="col-md-3">
            <div class="  card  border-3 m-1">
                <div class="card-body mt-0">
                    <div class="check ">
                        <div class="form-check"></div>
                     <input class="form-check-input delete-checkbox" type="checkbox" value="<?=$product['id']?>"  >
                    </div>
                    <div class="content ">
                        <ul class=" ms-3">
                        <li>sku: <?=$product['sku']?></li>
                            <li class="my-1">Name: <?=$product['name']?></li>
                            <li class="mb-1">price: <?=$product['price']?>$</li>
                            <li> <?=$product['attribute']?></li>
                        </ul>
                    </div>


            </div>
         </div>
        </div>
<?php endforeach;?>

    </div>
    </div>
</section>

<?php include_once __DIR__ . '/../layouts/footer.php'?>


<script>

</script>