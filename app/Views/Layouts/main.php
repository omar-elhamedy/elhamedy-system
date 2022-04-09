<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= site_url("/css/dashboard.css")?>">
    <link rel="stylesheet" href="<?= site_url("/css/auto-complete.css")?>">
    <link rel="stylesheet" href="<?= site_url("/css/bootstrap-select.min.css")?>">
    <script src="<?= site_url('/js/chart.min.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title><?= $_ENV['COMPANY'] ?> - <?= $this->renderSection("title") ?></title>
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?= $_ENV['COMPANY'] ?></a>

    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="عرض/إخفاء لوحة التنقل">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="col p-2 align-self-end">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <?php if (session()->has('user_id')): ?>
            <?php foreach (getBookmarks() as $bookmark): ?>
              <a type="button" href="<?= site_url($bookmark->uri) ?>" class="btn btn-secondary"><?= $bookmark->uri_title ?></a>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if (session()->has('user_id')): ?>
    <a class="col-md-3 col-lg-1 text-center justify-content-end" href="<?= site_url('/logout') ?>"><?= 'تسجيل الخروج'?></a>
    <?php else: ?>
    <a class="col-md-3 col-lg-1 text-center justify-content-end" href="<?= site_url('/login') ?>" ><?= 'تسجيل الدخول'?></a>
    <?php endif; ?>
    <!--    <input class="form-control form-control-dark w-100" type="text" placeholder="بحث" aria-label="بحث">-->
