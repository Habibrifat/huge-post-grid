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

// jQuery(document).ready(function ($) {
//   $(document).on("click", "#load-more-posts", function () {
//     const button = $(this);
//     const page = parseInt(button.data("page")) + 1;
//     const maxPages = parseInt(button.data("max-pages"));
//     const postsPerPage = button.data("posts-per-page");
//     const selectedCategory = button.data("category");

//     // Disable button during AJAX request
//     button.prop("disabled", true).text("Loading...");

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

//           // Check if we've reached the last page
//           if (page >= maxPages) {
//             button.remove(); // Remove the button completely
//           } else {
//             button.prop("disabled", false).text("Load More");
//           }
//         } else {
//           button.remove(); // Remove the button if no posts
//         }
//       },
//       error: function () {
//         button.prop("disabled", false).text("Load More");
//       },
//     });
//   });
// });

// jQuery(document).ready(function ($) {
//   $(document).on("click", "#load-more-posts", function () {
//     const button = $(this);
//     const page = parseInt(button.data("page")) + 1;
//     const maxPages = parseInt(button.data("max-pages"));
//     const postsPerPage = button.data("posts-per-page");
//     const selectedCategory = button.data("category");
//     const postStyle = button.data("post-style");
//     const widgetSettings = button.data("settings"); // Get settings from data attribute

//     // Disable button during AJAX request
//     button.prop("disabled", true).text("Loading...");

//     $.ajax({
//       url: post_grid_ajax_obj.ajaxurl,
//       type: "POST",
//       data: {
//         action: "load_more_posts",
//         nonce: post_grid_ajax_obj.nonce,
//         page: page,
//         posts_per_page: postsPerPage,
//         selected_category: selectedCategory,
//         post_style: postStyle,
//         settings: widgetSettings, // Send settings to server
//       },
//       success: function (response) {
//         if (response != 0) {
//           $(".custom-post-grid").append(response);
//           button.data("page", page);

//           if (page >= maxPages) {
//             button.remove();
//           } else {
//             button.prop("disabled", false).text("Load More");
//           }
//         } else {
//           button.remove();
//         }
//       },
//       error: function () {
//         button.prop("disabled", false).text("Load More");
//       },
//     });
//   });
// });

// jQuery(document).ready(function ($) {
//   $(document).on("click", "#load-more-posts", function () {
//     const button = $(this);
//     const page = parseInt(button.data("page")) + 1;
//     const maxPages = parseInt(button.data("max-pages"));
//     const postsPerPage = button.data("posts-per-page");
//     const selectedCategory = button.data("category");
//     const postStyle = button.data("post-style");
//     const widgetSettings = button.data("settings"); // Get settings from data attribute

//     // Disable button during AJAX request
//     button.prop("disabled", true).text("Loading...");

//     $.ajax({
//       url: post_grid_ajax_obj.ajaxurl,
//       type: "POST",
//       data: {
//         action: "load_more_posts",
//         nonce: post_grid_ajax_obj.nonce,
//         page: page,
//         posts_per_page: postsPerPage,
//         selected_category: selectedCategory,
//         post_style: postStyle,
//         settings: widgetSettings, // Send settings to server
//       },
//       success: function (response) {
//         if (response != 0) {
//           $(".custom-post-grid").append(response);
//           button.data("page", page);

//           if (page >= maxPages) {
//             button.remove();
//           } else {
//             button.prop("disabled", false).text("Load More");
//           }
//         } else {
//           button.remove();
//         }
//       },
//       error: function () {
//         button.prop("disabled", false).text("Load More");
//       },
//     });
//   });
// });

jQuery(document).ready(function ($) {
  $(document).on("click", "#load-more-posts", function (e) {
    e.preventDefault();
    const button = $(this);

    // Collect all settings from data attributes
    const ajaxData = {
      action: "load_more_posts",
      nonce: post_grid_ajax_obj.nonce,
      page: parseInt(button.data("page")) + 1,
      posts_per_page: button.data("posts-per-page"),
      selected_category: button.data("category"),
      post_style: button.data("post-style"),
      settings: {
        show_image: button.data("show-image"),
        show_category: button.data("show-category"),
        show_content: button.data("show-content"),
        show_author: button.data("show-author"),
        show_date: button.data("show-date"),
        image_size: button.data("image-size"),
        title_word_limit: button.data("title-word-limit"),
        content_word_limit: button.data("content-word-limit"),
      },
    };

    console.log("Sending AJAX with:", ajaxData);

    button.prop("disabled", true).text("Loading...");

    $.ajax({
      url: post_grid_ajax_obj.ajaxurl,
      type: "POST",
      dataType: "html",
      data: ajaxData,
      success: function (response) {
        if (response && response !== "0") {
          $(".custom-post-grid").append(response);
          button.data("page", parseInt(button.data("page")) + 1);

          if (
            parseInt(button.data("page")) >= parseInt(button.data("max-pages"))
          ) {
            button.remove();
          } else {
            button.prop("disabled", false).text("Load More");
          }
        } else {
          button.remove();
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
        button.prop("disabled", false).text("Load More");
      },
    });
  });
});
