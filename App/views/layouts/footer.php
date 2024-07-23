
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
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
// submit create form
  $('#save').click(function() {
    $("#product_form").submit();
    });
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
                data: { ids: ids },
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
  });
</script>
  </body>
</html>
