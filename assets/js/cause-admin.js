document.addEventListener('DOMContentLoaded', function () {
  const button = document.getElementById('ea-gallery-button');
  const preview = document.getElementById('ea-gallery-preview');
  const input = document.getElementById('ea-gallery-ids');

  if (!button || !preview || !input || typeof wp === 'undefined' || !wp.media) {
    return;
  }

  let frame;

  function updateRemoveButtons() {
    document.querySelectorAll('.ea-gallery-remove').forEach(function (removeButton) {
      removeButton.removeEventListener('click', removeImage);
      removeButton.addEventListener('click', removeImage);
    });
  }

  function removeImage(event) {
    event.preventDefault();
    const item = event.target.closest('.ea-gallery-item');
    const id = item && item.getAttribute('data-id');
    if (!id) {
      return;
    }

    const ids = input.value.split(',').filter(function (value) {
      return value !== id;
    });

    input.value = ids.join(',');
    item.remove();
  }

  button.addEventListener('click', function (event) {
    event.preventDefault();

    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select Images for Gallery',
      button: { text: 'Insert' },
      multiple: true
    });

    frame.on('select', function () {
      const selected = frame.state().get('selection').toJSON();
      selected.forEach(function (image) {
        if (input.value.includes(String(image.id))) {
          return;
        }

        const thumb = image.sizes && image.sizes.thumbnail ? image.sizes.thumbnail.url : image.url;
        const item = document.createElement('div');
        item.className = 'ea-gallery-item';
        item.setAttribute('data-id', image.id);
        item.style.cssText = 'position:relative; width:100px; height:100px; background:#f0f0f0; border-radius:4px; overflow:hidden;';
        item.innerHTML = '<img src="' + thumb + '" style="width:100%; height:100%; object-fit:cover;"><button type="button" class="ea-gallery-remove" style="position:absolute; top:2px; right:2px; background:red; color:white; border:none; border-radius:50%; width:24px; height:24px; cursor:pointer; font-size:16px;">×</button>';
        preview.appendChild(item);
        input.value = input.value ? input.value + ',' + image.id : String(image.id);
      });

      updateRemoveButtons();
    });

    frame.open();
  });

  updateRemoveButtons();
});