<!--    <div class="navbar-nav block">-->
<!--        <div class="nav-item text-nowrap">-->
<!--            <a class="nav-link px-3" href="#">تسجيل الخروج</a>-->
<!--        </div>-->
<!--    </div>-->
</header>
<div class="container-fluid">
    <div class="row">

        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <?php if (session()->has('user_id')): ?>
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('/')) ? 'active' : '' ?>" aria-current="page" href="<?= site_url("/") ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            لوحة القيادة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link clients collapsed" id="collabse-menu" data-bs-toggle="collapse" data-bs-target="#clients" role="button" aria-expanded="false" aria-controls="clients" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            العملاء
                        </a >
                        <div class="collapse bg-dark  <?= (url_is('/clients*')) ? 'show' : '' ?>" id="clients">

                                    <a class="nav-link text-white <?= (url_is('/clients')) ? 'sub-active' : '' ?>" aria-current="page" href="<?= site_url("/clients") ?>">

                                        اليومية
                                    </a>

                                    <?php foreach (getAllClients() as $client): ?>

                                    <a class="nav-link text-white <?= (url_is('/clients/' . $client->id)) ? 'sub-active' : '' ?>" aria-current="page" href="<?= site_url("/clients/" . $client->id) ?>">

                                        <?= $client->name ?>
                                    </a>
                                    <?php endforeach; ?>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link suppliers collapsed" id="collabse-menu" data-bs-toggle="collapse" data-bs-target="#suppliers" role="button" aria-expanded="false" aria-controls="suppliers" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            الموردين
                        </a >
                        <div class="collapse bg-dark  <?= (url_is('/suppliers*')) ? 'show' : '' ?>" id="suppliers">

                            <a class="nav-link text-white <?= (url_is('/suppliers')) ? 'sub-active' : '' ?>" aria-current="page" href="<?= site_url("/suppliers") ?>">

                                حسابات الموردين
                            </a>

                            <?php foreach (getAllSuppliers() as $supplier): ?>

                                <a class="nav-link text-white <?= (url_is('/suppliers/' . $supplier->id)) ? 'sub-active' : '' ?>" aria-current="page" href="<?= site_url("/suppliers/" . $supplier->id) ?>">

                                    <?= $supplier->name ?>
                                </a>
                            <?php endforeach; ?>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link suppliers collapsed" id="collabse-menu" data-bs-toggle="collapse" data-bs-target="#accounts" role="button" aria-expanded="false" aria-controls="suppliers" >
                            <svg id="Layer_1" data-name="Layer 1" height="24" width="24"class="feather" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 94.82 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>ledger</title><path class="cls-1" d="M18.12.05h72.3V57H49.22A7.21,7.21,0,0,0,42,64.19V90.05H17.11c-6.74.61-4.35,9.6,0,9.13H42v5.51H17.4c-10.12.14-13.47-.4-13.47-7.81V88.7a4.76,4.76,0,0,1,0-9.37V71.82a4.76,4.76,0,0,1,0-9.37V54.94a4.76,4.76,0,0,1,0-9.37V38.06A4.47,4.47,0,0,1,0,33.37a4.49,4.49,0,0,1,3.93-4.69v-7.5A4.48,4.48,0,0,1,0,16.49,4.48,4.48,0,0,1,3.93,11.8C3.94,2,4.5-.38,18.12.05ZM53.21,64.61H91.49a3.35,3.35,0,0,1,3.33,3.33v51.61a3.32,3.32,0,0,1-1,2.35,3.28,3.28,0,0,1-2.35,1H53.21a3.35,3.35,0,0,1-3.33-3.33V67.94a3.35,3.35,0,0,1,3.33-3.33Zm34.11,8.22H57.39v9.06H87.32V72.83ZM81.67,99.92H87a.83.83,0,0,1,.83.83v4.51a.83.83,0,0,1-.83.83H81.67a.84.84,0,0,1-.84-.83v-4.51a.84.84,0,0,1,.84-.83Zm0-10.7H87a.84.84,0,0,1,.83.84v4.5a.83.83,0,0,1-.83.83H81.67a.84.84,0,0,1-.84-.83v-4.5a.85.85,0,0,1,.84-.84Zm0,21.4H87a.83.83,0,0,1,.83.83V116a.84.84,0,0,1-.83.84H81.67a.84.84,0,0,1-.84-.84v-4.5a.85.85,0,0,1,.84-.83Zm-12-10.7H75a.84.84,0,0,1,.84.83v4.51a.84.84,0,0,1-.84.83H69.63a.84.84,0,0,1-.84-.83v-4.51a.84.84,0,0,1,.84-.83Zm0-10.7H75a.85.85,0,0,1,.84.84v4.5a.84.84,0,0,1-.84.83H69.63a.84.84,0,0,1-.84-.83v-4.5a.85.85,0,0,1,.84-.84Zm0,21.4H75a.84.84,0,0,1,.84.83V116a.85.85,0,0,1-.84.84H69.63a.84.84,0,0,1-.84-.84v-4.5a.85.85,0,0,1,.84-.83ZM57.81,89.22h5.33a.84.84,0,0,1,.84.84v4.5a.84.84,0,0,1-.84.83H57.81a.83.83,0,0,1-.83-.83v-4.5a.84.84,0,0,1,.83-.84Zm0,21.4h5.33a.84.84,0,0,1,.84.83V116a.84.84,0,0,1-.84.84H57.81A.84.84,0,0,1,57,116v-4.5a.84.84,0,0,1,.83-.83Zm0-10.7h5.33a.84.84,0,0,1,.84.83v4.51a.84.84,0,0,1-.84.83H57.81a.83.83,0,0,1-.83-.83v-4.51a.83.83,0,0,1,.83-.83ZM91.49,66.83H53.21a1.11,1.11,0,0,0-1.1,1.11v51.61a1.11,1.11,0,0,0,1.1,1.11H91.49a1.13,1.13,0,0,0,1.11-1.11V67.94a1.13,1.13,0,0,0-1.11-1.11ZM48.26,21.27a2,2,0,0,1-1.72-2.15A2,2,0,0,1,48.26,17H78.53a2,2,0,0,1,1.72,2.15,2,2,0,0,1-1.72,2.15Zm0,21.79a2.2,2.2,0,0,1,0-4.3h19.9a2.2,2.2,0,0,1,0,4.3Zm0-10.9A2,2,0,0,1,46.54,30a2,2,0,0,1,1.72-2.14H72.31A2,2,0,0,1,74,30a2,2,0,0,1-1.72,2.15ZM27,43.31c-.85-.05-1-.12-1.81-.23s-1.42-.2-2.09-.32-1.31-.27-1.93-.43V36.82c.81.07,1.69.13,2.63.17s1.89.09,2.86.11,1.87,0,2.7,0a9,9,0,0,0,2-.18,2.37,2.37,0,0,0,1.18-.57,1.48,1.48,0,0,0,.4-1.08v-.43a1.36,1.36,0,0,0-.56-1.18,2.21,2.21,0,0,0-1.31-.39H29.17q-4.16,0-6.3-1.83t-2.15-6.12V24.18a7.2,7.2,0,0,1,2.36-5.88A6.51,6.51,0,0,1,27,16.47V14.19h5.36v2.2a30.17,30.17,0,0,1,5.81,1v5.51c-1.1-.09-2.33-.17-3.71-.23s-2.62-.09-3.74-.09a9.65,9.65,0,0,0-1.79.15,2.15,2.15,0,0,0-1.21.57,1.66,1.66,0,0,0-.43,1.25v.36a1.66,1.66,0,0,0,.57,1.36,2.75,2.75,0,0,0,1.75.46H32a8.31,8.31,0,0,1,4.16,1,6.17,6.17,0,0,1,2.51,2.58,7.94,7.94,0,0,1,.84,3.7v1.18a9.4,9.4,0,0,1-1.18,5.19A5.8,5.8,0,0,1,35,42.74a9.74,9.74,0,0,1-2.59.56v2.55H27V43.31Z"/></svg>
                                            الحسابات
                        </a >
                        <div class="collapse bg-dark  <?= (url_is('/accounts*')) ? 'show' : '' ?>" id="accounts">

                            <?php foreach (getAllPaymentMethods() as $pm): ?>

                                <a class="nav-link text-white <?= (url_is('/accounts/' . $pm->id)) ? 'sub-active' : '' ?>" aria-current="page" href="<?= site_url("/accounts/" . $pm->id) ?>">

                                    <?= $pm->name ?>
                                </a>
                            <?php endforeach; ?>

                        </div>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link --><?//= (url_is('/inv*')) ? 'active' : '' ?><!--" href="--><?//= site_url("/inv") ?><!--">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>-->
