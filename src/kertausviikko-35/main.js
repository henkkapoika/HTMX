document.getElementById('recommended-images').addEventListener('htmx:afterRequest', function(event){

    if(event.detail.pathInfo.requestPath !== 'recommended-images.php'){
        return;
    } else {

    }

    const loadingDiv = document.getElementById('loading');

    loadingDiv.style.animation = 'none';
    loadingDiv.offsetHeight; 
    loadingDiv.style.animation = null;

});