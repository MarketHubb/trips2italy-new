<div id="modal-container" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75 transition-opacity overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
   <div class="flex min-h-full p-4 text-center sm:p-0">
      <div class="relative w-full max-w-7xl bg-white">
         <!-- Close button -->
         <button type="button" id="close-modal" class="absolute top-4 right-4 z-10 text-gray-400 hover:text-gray-700 focus:outline-none">
            <span class="sr-only">Close</span>
            <span aria-hidden="true" class="text-2xl font-medium">&times;</span>
         </button>
         <div class="overflow-y-auto max-h-screen">
            <div class="p-8">
               <section class="my-12">
                  <div class="max-w-7xl mx-auto rounded-md bg-gray-50 ring-1 ring-gray-200 py-24">
                     <?php 
                     $form = GFAPI::get_form(11); // Get form with ID 11
                     echo gravity_form_to_tailwind_exact($form); 
                     ?>
                  </div>
               </section>
            </div>
         </div>
      </div>
   </div>
</div>
