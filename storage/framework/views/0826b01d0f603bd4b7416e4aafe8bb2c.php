

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
    <?php $__env->startSection('title', "#{$item->id} - {$item->title}"); ?>

    
    <?php $__env->startPush('meta'); ?>
        <meta property="og:title" content="<?php echo e($item->title); ?>" />
        <meta property="og:description" content="<?php echo e(Str::limit(strip_tags($item->description), 150)); ?>" />
        <meta property="og:image" content="<?php echo e(asset('storage/' . $item->images->first()?->image_path)); ?>" />
        <meta property="og:url" content="<?php echo e(Request::url()); ?>" />
        <meta property="og:type" content="article" />
    <?php $__env->stopPush(); ?>

    <div class="bg-gray-100 py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-300 rounded-md shadow-sm">

                
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-300 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-700">
                        #<?php echo e($item->id); ?> - <?php echo e($item->title); ?>

                    </h2>

                    <div class="flex gap-3 items-center no-print">
                        
                        <button onclick="window.print()" class="text-gray-600 hover:text-gray-800" title="<?php echo e(__('items.print')); ?>">
                            <i class="fas fa-print"></i>
                        </button>

                        
						<?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('items.downloadPdf', $item)); ?>"
                           class="text-gray-600 hover:text-gray-800"
                           title="<?php echo e(__('items.download_pdf')); ?>">
                            <i class="fas fa-file-pdf"></i>
                        </a>
						<?php endif; ?>
                    </div>
                </div>

                
                <div class="p-6 space-y-4">

                    
				<div class="flex flex-col lg:flex-row gap-6">
					
					<div x-data="{ activeImage: '<?php echo e(asset('storage/' . $item->images->first()?->image_path)); ?>' }"
						 class="lg:w-1/2 flex flex-col-reverse lg:flex-row items-start gap-4">

						
						<div class="flex flex-row lg:flex-col gap-3 w-full lg:w-24 justify-center lg:justify-start">
							<?php $__currentLoopData = $item->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<img src="<?php echo e(asset('storage/' . $img->image_path)); ?>"
									 @click="activeImage = '<?php echo e(asset('storage/' . $img->image_path)); ?>'"
									 class="w-20 h-15 object-cover border-2 border-gray-300 hover:border-blue-500 cursor-pointer rounded"
									 alt="Thumbnail">
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>

						
						<div class="w-full lg:flex-1 text-center">
							<img :src="activeImage"
								 alt="<?php echo e($item->title); ?>"
								 class="h-[300px] max-w-[444px] w-full object-contain border border-gray-300 rounded shadow-sm mx-auto transition duration-300" />
						</div>
					</div>

					
					<div class="md:w-1/2 md:self-center md:mx-auto max-w-md px-4 space-y-6 flex flex-col items-center">

						
						<dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5 text-sm w-full text-left">
							<?php
								$details = [
									__('items.category') => $item->category->name ?? '-',
									__('items.year') => $item->year ?? '-',
									__('items.company') => $item->company ?? '-',
									__('items.serial_number') => $item->serial_number ?? '-',
									__('items.location') => $item->location ?? '-',
								];
							?>

							<?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="flex flex-col justify-center">
									<dt class="text-gray-700 font-semibold text-sm mb-1"><?php echo e($label); ?></dt>
									<dd class="text-gray-800"><?php echo e($value); ?></dd>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<?php if($item->link): ?>
								<div class="flex flex-col justify-center">
									<dt class="text-gray-700 font-semibold text-sm mb-1"><?php echo e(__('items.link')); ?></dt>
									<dd>
										<a href="<?php echo e($item->link); ?>" class="text-blue-600 hover:underline break-all" target="_blank">Link</a>
									</dd>
								</div>
							<?php endif; ?>
						</dl>

						
						<div class="flex flex-wrap gap-4 items-center justify-center md:justify-start no-print w-full">
							<span class="text-sm text-gray-600"><?php echo e(__('items.share')); ?>:</span>

							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(Request::url())); ?>"
							   target="_blank"
							   class="text-blue-600 hover:text-blue-800"
							   title="Facebook"
							   aria-label="Facebook">
								<i class="fab fa-facebook-square fa-xl"></i>
							</a>

							<a href="https://wa.me/?text=<?php echo e(urlencode($item->title . ' ' . Request::url())); ?>"
							   target="_blank"
							   class="text-green-600 hover:text-green-800 sm:hidden"
							   title="WhatsApp"
							   aria-label="WhatsApp">
								<i class="fab fa-whatsapp-square fa-xl"></i>
							</a>

							<a href="viber://forward?text=<?php echo e(urlencode($item->title . ' ' . Request::url())); ?>"
							   class="text-purple-600 hover:text-purple-800 sm:hidden"
							   title="Viber"
							   aria-label="Viber">
								<i class="fab fa-viber fa-xl"></i>
							</a>

							
							<div x-data="{ copied: false }" class="flex items-center gap-2 hidden sm:flex">
								<button @click="navigator.clipboard.writeText('<?php echo e(Request::url()); ?>'); copied = true; setTimeout(() => copied = false, 2000)"
										class="text-gray-600 hover:text-gray-800"
										title="Copy link"
										aria-label="Copy link">
									<i class="fas fa-link fa-xl"></i>
								</button>
								<span x-show="copied" class="text-green-600 text-sm" x-transition>✔ Copied!</span>
							</div>
						</div>
					</div>

				</div>

                    
                    <hr class="my-4">

                    
                    <?php if($item->description): ?>
                        <div class="mt-2 text-gray-700 text-justify text-sm leading-relaxed">
                            <?php echo e($item->description); ?>

                        </div>
                    <?php endif; ?>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <?php if($item->status || $item->attributes->count()): ?>
                            <hr class="my-4">
                            <h5 class="text-md font-semibold text-gray-700"><?php echo e(__('items.additional_attributes')); ?></h5>
                            <ul class="list-disc list-inside text-sm text-gray-700 mt-2 leading-relaxed">
                                <?php $__currentLoopData = $item->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><strong><?php echo e($attr->attribute_name); ?>:</strong> <?php echo e($attr->attribute_value); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php if($item->status): ?>
                                    <li><strong><?php echo e(__('items.status')); ?>:</strong> <?php echo e($item->status); ?></li>
                                <?php endif; ?>
								<?php if($item->user): ?>
									<li><strong><?php echo e(__('items.user')); ?>:</strong> <?php echo e($item->user->name); ?> <?php echo e($item->user->lastname); ?></li>
								<?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="p-4 mt-4 bg-blue-50 text-blue-700 border border-blue-300 rounded no-print">
                            Παρακαλώ συνδεθείτε για την προβολή περισσότερων στοιχείων.
                        </div>
                    <?php endif; ?>

                    
					<div x-data="{ showQr: false }" x-cloak>
						<div class="flex flex-col sm:flex-row justify-center sm:items-center gap-4 mt-6 no-print">

							
							<a href="<?php echo e(route('items.index')); ?>"
							   class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 flex items-center gap-2 justify-center">
								<i class="fas fa-list"></i> <?php echo e(__('items.back_to_list')); ?>

							</a>

							
							<button @click="showQr = !showQr"
									class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center gap-2 justify-center">
								<i class="fas fa-qrcode"></i> QR Code
							</button>

							
							<?php if(auth()->guard()->check()): ?>
								<?php if(auth()->id() === $item->user_id || auth()->user()->hasRole('admin')): ?>
									<a href="<?php echo e(route('items.edit', $item)); ?>"
									   class="flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
										<i class="fas fa-edit"></i> <?php echo e(__('items.edit')); ?>

									</a>
								<?php endif; ?>
							<?php endif; ?>
						</div>

						
						<div x-show="showQr" x-transition class="text-center mt-4 no-print">
							<div class="inline-block">
								<?php echo QrCode::size(150)->generate(Request::url()); ?>

							</div>
							<p class="text-sm text-gray-500 mt-2">
								<?php echo e(__('Registration No')); ?>: <?php echo e($item->id); ?>

							</p>
						</div>
					</div>

                </div>
            </div>
        </div>
    </div>

    
    <style>
        [x-cloak] { display: none !important; }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
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
<?php /**PATH C:\xampp\htdocs\retro-axd\resources\views/items/show.blade.php ENDPATH**/ ?>