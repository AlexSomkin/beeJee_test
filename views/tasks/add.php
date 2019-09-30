<div class="header">
  <ul class="nav nav-pills pull-right">
    <li><a href="/tasks/">Задачи</a></li>
      <?php
        if (!$auth::isLogged()) {
          echo '<li><a href="/admin/login">Авторизироваться</a></li>';
        } else {
          echo '<li><a href="/admin/logout">Выйти['.$auth->getLogin().']</a></li>';
        }
      ?>
  </ul>
  <h3 class="text-muted">Добавление задачи</h3>
  <ol class="breadcrumb">
    <li><a href="/tasks/">Домой</a></li>
    <li class="active">Добавление задачи</li>
  </ol>
</div>
<div class="row">
  <?php if (isset($error_messages) && count($error_messages) > 0) { ?>
    <div class="col-lg-12">
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php foreach ($error_messages as $error) { ?>
          <span><?= $error; ?></span><br>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
  <div class="col-lg-12">
    <form role="form" action="add" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="taskInputName">Имя</label>
        <input type="label" class="form-control" id="taskInputName" name="name" placeholder="Введите имя" required>
      </div>
      <div class="form-group">
        <label for="taskInputEmail">E-mail</label>
        <input type="email" class="form-control" id="taskInputEmail" name="email" placeholder="Введите e-mail" required>
      </div>
      <div class="form-group">
        <label for="taskInputContant">Задача</label>
        <input type="text" class="form-control" id="taskInputContant" name="content" placeholder="Введите задачу" required>
      </div>
      <button type="submit" class="btn btn-success">Добавить</button>
      <a href="/tasks/" class="btn btn-default">Назад</a>
    </form>
    <br>
  </div>
</div>