<!--                            المنتجات-->
<!--                        </a>-->
<!--                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('/storage*')) ? 'active' : '' ?>" href="<?= site_url("/storage") ?>">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart" aria-hidden="true"><path d="M2.978 8.358l-2.978-2.618 8.707-4.74 3.341 2.345 3.21-2.345 8.742 4.639-3.014 2.68.014.008 3 4.115-3 1.634v4.122l-9 4.802-9-4.802v-4.115l1 .544v2.971l7.501 4.002v-7.889l-2.501 3.634-9-4.893 2.978-4.094zm9.523 5.366v7.875l7.499-4.001v-2.977l-5 2.724-2.499-3.621zm-11.022-1.606l7.208 3.918 1.847-2.684-7.231-3.742-1.824 2.508zm11.989 1.247l1.844 2.671 7.208-3.927-1.822-2.498-7.23 3.754zm-9.477-4.525l8.01-4.43 7.999 4.437-7.971 4.153-8.038-4.16zm-2.256-2.906l2.106 1.851 7.16-3.953-2.361-1.657-6.905 3.759zm11.273-2.052l7.076 3.901 2.176-1.935-6.918-3.671-2.334 1.705z"/></svg>
                            المخازن
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('/currency*')) ? 'active' : '' ?>" href="<?= site_url("/currency") ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"  class="feather feather-shopping-cart" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                   سعر العملة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('/reports*')) ? 'active' : '' ?>" href="<?= site_url("/reports") ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                            التقارير
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('/settings*')) ? 'active' : '' ?>" href="<?= site_url("/settings") ?>">
                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2" aria-hidden="true" width="24px" height="24px"><path d="M 22.205078 2 A 1.0001 1.0001 0 0 0 21.21875 2.8378906 L 20.246094 8.7929688 C 19.076509 9.1331971 17.961243 9.5922728 16.910156 10.164062 L 11.996094 6.6542969 A 1.0001 1.0001 0 0 0 10.708984 6.7597656 L 6.8183594 10.646484 A 1.0001 1.0001 0 0 0 6.7070312 11.927734 L 10.164062 16.873047 C 9.583454 17.930271 9.1142098 19.051824 8.765625 20.232422 L 2.8359375 21.21875 A 1.0001 1.0001 0 0 0 2.0019531 22.205078 L 2.0019531 27.705078 A 1.0001 1.0001 0 0 0 2.8261719 28.691406 L 8.7597656 29.742188 C 9.1064607 30.920739 9.5727226 32.043065 10.154297 33.101562 L 6.6542969 37.998047 A 1.0001 1.0001 0 0 0 6.7597656 39.285156 L 10.648438 43.175781 A 1.0001 1.0001 0 0 0 11.927734 43.289062 L 16.882812 39.820312 C 17.936999 40.39548 19.054994 40.857928 20.228516 41.201172 L 21.21875 47.164062 A 1.0001 1.0001 0 0 0 22.205078 48 L 27.705078 48 A 1.0001 1.0001 0 0 0 28.691406 47.173828 L 29.751953 41.1875 C 30.920633 40.838997 32.033372 40.369697 33.082031 39.791016 L 38.070312 43.291016 A 1.0001 1.0001 0 0 0 39.351562 43.179688 L 43.240234 39.287109 A 1.0001 1.0001 0 0 0 43.34375 37.996094 L 39.787109 33.058594 C 40.355783 32.014958 40.813915 30.908875 41.154297 29.748047 L 47.171875 28.693359 A 1.0001 1.0001 0 0 0 47.998047 27.707031 L 47.998047 22.207031 A 1.0001 1.0001 0 0 0 47.160156 21.220703 L 41.152344 20.238281 C 40.80968 19.078827 40.350281 17.974723 39.78125 16.931641 L 43.289062 11.933594 A 1.0001 1.0001 0 0 0 43.177734 10.652344 L 39.287109 6.7636719 A 1.0001 1.0001 0 0 0 37.996094 6.6601562 L 33.072266 10.201172 C 32.023186 9.6248101 30.909713 9.1579916 29.738281 8.8125 L 28.691406 2.828125 A 1.0001 1.0001 0 0 0 27.705078 2 L 22.205078 2 z M 23.056641 4 L 26.865234 4 L 27.861328 9.6855469 A 1.0001 1.0001 0 0 0 28.603516 10.484375 C 30.066026 10.848832 31.439607 11.426549 32.693359 12.185547 A 1.0001 1.0001 0 0 0 33.794922 12.142578 L 38.474609 8.7792969 L 41.167969 11.472656 L 37.835938 16.220703 A 1.0001 1.0001 0 0 0 37.796875 17.310547 C 38.548366 18.561471 39.118333 19.926379 39.482422 21.380859 A 1.0001 1.0001 0 0 0 40.291016 22.125 L 45.998047 23.058594 L 45.998047 26.867188 L 40.279297 27.871094 A 1.0001 1.0001 0 0 0 39.482422 28.617188 C 39.122545 30.069817 38.552234 31.434687 37.800781 32.685547 A 1.0001 1.0001 0 0 0 37.845703 33.785156 L 41.224609 38.474609 L 38.53125 41.169922 L 33.791016 37.84375 A 1.0001 1.0001 0 0 0 32.697266 37.808594 C 31.44975 38.567585 30.074755 39.148028 28.617188 39.517578 A 1.0001 1.0001 0 0 0 27.876953 40.3125 L 26.867188 46 L 23.052734 46 L 22.111328 40.337891 A 1.0001 1.0001 0 0 0 21.365234 39.53125 C 19.90185 39.170557 18.522094 38.59371 17.259766 37.835938 A 1.0001 1.0001 0 0 0 16.171875 37.875 L 11.46875 41.169922 L 8.7734375 38.470703 L 12.097656 33.824219 A 1.0001 1.0001 0 0 0 12.138672 32.724609 C 11.372652 31.458855 10.793319 30.079213 10.427734 28.609375 A 1.0001 1.0001 0 0 0 9.6328125 27.867188 L 4.0019531 26.867188 L 4.0019531 23.052734 L 9.6289062 22.117188 A 1.0001 1.0001 0 0 0 10.435547 21.373047 C 10.804273 19.898143 11.383325 18.518729 12.146484 17.255859 A 1.0001 1.0001 0 0 0 12.111328 16.164062 L 8.8261719 11.46875 L 11.523438 8.7734375 L 16.185547 12.105469 A 1.0001 1.0001 0 0 0 17.28125 12.148438 C 18.536908 11.394293 19.919867 10.822081 21.384766 10.462891 A 1.0001 1.0001 0 0 0 22.132812 9.6523438 L 23.056641 4 z M 25 17 C 20.593567 17 17 20.593567 17 25 C 17 29.406433 20.593567 33 25 33 C 29.406433 33 33 29.406433 33 25 C 33 20.593567 29.406433 17 25 17 z M 25 19 C 28.325553 19 31 21.674447 31 25 C 31 28.325553 28.325553 31 25 31 C 21.674447 31 19 28.325553 19 25 C 19 21.674447 21.674447 19 25 19 z"/></svg>
                            الاعدادات
                        </a>
                    </li>
                </ul>
                <?php endif; ?>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <?= $this->renderSection("content"); ?>
        </main>
    </div>
</div>

</body>

<script>
    function onWheel() { }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2c967f2d37.js" crossorigin="anonymous"></script>
<script src="<?= site_url('/js/script.js') ?>"></script>

<script src="<?= site_url('/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= site_url('/js/i18n/defaults-ar_AR.js') ?>"></script>
</html>