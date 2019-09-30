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
  <h3 class="text-muted">Изменение задачи</h3>
  <ol class="breadcrumb">
    <li><a href="/tasks/">Домой</a></li>
    <li class="active">Изменение задачи</li>
  </ol>
</div>
<div class="row">
  <div class="col-lg-12">
    <form role="form" action="" method="post">
      <div class="form-group">
        <label for="taskInputName">Имя</label>
        <input type="label" class="form-control" id="taskInputName" value="<?php echo $task['name']?>" disabled="disabled" readonly>
      </div>
      <div class="form-group">
        <label for="taskInputEmail">E-mail</label>
        <input type="label" class="form-control" id="taskInputEmail" value="<?php echo $task['email']?>" disabled="disabled" readonly>
      </div>
      <div class="form-group">
        <label for="taskInputContant">Задача</label>
        <textarea type="text" class="form-control" id="taskInputContant" name="content"><?php echo $task['content']?></textarea>
      </div>
      <div class="form-group">
        <label for="taskInputDone">Задача выполнена</label><br>
        <input type="checkbox" class="pull_left" id="taskInputDone" value="yes" <?php if($task['done'] == 1) echo 'checked'?> name="done">
      </div>
      <button type="submit" class="btn btn-success">Отправить</button>
      <a href="/tasks/" class="btn btn-default">Назад</a>
    </form>
    <br>
  </div>
<div class="footer">
</div>