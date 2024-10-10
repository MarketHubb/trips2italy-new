<?php if (!isset($args) || empty($args)) return; ?>
<div class="relative isolate overflow-hidden bg-brand-600">
   <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
         <?php if (!empty($args['heading'])): ?>
            <h2 class="text-2xl sm:text-2xl md:text-4xl font-medium antialiased tracking-tight text-white">
               <?php echo $args['heading']; ?>
            </h2>
         <?php endif ?>

         <?php if (!empty($args['description'])): ?>
            <p class="mx-auto mt-6 max-w-xl text-lg leading-8 font-semibold antialiased text-white">
               <?php echo $args['description']; ?>
            </p>
         <?php endif ?>

         <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="<?php echo get_permalink(28484); ?>" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-brand-800 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Get started today</a>
         </div>
      </div>
   </div>
   <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
      <circle cx="512" cy="512" r="512" fill="url(#8d958450-c69f-4251-94bc-4e091a323369)" fill-opacity="0.7" />
      <defs>
         <radialGradient id="8d958450-c69f-4251-94bc-4e091a323369">
            <stop stop-color="#378ce1" />
            <stop offset="1" stop-color="#d7e8f9" />
         </radialGradient>
      </defs>
   </svg>
</div>