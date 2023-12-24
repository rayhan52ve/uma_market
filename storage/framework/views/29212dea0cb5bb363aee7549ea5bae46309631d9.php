<?php
    $footer = content('footer.content');

    $about = content('about.content');

    $categories = App\Models\Vehicle::take(4)->get();

    $policies = element('policy.element');

    $contact = content('contact.content');

    $socials = element('social.element');

?>

<!--Footer Start-->
<div class="main-footer">

    <div class="footer-area" style="background-image: url(<?php echo e(getFile('footer',@$footer->data->image)); ?>)">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-item">
                        <h3><?php echo e($navbar['About Us']); ?></h3>
                        <div class="textwidget">
                            <p>
                                <?php echo e(@$footer->data->short_description); ?>

                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-item">
                        <h3><?php echo e($navbar['Categories']); ?></h3>
                        <ul>
                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url('/experts')); ?>"><?php echo e(__($category->name)); ?></a></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <li ><a href="/service/অন্যান্য%20যানবাহন%20ভাড়া">আরো দেখুন</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-item">
                        <h3><?php echo e($navbar['Quick Links']); ?></h3>
                        <ul>
                            <?php $__currentLoopData = $policies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('policy', @$policy->data->slug)); ?>"><?php echo e(__(@$policy->data->page_name)); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-item">
                        <h3><?php echo e($navbar['Contact Info']); ?></h3>
                        <ul>
                            <li><b><?php echo e($navbar['Address']); ?>:</b> <br><?php echo e(__(@$contact->data->address)); ?></li>
                            <li><b><?php echo e($navbar['Call']); ?>:</b> <br><?php echo e(__(@$contact->data->phone)); ?></li>
                            <li><b><?php echo e($navbar['Email']); ?>:</b> <br><?php echo e(__(@$contact->data->email)); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyrignt">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright-text">
                        <p><?php echo e(__(@$footer->data->copyright)); ?> | Developed By <a class="text-light" href="https://gloriousit.com" target="_blank">Glorious IT</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-social">
                        <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(@$social->data->socail_link); ?>"><i class="<?php echo e(@$social->data->social_icon); ?>"></i></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Footer End-->

<!--Scroll-Top-->
<div class="scroll-top">
    <i class="fa fa-angle-up"></i>
</div>
<!--Scroll-Top-->
<?php /**PATH C:\laragon\www\uma_market\resources\views/frontend/sections/footer.blade.php ENDPATH**/ ?>