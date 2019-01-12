$(window).on('load', () => {

  $('#add-task-form').on('submit', (ev) => {
    const textArea = $(ev.target).find('#task-name');
    const taskName = textArea.val();

    $('#task-list').append(`<li>${taskName}</li>`);
    textArea.val('');

    ev.preventDefault();
  });

})