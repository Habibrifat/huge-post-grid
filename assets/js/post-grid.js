jQuery(document).ready(function ($) {
  $(document).on("click", ".load-more-btn", function (e) {
    e.preventDefault();

    var button = $(this);
    var page = parseInt(button.data("page"));
    var widget_id = button.data("widget-id");
    var settings = JSON.parse(button.data("settings"));

    button.text("Loading...").prop("disabled", true);

    $.ajax({
      url: elementorPostGrid.ajaxurl, // This needs to be localized
      type: "POST",
      data: {
        action: "load_more_posts",
        page: page + 1,
        widget_id: widget_id,
        settings: settings,
        nonce: elementorPostGrid.nonce, // This needs to be localized
      },
      success: function (response) {
        if (response.success) {
          $("#post-grid-" + widget_id).append(response.data.html);
          button.data("page", page + 1);

          if (response.data.is_last_page) {
            button.remove();
          } else {
            button.text("Load More").prop("disabled", false);
          }
        } else {
          console.error(response.data);
          button.text("Error").prop("disabled", true);
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
        button.text("Error").prop("disabled", true);
      },
    });
  });
});
