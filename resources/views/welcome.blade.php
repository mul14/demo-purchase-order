<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Demo</title>

  <link rel="stylesheet" href="{{ url('/libs/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('/libs/admin-lte/admin-lte.min.css') }}">
  <link rel="stylesheet" href="{{ url('/libs/select2/select2.min.css') }}">
</head>
<body>
<div class="container">

  <h1>Demo</h1>

  <table class="table">
    <thead>
    <tr>
      <th class="col-sm-3">Art no.</th>
      <th class="col-sm-3">Description</th>
      <th class="col-sm-1">Qty</th>
      <th class="col-sm-1">Unit Price</th>
      <th class="col-sm-1">Total</th>
      <th class="col-sm-1">Remarks</th>
      <th class="col-sm-1"></th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        <select name="" class="artno" style="width: 100%;">
          <option value=""></option>
        </select>
      </td>
      <td>
        <span class="description"></span>
      </td>
      <td>
        <input type="number" name="qty" class="qty form-control" min="1" value="1">
      </td>
      <td>
        <span class="price">0</span>
      </td>
      <td>
        <span class="total">0</span>
      </td>
      <td>

      </td>
    </tr>
    </tbody>
  </table>
</div>

<script src="/libs/jquery/jquery.min.js"></script>
<script src="/libs/select2/select2.min.js"></script>

<script>
  $(function() {
    var artno = $(".artno");

    artno.select2({
      ajax: {
        url: "{{ url('/api/artno') }}",
        dataType: 'json',
        delay: 300,
        data: function(params) {
          return {
            q: params.term,
            page: params.page
          };
        },
        processResults: function(data, params) {

          params.page = params.page || 1;

          return {
            results: data,
            pagination: {
              more: (params.page * 30) < data.total_count
            }
          };
        },
        cache: true
      },
      escapeMarkup: function(markup) {
        return markup;
      }, // let our custom formatter work
      minimumInputLength: 1,
    });

    artno.on('change', function() {

      var url = '{{ url('/api/artno/') }}/' + $(this).val();

      var tr = $(this).closest('tr');

      $.get(url, function(response) {

        var price = tr.find('.price');
        var total = tr.find('.total');
        var description = tr.find('.description');
        var qty = tr.find('.qty').val();

        price.text(response.price);
        total.text(response.price * qty);
        description.text(response.description);
      });

    });

    $('.qty').on('change', function() {

      var tr = $(this).closest('tr');

      var price = tr.find('.price');
      var total = tr.find('.total');
      var qty = $(this).val();

      total.text(price.text() * qty);

    });

  });
</script>
</body>
</html>
