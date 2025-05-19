jQuery(document).ready(function ($) {
  $(document).on(
    "click",
    ".post-grid-pagination a.page-numbers:not(.current)",
    function (e) {
      e.preventDefault();

      const link = $(this);
      const paginationContainer = link.closest(".post-grid-pagination");
      const gridContainer = paginationContainer
        .siblings(".huge-post-grid")
        .first();
      const containerId = gridContainer.attr("id");
      const page = link.attr("href").match(/paged?=(\d+)/i) ? RegExp.$1 : 1;

      // Get the widget wrapper
      const widgetWrapper = gridContainer.closest(
        ".elementor-widget-huge-post-grid"
      );

      // Prepare all settings
      const ajaxData = {
        action: "post_grid_pagination",
        nonce: postGrid.nonce,
        page: page,
        container_id: containerId,
        posts_per_page: widgetWrapper.data("posts-per-page"),
        selected_category: widgetWrapper.data("selected-category"),
        post_style: widgetWrapper.data("post-style"),
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

      // Add loading state
      gridContainer.addClass("loading");

      $.ajax({
        url: postGrid.ajaxurl,
        type: "POST",
        dataType: "json",
        data: ajaxData,
        success: function (response) {
          if (response?.success) {
            gridContainer.parent().html(response.data.html);

            // Update URL without reload
            if (history.pushState) {
              const newUrl = window.location.pathname + "?paged=" + page;
              window.history.pushState({ path: newUrl }, "", newUrl);
            }
          }
        },
        error: function (xhr) {
          console.error("Pagination Error:", xhr.responseText);
          gridContainer.before(
            '<div class="post-grid-error">Failed to load page. Please try again.</div>'
          );
        },
        complete: function () {
          gridContainer.removeClass("loading");
        },
      });
    }
  );
});
