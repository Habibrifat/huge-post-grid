jQuery(document).ready(function ($) {
  $(document).on("click", ".load-more-btn", function (e) {
    e.preventDefault();

    const button = $(this);
    const container = button.data("container");
    const widgetWrapper = button.closest(".elementor-widget-huge-post-grid");

    // Prepare AJAX data
    const ajaxData = {
      action: "load_more_posts",
      nonce: postGrid.nonce,
      page: parseInt(button.data("page")) + 1,
      posts_per_page: button.data("posts-per-page"),
      selected_category: button.data("category"),
      post_style: button.data("post-style"),
      settings: {
        show_image: widgetWrapper.data("show-image"),
        show_category: widgetWrapper.data("show-category"),
        show_content: widgetWrapper.data("show-content"),
        content_type: widgetWrapper.data("content-type"),
        show_author: widgetWrapper.data("show-author"),
        show_date: widgetWrapper.data("show-date"),
        image_size: widgetWrapper.data("image-size"),
        title_word_limit: widgetWrapper.data("title-word-limit"),
        content_word_limit: widgetWrapper.data("content-word-limit"),
        columns: widgetWrapper.data("columns"),
      },
    };

    // Loading state
    button
      .prop("disabled", true)
      .html('<span class="spinner"></span> Loading...');

    $.ajax({
      url: postGrid.ajaxurl,
      type: "POST",
      dataType: "html",
      data: ajaxData,
      success: function (response) {
        if (response && response !== "0") {
          // Append new posts
          $("#" + container).append(response);

          // Update page number
          button.data("page", parseInt(button.data("page")) + 1);

          // Remove button if no more pages
          if (
            parseInt(button.data("page")) >= parseInt(button.data("max-pages"))
          ) {
            button.fadeOut(300, function () {
              $(this).remove();
            });
          } else {
            button.prop("disabled", false).text("Load More");
          }
        } else {
          button.remove();
        }
      },
      error: function (xhr, status, error) {
        console.error("Load More Error:", status, error);
        button.prop("disabled", false).text("Load More");

        // Show error message
        const errorMsg = $(
          '<div class="loadmore-error">Failed to load posts. Please try again.</div>'
        );
        button.after(errorMsg);
        errorMsg.delay(3000).fadeOut();
      },
    });
  });
});
