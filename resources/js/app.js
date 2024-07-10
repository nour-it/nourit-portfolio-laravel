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