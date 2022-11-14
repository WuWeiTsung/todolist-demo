$(document).ready(function () {

  //handlebars setting
  var source = document.getElementById("todo-template").innerHTML;
  var todoTemplate = Handlebars.compile(source);

  //print todos in db
  let todoUI = ""
  $.each(todos, function (index, todo) {
    todoUI = todoUI + todoTemplate(todo)
  })
  $('li.new').after(todoUI)

  //create
  $('li.new').find('.content').blur(function (e) {
    let todo = $(e.currentTarget).text().trim()
    if (todo.length > 0) {

      //AJAX create 
      let order = 1
      // let order = $('#todo-list').find('li:not(.new)').length + 1
      $.post("todo/create.php", { content: todo, order: order },
        function (data, textStatus, jqXHR) {
          let context = {
            id: data.id,
            is_complete: false,
            content: todo,
          }
          let html = todoTemplate(context);
          $(e.currentTarget).closest('li').after(html);
        });
    }
    $(e.currentTarget).empty();
  })

  //update
  $('#todo-list')
    .on('dblclick', '.content', function (e) {
      $(e.target).prop('contenteditable', true).focus()
    })
    .on('blur', '.content', function (e) {
      let isNew = $(e.currentTarget).closest('li').is('.new')
      if (!isNew) {
        //AJAX update
        let id = $(e.currentTarget).closest('li').data('id')
        let content = $(e.currentTarget).text()
        $.post("todo/update.php", { id: id, content: content });
        $(e.currentTarget).prop('contenteditable', false)
      }
    })

  //delete
  $('#todo-list').on('click', '.delete', function (e) {
    let result = confirm('Are you sure you want to delete?')
    if (result) {
      //AJAX delete
      let id = $(e.currentTarget).closest('li').data('id')
      $.post("todo/delete.php", { id: id }, function (data, textStatus, jqXHR) {
        $(e.currentTarget).closest('li').remove()
      })

    }
  })

  //check complete
  $('#todo-list').on('click', '.checkbox', function (e) {
    //AJAX complete
    let id = $(e.currentTarget).closest('li').data('id')
    $.post("todo/complete.php", { id: id },
      function (data, textStatus, jqXHR) {
        $(e.currentTarget).closest('li').toggleClass('complete')
      },
    );

  })

  //sort
  $("#todo-list").find('ul').sortable({
    items: "li:not(.new)",
    //AJAX sort
    stop: function () {
      let orderList = []
      $('#todo-list').find('li:not(.new)').each(function (index, li) {
        orderList.push({
          id: $(li).data('id'),
          order: index + 2,
        })
      })
      $.post("todo/sort.php", { orderList: orderList });

    }
  });


})