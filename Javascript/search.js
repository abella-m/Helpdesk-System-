 //search on manage queries

$(function() {
      $(document).on('input', '#search-queries', function() {
        var search = $(this).val();
        $.ajax({
        url: 'search-queries.php',
        type: 'POST',
        async: false,
        data:{
          queries_search: 1, 'search-queries':search
        },
        success: function(response){
          $('#tbl-queries').html(response);
        }
      });
      })
    });
//search on view list


