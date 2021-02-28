
class Book {

    constructor() {
        //variables de book
        this.data = document.createElement("section");
        this.title = document.createElement("h2");
        this.autor = document.createElement("h3");
        this.ranking = document.createElement("div");
        this.description = document.createElement("article");
        this.cover = document.createElement("img");
    }

    createBook(parent, json) {

        console.log(json);

        if (typeof parent !== 'undefined') {
            let book = document.createElement("section");
            let parent_ = document.getElementById(parent);

            if (parent_ != null) {
                parent_.appendChild(book);
            } else {
                console.log("La sección anexada no existe");
            }
        }
    }

}