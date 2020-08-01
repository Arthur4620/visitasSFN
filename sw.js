//Asignar nombre  y vercion de cache
const CACHE_NAME = 'V1_cache_visitas';

//ficheros a cachear en aplicacion
var urlsToCache=[
    './',
    './public/css/all.min.css',
    './public/css/carta.css',
    './public/css/main.css',
    './public/css/main2.css',
    './public/css/normalize.css',
    './public/css/tablas.css',
    './public/img/icono.png',
    './public/img/marker2.png',
    './public/img/MLab16.png',
    './public/img/MLab32.png',
    './public/img/MLab64.png',
    './public/img/MLab96.png',
    './public/img/MLab128.png',
    './public/img/MLab192.png',
    './public/img/MLab256.png',
    './public/img/MLab384.png',
    './public/img/MLab512.png',
    './public/img/MLab1024.png',
    './public/js/excel.js',
    './public/js/FileSaver.min.js',
    './public/js/login.js',
    './public/js/menu.js',
    './public/js/scripsExcel.js',
    './public/js/scripstExcel.js',
    './public/js/tableexport.min.js',
    './public/js/validacion.js',
    './public/js/xlsx.full.min.js',
    './public/views/mapa.php',
    './public/views/mapa2.php',
    './public/views/regRepresentantes.php',
    './public/views/tabClinicas.php',
    './public/views/tabRepresentantes.php',
    './public/views/tabVisitas.php',
    './DB/conexion.php',
    './ajax.js',
    './conexion1.php',
    './database.php',
    './index.php',
    './login.php',
    './logout.php',
    './main.js',
    './rcp.php',
    './sw,js',
    './user.php',
    './visita.php'
    
];

//evento Instal
    //instalacion del service worker y en cache los archivos estaticos
    self.addEventListener('instal',e=>{
        e.waitUntil(
            caches.open(CACHE_NAME)
                .then(cache=>{
                    return cache.addAll(urlsToCache)
                        .then(()=>{
                            self.skipWaiting();
                        });
                        
                })
               .catch(err=> console.log('Nose registro la cache',err))
        );
    });

//ACTIVATE
//que la app funcione sin conexion
self.addEventListener('activate',e=>{
    const cacheWhitelist=[CACHE_NAME];
        e.waitUntil(
            caches.keys()
                .then(cacheNames=>{
                    return Promise.all(
                        cacheNames.map(cacheName=>{

                            if(cacheWhitelist.indexOf(cacheName)=== -1){
                                //Borrar elementos no se necesitan
                                return caches.delete(cacheName);
                            }

                        })
                    );
                })
                .then(()=>{
                    self.clients.claim();
                })
        );

});

//Evento fetch

self.addEventListener('fetch', e=>{
    e.respondWith(
        caches.match(e.resquest)
            .then(res=>{
                if(res){
                    //devuelvo datos desde cache
                    return res;
                }
                return fetch(e.request);

            })
    );
})