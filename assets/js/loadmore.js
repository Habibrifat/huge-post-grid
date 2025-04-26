// jQuery(document).ready(function ($) {
//   let page = 1;
//   const button = $("#load-more-posts");

//   button.on("click", function () {
//     page++;
//     const postsPerPage = button.data("posts-per-page");
//     const selectedCategory = button.data("category");

//     $.ajax({
//       url: post_grid_ajax_obj.ajaxurl,
//       type: "POST",
//       data: {
//         action: "load_more_posts",
//         nonce: post_grid_ajax_obj.nonce,
//         page: page,
//         posts_per_page: postsPerPage,
//         selected_category: selectedCategory,
//       },
//       success: function (response) {
//         if (response != 0) {
//           $(".custom-post-grid").append(response);
//           button.data("page", page);
//         } else {
//           button.text("No more posts").prop("disabled", true);
//         }
//       },
//     });
//   });
// });

jQuery(document).ready(function ($) {
  $(document).on("click", "#load-more-posts", function () {
    const button = $(this);
    const page = parseInt(button.data("page")) + 1;
    const maxPages = parseInt(button.data("max-pages"));
    const postsPerPage = button.data("posts-per-page");
    const selectedCategory = button.data("category");

    // Disable button during AJAX request
    button.prop("disabled", true).text("Loading...");

    $.ajax({
      url: post_grid_ajax_obj.ajaxurl,
      type: "POST",
      data: {
        action: "load_more_posts",
        nonce: post_grid_ajax_obj.nonce,
        page: page,
        posts_per_page: postsPerPage,
        selected_category: selectedCategory,
      },
      success: function (response) {
        if (response != 0) {
          $(".custom-post-grid").append(response);
          button.data("page", page);

          // Check if we've reached the last page
          if (page >= maxPages) {
            button.remove(); // Remove the button completely
          } else {
            button.prop("disabled", false).text("Load More");
          }
        } else {
          button.remove(); // Remove the button if no posts
        }
      },
      error: function () {
        button.prop("disabled", false).text("Load More");
      },
    });
  });
});
