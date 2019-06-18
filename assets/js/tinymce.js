$(function () {
    tinymce.init({
        selector: '#project-description',
        width: '100%',
        height: 300,
        language: 'fr_FR',
        language_url : '/fr_FR.js',
        plugins: "lists, link, code, fullscreen, wordcount, autolink, autosave, table, hr",
        toolbar: 'formatselect | bold italic | link | alignleft aligncenter alignright | numlist bullist',
        menubar: false,
        content_style: `
        * {
            font-size: 1.02em;
            font-family: 'Varela Round', sans-serif;
        } 
        
        h1, h2, h3, h4, h5 {
            font-family: 'Montserrat', sans-serif;
        }
        
        p {
            color: #222;
        }
        `,
        content_css: ['https://fonts.googleapis.com/css?family=Montserrat:400,600%7CVarela+Round&display=swap']
    });
});
