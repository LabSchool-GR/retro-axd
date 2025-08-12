

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
    <?php $__env->startSection('title', __('items.edit') . ': ' . $item->title); ?>

    <div class="bg-gray-100 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm overflow-hidden">

                <!-- Header -->
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-edit mr-2 text-blue-600"></i>
                        <?php echo e(__('items.edit')); ?>: <?php echo e($item->title); ?>

                    </h2>
                    <a href="<?php echo e(route('items.index')); ?>"
                       class="text-blue-600 hover:text-blue-800 text-lg"
                       title="<?php echo e(__('items.back_to_list')); ?>">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Form -->
                <div class="p-4 sm:p-6">
                    <?php if($errors->any()): ?>
                        <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
                            <ul class="list-disc pl-5">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('items.update', $item)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.title')); ?></label>
                            <input type="text" name="title" id="title" value="<?php echo e(old('title', $item->title)); ?>"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-4">
                            <label for="slug" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.slug')); ?></label>
                            <input type="text" name="slug" id="slug" value="<?php echo e(old('slug', $item->slug)); ?>"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.category')); ?></label>
                            <select name="category_id" id="category_id"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"
                                        <?php echo e(old('category_id', $item->category_id) == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        
                        <div class="mb-4">
                            <label for="company" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.company')); ?></label>
                            <input type="text" name="company" id="company" value="<?php echo e(old('company', $item->company)); ?>"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        
                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.serial_number')); ?></label>
                            <input type="text" name="serial_number" id="serial_number" value="<?php echo e(old('serial_number', $item->serial_number)); ?>"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        
                        <div class="mb-4">
                            <label for="link" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.link')); ?></label>
                            <input type="url" name="link" id="link" value="<?php echo e(old('link', $item->link)); ?>"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        
                        <div class="mb-4">
                            <label for="year" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.year')); ?></label>
                            <input type="text" name="year" id="year" maxlength="4" value="<?php echo e(old('year', $item->year)); ?>"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        
						<div class="mb-4">
							<label for="location" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.location')); ?></label>
							<select name="location" id="location"
									class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
								<option value="Χώρος Συλλόγου" <?php echo e(old('location', $item->location) == 'Χώρος Συλλόγου' ? 'selected' : ''); ?>>
									Χώρος Συλλόγου
								</option>
								<option value="Αποθήκη Ιδιοκτήτη" <?php echo e(old('location', $item->location) == 'Αποθήκη Ιδιοκτήτη' ? 'selected' : ''); ?>>
									Αποθήκη Ιδιοκτήτη
								</option>
								<option value="Χώρος Έκθεσης" <?php echo e(old('location', $item->location) == 'Χώρος Έκθεσης' ? 'selected' : ''); ?>>
									Χώρος Έκθεσης
								</option>
							</select>
							<?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						</div>

                        
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.status')); ?></label>
                            <input type="text" name="status" id="status" value="<?php echo e(old('status', $item->status)); ?>"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.description')); ?></label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"><?php echo e(old('description', $item->description)); ?></textarea>
                        </div>

                        
                        <div class="mb-4">
                            <label for="images" class="block text-sm font-medium text-gray-700"><?php echo e(__('items.images')); ?></label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            <p class="text-sm text-gray-500 mt-1"><?php echo e(__('items.image_note')); ?></p>
                        </div>

                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700"><?php echo e(__('items.additional_attributes')); ?></label>
                            <div id="attribute-fields" class="space-y-2 mt-2">
                                <?php $__currentLoopData = $item->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex gap-2">
                                        <input type="text" name="attributes[key][]" value="<?php echo e($attr->attribute_name); ?>"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md"
                                               placeholder="<?php echo e(__('items.attribute_key')); ?>">
                                        <input type="text" name="attributes[value][]" value="<?php echo e($attr->attribute_value); ?>"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md"
                                               placeholder="<?php echo e(__('items.attribute_value')); ?>">
                                        <button type="button" onclick="this.parentElement.remove()"
                                                class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <button type="button" onclick="addAttributeField()"
                                    class="mt-2 text-sm text-blue-600 hover:underline">
                                <i class="fas fa-plus-circle mr-1"></i><?php echo e(__('items.add_attribute')); ?>

                            </button>
                        </div>

                        
                        <div class="mt-6">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                                <i class="fas fa-save mr-2"></i>
                                <?php echo e(__('items.save')); ?>

                            </button>
                        </div>
                    </form>
					
					<?php if($item->images->count()): ?>
						<div class="mb-4">
							<label class="block text-sm font-medium text-gray-700"><?php echo e(__('items.existing_images')); ?></label>
							<div class="flex flex-wrap gap-4 mt-2">
								<?php $__currentLoopData = $item->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="relative group">
										<img src="<?php echo e(asset('storage/' . $img->image_path)); ?>"
											 alt="image"
											 class="w-32 h-24 object-contain border border-gray-300 rounded shadow-md" />

										<form action="<?php echo e(route('item-images.destroy', $img->id)); ?>" method="POST"
											  onsubmit="return confirm('Θέλετε σίγουρα να διαγράψετε την εικόνα;')"
											  class="absolute top-1 right-1 bg-white bg-opacity-90 rounded-full shadow-sm group-hover:opacity-100 opacity-0 transition-opacity">
											<?php echo csrf_field(); ?>
											<?php echo method_field('DELETE'); ?>
											<button type="submit" class="text-red-600 text-xs p-1 hover:text-red-800">
												<i class="fas fa-trash-alt"></i>
											</button>
										</form>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addAttributeField() {
            const container = document.getElementById('attribute-fields');
            const wrapper = document.createElement('div');
            wrapper.classList.add('flex', 'gap-2');

            wrapper.innerHTML = `
                <input type="text" name="attributes[key][]" placeholder="<?php echo e(__('items.attribute_key')); ?>"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md" />
                <input type="text" name="attributes[value][]" placeholder="<?php echo e(__('items.attribute_value')); ?>"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md" />
                <button type="button" onclick="this.parentElement.remove()"
                        class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            container.appendChild(wrapper);
        }
    </script>
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
<?php /**PATH C:\xampp\htdocs\retro-axd\resources\views/items/edit.blade.php ENDPATH**/ ?>