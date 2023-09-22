document.getElementById('image').addEventListener('change', function() {
    if (this.files && this.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imgPreview').src = e.target.result
        };
        reader.readAsDataURL(this.files[0]);
    }
})
