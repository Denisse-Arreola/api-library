// connect(´URL de búsqueda´) :
// Esta función se encarga de conectar con los distintos URL
// creados.

import Book from './Book.js'


function extractData(url, container){

    //Para el caso de una llamada de datos a una API
    //los datos devueltos por la API pueden, o no, existir
    //y en dado caso el traslado de datos se basa a una relación
    //asíncrona. Dicho esto, la manera en la que se reciben los datos
    // es en base a una promesa.

    fetch(url).
    then(res => res.json()).
    then(data => data.forEach(element => {
                let obj = new Book()                
                obj.createBook(container, element);
            }
        )
    ).
    catch(error => {console.log(
                {
                    error : "Solicitud imposible",
                    res : error
                }
            )
        }
    )

}

export default extractData