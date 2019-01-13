const listItemTemplate = (text) => {
  return `
    <li contenteditable="false">
        <div class="body">
          <span class="text">${text}</span>

          <div class="manage">
            <span class="edit">
              <i class="fas fa-pencil-alt"></i>
            </span>
            <span class="delete">
              <i class="fas fa-trash-alt"></i>
            </span>
          </div>
        </div>
    </li>
  `;
};

const createListItem = (text) => {
  const newElement = $(listItemTemplate(text));
  newElement.find(`.manage .edit`).on('click', ev => {
    newElement.attr('contenteditable', true);
  });
  newElement.find(`.manage .delete`).on('click', ev => {
    newElement.remove();
  });
  return newElement;
};

$(window).on('load', () => {
  $('#add-task-form').on('submit', ev => {
    const textArea = $(ev.target).find('#task-name');
    const taskName = textArea.val();
    if (!taskName) {
      ev.preventDefault();
      return;
    }
    $('#task-list').append(createListItem(taskName));
    textArea.val('');
    ev.preventDefault();
  });
});