

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
    <?php $__env->startSection('title', __('app.title')); ?>

    <div class="bg-gray-100 py-4 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header -->
                <div class="bg-gray-50 px-4 py-4 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center mx-auto">
                        <i class="fas fa-laptop-code mr-2 text-blue-700"></i>
                        <?php echo e(__('app.title')); ?>

                    </h2>
                </div>

                <!-- Content -->
                <div class="p-6 md:p-10 font-mono">

                    <!-- Logo -->
                    <div class="flex justify-center mb-6">
                        <img src="<?php echo e(asset('storage/retro-guardians-axd-250px.png')); ?>" alt="Retro Guardians Logo" class="w-64 h-auto">
                    </div>

                    <!-- Description -->
                    <p class="text-center text-base md:text-lg text-gray-700 leading-relaxed mb-8">
                        <?php echo e(__('app.description')); ?>

                    </p>

                    <!-- Authenticated -->
                    <?php if(auth()->guard()->check()): ?>
                        <div class="text-center space-y-4 mb-8">
                            <p class="text-lg text-gray-800 font-semibold">
                                <?php echo e(__('app.auth.welcome')); ?>, <?php echo e(Auth::user()->name); ?>!
                            </p>

                            <div class="flex flex-wrap justify-center gap-4">
								
								<?php if(Auth::user()->hasRole(['admin', 'reporter'])): ?>
									<a href="<?php echo e(route('items.create')); ?>"
									   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
										<i class="fas fa-plus-circle mr-2"></i><?php echo e(__('app.auth.new_entry')); ?>

									</a>
								<?php endif; ?>

								
								<?php if (! (Auth::user()->hasAnyRole(['admin', 'reporter']))): ?>
									<a href="<?php echo e(route('messenger.create')); ?>"
									   class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md shadow hover:bg-purple-700 transition">
										<i class="fas fa-envelope mr-2"></i><?php echo e(__('app.auth.contact')); ?>

									</a>
								<?php endif; ?>

								
								<form method="POST" action="<?php echo e(route('logout')); ?>">
									<?php echo csrf_field(); ?>
									<button type="submit"
											class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition">
										<i class="fas fa-sign-out-alt mr-2"></i><?php echo e(__('app.auth.logout')); ?>

									</button>
								</form>
							</div>

													</div>
                    <?php endif; ?>

                    <!-- Guest -->
                    <?php if(auth()->guard()->guest()): ?>
                        <div class="text-center space-x-4 mt-4 mb-8">
                            <a href="<?php echo e(route('login')); ?>"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
                                <i class="fas fa-sign-in-alt mr-2"></i><?php echo e(__('app.auth.login')); ?>

                            </a>
                            <a href="<?php echo e(route('register')); ?>"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md shadow hover:bg-gray-700 transition">
                                <i class="fas fa-user-plus mr-2"></i><?php echo e(__('app.auth.register')); ?>

                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Divider -->
                    <hr class="my-10 border-gray-300">

                    <!-- Catalog Link -->
                    <div class="text-center mt-6">
                        <a href="<?php echo e(route('items.index')); ?>"
                           class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
                            <i class="fas fa-archive mr-2"></i><?php echo e(__('app.catalog.general')); ?>

                        </a>
                    </div>
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
<?php /**PATH C:\xampp\htdocs\retro-axd\resources\views/welcome.blade.php ENDPATH**/ ?>