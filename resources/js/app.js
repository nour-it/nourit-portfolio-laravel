import './bootstrap';

// froalaEditor
import FroalaEditor from "froala-editor"
import 'froala-editor/js/plugins/align.min.js'
import "froala-editor/css/froala_style.min.css"

// swup
import Swup from 'swup';
import SwupSlideTheme from '@swup/slide-theme';

// quill editor
import "quill/dist/quill.snow.css"
import Quill from 'quill';
import ImageFileViewer from './ImageFileViewer';

// chart
import Chart from "./Chart"

ImageFileViewer.listen()
Chart.listen()

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

window.FroalaEditor = FroalaEditor;
window.Quill = Quill;

const swup = new Swup({
    plugins: [new SwupSlideTheme()],
    // cache: false
});

const delegation = swup.delegateEvent('form', 'submit', (event) => {
    event.preventDefault()
    const data = new FormData(event.target)
    axios({
        method: event.target.method,
        url: event.target.action,
        headers: {},
        data: data
    })
        .then(response => {
            if (response.status >= 200 && response.status < 400) {
                console.log(event.target.method, event.target.action)
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
})

swup.hooks.on('page:load', () => {
    // Remove 'active' class from all links
    document.querySelectorAll('li.active').forEach((link) => {
        link.classList.remove('active');
    });

    // Get the current URL path
    const currentPath = window.location.pathname;

    // Add 'active' class to the link that matches the current path
    document.querySelectorAll('aside ul li a').forEach((link) => {
        if (link.pathname === currentPath) {
            link.parentElement?.classList.add('active');
        }
    });
    
});



 