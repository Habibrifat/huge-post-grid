// jQuery(document).ready(function ($) {
//   $(document).on(
//     "click",
//     ".post-grid-pagination a.page-numbers:not(.current)",
//     function (e) {
//       e.preventDefault();

//       const link = $(this);
//       const paginationContainer = link.closest(".post-grid-pagination");
//       const gridContainer = paginationContainer
//         .siblings(".huge-post-grid")
//         .first();
//       const containerId = gridContainer.attr("id");
//       const pageMatch = link.attr("href").match(/paged?=(\d+)/i);
//       const page = pageMatch ? pageMatch[1] : 1;

//       console.log("Pagination clicked - Page:", page); // Debug log

//       // Show loading state
//       const loadingOverlay = $(
//         '<div class="pagination-loading">Loading...</div>'
//       );
//       gridContainer.before(loadingOverlay);

//       // Get settings from widget
//       const gridWrapper = paginationContainer.closest(
//         ".elementor-widget-huge-post-grid"
//       );
//       const settings = {
//         posts_per_page: gridWrapper.data("posts-per-page") || 6,
//         selected_category: gridWrapper.data("selected-category") || "",
//         post_style: gridWrapper.data("post-style") || "huge-style1",
//         show_image: gridWrapper.data("show-image") || "yes",
//         show_category: gridWrapper.data("show-category") || "yes",
//         show_content: gridWrapper.data("show-content") || "yes",
//         show_author: gridWrapper.data("show-author") || "yes",
//         show_date: gridWrapper.data("show-date") || "yes",
//         image_size: gridWrapper.data("image-size") || "large",
//         title_word_limit: gridWrapper.data("title-word-limit") || 10,
//         content_word_limit: gridWrapper.data("content-word-limit") || 20,
//         columns: gridWrapper.data("columns") || 3,
//       };

//       console.log("AJAX data:", {
//         // Debug log
//         page: page,
//         container_id: containerId,
//         settings: settings,
//       });

//       $.ajax({
//         url: post_grid_pagination_obj.ajaxurl,
//         type: "POST",
//         dataType: "json",
//         data: {
//           action: "post_grid_pagination",
//           nonce: post_grid_pagination_obj.nonce,
//           page: page,
//           posts_per_page: settings.posts_per_page,
//           selected_category: settings.selected_category,
//           post_style: settings.post_style,
//           container_id: containerId,
//           settings: settings,
//         },
//         success: function (response) {
//           console.log("AJAX success:", response); // Debug log
//           loadingOverlay.remove();

//           if (response && response.success) {
//             // Replace entire grid and pagination
//             gridContainer.parent().html(response.data.html);

//             // Update URL
//             if (history.pushState) {
//               const newUrl = window.location.pathname + "?paged=" + page;
//               window.history.pushState({ path: newUrl }, "", newUrl);
//             }

//             // Scroll to top smoothly
//             $("html, body").animate(
//               {
//                 scrollTop: gridContainer.offset().top - 20,
//               },
//               300
//             );
//           } else {
//             showError("Failed to load content");
//           }
//         },
//         error: function (xhr, status, error) {
//           console.error("AJAX error:", status, error, xhr.responseText); // Debug log
//           loadingOverlay.remove();
//           showError("Failed to load page. Please try again.");
//         },
//       });

//       function showError(message) {
//         const errorMsg = $(
//           '<div class="pagination-error">' + message + "</div>"
//         );
//         gridContainer.before(errorMsg);
//         setTimeout(() => errorMsg.fadeOut(), 3000);
//       }
//     }
//   );
// });

// jQuery(document).ready(function ($) {
//   // Store scroll position before AJAX call
//   let scrollPosition = 0;

//   $(document).on(
//     "click",
//     ".post-grid-pagination a.page-numbers:not(.current)",
//     function (e) {
//       e.preventDefault();

//       // Store current scroll position
//       scrollPosition = $(window).scrollTop();

//       const link = $(this);
//       const paginationContainer = link.closest(".post-grid-pagination");
//       const gridContainer = paginationContainer
//         .siblings(".huge-post-grid")
//         .first();
//       const containerId = gridContainer.attr("id");
//       const pageMatch = link.attr("href").match(/paged?=(\d+)/i);
//       const page = pageMatch ? pageMatch[1] : 1;

//       // Show loading overlay (without affecting layout)
//       const loadingOverlay = $(`
//             <div class="pagination-loading-overlay">
//                 <div class="loading-spinner"></div>
//             </div>
//         `);
//       gridContainer.css("position", "relative").append(loadingOverlay);

//       // Get settings from widget
//       const gridWrapper = paginationContainer.closest(
//         ".elementor-widget-huge-post-grid"
//       );
//       const settings = {
//         posts_per_page: gridWrapper.data("posts-per-page") || 6,
//         selected_category: gridWrapper.data("selected-category") || "",
//         post_style: gridWrapper.data("post-style") || "huge-style1",
//         show_image: gridWrapper.data("show-image") || "yes",
//         show_category: gridWrapper.data("show-category") || "yes",
//         show_content: gridWrapper.data("show-content") || "yes",
//         show_author: gridWrapper.data("show-author") || "yes",
//         show_date: gridWrapper.data("show-date") || "yes",
//         image_size: gridWrapper.data("image-size") || "large",
//         title_word_limit: gridWrapper.data("title-word-limit") || 10,
//         content_word_limit: gridWrapper.data("content-word-limit") || 20,
//         columns: gridWrapper.data("columns") || 3,
//       };

//       $.ajax({
//         url: post_grid_pagination_obj.ajaxurl,
//         type: "POST",
//         dataType: "json",
//         data: {
//           action: "post_grid_pagination",
//           nonce: post_grid_pagination_obj.nonce,
//           page: page,
//           posts_per_page: settings.posts_per_page,
//           selected_category: settings.selected_category,
//           post_style: settings.post_style,
//           container_id: containerId,
//           settings: settings,
//         },
//         success: function (response) {
//           if (response && response.success) {
//             // Replace content
//             gridContainer.parent().html(response.data.html);

//             // Restore scroll position after content loads
//             $(window).scrollTop(scrollPosition);

//             // Update URL without page jump
//             if (history.pushState) {
//               const newUrl = window.location.pathname + "?paged=" + page;
//               window.history.pushState({ path: newUrl }, "", newUrl);
//             }
//           } else {
//             showError("Failed to load content");
//           }
//         },
//         error: function (xhr, status, error) {
//           showError("Failed to load page. Please try again.");
//         },
//         complete: function () {
//           loadingOverlay.remove();
//           gridContainer.css("position", "");
//         },
//       });

//       function showError(message) {
//         const errorMsg = $(`<div class="pagination-error">${message}</div>`);
//         gridContainer.before(errorMsg);
//         setTimeout(() => errorMsg.fadeOut(), 3000);
//       }
//     }
//   );
// });

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
