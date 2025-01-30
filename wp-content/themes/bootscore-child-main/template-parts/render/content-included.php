<?php if (empty($args)) return;

$included = !empty($args['content']['includes'])
    ? parseTextWithParentheses($args['content']['includes'])
    : null;

$not_included = !empty($args['content']['not_included'])
    ? parseTextWithParentheses($args['content']['not_included'])
    : null;

$conditions = $args['content']['general_conditions'] ?? null;
?>

<div class="max-w-screen-lg mx-auto">

    <?php if (!empty($included)): ?>

        <div class="py-10">

            <ul class="text-sm grid grid-cols-1 md:grid-cols-2 md:gap-x-8 gap-y-4 items-start">
                <?php foreach ($included as $item) : ?>

                    <li class="flex gap-x-3">
                        <span class="size-5 flex justify-center items-center rounded-full bg-blue-600 text-white">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <span class="text-gray-800 font-medium text-base text-pretty">
                                <?php echo esc_html($item['text']); ?>
                            </span>
                            <?php if (isset($item['note']) && !empty($item['note'])) : ?>
                                <div class="hs-tooltip inline-block">
                                    <button type="button" class="hs-tooltip-toggle size-4 inline-flex justify-center items-center gap-2 rounded-full text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 focus:outline-none focus:bg-blue-50 focus:border-blue-200 focus:text-blue-600">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                        </svg>
                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                                            <?php echo $item['note']; ?>
                                        </span>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

    <?php endif; ?>

    <?php if (!empty($not_included)): ?>

        <div class="py-10">

            <p class="text-base md:text-lg font-medium mb-3">
                WHAT IS NOT INCLUDED:
            </p>

            <ul class="text-sm grid grid-cols-1 md:grid-cols-3 md:gap-x-8 gap-y-4 items-start text-gray-500">
                <?php foreach ($not_included as $not_include): ?>
                    <li>
                        <?php echo $not_include['text']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

    <?php endif; ?>

    <?php if (!empty($not_included)): ?>

        <div class="py-10">

            <p class="text-base md:text-lg font-medium mb-3">
                GENERAL CONDITIONS:
            </p>
            <p class="text-sm">
                <?php echo $conditions; ?>
            </p>

        </div>

    <?php endif; ?>