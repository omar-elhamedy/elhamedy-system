<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
<?= 'ضبط الملف الشخصي' ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">ضبط الملف الشخصي</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">


            </div>
        </div>
    </div>
<?php if(session()->has('errors')): ?>
    <?php foreach (session('errors') as $err): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                <?= $err ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(session()->has('info')): ?>

    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            <?= session()->get('info') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php endif; ?>

<section>
    <?= form_open('/profile/update/' . $user->id) ?>
    <div class="row my-3">
        <div class="col-2 mb-3">
            <input type="text" placeholder="الاسم" class="form-control form-control-lg" id="name" value="<?= old('name', esc($user->name)) ?>" name="name" autofocus>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-2 mb-3">
            <input type="text" placeholder="اسم المستخدم" class="form-control form-control-lg" id="username" value="<?= old('username', esc($user->username)) ?>" name="username">
        </div>
    </div>
    <div class="row my-3">
        <div class="col-2 mb-3">
            <input type="email" placeholder="البريد الاليكترونى" class="form-control form-control-lg" id="email" value="<?= old('email', esc($user->email)) ?>" name="email">
        </div>
    </div>
    <div class="row my-3">
        <div class="col-2 mb-3">
            <input type="password" placeholder="كلمة المرور" class="form-control form-control-lg" name="password">
        </div>
    </div>
    <div class="row my-3">
        <div class="col-2 mb-3">
            <input type="password" placeholder="تأكيد كلمة المرور" class="form-control form-control-lg" name="password_confirmation">
        </div>
    </div>
    <div class="row my-3">
        <div class="col-auto btn-block">
            <button type="submit" class="btn btn-primary mb-3">تسجيل المستخدم</button>
            <a href="<?= site_url('/settings') ?>" class="btn btn-primary mb-3">الغاء</a>
        </div>

        <?= form_close() ?>
</section>

<?= $this->endSection() ?>
