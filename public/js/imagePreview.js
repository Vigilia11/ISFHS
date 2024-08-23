//image preview
front_id_picture.onchange = evt => {
    const [file] = front_id_picture.files
    if (file) {
        front_id_preview.src = URL.createObjectURL(file)
        $('#img_add_preview').show();
    }
}
back_id_picture.onchange = evt => {
    const [file] = back_id_picture.files
    if (file) {
        back_id_preview.src = URL.createObjectURL(file)
        $('#img_add_preview').show();
    }
}