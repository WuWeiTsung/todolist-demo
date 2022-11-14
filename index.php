<?php include('header.php'); ?>
<?php include('data.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-8">
      <div id="panel">
        <div style="text-align:center;">
          <H1> TODO LIST</H1>
        </div>
        <div id="todo-list">
          <ul>
            <li class="new">
              <div class="">Enter TODO -></div>
              <div class="content" contenteditable="true"></div>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-4 mt-3">
      <h3 class="text-center">使用說明</h3>
      <ul>
        <li>滑鼠點擊Enter TODO-> 處可輸入內容，輸入後左鍵點擊他處可新增todo</li>
        <li>在todo上雙擊滑鼠左鍵可修改內容，點擊其他處完成修改</li>
        <li>點擊todo前方圓圈，可變更為完成todo</li>
        <li>按住滑鼠左鍵拖曳，可更改todo順序</li>
        <li>點擊X可刪除todo</li>
      </ul>
    </div>
  </div>
</div>

<!-- handlebars-template -->
<script id="todo-template" type="text/x-handlebars-template">
  <li data-id="{{id}}" class="{{#if is_complete}}complete{{/if}}">
    <div class="checkbox"></div>
    <div class="content">{{content}}</div>
    <div class="delete">X</div>
  </li>
</script>

<?php include('footer.php'); ?>