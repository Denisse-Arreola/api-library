
class Book {

    constructor() {
        this.bookSec = document.createElement("section");
        this.title = document.createElement("h2");
        this.autor = document.createElement("h3");
        this.ranking = document.createElement("div");
        this.description = document.createElement("article");
        this.cover = document.createElement("img");
        //this.style = {""}; 
    }

    //prepareStyle() {}

    createBook(json) {

        console.log(json);

        this.bookSec.appendChild(this.title);
        this.bookSec.appendChild(this.autor);
        this.bookSec.appendChild(this.ranking);
        this.bookSec.appendChild(this.description);
        this.bookSec.appendChild(this.cover);

        let book = this.bookSec;

        return book;
    }


    //bookList
}