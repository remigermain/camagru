function remove_notify()
{
  const not = document.getElementById('notify');
  if (not)
    not.remove();
}

function create_close()
{
    const close = document.createElement('button');
    close.setAttribute('onClick', "this.parentNode.remove()")
    close.setAttribute("class", "delete");
    return (close);
}

function create_notify(msg, type)
{
    const div = document.createElement('div');
    const close = create_close();
    div.classList.add("notification");
    div.setAttribute('id', "notify");
    if (type != 1)
    {
        var error = document.createElement('strong');
        error.textContent = "Error: ";
        div.append(error);
        div.classList.add("is-danger");
    }
    else
        div.classList.add("is-info");
    div.append(msg);
    div.append(close);
    document.getElementById('notif').prepend(div);
}