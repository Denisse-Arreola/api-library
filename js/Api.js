class Api {
    
    constructor(){

        // Enlace de la API:  'http://www.etnassoft.com/api/v1/get/?'
        //Constructor de todos los parámetros que pueden ser utilizados en la Api

        this.url= 'http://www.etnassoft.com/api/v1/get/?'

        this.category = 'all'
        this.numItems = '10'
        this.data = Array()

       
        console.log('Objeto conexión a Api iniciado')
    }

    //Getters & Setters

    setCategory = category => {this.category = category}
    setNumItems = numItems => {this.numItems = numItems}
    setData = data => {this.data = data}

    getData = () => this.data

    // searchBooks( ´Palabra a búsqueda´ ) :
    // Esta función es un prototipo básico de Búsqueda 
    // requiere un parámetro de entrada para así buscar coincidencias en libros. 
    // En dado caso de querer buscar por categorías o cambiar el 
    // número de resultados devueltos se deben utilizar las funciones setter.

    searchBooks(word){
        let params = new URLSearchParams({
            keyword : word,
            category : this.category,
            num_items : this.numItems
        }).toString() // Crea los parámetros de búsqueda que 
        //               serán incluídos en el URL.

        console.log('Busqueda "Listar Libros" realizada URL generado...')
        console.log(this.url + params)

        this.connect(this.url + params) // Llamada a la función connect()

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
        console.log(this.url + params)

        this.connect(this.url + params) // Llamada a la función connect()
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
        console.log(this.url + params)


        this.connect(this.url + params) // Llamada a la función connect()

    }


    // connect(´URL de búsqueda´) :
    // Esta función se encarga de conectar con los distintos URL
    // creados.

    connect(url){

        //Arreglo temporal
        let temp = Array()

        // Se genera la conexión.

        fetch(url).
        then(res => res.json()).
        then(data => data.map(
                // Se genera un traslado de los datos obtenidos
                // a el arreglo temporal.
                element => temp.push(element)
            )
        )

        this.setData(temp)

    }

}

// obj = new Api()
// obj.getCategories()


// obj.setCategory('Matematicas')
// obj.setNumItems('15')
// obj.searchBooks('Calculo')

// obj.getBook('17036')

// console.log(obj.getData());