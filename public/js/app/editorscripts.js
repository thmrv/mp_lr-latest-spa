
let editor = {
    darkFix: function() {
        document.querySelector('.dark iframe').contentDocument.querySelector('html').style.background = 'red';
    }
}

(function() {
    editor.darkFix();
 })();
