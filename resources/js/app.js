import './bootstrap';

import "~resources/scss/app.scss";
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);


const previewImgElem = document.getElementById('preview-img');

const image = document.getElementById('cover_image');


if(image) {
    image.addEventListener('change', function() {
        const selectedFile = this.files[0];
        if (selectedFile) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                previewImgElem.src = reader.result;
            })
            reader.readAsDataURL(selectedFile);
        }
    })
}
