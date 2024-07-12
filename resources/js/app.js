import './bootstrap';

import FroalaEditor from "froala-editor"
import 'froala-editor/js/plugins/align.min.js'
import "froala-editor/css/froala_style.min.css"
window.FroalaEditor = FroalaEditor;

import "quill/dist/quill.snow.css"
import Quill from 'quill';
import ImageFileViewer from './ImageFileViewer';
window.Quill = Quill;

ImageFileViewer.listen()

// Echo.private(`demo`)
//     .listen("App\\Events\\Admin\\UpdateProfileEvent", (e) => {
//         console.log(e);
//     })
//     .listen("UpdateProfileEvent", (e) => {
//         console.log(e);
//     })
//     .listen(".demo.brodcast", (e) => {
//         console.log(e);
//     })

