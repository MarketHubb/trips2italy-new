<?php if (!isset($args) || empty($args['post_type'])) return; ?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query = paginated_post_query($args['post_type'], $paged);
$query_args = !empty($args['query_args']) ? $args['query_args'] : [];
?>

<div class="bg-white pt-10 pb-24">
   <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">

         <?php
         $post_grid = get_post_list($query, $query_args);
         echo $post_grid;
         ?>

      </div>
   </div>

   <?php
   $current_page = max(1, get_query_var('paged'));
   $total_pages = $query->max_num_pages;
   $posts_per_page = get_option('posts_per_page');
   $total_posts = $query->found_posts;
   $start_post = (($current_page - 1) * $posts_per_page) + 1;
   $end_post = min($current_page * $posts_per_page, $total_posts);

   $prev_link = get_previous_posts_link('Previous');
   $next_link = get_next_posts_link('Next', $total_pages);

   $prev_link = $prev_link ? add_anchor_to_pagination_link($prev_link) : '';
   $next_link = $next_link ? add_anchor_to_pagination_link($next_link) : '';

   $pagination_args = array(
      'total' => $total_pages,
      'current' => $current_page,
      'prev_text' => __('&laquo; Previous'),
      'next_text' => __('Next &raquo;'),
      'type' => 'array'
   );

   $pagination_links = paginate_links($pagination_args);
   ?>

   <div class="flex items-center justify-between border-t border-gray-200 px-6 py-3 sm:px-6 mt-8 sm:mt-12 mx-auto max-w-7xl lg:px-8">
      <div class="flex flex-1 justify-between sm:hidden">
         <?php if ($prev_link): ?>
            <?php echo str_replace('Previous', '<span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</span>', $prev_link); ?>
         <?php endif; ?>
         <?php if ($next_link): ?>
            <?php echo str_replace('Next', '<span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</span>', $next_link); ?>
         <?php endif; ?>
      </div>
      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between mt-4 sm:mt-8">
         <div>
            <p class="text-sm text-gray-700">
               Showing
               <span class="font-medium"><?php echo $start_post; ?></span>
               to
               <span class="font-medium"><?php echo $end_post; ?></span>
               of
               <span class="font-medium"><?php echo $total_posts; ?></span>
               results
            </p>
         </div>
         <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
               <?php if ($prev_link): ?>
                  <?php echo str_replace(
                     'Previous',
                     '<span class="sr-only">Previous</span><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>',
                     preg_replace('/<a /', '<a class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-400 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" ', $prev_link)
                  ); ?>
               <?php endif; ?>

               <?php
               if ($pagination_links) {
                  foreach ($pagination_links as $link) {
                     if (strpos($link, 'current') !== false) {
                        echo str_replace('class="', 'class="relative z-10 inline-flex items-center bg-brand-500 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-500 ', $link);
                     } else {
                        echo str_replace('class="', 'class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-400 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 ', $link);
                     }
                  }
               }
               ?>

               <?php if ($next_link): ?>
                  <?php echo str_replace(
                     'Next',
                     '<span class="sr-only">Next</span><svg class="h-5 w-5 fill-gray-400" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>',
                     preg_replace('/<a /', '<a class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-400 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" ', $next_link)
                  ); ?>
               <?php endif; ?>
            </nav>
         </div>
      </div>
   </div>

</div>