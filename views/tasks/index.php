<div class="header">
  <ul class="nav nav-pills pull-right">
    <li><a href="/tasks/add">Добавить задачу</a></li>
    <?php
      if(!$auth::isLogged()){
        echo '<li><a href="/admin/login">Авторизироваться</a></li>';
      }else{
        echo '<li><a href="/admin/logout">Выйти['.$auth->getLogin().']</a></li>';
      }
    ?>
  </ul>
  <h3 class="text-muted">Задачи</h3>
</div>
<div class="row">
  <?php if (isset($success_message)) { ?>
  <div class="col-lg-12">
    <div class="alert alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <?= $success_message; ?>
    </div>
  </div>
  <? } ?>
  <div class="col-lg-12">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered task-list-table">
        <theader>
          <tr>
            <td name="nameTitle" class="active text-center">
              <?php echo '<a href="/tasks/'.$current_page.'/'.$other_sort['name'].'">Имя</a>';?>
            </td>
            <td name="emailTitle" class="active text-center">
              <?php echo '<a href="/tasks/'.$current_page.'/'.$other_sort['email'].'">E-mail</a>';?>
            </td>
            <td name="contentTitle" class="active text-center">Текст задачи</td>
            <td name="doneTitle" class="active text-center">
              <?php echo '<a href="/tasks/'.$current_page.'/'.$other_sort['done'].'">Статус</a>';?>
            </td>
            <?php
              if($auth::isLogged()){
                echo '<td name="doneUpdate" class="active text-center"></td>';
              }
            ?>
          </tr>
        </theader>  
        <tbody>
          <?php
            if(isset($tasks)){
              for($i = 0; $i < count($tasks); $i++){
                echo '<tr class="task-list-table-item">';
                echo '<td name="name" style="vertical-align:middle;" class="text-center task-list-table-name">'.$tasks[$i]['name'].'</td>';
                echo '<td name="email" style="vertical-align:middle;" class="text-center task-list-table-email">'.$tasks[$i]['email'].'</td>';
                echo '<td name="content" style="vertical-align:middle;" class="text-center task-list-table-content">'.$tasks[$i]['content'].'</td>';
                
                if ($tasks[$i]['done'] == 1) {
                  echo '<td name="done" style="vertical-align:middle;" class="text-center task-list-table-done"><span class="label label-success">Выполнена</span></td>';
                } elseif ($tasks[$i]['done'] == 0) {
                  echo '<td name="done" style="vertical-align:middle;" class="text-center task-list-table-done">'.
                        '<span class="label label-info">Не выполнена</span>';
                  if ($tasks[$i]['edited'] != null && $tasks[$i]['edited'] > 0) {
                    echo '<span class="edited-by-admin label label-primary">Отредактировано администратором</span>';
                  }

                  echo  '</td>';
                }
                
                if ($auth::isLogged()) {
                  echo '<td name="doneUpdate" style="vertical-align:middle;" class="active text-center">'.
                        '<a href="/tasks/update/'.$tasks[$i]['id'].'">Править</a>'.
                        '</td>';
                }
                
                echo '</tr>';
              }
            }
          ?> 
        </tbody>
      </table>
      <div id="pagination" class="text-center">
        <ul class="pagination">
          <?php
            if ($current_page != 1) {
              echo '<li><a href="/tasks/1" title="Первая">Первая</a></li>';
            }

            for ($i = 0; $i < $count_pages; $i++) {
              if (($i + 1) == $current_page) {
                echo '<li class="active"><a href="">'.($i + 1).'</a></li>';
              } else {
                echo '<li class=""><a href="/tasks/'.($i + 1).$current_sort.'">'.($i + 1).'</a></li>';
              }
            }

            if ($count_pages != $current_page && $count_pages > 0) {
              echo '<li><a href="/tasks/'.$count_pages.$current_sort.'" title="Последняя">Последняя</a></li>';
            }
          ?>
        </ul>      
      </div>       
    </div>
  </div>
  <div class="footer">
  </div>
</div>