import './bootstrap';

import FroalaEditor from "froala-editor"
import 'froala-editor/js/plugins/align.min.js'
import "froala-editor/css/froala_style.min.css"
window.FroalaEditor = FroalaEditor;

import "quill/dist/quill.snow.css"
import Quill from 'quill';
window.Quill = Quill;


window.addEventListener("load", function() {
    let $iconField = document.querySelector("input#icon") || document.querySelector("input#image")
    if ($iconField) {
        $iconField.addEventListener("change", function(e) {
            e.target.parentElement.querySelectorAll("img").forEach(img => {
                e.target.parentElement.removeChild(img)
            });
            const files = e.target.files;
            for (let file in files) {
                if (file !== 'item' && file !== 'length') {
                    let $img = document.createElement("img")
                    $img.src = URL.createObjectURL(files[file]);
                    $img.height = 50;
                    e.target.parentElement.appendChild($img);
                }
            }
        })
    }
})