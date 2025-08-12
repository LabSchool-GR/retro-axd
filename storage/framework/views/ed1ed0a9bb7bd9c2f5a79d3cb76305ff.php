

<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', __('items.item_list')); ?>

    <div class="bg-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-desktop mr-2 text-blue-600"></i>
                        <?php echo e(__('items.item_list')); ?>

                    </h2>
                    <div class="flex items-center space-x-4">
					
                        <!-- Toggle: my-items -->
                        <?php if(Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor'))): ?>
                            <a href="<?php echo e(route('items.index', array_merge(request()->except('page'), ['mine' => request('mine') ? null : 1]))); ?>"
                               class="ml-2 text-gray-600 hover:text-blue-600 text-lg"
                               title="<?php echo e(request('mine') ? __('items.show_all') : __('items.only_mine')); ?>">
                                <i class="fas fa-user"></i>
                            </a>
                        <?php endif; ?>

                        <!-- View Mode Toggle -->
                        <a href="<?php echo e(route('items.index', array_merge(request()->except('page'), ['view' => request('view') === 'list' ? 'grid' : 'list']))); ?>"
                           class="ml-2 text-gray-600 hover:text-blue-600 text-lg"
                           title="<?php echo e(request('view') === 'list' ? __('items.view_grid') : __('items.view_list')); ?>">
                            <i class="fas <?php echo e(request('view') === 'list' ? 'fa-th-large' : 'fa-list'); ?>"></i>
                        </a>

                        <!-- Excel Export Button -->
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('items.export.excel', request()->query())); ?>"
                               class="text-green-600 hover:text-green-800 text-lg"
                               title="<?php echo e(__('items.export_excel')); ?>">
                                <i class="fas fa-file-excel"></i>
                            </a>
                        <?php endif; ?>

                        <!-- Add New Item -->
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor')): ?>
                                <a href="<?php echo e(route('items.create')); ?>"
                                   class="text-blue-600 hover:text-blue-800 text-lg"
                                   title="<?php echo e(__('items.new_item')); ?>">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Filters -->
                <div class="p-4 sm:p-6">
                    <div class="mb-4 flex flex-wrap gap-2 md:gap-1.5 items-center justify-between">
                        <!-- Search -->
                        <form method="GET" action="<?php echo e(route('items.index')); ?>" class="flex flex-grow gap-1.5">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                   placeholder="<?php echo e(__('items.search_placeholder')); ?>"
                                   class="px-3 py-1.5 h-9 w-full md:w-72 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" />
                            <button type="submit"
                                    class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1.5 h-9 rounded-md">
                                <i class="fas fa-search"></i>
                            </button>
                            <?php if(request('search')): ?>
                                <a href="<?php echo e(route('items.index')); ?>"
                                   class="px-3 py-1.5 h-9 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>
                        </form>

                        <!-- Category Filter -->
                        <form method="GET" action="<?php echo e(route('items.index')); ?>" class="w-full md:w-auto">
                            <select name="category"
                                    onchange="this.form.submit()"
                                    class="w-full md:w-64 px-3 py-1.5 h-9 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                                <option value=""><?php echo e(__('items.all_categories')); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>
                    </div>

                    <!-- Dynamic View Section -->
                    <?php $viewMode = request('view', 'grid'); ?>

                    <?php if($viewMode === 'list'): ?>
                        
                        <div class="overflow-x-auto border border-gray-300 rounded-md">
                            <table class="min-w-full table-auto text-sm text-left text-gray-700">
                                <thead class="bg-gray-50 border-b">
                                    <tr>
                                        <?php
                                            $currentSort = request('sort');
                                            $currentDirection = request('direction', 'asc');
                                            $getDirection = fn($col) => ($currentSort === $col && $currentDirection === 'asc') ? 'desc' : 'asc';
                                            $arrow = fn($col) => $currentSort === $col ? ($currentDirection === 'asc' ? '⬆️' : '⬇️') : '';
                                        ?>
                                        <th class="px-4 py-2 text-center">A/A</th>
                                        <th class="px-6 py-2">
                                            <a href="<?php echo e(route('items.index', array_merge(request()->query(), ['sort' => 'title', 'direction' => $getDirection('title')]))); ?>"
                                               class="flex items-center hover:underline">
                                                <i class="fas fa-sort mr-1"></i><?php echo e(__('items.title')); ?> <?php echo $arrow('title'); ?>

                                            </a>
                                        </th>
                                        <th class="px-6 py-2 hidden md:table-cell">
                                            <a href="<?php echo e(route('items.index', array_merge(request()->query(), ['sort' => 'company', 'direction' => $getDirection('company')]))); ?>"
                                               class="flex items-center hover:underline">
                                                <i class="fas fa-sort mr-1"></i><?php echo e(__('items.company')); ?> <?php echo $arrow('company'); ?>

                                            </a>
                                        </th>
                                        <th class="px-6 py-2 hidden md:table-cell">
                                            <a href="<?php echo e(route('items.index', array_merge(request()->query(), ['sort' => 'year', 'direction' => $getDirection('year')]))); ?>"
                                               class="flex items-center hover:underline">
                                                <i class="fas fa-sort mr-1"></i><?php echo e(__('items.year')); ?> <?php echo $arrow('year'); ?>

                                            </a>
                                        </th>
                                        <th class="px-6 py-2 hidden md:table-cell"><?php echo e(__('items.category')); ?></th>
                                        <th class="px-6 py-2 text-right"><?php echo e(__('items.actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 text-center">
                                                <?php echo e(($items->currentPage() - 1) * $items->perPage() + $index + 1); ?>

                                            </td>
                                            <td class="px-6 py-2"><?php echo e($item->title); ?></td>
                                            <td class="px-6 py-2 hidden md:table-cell"><?php echo e($item->company); ?></td>
                                            <td class="px-6 py-2 hidden md:table-cell"><?php echo e($item->year); ?></td>
                                            <td class="px-6 py-2 hidden md:table-cell"><?php echo e($item->category->name ?? __('items.uncategorized')); ?></td>
                                            <td class="px-6 py-2 text-right">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="<?php echo e(route('items.show', $item->slug)); ?>"
                                                       class="text-blue-600 hover:text-blue-800" title="<?php echo e(__('items.view')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php if(Auth::check() && (Auth::user()->hasRole('admin') || Auth::id() === $item->user_id)): ?>
                                                        <a href="<?php echo e(route('items.edit', $item)); ?>"
                                                           class="text-green-600 hover:text-green-800" title="<?php echo e(__('items.edit')); ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="<?php echo e(route('items.destroy', $item)); ?>" method="POST"
                                                              onsubmit="return confirm('<?php echo e(__('items.confirm_delete')); ?>');">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="text-red-600 hover:text-red-800" title="<?php echo e(__('items.delete')); ?>">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                                <?php echo e(__('items.no_items')); ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Centered pagination with summary -->
						<div class="mt-6 flex flex-col items-center space-y-2">
							<div class="w-full flex justify-center">
								<?php echo e($items->withQueryString()->links('pagination::tailwind')); ?>

							</div>
						</div>
						
                    <?php else: ?>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition duration-200">
                                    <a href="<?php echo e(route('items.show', $item->slug)); ?>">
                                        <?php
                                            $image = $item->images->first()->image_path ?? null;
                                        ?>
                                        <img src="<?php echo e($image ? asset('storage/' . $image) : asset('images/no-image.png')); ?>"
                                             alt="<?php echo e($item->title); ?>"
                                             class="w-full h-48 object-cover rounded-t-lg" loading="lazy">
                                    </a>
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                                            <a href="<?php echo e(route('items.show', $item->slug)); ?>"><?php echo e($item->title); ?></a>
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            <?php echo e($item->company); ?> &middot; <?php echo e($item->year); ?>

                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            <?php echo e($item->category->name ?? __('items.uncategorized')); ?>

                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

						<!-- Centered pagination with summary -->
						<div class="mt-6 flex flex-col items-center space-y-2">
							<div class="w-full flex justify-center">
								<?php echo e($items->withQueryString()->links('pagination::tailwind')); ?>

							</div>
						</div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\retro-axd\resources\views/items/index.blade.php ENDPATH**/ ?>