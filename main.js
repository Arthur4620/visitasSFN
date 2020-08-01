

//SERVICE WORKER
if('serviceWorker' in navigator){
    console.log("puedes usar los Service Worker");

        //elementos de service worket
        navigator.serviceWorker.register('./sw.js')
                                .then(res=>console.log('service worker cargado correctamente',res))
                                .catch(err=>console.log('service worket no se pudo registrar',err));
                                

}else{
    console.log("no puedes ");
}









//
    /*$(document).ready(function(){
    $("#menu a").click(function(){
        e.preventDefault();
       
        $("html,body").animate({
            scrollTop:$($(this).attr('href')).offset().top
        });

        return false;
    });
});*/