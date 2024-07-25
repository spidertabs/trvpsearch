// js/script.js
(function ($) {
  $(document).ready(function () {
    $('#search-input').on('keyup', function () {
      var searchTerm = $(this).val();
      if (searchTerm.length > 0) {
        $.ajax({
          type: 'POST',
          url: 'forms/search.php',
          data: { search: searchTerm },
          dataType: 'json',
          success: function (response) {
            if (response.success) {
              var coursesHtml = '';
              $.each(response.data, function (index, course) {
                coursesHtml += '<p>' + course.course_title + '</p>';
                // Add more fields if necessary
              });
              $('#datatable').html(coursesHtml);
            } else {
              $('#datatable').html('Error: ' + response.message);
            }
          },
          error: function (xhr, status, error) {
            console.log('Error: ' + error);
          }
        });
      } else {
        $('#datatable').html('');
      }
    });
  });
})(jQuery);