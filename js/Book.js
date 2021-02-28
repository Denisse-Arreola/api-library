
class Book {

    constructor() {
        //variables de book
        this.title = document.createElement("h2");
        this.author = document.createElement("h3");
        this.description = document.createElement("article");
        this.cover = document.createElement("img");
        //this.ranking = document.createElement("div");
    }

    createBook(parent, json) {

        let book = document.createElement("section");
        book.className = "book-element";
        //console.log(json);

        if (typeof json !== 'undefined') {
            this.title.innerHTML = json.title;
            this.author.innerHTML = json.author;
            this.description.innerHTML = json.content_short
            this.cover.src = json.cover;

            let data = document.createElement("section");

            data.appendChild(this.title);
            data.appendChild(this.author);
            data.appendChild(this.description);

            book.appendChild(this.cover);
            book.appendChild(data);

        } else {
            console.log("No se encontró formato json");
        }


        if (typeof parent !== 'undefined') {
            let parent_ = document.getElementById(parent);

            if (parent_ != null) {
                parent_.appendChild(book);
            } else {
                console.log("La sección anexada no existe");
            }
        } else {
            console.log("No se recibió una sección para el libro");
        }
    }

}