

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
    <?php $__env->startSection('title', __('messenger.contact')); ?>

    <div class="bg-gray-100 py-4 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Card Header -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>
                        <?php echo e(__('messenger.contact')); ?>

                    </h2>
                    <a href="<?php echo e(route('items.index')); ?>"
                       class="text-blue-600 hover:text-blue-800 text-lg"
                       title="<?php echo e(__('messenger.back')); ?>">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Card Content -->
                <div class="p-6 font-mono">

                    <!-- Flash message -->
                    <?php if(session('success')): ?>
                        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <!-- Validation errors -->
                    <?php if($errors->any()): ?>
                        <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
                            <ul class="list-disc pl-5">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Contact Form -->
                    <form method="POST" action="<?php echo e(route('messenger.send')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Read-only user information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700"><?php echo e(__('messenger.name')); ?></label>
                                <input type="text" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="<?php echo e(Auth::user()->name); ?>">
                            </div>

                            <!-- Lastname -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700"><?php echo e(__('messenger.lastname')); ?></label>
                                <input type="text" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="<?php echo e(Auth::user()->lastname); ?>">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="<?php echo e(Auth::user()->email); ?>">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700"><?php echo e(__('messenger.phone')); ?></label>
                                <input type="text" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="<?php echo e(Auth::user()->phone); ?>">
                            </div>

                            <!-- Location -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700"><?php echo e(__('messenger.location')); ?></label>
                                <input type="text" readonly class="mt-1 w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2"
                                       value="<?php echo e(Auth::user()->location); ?>">
                            </div>
                        </div>

                        <!-- Subject Type Selection -->
                        <div class="mb-6">
                            <label for="subject_type" class="block text-sm font-medium text-gray-700">
                                <?php echo e(__('messenger.subject_type')); ?> <span class="text-red-500">*</span>
                            </label>
                            <select id="subject_type" name="subject_type"
                                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 bg-white shadow-sm"
                                    required>
                                <option value=""><?php echo e(__('messenger.choose_type')); ?></option>
                                <option value="contact_request"><?php echo e(__('messenger.types.contact_request')); ?></option>
                                <option value="material_offer"><?php echo e(__('messenger.types.material_offer')); ?></option>
                                <option value="catalog_editor_request"><?php echo e(__('messenger.types.catalog_editor_request')); ?></option>
                            </select>
                        </div>

                        <!-- Message Textarea -->
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-gray-700">
                                <?php echo e(__('messenger.message')); ?> <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="6"
                                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm"
                                      required><?php echo e(old('message')); ?></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow hover:bg-blue-700 transition">
                                <i class="fas fa-paper-plane mr-2"></i><?php echo e(__('messenger.send')); ?>

                            </button>
                        </div>
                    </form>
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
<?php /**PATH C:\xampp\htdocs\retro-axd\resources\views/messenger/create.blade.php ENDPATH**/ ?>