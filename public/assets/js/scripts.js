function handleDelete(formId, event) {
    event.preventDefault();
    if (confirm('Bạn có chắc chắn')){
        document.querySelector(`#${formId}`).submit();
    }
}
