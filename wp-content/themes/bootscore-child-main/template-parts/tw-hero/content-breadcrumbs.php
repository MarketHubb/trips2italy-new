<?php if (empty($args)) return; ?>

<nav class="flex mb-6" aria-label="Breadcrumb">
   <ol role="list" class="flex items-center space-x-1 md:space-x-4">
      <li>
         <div>
            <a href="<?php echo get_home_url(); ?>" class="text-gray-300 hover:underline">
               <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
               </svg>
               <span class="sr-only">Home</span>
            </a>
         </div>
      </li>
      <?php foreach ($args as $breadcrumb): ?>

         <?php 
         $href = $breadcrumb['link'] ?: '#';
         $aria = $breadcrumb['link'] ? '' : 'aria-current="page"';
         $color = $breadcrumb['link'] ? ' text-gray-200 hover:underline ' : ' text-gray-200 ';
          ?>

         <li>
            <div class="flex items-center">
               <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                  <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
               </svg>
               <a href="<?php echo $href; ?>" class="ml-1 md:ml-4 text-sm font-medium <?php echo $color; ?>" <?php echo $aria; ?>>
                  <?php echo $breadcrumb['text']; ?>
               </a>
            </div>
         </li>

      <?php endforeach; ?>
      
   </ol>
</nav>