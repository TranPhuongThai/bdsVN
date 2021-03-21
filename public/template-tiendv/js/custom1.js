$(document).ready(function(){
    $('.sale-news-list-detail > .description').each(function( index ) {
        let cutText = $(this).text();
        cutText =  cutText.slice(0, 300);
        console.log(200 - cutText.length);
        
        $(this).text(cutText);
    });
});