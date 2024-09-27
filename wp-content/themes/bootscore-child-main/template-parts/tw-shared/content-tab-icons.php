<?php if (!isset($args) || empty($args['pages'])) return; ?>

<?php 
$current_url = get_current_url();
$tab_count = count($args['pages']);
$tab_width = 'w-1/' . $tab_count;
$select = '';
$tabs = '';

for ($i = 0; $i < $tab_count; ++$i) {
   $border = '';
   if ($i === 0) {
      $border = ' rounded-tl-lg ';
   }
   if ($i === $tab_count - 1) {
      $border = ' rounded-tr-lg ';
   }

   $anchor = $args['pages'][$i]['permalink'] === $current_url ? ' bg-brand-500 text-white ring-1 ring-brand-500 shadow-inner shadow-brand-200 ' : ' bg-gray-200/60 text-gray-500 hover:bg-gray-200 ring-1 ring-gray-200 hover:text-gray-800 ';
   $color = $args['pages'][$i]['permalink'] === $current_url ? ' text-white ' : ' text-gray-500 ';
   $icon = $args['pages'][$i]['permalink'] === $current_url ? ' opacity-80 invert brightness-0 ' : ' opacity-40 ';
   $tabs .= '<a href="' . $args['pages'][$i]['permalink'] . '" class="' . $tab_width . ' px-1 py-4 text-center text-base font-semibold ' . $border . $anchor . '">';
   $tabs .= '<img class="inline-block -ml-0.5 mr-2 relative bottom-[3px] h-5 w-5 text-gray-400 ' . $icon . '" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" ';
   $tabs .= 'src="' . $args['pages'][$i]['icon'] . '" />';
   $tabs .= '<span>' . $args['pages'][$i]['name'] . '</span>';
   $tabs .= '</a>';
}
foreach ($args['pages'] as $tab) {

   // $anchor = $tab['permalink'] === $current_url ? ' bg-brand-500 text-white ' : ' bg-white text-gray-500 hover:bg-gray-100 ring-1 ring-gray-200 hover:text-gray-800 ';
   // $color = $tab['permalink'] === $current_url ? ' text-white ' : ' text-gray-500 ';
   // $icon = $tab['permalink'] === $current_url ? ' opacity-80 invert brightness-0 ' : ' opacity-40 ';
   // $tabs .= '<a href="' . $tab['permalink'] . '" class="' . $tab_width . ' px-1 py-4 text-center text-base font-semibold rounded-tl-lg rounded-tr-lg ' . $anchor . '">';
   // $tabs .= '<img class="inline-block -ml-0.5 mr-2 relative bottom-[3px] h-5 w-5 text-gray-400 ' . $icon . '" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" ';
   // $tabs .= 'src="' . $tab['icon'] . '" />';
   // $tabs .= '<span>' . $tab['name'] . '</span>';
   // $tabs .= '</a>';
}
 ?>
<div>
   <div class="sm:hidden">
      <label for="tabs" class="sr-only">Select a tab</label>
      <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
      <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
         <option>My Account</option>
         <option>Company</option>
         <option selected>Team Members</option>
         <option>Billing</option>
      </select>
   </div>
   <div class="hidden sm:block pt-2">
      <div class="border-b border-gray-200">
         <nav class="-mb-px flex shadow" aria-label="Tabs">
            <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
            <?php echo $tabs; ?>
         </nav>
      </div>
   </div>
</div>