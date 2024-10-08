<?php if (!isset($args) || empty($args['pages'])) return; ?>

<?php 
$current_url = get_current_url();
$tab_count = count($args['pages']);
$tab_width = 'w-1/' . $tab_count;
$select = '';
$tabs = '';
$mobile_options = '';


for ($i = 0; $i < $tab_count; ++$i) {
   $border = '';
   if ($i === 0) {
      $border = ' rounded-tl-lg ';
   }
   if ($i === $tab_count - 1) {
      $border = ' rounded-tr-lg ';
   }

   // Vars
   $anchor = $args['pages'][$i]['permalink'] === $current_url ? ' bg-brand-500 text-white shadow-lg ' : ' bg-gray-200 text-gray-800 hover:bg-gray-300 hover:text-gray-800 ';
   $color = $args['pages'][$i]['permalink'] === $current_url ? ' text-white ' : ' text-gray-500 ';
   $icon = $args['pages'][$i]['permalink'] === $current_url ? ' opacity-80 invert brightness-0 ' : ' opacity-70 ';
   $selected = $args['pages'][$i]['permalink'] === $current_url ? 'selected' : '';
   // Tabs
   $tabs .= '<a href="' . $args['pages'][$i]['permalink'] . '" class="' . $tab_width . ' relative border-r border-gray-400/60 z-10 px-1 py-4 text-center text-base font-semibold ' . $border . $anchor . '">';
   $tabs .= '<img class="inline-block -ml-0.5 mr-2 relative bottom-[3px] h-5 w-5 text-gray-400 ' . $icon . '" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" ';
   $tabs .= 'src="' . $args['pages'][$i]['icon'] . '" />';
   $tabs .= '<span>' . $args['pages'][$i]['name'] . '</span>';
   $tabs .= '</a>';
   // Mobile options
   $mobile_options .= '<option value="' . $args['pages'][$i]['permalink'] . '" ' . $selected . '>' . $args['pages'][$i]['name'] . '</option>';
}
 ?>
<div class="mb-4 md:mb-8">
   <div class="sm:hidden">
      <label for="tabs" class="font-semibold antialiased text-sm">Explore the region:</label>
      <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
      <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
         <?php echo $mobile_options; ?>
      </select>
   </div>
   <div class="hidden sm:block pt-2">
      <div class="relative shadow-sm rounded-tr-[.7rem] rounded-tl-[.7rem] bottom-[3px] border-l-[3px] border-t-[3px] border-r-[3px] border-white">
         <nav class="-mb-px flex rounded-lg" aria-label="Tabs">
            <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
            <?php echo $tabs; ?>
         </nav>
      </div>
   </div>
</div>