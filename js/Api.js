
class Api {
    
    constructor(){

        // Enlace de la API:  'http://www.etnassoft.com/api/v1/get/?'
        //Constructor de todos los parámetros que pueden ser utilizados en la Api

        this.url= 'http://www.etnassoft.com/api/v1/get/?'

        this.category = 'all'
        this.numItems = '10'
        this.criteria = 'most_viewed'

        this.url += "criteria="+this.criteria+"&" 
       
        console.log('Objeto conexión a Api iniciado')
    }

    //Getters & Setters

    setCategory = category => {this.category = category}
    setNumItems = numItems => {this.numItems = numItems}
    setUrl = params => { this.url += params }


    getData = () => this.data
    getUrl = () => this.url 

    // searchBooks( ´Palabra a búsqueda´ ) :
    // Esta función es un prototipo básico de Búsqueda 
    // requiere un parámetro de entrada para así buscar coincidencias en libros. 
    // En dado caso de querer buscar por categorías o cambiar el 
    // número de resultados devueltos se deben utilizar las funciones setter.

    searchBooks(word){
        let params = new URLSearchParams({
            keyword : word,
            // criteria : this.criteria,
            category : this.category,
            num_items : this.numItems
        }).toString() // Crea los parámetros de búsqueda que 
        //               serán incluídos en el URL.

        console.log('Busqueda "Listar Libros" realizada URL generado...')
        
        this.setUrl(params)
        console.log(this.getUrl())

    }

    // getCategories() : 
    // Esta función se encarga de listar las categorías disponibles 
    // dentro de la Api

    getCategories(){

        let params = new URLSearchParams({
            get_categories : 'all'
        }).toString()// Crea los parámetros de búsqueda que 
        //              serán incluídos en el URL.

        console.log('Busqueda "Listar categorías" realizada URL generado...')

        this.setUrl(params) 
        console.log(this.getUrl())
    }

    // getBook(´ID a buscar´) :
    // Esta función se encarga de buscar los
    // datos de un libro basado en su ID.


    getBook(id){

        let params = new URLSearchParams({
            id : id
        }).toString()// Crea los parámetros de búsqueda que 
        //              serán incluídos en el URL.

        console.log('Busqueda "Listar categorías" realizada URL generado...')


        this.setUrl(params) 
        console.log(this.getUrl())
    }

}

export default Api;