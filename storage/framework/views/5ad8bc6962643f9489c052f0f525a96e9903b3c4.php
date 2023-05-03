<!DOCTYPE html>
<html>
<head>
    <title><?php echo e(__('Installer')); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('public/theme/install/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/theme/install/css/fontawesome-all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/theme/install/css/font.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/theme/install/css/default.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/theme/install/css/style.css')); ?>">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('public/theme/install/img/favicon.ico')); ?>">
</head>
<body>
<!-- requirments-section-start -->
<section class="mt-50 mb-50">
    <div class="requirments-section">
        <div class="content-requirments d-flex justify-content-center">
            <div class="requirments-main-content">
                <div class="multi-step text-center">
                    <nav>
                        <ul id="progressbar">
                            <li class="active">
                                <div class="step-number">
                                    <span><?php echo e(__(1)); ?></span>
                                </div>
                                <div class="step-info">
                                    <?php echo e(__('Requirments')); ?>

                                </div>
                            </li>
                            <li>
                                <div class="step-number">
                                    <span><?php echo e(__(2)); ?></span>
                                </div>
                                <div class="step-info">
                                    <?php echo e(__('Configuration')); ?>

                                </div>
                            </li>
                            <li>
                                <div class="step-number">
                                    <span><?php echo e(__(3)); ?></span>
                                </div>
                                <div class="step-info">
                                    <?php echo e(__('Complete')); ?>

                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="installer-header text-center">
                    <h2><?php echo e(__('Requirments')); ?></h2>
                    <p><?php echo e(__('Please make sure the PHP extentions listed below are installed')); ?></p>
                </div>
                <table class="table requirments">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col"><?php echo e(__('Extentions')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($requirements)) {
                    foreach($requirements as $extension => $loaded) {
                    $_isLoaded = !$loaded ? 'list-group-item-danger' : '';
                    ?>
                    <tr class="<?php echo $_isLoaded ?>">
                        <td><?php echo e($extension); ?></td>
                        <td>
                            <?php
                            if ($loaded) { ?>
                            <i class="fas fa-check"></i>
                            <?php
                            }else{ ?>
                            <i class="fas fa-times"></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                    </tbody>
                </table>
                <table class="table requirments">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col"><?php echo e(__('Permissions')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($dir)) {
                    foreach($dir as $extension => $loaded) {
                    $_isLoaded = (is_writable($loaded)) ? '' : 'list-group-item-danger';
                    ?>
                    <tr class="<?php echo $_isLoaded ?>">
                        <td><?php echo e($extension); ?></td>
                        <td>
                            <?php
                            if (is_writable($loaded)) { ?>
                            <i class="fas fa-check"></i>
                            <?php
                            }else{ ?>
                            <i class="fas fa-times"></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                if (!$isRequirementPassed) {
                ?>
                <div class="alert alert-danger">
                    <strong>Oh snap!</strong> Your system does not meet the requirements. You have to fix them in
                    order to continue.
                </div>
                <?php
                }
                if ($isRequirementPassed) {?>
                <a href="<?php echo e(route('install.configuration')); ?>" class="btn btn-primary install-btn f-right">Next</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
</body>
</html><?php /**PATH C:\xampp\htdocs\ayf\resources\views/installer/index.blade.php ENDPATH**/ ?>