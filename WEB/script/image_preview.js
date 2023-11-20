function previewImage(input) {
    var preview = document.getElementById('preview');
    var file = input.files[0];
    var reader = new FileReader();
  
    reader.onloadend = function () {
      preview.src = reader.result;
    };
  
    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = "../images/<?= $myuser['icon_path'] ?>";
    }
  }
  