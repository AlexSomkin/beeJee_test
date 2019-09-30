      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="/tasks/">Задачи</a></li>
        </ul>
        <h3 class="text-muted">Авторизация</h3>
        <ol class="breadcrumb">
          <li><a href="/tasks/">Домой</a></li>
          <li class="active">Авторизация</li>
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
          <form role="form" action="login" method="post">
            <div class="form-group">
              <label for="exampleInputLogin">Логин</label>
              <input type="label" class="form-control" id="exampleInputLogin" name="login" placeholder="Введите логин" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Пароль</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Введите пароль" required>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
            <a href="/tasks/" class="btn btn-default">Назад</a>
          </form>
          <br>

          <?php if (isset($error_login)) {?>
            <div class="alert alert-danger">
              <p class="error"><?=$error_login?></p>
            </div>
          <?php } ?>

        </div>

      <div class="footer"> 
      </div>