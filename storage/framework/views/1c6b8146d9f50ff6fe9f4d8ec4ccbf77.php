<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="<?php echo e(__('Pagination Navigation')); ?>" class="flex flex-col items-center space-y-2 mt-4">
        
        <div class="flex justify-between w-full sm:hidden">
            
            <?php if($paginator->onFirstPage()): ?>
                <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                    <?php echo __('pagination.previous'); ?>

                </span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500">
                    <?php echo __('pagination.previous'); ?>

                </a>
            <?php endif; ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500">
                    <?php echo __('pagination.next'); ?>

                </a>
            <?php else: ?>
                <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                    <?php echo __('pagination.next'); ?>

                </span>
            <?php endif; ?>
        </div>

        
        <div class="hidden sm:flex sm:flex-col sm:items-center sm:space-y-2">
            
            <div class="text-sm text-gray-600">
                <?php echo e(__('Showing')); ?>

                <?php if($paginator->firstItem()): ?>
                    <span class="font-medium"><?php echo e($paginator->firstItem()); ?></span>
                    <?php echo e(__('to')); ?>

                    <span class="font-medium"><?php echo e($paginator->lastItem()); ?></span>
                <?php else: ?>
                    <?php echo e($paginator->count()); ?>

                <?php endif; ?>
                <?php echo e(__('of')); ?>

                <span class="font-medium"><?php echo e($paginator->total()); ?></span>
                <?php echo e(__('results')); ?>

            </div>

            
            <div>
                <span class="inline-flex items-center -space-x-px rounded-md shadow-sm" role="group">
                    
                    <?php if($paginator->onFirstPage()): ?>
                        <span class="px-2 py-2 text-sm text-gray-500 bg-white border border-gray-300 rounded-l-md cursor-default">
                            ‹
                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="px-2 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-l-md hover:text-blue-500">
                            ‹
                        </a>
                    <?php endif; ?>

                    
                    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(is_string($element)): ?>
                            <span class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 cursor-default"><?php echo e($element); ?></span>
                        <?php endif; ?>

                        <?php if(is_array($element)): ?>
                            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($page == $paginator->currentPage()): ?>
                                    <span class="px-4 py-2 text-sm font-bold text-white bg-blue-500 border border-blue-500"><?php echo e($page); ?></span>
                                <?php else: ?>
                                    <a href="<?php echo e($url); ?>" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:text-blue-500">
                                        <?php echo e($page); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($paginator->hasMorePages()): ?>
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="px-2 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-r-md hover:text-blue-500">
                            ›
                        </a>
                    <?php else: ?>
                        <span class="px-2 py-2 text-sm text-gray-500 bg-white border border-gray-300 rounded-r-md cursor-default">
                            ›
                        </span>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </nav>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\retro-axd\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>